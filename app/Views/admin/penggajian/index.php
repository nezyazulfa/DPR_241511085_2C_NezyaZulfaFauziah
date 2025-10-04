<?= $this->extend('layouts/admin_template') ?>

<?= $this->section('title') ?>
    Data Penggajian
<?= $this->endSection() ?>

<?= $this->section('page_title') ?>
    Data Penggajian Anggota DPR
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <a href="<?= site_url('admin/penggajian/new') ?>" class="btn btn-primary mb-3">
        <i class="fa fa-plus"></i> Tambah Data Penggajian
    </a>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tanggal</th>
                    <th>Nama Anggota</th>
                    <th>Jabatan</th>
                    <th>Take Home Pay</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($penggajian)): ?>
                    <tr>
                        <td colspan="6" class="text-center">Belum ada data penggajian.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach($penggajian as $item): ?>
                    <tr>
                        <td><?= esc($item['id_penggajian']) ?></td>
                        <td><?= esc(date('d F Y', strtotime($item['tanggal_penggajian']))) ?></td>
                        <td><?= esc($item['nama_depan'] . ' ' . $item['nama_belakang']) ?></td>
                        <td><?= esc($item['jabatan']) ?></td>
                        <td>Rp <?= number_format($item['take_home_pay'], 0, ',', '.') ?></td>
                        <td>
                            <a href="<?= site_url('admin/penggajian/' . $item['id_penggajian']) ?>" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                            
                            <form action="<?= site_url('admin/penggajian/' . $item['id_penggajian']) ?>" method="post" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
<?= $this->endSection() ?>