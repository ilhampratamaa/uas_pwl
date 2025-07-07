<?php

namespace App\Controllers\Buyer;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ProductModel;

class ProductController extends BaseController
{
public function index()
    {
        $model = new ProductModel();
        $data['products'] = $model->findAll();
        return view('buyer/products/index', $data);
    }

    public function detail($id)
    {
        $model = new ProductModel();
        $data['product'] = $model->find($id);
        return view('buyer/products/detail', $data);
    }
}
