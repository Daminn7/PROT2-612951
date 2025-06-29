<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('PROT3-612951/proyecto');
    }

    public function quienesSomos()
    {
        return view('PROT3-612951/quienesSomos');
    }

    public function acercade()
    {
        return view('PROT3-612951/acercade');
    }

    public function registrarse()
    {
        return view('PROT3-612951/registrarse');
    }
    
    public function login()
    {
        return view('PROT3-612951/login');
    }
}
