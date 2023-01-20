<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
    <img src="includes/truck.png" alt="Admin Logo" class="brand-image" >
      <span class="brand-text font-weight-light">ADMIN</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="index.php?include=profil" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Profil
              </p>
            </a>
          </li>
          <?php 
            if (isset($_SESSION['level'])){
              if ($_SESSION['level']=="Admin"){?>
          <li class="nav-item">
            <a href="index.php?include=pesan" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Pesan
              </p>
            </a>
          </li>
          <?php }}?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-database"></i>
              <p>
                Data Pemesanan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?include=menunggu-persetujuan" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Menunggu Persetujuan</p>
                </a>
              </li>
              <?php 
            if (isset($_SESSION['level'])){
              if ($_SESSION['level']=="Admin"){?>
              <li class="nav-item">
                <a href="index.php?include=disetujui" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Disetujui</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?include=dipesan" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dipesan</p>
                </a>
              </li>
              <?php }}?>
            </ul>
          </li>
          
          <li class="nav-item">
            <a href="index.php?include=riwayat-pesanan" class="nav-link">
              <i class="nav-icon fas fa-address-book"></i>
              <p>
                Riwayat Pesanan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="index.php?include=kendaraan" class="nav-link">
              <i class="nav-icon fas fa-truck"></i>
              <p>
                Kendaraan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="index.php?include=servis" class="nav-link">
              <i class="nav-icon fas fa-wrench"></i>
              <p>
                Data Servis
              </p>
            </a>
          </li>
          
          <?php 
            if (isset($_SESSION['level'])){
              if ($_SESSION['level']=="Admin"){?>
          <li class="nav-item">
            <a href="index.php?include=pemesan" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Data Pemesan
              </p>
            </a>
          </li>
          <?php }}?>

          <?php 
            if (isset($_SESSION['level'])){
              if ($_SESSION['level']=="Admin"){?>
          <li class="nav-item">
            <a href="index.php?include=driver" class="nav-link">
              <i class="nav-icon fas fa-user-secret"></i>
              <p>
                Data Driver
              </p>
            </a>
          </li>
          <?php }}?>

          <?php 
          if (isset($_SESSION['level'])){
            if ($_SESSION['level']=="Admin"){?>
            <li class="nav-item">
                <a href="index.php?include=pengaturan-user" class="nav-link">
                <i class="nav-icon fas fa-user-cog"></i>
                <p>
                  Pengaturan User
                </p>
                </a>
            </li>
          <?php }}?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>