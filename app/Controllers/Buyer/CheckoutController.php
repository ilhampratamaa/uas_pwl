<?php

namespace App\Controllers\Buyer;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ProductModel;
use App\Models\TransactionModel;
use App\Models\TransactionDetailModel;

class CheckoutController extends BaseController
{
public function index()
    {
        $cart = session()->get('cart') ?? [];

        if (empty($cart)) {
            return redirect()->to('/buyer/cart')->with('error', 'Keranjang kosong.');
        }

        return view('buyer/checkout/index', ['cart' => $cart]);
    }

    public function process()
    {
        $cart = session()->get('cart') ?? [];

        if (empty($cart)) {
            return redirect()->to('/buyer/cart')->with('error', 'Keranjang kosong.');
        }

        $productModel = new ProductModel();
        $trxModel = new TransactionModel();
        $detailModel = new TransactionDetailModel();

        $db = \Config\Database::connect();
        $db->transStart();

        $userId = session()->get('user_id');
        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Silakan login kembali.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
        }

        // 🔍 Insert transaksi utama
        $success = $trxModel->insert([
            'user_id'     => $userId,
            'total_price' => $total,
            'status'      => 'pending',
        ]);

        if (!$success) {
            // Tampilkan error jika insert transaksi gagal
            $errors = $trxModel->errors();
            dd("Gagal insert transaksi", $errors);
        }

        $trxId = $trxModel->getInsertID();

        // 🔍 Insert detail transaksi
        foreach ($cart as $item) {
            $successDetail = $detailModel->insert([
                'transaction_id' => $trxId,
                'product_id'     => $item['product_id'],
                'quantity'       => $item['qty'],
                'price'          => $item['price'],
                'subtotal'       => $item['price'] * $item['qty'],
            ]);

            if (!$successDetail) {
                $errors = $detailModel->errors();
                dd("Gagal insert detail transaksi", $errors);
            }

            // Update stok produk
            $product = $productModel->find($item['product_id']);
            if ($product && $product['stock'] >= $item['qty']) {
                $productModel->update($item['product_id'], [
                    'stock' => $product['stock'] - $item['qty']
                ]);
            }
        }

        $db->transComplete();

        if ($db->transStatus() === false) {
            $error = $db->error();
            dd("Transaksi gagal!", $error);
        }

        session()->remove('cart');
        return redirect()->to('/buyer/transactions')->with('success', 'Transaksi berhasil dilakukan.');
    }

}
