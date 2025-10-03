<?= $this->extend('layouts/admin_template') ?>

<?= $this->section('title') ?>
    Detail Anggota DPR
<?= $this->endSection() ?>

<?= $this->section('page_title') ?>
    Detail Anggota: <?= esc($anggota['nama_depan'] . ' ' . $anggota['nama_belakang']) ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="list-group">
        <div class="list-group-item">
            <strong>ID Anggota:</strong> <?= esc($anggota['id_anggota']) ?>
        </div>
        <div class="list-group-item">
            <strong>Nama Lengkap:</strong> 
            <?= esc(trim($anggota['gelar_depan'] . ' ' . $anggota['nama_depan'] . ' ' . $anggota['nama_belakang'] . ' ' . $anggota['gelar_belakang'])) ?>
        </div>
        <div class="list-group-item">
            <strong>Jabatan:</strong> <?= esc($anggota['jabatan']) ?>
        </div>
        <div class="list-group-item">
            <strong>Status Pernikahan:</strong> <?= esc($anggota['status_pernikahan']) ?>
        </div>
        <div class="list-group-item">
            <strong>Jumlah Anak:</strong> <?= esc($anggota['jumlah_anak']) ?>
        </div>
    </div>
    <a href="<?= site_url('admin/anggota') ?>" class="btn btn-secondary mt-3">Kembali</a>
<?= $this->endSection() ?>