<?php 
if(isset($_SESSION['id_kendaraan'])){
$id_kendaraan = $_SESSION['id_kendaraan'];
$id_pemesan = $_POST['pemesan'];
$id_driver = $_POST['driver'];
$id_atasan = $_POST['atasan'];
$pinjam = date('Y-m-d');
$kembali = $_POST['kembali'];
$status = 'Proses';


if(empty($id_atasan)){
	header("Location:index.php?include=form-pesan&notif=atasankosong");
}else if(empty($id_pemesan)){
	header("Location:index.php?include=form-pesan&notif=pemesankosong");
}else if(empty($id_driver)){
	header("Location:index.php?include=form-pesan&notif=driverkosong");
}else if(empty($pinjam)){
	header("Location:index.php?include=form-pesan&notif=pinjamkosong");
}else if(empty($kembali)){
	header("Location:index.php?include=form-pesan&notif=kembalikosong");
}else{
	$sql = "insert into `pesan` (`id_kendaraan`,`id_pemesan`,`id_driver`,`id_user`,`tgl_pinjam`,`tgl_kembali`, `status`) 
	values ('$id_kendaraan', '$id_pemesan','$id_driver','$id_atasan', '$pinjam', '$kembali', '$status')";
	mysqli_query($koneksi,$sql);

    $sql_up = "UPDATE `kendaraan` SET `status`='Tidak ada'
          where `id_kendaraan` = '$id_kendaraan'";
          mysqli_query($koneksi,$sql_up);
    header("Location:index.php?include=pesan&notif=pesanberhasil");	
}
}
?>