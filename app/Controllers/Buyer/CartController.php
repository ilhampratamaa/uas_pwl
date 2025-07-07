<?php

namespace App\Controllers\Buyer;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ProductModel;

class CartController extends BaseController
{
public function index()
    {
        $cart = session()->get('cart') ?? [];
        return view('buyer/cart/index', ['cart' => $cart]);
    }

    public function add($productId)
    {
        $productModel = new ProductModel();
        $product = $productModel->find($productId);

        if (!$product) return redirect()->back()->with('error', 'Produk tidak ditemukan.');

        $qty = (int)$this->request->getPost('qty');
        if ($qty < 1) $qty = 1;

        $cart = session()->get('cart') ?? [];

        if (isset($cart[$productId])) {
            $cart[$productId]['qty'] += $qty;
        } else {
            $cart[$productId] = [
                'product_id' => $productId,
                'name'       => $product['name'],
                'price'      => $product['price'],
                'qty'        => $qty,
            ];
        }

        session()->set('cart', $cart);
        return redirect()->to('/buyer/cart')->with('success', 'Produk ditambahkan ke keranjang');
    }

    public function remove($productId)
    {
        $cart = session()->get('cart') ?? [];
        unset($cart[$productId]);
        session()->set('cart', $cart);
        return redirect()->to('/buyer/cart')->with('success', 'Produk dihapus dari keranjang');
    }

    public function clear()
    {
        session()->remove('cart');
        return redirect()->to('/buyer/cart')->with('success', 'Keranjang dikosongkan');
    }
}
