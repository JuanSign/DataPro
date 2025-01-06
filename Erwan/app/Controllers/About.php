<?php
namespace App\Controllers;
class About extends BaseController
{
    public function index()
    {
        if (session()->get('num_user') == '') {
            return redirect()->to('/authentication');
        }
        return view('header').view('about').view('footer');
    }
}