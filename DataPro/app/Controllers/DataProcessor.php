<?php

namespace App\Controllers;

class DataProcessor extends BaseController
{
    public function index()
    {
        if (!session()->has('token')) {
            return redirect()->to('/authentication');
        }
        return view('header') . view('data_processor') . view('footer');
    }
}
