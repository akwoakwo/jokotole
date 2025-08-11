<aside class="main-sidebar sidebar-light-primary elevation-4" style="background-color: #fff;color:white;">
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="../../dist/img/<?php echo $bariss['foto'] ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo $bariss['nama'] ?></a>
                <a href="#" style="font-size: 12px;"><i class="fa fa-circle text-success"></i> Admin</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
         <?php $current_page = basename($_SERVER['PHP_SELF']); ?>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                
                <li class="nav-item">
                    <a href="Dashboard_Admin.php" class="nav-link <?= $current_page == 'Dashboard_Admin.php' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="Kelayakan.php" class="nav-link <?= $current_page == 'Kelayakan.php' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-percent"></i>
                        <p>Kelayakan</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="Materi.php" class="nav-link <?= $current_page == 'Materi.php' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-chalkboard-teacher"></i>
                        <p>Materi</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="Evaluasi.php" class="nav-link <?= $current_page == 'Evaluasi.php' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-info"></i>
                        <p>Evaluasi</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="Data_Siswa.php" class="nav-link <?= $current_page == 'Data_Siswa.php' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-graduation-cap"></i>
                        <p>Data Siswa</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="Verifikasi_Absen_Siswa.php" class="nav-link <?= $current_page == 'Verifikasi_Absen_Siswa.php' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-check"></i>
                        <p>Verifikasi Absensi</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="Jadwal.php" class="nav-link <?= $current_page == 'Jadwal.php' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-clock-o"></i>
                        <p>Jadwal</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="spp.php" class="nav-link <?= $current_page == 'spp.php' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-receipt"></i>
                        <p>Informasi SPP</p>
                    </a>
                </li>

                <!-- <li class="nav-item">
                    <a href="pengajuan_lomba.php" class="nav-link <?= $current_page == 'pengajuan_lomba.php' ? 'active' : '' ?>">
                        <i class="nav-icon fa fa-trophy"></i>
                        <p>Pengajuan Lomba</p>
                    </a>
                </li> -->

                <li class="nav-item">
                    <a href="Pengaturan.php" class="nav-link <?= $current_page == 'Pengaturan.php' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>Pengaturan</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="../logout.php" class="nav-link">
                        <i class="nav-icon fa fa-sign-out"></i>
                        <p>Logout</p>
                    </a>
                </li>

            </ul>
        </nav>

        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>