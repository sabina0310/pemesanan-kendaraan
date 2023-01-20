<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3><i class="fas fa-user-lock"></i> Ubah Password</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"> Ubah Password</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title"style="margin-top:5px;"><i class="far fa-list-alt"></i> Form Pengaturan Password</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <br>
      <div class="col-sm-12">
                <?php if(!empty($_GET['notif'])){?>
                  <?php if($_GET['notif']=="passlamakosong"){?>
                        <div class="alert alert-danger" role="alert">
                        Maaf password lama wajib di isi</div>
                  <?php } else if($_GET['notif']=="passbarukosong"){?>
                        <div class="alert alert-danger" role="alert">
                        Maaf password baru wajib di isi</div>
                  <?php } else if($_GET['notif']=="konfirmasikosong"){?>
                        <div class="alert alert-danger" role="alert">
                        Maaf password konfirmasi wajib di isi</div>
                  <?php } else if($_GET['notif']=="passwordlamasalah"){?>
                        <div class="alert alert-danger" role="alert">
                        Maaf password lama Anda salah</div>
                  <?php } else if($_GET['notif']=="passwordkonfirmasitidaksama"){?>
                        <div class="alert alert-danger" role="alert">
                        Maaf password baru dan password konfirmasi wajib sama</div>
                  <?php } else if($_GET['notif']=="ubahpasswordberhasil"){?>
                        <div class="alert alert-success" role="alert">
                        Password berhasil diubah</div>
                  <?php }?>
                    <?php }?>
              </div>
      <form class="form-horizontal" action="index.php?include=konfirmasi-ubah-password" method="POST">
        <div class="card-body">
          <h6>
            <i class="text-blue"><i class="fas fa-info-circle"></i> Silahkan memasukkan password lama dan password baru Anda untuk mengubah password.</i>
          </h6><br>
          
          <div class="form-group row">
            <label for="pass_lama" class="col-sm-3 col-form-label">Password Lama</label>
            <div class="col-sm-7">
              <input type="password" class="form-control" id="pass_lama" name="pass_lama" value="">
            </div>
          </div>
          <div class="form-group row">
            <label for="pass_baru" class="col-sm-3 col-form-label">Password Baru</label>
            <div class="col-sm-7">
              <input type="password" class="form-control" id="pass_baru" name="pass_baru" value="">
              <!--<span class="text-danger">Mohon maaf, password baru wajib diisi.</span>-->
            </div>
          </div>
          <div class="form-group row">
            <label for="konfirmasi" class="col-sm-3 col-form-label">Konfirmasi Password Baru</label>
            <div class="col-sm-7">
              <input type="password" class="form-control" id="konfirmasi" name="konfirmasi" value="">
              <!--<span class="text-danger">Mohon maaf, konfirmasi password baru wajib diisi.</span>-->
            </div>
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <div class="col-sm-10">
            <button type="submit" class="btn btn-info float-right"><i class="fas fa-save"></i> Simpan</button>
          </div>  
        </div>
        <!-- /.card-footer -->
      </form>
    </div>
    <!-- /.card -->

    </section>