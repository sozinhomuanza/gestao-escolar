<?php

namespace App\Controllers;

use App\Models\TrabalhadorModel;
use App\Models\LocalizacaoModel;

class Trabalhadores extends BaseController
{
    private $trabalhador_model;
    private $locModel;

    public function __construct()
    {
        helper(['url', 'form']);
        $this->trabalhador_model = new TrabalhadorModel();
        $this->locModel          = new LocalizacaoModel();
    }

    private function exibir($view, $data = []) 
    {
        return view('templates/header', $data)
             . view('templates/sidebar')
             . view($view, $data)
             . view('templates/footer');
    }

    // Listagem Geral com Join de Localização
    public function index()
    {
        if (!session()->get('logado')) return redirect()->to(base_url('login'));

        $busca = $this->request->getGet('busca');

        // Usando Query Builder para trazer nomes em vez de IDs
        $query = $this->trabalhador_model->select('trabalhadores.*, p.nome as provincia_nome, m.nome as municipio_nome')
            ->join('provincias p', 'p.id_provincia = trabalhadores.id_provincia', 'left')
            ->join('municipios m', 'm.id_municipio = trabalhadores.id_municipio', 'left');

        if ($busca) {
            $query->like('trabalhadores.nome', $busca);
        }

        $data['trabalhadores'] = $query->findAll();
        $data['busca']         = $busca;
        $data['titulo_pagina'] = 'Lista de Trabalhadores';

        return $this->exibir('trabalhadores/index', $data);
    }

    // Listagem Filtrada: Professores
    public function professores()
    {
        if (!session()->get('logado')) return redirect()->to(base_url('login'));

        $busca = $this->request->getGet('busca');

        $query = $this->trabalhador_model->select('trabalhadores.*, p.nome as provincia_nome, m.nome as municipio_nome')
            ->join('provincias p', 'p.id_provincia = trabalhadores.id_provincia', 'left')
            ->join('municipios m', 'm.id_municipio = trabalhadores.id_municipio', 'left')
            ->groupStart()
                ->where('funcao', 'Professor')
                ->orWhere('funcao', 'Professora')
            ->groupEnd();

        if ($busca) { $query->like('trabalhadores.nome', $busca); }

        $data['trabalhadores'] = $query->findAll();
        $data['busca']         = $busca;
        $data['titulo_pagina'] = 'Lista de Professores';

        return $this->exibir('trabalhadores/index', $data);
    }

    // Listagem Filtrada: Secretários
    public function secretarios()
    {
        if (!session()->get('logado')) return redirect()->to(base_url('login'));

        $busca = $this->request->getGet('busca');

        $query = $this->trabalhador_model->select('trabalhadores.*, p.nome as provincia_nome, m.nome as municipio_nome')
            ->join('provincias p', 'p.id_provincia = trabalhadores.id_provincia', 'left')
            ->join('municipios m', 'm.id_municipio = trabalhadores.id_municipio', 'left')
            ->groupStart()
                ->where('funcao', 'Secretário')
                ->orWhere('funcao', 'Secretária')
            ->groupEnd();

        if ($busca) { $query->like('trabalhadores.nome', $busca); }

        $data['trabalhadores'] = $query->findAll();
        $data['busca']         = $busca;
        $data['titulo_pagina'] = 'Lista de Secretários';

        return $this->exibir('trabalhadores/index', $data);
    }

    public function novo()
    {
        if (!session()->get('logado')) return redirect()->to(base_url('login'));

        $data['titulo_pagina'] = 'Novo Trabalhador';
        $data['provincias']    = $this->locModel->getProvincias();
        $data['id_provincia']  = '';
        $data['id_municipio']  = '';
        $data['id_comuna']     = '';

        return $this->exibir('trabalhadores/novo', $data);
    }

    public function editar($id)
    {
        if (!session()->get('logado')) return redirect()->to(base_url('login'));

        $trabalhador = $this->trabalhador_model->find($id);

        if (!$trabalhador) {
            return redirect()->to(base_url('trabalhadores'))->with('error', 'Funcionário não encontrado.');
        }

        $data['t']             = $trabalhador;
        $data['titulo_pagina'] = 'Editar Trabalhador';
        $data['provincias']    = $this->locModel->getProvincias();
        $data['id_provincia']  = $trabalhador['id_provincia'] ?? '';
        $data['id_municipio']  = $trabalhador['id_municipio'] ?? '';
        $data['id_comuna']     = $trabalhador['id_comuna']    ?? '';

        return $this->exibir('trabalhadores/editar', $data);
    }

    public function store()
    {
        if (!session()->get('logado')) return redirect()->to(base_url('login'));

        $id = $this->request->getPost('id_trabalhador');

        $dados = [
            'nome'          => $this->request->getPost('nome'),
            'funcao'        => $this->request->getPost('funcao'),
            'telefone'      => $this->request->getPost('telefone'),
            'email'         => $this->request->getPost('email'),
            'data_admissao' => $this->request->getPost('data_admissao'),
            'id_provincia'  => $this->request->getPost('id_provincia') ?: null,
            'id_municipio'  => $this->request->getPost('id_municipio') ?: null,
            'id_comuna'     => $this->request->getPost('id_comuna')    ?: null,
        ];

        // Processamento de Uploads (BI e Certificado)
        $arquivos = [
            'doc_bi'          => $this->request->getFile('doc_bi'),
            'doc_certificado' => $this->request->getFile('doc_certificado')
        ];

        foreach ($arquivos as $campo => $file) {
            if ($file && $file->isValid() && !$file->hasMoved()) {
                if ($id) {
                    $atual = $this->trabalhador_model->find($id);
                    if (!empty($atual[$campo])) {
                        $caminhoAntigo = FCPATH . 'uploads/documentos/' . $atual[$campo];
                        if (file_exists($caminhoAntigo)) @unlink($caminhoAntigo);
                    }
                }
                
                $novoNome = $file->getRandomName();
                $file->move(FCPATH . 'uploads/documentos', $novoNome);
                $dados[$campo] = $novoNome;
            }
        }

        // Salvar ou Atualizar
        $resultado = $id ? $this->trabalhador_model->update($id, $dados) : $this->trabalhador_model->insert($dados);

        if ($resultado) {
            return redirect()->to(base_url('trabalhadores'))->with('success', 'Operação realizada com sucesso!');
        } else {
            return redirect()->back()->withInput()->with('errors', $this->trabalhador_model->errors());
        }
    }

    public function excluir()
    {
        if (!session()->get('logado')) return redirect()->to(base_url('login'));

        $id          = $this->request->getPost('id_trabalhador');
        $trabalhador = $this->trabalhador_model->find($id);

        if ($trabalhador) {
            foreach (['doc_bi', 'doc_certificado'] as $campo) {
                if (!empty($trabalhador[$campo])) {
                    $caminho = FCPATH . 'uploads/documentos/' . $trabalhador[$campo];
                    if (file_exists($caminho)) @unlink($caminho);
                }
            }
            $this->trabalhador_model->delete($id);
        }

        return redirect()->to(base_url('trabalhadores'))->with('success', 'Trabalhador removido.');
    }
}