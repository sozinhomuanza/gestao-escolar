<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class App extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Base Site URL
     * --------------------------------------------------------------------------
     * Detecta automaticamente a URL em produção (Railway) ou usa localhost em dev.
     */
    public $baseURL = '';

    /**
     * --------------------------------------------------------------------------
     * Index File
     * --------------------------------------------------------------------------
     */
    public $indexPage = '';

    /**
     * --------------------------------------------------------------------------
     * URI PROTOCOL
     * --------------------------------------------------------------------------
     */
    public $uriProtocol = 'REQUEST_URI';

    /**
     * --------------------------------------------------------------------------
     * Default Locale
     * --------------------------------------------------------------------------
     */
    public $defaultLocale = 'pt';

    /**
     * --------------------------------------------------------------------------
     * Negotiate Locale
     * --------------------------------------------------------------------------
     */
    public $negotiateLocale = false;

    /**
     * --------------------------------------------------------------------------
     * Supported Locales
     * --------------------------------------------------------------------------
     */
    public $supportedLocales = ['pt', 'en'];

    /**
     * --------------------------------------------------------------------------
     * Application Timezone
     * --------------------------------------------------------------------------
     */
    public $appTimezone = 'America/Sao_Paulo';

    /**
     * --------------------------------------------------------------------------
     * Default Character Set
     * --------------------------------------------------------------------------
     */
    public $charset = 'UTF-8';

    /**
     * --------------------------------------------------------------------------
     * Force Global Secure Requests
     * --------------------------------------------------------------------------
     * Em produção no Railway, o HTTPS é terminado no proxy deles.
     * Deixamos false para evitar loop de redirect.
     */
    public $forceGlobalSecureRequests = false;

    /**
     * --------------------------------------------------------------------------
     * Session Driver
     * --------------------------------------------------------------------------
     */
    public $sessionDriver = 'CodeIgniter\Session\Handlers\FileHandler';

    /**
     * --------------------------------------------------------------------------
     * Session Cookie Name
     * --------------------------------------------------------------------------
     */
    public $sessionCookieName = 'ci_session';

    /**
     * --------------------------------------------------------------------------
     * Session Expiration
     * --------------------------------------------------------------------------
     */
    public $sessionExpiration = 7200;

    /**
     * --------------------------------------------------------------------------
     * Session Save Path
     * --------------------------------------------------------------------------
     */
    public $sessionSavePath = WRITEPATH . 'session';

    /**
     * --------------------------------------------------------------------------
     * Session Match IP
     * --------------------------------------------------------------------------
     */
    public $sessionMatchIP = false;

    /**
     * --------------------------------------------------------------------------
     * Session Time to Update
     * --------------------------------------------------------------------------
     */
    public $sessionTimeToUpdate = 300;

    /**
     * --------------------------------------------------------------------------
     * Session Regenerate Destroy
     * --------------------------------------------------------------------------
     */
    public $sessionRegenerateDestroy = false;

    /**
     * --------------------------------------------------------------------------
     * Cookie Prefix
     * --------------------------------------------------------------------------
     * @deprecated use Config\Cookie::$prefix property instead.
     */
    public $cookiePrefix = '';

    /**
     * --------------------------------------------------------------------------
     * Cookie Domain
     * --------------------------------------------------------------------------
     * @deprecated use Config\Cookie::$domain property instead.
     */
    public $cookieDomain = '';

    /**
     * --------------------------------------------------------------------------
     * Cookie Path
     * --------------------------------------------------------------------------
     * @deprecated use Config\Cookie::$path property instead.
     */
    public $cookiePath = '/';

    /**
     * --------------------------------------------------------------------------
     * Cookie Secure
     * --------------------------------------------------------------------------
     * @deprecated use Config\Cookie::$secure property instead.
     */
    public $cookieSecure = false;

    /**
     * --------------------------------------------------------------------------
     * Cookie HttpOnly
     * --------------------------------------------------------------------------
     * @deprecated use Config\Cookie::$httponly property instead.
     */
    public $cookieHTTPOnly = true;

    /**
     * --------------------------------------------------------------------------
     * Cookie SameSite
     * --------------------------------------------------------------------------
     * @deprecated use Config\Cookie::$samesite property instead.
     */
    public $cookieSameSite = 'Lax';

    /**
     * --------------------------------------------------------------------------
     * Reverse Proxy IPs
     * --------------------------------------------------------------------------
     * Railway usa reverse proxy. A subnet 100.64.0.0/10 cobre os IPs internos
     * do Railway (100.64.x.x que aparecem nos seus logs).
     * Isto diz ao CodeIgniter para confiar nos headers X-Forwarded-For vindos
     * desses IPs, resolvendo o Warning de $proxyIPs.
     *
     * @var string|string[]
     */
    public $proxyIPs = '100.64.0.0/10';

    /**
     * --------------------------------------------------------------------------
     * CSRF Token Name
     * --------------------------------------------------------------------------
     * @deprecated Use `Config\Security` $tokenName instead.
     */
    public $CSRFTokenName = 'csrf_test_name';

    /**
     * --------------------------------------------------------------------------
     * CSRF Header Name
     * --------------------------------------------------------------------------
     * @deprecated Use `Config\Security` $headerName instead.
     */
    public $CSRFHeaderName = 'X-CSRF-TOKEN';

    /**
     * --------------------------------------------------------------------------
     * CSRF Cookie Name
     * --------------------------------------------------------------------------
     * @deprecated Use `Config\Security` $cookieName instead.
     */
    public $CSRFCookieName = 'csrf_cookie_name';

    /**
     * --------------------------------------------------------------------------
     * CSRF Expire
     * --------------------------------------------------------------------------
     * @deprecated Use `Config\Security` $expire instead.
     */
    public $CSRFExpire = 7200;

    /**
     * --------------------------------------------------------------------------
     * CSRF Regenerate
     * --------------------------------------------------------------------------
     * @deprecated Use `Config\Security` $regenerate instead.
     */
    public $CSRFRegenerate = true;

    /**
     * --------------------------------------------------------------------------
     * CSRF Redirect
     * --------------------------------------------------------------------------
     * @deprecated Use `Config\Security` $redirect instead.
     */
    public $CSRFRedirect = true;

    /**
     * --------------------------------------------------------------------------
     * CSRF SameSite
     * --------------------------------------------------------------------------
     * @deprecated Use `Config\Security` $samesite instead.
     */
    public $CSRFSameSite = 'Lax';

    /**
     * --------------------------------------------------------------------------
     * Content Security Policy
     * --------------------------------------------------------------------------
     */
    public $CSPEnabled = false;

    /**
     * --------------------------------------------------------------------------
     * Constructor - Configuração dinâmica para Railway
     * --------------------------------------------------------------------------
     * Detecta automaticamente a URL base e os IPs do proxy em tempo de execução.
     */
    public function __construct()
    {
        parent::__construct();

        // Define a baseURL dinamicamente
        // Em produção (Railway), usa a variável de ambiente RAILWAY_PUBLIC_DOMAIN
        // ou detecta pelo $_SERVER
        if (isset($_SERVER['HTTP_HOST'])) {
            $protocol = (
                (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ||
                (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') ||
                (isset($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] === 'on')
            ) ? 'https' : 'http';

            $this->baseURL = $protocol . '://' . $_SERVER['HTTP_HOST'] . '/';
        }

        // Se existir variável de ambiente com a URL do Railway, usa ela
        if (getenv('APP_BASE_URL') !== false) {
            $this->baseURL = rtrim(getenv('APP_BASE_URL'), '/') . '/';
        }
    }
}
