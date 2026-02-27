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
    public $baseURL = 'https://gestao-escolar-production.up.railway.app/';
    public $indexPage = '';
    public $uriProtocol = 'REQUEST_URI';
    /*
    |--------------------------------------------------------------------------
    | Localization
    |--------------------------------------------------------------------------
    */
    public $defaultLocale = 'pt';
    public $negotiateLocale = false;
    public $supportedLocales = ['pt', 'en'];
    /*
    |--------------------------------------------------------------------------
    | Timezone (Angola)
    |--------------------------------------------------------------------------
    */
    public $appTimezone = 'Africa/Luanda';
    public $charset = 'UTF-8';
    /*
    |--------------------------------------------------------------------------
    | HTTPS
    |--------------------------------------------------------------------------
    | No Railway a aplicação já roda em HTTPS
    */
    public $forceGlobalSecureRequests = true;
    /*
    |--------------------------------------------------------------------------
    | Reverse Proxy (Railway)
    |--------------------------------------------------------------------------
    | Pode ser um array ou string CIDR. Evita aviso de propriedade indefinida.
    */
    public $proxyIPs = ['100.64.0.0/10'];
    /*
    |--------------------------------------------------------------------------
    | Session
    |--------------------------------------------------------------------------
    */
    public $sessionDriver = 'CodeIgniter\Session\Handlers\FileHandler';
    public $sessionCookieName = 'ci_session';
    public $sessionExpiration = 7200;
    public $sessionSavePath = WRITEPATH . 'session';
    public $sessionMatchIP = false;
    public $sessionTimeToUpdate = 300;
    public $sessionRegenerateDestroy = false;
    /*
    |--------------------------------------------------------------------------
    | Cookies
    |--------------------------------------------------------------------------
    */
    public $cookiePrefix = '';
    public $cookieDomain = '';
    public $cookiePath = '/';
    public $cookieSecure = true; // HTTPS obrigatório
    public $cookieHTTPOnly = true;
    public $cookieSameSite = 'Lax';
    /*
    |--------------------------------------------------------------------------
    | CSRF Protection
    |--------------------------------------------------------------------------
    */
    public $CSRFTokenName = 'csrf_test_name';
    public $CSRFHeaderName = 'X-CSRF-TOKEN';
    public $CSRFCookieName = 'csrf_cookie_name';
    public $CSRFExpire = 7200;
    public $CSRFRegenerate = true;
    public $CSRFRedirect = true;
    public $CSRFSameSite = 'Lax';
    /*
    |--------------------------------------------------------------------------
    | Content Security Policy
    |--------------------------------------------------------------------------
    */
    public $CSPEnabled = false;
}
