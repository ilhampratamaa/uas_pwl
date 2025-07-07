<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;
use App\Models\TransactionModel;
use App\Models\TransactionDetailModel; // Tambahkan ini jika belum ada
use App\Models\ProductModel;

class TransactionController extends BaseController
{
public function index()
    {
        $model = new TransactionModel();
        $data['transactions'] = $model->join('users', 'users.id = transactions.user_id')->select('transactions.*, users.username')->findAll();
        return view('admin/transactions/index', $data);
    }

    public function confirm($id)
    {
        $model = new TransactionModel();
        $data['transaction'] = $model->find($id);
        return view('admin/transactions/confirm', $data);
    }

    public function update($id)
    {
        $model = new TransactionModel();

        $model->update($id, [
            'status'     => 'verified',
            'akun_game'  => $this->request->getPost('akun_game')
        ]);

        return redirect()->to('/admin/transactions');
    }

    public function cancel($id)
    {
        $trxModel = new TransactionModel();
        $detailModel = new TransactionDetailModel();
        $productModel = new ProductModel();

        $db = \Config\Database::connect();
        $db->transStart(); // Mulai transaksi database

        $transaction = $trxModel->find($id);

        if (!$transaction) {
            $db->transRollback();
            return redirect()->to('/admin/transactions')->with('error', 'Transaksi tidak ditemukan.');
        }

        // Hanya batalkan jika statusnya pending
        if ($transaction['status'] === 'pending') {
            // Update status transaksi menjadi 'canceled'
            $success = $trxModel->update($id, ['status' => 'canceled']);

            if (!$success) {
                $db->transRollback();
                return redirect()->to('/admin/transactions')->with('error', 'Gagal membatalkan transaksi.');
            }

            // Kembalikan stok produk
            $details = $detailModel->where('transaction_id', $id)->findAll();
            foreach ($details as $item) {
                $product = $productModel->find($item['product_id']);
                if ($product) {
                    $productModel->update($item['product_id'], [
                        'stock' => $product['stock'] + $item['quantity'] // Tambahkan kembali kuantitas ke stok
                    ]);
                }
            }

            $db->transComplete(); // Selesaikan transaksi database

            if ($db->transStatus() === false) {
                return redirect()->to('/admin/transactions')->with('error', 'Pembatalan transaksi gagal dan stok tidak dikembalikan.');
            }

            return redirect()->to('/admin/transactions')->with('success', 'Transaksi berhasil dibatalkan dan stok dikembalikan.');
        } else {
            return redirect()->to('/admin/transactions')->with('error', 'Transaksi tidak dapat dibatalkan karena statusnya bukan pending.');
        }
    }

     public function delete($id)
    {
        $trxModel = new TransactionModel();
        $detailModel = new TransactionDetailModel();
        $productModel = new ProductModel();

        $db = \Config\Database::connect();
        $db->transStart(); // Mulai transaksi database

        $transaction = $trxModel->find($id);

        if (!$transaction) {
            $db->transRollback();
            return redirect()->to('/admin/transactions')->with('error', 'Transaksi tidak ditemukan.');
        }

        // 1. Ambil detail transaksi terkait untuk mengembalikan stok
        $details = $detailModel->where('transaction_id', $id)->findAll();

        // 2. Kembalikan stok produk
        foreach ($details as $item) {
            $product = $productModel->find($item['product_id']);
            if ($product) {
                // Pastikan menggunakan 'quantity' sesuai dengan nama kolom di database
                $productModel->update($item['product_id'], [
                    'stock' => $product['stock'] + $item['quantity']
                ]);
            }
        }

        // 3. Hapus detail transaksi
        $detailModel->where('transaction_id', $id)->delete();

        // 4. Hapus transaksi utama
        $trxModel->delete($id);

        $db->transComplete(); // Selesaikan transaksi database

        if ($db->transStatus() === false) {
            // Jika ada masalah dalam transaksi, rollback akan terjadi
            return redirect()->to('/admin/transactions')->with('error', 'Gagal menghapus transaksi. Silakan coba lagi.');
        }

        return redirect()->to('/admin/transactions')->with('success', 'Transaksi berhasil dihapus dan stok produk telah dikembalikan.');
    }


    public function detail($id)
{
    $transactionModel = new \App\Models\TransactionModel();
    $detailModel = new \App\Models\TransactionDetailModel();

    $data['transaction'] = $transactionModel
        ->join('users', 'users.id = transactions.user_id')
        ->select('transactions.*, users.username')
        ->find($id);

    $data['details'] = $detailModel
        ->join('products', 'products.id = transaction_details.product_id')
        ->select('transaction_details.*, products.name as product_name')
        ->where('transaction_id', $id)
        ->findAll();

    return view('admin/transactions/detail', $data);
}
}
