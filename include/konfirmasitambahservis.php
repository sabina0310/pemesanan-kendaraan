<?php 
    $id_kendaraan = $_POST['kendaraan'];
    $date = $_POST['date'];
    $biaya = $_POST['biaya'];
    $keterangan = $_POST['keterangan'];

    if(empty($id_kendaraan)){	   
        header("Location:index.php?include=tambah-post&notif=tambahkosong&jenis=kendaraan");
    }else if(empty($date)){
	header("Location:index.php?include=tambah-post&notif=tambahkosong&jenis=date");
    }else if(empty($biaya)){	    
        header("Location:index.php?include=tambah-post&notif=tambahkosong&jenis=biaya");
    }else if(empty($keterangan)){
	header("Location:index.php?include=tambah-post&notif=tambahkosong&jenis=keterangan");
    }else{   
	$sql = "INSERT INTO `servis` (`id_kendaraan`,`date`,`biaya`,`keterangan`) VALUES ('$id_kendaraan','$date','$biaya','$keterangan')";
      //echo $sql;
	mysqli_query($koneksi,$sql);
	$id_post = mysqli_insert_id($koneksi);

        header("Location:index.php?include=servis&notif=tambahberhasil");
    }
?>