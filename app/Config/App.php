<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class App extends BaseConfig
{
    /*
    |--------------------------------------------------------------------------
    | Base URL
    |--------------------------------------------------------------------------
    */
    public string $baseURL = 'https://gestao-escolar-production.up.railway.app/';

    public string $indexPage = '';

    public string $uriProtocol = 'REQUEST_URI';

    /*
    |--------------------------------------------------------------------------
    | Localization
    |--------------------------------------------------------------------------
    */
    public string $defaultLocale = 'pt';
    public bool $negotiateLocale = false;
    public array $supportedLocales = ['pt', 'en'];

    /*
    |--------------------------------------------------------------------------
    | Timezone (Angola)
    |--------------------------------------------------------------------------
    */
    public string $appTimezone = 'Africa/Luanda';

    public string $charset = 'UTF-8';

    /*
    |--------------------------------------------------------------------------
    | HTTPS
    |--------------------------------------------------------------------------
    | No Railway a aplicação já roda em HTTPS
    */
    public bool $forceGlobalSecureRequests = true;

    /*
    |--------------------------------------------------------------------------
    | Reverse Proxy (Railway)
    |--------------------------------------------------------------------------
    */
    public $proxyIPs = '100.64.0.0/10';

    /*
    |--------------------------------------------------------------------------
    | Session
    |--------------------------------------------------------------------------
    */
    public string $sessionDriver = 'CodeIgniter\Session\Handlers\FileHandler';
    public string $sessionCookieName = 'ci_session';
    public int $sessionExpiration = 7200;
    public string $sessionSavePath = WRITEPATH . 'session';
    public bool $sessionMatchIP = false;
    public int $sessionTimeToUpdate = 300;
    public bool $sessionRegenerateDestroy = false;

    /*
    |--------------------------------------------------------------------------
    | Cookies
    |--------------------------------------------------------------------------
    */
    public string $cookiePrefix = '';
    public string $cookieDomain = '';
    public string $cookiePath = '/';
    public bool $cookieSecure = true; // IMPORTANTE para HTTPS
    public bool $cookieHTTPOnly = true;
    public string $cookieSameSite = 'Lax';

    /*
    |--------------------------------------------------------------------------
    | CSRF Protection
    |--------------------------------------------------------------------------
    */
    public string $CSRFTokenName = 'csrf_test_name';
    public string $CSRFHeaderName = 'X-CSRF-TOKEN';
    public string $CSRFCookieName = 'csrf_cookie_name';
    public int $CSRFExpire = 7200;
    public bool $CSRFRegenerate = true;
    public bool $CSRFRedirect = true;
    public string $CSRFSameSite = 'Lax';

    /*
    |--------------------------------------------------------------------------
    | Content Security Policy
    |--------------------------------------------------------------------------
    */
    public bool $CSPEnabled = false;
}
