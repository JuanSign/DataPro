<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        if (session()->get('num_user') == '') {
            return redirect()->to('/authentication');
        }
        return view('header').view('dashboard').view('footer');
    }
}
