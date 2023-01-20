<?php 
if(isset($_SESSION['id_user'])){
	$id_user = $_SESSION['id_user'];
    $pass_lama = $_POST['pass_lama'];
    $pass_baru = $_POST['pass_baru'];
    $konfirmasi = $_POST['konfirmasi'];
    $pw_lama = "ada";
    
    $passlama = mysqli_real_escape_string($koneksi, MD5($pass_lama));
    $password = mysqli_real_escape_string($koneksi, MD5($pass_baru));

    $sql_p = "SELECT `password` FROM `user` WHERE `id_user`='$id_user'";
    $query_p = mysqli_query($koneksi, $sql_p);
    while($data_p = mysqli_fetch_row($query_p)){
    $pw_lama = $data_p[0];
    }
    
	if(empty($pass_lama)){
	header("Location:index.php?include=ubah-password&notif=passlamakosong");
	}else if(empty($pass_baru)){
	header("Location:index.php?include=ubah-password&notif=passbarukosong");
	}else if(empty($konfirmasi)){
	header("Location:index.php?include=ubah-password&notif=konfirmasikosong");
	}else if($passlama!=$pw_lama){
    header("Location:index.php?include=ubah-password&notif=passwordlamasalah");
    }else if($pass_baru!=$konfirmasi){
    header("Location:index.php?include=ubah-password&notif=passwordkonfirmasitidaksama");
    }else{
		$sql = "UPDATE `user` SET `password`='$password' WHERE `id_user`='$id_user'";
                // echo $sql;
		mysqli_query($koneksi,$sql);
        header("Location:index.php?include=ubah-password&notif=ubahpasswordberhasil");
	}
    
	}
?>