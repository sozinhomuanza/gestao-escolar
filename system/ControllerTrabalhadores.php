<?php

namespace App\Controllers;

use App\Models\TrabalhadorModel;

class Trabalhadores extends BaseController
{
    private $trabalhador_model;

    public function __construct() {
        helper(['url', 'form']);
        $this->trabalhador_model = new TrabalhadorModel();
    }

    public function index() {
        $data['trabalhadores'] = $this->trabalhador_model->findAll();
        echo view('templates/header');
        echo view('trabalhadores/index', $data);
        echo view('templates/footer');
    }

    public function novo() {
        echo view('templates/header');
        echo view('trabalhadores/novo');
        echo view('templates/footer');
    }

    public function store() {
        $dados = $this->request->getPost();
        
        if (isset($dados['id_trabalhador']) && !empty($dados['id_trabalhador'])) {
            $this->trabalhador_model->update($dados['id_trabalhador'], $dados);
            session()->setFlashdata('alert', 'success_update');
        } else {
            $this->trabalhador_model->insert($dados);
            session()->setFlashdata('alert', 'success_create');
        }

        return redirect()->to(base_url('trabalhadores'));
    }

    public function excluir() {
        $id = $this->request->getPost('id_trabalhador');
        $this->trabalhador_model->delete($id);
        session()->setFlashdata('alert', 'success_delete');
        return redirect()->to(base_url('trabalhadores'));
    }
}