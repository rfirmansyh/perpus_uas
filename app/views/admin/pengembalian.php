
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
                <h1 class="h3 mb-0 text-gray-800">Data Pengembalian Buku</h1>
                <button data-url="<?= BASE_URL; ?>" data-target="#modal-save" class="btn btn-primary btn-add">Tambah Data</button>
            </div>


            <!-- Content Row -->
            <div class="row">
                <div class="container-fluid px-3">

                    <?php Flasher::flash(); ?>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Pengembalian</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-clickable" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Peminjaman ID</th>
                                            <th>Tanggal Pengembalian</th>
                                            <th>Denda</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 0; ?>
                                        <?php foreach($data['pengembalian_all'] as $pengembalian): ?>
                                            <tr class="tr-modal-detail" data-target="#modal-detail" data-id="<?= $pengembalian['peminjaman_id']; ?>" data-url="<?= BASE_URL; ?>">
                                                <td><?= ++$i; ?></td>
                                                <td><?= $pengembalian['peminjaman_id']; ?></td>
                                                <td><?= Helpers::getIndoDate($pengembalian['tanggal_pengembalian']); ?></td>
                                                <td><?= 'Rp '.$pengembalian['denda']; ?></td>
                                                <td data-col="action">
                                                    <div class="d-flex flex-row justify-content-start">
                                                        <button 
                                                            data-href="<?= BASE_URL.'admin/pengembalian/hapus/'.$pengembalian['id'].'/'.$pengembalian['peminjaman_id']; ?>"
                                                            data-toggle="modal"
                                                            data-target="#modal-confirm"
                                                            class="btn btn-sm btn-danger mr-3">Hapus</button>
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
                            <input type="hidden" name="peminjaman_buku_id" id="peminjaman_buku_id">
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="peminjaman_id">Data Peminjaman :</label>
                                    <select required  name="peminjaman_id" class="selectpicker form-control" id="peminjaman_id" data-url="<?= BASE_URL ?>" data-container="body" data-style="form-control border" data-size="5" data-live-search="true" data-live-search-placeholder="Cari Data Berdasarkan id, Nama, Buku">
                                        <?php foreach($data['peminjaman_all_with'] as $peminjaman): ?>
                                            <option style="word-wrap: break-word; white-space: normal;" value="<?= $peminjaman['id']; ?>"><?= '[ Peminjaman ID  : '.$peminjaman['id'].' ] - '.$peminjaman['judul_buku'].' - '.$peminjaman['nama_lengkap']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>  
                                <div class="form-group col-12">
                                    <label for="tanggal_pengembalian">Tanggal Pengembalian :</label>
                                    <input required type="date" class="form-control" id="tanggal_pengembalian" name="tanggal_pengembalian">
                                </div>
                                
                                <div class="form-group col-12">
                                    <label for="denda">Denda :</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"">Rp.</span>
                                        </div>
                                        <input required type="number" class="form-control" id="denda" name="denda" readonly>
                                        <div class="input-group-append" style="cursor:pointer;">
                                            <span class="input-group-text bg-primary text-white" data-url="<?= BASE_URL; ?>" id="check-denda">Check</span>
                                        </div>
                                    </div>
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
            let gambar = (gambar_anggota === '' || gambar_anggota === null) ? 'image-default-anggota.png' : gambar_anggota ;
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

            $('#check-denda').on('click', function() {
                const base_url = $(this).data('url');
                const peminjaman_id = $('#peminjaman_id').val();
                let tanggal_pengembalian = $('#tanggal_pengembalian').val();

                if ( tanggal_pengembalian !== '' && peminjaman_id !== '' ) {
                    $.ajax({
                        url: base_url+'admin/pengembalian/getTanggalKembaliByPeminjamanId/',
                        data: {id: peminjaman_id},
                        method: 'POST',
                        dataType: 'json',
                        success: function(data) {
                            console.log(data);
                            let tanggal_harus_kembali = new Date(data.tanggal_kembali);
                            let tanggal_dikembalikan = new Date(tanggal_pengembalian);
                            let diff = Math.abs(tanggal_dikembalikan - tanggal_harus_kembali);
                            let diffDays = Math.ceil(diff / (1000 * 60 * 60 * 24));
                            if ( tanggal_dikembalikan > tanggal_harus_kembali ) {
                                $('#denda').val(diffDays * 500);
                            } else {
                                $('#denda').val(0);
                            }
                        }
                    })
                } else {
                    console.log('Data tidak boleh kosong');
                }

            });

            $('.btn-add').on('click', function() {
                let base_url = $(this).data('url')+'admin/pengembalian/tambah/';
                $($(this).data('target')).modal('show');
                $('#modal-save-label').html('Tambah Data Pengembalian');
                $('#modal-save-button').html('Tambahkan');
                $('#form-save').attr('action', `${base_url}`);
                clear_input_fields();
            });

            $('#peminjaman_id').on('change', function() {
                let peminjaman_id = $(this).val();
                let base_url = $(this).data('url');
                $.ajax({
                    url: base_url+'admin/pengembalian/detail/'+peminjaman_id,
                    dataType: 'json',
                    success: function(data) {
                        $('#peminjaman_buku_id').val(data.buku_id);
                        // let tanggal_harus_kembali = new Date(data.tanggal_kembali);
                        // let tanggal_dikembalikan = new Date(tanggal_pengembalian);
                        // let diff = Math.abs(tanggal_dikembalikan - tanggal_harus_kembali);
                        // let diffDays = Math.ceil(diff / (1000 * 60 * 60 * 24));
                        // if ( tanggal_dikembalikan > tanggal_harus_kembali ) {
                        //     $('#denda').val(diffDays * 500);
                        // } else {
                        //     $('#denda').val(0);
                        // }
                    }
                })
            })

            


            $('.btn-update').on('click', function() {
                const id = $(this).data('id');
                const base_url = $(this).data('url');
                
                $($(this).data('target')).modal('show');
                $('#modal-save-label').html('Ubah Data Rak');
                $('#modal-save-button').html('Ubah');
                $('#form-save').attr('action', `${base_url}admin/rak/ubah/`);
                // console.log(id);
                console.log($('#form-save').attr('action'));
                $.ajax({
                    url: base_url+'admin/rak/detail/'+id,
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        $('#rak_id').val(data.id);
                        $('#nama_rak').val(data.nama_rak);
                        $('#lokasi_rak_id').selectpicker('val', data.lokasi_rak_id);
                        $('#lokasi_rak_id').selectpicker('render');
                    }
                });
            });

        });
    </script>

    <?php $this->view('admin/_layouts/footer/footer_end'); ?>