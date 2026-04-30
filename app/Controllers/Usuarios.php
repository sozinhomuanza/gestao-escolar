<?php
namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Models\LocalizacaoModel;

class Usuarios extends BaseController
{
    private $usuario_model;
    private $locModel;

    public function __construct()
    {
        helper(['url', 'form', 'filesystem']); 
        $this->usuario_model = new UsuarioModel();
        $this->locModel      = new LocalizacaoModel();
    }

    private function exibir($view, $data = []) 
    {
        return view('templates/header', $data)
             . view('templates/sidebar')
             . view($view, $data)
             . view('templates/footer');
    }

    private function verificarAdmin()
    {
        if (!session()->get('logado')) {
            return redirect()->to(base_url('login'));
        }
        if (strtolower(session()->get('perfil')) !== 'administrador') {
            session()->setFlashdata('erro', 'Acesso negado. Apenas administradores podem gerir utilizadores.');
            return redirect()->to(base_url('inicio'));
        }
        return null;
    }

    private function uploadFoto($file, $fotoAntiga = null)
    {
        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Remove a foto antiga se existir e não for a padrão
            if ($fotoAntiga && $fotoAntiga !== 'default.png') {
                $caminhoAntigo = FCPATH . 'uploads/usuarios/' . $fotoAntiga;
                if (file_exists($caminhoAntigo)) {
                    unlink($caminhoAntigo);
                }
            }

            $novoNome = $file->getRandomName();
            $file->move(FCPATH . 'uploads/usuarios', $novoNome);
            return $novoNome;
        }
        // Se não houve upload novo, mantém a foto que já existia
        return $fotoAntiga ?: 'default.png';
    }

    public function index()
    {
        if ($redir = $this->verificarAdmin()) return $redir;

        $data['usuarios']      = $this->usuario_model->findAll();
        $data['titulo_pagina'] = 'Gestão de Utilizadores';

        return $this->exibir('usuarios/index', $data);
    }

    public function novo()
    {
        if ($redir = $this->verificarAdmin()) return $redir;

        $data['titulo_pagina'] = 'Registar Novo Utilizador';
        $data['provincias']    = $this->locModel->getProvincias();
        
        return $this->exibir('usuarios/novo', $data);
    }

    public function store()
    {
        if ($redir = $this->verificarAdmin()) return $redir;

        $dados = $this->request->getPost();
        $file  = $this->request->getFile('foto');

        if ($this->usuario_model->where('username', $dados['username'])->first()) {
            return redirect()->back()->withInput()->with('erro', 'Este nome de utilizador já está em uso.');
        }

        if ($this->usuario_model->where('email', $dados['email'])->first()) {
            return redirect()->back()->withInput()->with('erro', 'Este email já está registado.');
        }

        if (strlen($dados['senha']) < 6) {
            return redirect()->back()->withInput()->with('erro', 'A senha deve ter pelo menos 6 caracteres.');
        }

        $nomeFoto = $this->uploadFoto($file);

        $this->usuario_model->insert([
            'nome'         => $dados['nome'],
            'email'        => $dados['email'],
            'username'     => $dados['username'],
            'senha'        => password_hash($dados['senha'], PASSWORD_DEFAULT),
            'perfil'       => $dados['perfil'],
            'foto'         => $nomeFoto,
            'ativo'        => 1,
            'id_provincia' => $dados['id_provincia'] ?? null,
            'id_municipio' => $dados['id_municipio'] ?? null,
            'id_comuna'    => $dados['id_comuna']    ?? null,
        ]);

        return redirect()->to(base_url('usuarios'))->with('sucesso', 'Utilizador criado com sucesso!');
    }

    public function editar($id)
    {
        if ($redir = $this->verificarAdmin()) return $redir;

        $usuario = $this->usuario_model->find($id);

        if (!$usuario) {
            return redirect()->to(base_url('usuarios'))->with('erro', 'Utilizador não encontrado.');
        }

        $data['usuario']       = $usuario;
        $data['titulo_pagina'] = 'Editar Utilizador';
        $data['provincias']    = $this->locModel->getProvincias();

        return $this->exibir('usuarios/editar', $data);
    }

    public function update()
    {
        if ($redir = $this->verificarAdmin()) return $redir;

        $dados = $this->request->getPost();
        $id    = $dados['id_usuario'];
        $file  = $this->request->getFile('foto');
        
        $usuarioAtual = $this->usuario_model->find($id);

        $atualizar = [
            'nome'         => $dados['nome'],
            'email'        => $dados['email'],
            'perfil'       => $dados['perfil'],
            'ativo'        => $dados['ativo'] ?? 1,
            'id_provincia' => $dados['id_provincia'] ?? $usuarioAtual['id_provincia'],
            'id_municipio' => $dados['id_municipio'] ?? $usuarioAtual['id_municipio'],
            'id_comuna'    => $dados['id_comuna']    ?? $usuarioAtual['id_comuna'],
        ];

        // Processamento da Foto: Se não enviar nova foto, mantém explicitamente a antiga
        if ($file && $file->isValid()) {
            $atualizar['foto'] = $this->uploadFoto($file, $usuarioAtual['foto']);
        } else {
            $atualizar['foto'] = $usuarioAtual['foto'];
        }

        // Se o administrador estiver a editar a própria conta, atualiza a sessão imediatamente
        if ($id == session()->get('id_usuario')) {
            session()->set('nome', $atualizar['nome']);
            session()->set('foto', $atualizar['foto']);
            session()->set('perfil', $atualizar['perfil']);
        }

        if (!empty($dados['nova_senha'])) {
            if (strlen($dados['nova_senha']) < 6) {
                return redirect()->back()->with('erro', 'A nova senha deve ter pelo menos 6 caracteres.');
            }
            $atualizar['senha'] = password_hash($dados['nova_senha'], PASSWORD_DEFAULT);
        }

        $this->usuario_model->update($id, $atualizar);
        return redirect()->to(base_url('usuarios'))->with('sucesso', 'Utilizador atualizado com sucesso!');
    }

    public function excluir()
    {
        if ($redir = $this->verificarAdmin()) return $redir;

        $id = $this->request->getPost('id_usuario');
        $usuario = $this->usuario_model->find($id);

        if ($id == session()->get('id_usuario')) {
            return redirect()->to(base_url('usuarios'))->with('erro', 'Não pode excluir a sua própria conta.');
        }

        if ($usuario['foto'] && $usuario['foto'] !== 'default.png') {
            $caminho = FCPATH . 'uploads/usuarios/' . $usuario['foto'];
            if (file_exists($caminho)) unlink($caminho);
        }

        $this->usuario_model->delete($id);
        return redirect()->to(base_url('usuarios'))->with('sucesso', 'Utilizador removido.');
    }

    public function toggleAtivo()
    {
        if ($redir = $this->verificarAdmin()) return $redir;

        $id      = $this->request->getPost('id_usuario');
        $usuario = $this->usuario_model->find($id);

        if ($usuario) {
            $novo_estado = $usuario['ativo'] ? 0 : 1;
            $this->usuario_model->update($id, ['ativo' => $novo_estado]);
            $msg = $novo_estado ? 'Utilizador ativado.' : 'Utilizador desativado.';
            return redirect()->to(base_url('usuarios'))->with('sucesso', $msg);
        }

        return redirect()->to(base_url('usuarios'));
    }
}