<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class App extends BaseConfig
{
    /**
     * Base Site URL
     */
    public string $baseURL = 'http://localhost/DPR_241511085_2C_Nezya/DPR_241511085_2C_NezyaZulfaFauziah/public/';

    public array $allowedHostnames = [];

    /**
     * Index File
     */
    public string $indexPage = '';

    /**
     * URI PROTOCOL
     */
    public string $uriProtocol = 'REQUEST_URI';

    /*
     * Allowed URL Characters
     */
    public string $permittedURIChars = 'a-z 0-9~%.:_\-';

    /**
     * Default Locale
     */
    public string $defaultLocale = 'en';

    /**
     * Negotiate Locale
     */
    public bool $negotiateLocale = false;

    /**
     * Supported Locales
     */
    public array $supportedLocales = ['en'];

    /**
     * Application Timezone
     */
    public string $appTimezone = 'Asia/Jakarta'; 

    /**
     * Default Character Set
     */
    public string $charset = 'UTF-8';

    /**
     * Force Global Secure Requests
     */
    public bool $forceGlobalSecureRequests = false;

    /**
     * Reverse Proxy IPs
     */
    public array $proxyIPs = [];

    /**
     * Content Security Policy
     */
    public bool $CSPEnabled = false;

    /*
    |--------------------------------------------------------------------------
    | Session
    |--------------------------------------------------------------------------
    */
    public string $sessionDriver = 'CodeIgniter\Session\Handlers\FileHandler';
    public string $sessionSavePath = WRITEPATH . 'session';
    
    // --- PENGATURAN AMAN UNTUK LOCALHOST ---
    public bool $sessionCookieSecure = false;
    public bool $sessionMatchIP = false;
}
