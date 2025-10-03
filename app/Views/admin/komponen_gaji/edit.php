<?= $this->extend('layouts/admin_template') ?>

<?= $this->section('title') ?>
    Edit Komponen Gaji
<?= $this->endSection() ?>

<?= $this->section('page_title') ?>
    Edit Komponen Gaji: <?= esc($komponen['nama_komponen']) ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <form action="<?= site_url('admin/komponen-gaji/' . $komponen['id_komponen']) ?>" method="post">
        <input type="hidden" name="_method" value="PUT">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label for="nama_komponen" class="form-label">Nama Komponen</label>
            <input type="text" class="form-control" id="nama_komponen" name="nama_komponen" value="<?= esc($komponen['nama_komponen']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="kategori" class="form-label">Kategori</label>
            <select class="form-select" id="kategori" name="kategori" required>
                <option value="Tunjangan" <?= ($komponen['kategori'] == 'Tunjangan') ? 'selected' : '' ?>>Tunjangan</option>
                <option value="Biaya" <?= ($komponen['kategori'] == 'Biaya') ? 'selected' : '' ?>>Biaya</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="jabatan" class="form-label">Berlaku Untuk Jabatan</label>
            <select class="form-select" id="jabatan" name="jabatan" required>
                <option value="Semua" <?= ($komponen['jabatan'] == 'Semua') ? 'selected' : '' ?>>Semua</option>
                <option value="Ketua" <?= ($komponen['jabatan'] == 'Ketua') ? 'selected' : '' ?>>Ketua</option>
                <option value="Wakil Ketua" <?= ($komponen['jabatan'] == 'Wakil Ketua') ? 'selected' : '' ?>>Wakil Ketua</option>
                <option value="Anggota" <?= ($komponen['jabatan'] == 'Anggota') ? 'selected' : '' ?>>Anggota</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="nominal" class="form-label">Nominal (Rp)</label>
            <input type="number" class="form-control" id="nominal" name="nominal" value="<?= esc($komponen['nominal']) ?>" required min="0">
        </div>
        <div class="mb-3">
            <label for="satuan" class="form-label">Satuan</label>
            <select class="form-select" id="satuan" name="satuan" required>
                <option value="Per Bulan" <?= ($komponen['satuan'] == 'Per Bulan') ? 'selected' : '' ?>>Per Bulan</option>
                <option value="Per Kegiatan" <?= ($komponen['satuan'] == 'Per Kegiatan') ? 'selected' : '' ?>>Per Kegiatan</option>
                <option value="Per Hari" <?= ($komponen['satuan'] == 'Per Hari') ? 'selected' : '' ?>>Per Hari</option>
            </select>
        </div>

        <a href="<?= site_url('admin/komponen-gaji') ?>" class="btn btn-secondary">Kembali</a>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
<?= $this->endSection() ?>