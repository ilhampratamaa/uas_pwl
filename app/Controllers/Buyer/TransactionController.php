<?php

namespace App\Controllers\Buyer;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\TransactionModel;
use App\Models\TransactionDetailModel;
use App\Models\ProductModel;

class TransactionController extends BaseController
{
public function index()
    {
        $userId = session()->get('user_id');
        $trxModel = new TransactionModel();

        $transactions = $trxModel->where('user_id', $userId)->orderBy('created_at', 'DESC')->findAll();

        return view('buyer/transactions/index', ['transactions' => $transactions]);
    }

    public function detail($id)
    {
        $userId = session()->get('user_id');
        $trxModel = new TransactionModel();
        $detailModel = new TransactionDetailModel();
        $productModel = new ProductModel();

        $transaction = $trxModel->where('id', $id)->where('user_id', $userId)->first();

        if (!$transaction) {
            return redirect()->to('/buyer/transactions')->with('error', 'Transaksi tidak ditemukan.');
        }

        $details = $detailModel->where('transaction_id', $id)->findAll();

        return view('buyer/transactions/detail', [
            'transaction' => $transaction,
            'details' => $details,
        ]);
    }
}
