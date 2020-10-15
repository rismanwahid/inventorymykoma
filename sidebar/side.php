<div class="sidebar">
  <!-- Sidebar user panel (optional) -->
  <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
      <img src="asets/dist/img/user.png" alt="User Image">
    </div>
    <div class="info">
      <a href="#" class="d-block"><?php if (empty($_SESSION['no_user'])) {
                                    echo "";
                                  } else {
                                    echo $_SESSION['nama'];
                                  } ?></a>
    </div>
  </div>

  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
      <li class="nav-item">
        <a href="index.php?page=beranda" class="nav-link">
          <i class="nav-icon fas fa-home"></i>
          <p>
            Beranda
          </p>
        </a>

      </li>
      <?php if ($_SESSION['level'] == 'Admin') { ?>
        <li class="nav-item">
          <a href="index.php?page=pgw" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Data Pegawai
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="index.php?page=suplier" class="nav-link">
            <i class="nav-icon fas fa-truck"></i>
            <p>
              Data Suplier
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="index.php?page=bahanbk" class="nav-link">
            <i class="nav-icon fas fa-cube"></i>
            <p>
              Data Bahan Baku
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="index.php?page=kategori" class="nav-link">
            <i class="nav-icon fas fa-th-list"></i>
            <p>
              Data Kategori Menu
            </p>
          </a>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-book"></i>
            <p>
              Data Menu
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <?php

            $query  = mysqli_query($db, "SELECT * FROM kategori");
            $hitung = mysqli_num_rows($query);
            if ($hitung > 0) {
              while ($pecah = mysqli_fetch_assoc($query)) {


            ?>

                <li class="nav-item">
                  <a href=" index.php?page=menu&kd_kategori=<?php echo $pecah['kd_kategori']; ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p><?php echo $pecah['nm_kategori']; ?></p>
                  </a>
                </li>
            <?php }
            } ?>
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-edit"></i>
            <p>
              Data Resep
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <?php

            $query1  = mysqli_query($db, "SELECT * FROM kategori");
            $hitung1 = mysqli_num_rows($query1);
            if ($hitung1 > 0) {
              while ($pecah1 = mysqli_fetch_assoc($query1)) {


            ?>

                <li class="nav-item">
                  <a href=" index.php?page=resep&kd_kategori=<?php echo $pecah1['kd_kategori']; ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p><?php echo $pecah1['nm_kategori']; ?></p>
                  </a>
                </li>
            <?php }
            } ?>
          </ul>
        </li>
        <li class="nav-item">
          <a href="index.php?page=pembelian" class="nav-link">
            <i class="nav-icon fas fa-shopping-cart"></i>
            <p>
              Pembelian Barang
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="index.php?page=pengambilan" class="nav-link">
            <i class="nav-icon fas fa-cart-arrow-down"></i>
            <p>
              Pengambilan Barang
            </p>
          </a>
        </li>
      <?php } ?>
      <?php if ($_SESSION['level'] == 'Owner') { ?>
        <li class="nav-item">
          <a href="pages/widgets.html" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Laporan
            </p>
          </a>
        </li>
      <?php } ?>
    </ul>
  </nav>
  <!-- /.sidebar-menu -->
</div>