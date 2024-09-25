<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Session extends BaseConfig
{
    public $sessionDriver = 'CodeIgniter\Session\Files';
    public $sessionCookieName = 'ci_session';
    public $sessionExpiration = 7200;
    public $sessionSavePath = WRITEPATH . 'session'; // Ensure this directory exists
    public $sessionMatchIP = false;
    public $sessionTimeToUpdate = 300;
    public $sessionRegenerateDestroy = false;
}