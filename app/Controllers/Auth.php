<?php

namespace App\Controllers;

class Auth extends BaseController
{
    
    public function index()
    {
        //echo "Hello World";
        return view('auth/login');
    }

    public function loginCheck()
    {
        $username = trim($this->request->getPost('username'));
        $password = trim($this->request->getPost('password'));

        if ($username == 'admin@themesbrand.com' && $password == '123456') {
            $session = session();
            $session->set('isLoggedIn', 1);
            return redirect()->to('/');
        } else {
            return redirect()->back()->with('error', 'Invalid Login Credentials.');
        }
    }

    public function logout()
    {
        $session = session();
        $session->remove('isLoggedIn');
        return redirect()->to('/login');
    }

}
