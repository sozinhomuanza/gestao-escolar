<?php
// Ficheiro: app/Controllers/Salas.php
namespace App\Controllers;
use App\Models\SalaModel;

class Salas extends BaseController {
    private $sala_model;

    public function __construct() {
        helper(['url', 'form']);
        $this->sala_model = new SalaModel();
        if (!session()->get('logado')) return redirect()->to(base_url('login'));
    }

    public function index() {
        $data['salas'] = $this->sala_model->findAll();
        echo view('templates/header');
        echo view('templates/sidebar');
        echo view('salas/index', $data);
        echo view('templates/footer');
    }

    public function novo() {
        echo view('templates/header');
        echo view('templates/sidebar');
        echo view('salas/novo');
        echo view('templates/footer');
    }

    public function store() {
        $dados = $this->request->getPost();
        if (!empty($dados['id_sala'])) {
            $this->sala_model->update($dados['id_sala'], $dados);
            session()->setFlashdata('sucesso', 'Sala atualizada!');
        } else {
            $this->sala_model->insert($dados);
            session()->setFlashdata('sucesso', 'Sala criada com sucesso!');
        }
        return redirect()->to(base_url('salas'));
    }

    public function editar($id) {
        $data['sala'] = $this->sala_model->find($id);
        if (!$data['sala']) return redirect()->to(base_url('salas'));
        echo view('templates/header');
        echo view('templates/sidebar');
        echo view('salas/editar', $data);
        echo view('templates/footer');
    }

    public function excluir() {
        $id = $this->request->getPost('id_sala');
        if ($id) { $this->sala_model->delete($id); session()->setFlashdata('sucesso', 'Sala removida.'); }
        return redirect()->to(base_url('salas'));
    }
}
