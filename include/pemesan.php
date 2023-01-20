<?php 
if((isset($_GET['aksi']))&&(isset($_GET['data']))){
	if($_GET['aksi']=='hapus'){
		$id_pemesan = $_GET['data'];
		//hapus pemesan
		$sql_dh = "delete from `pemesan` where `id_pemesan` = '$id_pemesan'";
		mysqli_query($koneksi,$sql_dh);
	}
}
?>

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3><i class="fas fa-user-tie"></i> Data Pemesan</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"> Data Pemesan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" style="margin-top:5px;"><i class="fas fa-list-ul"></i> Daftar  Pemesan</h3>
                <div class="card-tools">
                  <a href="index.php?include=tambah-pemesan" class="btn btn-sm btn-info float-right">
                  <i class="fas fa-plus"></i> Tambah  Pemesan</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <div class="col-md-12">
                  <form method="POST" action="">
                    <div class="row">
                        <div class="col-md-4 bottom-10">
                          <input type="text" class="form-control" id="kata_kunci" name="katakunci">
                        </div>
                        <div class="col-md-5 bottom-10">
                          <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i>&nbsp; Search</button>
                        </div>
                    </div><!-- .row -->
                  </form>
                </div><br>
              <div class="col-sm-12">
              <?php if(!empty($_GET['notif'])){?>
                <?php if($_GET['notif']=="tambahpemesanberhasil"){?>
                    <div class="alert alert-success" role="alert">
                    Data Berhasil Ditambahkan</div>
                <?php } else if($_GET['notif']=="editberhasil"){?>
                  <div class="alert alert-success" role="alert">
                  Data Berhasil Diubah</div>
                  <?php } else if($_GET['notif']=="hapuspemesanberhasil"){?>
                  <div class="alert alert-success" role="alert">
                  Data Berhasil Dihapus</div>
                <?php }?>
              <?php }?>
</div>

              <table class="table table-bordered">
          <thead>                  
            <tr>
              <th width="5%">No</th>
              <th width="25%">Nama</th>
              <th width="25%">Email</th>
              <th width="20%">No Telp</th>
              <th width="15%"><center>Aksi</center></th>
            </tr>
          </thead>
          <tbody>
            <?php
            $batas = 10;
            //hitung jumlah semua data 
            $sql_jum = "SELECT `id_pemesan`, `nama` FROM `pemesan`"; 
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
            $sql_k = "SELECT `id_pemesan`, `nama`, `email`, `telp` FROM `pemesan`";
            if (isset($_POST["katakunci"])){
                        $katakunci_up = $_POST["katakunci"];
                        $sql_k .= " where `nama` LIKE '%$katakunci_up%' OR `email` LIKE '%$katakunci_up%'";
                        }
            $sql_k .= " ORDER BY `id_pemesan` limit $posisi, $batas";
            $query_k = mysqli_query($koneksi,$sql_k);
            $no = $posisi+1;
            while($data_k = mysqli_fetch_row($query_k)){
                $id_pemesan = $data_k[0];
                $nama = $data_k[1];
                $email = $data_k[2];
                $telp = $data_k[3];
            ?>
            <tr>
                <td><?php echo $posisi+1;?></td>
                <td><?php echo $nama;?></td>
                <td><?php echo $email;?></td>
                <td><?php echo $telp;?></td>
                <td align="center">
                  <a href="javascript:if(confirm('Anda yakin ingin menghapus data <?php echo $nama; ?>?'))window.location.href = 'index.php?include=pemesan&aksi=hapus&data=<?php echo $id_pemesan;?>&notif=hapuspemesanberhasil'" class="btn btn-xs btn-danger"><i class="fas fa-trash" title="Hapus"></i></a>
              </td>
            </tr>
            <?php $posisi++;}?>
            </tbody>
        </table>

              
              </div>
              
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
                  href='index.php?include=pemesan&halaman=1'>First</a></li>";
                  echo "<li class='page-item'><a class='page-link' 
                  href='index.php?include=pemesan&halaman=$sebelum'>«</a></li>";
                }
                for($i=1; $i<=$jum_halaman; $i++){
                    if ($i > $halaman - 5 and $i < $halaman + 5 ) {
                      if($i!=$halaman){
                          echo "<li class='page-item'><a class='page-link' 
                          href='index.php?include=pemesan&halaman=$i'>$i</a></li>";
                      }else{
                          echo "<li class='page-item'><a class='page-link'>$i</a></li>";
                      }
                    }
                }
                if($halaman!=$jum_halaman){
                      echo "<li class='page-item'><a class='page-link' 
                      href='index.php?include=pemesan&halaman=$setelah'>»</a></li>";
                      echo "<li class='page-item'><a class='page-link' 
                      href='index.php?include=pemesan&halaman=$jum_halaman'>Last</a></li>";
                }
              }?>
                    </ul>
              </div>
            </div>
            <!-- /.card -->

    </section>