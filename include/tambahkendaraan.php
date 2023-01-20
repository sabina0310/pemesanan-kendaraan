<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3><i class="fas fa-plus"></i> Tambah Kendaraan</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php?include=kendaraan">Data Kendaraan</a></li>
              <li class="breadcrumb-item active">Tambah Kendaraan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title"style="margin-top:5px;"><i class="far fa-list-alt"></i> Form Tambah Data Kendaraan</h3>
        <div class="card-tools">
          <a href="index.php?include=kendaraan" class="btn btn-sm btn-warning float-right">
          <i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
        </div>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      </br></br>
      <div class="col-sm-10">
      <?php if(!empty($_GET['notif'])){?>
      <?php if($_GET['notif']=="tambahnopolkosong"){?>
      <div class="alert alert-danger" role="alert">
      Maaf data nopol wajib di isi</div>
      <?php }?>
      <?php if($_GET['notif']=="tambahnamakosong"){?>
      <div class="alert alert-danger" role="alert">
      Maaf data nama wajib di isi</div>
      <?php }?>
      <?php if($_GET['notif']=="tambahbbmkosong"){?>
      <div class="alert alert-danger" role="alert">
      Maaf data bbm wajib di isi</div>
      <?php }?>
      <?php if($_GET['notif']=="tambahjeniskosong"){?>
      <div class="alert alert-danger" role="alert">
      Maaf data jenis wajib di isi</div>
      <?php }?>
      <?php if($_GET['notif']=="tambahkepemilikankosong"){?>
      <div class="alert alert-danger" role="alert">
      Maaf data kepemilikan wajib di isi</div>
      <?php }?>
      <?php if($_GET['notif']=="tambahstatuskosong"){?>
      <div class="alert alert-danger" role="alert">
      Maaf data status wajib di isi</div>
      <?php }?>
      <?php }?>
      </div> 

      <form class="form-horizontal" action="index.php?include=konfirmasi-tambah-kendaraan" method="post" enctype="multipart/form-data">
        <div class="card-body">
        <div class="form-group row">
            <label for="nopol" class="col-sm-3 col-form-label">Nopol</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" name="nopol" id="nopol" value="">
            </div>
          </div>

          <div class="form-group row">
            <label for="nama" class="col-sm-3 col-form-label">Nama</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" name="nama" id="nama" value="">
            </div>
          </div>

          <div class="form-group row">
            <label for="bbm" class="col-sm-3 col-form-label">BBM</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" name="bbm" id="bbm" value="">
            </div>
          </div>
          
          <div class="form-group row">
          <label for="kategori" class="col-sm-3 col-form-label">Jenis Kendaraan</label>
          <div class="col-sm-7">
          <select class="form-control" id="jenis" name="jenis">
          <option value=""> Pilih Jenis </option>
          <?php 
          $sql_k = "SELECT `id_jenis`,`nama` FROM 
          `jenis_kendaraan` ORDER BY `id_jenis`";
          $query_k = mysqli_query($koneksi, $sql_k);
          while($data_k = mysqli_fetch_row($query_k)){
                $id_j = $data_k[0];
                $nama = $data_k[1];
          ?>
                <option value="<?php echo $id_j;?>"><?php echo $nama;?></option>
          <?php }?>
          </select>
          </div>
        </div>

          <div class="form-group row">
          <label for="author" class="col-sm-3 col-form-label">Kepemilikan</label>
          <div class="col-sm-7">
          <select class="form-control" id="pemilik" name="pemilik">
          <option value=""> Pilih Kepemilikan </option>
          <?php 
          $sql_t = "SELECT `id_pemilik`,`nama` FROM `kepemilikan`
                  ORDER BY `id_pemilik`";
          $query_t = mysqli_query($koneksi, $sql_t);
          while($data_t = mysqli_fetch_row($query_t)){
          $id_pemilik = $data_t[0];
          $nama = $data_t[1];
          ?>
          <option value="<?php echo $id_pemilik;?>"><?php echo $nama;?></option>
          <?php }?>
          </select>
          </div>
          </div>
          <div class="form-group row">
          <label for="status" class="col-sm-3 col-form-label">Status</label>
          <div class="col-sm-7">
                        <select name="status" class="form-control" >
                            <option value="">Pilih Status</option>
                            <option value="Ada">Ada</option>
                            <option value="Tidak ada">Tidak ada</option>
                        </select>
          </div>
            </div>
             


          </div>
        </div>

      </div>
        <!-- /.card-footer -->
        <div class="card-footer">
          <div class="col-sm-12">
            <button type="submit" class="btn btn-info float-right"><i class="fas fa-plus"></i> Tambah</button>
          </div>  
        </div>
        <!-- /.card-footer -->
      </form>
    </div>
    <!-- /.card -->

    </section>
 