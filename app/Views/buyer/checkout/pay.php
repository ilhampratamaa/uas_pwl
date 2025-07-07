<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?= getenv('MIDTRANS_CLIENT_KEY') ?>"></script>

<section class="py-5">
<div class="container my-5">
    <h2 class="mb-4">Proses Pembayaran</h2>

    <div class="alert alert-info">
        Silakan klik tombol di bawah untuk menyelesaikan pembayaran Anda melalui Midtrans.
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body text-center">
            <p class="mb-4 fs-5">Klik tombol di bawah untuk membuka halaman pembayaran:</p>

            <button id="pay-button" class="btn btn-primary btn-lg">
                <i class="bi bi-credit-card"></i> Bayar Sekarang
            </button>

            <p class="mt-4 text-muted fst-italic">Transaksi Anda akan dikonfirmasi otomatis setelah pembayaran berhasil.</p>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="<?= site_url('buyer/transactions') ?>" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left-circle"></i> Kembali ke Daftar Transaksi
        </a>
    </div>
</div>
</section>

<script>
    document.getElementById('pay-button').addEventListener('click', function () {
        snap.pay('<?= $snapToken ?>', {
            onSuccess: function(result) {
                // Hapus cart di session setelah sukses
                fetch("<?= site_url('buyer/cart/clear') ?>", { method: "POST" }) 
                    .then(() => {
                        alert("Pembayaran berhasil!");
                        window.location.href = "/buyer/transactions";
                    });
            },
            onPending: function(result) {
                alert("Menunggu pembayaran.");
                window.location.href = "/buyer/transactions";
            },
            onError: function(result) {
                alert("Pembayaran gagal.");
                window.location.href = "/buyer/transactions";
            }
        });
    });
</script>

<?= $this->endSection() ?>
