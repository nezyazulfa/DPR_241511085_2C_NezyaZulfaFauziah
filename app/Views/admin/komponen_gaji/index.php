<?= $this->extend('layouts/admin_template') ?>

<?= $this->section('title') ?>
    Data Komponen Gaji
<?= $this->endSection() ?>

<?= $this->section('page_title') ?>
    Data Komponen Gaji & Tunjangan
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <a href="#" class="btn btn-primary mb-3">
        <i class="fa fa-plus"></i> Tambah Data
    </a>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Komponen</th>
                    <th>Kategori</th>
                    <th>Untuk Jabatan</th>
                    <th>Nominal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($komponen_gaji as $item): ?>
                <tr>
                    <td><?= esc($item['id_komponen']) ?></td>
                    <td><?= esc($item['nama_komponen']) ?></td>
                    <td><?= esc($item['kategori']) ?></td>
                    <td><?= esc($item['jabatan']) ?></td>
                    <td>Rp <?= number_format($item['nominal'], 0, ',', '.') ?></td>
                    <td>
                        <a href="#" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                        <a href="#" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?= $this->endSection() ?>