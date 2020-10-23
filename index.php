<?php

include 'database.php';

if (empty($_SESSION['no_user'])) {
  header('Location:login.php?alert=3');
}

if (isset($_GET['aksi'])) {
  if ($_GET['aksi'] == 'logout') {

    session_destroy();

    header('Location:login.php?alert=2');
  }
}

date_default_timezone_set('Asia/Jakarta');

function rupiah($angka)
{
  $hasil_rupiah = "Rp." . number_format($angka, 0, '.', '.');
  return $hasil_rupiah;
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
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="asets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="asets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="asets/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="asets/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="asets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="asets/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="asets/plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="asets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="asets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <style>
    .color-palette {
      height: 35px;
      line-height: 35px;
      text-align: right;
      padding-right: .75rem;
    }

    .color-palette.disabled {
      text-align: center;
      padding-right: 0;
      display: block;
    }

    .color-palette-set {
      margin-bottom: 15px;
    }

    .color-palette span {
      display: none;
      font-size: 12px;
    }

    .color-palette:hover span {
      display: block;
    }

    .color-palette.disabled span {
      display: block;
      text-align: left;
      padding-left: .75rem;
    }

    .color-palette-box h4 {
      position: absolute;
      left: 1.25rem;
      margin-top: .75rem;
      color: rgba(255, 255, 255, 0.8);
      font-size: 12px;
      display: block;
      z-index: 7;
    }
  </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark navbar-light">
      <!-- Left navbar links -->

      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <!-- Notifications Dropdown Menu -->

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
            <?php if (empty($_SESSION['no_user'])) {
              echo "";
            } else {
              echo $_SESSION['level'];
            } ?>
          </a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#"><i class="fa fa-key"></i> Ganti Password</a>
            <a class="dropdown-item" href="index.php?aksi=logout"><i class="fa fa-sign-out-alt"></i> Log Out</a>
          </div>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="asets/dist/img/logomykoma.png" alt="Mykoma Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Mykoma Inventory</span>
      </a>

      <!-- Sidebar -->
      <?php include 'sidebar/side.php'; ?>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      <!-- Main content -->

      <?php
      if (isset($_GET['page'])) {
        if ($_GET['page'] == 'pgw') {
          include 'modules/pegawai/view.php';
        } elseif ($_GET['page'] == 'tampgw') {
          include 'modules/pegawai/tambah.php';
        } elseif ($_GET['page'] == 'edtpgw') {
          include 'modules/pegawai/ubah.php';
        } elseif ($_GET['page'] == 'suplier') {
          include 'modules/suplier/view.php';
        } elseif ($_GET['page'] == 'tamsuplier') {
          include 'modules/suplier/tambah.php';
        } elseif ($_GET['page'] == 'editsupli') {
          include 'modules/suplier/edit.php';
        } elseif ($_GET['page'] == 'bahanbk') {
          include 'modules/bahanbk/view.php';
        } elseif ($_GET['page'] == 'tambahanbk') {
          include 'modules/bahanbk/tambah.php';
        } elseif ($_GET['page'] == 'editbahanbk') {
          include 'modules/bahanbk/edit.php';
        } elseif ($_GET['page'] == 'kategori') {
          include 'modules/kategori/view.php';
        } elseif ($_GET['page'] == 'tambahktgr') {
          include 'modules/kategori/tambah.php';
        } elseif ($_GET['page'] == 'editktgr') {
          include 'modules/kategori/edit.php';
        } elseif ($_GET['page'] == 'menu') {
          include 'modules/menu/view.php';
        } elseif ($_GET['page'] == 'tammenu') {
          include 'modules/menu/tambah.php';
        } elseif ($_GET['page'] == 'editmenu') {
          include 'modules/menu/edit.php';
        } elseif ($_GET['page'] == 'resep') {
          include 'modules/resep/view.php';
        } elseif ($_GET['page'] == 'tamresep') {
          include 'modules/resep/tambah.php';
        } elseif ($_GET['page'] == 'viewrs') {
          include 'modules/resep/viewrs.php';
        } elseif ($_GET['page'] == 'pembelian') {
          include 'modules/pembelian/view.php';
        } elseif ($_GET['page'] == 'tambeli') {
          include 'modules/pembelian/tambah.php';
        } elseif ($_GET['page'] == 'detailbl') {
          include 'modules/pembelian/detail.php';
        } elseif ($_GET['page'] == 'pengambilan') {
          include 'modules/pengambilan/view.php';
        } elseif ($_GET['page'] == 'ambil') {
          include 'modules/pengambilan/tambah.php';
        } elseif ($_GET['page'] == 'detambil') {
          include 'modules/pengambilan/detail.php';
        } elseif ($_GET['page'] == 'ceklapmenu') {
          include 'modules/lapmenu/view.php';
        } elseif ($_GET['page'] == 'ceklapbeli') {
          include 'modules/lapbeli/view.php';
        } elseif ($_GET['page'] == 'beranda') {
          include 'modules/beranda/view.php';
        }
      } else {
        include 'modules/beranda/view.php';
      }


      ?>
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong><?php echo "Copyright © " . (int)date('Y') . " Waryuni"; ?></strong>
    </footer>

  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="asets/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="asets/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="asets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="asets/plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="asets/plugins/sparklines/sparkline.js"></script>

  <!-- jQuery Knob Chart -->
  <script src="asets/plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="asets/plugins/moment/moment.min.js"></script>
  <script src="asets/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="asets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="asets/plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="asets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="asets/dist/js/adminlte.js"></script>
  <!-- DataTables -->
  <script src="asets/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="asets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="asets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="asets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <!-- bs-custom-file-input -->
  <script src="asets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
</body>

</html>
<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
      "oLanguage": {
        "sSearch": "Cari:",
        "sZeroRecords": "Tidak Menemukan Data Yang Dicari",
        "sEmptyTable": "Tidak Ada Data",
        "sInfo": "Menampilkan_START_ Sampai _END_ Dari _TOTAL_ Data",
        "sInfoEmpty": "Menampilkan 0 Sampai 0 Dari 0 Data",
        "sInfoFiltered": "(Filter Dari _MAX_ total Data)",
        "sLengthMenu": "Tampilkan _MENU_ Data",

      }
    });
    $("#example3").DataTable({
      "responsive": true,
      "autoWidth": false,
      "oLanguage": {
        "sSearch": "Cari:",
        "sZeroRecords": "Tidak Menemukan Data Yang Dicari",
        "sEmptyTable": "Tidak Ada Data",
        "sInfo": "Menampilkan_START_ Sampai _END_ Dari _TOTAL_ Data",
        "sInfoEmpty": "Menampilkan 0 Sampai 0 Dari 0 Data",
        "sInfoFiltered": "(Filter Dari _MAX_ total Data)",
        "sLengthMenu": "Tampilkan _MENU_ Data",

      }
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

<script>
  $(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
  });
</script>

<script type="text/javascript">
  $(document).ready(function() {
    bsCustomFileInput.init();
  });
</script>

<!-- lihat gambar menu -->
<script type="text/javascript">
  $(document).on("click", "#aksigambar", function() {
    var gambar = $(this).data('gambar');
    var namamenu1 = $(this).data('namamenu');

    $("#nama_menu").html(namamenu1);
    $("#gambarmenu").html('<img src="images/menu/' + gambar + '" style="width:100%;">');


  });
</script>
<!-- pilih menu pada resep -->

<script type="text/javascript">
  $(document).ready(function() {
    $(document).on('click', '#pilihresepmn', function() {
      var kdmenursp = $(this).data('kdmenursp');
      var namamenursp = $(this).data('namamenursp');

      $('#kd_menursp').val(kdmenursp);
      $('#nm_menursp').val(namamenursp);
      $('#datamenursp').modal('hide');
    })
  })
</script>
<!-- pilih bk pada resep -->

<script type="text/javascript">
  $(document).ready(function() {
    $(document).on('click', '#pilihresepbk', function() {
      var kdbahanrsp = $(this).data('kdbahanrsp');
      var nmbahanrsp = $(this).data('nmbahanrsp');

      $('#kd_bkrs').val(kdbahanrsp);
      $('#bahan_bkrs').val(nmbahanrsp);
      $('#databkrsp').modal('hide');
    })
  })
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $(document).on('click', '#pilbkout', function() {
      var kdbahanout = $(this).data('kdbahanout');
      var nmbahanout = $(this).data('nmbahanout');

      $('#kd_bkout').val(kdbahanout);
      $('#bahan_bkout').val(nmbahanout);
      $('#databahan').modal('hide');
    })
  })
</script>