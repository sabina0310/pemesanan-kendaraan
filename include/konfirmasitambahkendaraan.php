<?php 
    $nopol = $_POST['nopol'];
    $nama = $_POST['nama'];
    $bbm = $_POST['bbm'];
    $id_jenis = $_POST['jenis'];
    $id_pemilik = $_POST['pemilik'];
    $status = $_POST['status'];

    if(empty($nopol)){	   
        header("Location:index.php?include=tambah-post&notif=tambahkosong&jenis=nopol");
    }else if(empty($nama)){
	header("Location:index.php?include=tambah-post&notif=tambahkosong&jenis=nama");
    }else if(empty($bbm)){	    
        header("Location:index.php?include=tambah-post&notif=tambahkosong&jenis=bbm");
    }else if(empty($id_jenis)){
	header("Location:index.php?include=tambah-post&notif=tambahkosong&jenis=jenis");
    }else if(empty($id_pemilik)){
	header("Location:index.php?include=tambah-post&notif=tambahkosong&jenis=pemilik");
    }else if(empty($status)){
        header("Location:index.php?include=tambah-post&notif=tambahkosong&jenis=status");
    }else{   
	$sql = "INSERT INTO `kendaraan` (`nopol`,`nama`,`bbm`,`id_jenis`,`id_pemilik`, `status`) VALUES ('$nopol','$nama','$bbm','$id_jenis','$id_pemilik','$status')";
      //echo $sql;
	mysqli_query($koneksi,$sql);
	$id_post = mysqli_insert_id($koneksi);

        header("Location:index.php?include=kendaraan&notif=tambahberhasil");
    }
?>