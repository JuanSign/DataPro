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
        $name = $model->getDataUsers($username, $password);  // Get the name from the database
    
        if ($name !== null) {
            session()->set('num_user', 1); // Set session for user
            session()->set('username', $username); // Set username in session
            session()->set('name', $name); // Set the correct name from DB
            session()->set('isLoggedIn', true); // Set session isLoggedIn
            return redirect()->to('/');
        } else {
            return redirect()->to('/authentication');
        }
    }
    
    public function logout() 
    {
        session()->destroy();
        return redirect()->to('/authentication');
    }
}