<?= $this->extend('layouts/admin_template') ?>

<?= $this->section('title') ?>
    Tambah Data Anggota
<?= $this->endSection() ?>

<?= $this->section('page_title') ?>
    Tambah Data Anggota Baru
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <form action="<?= site_url('admin/anggota') ?>" method="post">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label for="id_anggota" class="form-label">ID Anggota</label>
            <input type="text" class="form-control" id="id_anggota" name="id_anggota" required placeholder="Contoh: A-101">
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="nama_depan" class="form-label">Nama Depan</label>
                <input type="text" class="form-control" id="nama_depan" name="nama_depan" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="nama_belakang" class="form-label">Nama Belakang</label>
                <input type="text" class="form-control" id="nama_belakang" name="nama_belakang" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="gelar_depan" class="form-label">Gelar Depan (Opsional)</label>
                <input type="text" class="form-control" id="gelar_depan" name="gelar_depan">
            </div>
            <div class="col-md-6 mb-3">
                <label for="gelar_belakang" class="form-label">Gelar Belakang (Opsional)</label>
                <input type="text" class="form-control" id="gelar_belakang" name="gelar_belakang">
            </div>
        </div>
        <div class="mb-3">
            <label for="jabatan" class="form-label">Jabatan</label>
            <select class="form-select" id="jabatan" name="jabatan" required>
                <option value="" disabled selected>-- Pilih Jabatan --</option>
                <option value="Ketua">Ketua</option>
                <option value="Wakil Ketua">Wakil Ketua</option>
                <option value="Anggota">Anggota</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="status_pernikahan" class="form-label">Status Pernikahan</label>
            <select class="form-select" id="status_pernikahan" name="status_pernikahan" required>
                <option value="" disabled selected>-- Pilih Status --</option>
                <option value="Kawin">Kawin</option>
                <option value="Belum Kawin">Belum Kawin</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="jumlah_anak" class="form-label">Jumlah Anak</label>
            <input type="number" class="form-control" id="jumlah_anak" name="jumlah_anak" required min="0" value="0">
        </div>

        <a href="<?= site_url('admin/anggota') ?>" class="btn btn-secondary">Kembali</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
<?= $this->endSection() ?>