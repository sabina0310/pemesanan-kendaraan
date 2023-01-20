<?php 
  if((isset($_GET['aksi']))&&(isset($_GET['data']))){
    if($_GET['aksi']=='hapus'){
      $id_post = $_GET['data'];
      //hapus post
      $sql_dh = "delete from `post` 
      where `id_post` = '$id_post'";
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
            <h3><i class="fas fa-newspaper"></i> Post</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"> Post</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" style="margin-top:5px;"><i class="fas fa-list-ul"></i> Daftar Message</h3>
                <!-- <div class="card-tools">
                <a href="index.php?include=tambah-post" 
                  class="btn btn-sm btn-info float-right">
                  <i class="fas fa-plus"></i> Tambah Post</a>
                </div> -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <div class="col-md-12">
                  <form method="post" action="index.php?include=message">
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
                      <th width="10%">Nama</th>
                      <th width="10%">Email</th>
                      <th width="13%">Subject</th>
                      <th width="30%">Isi</th>
                      <th width="5%"><center>Aksi</center></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                $batas = 3;
                
              //hitung jumlah semua data
                  $sql_jum = "SELECT `id_msg`, `name`, `subject`,`email`, `msg` from `message`";
                  if (!empty($katakunci)){
                    $sql_jum .= " where `name` LIKE '%$katakunci%'";
                  }
                  $sql_jum .= " order by `name` ";
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
                
                    // menampilkan data POST
                    $sql_m = "SELECT `id_msg`, `name`, `subject`,`email`, `msg` from `message`";
                    if (!empty($katakunci)){
                        $sql_m .= " where name LIKE '%$katakunci%'";
                    }
                    $sql_m .=" ORDER BY `id_msg` limit $posisi, $batas";
                    
                    $query_m = mysqli_query($koneksi,$sql_m);
                    $posisi+1;
                    
                  while($data_k = mysqli_fetch_row($query_m)){
                    $id_msg = $data_k[0];
                    $name = $data_k[1];
                    $subject = $data_k[2];
                    $email = $data_k[3];
                    $message = $data_k[4];

                  ?>
                    <tr>
                      <td><?php echo $posisi+1;?></td>
                      <td><?php echo $name;?></td>
                      <td><?php echo $email;?></td>
                      <td><?php echo $subject;?></td>
                      <td><?php echo $message;?></td>
                      <td align="center">
                        <a href="javascript:if(confirm('Anda yakin ingin menghapus data <?php echo $id_post; ?>?')) 
                          window.location.href ='index.php?include=post&aksi=hapus&data=<?php echo 
                          $id_post;?>&notif=hapusberhasil'"
                          class="btn btn-xs btn-warning"><i class="fas fa-trash"></i></a>
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
                    href='index.php?include=message&halaman=1'>First</a></li>";
                    echo "<li class='page-item'><a class='page-link' 
                    href='index.php?include=message&halaman=$sebelum'>«</a></li>";
                  }
                  for($i=1; $i<=$jum_halaman; $i++){
                    if ($i > $halaman - 5 and $i < $halaman + 5 ) {
                      if($i!=$halaman){
                          echo "<li class='page-item'><a class='page-link' 
                          href='index.php?include=message&halaman=$i'>$i</a></li>";
                      }else{
                          echo "<li class='page-item'><a class='page-link'>$i</a></li>";
                      }
                    }
                  }
                  if($halaman!=$jum_halaman){
                    echo "<li class='page-item'><a class='page-link' 
                    href='index.php?include=message&halaman=$setelah'>»</a></li>";
                    echo "<li class='page-item'><a class='page-link' 
                    href='index.php?include=message&halaman=$jum_halaman'>Last</a></li>";
                  }
                  
                    }?>
                    </ul>
              </div>
            </div>
            <!-- /.card -->

    </section>
    <!-- /.content -->