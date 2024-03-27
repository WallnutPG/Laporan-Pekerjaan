<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        if (in_groups('admin') || in_groups('panitia')) {
            $redirect = 'dashboard';
        } elseif(in_groups('examp')) {
            $redirect = '/examp';
        } else {
            $redirect = '/';
        }

        return redirect()->to($redirect);
    }
}
