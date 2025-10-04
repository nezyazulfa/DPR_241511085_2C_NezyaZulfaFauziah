<?= $this->extend('layouts/admin_template') ?>

<?= $this->section('title') ?>
    Detail Penggajian
<?= $this->endSection() ?>

<?= $this->section('page_title') ?>
    Detail Penggajian
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="card">
        <div class="card-header">
            <h4>ID Penggajian: <?= esc($penggajian['id_penggajian']) ?></h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Nama Anggota:</strong> <?= esc($penggajian['nama_depan'] . ' ' . $penggajian['nama_belakang']) ?></p>
                    <p><strong>Jabatan:</strong> <?= esc($penggajian['jabatan']) ?></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Tanggal Penggajian:</strong> <?= esc(date('d F Y', strtotime($penggajian['tanggal_penggajian']))) ?></p>
                    <p><strong>Total Take Home Pay:</strong> Rp <?= number_format($penggajian['take_home_pay'], 0, ',', '.') ?></p>
                </div>
            </div>

            <hr>

            <h5>Rincian Komponen Gaji:</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>Nama Komponen</th>
                            <th>Kategori</th>
                            <th>Nominal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($detail_komponen as $komponen): ?>
                            <tr>
                                <td><?= esc($komponen['nama_komponen']) ?></td>
                                <td><?= esc($komponen['kategori']) ?></td>
                                <td>Rp <?= number_format($komponen['nominal'], 0, ',', '.') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <a href="<?= site_url('admin/penggajian') ?>" class="btn btn-secondary mt-3">Kembali</a>
        </div>
    </div>
<?= $this->endSection() ?>