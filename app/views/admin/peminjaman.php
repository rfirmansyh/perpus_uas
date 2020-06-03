
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
                <h1 class="h3 mb-0 text-gray-800">Data Peminjaman Buku</h1>
                <button data-url="<?= BASE_URL; ?>" data-target="#modal-save" class="btn btn-primary btn-add">Tambah Data</button>
            </div>


            <!-- Content Row -->
            <div class="row">
                <div class="container-fluid px-3">

                    <?php Flasher::flash(); ?>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Peminjaman</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-clickable" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Peminjam</th>
                                            <th>Buku Yang Dipinjam</th>
                                            <th>Tanggal Pinjam</th>
                                            <th>Tanggal Kembali</th>
                                            <th>Status</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 0; ?>
                                        <?php foreach($data['peminjaman_all'] as $peminjaman): ?>
                                            <tr class="tr-modal-detail" data-target="#modal-detail" data-id="<?= $peminjaman['id']; ?>"
                                    data-url="<?= BASE_URL; ?>">
                                                <td><?= ++$i; ?></td>
                                                <td><?= $peminjaman['nama_lengkap']; ?></td>
                                                <td><?= $peminjaman['judul_buku']; ?></td>
                                                <td><?= $peminjaman['tanggal_pinjam']; ?></td>
                                                <td><?= $peminjaman['tanggal_kembali']; ?></td>
                                                <td><?= $peminjaman['nama_status']; ?></td>
                                                <td data-col="action">
                                                    <div class="d-flex flex-row justify-content-start">
                                                        <button 
                                                            data-href="<?= BASE_URL.'admin/peminjaman/hapus/'.$peminjaman['id'].'/'.$peminjaman['buku_id']; ?>"
                                                            data-toggle="modal"
                                                            data-target="#modal-confirm"
                                                            class="btn btn-sm btn-danger mr-3">Hapus</button>
                                                        <button 
                                                            data-target="#modal-save" data-id="<?= $peminjaman['id']; ?>"
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
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="modal-detail-label">Detail Peminjaman</h5>
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

    <!-- MODAL ADD  -->
    <div class="modal fade" id="modal-save" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="modal-save-label">Tambah Data Pengembalian</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                </div>

                <div class="modal-body">
                    <div class="container-fluid" id="container-modal-save">
                        <form id="form-save" action="<?= BASE_URL.'admin/pengembalian/tambah/'; ?>" method="post">
                            <input type="hidden" name="buku_old_id" id="buku_old_id">
                            <input type="hidden" name="peminjaman_id" id="peminjaman_id">
                            <div class="form-row">

                                <div class="form-group col-12">
                                    <label for="buku_id">Data Buku :</label>
                                    <select required  name="buku_id" class="selectpicker form-control" id="buku_id" data-container="body" data-style="form-control border" data-size="5" data-live-search="true" data-live-search-placeholder="Cari Data Berdasarkan id, Nama">
                                        <?php foreach($data['buku_available_all'] as $buku): ?>
                                            <option style="word-wrap: break-word; white-space: normal;" value="<?= $buku['id']; ?>"><?= '[ Buku ID  : '.$buku['id'].' ] - '.$buku['judul_buku'].' - Sisa : '.$buku['stok']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>  
                                <div class="form-group col-12">
                                    <label for="anggota_id">Data Anggota :</label>
                                    <select required  name="anggota_id" class="selectpicker form-control" id="anggota_id" data-container="body" data-style="form-control border" data-size="5" data-live-search="true" data-live-search-placeholder="Cari Data Berdasarkan id, Nama, Buku">
                                        <?php foreach($data['anggota_active_all'] as $anggota): ?>
                                            <option style="word-wrap: break-word; white-space: normal;" value="<?= $anggota['id']; ?>"><?= '[ Anggota ID  : '.$anggota['id'].' ] - '.$anggota['nama_lengkap']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div> 
                                <div class="form-group col-12">
                                    <label for="tanggal_pinjam">Tanggal Pinjam :</label>
                                    <input required type="date" class="form-control" id="tanggal_pinjam" name="tanggal_pinjam">
                                </div>
                                <div class="form-group col-12">
                                    <label for="tanggal_kembali">Tanggal Kembali :</label>
                                    <input required type="date" class="form-control" id="tanggal_kembali" name="tanggal_kembali">
                                </div>
                                <div class="form-group col-12">
                                    <label for="anggota_id">Data Petugas :</label>
                                    <select required  name="petugas_id" class="selectpicker form-control" id="petugas_id" data-container="body" data-style="form-control border" data-size="5" data-live-search="true" data-live-search-placeholder="Cari Data Berdasarkan id, Nama, Buku">
                                        <?php foreach($data['petugas_active_all'] as $petugas): ?>
                                            <option style="word-wrap: break-word; white-space: normal;" value="<?= $petugas['id']; ?>"><?= '[ Petugas ID  : '.$petugas['id'].' ] - '.$petugas['nama_lengkap']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
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

        let template_detail_peminjaman = function(base_url, gambar_anggota, nama_anggota, no_anggota, tgl_pinjam, tgl_kembali, buku, nama_status, nama_petugas, no_petugas) {
            let gambar = (gambar_anggota === '' || gambar_anggota === null) ? 'image-default-anggota.png' : gambar_anggota;
            let status_style = (nama_status === 'Selesai') ? 'success' : 'secondary';
            let render = `<div class="row">
                            <div class="form-group col-12 text-right">
                                <label class="text-md">Status :</label>
                                <div class="badge badge-${status_style}">${nama_status}</div>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="text-md font-weight-bolder">Peminjam :</label>
                                <div class="row">
                                    <div class="col-12 col-sm-auto mb-3 mb-sm-0">
                                        <div class="bg-light rounded-circle img-profile" >
                                            <img src="${base_url}uploads/${gambar}" alt="">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm">
                                        <h5 class="font-weight-bolder mb-0 mt-2" id="nama_pengguna">${nama_anggota}</h5>
                                        <p class="font-weight-light" id="nomor_pengguna">${no_anggota}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <label class="text-md">Tanggal Pinjam :</label>
                                <input 
                                    class="form-control" 
                                    type="text"
                                    value="${tgl_pinjam}" 
                                    readonly>
                            </div>
                            <div class="form-group col-12">
                                <label class="text-md">Tanggal Harus Dikembalikan :</label>
                                <input 
                                    class="form-control" 
                                    type="text" 
                                    value="${tgl_kembali}"
                                    readonly>
                            </div>
                            <div class="form-group col-12">
                                <label class="text-md">Buku Yang Dipinjam :</label>
                                <input 
                                    class="form-control" 
                                    type="text" 
                                    value="${buku}"
                                    readonly>
                            </div>
                            <div class="form-group col-12">
                                <label class="text-md">Petugas :</label>
                                <input 
                                    class="form-control" 
                                    type="text" 
                                    value="${nama_petugas}"
                                    readonly>
                            </div>
                            <div class="form-group col-12">
                                <label class="text-md">Nomor Hp Petugas :</label>
                                <input 
                                    class="form-control" 
                                    type="text" 
                                    value="${no_petugas}"
                                    readonly>
                            </div>

                        </div>`;
            return render;
        }


        $(document).ready(function() {

            $('.tr-modal-detail').delegate('td:not([data-col="action"])', 'click', function() {
                $($(this).parent().data('target')).modal('show');
                const id = $(this).parent().data('id');
                const base_url = $(this).parent().data('url');
                console.log(base_url+'admin/buku/detail/'+id);
                
                $.ajax({
                    url: base_url+'admin/pengembalian/detail/'+id,
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        const date_borrow = date_base_format(data.tanggal_pinjam);
                        const date_back = date_base_format(data.tanggal_kembali);
                        $('#modal-detail-label').html(`Detail Peminjaman ID : ${data.id}`);
                        $('#container-modal-detail').html(template_detail_peminjaman(base_url, data.gambar, data.nama_anggota, data.anggota_nomor, date_borrow, date_back, data.judul_buku, data.nama_status, data.nama_petugas, data.petugas_nomor));
                    }
                })
                
            });

            $('#modal-confirm').on('show.bs.modal', function(e) {
                $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            });


            $('.btn-add').on('click', function() {
                let base_url = $(this).data('url')+'admin/peminjaman/tambah/';
                $($(this).data('target')).modal('show');
                $('#modal-save-label').html('Tambah Data Peminjaman');
                $('#modal-save-button').html('Tambahkan');
                $('#form-save').attr('action', `${base_url}`);
                clear_input_fields();
            });

            


            $('.btn-update').on('click', function() {
                const id = $(this).data('id');
                const base_url = $(this).data('url');
                console.log("tes");
                
                $($(this).data('target')).modal('show');
                $('#modal-save-label').html('Ubah Data Peminjaman');
                $('#modal-save-button').html('Ubah');
                $('#form-save').attr('action', `${base_url}admin/peminjaman/ubah/`);
                // console.log(id);
                console.log($('#form-save').attr('action'));
                $.ajax({
                    url: base_url+'admin/peminjaman/detail/'+id,
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        $('#buku_old_id').val(data.buku_id);
                        $('#peminjaman_id').val(data.id);
                        $('#buku_id').selectpicker('val', data.buku_id);
                        $('#buku_id').selectpicker('render');
                        $('#anggota_id').selectpicker('val', data.anggota_id);
                        $('#anggota_id').selectpicker('render');
                        $('#tanggal_pinjam').val(date_input_format(data.tanggal_pinjam));
                        $('#tanggal_kembali').val(date_input_format(data.tanggal_kembali));
                        $('#petugas_id').selectpicker('val', data.petugas_id);
                        $('#petugas_id').selectpicker('render');
                    }
                });
            });

        });
    </script>

    <?php $this->view('admin/_layouts/footer/footer_end'); ?>