<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Admin - <?= $data['title']; ?></title>

  <!-- Custom fonts for this template-->
  <link href="<?= BASE_URL ?>/admin_public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="<?= BASE_URL ?>/admin_public/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-lg-6">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-12">
                <div class="p-4 p-sm-5">
                  <div style="width: 180px; object-fit:cover; overflow: hidden" class="mx-auto my-4 mb-5">
                    <img src="<?= BASE_URL.'img/logo.png' ?>" alt="" class="img-fluid">
                  </div>
                  <div>
                    <?php Flasher::flash(); ?>
                  </div>
                  <form action="<?= BASE_URL.'admin/login/do/'; ?>" method="post">
                    <div class="form-group">
                      <input type="text" class="form-control" value="<?= (isset($_SESSION['username'])) ? $_SESSION['username'] : ''?>" id="username" name="username" aria-describedby="emailHelp" placeholder="Username...">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>

                    <button type="submit" class="btn btn-block btn-primary">Login</button>
                    

                  </form>
                    
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?= BASE_URL ?>/admin_public/vendor/jquery/jquery.min.js"></script>
  <script src="<?= BASE_URL ?>/admin_public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= BASE_URL ?>/admin_public/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= BASE_URL ?>/admin_public/js/sb-admin-2.min.js"></script>

</body>

</html>
