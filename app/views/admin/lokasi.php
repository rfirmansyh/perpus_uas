
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
                <h1 class="h3 mb-0 text-gray-800">Data Lokasi Rak Buku</h1>
                <button data-url="<?= BASE_URL; ?>" data-target="#modal-save" class="btn btn-primary btn-add">Tambah Data</button>
            </div>

            <!-- Content Row -->
            <div class="row">
                <div class="container-fluid px-3">

                    <?php Flasher::flash(); ?>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Lokasi Rak Buku</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Lokasi</th>
                                            <th>Detail Lokasi</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 0; ?>
                                        <?php foreach($data['lokasi_all'] as $lokasi): ?>
                                            <tr>
                                                <td><?= ++$i; ?></td>
                                                <td><?= $lokasi['nama_lokasi']; ?></td>
                                                <td><?= $lokasi['detail_lokasi']; ?></td>
                                                <td data-col="action">
                                                    <div class="d-flex flex-row justify-content-start">
                                                        <button 
                                                            data-href="<?= BASE_URL.'admin/lokasi/hapus/'.$lokasi['id']; ?>"
                                                            data-toggle="modal"
                                                            data-target="#modal-confirm"
                                                            class="btn btn-sm btn-danger mr-3">Hapus</button>
                                                        <button 
                                                            data-target="#modal-save" data-id="<?= $lokasi['id']; ?>"
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

    <!-- MODAL ADD  -->
    <div class="modal fade" id="modal-save" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="modal-save-label">Tambah Data Kategori</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                </div>

                <div class="modal-body">
                    <div class="container-fluid" id="container-modal-save">
                        <form id="form-save" action="<?= BASE_URL.'admin/kategori/tambah/'; ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="lokasi_id" id="lokasi_id">
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="nama_lokasi">Nama Lokasi :</label>
                                    <div class="input-group">
                                        <input required type="text" class="form-control" id="nama_lokasi" name="nama_lokasi">
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label for="detail_lokasi">Detail Lokasi :</label>
                                    <textarea rows="5" type="text" class="form-control" id="detail_lokasi" name="detail_lokasi"></textarea>
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

    <!-- MODAL CONFIRM -->
    <div class="modal fade" id="modal-confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="modal-confirm-label">Hapus Rak</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                </div>

                <div class="modal-body">
                    <div class="container-fluid" id="container-modal-confirm">
                        <h5>Anda yakin menghapus Rak ini ?</h5>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-secondary btn-ok">Ya, Hapus</a>
                </div>
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

            $('#modal-confirm').on('show.bs.modal', function(e) {
                $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            });

            $('.btn-add').on('click', function() {
                let base_url = $(this).data('url')+'admin/lokasi/tambah/';
                $($(this).data('target')).modal('show');
                $('#modal-save-label').html('Tambah Data Lokasi Rak Buku');
                $('#modal-save-button').html('Tambahkan');
                $('#form-save').attr('action', `${base_url}`);
                clear_input_fields();
            });

            $('.btn-update').on('click', function() {
                const id = $(this).data('id');
                const base_url = $(this).data('url');
                
                $($(this).data('target')).modal('show');
                $('#modal-save-label').html('Ubah Data Lokasi Rak Buku');
                $('#modal-save-button').html('Ubah');
                $('#form-save').attr('action', `${base_url}admin/lokasi/ubah/`);
                // console.log(id);
                console.log($('#form-save').attr('action'));
                $.ajax({
                    url: base_url+'admin/lokasi/detail/'+id,
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        $('#lokasi_id').val(data.id);
                        $('#nama_lokasi').val(data.nama_lokasi);
                        $('#detail_lokasi').val(data.detail_lokasi);
                    }
                });
            });

        });
    </script>

    <?php $this->view('admin/_layouts/footer/footer_end'); ?>