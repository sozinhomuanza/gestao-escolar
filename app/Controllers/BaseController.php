<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

abstract class BaseController extends Controller
{
    protected $request;
    
    /**
     * Helpers carregados automaticamente.
     */
    protected $helpers = ['url', 'form', 'session', 'text'];

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Não remova esta linha
        parent::initController($request, $response, $logger);
    }

    /**
     * Normaliza o perfil do usuário para chaves simplificadas.
     * Mantenha como PROTECTED para que os filhos possam usar se necessário, 
     * ou PRIVATE se apenas o BaseController for usar.
     */
    protected function perfilNormalizado(): string
    {
        $perfilSessao = trim(session()->get('perfil') ?? '');
        $perfilSessao = mb_strtolower($perfilSessao, 'UTF-8');

        $mapa = [
            'administrador' => 'admin',
            'admin'         => 'admin',
            'director'      => 'director',
            'directora'     => 'director',
            'diretor'       => 'director',
            'diretora'      => 'director',
            'secretario'    => 'secretario',
            'secretária'    => 'secretario',
            'secretaria'    => 'secretario',
            'professor'     => 'professor',
            'professora'    => 'professor',
        ];

        $perfilMapeado = $mapa[$perfilSessao] ?? $perfilSessao;
        return (string)$perfilMapeado;
    }

    /**
     * Protege o acesso às rotas.
     * @param array $niveisPermitidos Ex: ['admin', 'professor']
     */
    protected function proteger(array $niveisPermitidos = [])
    {
        // 1. Verifica se está logado
        if (!session()->get('logado')) {
            // Redirecionamento limpo usando o framework
            header("Location: " . base_url('login'));
            exit;
        }

        // 2. Verifica permissão de nível
        if (!empty($niveisPermitidos)) {
            $perfilAtual = $this->perfilNormalizado();
            
            // Normaliza os níveis passados para garantir comparação correta
            $permitidos = array_map('strtolower', $niveisPermitidos);

            // Se o perfil 'admin' estiver na lista, incluímos também o mapeamento 'administrador'
            if (in_array('admin', $permitidos) && !in_array('administrador', $permitidos)) {
                $permitidos[] = 'administrador';
            }

            if (!in_array($perfilAtual, $permitidos)) {
                session()->setFlashdata('erro', 'Acesso negado: o seu perfil não tem permissão para esta acção.');
                header("Location: " . base_url('inicio'));
                exit;
            }
        }
    }

    // ─────────────────────────────────────────────────────────
    // MÉTODOS DE VERIFICAÇÃO RÁPIDA
    // ─────────────────────────────────────────────────────────

    protected function isAdmin(): bool
    {
        return $this->perfilNormalizado() === 'admin';
    }

    protected function isDirector(): bool
    {
        return $this->perfilNormalizado() === 'director';
    }

    protected function isProfessor(): bool
    {
        return $this->perfilNormalizado() === 'professor';
    }

    protected function isSecretario(): bool
    {
        return $this->perfilNormalizado() === 'secretario';
    }

    /** Verifica se pertence a qualquer um dos grupos de gestão */
    protected function isGestao(): bool
    {
        return in_array($this->perfilNormalizado(), ['admin', 'director', 'secretario']);
    }

    protected function getPerfil(): string
    {
        return $this->perfilNormalizado();
    }
}