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
        <h1 class="h3 mb-0 text-gray-800">Data Buku </h1>
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
                                    <th>Kode</th>
                                    <th>Judul</th>
                                    <th>Stok</th>
                                    <th>Rak</th>
                                    <th>Kategori</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                <?php foreach($data['buku_all'] as $buku): ?>
                                    <tr class="tr-modal-detail" data-target="#modal-detail" data-id="<?= $buku['id']; ?>"
                                    data-url="<?= BASE_URL; ?>">
                                        <td><?= ++$i; ?></td>
                                        <td><?= $buku['kode_buku']; ?></td>
                                        <td><?= $buku['judul_buku']; ?></td>
                                        <td><?= $buku['stok']; ?></td>
                                        <td><?= $buku['nama_rak']; ?></td>
                                        <td><?= $buku['nama_kategori']; ?></td>
                                        <td data-col="action">
                                            <div class="d-flex flex-row justify-content-around">
                                                <button 
                                                    data-href="<?= BASE_URL.'admin/buku/hapus/'.$buku['id']; ?>"
                                                    data-toggle="modal"
                                                    data-target="#modal-confirm"
                                                    class="btn btn-sm btn-danger">Hapus</button>
                                                <button 
                                                    data-target="#modal-save" data-id="<?= $buku['id']; ?>"
                                                    data-url="<?= BASE_URL; ?>"
                                                    class="btn btn-sm btn-warning btn-update">Ubah</button>
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
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="modal-detail-label">Detail Buku Kode</h5>
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
                <h5 class="modal-title" id="modal-confirm-label">Hapus Buku</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                </div>

                <div class="modal-body">
                    <div class="container-fluid" id="container-modal-confirm">
                        <h5>Anda yakin menghapus buku ini ?</h5>
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
                            <input type="hidden" name="id_buku" id="id_buku">
                            <input type="hidden" name="gambar_buku_lama" id="gambar_buku_lama">
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <div class="w-100 bg-light rounded-lg d-flex align-items-center justify-content-center mb-3" style="min-height: 300px">
                                        <img src="" alt="no image uploaded" class="img-fluid" id="book-upload-image">
                                    </div>
                                    <input type="file" name="gambar" id="book-upload">
                                </div>
                                <div class="form-group col-12">
                                    <label for="kode_buku">Kode Buku :</label>
                                    <div class="input-group">
                                        <input required type="text" class="form-control" id="kode_buku" name="kode_buku">
                                        <div class="invalid-feedback">
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label for="judul_buku">Judul Buku :</label>
                                    <input required type="text" class="form-control" id="judul_buku" name="judul_buku">
                                </div>
                                <div class="form-group col-12">
                                    <label for="overview_buku">Overview Buku :</label>
                                    <textarea rows="5" type="text" class="form-control" id="overview_buku" name="overview_buku"></textarea>
                                </div>
                                <div class="form-group col-12">
                                    <label for="penulis_buku">Penulis Buku :</label>
                                    <input required type="text" class="form-control" id="penulis_buku" name="penulis_buku">
                                </div>
                                <div class="form-group col-12">
                                    <label for="penerbit_buku">Penerbit Buku :</label>
                                    <input required type="text" class="form-control" id="penerbit_buku" name="penerbit_buku">
                                </div>
                                <div class="form-group col-12">
                                    <label for="tanggal_terbit">Tanggal Terbit :</label>
                                    <input required type="date" class="form-control" id="tanggal_terbit" name="tanggal_terbit">
                                </div>
                                <div class="form-group col-12">
                                    <label for="stok">Stok :</label>
                                    <input required type="number" class="form-control" id="stok" name="stok">
                                </div>
                                <div class="form-group col-12">
                                    <label for="rak_id">Rak :</label>
                                    <select required name="rak_id" class="selectpicker form-control" id="rak_id" data-style="form-control border" data-size="5" data-live-search="true" data-live-search-placeholder="Cari Rak Lokasi">
                                        <?php foreach($data['rak'] as $rak): ?>
                                            <option value="<?= $rak['id']; ?>"><?= $rak['nama_rak']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group col-12">
                                    <label for="kategori_buku">Kategori Buku :</label>
                                    <select required name="kategori_buku_id" class="selectpicker form-control" id="kategori_buku_id" data-style="form-control border" data-size="5" data-live-search="true" data-live-search-placeholder="Cari Jenis Kategori">
                                        <?php foreach($data['category_all'] as $category): ?>
                                            <option value="<?= $category['id']; ?>"><?= $category['nama_kategori']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group col-12">
                                    <label for="tanggal_input">Tanggal Input :</label>
                                    <input required type="date" class="form-control" id="tanggal_input" name="tanggal_input">
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










    <?php $this->view('admin/_layouts/footer/footer_start'); ?>


    <script src="<?= BASE_URL ?>/admin_public/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= BASE_URL ?>/admin_public/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?= BASE_URL ?>/admin_public/js/demo/datatables-demo.js"></script>
    <script src="<?= BASE_URL ?>/admin_public/js/bootstrap-select.min.js"></script>


    <script>
        $(document).ready(function() {

            // buku.php

            $('#book-upload').on('change', function() {
                uploadFile('#book-upload');
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
                    url: base_url+'admin/buku/detail/'+id,
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        const date_rise = date_base_format(data.tanggal_terbit);
                        const date_input = date_base_format(data.tanggal_input);
                        console.log(date_input);
                        $('#modal-detail-label').html(`Detail Buku ${data.kode_buku}`)
                        $('#container-modal-detail').html(`
                        <div class="row">
                            <div class="col-12 col-lg-6 mb-3 mb-lg-0">
                                <img src="${base_url}uploads/${data.gambar}" alt="" class="img-fluid">
                            </div>
                            <div class="col">
                                <h3 class="font-weight-bold mb-1">${data.judul_buku}</h3>  
                                <p class="mb-2 text-xs">${data.nama_kategori}</p> 
                                <p>${data.overview_buku}</p>
                            </div>
                        </div>

                        <!-- divider -->
                        <hr class="my-4">

                        <div class="form-row">
                            <div class="form-group col-12 col-lg-6">
                                <label class="text-md">Penerbit :</label>
                                <input 
                                    class="form-control" 
                                    type="text" 
                                    value="${data.penerbit_buku}"
                                    readonly>
                            </div>
                            <div class="form-group col-12 col-lg-6">
                                <label class="text-md">Penulis :</label>
                                <input 
                                    class="form-control" 
                                    type="text" 
                                    value="${data.penulis_buku}"
                                    readonly>
                            </div>
                            <div class="form-group col-12 col-lg-6">
                                <label class="text-md">Tanggal Terbit Buku :</label>
                                <input 
                                    class="form-control" 
                                    type="text" 
                                    value="${date_rise}"
                                    readonly>
                            </div>
                            <div class="form-group col-12 col-lg-6">
                                <label class="text-md">Stok Buku :</label>
                                <input 
                                    class="form-control" 
                                    type="text" 
                                    value="${data.stok}"
                                    readonly>
                            </div>
                            <div class="form-group col-12 col-lg-6">
                                <label class="text-md">Lokasi Rak :</label>
                                <input 
                                    class="form-control" 
                                    type="text" 
                                    value="${data.nama_rak}"
                                    readonly>
                            </div>
                            <div class="form-group col-12 col-lg-6">
                                <label class="text-md">Tanggal Input :</label>
                                <input 
                                    class="form-control" 
                                    type="text" 
                                    value="${date_input}"
                                    readonly>
                            </div>
                        </div>`);
                    }
                })
                
            });

            $('.btn-add').on('click', function() {
                let base_url = $(this).data('url')+'admin/buku/tambah/';
                $($(this).data('target')).modal('show');
                $('#modal-save-label').html('Tambah Data Buku');
                $('#modal-save-button').html('Tambahkan');
                $('#form-save').attr('action', `${base_url}`);
                clear_input_fields();
            });

            $('.btn-update').on('click', function() {
                const id = $(this).data('id');
                const base_url = $(this).data('url');
                
                $($(this).data('target')).modal('show');
                $('#modal-save-label').html('Ubah Data Buku');
                $('#modal-save-button').html('Ubah');
                $('#form-save').attr('action', `${base_url}admin/buku/ubah/`);
                // console.log(id);
                console.log($('#form-save').attr('action'));
                $.ajax({
                    url: base_url+'admin/buku/dataUbah/',
                    data: {id: id},
                    method: 'post',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        console.log(date_input_format(data.tanggal_terbit));
                        $('#id_buku').val(data.id);
                        $('#gambar_buku').val(data.gambar);
                        $('#book-upload-image').attr('src', base_url+'/uploads/'+data['gambar']);
                        $('#kode_buku').val(data.kode_buku);
                        $('#judul_buku').val(data.judul_buku);
                        $('#overview_buku').val(data.overview_buku);
                        $('#penulis_buku').val(data.penulis_buku);
                        $('#penerbit_buku').val(data.penerbit_buku);
                        $('#tanggal_terbit').val(date_input_format(data.tanggal_terbit));
                        $('#stok').val(data.stok);
                        $('#rak_id').selectpicker('val', data.rak_id);
                        $('#rak_id').selectpicker('render');
                        $('#kategori_buku_id').selectpicker('val', data.kategori_id);
                        $('#kategori_buku_id').selectpicker('render');
                        $('#tanggal_input').val(date_input_format(data.tanggal_input));

                        // $('#stok').val(data.stok);
                        // const date_input = date_base_format(data.tanggal_input);
                        // console.log(date_input);
                    }
                });
            });


        });
    </script>

    <?php $this->view('admin/_layouts/footer/footer_end'); ?>