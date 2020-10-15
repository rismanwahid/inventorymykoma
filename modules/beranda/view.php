 <!-- Content Header (Page header) -->
 <div class="content-header">
   <div class="container-fluid">
     <div class="row mb-2">
       <div class="col-sm-6">
         <h1 class="m-0 text-dark">Beranda</h1>
       </div><!-- /.col -->
     </div><!-- /.row -->
   </div><!-- /.container-fluid -->
 </div>
 <!-- /.content-header -->
 <div class="container-fluid">
   <!-- Small boxes (Stat box) -->
   <div class='alert alert-info'>
     <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
     Selamat Datang <?php echo $_SESSION['nama']; ?> Di Inventory Mykoma
   </div>
   <div class="row">
     <div class="col-lg-3 col-6">
       <!-- small box -->
       <div class="small-box bg-info">
         <div class="inner">
           <?php
            $qrbeli = mysqli_query($db, "SELECT COUNT(id_pembelian) AS totalbl FROM pembelian WHERE tgl_beli=CURDATE()");
            $ouputbl = mysqli_fetch_assoc($qrbeli);
            ?>

           <h3><?php echo $ouputbl['totalbl']; ?></h3>

           <p>Pembelian <?php echo date('d-m-Y'); ?></p>
         </div>
         <div class="icon">
           <i class="fa fa-shopping-cart"></i>
         </div>
         <a href="index.php?page=pembelian" class="small-box-footer">Lihat Pembelian <i class="fas fa-arrow-circle-right"></i></a>
       </div>
     </div>
     <!-- ./col -->
     <div class="col-lg-3 col-6">
       <!-- small box -->
       <div class="small-box bg-success">
         <div class="inner">
           <?php
            $date = date('Y-m-d');
            $qrbk = mysqli_query($db, "SELECT COUNT(kd_brgout) AS totalbk FROM brg_keluar WHERE date(tgl_out)='$date'");
            $ouputbk = mysqli_fetch_assoc($qrbk);
            ?>
           <h3><?php echo $ouputbk['totalbk']; ?></h3>

           <p>Barang Keluar <?php echo date('d-m-Y'); ?></p>
         </div>
         <div class="icon">
           <i class="nav-icon fas fa-cart-arrow-down"></i>
         </div>
         <a href="index.php?page=pengambilan" class="small-box-footer">Lihat Pengambilan Barang <i class="fas fa-arrow-circle-right"></i></a>
       </div>
     </div>
     <!-- ./col -->
     <div class="col-lg-3 col-6">
       <!-- small box -->
       <div class="small-box bg-warning">
         <div class="inner">
           <?php
            $qrspl = mysqli_query($db, "SELECT COUNT(id_suplier) AS totalspl FROM suplier");
            $ouputspl = mysqli_fetch_assoc($qrspl);
            ?>
           <h3><?php echo $ouputspl['totalspl']; ?></h3>

           <p>Suplier</p>
         </div>
         <div class="icon">
           <i class="nav-icon fas fa-truck"></i>
         </div>
         <a href="index.php?page=suplier" class="small-box-footer">Lihat Suplier <i class="fas fa-arrow-circle-right"></i></a>
       </div>
     </div>
     <!-- ./col -->
     <div class="col-lg-3 col-6">
       <!-- small box -->
       <div class="small-box bg-danger">
         <div class="inner">
           <?php
            $qrbku = mysqli_query($db, "SELECT COUNT(bahan_bk.kd_bahanbk) AS totalbku,stok.stok as stoks FROM bahan_bk JOIN stok ON stok.kd_bahanbk=bahan_bk.kd_bahanbk WHERE stok.stok!=0");
            $ouputbku = mysqli_fetch_assoc($qrbku);
            ?>
           <h3><?php echo $ouputbku['totalbku'] ?></h3>

           <p>Bahan Baku</p>
         </div>
         <div class="icon">
           <i class="nav-icon fas fa-cube"></i>
         </div>
         <a href="index.php?page=bahanbk" class="small-box-footer">Lihat Bahan Baku <i class="fas fa-arrow-circle-right"></i></a>
       </div>
     </div>
     <!-- ./col -->
   </div>
   <!-- /.row -->

 </div><!-- /.container-fluid -->