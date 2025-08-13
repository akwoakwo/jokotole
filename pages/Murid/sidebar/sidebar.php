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
                <a href="#" class="d-block"><?php echo $namajurusan ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
         <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="pengaturan.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'pengaturan.php' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Profil</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="materi.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'materi.php' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Materi</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="Jadwal.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'Jadwal.php' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-calendar-check"></i>
                        <p>Jadwal</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="Absen.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'Absen.php' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-clipboard-check"></i>
                        <p>Absensi</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="Evaluasi.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'Evaluasi.php' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-info"></i>
                        <p>Evaluasi Latihan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="history_kenaikan_tingkat.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'history_kenaikan_tingkat.php' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-road"></i>
                        <p>Riwayat Tingkatan</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="spp.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'spp.php' ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-receipt"></i>
                        <p>Pembayaran SPP</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../logout.php" class="nav-link">
                        <i class="nav-icon fa fa-sign-out"></i>
                        <p>Logout</p>
                    </a>
                </li>

                <?php
                $id = $_SESSION['id_aktor'];
                $koneksi = mysqli_connect('localhost', 'urbeing1_jokotole_user', 'jokotoleuser0', 'urbeing1_jokotole');
                $sql = "SELECT * FROM aktor a WHERE id_aktor = $id";
                $hasil = mysqli_query($koneksi, $sql);
                $baris = mysqli_fetch_assoc($hasil);
                $pengajuan = $baris['jurusan_id'];
                

                // if ($pengajuan == '1') {
                //     echo '<li class="nav-item">
                //             <a href="pengaturan.php" class="nav-link ' . (basename($_SERVER['PHP_SELF']) == 'pengaturan.php' ? 'active' : '') . '">
                //                 <i class="nav-icon fas fa-trophy"></i>
                //                 <p>Pengajuan Lomba</p>
                //             </a>
                //         </li>';
                // }
                // if ($pengajuan == '2') {
                //     echo '<li class="nav-item">
                //             <a href="pengajuanlomba_tanding.php" class="nav-link ' . (basename($_SERVER['PHP_SELF']) == 'pengajuanlomba_tanding.php' ? 'active' : '') . '">
                //                 <i class="nav-icon fas fa-trophy"></i>
                //                 <p>Pengajuan Lomba</p>
                //             </a>
                //         </li>';
                // }
                // if ($pengajuan == '3') {
                //     echo '<li class="nav-item">
                //             <a href="pengajuanlomba_seni.php" class="nav-link ' . (basename($_SERVER['PHP_SELF']) == 'pengajuanlomba_seni.php' ? 'active' : '') . '">
                //                 <i class="nav-icon fas fa-trophy"></i>
                //                 <p>Pengajuan Lomba</p>
                //             </a>
                //         </li>';
                // }
                ?>
            </ul>
        </nav>

        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>