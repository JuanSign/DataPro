<?php
namespace App\Controllers;
use App\Models\Login;
class LoginController extends BaseController
{
    public function index()
    {
        return view('authentication');
    }
    
    public function login_action(){
        $model = model(Login::class);
        $username = $this->request->getPost('username');
        $password = md5($this->request->getPost('password'));
        $name = $model->getDataUsers($username, $password);
    
        if ($name !== null) {
            session()->set('num_user', 1); 
            session()->set('username', $username);
            session()->set('name', $name); 
            session()->set('isLoggedIn', true);
            return redirect()->to('/');
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