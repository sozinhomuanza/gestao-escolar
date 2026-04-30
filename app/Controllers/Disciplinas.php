<?php
namespace App\Controllers;
use App\Models\DisciplinaModel;

class Disciplinas extends BaseController {
    private $disciplina_model;

    public function __construct() {
        helper(['url', 'form']);
        $this->disciplina_model = new DisciplinaModel();
        if (!session()->get('logado')) return redirect()->to(base_url('login'));
    }

    public function index() {
        $data['disciplinas'] = $this->disciplina_model->findAll();
        echo view('templates/header');
        echo view('templates/sidebar');
        echo view('disciplinas/index', $data);
        echo view('templates/footer');
    }

    public function novo() {
        echo view('templates/header');
        echo view('templates/sidebar');
        echo view('disciplinas/novo');
        echo view('templates/footer');
    }

    public function store() {
        $dados = $this->request->getPost();
        $this->disciplina_model->insert($dados);
        session()->setFlashdata('sucesso', 'Disciplina criada com sucesso!');
        return redirect()->to(base_url('disciplinas'));
    }

    public function editar($id) {
        $data['disciplina'] = $this->disciplina_model->find($id);
        if (!$data['disciplina']) return redirect()->to(base_url('disciplinas'));
        echo view('templates/header');
        echo view('templates/sidebar');
        echo view('disciplinas/editar', $data);
        echo view('templates/footer');
    }

    public function update() {
        $id    = $this->request->getPost('id_disciplina');
        $dados = [
            'nome_disciplina' => $this->request->getPost('nome_disciplina'),
            'carga_horaria'   => $this->request->getPost('carga_horaria'),
            'descricao'       => $this->request->getPost('descricao'),
        ];
        $this->disciplina_model->update($id, $dados);
        session()->setFlashdata('sucesso', 'Disciplina atualizada!');
        return redirect()->to(base_url('disciplinas'));
    }

    public function excluir() {
        $id = $this->request->getPost('id_disciplina');
        if ($id) { $this->disciplina_model->delete($id); session()->setFlashdata('sucesso', 'Disciplina removida.'); }
        return redirect()->to(base_url('disciplinas'));
    }
}
