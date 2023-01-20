<?php 

// if(isset($_SESSION['id_user'])){
// 	$id_user = $_SESSION['id_user'];
//   $sql_d = "select `id_user`, `level`  from `user` 
//   where `id_user` = '$id_user'";
// 	$query_d = mysqli_query($koneksi,$sql_d);
// 	while($data_d = mysqli_fetch_row($query_d)){
//     $id_user= $data_d[0];
//     $level= $data_d[1];


  if((isset($_GET['aksi']))&&(isset($_GET['data']))){
    if($_GET['aksi']=='batal'){
      $id_pesan= $_GET['data'];

      $sql = "SELECT `id_kendaraan` from `pesan`
      where `id_pesan` = '$id_pesan'";
      mysqli_query($koneksi,$sql);

      $query = mysqli_query($koneksi, $sql);
          while($data = mysqli_fetch_row($query)){
          $id_kendaraan= $data[0];
          
      //batal 
      $sql_dh = "UPDATE pesan set `status`= 'Batal'
      where `id_pesan` = '$id_pesan'";
      mysqli_query($koneksi,$sql_dh);

      $sql_d = "UPDATE kendaraan set `status`= 'Ada'
      where `id_kendaraan` = '$id_kendaraan'";
      mysqli_query($koneksi,$sql_d);
          }
    }
  
  if((isset($_GET['aksi']))&&(isset($_GET['data']))){
    if($_GET['aksi']=='setuju'){
      $id_pesan= $_GET['data'];
      //setuju 
      $sql_dh = "UPDATE pesan set `status`= 'Disetujui'
      where `id_pesan` = '$id_pesan'";
      mysqli_query($koneksi,$sql_dh);
    }
  }
}


  if(isset($_POST['katakunci'])){
    $katakunci = $_POST['katakunci'];
    $_SESSION['katakunci'] = $katakunci;
  }
  if(isset($_SESSION['katakunci'])){
    $katakunci = $_SESSION['katakunci'];
  }
?>

