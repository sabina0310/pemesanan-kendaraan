<!-- <?php 
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
?> -->

<!-- Content Header (Page header) -->
  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3><i class="fas fa-newspaper"></i> Riwayat Pesanan</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"> Riwayat Pesanan</li>
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
                  <form method="post" action="index.php?include=riwayat-pesanan">
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
                      <th width="7%">Status</th>
                      <!-- <th width="8%"><center>Aksi</center></th> -->
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                $batas = 10;
                
                  $sql_jum = "SELECT `p`.`id_pesan`, `k`.`nopol`, `pm`.`nama`, `d`.`nama`, `u`.`id_user`, `p`.`status`
                  from `pesan` `p` JOIN `kendaraan` `k` ON `p`.`id_kendaraan` = `k`.`id_kendaraan` 
                  JOIN `pemesan` `pm` ON `p`.`id_pemesan` = `pm`.`id_pemesan`
                  JOIN `driver` `d` ON `p`.`id_driver` = `d`.`id_driver`
                  JOIN `user` `u` ON `p`.`id_user` = `u`.`id_user`";
                  if (!empty($katakunci)){
                    $sql_jum .= " WHERE `k`.`nopol`,`k`.`nama` LIKE '%$katakunci%'";
                  }
                  $sql_jum .= " order by `p`.`id_pesan`";
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
                    $sql_p = "SELECT `p`.`id_pesan`, `k`.`nopol`, `k`.`nama`, `pm`.`nama`, `d`.`nama`, `u`.`nama`,`p`.`tgl_pinjam`, `p`.`tgl_kembali`, `p`.`status`
                  from `pesan` `p` JOIN `kendaraan` `k` ON `p`.`id_kendaraan` = `k`.`id_kendaraan`
                  JOIN `pemesan` `pm` ON `p`.`id_pemesan` = `pm`.`id_pemesan`
                  JOIN `driver` `d` ON `p`.`id_driver` = `d`.`id_driver`
                  JOIN `user` `u` ON `p`.`id_user` = `u`.`id_user`";
                    
                    if (!empty($katakunci)){
                    $sql_p .= " WHERE `k`.`nopol`,`k`.`nama`, `u`.`nama`, LIKE '%$katakunci%'";
                    }
                    $sql_p .= " ORDER BY `p`.`id_pesan` limit $posisi, $batas ";
                    
                    
                
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
                    $status = $data_k[8];


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
                      <td><?php echo $status;?></td>

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
                    href='index.php?include=riwayat-pesanan&halaman=1'>First</a></li>";
                    echo "<li class='page-item'><a class='page-link' 
                    href='index.php?include=riwayat-pesanan&halaman=$sebelum'>«</a></li>";
                  }
                  for($i=1; $i<=$jum_halaman; $i++){
                    if ($i > $halaman - 5 and $i < $halaman + 5 ) {
                      if($i!=$halaman){
                          echo "<li class='page-item'><a class='page-link' 
                          href='index.php?include=riwayat-pesanan&halaman=$i'>$i</a></li>";
                      }else{
                          echo "<li class='page-item'><a class='page-link'>$i</a></li>";
                      }
                    }
                  }
                  if($halaman!=$jum_halaman){
                    echo "<li class='page-item'><a class='page-link' 
                    href='index.php?include=riwayat-pesanan&halaman=$setelah'>»</a></li>";
                    echo "<li class='page-item'><a class='page-link' 
                    href='index.php?include=riwayat-pesanan&halaman=$jum_halaman'>Last</a></li>";
                  }
                  
                    }?>
                    </ul>
              </div>
            </div>
            <!-- /.card -->

    </section>
    <!-- /.content -->