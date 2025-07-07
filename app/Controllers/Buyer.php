<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Buyer extends BaseController
{
    public function dashboard()
    {
        echo "Selamat datang Buyer " . session()->get('username');
    }
}
