<?php

namespace Config;

use CodeIgniter\Database\Config;

/**
 * Database Configuration
 */
class Database extends Config
{
    public $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;
    public $defaultGroup = 'default';

    /**
     * Configuração ajustada para Railway e Localhost
     */
    public $default = [
        'DSN'      => '',
        'hostname' => 'localhost',
        'username' => '',
        'password' => '',
        'database' => 'escola',
        'DBDriver' => 'MySQLi',
        'DBPrefix' => '',
        'pConnect' => false,
        'DBDebug'  => true, // Ativado para ajudar a ver erros de conexão agora
        'charset'  => 'utf8',
        'DBCollat' => 'utf8_general_ci',
        'swapPre'  => '',
        'encrypt'  => false,
        'compress' => false,
        'strictOn' => false,
        'failover' => [],
        'port'     => 3306,
    ];

    public $tests = [
        'DSN'      => '',
        'hostname' => '127.0.0.1',
        'username' => '',
        'password' => '',
        'database' => ':memory:',
        'DBDriver' => 'SQLite3',
        'DBPrefix' => 'db_',
        'pConnect' => false,
        'DBDebug'  => true,
        'charset'  => 'utf8',
        'DBCollat' => 'utf8_general_ci',
        'swapPre'  => '',
        'encrypt'  => false,
        'compress' => false,
        'strictOn' => false,
        'failover' => [],
        'port'     => 3306,
    ];

    public function __construct()
    {
        parent::__construct();

        if (ENVIRONMENT === 'testing') {
            $this->defaultGroup = 'tests';
        }

        /**
         * INTEGRAÇÃO DINÂMICA COM RAILWAY
         * Tenta ler as variáveis automáticas do Railway. 
         * Se não existirem, mantém o padrão acima.
         */
        if (getenv('MYSQLHOST')) {
            $this->default['hostname'] = getenv('MYSQLHOST');
            $this->default['username'] = getenv('MYSQLUSER');
            $this->default['password'] = getenv('MYSQLPASSWORD');
            $this->default['database'] = getenv('MYSQLDATABASE');
            $this->default['port']     = getenv('MYSQLPORT') ?: 3306;
        }
    }
}
