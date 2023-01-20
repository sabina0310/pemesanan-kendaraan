<?php 
$nama = $_POST['nama'];
$email = $_POST['email'];
$telp = $_POST['notelp'];

if(empty($nama)){
	header("Location:index.php?include=tambah-user&notif=tambahnamakosong");
}else if(empty($email)){
	header("Location:index.php?include=tambah-user&notif=tambahemailkosong");
}else if(empty($telp)){
	header("Location:index.php?include=tambah-user&notif=tambahtelpkosong");
}else{
	$sql = "INSERT into `pemesan` (`nama`, `email`, `telp`) 
	values ('$nama', '$email', '$telp')";
	mysqli_query($koneksi,$sql);
header("Location:index.php?include=pemesan&notif=tambahpemesanberhasil");	
}

?>