<?php

namespace App\Controllers\Buyer;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ProductModel;
use App\Models\TransactionModel;
use App\Models\TransactionDetailModel;
use App\Libraries\MidtransSnap;

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

        $trxModel->insert([
            'user_id'     => $userId,
            'total_price' => $total,
            'status'      => 'pending',
        ]);
        $trxId = $trxModel->getInsertID();

        foreach ($cart as $item) {
            $detailModel->insert([
                'transaction_id' => $trxId,
                'product_id'     => $item['product_id'],
                'quantity'       => $item['qty'],
                'price'          => $item['price'],
                'subtotal'       => $item['price'] * $item['qty'],
            ]);

            $product = $productModel->find($item['product_id']);
            if ($product && $product['stock'] >= $item['qty']) {
                $productModel->update($item['product_id'], [
                    'stock' => $product['stock'] - $item['qty']
                ]);
            }
        }

        $db->transComplete();

        // Generate Snap Token
        $midtrans = new MidtransSnap();

        $params = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . $trxId,
                'gross_amount' => $total,
            ],
            'customer_details' => [
                'first_name' => session()->get('username'),
                'email' => session()->get('email'),
            ],
        ];

        $snapToken = $midtrans->createTransaction($params)->token;

        // Redirect ke halaman view Snap
        return view('buyer/checkout/pay', [
            'snapToken' => $snapToken,
            'orderId' => $trxId
        ]);
    }
}
