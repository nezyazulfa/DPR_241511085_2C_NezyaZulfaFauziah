<?= $this->extend('layouts/admin_template') ?>

<?= $this->section('title') ?>
    Tambah Data Penggajian
<?= $this->endSection() ?>

<?= $this->section('page_title') ?>
    Tambah Data Penggajian Baru
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <?php 
    if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger" role="alert">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="id_anggota_select" class="form-label">1. Pilih Anggota</label>
                <select class="form-select" id="id_anggota_select" required>
                    <option selected disabled value="">-- Pilih Anggota --</option>
                    <?php foreach ($anggota as $item) : ?>
                        <option value="<?= $item['id_anggota'] ?>" data-jabatan="<?= $item['jabatan'] ?>">
                            <?= esc($item['nama_depan'] . ' ' . $item['nama_belakang']) ?> (<?= esc($item['jabatan']) ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>

    <form action="<?= site_url('admin/penggajian') ?>" method="post">
        <?= csrf_field() ?>
        
        <input type="hidden" id="id_anggota_form" name="id_anggota" required>
        <input type="hidden" name="tanggal_penggajian" value="<?= date('Y-m-d') ?>">

        <div id="komponen_gaji_container" class="mt-4" style="display: none;">
            <h5>2. Pilih Komponen Gaji</h5>
            <div id="komponen_gaji_list" class="table-responsive">
                <p class="text-muted">Silakan pilih Anggota DPR terlebih dahulu.</p>
            </div>
             <p class="text-danger mt-1" id="komponen_error_status" style="display:none;">Anda harus memilih minimal satu komponen gaji.</p>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Simpan Penggajian</button>
        <a href="<?= site_url('admin/penggajian') ?>" class="btn btn-secondary mt-3">Kembali</a>
    </form>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Event listener saat pilihan anggota berubah
        $('#id_anggota_select').change(function() {
            var idAnggota = $(this).val();
            var jabatan = $(this).find(':selected').data('jabatan');
            var csrfToken = $('input[name="<?= csrf_token() ?>"]').val();

            if (idAnggota) { 
                $('#id_anggota_form').val(idAnggota);
                
                $('#komponen_gaji_list').html('<p class="text-muted">Memuat komponen gaji...</p>');
                $('#komponen_gaji_container').show();
                $('#komponen_error_status').hide();

                $.ajax({
                    url: "<?= site_url('admin/penggajian/get-komponen') ?>", 
                    type: 'POST',
                    data: {
                        'jabatan': jabatan,
                        '<?= csrf_token() ?>': csrfToken
                    },
                    dataType: 'json',
                    success: function(response) {
                        var html = '';
                        if (response.length > 0) {
                            html += '<table class="table table-bordered table-sm">';
                            html += '<thead><tr><th>Pilih</th><th>Nama Komponen</th><th>Kategori</th><th>Nominal</th></tr></thead>';
                            html += '<tbody>';

                            response.forEach(function(item) {
                                html += '<tr>';
                                html += '<td><input class="form-check-input" type="checkbox" name="id_komponen[]" value="' + item.id_komponen + '"></td>';
                                html += '<td>' + item.nama_komponen + '</td>';
                                html += '<td>' + item.kategori + '</td>';
                                html += '<td>Rp ' + new Intl.NumberFormat('id-ID').format(item.nominal) + '</td>';
                                html += '</tr>';
                            });

                            html += '</tbody></table>';
                        } else {
                            html = '<p class="text-muted">Tidak ada komponen gaji yang sesuai untuk jabatan ini.</p>';
                        }
                        $('#komponen_gaji_list').html(html);
                    },
                    error: function(xhr) {
                         let errorMsg = `Gagal memuat komponen gaji. (Error Status: ${xhr.status})`;
                         $('#komponen_gaji_list').html(`<p class="text-danger">${errorMsg}</p>`);
                    }
                });
            } else {
                $('#komponen_gaji_container').hide();
                $('#id_anggota_form').val('');
            }
        });
        
        // VALIDASI SUBMIT: Memastikan minimal ada satu komponen gaji yang dipilih
        $('form').submit(function(e) {
            if ($('input[name="id_komponen[]"]:checked').length === 0) {
                e.preventDefault();
                $('#komponen_error_status').show();
                $('html, body').animate({
                    scrollTop: $("#komponen_gaji_container").offset().top - 50
                }, 500);
            } else {
                $('#komponen_error_status').hide();
            }
        });
    });
</script>
<?= $this->endSection() ?>