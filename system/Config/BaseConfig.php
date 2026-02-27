<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class App extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Base Site URL
     * --------------------------------------------------------------------------
     * Em produção no Railway, defina a variável de ambiente:
     *   app.baseURL = https://gestao-escolar-production.up.railway.app/
     *
     * O BaseConfig vai sobrescrever este valor automaticamente se a variável
     * de ambiente existir. O valor abaixo é o fallback para desenvolvimento local.
     *
     * @var string
     */
    public $baseURL = 'http://localhost:8080/';

    /**
     * --------------------------------------------------------------------------
     * Index File
     * --------------------------------------------------------------------------
     * Sem index.php na URL (Railway usa PHP built-in server ou Nginx).
     *
     * @var string
     */
    public $indexPage = '';

    /**
     * --------------------------------------------------------------------------
     * URI PROTOCOL
     * --------------------------------------------------------------------------
     *
     * @var string
     */
    public $uriProtocol = 'REQUEST_URI';

    /**
     * --------------------------------------------------------------------------
     * Default Locale
     * --------------------------------------------------------------------------
     *
     * @var string
     */
    public $defaultLocale = 'pt';

    /**
     * --------------------------------------------------------------------------
     * Negotiate Locale
     * --------------------------------------------------------------------------
     *
     * @var bool
     */
    public $negotiateLocale = false;

    /**
     * --------------------------------------------------------------------------
     * Supported Locales
     * --------------------------------------------------------------------------
     *
     * @var string[]
     */
    public $supportedLocales = ['pt', 'en'];

    /**
     * --------------------------------------------------------------------------
     * Application Timezone
     * --------------------------------------------------------------------------
     *
     * @var string
     */
    public $appTimezone = 'America/Sao_Paulo';

    /**
     * --------------------------------------------------------------------------
     * Default Character Set
     * --------------------------------------------------------------------------
     *
     * @var string
     */
    public $charset = 'UTF-8';

    /**
     * --------------------------------------------------------------------------
     * Force Global Secure Requests
     * --------------------------------------------------------------------------
     * Mantemos false — o Railway termina o HTTPS no proxy deles.
     * Forçar HTTPS aqui causaria redirect loop.
     *
     * @var bool
     */
    public $forceGlobalSecureRequests = false;

    /**
     * --------------------------------------------------------------------------
     * Session Driver
     * --------------------------------------------------------------------------
     *
     * @var string
     */
    public $sessionDriver = 'CodeIgniter\Session\Handlers\FileHandler';

    /**
     * --------------------------------------------------------------------------
     * Session Cookie Name
     * --------------------------------------------------------------------------
     *
     * @var string
     */
    public $sessionCookieName = 'ci_session';

    /**
     * --------------------------------------------------------------------------
     * Session Expiration
     * --------------------------------------------------------------------------
     *
     * @var int
     */
    public $sessionExpiration = 7200;

    /**
     * --------------------------------------------------------------------------
     * Session Save Path
     * --------------------------------------------------------------------------
     *
     * @var string
     */
    public $sessionSavePath = WRITEPATH . 'session';

    /**
     * --------------------------------------------------------------------------
     * Session Match IP
     * --------------------------------------------------------------------------
     *
     * @var bool
     */
    public $sessionMatchIP = false;

    /**
     * --------------------------------------------------------------------------
     * Session Time to Update
     * --------------------------------------------------------------------------
     *
     * @var int
     */
    public $sessionTimeToUpdate = 300;

    /**
     * --------------------------------------------------------------------------
     * Session Regenerate Destroy
     * --------------------------------------------------------------------------
     *
     * @var bool
     */
    public $sessionRegenerateDestroy = false;

    /**
     * --------------------------------------------------------------------------
     * Cookie Prefix
     * --------------------------------------------------------------------------
     * @deprecated use Config\Cookie::$prefix property instead.
     * @var string
     */
    public $cookiePrefix = '';

    /**
     * --------------------------------------------------------------------------
     * Cookie Domain
     * --------------------------------------------------------------------------
     * @deprecated use Config\Cookie::$domain property instead.
     * @var string
     */
    public $cookieDomain = '';

    /**
     * --------------------------------------------------------------------------
     * Cookie Path
     * --------------------------------------------------------------------------
     * @deprecated use Config\Cookie::$path property instead.
     * @var string
     */
    public $cookiePath = '/';

    /**
     * --------------------------------------------------------------------------
     * Cookie Secure
     * --------------------------------------------------------------------------
     * @deprecated use Config\Cookie::$secure property instead.
     * @var bool
     */
    public $cookieSecure = false;

    /**
     * --------------------------------------------------------------------------
     * Cookie HttpOnly
     * --------------------------------------------------------------------------
     * @deprecated use Config\Cookie::$httponly property instead.
     * @var bool
     */
    public $cookieHTTPOnly = true;

    /**
     * --------------------------------------------------------------------------
     * Cookie SameSite
     * --------------------------------------------------------------------------
     * @deprecated use Config\Cookie::$samesite property instead.
     * @var string
     */
    public $cookieSameSite = 'Lax';

    /**
     * --------------------------------------------------------------------------
     * Reverse Proxy IPs
     * --------------------------------------------------------------------------
     * O Railway usa a subnet 100.64.0.0/10 para proxies internos.
     * Os IPs 100.64.0.2 e 100.64.0.3 visíveis nos logs são desta subnet.
     * Isto resolve definitivamente o Warning: Undefined property e o
     * erro "headers already sent".
     *
     * Pode sobrescrever via variável de ambiente no Railway:
     *   app.proxyIPs = 100.64.0.0/10
     *
     * @var string|string[]
     */
    public $proxyIPs = '100.64.0.0/10';

    /**
     * --------------------------------------------------------------------------
     * CSRF Token Name
     * --------------------------------------------------------------------------
     * @deprecated Use `Config\Security` $tokenName instead.
     * @var string
     */
    public $CSRFTokenName = 'csrf_test_name';

    /**
     * --------------------------------------------------------------------------
     * CSRF Header Name
     * --------------------------------------------------------------------------
     * @deprecated Use `Config\Security` $headerName instead.
     * @var string
     */
    public $CSRFHeaderName = 'X-CSRF-TOKEN';

    /**
     * --------------------------------------------------------------------------
     * CSRF Cookie Name
     * --------------------------------------------------------------------------
     * @deprecated Use `Config\Security` $cookieName instead.
     * @var string
     */
    public $CSRFCookieName = 'csrf_cookie_name';

    /**
     * --------------------------------------------------------------------------
     * CSRF Expire
     * --------------------------------------------------------------------------
     * @deprecated Use `Config\Security` $expire instead.
     * @var int
     */
    public $CSRFExpire = 7200;

    /**
     * --------------------------------------------------------------------------
     * CSRF Regenerate
     * --------------------------------------------------------------------------
     * @deprecated Use `Config\Security` $regenerate instead.
     * @var bool
     */
    public $CSRFRegenerate = true;

    /**
     * --------------------------------------------------------------------------
     * CSRF Redirect
     * --------------------------------------------------------------------------
     * @deprecated Use `Config\Security` $redirect instead.
     * @var bool
     */
    public $CSRFRedirect = true;

    /**
     * --------------------------------------------------------------------------
     * CSRF SameSite
     * --------------------------------------------------------------------------
     * @deprecated Use `Config\Security` $samesite instead.
     * @var string
     */
    public $CSRFSameSite = 'Lax';

    /**
     * --------------------------------------------------------------------------
     * Content Security Policy
     * --------------------------------------------------------------------------
     *
     * @var bool
     */
    public $CSPEnabled = false;

    /**
     * --------------------------------------------------------------------------
     * Constructor
     * --------------------------------------------------------------------------
     * Chama o parent que processa variáveis de ambiente automaticamente
     * (via BaseConfig::__construct). Depois aplica detecção dinâmica da
     * baseURL caso não tenha sido sobrescrita por variável de ambiente.
     */
    public function __construct()
    {
        // O parent::__construct() do BaseConfig lê automaticamente
        // variáveis de ambiente no formato:
        //   app.baseURL = https://gestao-escolar-production.up.railway.app/
        //   app.proxyIPs = 100.64.0.0/10
        // Basta definir essas variáveis no painel do Railway > Variables.
        parent::__construct();

        // Se a baseURL ainda aponta para localhost (não foi sobrescrita
        // por variável de ambiente), detecta automaticamente pelo request.
        if (
            strpos($this->baseURL, 'localhost') !== false
            && isset($_SERVER['HTTP_HOST'])
        ) {
            $isHttps = (
                (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ||
                (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') ||
                (isset($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] === 'on')
            );

            $protocol      = $isHttps ? 'https' : 'http';
            $this->baseURL = $protocol . '://' . $_SERVER['HTTP_HOST'] . '/';
        }
    }
}
