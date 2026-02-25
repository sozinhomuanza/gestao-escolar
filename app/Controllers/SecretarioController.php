<?php

namespace App\Controllers;

class SecretarioController extends BaseController
{
    public function __construct()
    {
        helper('url');
        $this->proteger(['secretario']); // protege para apenas secretários
    }

    public function dashboard()
    {
        echo "Bem-vindo ao painel Secretário!";
        // return view('secretario/dashboard');
    }
}
