<?php 
if(isset($_GET['data'])){
	$id_kendaraan = $_GET['data'];

    $sql_d = "select `nama`, `nopol` from `kendaraan` 
    where `id_kendaraan` = '$id_kendaraan'";
      $query_d = mysqli_query($koneksi,$sql_d);
      while($data_d = mysqli_fetch_row($query_d)){
      $nama= $data_d[0];
      $nopol= $data_d[1];
      


  if((isset($_GET['aksi']))&&(isset($_GET['data']))){
    if($_GET['aksi']=='hapus'){
      $id_servis = $_GET['data'];
      //hapus post
      $sql_dh = "delete from `servis` 
      where `id_servis` = '$id_servis'";
      mysqli_query($koneksi,$sql_dh);
    }
  }
?>

<!-- Content Header (Page header) -->
  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3><i class="fas fa-newspaper"></i> Detail Servis</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"> Detail Servis <?php echo $nopol; ?> - <?php echo $nama; ?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" style="margin-top:5px;"><i class="fas fa-list-ul"></i> Data Servis</h3>
                <div class="card-tools">
          <a href="index.php?include=kendaraan" class="btn btn-sm btn-warning float-right">
          <i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
        </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <div class="col-md-12">
                  <form method="post" action="index.php?include=servis">
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
                      <th width="10%">Tanggal</th>
                      <th width="10%">Biaya</th>
                      <th width="15%">Keterangan</th>
                      <th width="5%"><center>Aksi</center></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                $batas = 10;

                  $sql_jum = "SELECT `s`.`id_servis`, `k`.`nopol`, `k`.`nama`, `s`.`date`, `s`.`biaya`, `s`.`keterangan`
                  from `servis` `s` JOIN `kendaraan` `k` ON `s`.`id_kendaraan` = `k`.`id_kendaraan` where `s`.`id_kendaraan` = '$id_kendaraan'";
                  if (!empty($katakunci)){
                    $sql_jum .= " and `k`.`nama` LIKE '%$katakunci%'";
                  }
                  $sql_jum .= " order by `s`.`id_servis`";
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
                
                    // menampilkan data servis

                    $sql_k = "SELECT `s`.`id_servis`, `k`.`nopol`, `k`.`nama`, `s`.`date`, `s`.`biaya`, `s`.`keterangan`
                    from `servis` `s` INNER JOIN `kendaraan` `k` ON `s`.`id_kendaraan` = `k`.`id_kendaraan` where `s`.`id_kendaraan` = '$id_kendaraan'";
                    
                    if (!empty($katakunci)){
                    $sql_k .= " and `k`.`nama` LIKE '%$katakunci%'";
                    }
                    $sql_k .= " ORDER BY `s`.`id_servis` limit $posisi, $batas ";
                
                    
                
                    $query_k = mysqli_query($koneksi,$sql_k);
                    $posisi+1;
                    
                  while($data_k = mysqli_fetch_row($query_k)){
                    $id_servis = $data_k[0];
                    $nopol = $data_k[1];
                    $nama = $data_k[2];
                    $date = $data_k[3];
                    $biaya = $data_k[4];
                    $keterangan = $data_k[5];
                  
                  ?>
                    <tr>
                      <td><?php echo $posisi+1;?></td>
                      <td><?php echo $nopol;?></td>
                      <td><?php echo $nama;?></td>
                      <td><?php echo $date;?></td>
                      <td><?php echo $biaya;?></td>
                      <td><?php echo $keterangan;?></td>
                      <td align="center">
                        <a href="javascript:if(confirm('Anda yakin ingin menghapus data <?php echo $id_servis; ?>?')) 
                          window.location.href ='index.php?include=servis&aksi=hapus&data=<?php echo 
                          $id_servis;?>&notif=hapusberhasil'"
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
                    href='index.php?include=detail-servis&halaman=1'>First</a></li>";
                    echo "<li class='page-item'><a class='page-link' 
                    href='index.php?include=detail-servis&halaman=$sebelum'>«</a></li>";
                  }
                  for($i=1; $i<=$jum_halaman; $i++){
                    if ($i > $halaman - 5 and $i < $halaman + 5 ) {
                      if($i!=$halaman){
                          echo "<li class='page-item'><a class='page-link' 
                          href='index.php?include=detail-servis&halaman=$i'>$i</a></li>";
                      }else{
                          echo "<li class='page-item'><a class='page-link'>$i</a></li>";
                      }
                    }
                  }
                  if($halaman!=$jum_halaman){
                    echo "<li class='page-item'><a class='page-link' 
                    href='index.php?include=detail-servis&halaman=$setelah'>»</a></li>";
                    echo "<li class='page-item'><a class='page-link' 
                    href='index.php?include=detail-servis&halaman=$jum_halaman'>Last</a></li>";
                  }
                  
                    }?>
                    </ul>
              </div>
            </div>
            <!-- /.card -->

    </section>
    <!-- /.content -->
    <?php }}?>
                