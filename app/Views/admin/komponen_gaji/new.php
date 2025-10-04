<?= $this->extend('layouts/admin_template') ?>

<?= $this->section('title') ?>
    Tambah Komponen Gaji
<?= $this->endSection() ?>

<?= $this->section('page_title') ?>
    Tambah Komponen Gaji Baru
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <form action="<?= site_url('admin/komponen-gaji') ?>" method="post">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label for="nama_komponen" class="form-label">Nama Komponen</label>
            <input type="text" class="form-control" id="nama_komponen" name="nama_komponen" required>
        </div>
        <div class="mb-3">
            <label for="kategori" class="form-label">Kategori</label>
            <select class="form-select" id="kategori" name="kategori" required>
                <option value="" disabled selected>-- Pilih Kategori --</option>
                <option value="Tunjangan">Tunjangan</option>
                <option value="Biaya">Biaya</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="jabatan" class="form-label">Berlaku Untuk Jabatan</label>
            <select class="form-select" id="jabatan" name="jabatan" required>
                <option value="" disabled selected>-- Pilih Jabatan --</option>
                <option value="Semua">Semua</option>
                <option value="Ketua">Ketua</option>
                <option value="Wakil Ketua">Wakil Ketua</option>
                <option value="Anggota">Anggota</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="nominal" class="form-label">Nominal (Rp)</label>
            <input type="number" class="form-control" id="nominal" name="nominal" required min="0">
        </div>
        <div class="mb-3">
            <label for="satuan" class="form-label">Satuan</label>
            <select class="form-select" id="satuan" name="satuan" required>
                <option value="" disabled selected>-- Pilih Satuan --</option>
                <option value="Per Bulan">Per Bulan</option>
                <option value="Per Kegiatan">Per Kegiatan</option>
                <option value="Per Hari">Per Hari</option>
            </select>
        </div>

        <a href="<?= site_url('admin/komponen-gaji') ?>" class="btn btn-secondary">Kembali</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
<?= $this->endSection() ?>