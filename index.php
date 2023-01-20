<?php 
session_start();
include("koneksi/koneksi.php");
if(isset($_GET["include"])){
  $include = $_GET["include"];
  if($include=="konfirmasi-login"){
    include("include/konfirmasilogin.php");
  }else if($include=="konfirmasi-edit-profil"){
    include("include/konfirmasieditprofil.php");
  }else if($include=="konfirmasi-ubah-password"){
    include("include/konfirmasiubahpassword.php");
  }else if($include=="konfirmasi-edit-user"){
    include("include/konfirmasiedituser.php");
  }else if($include=="konfirmasi-pesan"){
    include("include/konfirmasipesan.php");
  }else if($include=="konfirmasi-tambah-kendaraan"){
    include("include/konfirmasitambahkendaraan.php");
  }else if($include=="konfirmasi-tambah-user"){
    include("include/konfirmasitambahuser.php");
  }else if($include=="konfirmasi-tambah-pemesan"){
    include("include/konfirmasitambahpemesan.php");
  }else if($include=="konfirmasi-tambah-driver"){
    include("include/konfirmasitambahdriver.php");
  }else if($include=="konfirmasi-tambah-servis"){
    include("include/konfirmasitambahservis.php");
  }
  else if($include=="signout"){
    include("include/signout.php");
  }
}
?>

<!DOCTYPE html>
<html>
<head>
<?php include("includes/head.php") ?>
</head>
<?php
//cek ada get include
if(isset($_GET["include"])){
  	$include = $_GET["include"];
  	//cek apakah ada session id admin
  	if(isset($_SESSION['id_user'])){
      ?>
      <body class="hold-transition sidebar-mini layout-fixed">
      <div class="wrapper">
        <?php include("includes/header.php") ?>
        <?php include("includes/sidebar.php") ?>
        <div class="content-wrapper">
          <?php 
          if ($include=="pesan"){
            include("include/pesan.php");
          }else if($include=="kendaraan"){
            include("include/kendaraan.php");
          }else if($include=="tambah-kendaraan"){
            include("include/tambahkendaraan.php");
          }else if($include=="ubah-password"){
            include("include/ubahpassword.php");
          }else if($include=="edit-profil"){
            include("include/editprofil.php");
          }else if($include=="pengaturan-user"){
            include("include/pengaturanuser.php");
          }else if($include=="edit-user"){
            include("include/edituser.php");
          }else if($include=="form-pesan"){
            include("include/formpesan.php");
          }else if($include=="menunggu-persetujuan"){
            include("include/menunggupersetujuan.php");
          }else if($include=="disetujui"){
            include("include/disetujui.php");
          }else if($include=="dipesan"){
            include("include/dipesan.php");
          }else if($include=="riwayat-pesanan"){
            include("include/riwayatpesanan.php");
          }else if($include=="pemesan"){
            include("include/pemesan.php");
          }else if($include=="driver"){
            include("include/driver.php");
          }else if($include=="tambah-pemesan"){
            include("include/tambahpemesan.php");
          }else if($include=="tambah-user"){
            include("include/tambahuser.php");
          }else if($include=="tambah-driver"){
            include("include/tambahdriver.php");
          }else if($include=="servis"){
            include("include/servis.php");
          }else if($include=="tambah-servis"){
            include("include/tambahservis.php");
          }else if($include=="detail-servis"){
            include("include/detailservis.php");
          }
          else {
            include("include/profil.php");
          }
          ?>
          </div>
          <!-- /.content-wrapper -->
          <?php include("includes/footer.php") ?>
        </div>
        <!-- ./wrapper -->
        <?php include("includes/script.php") ?>
      </body>
      <?php
  	}else{
    //pemanggilan halaman form login
    include("include/login.php");
  	}  
}else{
  if(isset($_SESSION['id_user'])){
    ?>
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
          <?php include("includes/header.php") ?>
          <?php include("includes/sidebar.php") ?>
          <div class="content-wrapper">
          <?php
            //pemanggilan profil
            include("include/profil.php");
          ?>
          </div>
          <!-- /.content-wrapper -->
          <?php include("includes/footer.php") ?>
        </div>
        <!-- ./wrapper -->
        <?php include("includes/script.php") ?>
      </body>
      <?php  
  }else{
  //pemanggilan halaman form login
    include("include/login.php");
  } 
}
?>


</html>
