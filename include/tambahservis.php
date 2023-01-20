<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3><i class="fas fa-plus"></i> Tambah Servis</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php?include=servis">Data Servis</a></li>
              <li class="breadcrumb-item active">Tambah Servis</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title"style="margin-top:5px;"><i class="far fa-list-alt"></i> Form Tambah Data Servis</h3>
        <div class="card-tools">
          <a href="index.php?include=servis" class="btn btn-sm btn-warning float-right">
          <i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
        </div>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      </br></br>
      <div class="col-sm-10">
      <?php if(!empty($_GET['notif'])){?>
      <?php if($_GET['notif']=="tambahkendaraankosong"){?>
      <div class="alert alert-danger" role="alert">
      Maaf data kendaraan wajib di isi</div>
      <?php }?>
      <?php if($_GET['notif']=="tambahdatekosong"){?>
      <div class="alert alert-danger" role="alert">
      Maaf data tanggal wajib di isi</div>
      <?php }?>
      <?php if($_GET['notif']=="tambahbiayakosong"){?>
      <div class="alert alert-danger" role="alert">
      Maaf data biaya wajib di isi</div>
      <?php }?>
      <?php if($_GET['notif']=="tambahketerangankosong"){?>
      <div class="alert alert-danger" role="alert">
      Maaf data keterangan wajib di isi</div>
      <?php }?>
      <?php }?>
      </div> 

      <form class="form-horizontal" action="index.php?include=konfirmasi-tambah-servis" method="post" enctype="multipart/form-data">
        <div class="card-body">
        <div class="form-group row">
          <label for="kategori" class="col-sm-3 col-form-label">Kendaraan</label>
          <div class="col-sm-7">
          <select class="form-control" id="kendaraan" name="kendaraan">
          <option value=""> Pilih Kendaraan </option>
          <?php 
          $sql_k = "SELECT `id_kendaraan`,`nama`,`nopol` FROM 
          `kendaraan` ORDER BY `id_kendaraan`";
          $query_k = mysqli_query($koneksi, $sql_k);
          while($data_k = mysqli_fetch_row($query_k)){
                $id_k = $data_k[0];
                $nama = $data_k[1];
                $nopol = $data_k[2];

          ?>
                <option value="<?php echo $id_k;?>"><?php echo $nopol;?> - <?php echo $nama;?> </option>
          <?php }?>
          </select>
          </div>
        </div>

          <div class="form-group row">
            <label for="date" class="col-sm-3 col-form-label">Tanggal</label>
            <div class="col-sm-7">
              <div class="input-group date">
                <input type="text" class="form-control" name="date" id="datepicker-days"  autocomplete="off"
                value="">
                  <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                  </div>
              </div>
            </div>
          </div>

          <div class="form-group row">
            <label for="biaya" class="col-sm-3 col-form-label">Biaya</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" name="biaya" id="biaya" value="">
            </div>
          </div>

          <div class="form-group row">
            <label for="ket" class="col-sm-3 col-form-label">Keterangan</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" name="keterangan" id="keterangan" value="">
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
 