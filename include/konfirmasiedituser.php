<?php 
if(isset($_SESSION['id_user'])){
	$id_user = $_POST['id_user'];
	$nama = $_POST['nama'];
	$email = $_POST['email'];
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $level = $_POST['level'];
    $password = mysqli_real_escape_string($koneksi, MD5($pass));

	if(empty($nama)){
	header("Location:index.php?include=edit-user&notif=editnamakosong");
	}else if(empty($email)){
	header("Location:index.php?include=edit-user&notif=editemailkosong");
	}else if(empty($user)){
	header("Location:index.php?include=edit-user&notif=edituserkosong");
	}else
		if(empty($pass)){
		$sql = "UPDATE `user` SET `nama`='$nama', `email`='$email', `username`='$user', `level`='$level' WHERE `user`.`id_user`='$id_user'";
                  //echo $sql;
		mysqli_query($koneksi,$sql);
		}else{
		$sql = "UPDATE `user` SET `nama`='$nama', `email`='$email', `username`='$user', `password`='$password', `level`='$level' WHERE `user`.`id_user`='$id_user'";
                  //echo $sql;
		mysqli_query($koneksi,$sql);
		}
    header("Location:index.php?include=pengaturan-user&notif=editberhasil");
	
	}

?>
