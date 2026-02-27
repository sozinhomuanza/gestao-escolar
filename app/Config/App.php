<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class App extends BaseConfig
{
    // A baseURL vazia permite que o CodeIgniter tente detectá-la sozinho
    // Mas no Railway, é mais seguro usar a variável de ambiente ou o domínio fixo
    public $baseURL = 'https://gestao-escolar-production.up.railway.app/';

    public $indexPage = '';

    public $uriProtocol = 'REQUEST_URI';

    public $defaultLocale = 'pt';

    public $negotiateLocale = false;

    public $supportedLocales = ['pt', 'en'];

    public $appTimezone = 'America/Sao_Paulo';

    public $charset = 'UTF-8';

    // Importante: Deixe em false no Railway para evitar loops com o proxy deles
    public $forceGlobalSecureRequests = false;

    /**
     * Reverse Proxy IPs
     * * O Railway usa a rede 100.64.0.0/10. Definir isso aqui elimina 
     * o Warning de $proxyIPs nos seus logs.
     */
    public $proxyIPs = '100.64.0.0/10';

    // --- Configurações de Sessão ---
    public $sessionDriver            = 'CodeIgniter\Session\Handlers\FileHandler';
    public $sessionCookieName        = 'ci_session';
    public $sessionExpiration        = 7200;
    public $sessionSavePath          = WRITEPATH . 'session';
    public $sessionMatchIP           = false;
    public $sessionTimeToUpdate      = 300;
    public $sessionRegenerateDestroy = false;

    // --- Configurações de Cookie ---
    public $cookiePrefix   = '';
    public $cookieDomain   = '';
    public $cookiePath     = '/';
    public $cookieSecure   = false;
    public $cookieHTTPOnly = true;
    public $cookieSameSite = 'Lax';

    // --- CSRF (Segurança) ---
    public $CSRFTokenName   = 'csrf_test_name';
    public $CSRFHeaderName  = 'X-CSRF-TOKEN';
    public $CSRFCookieName  = 'csrf_cookie_name';
    public $CSRFExpire      = 7200;
    public $CSRFRegenerate  = true;
    public $CSRFRedirect    = true;
    public $CSRFSameSite    = 'Lax';

    public $CSPEnabled = false;
}
