<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class UserController extends BaseController
{
public function index()
    {
        $model = new UserModel();
        $data['users'] = $model->findAll();
        return view('admin/users/index', $data);
    }

    public function create()
    {
        return view('admin/users/create');
    }

    public function store()
    {
        $model = new UserModel();
        $data = $this->request->getPost();

        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        $model->save($data);
        return redirect()->to('/admin/users');
    }

    public function edit($id)
    {
        $model = new UserModel();
        $data['user'] = $model->find($id);
        return view('admin/users/edit', $data);
    }

    public function update($id)
    {
        $model = new UserModel();
        $data = $this->request->getPost();

        // jika password diisi baru, hash. Kalau kosong, jangan ubah
        if (!empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        } else {
            unset($data['password']);
        }

        $model->update($id, $data);
        return redirect()->to('/admin/users');
    }

    public function delete($id)
    {
        $model = new UserModel();
        $model->delete($id);
        return redirect()->to('/admin/users');
    }
}
