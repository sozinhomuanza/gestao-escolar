<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class Login extends BaseController
{
    private $usuario_model;

    public function __construct()
    {
        $this->usuario_model = new UsuarioModel();
    }

    /**
     * Página de Login
     */
    public function index()
    {
        if (session()->get('logado')) {
            return redirect()->to(base_url('inicio'));
        }

        echo view('login/index');
    }

    /**
     * Processa o formulário de login
     */
    public function autenticar()
    {
        $username = $this->request->getPost('username');
        $senha    = $this->request->getPost('senha');

        if (empty($username) || empty($senha)) {
            session()->setFlashdata('erro', 'Por favor, preencha todos os campos.');
            return redirect()->to(base_url('login'));
        }

        // Busca pelo username OU email
        $usuario = $this->usuario_model
            ->groupStart()
                ->where('username', $username)
                ->orWhere('email', $username)
            ->groupEnd()
            ->where('ativo', 1)
            ->first();

        if (!$usuario) {
            session()->setFlashdata('erro', 'Utilizador não encontrado ou conta desativada.');
            return redirect()->to(base_url('login'));
        }

        if (!password_verify($senha, $usuario['senha'])) {
            session()->setFlashdata('erro', 'Senha incorreta. Tente novamente.');
            return redirect()->to(base_url('login'));
        }

        // Regista o último acesso
        $this->usuario_model->update($usuario['id_usuario'], [
            'ultimo_acesso' => date('Y-m-d H:i:s')
        ]);

        // ── Sessão ────────────────────────────────────────────────────────
        $partes_nome = explode(' ', trim($usuario['nome']));
        session()->set([
            'logado'        => true,
            'id_usuario'    => $usuario['id_usuario'],
            'nome_usuario'  => $usuario['nome'],
            'primeiro_nome' => $partes_nome[0],
            'perfil'        => $usuario['perfil'],   // ex: "Professor", "Administrador"
            'email_usuario' => $usuario['email'],    // usado para ligar ao trabalhador
        ]);

        return redirect()->to(base_url('inicio'));
    }

    /**
     * Logout
     */
    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }

    /**
     * Formulário para trocar senha
     */
    public function trocarSenha()
    {
        if (!session()->get('logado')) {
            return redirect()->to(base_url('login'));
        }

        echo view('templates/header');
        echo view('templates/sidebar');
        echo view('login/trocar_senha');
        echo view('templates/footer');
    }

    /**
     * Salva a nova senha
     */
    public function storeSenha()
    {
        if (!session()->get('logado')) {
            return redirect()->to(base_url('login'));
        }

        $id_usuario  = session()->get('id_usuario');
        $senha_atual = $this->request->getPost('senha_atual');
        $nova_senha  = $this->request->getPost('nova_senha');
        $confirmar   = $this->request->getPost('confirmar_senha');

        $usuario = $this->usuario_model->find($id_usuario);

        if (!password_verify($senha_atual, $usuario['senha'])) {
            session()->setFlashdata('erro', 'A senha atual está incorreta.');
            return redirect()->to(base_url('login/trocarsenha'));
        }

        if ($nova_senha !== $confirmar) {
            session()->setFlashdata('erro', 'A nova senha e a confirmação não coincidem.');
            return redirect()->to(base_url('login/trocarsenha'));
        }

        if (strlen($nova_senha) < 6) {
            session()->setFlashdata('erro', 'A nova senha deve ter pelo menos 6 caracteres.');
            return redirect()->to(base_url('login/trocarsenha'));
        }

        $this->usuario_model->update($id_usuario, [
            'senha' => password_hash($nova_senha, PASSWORD_DEFAULT)
        ]);

        session()->setFlashdata('sucesso', 'Senha alterada com sucesso!');
        return redirect()->to(base_url('inicio'));
    }
}