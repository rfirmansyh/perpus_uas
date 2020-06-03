<!-- Page Wrapper -->
<div id="wrapper">

<?php $this->view('admin/_layouts/sidebar', $data); ?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

<?php $this->view('admin/_layouts/topbar'); ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Anggota </h1>
        <button data-url="<?= BASE_URL; ?>" data-target="#modal-save" class="btn btn-primary btn-add">Tambah Data</button>
    </div>


    <!-- Content Row -->
    <div class="row">
        <div class="container-fluid px-3">

            <?php Flasher::flash(); ?>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Buku</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-clickable" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Foto</th>
                                    <th>Nama Anggota</th>
                                    <th>No Hp</th>
                                    <th>Status</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                <?php foreach($data['anggota_all'] as $anggota): ?>
                                    <tr class="tr-modal-detail" data-target="#modal-detail" data-id="<?= $anggota['id']; ?>"
                                    data-url="<?= BASE_URL; ?>">
                                        <td><?= ++$i; ?></td>
                                        <td class="text-center"><img width="50px" src="<?= BASE_URL; ?>uploads/<?= ($anggota['gambar'] !== null) ? $anggota['gambar'] : 'image-default-anggota.png'; ?>" alt=""></td>
                                        <td><?= $anggota['nama_lengkap']; ?></td>
                                        <td><?= $anggota['no_hp']; ?></td>
                                        <td><span class="badge badge-<?= ($anggota['nama_status'] === 'Aktif') ? 'success' : 'secondary'; ?>"><?= $anggota['nama_status']; ?></span></td>
                                        <td data-col="action">
                                            <div class="d-flex flex-row justify-content-around">
                                                <button 
                                                    data-id="<?= $anggota['id']; ?>"
                                                    data-target="#modal-password"
                                                    data-url="<?= BASE_URL; ?>"
                                                    class="btn btn-sm btn-outline-danger btn-password">Ubah Password</button>
                                                <button 
                                                    data-target="#modal-save" 
                                                    data-id="<?= $anggota['id']; ?>"
                                                    data-url="<?= BASE_URL; ?>"
                                                    class="btn btn-sm btn-warning btn-update">Ubah Data</button>
                                            </div>
                                        </td>
                                    </tr>    
                                <?php endforeach; ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?php $this->view('admin/_layouts/bottom'); ?>

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>



    <!-- modal -->

    <!-- MODAL DETAIL -->
    <div class="modal fade" id="modal-detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="modal-detail-label">Detail Anggota</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                </div>

                <div class="modal-body">
                    <div class="container-fluid" id="container-modal-detail">

                    </div>
                </div>

                <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Selesai</button>
                </div>
            </div>
        </div>
    </div>


    <!-- MODAL CONFIRM -->
    <div class="modal fade" id="modal-confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="modal-confirm-label">Hapus Data Anggota</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                </div>

                <div class="modal-body">
                    <div class="container-fluid" id="container-modal-confirm">
                        <h5>Anda yakin menghapus Data Anggota Ini ini ?</h5>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-secondary btn-ok">Ya, Hapus</a>
                </div>
            </div>
        </div>
    </div>



    <!-- MODAL ADD  -->
    <div class="modal fade" id="modal-save" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="modal-save-label">Tambah Data Buku</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                </div>

                <div class="modal-body">
                    <div class="container-fluid" id="container-modal-save">
                        <form id="form-save" action="<?= BASE_URL.'admin/buku/tambah/'; ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id_anggota" id="id_anggota">
                            <input type="hidden" name="gambar_anggota_lama" id="gambar_anggota_lama">
                            <div class="form-row">
                                <div class="form-group col-12 d-flex align-items-end">
                                    <div class="bg-light rounded-circle img-profile text-center mr-3 flex-shrink-0" >
                                        <img src="<?= BASE_URL; ?>uploads/image-default-anggota.png" alt="" class="text-xs" id="anggota-upload-image">
                                    </div>
                                    <input type="file" name="gambar" id="anggota-upload">
                                </div>
                                <div class="form-group col-12">
                                    <label for="nama_lengkap">Nama Lengkap :</label>
                                    <input required type="text" class="form-control" id="nama_lengkap" name="nama_lengkap">
                                </div>
                                <div class="form-group col-12">
                                    <label for="nisn">Nisn :</label>
                                    <div class="input-group">
                                        <input required data-url="<?= BASE_URL; ?>"  type="text" class="form-control" id="nisn" name="nisn">
                                        <div class="invalid-feedback d-none" id="invalid-nisn">
                                            Nisn Sudah Ada
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label for="tanggal_masuk">Tanggal Masuk :</label>
                                    <input required type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk">
                                </div>
                                <div class="form-group col-12">
                                    <label for="tanggal_daftar">Tanggal Daftar :</label>
                                    <input required type="date" class="form-control" id="tanggal_daftar" name="tanggal_daftar">
                                </div>
                                <div class="form-group col-12">
                                    <label for="no_hp">Nomor Hp :</label>
                                    <input required type="text" class="form-control" id="no_hp" name="no_hp">
                                </div>
                                <div class="form-group col-12">
                                    <label for="jenis_kelamin_id">Jenis Kelamin :</label>
                                    <select required name="jenis_kelamin_id" title="Pilih Jenis Kelamin" class="selectpicker form-control" id="jenis_kelamin_id" data-style="form-control border" data-size="5" data-live-search="true" data-live-search-placeholder="Cari Rak Lokasi">
                                        <?php foreach($data['jenis_kelamin_all'] as $jenis_kelamin): ?>
                                            <option value="<?= $jenis_kelamin['id']; ?>"><?= $jenis_kelamin['nama_jenis']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group col-12">
                                    <label for="anggota_status_id">Status :</label>
                                    <select required name="anggota_status_id" class="selectpicker form-control" id="anggota_status_id" data-style="form-control border" data-size="5" data-live-search="true" data-live-search-placeholder="Cari Jenis Kategori">
                                        <?php foreach($data['status_all'] as $status): ?>
                                            <option value="<?= $status['id']; ?>"><?= $status['nama_status']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group col-12">
                                    <label for="password">Password :</label>
                                    <input required type="password" class="form-control" id="password" name="password">
                                </div>
                                <div class="form-group col-12">
                                    <label for="password2">Konfirmasi Password :</label>
                                    <input required type="password" class="form-control" id="password2" name="password2">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                        <button class="btn btn-primary" type="submit" id="modal-save-button">Tambahkan</button>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- MODAL PASSWORD  -->
    <div class="modal fade" id="modal-password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="modal-password-label">Ubah Password Anggota ID : </h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                </div>

                <div class="modal-body">
                    <div class="container-fluid" id="container-modal-password">
                        <form id="form-password" action="<?= BASE_URL.'admin/anggota/ubahPassword/'; ?>" method="post">
                            <input type="hidden" name="p_anggota_id" id="p-anggota-id">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <div class="row">
                                        <div class="col-12 col-sm-auto mb-3 mb-sm-0">
                                            <div class="bg-light rounded-circle img-profile" >
                                                <img src="" alt="" id="img_password_change">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm">
                                            <h5 class="font-weight-bolder mb-0 mt-2" id="nama_pengguna_password"></h5>
                                            <p class="font-weight-light" id="nomor_pengguna_password"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label for="new-password">Password Baru :</label>
                                    <input required type="password" class="form-control" id="new-password" name="new-password">
                                </div>
                                <div class="form-group col-12">
                                    <label for="new-password2">Konfirmasi Password Baru :</label>
                                    <input required type="password" class="form-control" id="new-password2" name="new-password2">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                        <button class="btn btn-outline-warning" type="submit"">Ubah Password</button>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>










    <?php $this->view('admin/_layouts/footer/footer_start'); ?>


    <script src="<?= BASE_URL ?>/admin_public/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= BASE_URL ?>/admin_public/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?= BASE_URL ?>/admin_public/js/demo/datatables-demo.js"></script>
    <script src="<?= BASE_URL ?>/admin_public/js/bootstrap-select.min.js"></script>


    <script>

        let template_detail_peminjaman = function(base_url, gambar_anggota, nama_lengkap, nisn, tgl_masuk, tgl_daftar, no_hp, jenis_kelamin, nama_status) {
            let gambar = (gambar_anggota === '' || gambar_anggota === null) ? 'image-default-anggota.png' : gambar_anggota;
            let status_style = (nama_status === 'Aktif') ? 'success' : 'secondary';
            let render = `<div class="row">
                            <div class="form-group col-12 text-right">
                                <label class="text-md">Status :</label>
                                <div class="badge badge-${status_style}">${nama_status}</div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="row">
                                    <div class="col-12 col-sm-auto mb-3 mb-sm-0">
                                        <div class="bg-light rounded-circle img-profile" >
                                            <img src="${base_url}uploads/${gambar}" alt="">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm">
                                        <h5 class="font-weight-bolder mb-0 mt-2" id="nama_pengguna">${nama_lengkap}</h5>
                                        <p class="font-weight-light" id="nomor_pengguna">${no_hp}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <label class="text-md">NISN :</label>
                                <input 
                                    class="form-control" 
                                    type="text"
                                    value="${nisn}" 
                                    readonly>
                            </div>
                            <div class="form-group col-12">
                                <label class="text-md">Tanggal Masuk :</label>
                                <input 
                                    class="form-control" 
                                    type="text" 
                                    value="${date_base_format(tgl_masuk)}"
                                    readonly>
                            </div>
                            <div class="form-group col-12">
                                <label class="text-md">Tanggal Daftar :</label>
                                <input 
                                    class="form-control" 
                                    type="text" 
                                    value="${date_base_format(tgl_daftar)}"
                                    readonly>
                            </div>
                            <div class="form-group col-12">
                                <label class="text-md">Jenis Kelamin :</label>
                                <input 
                                    class="form-control" 
                                    type="text" 
                                    value="${jenis_kelamin}"
                                    readonly>
                            </div>

                        </div>`;
            return render;
        }

        $(document).ready(function() {

            // buku.php

            $('#anggota-upload').on('change', function() {
                uploadFile('#anggota-upload');
            });

            $('#modal-confirm').on('show.bs.modal', function(e) {
                $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            });


            $('.tr-modal-detail').delegate('td:not([data-col="action"])', 'click', function() {
                $($(this).parent().data('target')).modal('show');
                const id = $(this).parent().data('id');
                const base_url = $(this).parent().data('url');
                console.log(base_url+'admin/buku/detail/'+id);
                
                $.ajax({
                    url: base_url+'admin/anggota/detail/'+id,
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        $('#modal-detail-label').html(`Detail Anggota ${data.id}`)
                        $('#container-modal-detail').html(template_detail_peminjaman(base_url, data.gambar, data.nama_lengkap, data.nisn, data.tanggal_masuk, data.tanggal_daftar, data.no_hp, data.nama_jenis, data.nama_status));
                    }
                })
                
            });

            $('.btn-add').on('click', function() {
                let base_url = $(this).data('url')+'admin/anggota/tambah/';
                $($(this).data('target')).modal('show');
                $('#modal-save-label').html('Tambah Data Anggota');
                $('#modal-save-button').html('Tambahkan');
                $('#form-save').attr('action', `${base_url}`);
                $('#password').attr('required', 'true');
                $('#password2').attr('required', 'true');
                $('#password').parent().removeClass('d-none');
                $('#password2').parent().removeClass('d-none');
                clear_input_fields();
            });

            $('.btn-update').on('click', function() {
                const id = $(this).data('id');
                const base_url = $(this).data('url');
                
                $($(this).data('target')).modal('show');
                $('#modal-save-label').html('Ubah Data Anggota');
                $('#modal-save-button').html('Ubah');
                $('#form-save').attr('action', `${base_url}admin/anggota/ubah/`);
                // console.log(id);
                console.log($('#form-save').attr('action'));
                $.ajax({
                    url: base_url+'admin/anggota/detail/'+id,
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        $('#id_anggota').val(data.id);
                        $('#gambar_anggota_lama').val(data.gambar);
                        $('#anggota-upload-image').attr('src', base_url+'/uploads/'+data.gambar);
                        $('#nama_lengkap').val(data.nama_lengkap);
                        $('#nisn').val(data.nisn);
                        $('#tanggal_masuk').val(date_input_format(data.tanggal_masuk));
                        $('#tanggal_daftar').val(date_input_format(data.tanggal_daftar));
                        $('#no_hp').val(data.no_hp);
                        $('#jenis_kelamin_id').selectpicker('val', data.jenis_kelamin_id);
                        $('#jenis_kelamin_id').selectpicker('render');
                        $('#anggota_status_id').selectpicker('val', data.anggota_status_id);
                        $('#anggota_status_id').selectpicker('render');
                        $('#password').removeAttr('required');
                        $('#password2').removeAttr('required');
                        $('#password').parent().addClass('d-none');
                        $('#password2').parent().addClass('d-none');
                    }
                });
            });

            $('.btn-password').on('click', function() {
                const id = $(this).data('id');
                const base_url = $(this).data('url');
                
                $($(this).data('target')).modal('show');
                $.ajax({
                    url: base_url+'admin/anggota/detail/'+id,
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        let gambar_showed = (data.gambar === null || data.gambar === '') ? 'image-default-anggota.png' : data.gambar;
                        $('#p-anggota-id').val(data.id);
                        $('#img_password_change').attr('src', base_url+"uploads/"+gambar_showed);
                        $('#nama_pengguna_password').html(data.nama_lengkap);
                        $('#nomor_pengguna_password').html(data.no_hp);
                    }
                })
            });

            $('#new-password2').on('keyup', function() {
                const new_password = $('#new-password').val();
                const new_password2 = $('#new-password2').val();
                if (new_password !== new_password2) {
                    $('#new-password2').addClass('is-invalid');
                } else {
                    $('#new-password2').removeClass('is-invalid');
                }
            });
            $('#password2').on('keyup', function() {
                const new_password = $('#password').val();
                const new_password2 = $('#password2').val();
                if (new_password !== new_password2) {
                    $('#password2').addClass('is-invalid');
                } else {
                    $('#password2').removeClass('is-invalid');
                }
            });
            $('#nisn').on('keyup', function() {
                const nisn = $(this).val();
                let base_url = $(this).data('url')+"admin/anggota/checkNisn/";
                $.ajax({
                    url: base_url,
                    data: {nisn: nisn},
                    method: 'POST',
                    dataType: 'json',
                    success: function(data) {
                        if (data) {
                            $('#nisn').addClass('is-invalid');
                            $('#invalid-nisn').removeClass('d-none');
                        } else {
                            $('#nisn').removeClass('is-invalid');
                            $('#invalid-nisn').addClass('d-none');
                        }
                    }
                })
            });

        });
    </script>

    <?php $this->view('admin/_layouts/footer/footer_end'); ?>