<?= $this->extend('public/template') ?>

<?= $this->section('content') ?>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID Anggota</th>
                    <th>Nama Lengkap</th>
                    <th>Jabatan</th>
                    <th>Status Pernikahan</th>
                    <th>Jumlah Anak</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($anggota)): ?>
                    <tr>
                        <td colspan="5" class="text-center">Belum ada data anggota.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach($anggota as $item): ?>
                    <tr>
                        <td><?= esc($item['id_anggota']) ?></td>
                        <td>
                            <?= esc(trim($item['gelar_depan'] . ' ' . $item['nama_depan'] . ' ' . $item['nama_belakang'] . ', ' . $item['gelar_belakang'], ', ')) ?>
                        </td>
                        <td><?= esc($item['jabatan']) ?></td>
                        <td><?= esc($item['status_pernikahan']) ?></td>
                        <td><?= esc($item['jumlah_anak']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
<?= $this->endSection() ?>