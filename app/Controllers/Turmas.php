<?php

namespace App\Controllers;

use App\Models\TurmaModel;
use App\Models\SalaModel;
use App\Models\DisciplinaModel;
use App\Models\TrabalhadorModel;

class Turmas extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $data['turmas'] = $this->db->table('turmas')
            ->select('turmas.*, trabalhadores.nome as nome_professor, disciplinas.nome_disciplina, salas.nome_sala')
            ->join('trabalhadores', 'trabalhadores.id_trabalhador = turmas.id_professor', 'left')
            ->join('disciplinas', 'disciplinas.id_disciplina = turmas.id_disciplina', 'left')
            ->join('salas', 'salas.id_sala = turmas.id_sala', 'left')
            ->orderBy('turmas.ano_letivo', 'DESC')
            ->orderBy('turmas.classe', 'ASC')
            ->get()->getResultArray();

        echo view('templates/header');
        echo view('templates/sidebar');
        echo view('turmas/index', $data);
        echo view('templates/footer');
    }

    public function novo()
    {
        $trabalhadorModel = new TrabalhadorModel();
        $data = [
            'salas'       => (new SalaModel())->findAll(),
            'disciplinas' => (new DisciplinaModel())->findAll(),
            'professores' => $trabalhadorModel
                ->groupStart()
                    ->where('funcao', 'Professor')
                    ->orWhere('funcao', 'Professora')
                ->groupEnd()
                ->findAll(),
        ];

        echo view('templates/header');
        echo view('templates/sidebar');
        echo view('turmas/novo', $data);
        echo view('templates/footer');
    }

    public function store()
    {
        $model = new TurmaModel();
        $data  = [
            'nome_turma'    => $this->request->getPost('nome_turma'),
            'classe'        => $this->request->getPost('classe'),
            'id_professor'  => $this->request->getPost('id_professor'),
            'id_disciplina' => $this->request->getPost('id_disciplina'),
            'id_sala'       => $this->request->getPost('id_sala'),
            'periodo'       => $this->request->getPost('periodo'),
            'ano_letivo'    => $this->request->getPost('ano_letivo') ?? date('Y'),
        ];

        $model->save($data);
        session()->setFlashdata('sucesso', 'Turma criada com sucesso!');
        return redirect()->to(base_url('turmas'));
    }

    public function detalhes($id_turma = null)
    {
        if (!$id_turma) return redirect()->to(base_url('turmas'));

        $data['turma'] = $this->db->table('turmas')
            ->select('turmas.*, trabalhadores.nome as nome_professor, disciplinas.nome_disciplina, salas.nome_sala')
            ->join('trabalhadores', 'trabalhadores.id_trabalhador = turmas.id_professor', 'left')
            ->join('disciplinas', 'disciplinas.id_disciplina = turmas.id_disciplina', 'left')
            ->join('salas', 'salas.id_sala = turmas.id_sala', 'left')
            ->where('turmas.id_turma', $id_turma)
            ->get()->getRowArray();

        $data['alunos'] = $this->db->table('matriculas')
            ->select('alunos.nome, alunos.telefone, matriculas.id_matricula, matriculas.status, matriculas.data_inscricao')
            ->join('alunos', 'alunos.id_aluno = matriculas.id_aluno')
            ->where('matriculas.id_turma', $id_turma)
            ->where('matriculas.status', 'Confirmada')
            ->orderBy('alunos.nome', 'ASC')
            ->get()->getResultArray();

        $data['pendentes'] = $this->db->table('matriculas')
            ->join('alunos', 'alunos.id_aluno = matriculas.id_aluno')
            ->where('matriculas.id_turma', $id_turma)
            ->where('matriculas.status', 'Pendente')
            ->get()->getResultArray();

        echo view('templates/header');
        echo view('templates/sidebar');
        echo view('turmas/detalhes', $data);
        echo view('templates/footer');
    }

    public function matricular()
    {
        $data['alunos'] = $this->db->table('alunos')->orderBy('nome', 'ASC')->get()->getResultArray();
        $data['turmas'] = $this->db->table('turmas')->where('ano_letivo', date('Y'))->get()->getResultArray();
        
        $data['rupes_disponiveis'] = $this->db->table('estoque_rupes')
            ->where('status', 'livre')
            ->countAllResults();

        echo view('templates/header');
        echo view('templates/sidebar');
        echo view('turmas/matricular', $data);
        echo view('templates/footer');
    }

    /**
     * MÉTODO CORRIGIDO: salvarMatricula
     * Compatível com a rota e com o sistema de estoque de RUPEs
     */
    public function salvarMatricula()
    {
        // Pega os IDs do formulário (verifique se os nomes batem com o name="" do HTML)
        $id_aluno  = $this->request->getPost('id_aluno') ?? $this->request->getPost('aluno_id');
        $id_turma  = $this->request->getPost('id_turma') ?? $this->request->getPost('turma_id');
        $gerarRupe = $this->request->getPost('gerar_rupe');

        $this->db->transStart(); // Inicia transação

        try {
            // 1. Validar Turma
            $turma = $this->db->table('turmas')->where('id_turma', $id_turma)->get()->getRowArray();
            if (!$turma) throw new \Exception('Turma não encontrada.');

            // 2. Verificar duplicidade
            $jaMatriculado = $this->db->table('matriculas')
                ->join('turmas', 'turmas.id_turma = matriculas.id_turma')
                ->where('matriculas.id_aluno', $id_aluno)
                ->where('turmas.ano_letivo', $turma['ano_letivo'])
                ->whereIn('matriculas.status', ['Pendente', 'Confirmada'])
                ->countAllResults();

            if ($jaMatriculado) throw new \Exception('Aluno já matriculado neste ano letivo.');

            // 3. Inserir Matrícula
            $this->db->table('matriculas')->insert([
                'id_aluno'       => $id_aluno,
                'id_turma'       => $id_turma,
                'status'         => 'Pendente',
                'data_inscricao' => date('Y-m-d H:i:s')
            ]);

            // 4. Consumir RUPE se solicitado
            if ($gerarRupe == "1" || $gerarRupe == "on") {
                $rupe = $this->db->table('estoque_rupes')
                           ->where('status', 'livre')
                           ->orderBy('id', 'ASC')
                           ->limit(1)->get()->getRow();

                if (!$rupe) throw new \Exception('Estoque de RUPEs vazio! Importe novas referências.');

                $this->db->table('estoque_rupes')->where('id', $rupe->id)->update([
                    'status'   => 'utilizado',
                    'aluno_id' => $id_aluno,
                    'data_uso' => date('Y-m-d H:i:s')
                ]);

                $this->db->transComplete();
                // Redireciona direto para a impressão
                return redirect()->to(base_url("financeiro/imprimir_guia/{$id_aluno}/{$rupe->numero_rupe}"));
            }

            $this->db->transComplete();
            return redirect()->to(base_url('turmas/detalhes/' . $id_turma))->with('sucesso', 'Matrícula Pendente salva!');

        } catch (\Exception $e) {
            $this->db->transRollback();
            return redirect()->back()->with('erro', $e->getMessage());
        }
    }

    public function confirmar($id_matricula)
    {
        $this->db->table('matriculas')
           ->where('id_matricula', $id_matricula)
           ->update(['status' => 'Confirmada']);

        session()->setFlashdata('sucesso', 'Matrícula confirmada!');
        return redirect()->back();
    }

    public function excluir()
    {
        $id = $this->request->getPost('id_turma');
        if ($id) {
            (new TurmaModel())->delete($id);
            session()->setFlashdata('sucesso', 'Turma removida.');
        }
        return redirect()->to(base_url('turmas'));
    }
}