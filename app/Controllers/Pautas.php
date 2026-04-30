<?php
namespace App\Controllers;

use App\Models\NotaModel;
use App\Models\TurmaModel;
use App\Models\DisciplinaModel;
use App\Models\TrabalhadorModel;

class Pautas extends BaseController
{
    protected NotaModel        $notaModel;
    protected TurmaModel       $turmaModel;
    protected DisciplinaModel  $disciplinaModel;
    protected TrabalhadorModel $trabalhadorModel;

    public function initController(
        \CodeIgniter\HTTP\RequestInterface  $request,
        \CodeIgniter\HTTP\ResponseInterface $response,
        \Psr\Log\LoggerInterface            $logger
    ) {
        parent::initController($request, $response, $logger);
        $this->notaModel        = new NotaModel();
        $this->turmaModel       = new TurmaModel();
        $this->disciplinaModel  = new DisciplinaModel();
        $this->trabalhadorModel = new TrabalhadorModel();
    }

    // ─── HELPER: Busca o trabalhador ligado ao utilizador logado ───────────
    // Tenta ligar pelo email do utilizador ao email do trabalhador.
    // Se a sua tabela usuarios tiver uma coluna id_trabalhador, é ainda mais direto.
    private function getTrabalhadorLogado(): ?array
    {
        // Tenta pelo email (campo guardado na sessão pelo Login)
        $email = session()->get('email_usuario') ?? session()->get('email');

        if (empty($email)) return null;

        return $this->trabalhadorModel->where('email', $email)->first();
    }

