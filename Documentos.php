<?php

namespace App\Controllers;

class Documentos extends BaseController
{
    // ─────────────────────────────────────────────────────────
    // PÁGINA PRINCIPAL
    // ─────────────────────────────────────────────────────────
    public function index()
    {
        $this->proteger(['admin', 'secretario']);

        $db      = db_connect();
        $search  = $this->request->getGet('q');
        $turmaId = $this->request->getGet('turma_id');
        $ano     = $this->request->getGet('ano') ?? date('Y');

        $builder = $db->table('alunos a')
            ->select('a.id_aluno, a.nome, a.data_nascimento, a.genero,
                      t.id_turma, t.nome_turma, t.periodo, t.ano_letivo,
                      m.status AS status_matricula')
            ->join('matriculas m', 'm.id_aluno = a.id_aluno', 'left')
            ->join('turmas t',     't.id_turma = m.id_turma', 'left')
            ->orderBy('a.nome', 'ASC');

        if (!empty($search)) {
            $builder->groupStart()
                ->like('a.nome', $search)
                ->orLike('t.nome_turma', $search)
                ->groupEnd();
        }
        if (!empty($turmaId)) $builder->where('m.id_turma', $turmaId);
        if (!empty($ano))     $builder->where('t.ano_letivo', $ano);

        $alunos = $builder->get()->getResultArray();
        $turmas = $db->table('turmas')->orderBy('nome_turma')->get()->getResultArray();
        $anos   = $db->table('turmas')
            ->select('DISTINCT ano_letivo')
            ->orderBy('ano_letivo','DESC')
            ->get()->getResultArray();

        echo view('templates/header');
        echo view('templates/sidebar');
        echo view('documentos/index', compact('alunos','turmas','anos','search','turmaId','ano'));
        echo view('templates/footer');
    }

    // ─────────────────────────────────────────────────────────
    // BOLETIM DE NOTAS
    // ─────────────────────────────────────────────────────────
    public function boletim(int $alunoId)
    {
        $this->proteger(['admin', 'secretario']);
        $db  = db_connect();
        $ano = $this->request->getGet('ano') ?? date('Y');

        $aluno = $this->_getAluno($db, $alunoId, $ano);
        if (!$aluno) return redirect()->to(base_url('documentos'));

        // Notas: mac=MAC, npp=Nota Prova Parcial, npt=Nota Prova Trimestral, mt=Média Trimestral (STORED)
        $notasRaw = $db->query("
            SELECT n.id_disciplina, n.trimestre,
                   n.mac, n.npp, n.npt, n.mt, n.falta, n.observacao,
                   d.nome_disciplina
            FROM notas n
            JOIN disciplinas d ON d.id_disciplina = n.id_disciplina
            JOIN turmas t      ON t.id_turma = n.id_turma
            WHERE n.id_aluno = ?
              AND t.ano_letivo = ?
            ORDER BY d.nome_disciplina ASC, n.trimestre ASC
        ", [$alunoId, $ano])->getResultArray();

        // Organizar por disciplina → trimestres
        $notas = [];
        foreach ($notasRaw as $n) {
            $did = $n['id_disciplina'];
            if (!isset($notas[$did])) {
                $notas[$did] = [
                    'disciplina' => $n['nome_disciplina'],
                    'trimestres' => [1 => null, 2 => null, 3 => null],
                ];
            }
            $notas[$did]['trimestres'][$n['trimestre']] = $n;
        }

        // Média anual = média das mt preenchidas
        foreach ($notas as &$nd) {
            $mts = array_filter(array_column($nd['trimestres'], 'mt'));
            $nd['media_anual'] = count($mts) ? round(array_sum($mts) / count($mts), 2) : null;
            $nd['situacao']    = $nd['media_anual'] !== null
                ? ($nd['media_anual'] >= 10 ? 'Aprovado' : 'Reprovado') : null;
            $nd['total_faltas']= array_sum(array_column(array_filter($nd['trimestres']), 'falta'));
        }
        unset($nd);

        $escola = $this->_getEscola();
        echo view('documentos/boletim', compact('aluno','notas','ano','escola'));
    }

    // ─────────────────────────────────────────────────────────
    // DECLARAÇÃO COM NOTAS
    // ─────────────────────────────────────────────────────────
    public function declaracaoComNotas(int $alunoId)
    {
        $this->proteger(['admin', 'secretario']);
        $db  = db_connect();
        $ano = $this->request->getGet('ano') ?? date('Y');

        $aluno = $this->_getAluno($db, $alunoId, $ano);
        if (!$aluno) return redirect()->to(base_url('documentos'));

        $notas = $db->query("
            SELECT d.nome_disciplina,
                   ROUND(AVG(n.mt), 2)   AS media_final,
                   SUM(n.falta)           AS total_faltas
            FROM notas n
            JOIN disciplinas d ON d.id_disciplina = n.id_disciplina
            JOIN turmas t      ON t.id_turma = n.id_turma
            WHERE n.id_aluno = ?
              AND t.ano_letivo = ?
            GROUP BY n.id_disciplina
            ORDER BY d.nome_disciplina ASC
        ", [$alunoId, $ano])->getResultArray();

        $mediaGeral = count($notas)
            ? round(array_sum(array_column($notas,'media_final')) / count($notas), 2)
            : null;

        $escola = $this->_getEscola();
        echo view('documentos/declaracao_com_notas', compact('aluno','notas','mediaGeral','ano','escola'));
    }

    // ─────────────────────────────────────────────────────────
    // DECLARAÇÃO SEM NOTAS
    // ─────────────────────────────────────────────────────────
    public function declaracaoSemNotas(int $alunoId)
    {
        $this->proteger(['admin', 'secretario']);
        $db  = db_connect();
        $ano = $this->request->getGet('ano') ?? date('Y');

        $aluno = $this->_getAluno($db, $alunoId, $ano);
        if (!$aluno) return redirect()->to(base_url('documentos'));

        $escola = $this->_getEscola();
        echo view('documentos/declaracao_sem_notas', compact('aluno','ano','escola'));
    }

    // ─────────────────────────────────────────────────────────
    // LANÇAR / EDITAR NOTAS
    // ─────────────────────────────────────────────────────────
    public function lancarNotas(int $alunoId)
    {
        $this->proteger(['admin', 'secretario']);
        $db      = db_connect();
        $ano     = $this->request->getGet('ano') ?? date('Y');

        $aluno = $this->_getAluno($db, $alunoId, $ano);
        if (!$aluno) return redirect()->to(base_url('documentos'));

        $turmaId = $this->request->getGet('turma_id') ?? $aluno['id_turma'] ?? null;

        $disciplinas = $db->table('disciplinas')
            ->orderBy('nome_disciplina','ASC')
            ->get()->getResultArray();

        // Notas existentes indexadas [id_disciplina][trimestre]
        $notasExist = [];
        if ($turmaId) {
            $raw = $db->table('notas')
                ->where('id_aluno', $alunoId)
                ->where('id_turma', $turmaId)
                ->get()->getResultArray();
            foreach ($raw as $r) {
                $notasExist[$r['id_disciplina']][$r['trimestre']] = $r;
            }
        }

        $professorId = session()->get('usuario_id') ?? 1;

        echo view('templates/header');
        echo view('templates/sidebar');
        echo view('documentos/lancar_notas', compact(
            'aluno','disciplinas','notasExist','ano','turmaId','professorId'
        ));
        echo view('templates/footer');
    }

    public function salvarNotas()
    {
        $this->proteger(['admin', 'secretario']);
        $db          = db_connect();
        $alunoId     = (int) $this->request->getPost('aluno_id');
        $turmaId     = (int) $this->request->getPost('turma_id');
        $anoLetivo   = $this->request->getPost('ano_letivo') ?? date('Y');
        $professorId = (int) ($this->request->getPost('professor_id') ?? session()->get('usuario_id') ?? 1);
        $notasPost   = $this->request->getPost('notas');

        if (!$alunoId || !$turmaId || empty($notasPost)) {
            session()->setFlashdata('erro', 'Dados inválidos.');
            return redirect()->back();
        }

        foreach ($notasPost as $discId => $trimestres) {
            foreach ($trimestres as $tri => $c) {
                $mac = isset($c['mac']) && $c['mac'] !== '' ? (float)$c['mac'] : null;
                $npp = isset($c['npp']) && $c['npp'] !== '' ? (float)$c['npp'] : null;
                $npt = isset($c['npt']) && $c['npt'] !== '' ? (float)$c['npt'] : null;

                // mt é coluna STORED GENERATED no MySQL — não a enviar no INSERT/UPDATE
                $dados = [
                    'id_aluno'      => $alunoId,
                    'id_turma'      => $turmaId,
                    'id_disciplina' => (int)$discId,
                    'id_professor'  => $professorId,
                    'trimestre'     => (int)$tri,
                    'mac'           => $mac,
                    'npp'           => $npp,
                    'npt'           => $npt,
                    'falta'         => isset($c['falta']) && $c['falta'] !== '' ? (int)$c['falta'] : 0,
                    'observacao'    => trim($c['observacao'] ?? '') ?: null,
                ];

                $existe = $db->table('notas')
                    ->where('id_aluno',      $alunoId)
                    ->where('id_turma',      $turmaId)
                    ->where('id_disciplina', (int)$discId)
                    ->where('trimestre',     (int)$tri)
                    ->countAllResults();

                if ($existe) {
                    unset($dados['id_aluno'],$dados['id_turma'],$dados['id_disciplina'],$dados['trimestre']);
                    $db->table('notas')
                        ->where('id_aluno',      $alunoId)
                        ->where('id_turma',      $turmaId)
                        ->where('id_disciplina', (int)$discId)
                        ->where('trimestre',     (int)$tri)
                        ->update($dados);
                } else {
                    $db->table('notas')->insert($dados);
                }
            }
        }

        session()->setFlashdata('sucesso', 'Notas guardadas com sucesso!');
        return redirect()->to(base_url("documentos/lancar-notas/{$alunoId}?ano={$anoLetivo}&turma_id={$turmaId}"));
    }

    // ─────────────────────────────────────────────────────────
    // HELPERS
    // ─────────────────────────────────────────────────────────
    private function _getAluno($db, int $id, string $ano): ?array
    {
        $row = $db->table('alunos a')
            ->select('a.id_aluno, a.nome, a.data_nascimento, a.genero,
                      a.telefone, a.email, a.nome_responsavel,
                      t.id_turma, t.nome_turma, t.periodo, t.ano_letivo,
                      m.status AS status_matricula, m.data_inscricao')
            ->join('matriculas m', 'm.id_aluno = a.id_aluno', 'left')
            ->join('turmas t',     't.id_turma = m.id_turma', 'left')
            ->where('a.id_aluno', $id)
            ->where('t.ano_letivo', $ano)
            ->orderBy('m.data_inscricao','DESC')
            ->limit(1)
            ->get()->getRowArray();

        if (!$row) {
            // fallback: pega sem filtro de ano
            $row = $db->table('alunos a')
                ->select('a.id_aluno, a.nome, a.data_nascimento, a.genero,
                          a.telefone, a.email, a.nome_responsavel,
                          t.id_turma, t.nome_turma, t.periodo, t.ano_letivo,
                          m.status AS status_matricula, m.data_inscricao')
                ->join('matriculas m', 'm.id_aluno = a.id_aluno', 'left')
                ->join('turmas t',     't.id_turma = m.id_turma', 'left')
                ->where('a.id_aluno', $id)
                ->orderBy('m.data_inscricao','DESC')
                ->limit(1)
                ->get()->getRowArray();
        }
        return $row ?: null;
    }

    private function _getEscola(): array
    {
        // ⚠️ Altere aqui com os dados reais da sua escola
        return [
            'nome'       => 'Escola Secundária',
            'endereco'   => 'Luanda, Angola',
            'telefone'   => '',
            'email'      => '',
            'ministerio' => 'Ministério da Educação de Angola',
            'provincia'  => 'Luanda',
        ];
    }
}