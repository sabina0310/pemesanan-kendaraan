<?php
$koneksi = mysqli_connect("localhost","root","","pemesanan_kendaraan");
// cek koneksi
if (!$koneksi){
  die("Error koneksi: " . mysqli_connect_errno());
}
?>
