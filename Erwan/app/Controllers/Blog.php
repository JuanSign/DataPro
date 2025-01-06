<?php
namespace App\Controllers;
class Blog extends BaseController
{
    public function index()
    {
        if (session()->get('num_user') == '') {
            return redirect()->to('/authentication');
        }
        return view('header').view('blog').view('footer');
    }
}