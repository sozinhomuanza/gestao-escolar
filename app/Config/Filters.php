<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;

class Filters extends BaseConfig
{
    /**
     * Aliases para os filtros.
     */
    public $aliases = [
        'csrf'     => CSRF::class,
        'toolbar'  => DebugToolbar::class,
        'honeypot' => Honeypot::class,
        'auth'     => \App\Filters\Auth::class, 
    ];

    /**
     * Configurações globais (aplicadas a todas as requisições).
     */
    public $globals = [
        'before' => [
            // 'csrf',
        ],
        'after' => [
            'toolbar',
            // 'honeypot',
        ],
    ];

    /**
     * Filtros baseados em métodos HTTP (GET, POST, etc).
     */
    public $methods = [];

    /**
     * FILTROS ESPECÍFICOS POR ROTA
     * Aqui é onde a mágica acontece.
     */
    
    public $filters = [
        'auth' => [
            'before' => [
                'inicio*',      // Protege a home
                'usuarios*',    // Protege o gerenciamento de usuários
                'admin/*',      // Protege qualquer rota que comece com admin/
                'professor/*',  // Protege qualquer rota que comece com professor/
                'secretario/*', // Protege qualquer rota que comece com secretario/
            ]
        ],
    ];
}