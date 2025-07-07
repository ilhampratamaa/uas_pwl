<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\TransactionModel;
use App\Models\UserModel; // Pastikan ini diimpor
use Dompdf\Dompdf;

class DashboardController extends BaseController
{
    public function index()
    {
        $transactionModel = new TransactionModel();
        $userModel = new UserModel();

        $data['totalSales'] = $transactionModel->where('status', 'verified')->selectSum('total_price')->first()['total_price'] ?? 0;
        $data['totalTransactions'] = $transactionModel->where('status', 'verified')->countAllResults();
        $data['totalUsers'] = $userModel->where('role', 'buyer')->countAllResults();
        // Untuk dashboard, Anda mungkin ingin menampilkan transaksi terbaru dengan username
        $data['transactions'] = $transactionModel->join('users', 'users.id = transactions.user_id')
                                                 ->select('transactions.*, users.username')
                                                 ->where('status', 'verified')
                                                 ->orderBy('created_at', 'DESC')
                                                 ->findAll();

        return view('admin/dashboard/index', $data);
    }

    public function exportPdf()
    {
        $transactionModel = new TransactionModel();
        // Lakukan join untuk mendapatkan username di data PDF
        $data['transactions'] = $transactionModel->join('users', 'users.id = transactions.user_id')
                                                 ->select('transactions.*, users.username') // Pilih juga username
                                                 ->where('status', 'verified')
                                                 ->orderBy('created_at', 'DESC')
                                                 ->findAll();

        $dompdf = new Dompdf();
        $html = view('admin/dashboard/pdf', $data); // Pastikan view ini ada dan benar
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('laporan_penjualan_' . date('Ymd') . '.pdf', ['Attachment' => false]);
        exit(); // Penting untuk menghentikan eksekusi setelah streaming PDF
    }
}
