<?php

include 'database.php';

if (isset($_SESSION['no_user'])) {
  header("location:index.php");
  exit;
}

if (isset($_POST['login'])) {
  $email = $_POST['email'];
  $pass  = $_POST['pass'];

  $result = mysqli_query($db, "SELECT users.*,pegawai.nm_pegawai,pegawai.id_pegawai FROM users JOIN pegawai ON users.id_pegawai=pegawai.id_pegawai WHERE users.email='$email' ");

  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    if (password_verify($pass, $row['password'])) {
      $_SESSION['no_user'] = $row['no'];
      $_SESSION['nama'] = $row['nm_pegawai'];
      $_SESSION['email'] = $row['email'];
      $_SESSION['level'] = $row['level'];
      $_SESSION['password'] = $row['password'];
      $_SESSION['level'] = $row['level'];
      $_SESSION['id_pegawai'] = $row['id_pegawai'];

      echo "<script>window.location='index.php'</script>";
    } else {
      echo "<script>alert('Login Anda Gagal!')</script>";
      echo "<script>window.location='login.php'</script>";
    }
  }
}


?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="asets/dist/img/logomykoma.png" type="image/ico" />
  <title>MyKoma | Inventory</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="asets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="asets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="asets/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="login.php"><img src="asets/dist/img/logomykoma.png" alt="Mykoma Logo"></a>
    </div>
    <?php
    // fungsi untuk menampilkan pesan
    // jika alert = "" (kosong)
    // tampilkan pesan "" (kosong)
    if (empty($_GET['alert'])) {
      echo "";
    }
    // jika alert = 1
    // tampilkan pesan Gagal "Username atau Password salah, cek kembali Username dan Password Anda"
    elseif ($_GET['alert'] == 1) {
      echo "<div class='alert alert-danger'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4>  <i class='icon fa fa-times-circle'></i> Gagal Login!</h4>
                Email atau Password salah, cek kembali Email dan Password Anda.
              </div>";
    }
    // jika alert = 2
    // tampilkan pesan Sukses "Anda telah berhasil logout"
    elseif ($_GET['alert'] == 2) {
      echo "<div class='alert alert-success'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
                Anda telah berhasil logout.
              </div>";
    } elseif ($_GET['alert'] == 3) {
      echo "<div class='alert alert-info'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <i class='icon fas fa-info'></i>
                Silahkan Login Terlebih Dahulu!
              </div>";
    }
    ?>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Form Login </p>

        <form method="POST">
          <div class="input-group mb-3">
            <input type="email" class="form-control" name="email" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="pass" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="asets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="asets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="asets/dist/js/adminlte.min.js"></script>

</body>

</html>