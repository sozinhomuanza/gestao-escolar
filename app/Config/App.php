<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class App extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Base Site URL
     * --------------------------------------------------------------------------
     */
    public string $baseURL = 'https://gestao-escolar-production.up.railway.app/';

    /**
     * --------------------------------------------------------------------------
     * Index File
     * --------------------------------------------------------------------------
     */
    public string $indexPage = '';

    /**
     * --------------------------------------------------------------------------
     * URI PROTOCOL
     * --------------------------------------------------------------------------
     */
    public string $uriProtocol = 'REQUEST_URI';

    /**
     * --------------------------------------------------------------------------
     * Default Locale / Timezone
     * --------------------------------------------------------------------------
     */
    public string $defaultLocale    = 'pt';
    public bool $negotiateLocale    = false;
    public array $supportedLocales  = ['pt', 'en'];
    public string $appTimezone      = 'Africa/Luanda';
    public string $charset          = 'UTF-8';

    /**
     * --------------------------------------------------------------------------
     * Global Secure Requests
     * --------------------------------------------------------------------------
     */
    public bool $forceGlobalSecureRequests = true;

    /**
     * --------------------------------------------------------------------------
     * Proxy IPs (O Ponto Crítico do Erro)
     * --------------------------------------------------------------------------
     */
    public string|array $proxyIPs = ''; // Railway usa proxies internos, deixar vazio ou '*' resolve o erro de undefined

    /**
     * --------------------------------------------------------------------------
     * Session Variables
     * --------------------------------------------------------------------------
     */
    public string $sessionDriver            = 'CodeIgniter\Session\Handlers\FileHandler';
    public string $sessionCookieName        = 'ci_session';
    public int $sessionExpiration           = 7200;
    public string $sessionSavePath          = WRITEPATH . 'session';
    public bool $sessionMatchIP             = false;
    public int $sessionTimeToUpdate         = 300;
    public bool $sessionRegenerateDestroy   = false;

    /**
     * --------------------------------------------------------------------------
     * Cookie Variables
     * --------------------------------------------------------------------------
     */
    public string $cookiePrefix   = '';
    public string $cookieDomain   = '';
    public string $cookiePath     = '/';
    public bool $cookieSecure     = true;
    public bool $cookieHTTPOnly   = true;
    public string $cookieSameSite = 'Lax';

    /**
     * --------------------------------------------------------------------------
     * CSRF Keep Alive
     * --------------------------------------------------------------------------
     */
    public string $CSRFTokenName   = 'csrf_test_name';
    public string $CSRFHeaderName  = 'X-CSRF-TOKEN';
    public string $CSRFCookieName  = 'csrf_cookie_name';
    public int $CSRFExpire         = 7200;
    public bool $CSRFRegenerate    = true;
    public bool $CSRFRedirect      = true;
    public string $CSRFSameSite   = 'Lax';

    /**
     * --------------------------------------------------------------------------
     * Content Security Policy
     * --------------------------------------------------------------------------
     */
    public bool $CSPEnabled = false;
}
