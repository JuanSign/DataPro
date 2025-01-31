<?php

namespace App\Controllers;

use App\Models\Auth;

class AuthController extends BaseController
{
    public function index()
    {
        return view('authentication');
    }

    public function login_action()
    {
        $model = model(Auth::class);
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $response = $model->Login($username, $password);

        if ($response['STATUS'] == 'SUCCESS') {
            session()->set('token', $response['TOKEN']);
            session()->set('fname', $response['fname']);
            session()->set('lname', $response['lname']);
            return redirect()->to('/');
        } else {
            return redirect()->to('/authentication');
        }
    }

    public function register_action()
    {
        $model = model(Auth::class);

        $fname = $this->request->getPost('firstName');
        $lname = $this->request->getPost('lastName');
        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $response = $model->Register($fname, $lname, $username, $email, $password);

        if ($response['STATUS'] == 'SUCCESS') {
            return redirect()->to('/authentication');
        } else {
            return redirect()->to('/authentication');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