<!-- Content Header (Page header) -->
  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3><i class="fas fa-newspaper"></i> Menunggu Persetujuan</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"> Menunggu Persetujuan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" style="margin-top:5px;"><i class="fas fa-list-ul"></i> Daftar Kendaraan</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <div class="col-md-12">
                  <form method="post" action="index.php?include=kendaraan">
                    <div class="row">
                        <div class="col-md-4 bottom-10">
                          <input type="text" class="form-control" id="kata_kunci" name="katakunci">
                        </div>
                        <div class="col-md-5 bottom-10">
                          <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Search</button>
                        </div>
                    </div><!-- .row -->
                  </form>
                </div><br>
                <div class="col-sm-12">
                <?php if(!empty($_GET['notif'])){?>
                <?php if($_GET['notif']=="tambahberhasil"){?>
                <div class="alert alert-success" role="alert">
                Data Berhasil Ditambahkan</div>
                <?php } else if($_GET['notif']=="editberhasil"){?>
                <div class="alert alert-success" role="alert">
                Data Berhasil Diubah</div>
                <?php } else if($_GET['notif']=="hapusberhasil"){?>
                <div class="alert alert-success" role="alert">
                Data Berhasil Dihapus</div>
                <?php }?>
                <?php }?>
                </div>
                <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th width="2%">No</th>
                      <th width="5%">Nopol</th>
                      <th width="10%">Nama</th>
                      <th width="10%">Pemesan</th>
                      <th width="10%">Driver</th>
                      <th width="10%">Atasan</th>
                      <th width="10%">Tgl Pinjam</th>
                      <th width="10%">Tgl Kembali</th>
                      <th width="8%"><center>Aksi</center></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                $batas = 10;
                if ($_SESSION['level'] == 'Admin'){
                  $id_user = $_SESSION['id_user'];
                  $sql_jum = "SELECT `p`.`id_pesan`, `k`.`nopol`, `pm`.`nama`, `d`.`nama`, `u`.`id_user`
                  from `pesan` `p` JOIN `kendaraan` `k` ON `p`.`id_kendaraan` = `k`.`id_kendaraan` 
                  JOIN `pemesan` `pm` ON `p`.`id_pemesan` = `pm`.`id_pemesan`
                  JOIN `driver` `d` ON `p`.`id_driver` = `d`.`id_driver`
                  JOIN `user` `u` ON `p`.`id_user` = `p`.`id_user`
                  where `p`.`status` = 'Proses'";
                  if (!empty($katakunci)){
                    $sql_jum .= " and `k`.`nama` LIKE '%$katakunci%'";
                  }
                  $sql_jum .= " order by `k`.`nama`";
                  $query_jum = mysqli_query($koneksi,$sql_jum);
                  $jum_data = mysqli_num_rows($query_jum);
                  $jum_halaman = ceil($jum_data/$batas);
                } else if ($_SESSION['level'] == 'Atasan'){
                  $id_user = $_SESSION['id_user'];
                  $sql_jum = "SELECT `p`.`id_pesan`, `k`.`nopol`, `pm`.`nama`, `d`.`nama`, `u`.`id_user`
                  from `pesan` `p` JOIN `kendaraan` `k` ON `p`.`id_kendaraan` = `k`.`id_kendaraan` 
                  JOIN `pemesan` `pm` ON `p`.`id_pemesan` = `pm`.`id_pemesan`
                  JOIN `driver` `d` ON `p`.`id_driver` = `d`.`id_driver`
                  JOIN `user` `u` ON `p`.`id_user` = `u`.`id_user`
                  where `p`.`status` = 'Proses' AND `p`.`id_user` = '$id_user'";
                  if (!empty($katakunci)){
                    $sql_jum .= " and `k`.`nama` LIKE '%$katakunci%'";
                  }
                  $sql_jum .= " order by `k`.`nama`";
                  $query_jum = mysqli_query($koneksi,$sql_jum);
                  $jum_data = mysqli_num_rows($query_jum);
                  $jum_halaman = ceil($jum_data/$batas);
                }
                  if(!isset($_GET['halaman'])){
                    $posisi = 0;
                    $halaman = 1;
                  }else{
                    $halaman = $_GET['halaman'];
                    $posisi = ($halaman-1) * $batas;
                  }
                
                    // menampilkan data kendaraan
                    if ($_SESSION['level'] == 'Admin'){
                      $id_user = $_SESSION['id_user'];
                    $sql_p = "SELECT `p`.`id_pesan`, `k`.`nopol`, `k`.`nama`, `pm`.`nama`, `d`.`nama`, `u`.`nama`,`p`.`tgl_pinjam`, `p`.`tgl_kembali`,`p`.`id_kendaraan`
                  from `pesan` `p` JOIN `kendaraan` `k` ON `p`.`id_kendaraan` = `k`.`id_kendaraan`
                  JOIN `pemesan` `pm` ON `p`.`id_pemesan` = `pm`.`id_pemesan`
                  JOIN `driver` `d` ON `p`.`id_driver` = `d`.`id_driver`
                  JOIN `user` `u` ON `p`.`id_user` = `u`.`id_user`
                  where `p`.`status` = 'Proses'";
                    
                    if (!empty($katakunci)){
                    $sql_p .= " and `k`.`nama` LIKE '%$katakunci%'";
                    }
                    $sql_p .= " ORDER BY `k`.`nama` limit $posisi, $batas ";
                    } else if($_SESSION['level'] == 'Atasan'){
                      $id_user = $_SESSION['id_user'];

                      $sql_p = "SELECT `p`.`id_pesan`, `k`.`nopol`, `k`.`nama`, `pm`.`nama`, `d`.`nama`, `u`.`nama`,`p`.`tgl_pinjam`, `p`.`tgl_kembali`,`p`.`id_kendaraan`
                      from `pesan` `p` JOIN `kendaraan` `k` ON `p`.`id_kendaraan` = `k`.`id_kendaraan`
                      JOIN `pemesan` `pm` ON `p`.`id_pemesan` = `pm`.`id_pemesan`
                      JOIN `driver` `d` ON `p`.`id_driver` = `d`.`id_driver`
                      JOIN `user` `u` ON `p`.`id_user` = `u`.`id_user`
                      where `p`.`status` = 'Proses' AND `p`.`id_user` = '$id_user'";
                        
                        if (!empty($katakunci)){
                        $sql_p .= " and `k`.`nama` LIKE '%$katakunci%'";
                        }
                        $sql_p .= " ORDER BY `k`.`nama` limit $posisi, $batas ";
                    }
                    
                
                    $query_k = mysqli_query($koneksi,$sql_p);
                    $posisi+1;
                    
                  while($data_k = mysqli_fetch_row($query_k)){
                    $id_pesan = $data_k[0];
                    $nopol = $data_k[1];
                    $nama = $data_k[2];
                    $pemesan = $data_k[3];
                    $driver = $data_k[4];
                    $atasan = $data_k[5];
                    $pinjam = $data_k[6];
                    $kembali = $data_k[7];

                  ?>
                    <tr>
                      <td><?php echo $posisi+1;?></td>
                      <td><?php echo $nopol;?></td>
                      <td><?php echo $nama;?></td>
                      <td><?php echo $pemesan;?></td>
                      <td><?php echo $driver;?></td>
                      <td><?php echo $atasan;?></td>
                      <td><?php echo $pinjam;?></td>
                      <td><?php echo $kembali;?></td>
                      <td align="center">
                        <!-- <a href="index.php?include=edit-post&data=<?php echo $id_kendaraan;?>" 
                        class="btn btn-xs btn-info" title="Edit"><i class="fas fa-edit"></i></a> -->
                        <a href="javascript:if(confirm('Anda yakin ingin batalkan pesanan <?php echo  $id_pesan; ?>?')) 
                          window.location.href ='index.php?include=menunggu-persetujuan&aksi=batal&data=<?php echo  $id_pesan; ?>&notif=batalkanberhasil'"
                          class="btn btn-xs btn-danger" title="Batalkan"><i class="fas fa-times"></i></a>
                        <a href="javascript:if(confirm('Anda yakin ingin setujui pesanan <?php echo $id_pesan; ?>?')) 
                          window.location.href ='index.php?include=menunggu-persetujuan&aksi=setuju&data=<?php echo  $id_pesan; ?>&notif=setujuiberhasil'"
                          class="btn btn-xs btn-success" title="Setuju"><i class="fas fa-check"></i></a>
                      </td>
                    </tr>
                    <?php $posisi++;}?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">

              <ul class="pagination pagination-sm m-0 float-right">
              <?php 
              if($jum_halaman==0){
                //tidak ada halaman
              }else if($jum_halaman==1){
                  echo "<li class='page-item'><a class='page-link'>1</a></li>";
              }else{
                  $sebelum = $halaman-1;
                  $setelah = $halaman+1;
                  if($halaman!=1){
                    echo "<li class='page-item'><a class='page-link' 
                    href='index.php?include=menunggu-persetujuan&halaman=1'>First</a></li>";
                    echo "<li class='page-item'><a class='page-link' 
                    href='index.php?include=menunggu-persetujuan&halaman=$sebelum'>«</a></li>";
                  }
                  for($i=1; $i<=$jum_halaman; $i++){
                    if ($i > $halaman - 5 and $i < $halaman + 5 ) {
                      if($i!=$halaman){
                          echo "<li class='page-item'><a class='page-link' 
                          href='index.php?include=menunggu-persetujuan&halaman=$i'>$i</a></li>";
                      }else{
                          echo "<li class='page-item'><a class='page-link'>$i</a></li>";
                      }
                    }
                  }
                  if($halaman!=$jum_halaman){
                    echo "<li class='page-item'><a class='page-link' 
                    href='index.php?include=menunggu-persetujuan&halaman=$setelah'>»</a></li>";
                    echo "<li class='page-item'><a class='page-link' 
                    href='index.php?include=menunggu-persetujuan&halaman=$jum_halaman'>Last</a></li>";
                  }
                  
                    }?>
                    </ul>
              </div>
            </div>
            <!-- /.card -->

    </section>
    <!-- /.content -->
    