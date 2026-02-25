<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        
        // Verifica se o usuário está logado
        if (!$session->get('logado')) {
            return redirect()->to(base_url('login'))
                ->with('alert', 'login_necessario');
        }
        
        // Verifica o nível de acesso (se argumentos foram passados)
        if (!empty($arguments)) {
            $nivel = $session->get('nivel');
            
            // Converte argumentos para array e normaliza para minúsculo
            $niveisPermitidos = array_map('strtolower', $arguments);
            
            if (!in_array($nivel, $niveisPermitidos)) {
                return redirect()->to(base_url('inicio'))
                    ->with('alert', 'acesso_negado');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Não faz nada após a requisição
    }
}