    // ─── SELECIONAR TURMA ──────────────────────────────────────────────────
    public function index()
    {
        $this->proteger(['admin', 'director', 'secretario', 'professor']);

        $db     = db_connect();
        $perfil = strtolower(session()->get('perfil') ?? '');

        $busca   = $this->request->getGet('busca');
        $periodo = $this->request->getGet('periodo');

        $builder = $db->table('turmas t')
            ->select('t.id_turma, t.nome_turma, t.periodo, t.ano_letivo,
                      d.id_disciplina, d.nome_disciplina,
                      s.nome_sala,
                      tr.nome AS nome_professor')
            ->join('disciplinas d',    'd.id_disciplina = t.id_disciplina', 'left')
            ->join('salas s',          's.id_sala = t.id_sala',             'left')
            ->join('trabalhadores tr', 'tr.id_trabalhador = t.id_professor', 'left');

        // ── Restrição por Perfil ──────────────────────────────────────────
        if (in_array($perfil, ['professor', 'professora'])) {
            $trabalhador = $this->getTrabalhadorLogado();

            if ($trabalhador) {
                $builder->where('t.id_professor', $trabalhador['id_trabalhador']);
            } else {
                // Nenhum trabalhador ligado a este utilizador — lista vazia
                $builder->where('t.id_turma', -1);
            }
        }

        // ── Filtros de Busca ──────────────────────────────────────────────
        if (!empty($busca)) {
            $builder->groupStart()
                    ->like('t.nome_turma', $busca)
                    ->orLike('tr.nome', $busca)
                    ->orLike('d.nome_disciplina', $busca)
                    ->groupEnd();
        }

        if (!empty($periodo)) {
            $builder->where('t.periodo', $periodo);
        }

        $turmas = $builder
            ->where('t.id_disciplina IS NOT NULL')
            ->orderBy('t.nome_turma', 'ASC')
            ->get()->getResultArray();

        // ── Contagem correta para o painel do professor ───────────────────
        $total_turmas = count($turmas);

        $data = [
            'turmas'      => $turmas,
            'total_turmas'=> $total_turmas,
            'ano_corrente'=> date('Y'),
            'titulo'      => 'Mini Pautas',
            'pode_editar' => $this->isAdmin() || $this->isProfessor() || in_array($perfil, ['secretario']),
            'so_leitura'  => in_array($perfil, ['director', 'directora']) && !$this->isProfessor(),
        ];

        echo view('templates/header');
        echo view('templates/sidebar');
        echo view('pautas/selecionar', $data);
        echo view('templates/footer');
    }

    // ─── LANÇAR NOTAS ────────────────────────────────────────────────────
    public function lancar(int $id_turma)
    {
        $this->proteger(['admin', 'director', 'secretario', 'professor']);

        $perfil     = strtolower(session()->get('perfil') ?? '');
        $so_leitura = in_array($perfil, ['director', 'directora']);

        // Verificar se o professor tem acesso a esta turma
        if (in_array($perfil, ['professor', 'professora'])) {
            $trabalhador = $this->getTrabalhadorLogado();

            if ($trabalhador) {
                $db          = db_connect();
                $turma_check = $db->table('turmas')
                    ->where('id_turma', $id_turma)
                    ->where('id_professor', $trabalhador['id_trabalhador'])
                    ->get()->getRowArray();

                if (!$turma_check) {
                    session()->setFlashdata('erro', 'Não tem permissão para aceder a esta turma.');
                    return redirect()->to(base_url('pautas'));
                }
            } else {
                session()->setFlashdata('erro', 'Utilizador não está associado a nenhum professor.');
                return redirect()->to(base_url('pautas'));
            }
        }

        $trimestre = (int)($this->request->getGet('trimestre') ?? 1);
        if ($trimestre < 1 || $trimestre > 3) $trimestre = 1;

        $db    = db_connect();
        $turma = $db->table('turmas t')
            ->select('t.*, d.id_disciplina, d.nome_disciplina,
                      s.nome_sala,
                      tr.nome AS nome_professor,
                      tr.telefone AS tel_professor,
                      tr.id_trabalhador AS id_professor')
            ->join('disciplinas d',    'd.id_disciplina = t.id_disciplina', 'left')
            ->join('salas s',          's.id_sala = t.id_sala',             'left')
            ->join('trabalhadores tr', 'tr.id_trabalhador = t.id_professor', 'left')
            ->where('t.id_turma', $id_turma)
            ->get()->getRowArray();

        if (!$turma) {
            session()->setFlashdata('erro', 'Turma não encontrada.');
            return redirect()->to(base_url('pautas'));
        }

        $alunos = $db->query("
            SELECT a.id_aluno, a.nome AS nome_aluno, a.genero,
                   n.id_nota, n.mac, n.npp, n.npt, n.mt, n.falta, n.observacao
            FROM matriculas m
            JOIN alunos a ON a.id_aluno = m.id_aluno
            LEFT JOIN notas n
                   ON n.id_aluno     = m.id_aluno
                  AND n.id_turma     = m.id_turma
                  AND n.id_disciplina = ?
                  AND n.trimestre    = ?
            WHERE m.id_turma = ? AND m.status = 'Confirmada'
            ORDER BY a.nome ASC
        ", [$turma['id_disciplina'], $trimestre, $id_turma])->getResultArray();

        $stats = $this->notaModel->getEstatisticas($id_turma, $turma['id_disciplina'], $trimestre);

        $data = [
            'turma'      => $turma,
            'alunos'     => $alunos,
            'trimestre'  => $trimestre,
            'stats'      => $stats,
            'titulo'     => 'Lançar Notas – ' . $turma['nome_turma'],
            'so_leitura' => $so_leitura,
        ];

        echo view('templates/header');
        echo view('templates/sidebar');
        echo view('pautas/lancar', $data);
        echo view('templates/footer');
    }

    // ─── GUARDAR NOTAS ───────────────────────────────────────────────────
    public function salvar()
    {
        $this->proteger(['admin', 'secretario', 'professor']);

        $post      = $this->request->getPost();
        $id_turma  = (int)($post['id_turma']  ?? 0);
        $trimestre = (int)($post['trimestre'] ?? 1);

        if ($id_turma === 0) {
            session()->setFlashdata('erro', 'Turma inválida.');
            return redirect()->to(base_url('pautas'));
        }

        // Verificar permissão do professor
        if ($this->isProfessor()) {
            $trabalhador = $this->getTrabalhadorLogado();

            if ($trabalhador) {
                $db          = db_connect();
                $turma_check = $db->table('turmas')
                    ->where('id_turma', $id_turma)
                    ->where('id_professor', $trabalhador['id_trabalhador'])
                    ->get()->getRowArray();

                if (!$turma_check) {
                    session()->setFlashdata('erro', 'Não tem permissão para guardar notas nesta turma.');
                    return redirect()->to(base_url('pautas'));
                }
            } else {
                session()->setFlashdata('erro', 'Utilizador não está associado a nenhum professor.');
                return redirect()->to(base_url('pautas'));
            }
        }

        $turma = $this->turmaModel->find($id_turma);
        if (!$turma) {
            session()->setFlashdata('erro', 'Turma não encontrada.');
            return redirect()->to(base_url('pautas'));
        }

        $lote       = [];
        $alunos_ids = $post['aluno_id'] ?? [];

        foreach ($alunos_ids as $id_aluno) {
            $id    = (int)$id_aluno;
            $mac   = (isset($post["mac_{$id}"])   && $post["mac_{$id}"]   !== '') ? (float)$post["mac_{$id}"]   : null;
            $npp   = (isset($post["npp_{$id}"])   && $post["npp_{$id}"]   !== '') ? (float)$post["npp_{$id}"]   : null;
            $npt   = (isset($post["npt_{$id}"])   && $post["npt_{$id}"]   !== '') ? (float)$post["npt_{$id}"]   : null;
            $falta = isset($post["falta_{$id}"]) ? 1 : 0;
            $obs   = $post["obs_{$id}"] ?? null;

            $lote[] = [
                'id_aluno'      => $id,
                'id_turma'      => $id_turma,
                'id_disciplina' => $turma['id_disciplina'],
                'id_professor'  => $turma['id_professor'],
                'trimestre'     => $trimestre,
                'mac'           => $mac,
                'npp'           => $npp,
                'npt'           => $npt,
                'falta'         => $falta,
                'observacao'    => $obs,
            ];
        }

        if ($this->notaModel->salvarLote($lote)) {
            session()->setFlashdata('sucesso', 'Notas guardadas com sucesso!');
        } else {
            session()->setFlashdata('erro', 'Erro ao guardar as notas. Tente novamente.');
        }

        return redirect()->to(base_url("pautas/lancar/{$id_turma}?trimestre={$trimestre}"));
    }

    // ─── VER PAUTA COMPLETA ──────────────────────────────────────────────
    public function ver(int $id_turma)
    {
        $this->proteger(['admin', 'director', 'secretario', 'professor']);

        $db    = db_connect();
        $turma = $db->table('turmas t')
            ->select('t.*, d.id_disciplina, d.nome_disciplina, s.nome_sala,
                      tr.nome AS nome_professor, tr.telefone AS tel_professor')
            ->join('disciplinas d',    'd.id_disciplina = t.id_disciplina', 'left')
            ->join('salas s',          's.id_sala = t.id_sala',             'left')
            ->join('trabalhadores tr', 'tr.id_trabalhador = t.id_professor', 'left')
            ->where('t.id_turma', $id_turma)
            ->get()->getRowArray();

        if (!$turma) {
            session()->setFlashdata('erro', 'Turma não encontrada.');
            return redirect()->to(base_url('pautas'));
        }

        $pauta = $this->notaModel->getPautaCompleta($id_turma, $turma['id_disciplina']);
        $stats = [
            1 => $this->notaModel->getEstatisticas($id_turma, $turma['id_disciplina'], 1),
            2 => $this->notaModel->getEstatisticas($id_turma, $turma['id_disciplina'], 2),
            3 => $this->notaModel->getEstatisticas($id_turma, $turma['id_disciplina'], 3),
        ];

        echo view('templates/header');
        echo view('templates/sidebar');
        echo view('pautas/ver', ['turma' => $turma, 'pauta' => $pauta, 'stats' => $stats]);
        echo view('templates/footer');
    }

    // ─── IMPRIMIR ────────────────────────────────────────────────────────
    public function imprimir(int $id_turma)
    {
        $this->proteger(['admin', 'director', 'secretario', 'professor']);

        $db    = db_connect();
        $turma = $db->table('turmas t')
            ->select('t.*, d.id_disciplina, d.nome_disciplina, s.nome_sala, t.periodo,
                      tr.nome AS nome_professor, tr.telefone AS tel_professor')
            ->join('disciplinas d',    'd.id_disciplina = t.id_disciplina', 'left')
            ->join('salas s',          's.id_sala = t.id_sala',             'left')
            ->join('trabalhadores tr', 'tr.id_trabalhador = t.id_professor', 'left')
            ->where('t.id_turma', $id_turma)
            ->get()->getRowArray();

        if (!$turma) {
            session()->setFlashdata('erro', 'Turma não encontrada.');
            return redirect()->to(base_url('pautas'));
        }

        $pauta = $this->notaModel->getPautaCompleta($id_turma, $turma['id_disciplina']);
        $stats = [
            1 => $this->notaModel->getEstatisticas($id_turma, $turma['id_disciplina'], 1),
            2 => $this->notaModel->getEstatisticas($id_turma, $turma['id_disciplina'], 2),
            3 => $this->notaModel->getEstatisticas($id_turma, $turma['id_disciplina'], 3),
        ];

        echo view('pautas/imprimir', ['turma' => $turma, 'pauta' => $pauta, 'stats' => $stats]);
    }
}