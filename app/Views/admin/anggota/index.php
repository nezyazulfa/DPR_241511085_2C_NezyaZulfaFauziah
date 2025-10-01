<?= $this->extend('layouts/admin_template') ?>

<?= $this->section('title') ?>
    Data Anggota DPR
<?= $this->endSection() ?>

<?= $this->section('page_title') ?>
    Data Anggota DPR
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <a href="<?= site_url('admin/anggota/new') ?>" class="btn btn-primary mb-3">
        <i class="fa fa-plus"></i> Tambah Data
    </a>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID Anggota</th>
                    <th>Nama Lengkap</th>
                    <th>Jabatan</th>
                    <th>Status</th>
                    <th>Anak</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($anggota as $item): ?>
                <tr>
                    <td><?= esc($item['id_anggota']) ?></td>
                    <td>
                        <?= esc(trim($item['gelar_depan'] . ' ' . $item['nama_depan'] . ' ' . $item['nama_belakang'] . ' ' . $item['gelar_belakang'])) ?>
                    </td>
                    <td><?= esc($item['jabatan']) ?></td>
                    <td><?= esc($item['status_pernikahan']) ?></td>
                    <td><?= esc($item['jumlah_anak']) ?></td>
                    <td>
                        <a href="#" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                        <a href="<?= site_url('admin/anggota/' . $item['id_anggota'] . '/edit') ?>" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                        <form action="<?= site_url('admin/anggota/' . $item['id_anggota']) ?>" method="post" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
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