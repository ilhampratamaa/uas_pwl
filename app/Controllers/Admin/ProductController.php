<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ProductModel;

class ProductController extends BaseController
{
public function index()
    {
        $productModel = new ProductModel();
        $data['products'] = $productModel->findAll();
        return view('admin/products/index', $data);
    }

    public function create()
    {
        return view('admin/products/create');
    }

    public function store()
    {
        $productModel = new ProductModel();

        $data = $this->request->getPost();
        $file = $this->request->getFile('photo');

        if ($file && $file->isValid()) {
            $fileName = $file->getRandomName();
            $file->move('uploads/products', $fileName);
            $data['photo'] = $fileName;
        }

        $productModel->save($data);
        return redirect()->to('/admin/products');
    }

    public function edit($id)
    {
        $productModel = new ProductModel();
        $data['product'] = $productModel->find($id);
        return view('admin/products/edit', $data);
    }

    public function update($id)
    {
        $productModel = new ProductModel();

        $data = $this->request->getPost();
        $file = $this->request->getFile('photo');

        if ($file && $file->isValid()) {
            $fileName = $file->getRandomName();
            $file->move('uploads/products', $fileName);
            $data['photo'] = $fileName;
        }

        $productModel->update($id, $data);
        return redirect()->to('/admin/products');
    }

    public function delete($id)
    {
        $productModel = new ProductModel();
        $productModel->delete($id);
        return redirect()->to('/admin/products');
    }
}
