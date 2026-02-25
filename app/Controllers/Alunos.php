<?php

namespace App\Controllers;

use App\Models\AlunosModel;
use App\Models\TurmaModel;
use App\Models\LocalizacaoModel;

class Alunos extends BaseController
{
    protected $aluno_model;
    protected $locModel;

    public function __construct()
    {
        helper(['url', 'form']);
        $this->aluno_model = new AlunosModel();
        $this->locModel    = new LocalizacaoModel();
    }

    public function index()
    {
        $id_turma = $this->request->getGet('turma');
        $turmaModel = new TurmaModel();

        $data['alunos'] = $this->aluno_model->getAlunosComLocalizacao($id_turma);
        $data['turma_selecionada'] = $id_turma;
        $data['turmas']            = $turmaModel->findAll();
        $data['titulo_pagina']     = 'Lista de Alunos';

        return view('templates/header', $data)
             . view('templates/sidebar')
             . view('alunos/index', $data)
             . view('templates/footer');
    }

    /**
     * Exibir o formulário de cadastro de novo aluno
     */
    public function novo()
    {
        $turmaModel = new TurmaModel();

        $data['titulo_pagina'] = 'Registar Novo Aluno';
        $data['turmas']        = $turmaModel->findAll();

        // Dados para o Widget de Localização
        $data['provincias']    = $this->locModel->getProvincias();
        $data['id_provincia']  = '';
        $data['id_municipio']  = '';
        $data['id_comuna']     = '';

        return view('templates/header', $data)
             . view('templates/sidebar')
             . view('alunos/novo', $data)
             . view('templates/footer');
    }

    public function store()
    {
        // Captura todos os campos (incluindo bi, naturalidade e provincia_natural)
        $dados = $this->request->getPost();

        if ($this->aluno_model->save($dados)) {
            return redirect()->to('/alunos')->with('success', 'Aluno cadastrado com sucesso!');
        } else {
            return redirect()->back()->withInput()->with('errors', $this->aluno_model->errors());
        }
    }

    public function editar($id)
    {
        $aluno = $this->aluno_model->find($id);

        if (!$aluno) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Aluno não encontrado.");
        }

        $turmaModel = new TurmaModel();

        $data['aluno']         = $aluno;
        $data['turmas']        = $turmaModel->findAll();
        $data['titulo_pagina'] = 'Editar Aluno';

        // Localização para edição
        $data['provincias']    = $this->locModel->getProvincias();
        $data['id_provincia']  = $aluno['id_provincia'] ?? '';
        $data['id_municipio']  = $aluno['id_municipio'] ?? '';
        $data['id_comuna']     = $aluno['id_comuna']    ?? '';

        return view('templates/header', $data)
             . view('templates/sidebar')
             . view('alunos/editar', $data)
             . view('templates/footer');
    }

    public function update()
    {
        $id = $this->request->getPost('id_aluno');
        
        // Captura todos os inputs do formulário de edição
        $dados = $this->request->getPost();

        // Removemos o ID do array de dados para evitar conflito no update
        unset($dados['id_aluno']);

        if ($this->aluno_model->update($id, $dados)) {
            return redirect()->to('/alunos')->with('success', 'Dados de ' . $dados['nome'] . ' atualizados com sucesso!');
        } else {
            return redirect()->back()->withInput()->with('errors', $this->aluno_model->errors());
        }
    }

    public function excluir()
    {
        $id = $this->request->getPost('id_aluno');
        if ($id && $this->aluno_model->delete($id)) {
            return redirect()->to('/alunos')->with('success', 'Aluno removido com sucesso.');
        }
        return redirect()->to('/alunos')->with('error', 'Erro ao tentar remover o registro.');
    }
}