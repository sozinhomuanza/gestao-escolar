<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class App extends BaseConfig
{
    public $baseURL = 'https://gestao-escolar-production.up.railway.app/';
    public $indexPage = '';
    public $uriProtocol = 'REQUEST_URI';
    public $defaultLocale = 'pt';
    public $negotiateLocale = false;
    public $supportedLocales = ['pt', 'en'];
    public $appTimezone = 'Africa/Luanda';
    public $charset = 'UTF-8';
    public $forceGlobalSecureRequests = true;
    public $proxyIPs = ['100.64.0.0/10'];
    public $sessionDriver = 'CodeIgniter\Session\Handlers\FileHandler';
    public $sessionCookieName = 'ci_session';
    public $sessionExpiration = 7200;
    public $sessionSavePath = WRITEPATH . 'session';
    public $sessionMatchIP = false;
    public $sessionTimeToUpdate = 300;
    public $sessionRegenerateDestroy = false;
    public $cookiePrefix = '';
    public $cookieDomain = '';
    public $cookiePath = '/';
    public $cookieSecure = true;
    public $cookieHTTPOnly = true;
    public $cookieSameSite = 'Lax';
    public $CSRFTokenName = 'csrf_test_name';
    public $CSRFHeaderName = 'X-CSRF-TOKEN';
    public $CSRFCookieName = 'csrf_cookie_name';
    public $CSRFExpire = 7200;
    public $CSRFRegenerate = true;
    public $CSRFRedirect = true;
    public $CSRFSameSite = 'Lax';
    public $CSPEnabled = false;
}
