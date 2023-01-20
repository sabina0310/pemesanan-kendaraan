<?php
if(isset($_GET['data'])){
	$id_kendaraan = $_GET['data'];
    $_SESSION['id_kendaraan'] = $id_kendaraan;
	//get data post
	$sql_m = "SELECT `id_kendaraan`, `nopol`, `nama` FROM `kendaraan` WHERE `id_kendaraan`='$id_kendaraan'";
	$query_m = mysqli_query($koneksi, $sql_m);
	while($data_m = mysqli_fetch_row($query_m)){
	$id_kendaraan = $data_m[0];
	$nopol = $data_m[1];
	$nama = $data_m[2];
	}
    

?>

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3><i class="fas fa-edit"></i> Form Pemesanan</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php?include=pesan">Data pesan</a></li>
              <li class="breadcrumb-item active">Form Pemesanan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title"style="margin-top:5px;"><i class="far fa-list-alt"></i> Form Edit Data post</h3>
        <div class="card-tools">
          <a href="index.php?include=pesan" class="btn btn-sm btn-warning float-right">
          <i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
        </div>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      </br></br>
      <div class="col-sm-10">
        <?php if((!empty($_GET['notif']))&&(!empty($_GET['jenis']))){?>
          <?php if($_GET['notif']=="editkosong"){?>
            <div class="alert alert-danger" role="alert">Maaf data 
            <?php echo $_GET['jenis'];?> wajib di isi</div>
          <?php }?>
        <?php }?>
      </div>

        <form class="form-horizontal" action="index.php?include=konfirmasi-pesan" method="post"
    enctype="multipart/form-data">
  <div class="card-body"> 
    <div class="form-group row">
        <label for="nopol" class="col-sm-3 col-form-label">Nopol</label>
        <div class="col-sm-7">
        <input type="text" class="form-control" name="nopol" id="nopol" 
        value="<?php echo $nopol;?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="nama" class="col-sm-3 col-form-label">Nama</label>
        <div class="col-sm-7">
        <input type="text" class="form-control" name="nama" id="nama" 
        value="<?php echo $nama;?>">
        </div>
    </div>

    <div class="form-group row">
          <label for="pemesan" class="col-sm-3 col-form-label">Pemesan</label>
          <div class="col-sm-7">
          <select class="form-control" id="pemesan" name="pemesan">
          <option value=""> Pilih Pemesan </option>
          <?php 
          $sql_pm = "SELECT `id_pemesan`,`nama` FROM `pemesan`
                  ORDER BY `id_pemesan`";
          $query_pm = mysqli_query($koneksi, $sql_pm);
          while($data_pm = mysqli_fetch_row($query_pm)){
          $id_pemesan = $data_pm[0];
          $nama = $data_pm[1];
          ?>
          <option value="<?php echo $id_pemesan;?>"><?php echo $nama;?></option>
          <?php }?>
          </select>
          </div>
          </div>
    
    <div class="form-group row">
          <label for="driver" class="col-sm-3 col-form-label">Driver</label>
          <div class="col-sm-7">
          <select class="form-control" id="driver" name="driver">
          <option value=""> Pilih Driver </option>
          <?php 
          $sql_d = "SELECT `id_driver`,`nama` FROM `driver` 
                  ORDER BY `id_driver`";
          $query_d = mysqli_query($koneksi, $sql_d);
          while($data_d = mysqli_fetch_row($query_d)){
          $id_driver = $data_d[0];
          $nama = $data_d[1];
          ?>
          <option value="<?php echo $id_user;?>"><?php echo $nama;?></option>
          <?php }?>
          </select>
          </div>
    </div>

    <div class="form-group row">
          <label for="atasan" class="col-sm-3 col-form-label">Persetujuan Atasan</label>
          <div class="col-sm-7">
          <select class="form-control" id="atasan" name="atasan">
          <option value=""> Pilih Atasan </option>
          <?php 
          $sql_t = "SELECT `id_user`,`nama` FROM `user` WHERE `level` = 'Atasan'
                  ORDER BY `id_user`";
          $query_t = mysqli_query($koneksi, $sql_t);
          while($data_t = mysqli_fetch_row($query_t)){
          $id_user = $data_t[0];
          $nama = $data_t[1];
          ?>
          <option value="<?php echo $id_user;?>"><?php echo $nama;?></option>
          <?php }?>
          </select>
          </div>
          </div>

          <div class="form-group row">
            <label for="date" class="col-sm-3 col-form-label">Tanggal Kembali</label>
            <div class="col-sm-7">
              <div class="input-group date">
                <input type="text" class="form-control" name="kembali" id="datepicker-days"  autocomplete="off"
                value="">
                  <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                  </div>
              </div>
            </div>
          </div>
             
    
  </div>
  </div>
  <!-- /.card-body -->
  <div class="card-footer">
      <div class="col-sm-12">
      <button type="submit" class="btn btn-info float-right"><i class="fas 
      fa-save"></i> Simpan</button>
      </div>  
      </div>
      <!-- /.card-footer -->
      <?php }?>
  </form>

    </div>
    <!-- /.card -->

    </section>

