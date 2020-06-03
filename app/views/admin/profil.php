
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
                <h1 class="h3 mb-0 text-gray-800">Profil Saya</h1>
            </div>

            <div>
                <?php Flasher::flash(); ?>
            </div>
            
            <!-- Content Row -->
            <div class="row">

                <div class="col-xl-4 col-lg-5">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Foto</h6>
                            <button class="btn btn-outline-secondary" id="btn-update-foto">Ubah Foto</button>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <img data-url="<?= BASE_URL; ?>" src="<?= BASE_URL.'uploads/'.$data['profile']['gambar']; ?>" alt="" class="img-fluid" id="profil-upload-image">
                            <form action="<?= BASE_URL.'admin/profil/updateImage/' ?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?= $data['profile']['id'] ?>">
                                <input type="hidden" name="gambar_lama" value="<?= $data['profile']['gambar'] ?>">
                                <div class="form-row d-none" id="hidden-foto">
                                    <div class="form-group col-12">
                                        <input type="file"  id="profil-upload" name="gambar" class="mb-2">
                                    </div>
                                    <div class="col-12 d-flex justify-content-end mt-4">
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    </div>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Area Chart -->
                <div class="col-xl-8 col-lg-7">

                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Data Profil</h6>
                        <button class="btn btn-outline-secondary" id="btn-update-profil">Ubah Profil</button>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <form action="<?= BASE_URL.'admin/profil/updateProfil/' ?>" method="post">
                        <input type="hidden" name="id" value="<?= $data['profile']['id'] ?>" readonly="true">
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="nama_lengkap">Nama Lengkap :</label>
                                <input readonly="true" type="text" class="form-control" data-current="<?= $data['profile']['nama_lengkap'] ?>" value="<?= $data['profile']['nama_lengkap'] ?>" id="nama_lengkap" name="nama_lengkap">
                            </div>
                            <div class="form-group col-12">
                                <label for="username">Username :</label>
                                <div class="input-group">
                                    <input readonly="true" data-url="<?= BASE_URL; ?>"  type="text" data-current="<?= $data['profile']['username'] ?>" value="<?= $data['profile']['username'] ?>" class="form-control" id="username" name="username">
                                    <div class="invalid-feedback d-none" id="invalid-username">
                                        Username Sudah Ada
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <label for="no_hp">Nomor Hp :</label>
                                <input readonly="true" type="text" class="form-control" data-current="<?= $data['profile']['no_hp'] ?>" value="<?= $data['profile']['no_hp'] ?>" id="no_hp" name="no_hp">
                            </div>
                            <div class="col-12 justify-content-end d-none" id="hidden-profil">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </div>
                        </form>
                        
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Password</h6>
                        <button class="btn btn-outline-secondary" id="btn-update-password">Ubah Password</button>
                    </div>
                    <div class="card-body">
                        <form action="<?= BASE_URL.'admin/profil/updatePassword/' ?>" method="post">
                        <input type="hidden" name="id" value="<?= $data['profile']['id'] ?>">
                        <div class="form-row d-none" id="hidden-password">
                            <div class="form-group col-12">
                                <label for="new-password">Password Baru :</label>
                                <input required type="password" class="form-control" id="new-password" name="new-password">
                            </div>
                            <div class="form-group col-12">
                                <label for="new-password2">Konfirmasi Password Baru :</label>
                                <input required type="password" class="form-control" id="new-password2" name="new-password2">
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>

                </div>

                <!-- Pie Chart -->
                
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

        



    <?php $this->view('admin/_layouts/footer/footer_start'); ?>


    <script>
        $(document).ready(function() {
            $('#profil-upload').on('change', function() {
                uploadFile('#profil-upload');
            });

            $('#btn-update-foto').on('click', function() {
                $('#hidden-foto').toggleClass('d-none');
                $(this).html(function(idx,txt) {
                    return txt === 'Ubah Foto' ? 'Batal' : 'Ubah Foto';
                });
                $('#profil-upload-image').attr('src', `${$('#profil-upload-image').data('url')}uploads/${$('input[name="gambar_lama"]').val()}`);
                $('#profil-upload').on('change', function() {
                    uploadFile('#profil-upload');
                });
            })
            $('#btn-update-profil').on('click', function() {
                
                $(this).html(function(idx,txt) {
                    return txt === 'Ubah Profil' ? 'Batal' : 'Ubah Profil';
                })

                $('#hidden-profil').toggleClass('d-flex');
                $('input').prop('readonly', function(index, attr){
                    return attr === false ? true : false;
                });
                $('#nama_lengkap').val($('#nama_lengkap').data('current'));
                $('#username').val($('#username').data('current'));
                $('#no_hp').val($('#no_hp').data('current'));
            })
            $('#btn-update-password').on('click', function() {
                $('#hidden-password').toggleClass('d-none');
                $(this).html(function(idx,txt) {
                    return txt === 'Ubah Password' ? 'Batal' : 'Ubah Password';
                });
                $('input[type="password"]').val('');
            })
            $('#username').on('keyup', function() {
                const current = $(this).data('current');
                const username = $(this).val();
                let base_url = $(this).data('url')+"admin/petugas/checkUsername/";
                console.log(username);
                $.ajax({
                    url: base_url,
                    data: {username: username},
                    method: 'POST',
                    dataType: 'json',
                    success: function(data) {
                        if (data && (username !== current)) {
                            $('#username').addClass('is-invalid');
                            $('#invalid-username').removeClass('d-none');
                        } else {
                            $('#username').removeClass('is-invalid');
                            $('#invalid-username').addClass('d-none');
                        }
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
        });
    </script>

    <?php $this->view('admin/_layouts/footer/footer_end'); ?>