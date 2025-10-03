<?= $this->extend('layouts/admin_template') ?>

<?= $this->section('title') ?>
    Data Komponen Gaji
<?= $this->endSection() ?>

<?= $this->section('page_title') ?>
    Data Komponen Gaji & Tunjangan
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <a href="<?= site_url('admin/komponen-gaji/new') ?>" class="btn btn-primary mb-3">
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
                        <a href="<?= site_url('admin/komponen-gaji/' . $item['id_komponen'] . '/edit') ?>" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                        <form action="<?= site_url('admin/komponen-gaji/' . $item['id_komponen']) ?>" method="post" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                            <input type="hidden" name="_method" value="DELETE">
                            <?= csrf_field() ?>
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?= $this->endSection() ?>