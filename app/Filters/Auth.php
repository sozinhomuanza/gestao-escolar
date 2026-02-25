<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // 1. Verifica se a chave 'logado' existe na sessão
        if (!$session->get('logado')) {
            // Redireciona de forma limpa sem disparar alertas JS
            return redirect()->to(base_url('login'));
        }

        // 2. Verifica nível de acesso apenas se houver argumentos definidos no Filters.php
        if ($arguments) {
            $nivelUsuario = strtolower($session->get('nivel') ?? '');
            
            // Converte todos os argumentos permitidos para minúsculo para evitar erros de digitação
            $permitidos = array_map('strtolower', $arguments);

            if (!in_array($nivelUsuario, $permitidos)) {
                // Se não tiver permissão, volta para o início com uma mensagem flash
                return redirect()->to(base_url('inicio'))->with('alert', 'sem_permissao');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Não é necessário implementar lógica aqui para este filtro
    }
}