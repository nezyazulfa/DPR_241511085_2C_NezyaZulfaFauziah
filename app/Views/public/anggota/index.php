<?= $this->extend('layouts/public_template') ?>

<?= $this->section('title') ?>
    Data Anggota DPR
<?= $this->endSection() ?>

<?= $this->section('page_title') ?>
    Data Anggota DPR (Read Only)
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="alert alert-info" role="alert">
    <i class="fas fa-info-circle"></i> Informasi ini bersifat publik dan hanya untuk keperluan pembacaan data.
</div>

<div class="table-responsive">
    <table class="table table-hover table-striped table-bordered align-middle">
        <thead class="table-primary">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Lengkap</th>
                <th scope="col">Jabatan</th>
                <th scope="col">Status</th>
                <th scope="col">Jml. Anak</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php if (!empty($anggota) && is_array($anggota)): ?>
                <?php foreach ($anggota as $row): ?>
                    <tr>
                        <th scope="row"><?= $no++ ?></th>
                        <td>
                            <?= $row['gelar_depan'] ? esc($row['gelar_depan']) . '. ' : '' ?>
                            <?= esc($row['nama_depan'] . ' ' . $row['nama_belakang']) ?>
                            <?= $row['gelar_belakang'] ? ', ' . esc($row['gelar_belakang']) : '' ?>
                        </td>
                        <td><?= esc($row['jabatan']) ?></td>
                        <td>
                            <?= esc($row['status_pernikahan']) ?>
                        </td>
                        <td><?= esc($row['jumlah_anak']) ?></td>
                        <td class="text-center">
                            <a href="<?= site_url('anggota/' . $row['id_anggota']) ?>" class="btn btn-sm btn-info text-white" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center text-muted">Belum ada data anggota DPR yang tersedia.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>