<?php

namespace App\Controllers;

use App\Models\ProfessorModel;

class Professores extends BaseController
{
    private $professor_model;

    public function __construct()
    {
        $this->professor_model = new ProfessorModel();
    }

    public function index()
    {
        $data['professores'] = $this->professor_model->findAll();

        echo view('templates/header');
        echo view('professores/index', $data);
        echo view('templates/footer');
    }

    public function novo()
    {
        echo view('templates/header');
        echo view('professores/novo');
        echo view('templates/footer');
    }

    public function editar($id_professor)
    {
        $professor = $this->professor_model->find($id_professor);

        if (!$professor) {
            return redirect()->to(base_url('professores'));
        }

        $data['professor'] = $professor;
        
        echo view('templates/header');
        echo view('professores/editar', $data);
        echo view('templates/footer');
    }

    public function store()
    {
        $dados = $this->request->getPost(); // Uso do getPost por segurança

        // Verificando se é atualização ou novo cadastro
        if (isset($dados['id_professor']) && !empty($dados['id_professor'])) {
            $this->professor_model->update($dados['id_professor'], $dados);
            session()->setFlashdata('alert', 'success_update');
            return redirect()->to(base_url("professores/editar/{$dados['id_professor']}"));
        }

        // Novo cadastro
        $this->professor_model->insert($dados);
        session()->setFlashdata('alert', 'success_create');

        return redirect()->to(base_url('professores'));
    }

    public function excluir()
    {
        $id_professor = $this->request->getPost('id_professor');

        if ($id_professor) {
            $this->professor_model->delete($id_professor);
            session()->setFlashdata('alert', 'success_delete');
        }

        return redirect()->to(base_url('professores'));
    }

    public function ver($id_professor)
    {
        $data['professor'] = $this->professor_model->find($id_professor);

        echo view('templates/header');
        echo view('professores/ver', $data);
        echo view('templates/footer');
    }
}