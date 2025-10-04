<?= $this->extend('layouts/public_template') ?>

<?= $this->section('title') ?>
    Dashboard Publik
<?= $this->endSection() ?>

<?= $this->section('page_title') ?>
    Dashboard Transparansi Gaji DPR
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <p>Selamat datang di halaman **Transparansi Gaji DPR**. Aplikasi ini menyajikan informasi penghasilan Anggota DPR RI secara transparan dan mudah dipahami oleh publik[cite: 8].</p>
                    
                    <h5 class="mt-4">Fitur Publik (Akses Baca Saja):</h5>
                    <ul>
                        <li><i class="fas fa-users"></i> Data Anggota DPR (Read Only) [cite: 13, 50]</li>
                        <li><i class="fas fa-money-bill-wave"></i> Data Penggajian dan Take Home Pay (Read Only) [cite: 13, 53]</li>
                    </ul>

                    <p class="mt-4 text-muted">Untuk melihat data, silakan gunakan menu navigasi di samping atau di atas.</p>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>