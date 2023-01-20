<?php 
  if((isset($_GET['aksi']))&&(isset($_GET['data']))){
    if($_GET['aksi']=='hapus'){
      $id_kendaraan = $_GET['data'];
      //hapus post
      $sql_dh = "delete from `kendaraan` 
      where `id_kendaraan` = '$id_kendaraan'";
      mysqli_query($koneksi,$sql_dh);
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
            <h3><i class="fas fa-newspaper"></i> Kendaraan</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"> Kendaraan</li>
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
                <div class="card-tools">
                <a href="index.php?include=tambah-kendaraan" 
                  class="btn btn-sm btn-info float-right">
                  <i class="fas fa-plus"></i> Tambah Kendaraan</a>
                </div>
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
                      <th width="5%">No</th>
                      <th width="10%">Nopol</th>
                      <th width="10%">Nama</th>
                      <th width="10%">BBM</th>
                      <th width="10%">Jenis</th>
                      <th width="5%">Kepemilikan</th>
                      <th width="5%">Status</th>
                      <th width="15%"><center>Aksi</center></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                $batas = 10;
                
                  $sql_jum = "SELECT `k`.`id_kendaraan`, `k`.`nopol`, `k`.`nama`, `k`.`bbm`, `j`.`nama`,`p`.`nama`,`k`.`status`
                  from `kendaraan` `k` JOIN `jenis_kendaraan` `j` ON `k`.`id_jenis` = `j`.`id_jenis` 
                  JOIN `kepemilikan` `p` ON `k`.`id_pemilik` = `p`.`id_pemilik`";
                  if (!empty($katakunci)){
                    $sql_jum .= " where `k`.`nama` LIKE '%$katakunci%'";
                  }
                  $sql_jum .= " order by `k`.`nama`";
                  $query_jum = mysqli_query($koneksi,$sql_jum);
                  $jum_data = mysqli_num_rows($query_jum);
                  $jum_halaman = ceil($jum_data/$batas);
                  
                  if(!isset($_GET['halaman'])){
                    $posisi = 0;
                    $halaman = 1;
                  }else{
                    $halaman = $_GET['halaman'];
                    $posisi = ($halaman-1) * $batas;
                  }
                
                    // menampilkan data kendaraan
                    $sql_k = "SELECT `k`.`id_kendaraan`, `k`.`nopol`, `k`.`nama`, `k`.`bbm`, `j`.`nama`, `p`.`nama`, `k`.`status`
                    from `kendaraan` `k` INNER JOIN `jenis_kendaraan` `j` ON `k`.`id_jenis` = `j`.`id_jenis` 
                    INNER JOIN `kepemilikan` `p` ON `k`.`id_pemilik` = `p`.`id_pemilik`";
                    
                    if (!empty($katakunci)){
                    $sql_k .= " where `k`.`nama` LIKE '%$katakunci%'";
                    }
                    $sql_k .= " ORDER BY `k`.`id_kendaraan` limit $posisi, $batas ";
                    
                    
                
                    $query_k = mysqli_query($koneksi,$sql_k);
                    $posisi+1;
                    
                  while($data_k = mysqli_fetch_row($query_k)){
                    $id_kendaraan = $data_k[0];
                    $nopol = $data_k[1];
                    $nama = $data_k[2];
                    $bbm = $data_k[3];
                    $jenis = $data_k[4];
                    $pemilik = $data_k[5];
                    $status = $data_k[6];

                  ?>
                    <tr>
                      <td><?php echo $posisi+1;?></td>
                      <td><?php echo $nopol;?></td>
                      <td><?php echo $nama;?></td>
                      <td><?php echo $bbm;?></td>
                      <td><?php echo $jenis;?></td>
                      <td><?php echo $pemilik;?></td>
                      <td><?php echo $status;?></td>
                      <td align="center">
                        <a href="index.php?include=detail-servis&data=<?php echo $id_kendaraan;?>" 
                        class="btn btn-xs btn-secondary" title="Detail Servis"><i class="fas fa-wrench"></i></a>
                        <a href="javascript:if(confirm('Anda yakin ingin menghapus data <?php echo $id_kendaraan; ?>?')) 
                          window.location.href ='index.php?include=kendaraan&aksi=hapus&data=<?php echo 
                          $id_kendaraan;?>&notif=hapusberhasil'"
                          class="btn btn-xs btn-danger" title="Hapus"><i class="fas fa-trash"></i></a>
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
                    href='index.php?include=kendaraan&halaman=1'>First</a></li>";
                    echo "<li class='page-item'><a class='page-link' 
                    href='index.php?include=kendaraan&halaman=$sebelum'>«</a></li>";
                  }
                  for($i=1; $i<=$jum_halaman; $i++){
                    if ($i > $halaman - 5 and $i < $halaman + 5 ) {
                      if($i!=$halaman){
                          echo "<li class='page-item'><a class='page-link' 
                          href='index.php?include=kendaraan&halaman=$i'>$i</a></li>";
                      }else{
                          echo "<li class='page-item'><a class='page-link'>$i</a></li>";
                      }
                    }
                  }
                  if($halaman!=$jum_halaman){
                    echo "<li class='page-item'><a class='page-link' 
                    href='index.php?include=kendaraan&halaman=$setelah'>»</a></li>";
                    echo "<li class='page-item'><a class='page-link' 
                    href='index.php?include=kendaraan&halaman=$jum_halaman'>Last</a></li>";
                  }
                  
                    }?>
                    </ul>
              </div>
            </div>
            <!-- /.card -->

    </section>
    <!-- /.content -->