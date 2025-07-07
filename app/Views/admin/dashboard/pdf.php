<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan</title>
    <style>
        /* Gaya dasar untuk PDF */
        body {
            font-family: Arial, sans-serif;
            font-size: 10pt;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold; /* Pastikan header tebal */
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 8pt;
        }
    </style>
</head>
<body>

    <h1>Laporan Penjualan</h1>
    <p>Tanggal Laporan: <?= date('d M Y H:i:s') ?></p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Total</th>
                <th>Status</th>
                <th>Tanggal Transaksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($transactions)): ?>
                <?php foreach ($transactions as $t): ?>
                    <tr>
                        <td><?= esc($t['id']) ?></td>
                        <td><?= esc($t['username']) ?></td>
                        <td class="text-right">Rp<?= number_format($t['total_price']) ?></td>
                        <td><?= ucfirst(esc($t['status'])) ?></td>
                        <td><?= date('d M Y, H:i', strtotime($t['created_at'])) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data transaksi yang ditemukan.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="footer">
        Laporan ini dibuat secara otomatis.
    </div>

</body>
</html>
