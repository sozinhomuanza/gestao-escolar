<?php

namespace App\Controllers;

use App\Models\SecretariosModel;

class Secretarios extends BaseController
{
    private $secretario_model;

    public function __construct()
    {
        $this->secretario_model = new SecretariosModel();
    }

    public function index()
    {
        $data['secretarios'] = $this->secretario_model->findAll();

        echo view('templates/header');
        echo view('secretarios/index', $data);
        echo view('templates/footer');
    }

    public function novo()
    {
        echo view('templates/header');
        echo view('secretarios/novo');
        echo view('templates/footer');
    }

    public function editar($id_secretario)
    {
        $secretario = $this->secretario_model->find($id_secretario);

        if (!$secretario) {
            return redirect()->to(base_url('secretarios'));
        }

        $data['secretario'] = $secretario;
        
        echo view('templates/header');
        echo view('secretarios/editar', $data);
        echo view('templates/footer');
    }

    public function store()
    {
        $dados = $this->request->getPost(); // getPost é mais seguro para formulários

        // Se houver ID, atualiza. Se não, insere.
        if (isset($dados['id_secretario']) && !empty($dados['id_secretario'])) {
            $this->secretario_model->update($dados['id_secretario'], $dados);
            session()->setFlashdata('alert', 'success_update');
        } else {
            $this->secretario_model->insert($dados);
            session()->setFlashdata('alert', 'success_create');
        }

        return redirect()->to(base_url('secretarios'));
    }

    public function excluir()
    {
        $id_secretario = $this->request->getPost('id_secretario');

        if ($id_secretario) {
            $this->secretario_model->delete($id_secretario);
            session()->setFlashdata('alert', 'success_delete');
        }

        return redirect()->to(base_url('secretarios'));
    }

    public function ver($id_secretario)
    {
        $data['secretario'] = $this->secretario_model->find($id_secretario);

        echo view('templates/header');
        echo view('secretarios/ver', $data);
        echo view('templates/footer');
    }
}