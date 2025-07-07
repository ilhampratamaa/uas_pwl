<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class Auth extends BaseController
{
public function login()
{
    helper(['form']);

    if ($this->request->getMethod() === 'POST') {
        $rules = [
            'username' => 'required',
            'password' => 'required',
        ];

        if (!$this->validate($rules)) {
            return view('auth/login', ['validation' => $this->validator]);
        }

        $userModel = new \App\Models\UserModel();
        $user = $userModel->where('username', $this->request->getPost('username'))->first();

        if ($user && password_verify($this->request->getPost('password'), $user['password'])) {
            session()->set([
                'user_id'   => $user['id'],
                'username'  => $user['username'],
                'role'      => $user['role'],
                'isLoggedIn'=> true
            ]);

            return redirect()->to($user['role'] === 'admin' ? '/admin' : '/');
        } else {
            return view('auth/login', ['error' => 'Username atau password salah']);
        }
    }

    return view('auth/login');
}


    public function register()
    {
        helper(['form']);
        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'username' => 'required|is_unique[users.username]',
                'email'    => 'required|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[6]',
                'confirm'  => 'matches[password]',
            ];

            if (!$this->validate($rules)) {
                return view('auth/register', ['validation' => $this->validator]);
            }

            $model = new UserModel();
            $model->save([
                'username' => $this->request->getPost('username'),
                'email'    => $this->request->getPost('email'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'role'     => 'buyer'
            ]);

            return redirect()->to('/login');
        }

        return view('auth/register');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
