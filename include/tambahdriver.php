<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3><i class="fas fa-plus"></i> Tambah Driver</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php?include=driver">Data Driver</a></li>
              <li class="breadcrumb-item active">Tambah Driver</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title"style="margin-top:5px;"><i class="far fa-list-alt"></i> Form Tambah Data Driver</h3>
        <div class="card-tools">
          <a href="index.php?include=driver" class="btn btn-sm btn-warning float-right"><i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
        </div>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      </br>
      <?php if(!empty($_GET['notif'])){?>
      <?php if($_GET['notif']=="tambahnamakosong"){?>
      <div class="alert alert-danger" role="alert">
      Maaf data nama wajib di isi</div>
      <?php }?>
      <?php if($_GET['notif']=="tambahemailkosong"){?>
      <div class="alert alert-danger" role="alert">
      Maaf data email wajib di isi</div>
      <?php }?>
      <?php if($_GET['notif']=="tambahtelpkosong"){?>
      <div class="alert alert-danger" role="alert">
      Maaf data telp wajib di isi</div>
      <?php }?>
      <?php }?>
      <form class="form-horizontal" method="post" action="index.php?include=konfirmasi-tambah-driver" enctype="multipart/form-data">
        <div class="card-body">
          <div class="form-group row">
            <label for="user" class="col-sm-12 col-form-label"><span class="text-info"><i class="fas fa-user-circle"></i> <u>Data Driver</u></span></label>
          </div>  
          <div class="form-group row">
            <label for="nama" class="col-sm-3 col-form-label">Nama</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" name="nama" id="nama" value="">
            </div>
          </div>
          <div class="form-group row">
            <label for="email" class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" name="email" id="email" value="">
            </div>
          </div>
          <div class="form-group row">
            <label for="notelp" class="col-sm-3 col-form-label">No Telp</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" name="notelp" id="notelp" value="">
            </div>
          </div>
          


      </div>
        <!-- /.card-body -->
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