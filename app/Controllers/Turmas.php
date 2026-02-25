<?php

namespace App\Controllers;

use App\Models\TurmaModel;
use App\Models\SalaModel;
use App\Models\DisciplinaModel;
use App\Models\TrabalhadorModel;

class Turmas extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        
        // Filtramos as turmas para que o usuário veja primeiro as do ano atual
        $anoAtual = date('Y');

        $data['turmas'] = $db->table('turmas')
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

    public function editar($id_turma)
    {
        $trabalhadorModel = new TrabalhadorModel();
        $db = \Config\Database::connect();

        $data = [
            'turma'       => $db->table('turmas')->where('id_turma', $id_turma)->get()->getRowArray(),
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
        echo view('turmas/editar', $data);
        echo view('templates/footer');
    }

    public function update()
    {
        $model    = new TurmaModel();
        $id_turma = $this->request->getPost('id_turma');
        $data     = [
            'nome_turma'    => $this->request->getPost('nome_turma'),
            'classe'        => $this->request->getPost('classe'),
            'id_professor'  => $this->request->getPost('id_professor'),
            'id_disciplina' => $this->request->getPost('id_disciplina'),
            'id_sala'       => $this->request->getPost('id_sala'),
            'periodo'       => $this->request->getPost('periodo'),
            'ano_letivo'    => $this->request->getPost('ano_letivo'),
        ];

        $model->update($id_turma, $data);
        session()->setFlashdata('sucesso', 'Turma atualizada com sucesso!');
        return redirect()->to(base_url('turmas'));
    }

    public function detalhes($id_turma = null)
    {
        if (!$id_turma) return redirect()->to(base_url('turmas'));

        $db = \Config\Database::connect();

        // 1. Pegamos os dados da Turma
        $turma = $db->table('turmas')
            ->select('turmas.*, trabalhadores.nome as nome_professor, disciplinas.nome_disciplina, salas.nome_sala')
            ->join('trabalhadores', 'trabalhadores.id_trabalhador = turmas.id_professor', 'left')
            ->join('disciplinas', 'disciplinas.id_disciplina = turmas.id_disciplina', 'left')
            ->join('salas', 'salas.id_sala = turmas.id_sala', 'left')
            ->where('turmas.id_turma', $id_turma)
            ->get()->getRowArray();

        $data['turma'] = $turma;

        // 2. FILTRO IMPORTANTE: Pegamos apenas alunos com matrícula CONFIRMADA nesta turma
        // E garantimos que não haja duplicatas na exibição
        $data['alunos'] = $db->table('matriculas')
            ->select('alunos.nome, alunos.telefone, matriculas.id_matricula, matriculas.status, matriculas.data_inscricao')
            ->join('alunos', 'alunos.id_aluno = matriculas.id_aluno')
            ->where('matriculas.id_turma', $id_turma)
            ->where('matriculas.status', 'Confirmada') // APENAS CONFIRMADOS
            ->orderBy('alunos.nome', 'ASC')
            ->get()->getResultArray();

        // 3. Opcional: Lista de alunos pendentes (caso queira ver quem ainda não foi confirmado)
        $data['pendentes'] = $db->table('matriculas')
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
        $db = \Config\Database::connect();
        $data['alunos'] = $db->table('alunos')->orderBy('nome', 'ASC')->get()->getResultArray();
        $data['turmas'] = $db->table('turmas')->where('ano_letivo', date('Y'))->get()->getResultArray();

        echo view('templates/header');
        echo view('templates/sidebar');
        echo view('turmas/matricular', $data);
        echo view('templates/footer');
    }

    public function salvarMatricula()
    {
        $db       = \Config\Database::connect();
        $id_aluno = $this->request->getPost('id_aluno');
        $id_turma = $this->request->getPost('id_turma');

        // Pegamos o ano lectivo da turma alvo
        $turmaAlvo = $db->table('turmas')->where('id_turma', $id_turma)->get()->getRowArray();
        $anoDaTurma = $turmaAlvo['ano_letivo'];

        // VERIFICAÇÃO DE DUPLICIDADE POR ANO LECTIVO
        // Verifica se o aluno já tem qualquer matrícula (Pendente ou Confirmada) NESTE ANO em QUALQUER turma
        $jaMatriculado = $db->table('matriculas')
            ->join('turmas', 'turmas.id_turma = matriculas.id_turma')
            ->where('matriculas.id_aluno', $id_aluno)
            ->where('turmas.ano_letivo', $anoDaTurma)
            ->whereIn('matriculas.status', ['Pendente', 'Confirmada'])
            ->countAllResults();

        if ($jaMatriculado) {
            session()->setFlashdata('erro', 'Este aluno já possui uma matrícula ativa ou pendente para o ano lectivo ' . $anoDaTurma);
            return redirect()->back();
        }

        $db->table('matriculas')->insert([
            'id_aluno' => $id_aluno,
            'id_turma' => $id_turma,
            'status'   => 'Pendente',
            'data_inscricao' => date('Y-m-d H:i:s')
        ]);

        session()->setFlashdata('sucesso', 'Inscrição realizada com sucesso!');
        return redirect()->to(base_url('turmas/detalhes/' . $id_turma));
    }

    public function confirmar($id_matricula)
    {
        $db = \Config\Database::connect();
        $db->table('matriculas')
           ->where('id_matricula', $id_matricula)
           ->update(['status' => 'Confirmada']);

        session()->setFlashdata('sucesso', 'Matrícula confirmada!');
        return redirect()->back();
    }

    public function cancelarMatricula($id_matricula)
    {
        $db = \Config\Database::connect();
        $db->table('matriculas')
           ->where('id_matricula', $id_matricula)
           ->update(['status' => 'Cancelada']);

        session()->setFlashdata('sucesso', 'Matrícula cancelada.');
        return redirect()->back();
    }

    public function excluir()
    {
        $id    = $this->request->getPost('id_turma');
        $model = new TurmaModel();
        if ($id) {
            $model->delete($id);
            session()->setFlashdata('sucesso', 'Turma removida com sucesso.');
        }
        return redirect()->to(base_url('turmas'));
    }
}