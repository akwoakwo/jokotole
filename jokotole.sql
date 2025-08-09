-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 09, 2025 at 04:40 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jokotole`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id_absensi` int NOT NULL,
  `murid_id` int NOT NULL,
  `jadwal_latihan_id` int NOT NULL,
  `tanggal_absensi` date NOT NULL,
  `resume_materi` varchar(255) NOT NULL,
  `status_absensi` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `aktor`
--

CREATE TABLE `aktor` (
  `id_aktor` int NOT NULL,
  `jurusan_id` int NOT NULL,
  `nama` varchar(150) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `telepon_wali` varchar(15) NOT NULL,
  `tingkatan` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `aktor`
--

INSERT INTO `aktor` (`id_aktor`, `jurusan_id`, `nama`, `tanggal_lahir`, `email`, `telepon`, `gender`, `alamat`, `foto`, `telepon_wali`, `tingkatan`, `username`, `password`, `role`, `status`) VALUES
(1, 2, 'Mubessirul Ummah', '2023-11-02', 'muba@gmail.com', '0000', 'laki-laki', 'mmm', 'mubes.jpg', '1', 3, 'ww', 'ww', 'Siswa', 'tetap'),
(2, 3, 'soni', '2023-11-01', 'soni@gmail.com', '99999', 'laki-laki', 'gg', 'soni.jpg', '77', 1, 'soni', 'soni', 'Super Admin', 'n'),
(3, 1, 'Rama', '2023-11-02', 'rama@gmail.com', '628213233321', 'laki-laki', 'Jalan Diponegoro', 'rama.jpg', '222', 2, 'rama', 'rama', 'Admin', 'n'),
(10, 1, 'alif', '2023-12-14', 'alif@gmail.com', '8', 'laki-laki', 'a', 'a', '1', 2, 'alif', 'alif', 'Siswa', 'tetap'),
(12, 3, 'icha', '0000-00-00', 'icha@gmail.com', '', '', '', 'rama.jpg', '0868768', 2, 'icha', 'icha123', 'Siswa', 'tetap');

--
-- Triggers `aktor`
--
DELIMITER $$
CREATE TRIGGER `inserkelayakan` AFTER INSERT ON `aktor` FOR EACH ROW BEGIN 
    -- Cek kondisi: tingkatan = 1 dan status = 'tetap' 
    IF NEW.tingkatan = 1 AND NEW.status = 'tetap' THEN 
        -- Masukkan data ke tabel kelayakan_naik_tingkat 
        INSERT INTO kelayakan_naik_tingkat (id_kelayakan, murid_id, jumlah_pertemuan, salam_perguruan, dasar_kaki, dasar_tangan, jurus_tangan, jurus_kaki, langkah_segitiga, hindaran, zigzag_abc, pasangan, seni, pertemuan_latihan_fisik, status_kelayakan) 
        VALUES (UUID(), NEW.id_aktor, 0, '', '', '', '', '', '', '', '', '', '', 0, 'belum layak'); 
    END IF; 
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id_berita` int NOT NULL,
  `tanggal_berita` date NOT NULL,
  `judul_berita` varchar(50) NOT NULL,
  `deskripsi_berita` varchar(255) NOT NULL,
  `kategori_berita` varchar(25) NOT NULL,
  `referensi` varchar(255) NOT NULL,
  `foto_berita` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `evaluasi_diri`
--

CREATE TABLE `evaluasi_diri` (
  `id_evaluasi` int NOT NULL,
  `murid_id` int NOT NULL,
  `pelatih_id` int NOT NULL,
  `jadwal_latihan_id` int NOT NULL,
  `ulasan_pelatih` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galeri_prestasi`
--

CREATE TABLE `galeri_prestasi` (
  `id_prestasi` int NOT NULL,
  `nama_prestasi` varchar(50) NOT NULL,
  `tingkat_prestasi` varchar(25) NOT NULL,
  `deskripsi_prestasi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `foto_prestasi` varchar(255) NOT NULL,
  `murid_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `galeri_prestasi`
--

INSERT INTO `galeri_prestasi` (`id_prestasi`, `nama_prestasi`, `tingkat_prestasi`, `deskripsi_prestasi`, `foto_prestasi`, `murid_id`) VALUES
(1, 'Tanding Pencak Silat', 'akhir', 'aselole', 'tanding pencak silat.jpg', 1),
(5, 'Seni Tunggal', 'Nasional', 'Ini adalah lomba pencak silat seni tunggal yang dilakukan secara individu', 'f1e7907a6e32aed701cfc2a1d4d5bb8f.jpg', 10);

-- --------------------------------------------------------

--
-- Table structure for table `inventaris`
--

CREATE TABLE `inventaris` (
  `id_inventaris` int NOT NULL,
  `nama_barang` varchar(25) NOT NULL,
  `jumlah_barang` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `inventaris`
--

INSERT INTO `inventaris` (`id_inventaris`, `nama_barang`, `jumlah_barang`) VALUES
(2, 'Matras', 1),
(4, 'Seragam silat', 0),
(5, 'Sabuk', 20),
(6, 'Target pukulan', 0),
(7, 'Pelindung tulang kering', 0),
(8, 'Pelindung kepala', 0),
(9, 'Pelindung badan', 0),
(10, 'Samsak', 0),
(12, 'Keris', 0),
(34, 'Pisau', 4);

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_latihan`
--

CREATE TABLE `jadwal_latihan` (
  `id_jadwal` int(11) NOT NULL AUTO_INCREMENT,
  `pelatih_id` int(11) NOT NULL,
  `jadwal_latihan` date NOT NULL,
  `jenis_latihan` varchar(25) NOT NULL,
  `nama_latihan` varchar(25) NOT NULL,
  `deskripsi_latihan` varchar(255) NOT NULL,
  PRIMARY KEY (`id_jadwal`),
  KEY `pelatih_id` (`pelatih_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Menambahkan data sampel untuk pengujian
INSERT INTO `jadwal_latihan` (`pelatih_id`, `jadwal_latihan`, `jenis_latihan`, `nama_latihan`, `deskripsi_latihan`) VALUES
(3, '2023-12-15', 'Dasar', 'Latihan Pukulan', 'Latihan pukulan dasar untuk pemula.'),
(3, '2023-12-18', 'Seni', 'Jurus Tunggal', 'Memperdalam jurus tunggal untuk persiapan lomba.');
-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id_jurusan` int NOT NULL,
  `nama_jurusan` varchar(10) NOT NULL,
  `deskripsi_jurusan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id_jurusan`, `nama_jurusan`, `deskripsi_jurusan`) VALUES
(1, 'Belum', 'jjjjj'),
(2, 'Tanding', 'sss'),
(3, 'Seni', 'jjj');

-- --------------------------------------------------------

--
-- Table structure for table `kelayakan_naik_tingkat`
--

CREATE TABLE `kelayakan_naik_tingkat` (
  `id_kelayakan` int NOT NULL,
  `murid_id` int NOT NULL,
  `jumlah_pertemuan` int NOT NULL,
  `salam_perguruan` varchar(15) NOT NULL,
  `dasar_kaki` varchar(15) NOT NULL,
  `dasar_tangan` varchar(15) NOT NULL,
  `jurus_tangan` varchar(15) NOT NULL,
  `jurus_kaki` varchar(15) NOT NULL,
  `langkah_segitiga` varchar(15) NOT NULL,
  `hindaran` varchar(15) NOT NULL,
  `zigzag_abc` varchar(15) NOT NULL,
  `pasangan` varchar(15) NOT NULL,
  `seni` varchar(15) NOT NULL,
  `pertemuan_latihan_fisik` int NOT NULL,
  `status_kelayakan` varchar(15) NOT NULL,
  `pelatih_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kelayakan_naik_tingkat`
--

INSERT INTO `kelayakan_naik_tingkat` (`id_kelayakan`, `murid_id`, `jumlah_pertemuan`, `salam_perguruan`, `dasar_kaki`, `dasar_tangan`, `jurus_tangan`, `jurus_kaki`, `langkah_segitiga`, `hindaran`, `zigzag_abc`, `pasangan`, `seni`, `pertemuan_latihan_fisik`, `status_kelayakan`, `pelatih_id`) VALUES
(50, 12, 60, 'hafal', 'hafal', 'hafal', 'hafal', 'hafal', 'hafal', 'hafal', 'hafal', 'hafal', 'hafal', 40, 'layak', 0);

--
-- Triggers `kelayakan_naik_tingkat`
--
DELIMITER $$
CREATE TRIGGER `insertujian` AFTER UPDATE ON `kelayakan_naik_tingkat` FOR EACH ROW BEGIN
    DECLARE is_layak VARCHAR(10);
    SELECT status_kelayakan INTO is_layak FROM kelayakan_naik_tingkat WHERE id_kelayakan = NEW.id_kelayakan;

    IF is_layak = 'layak' THEN
        -- Masukkan data ke tabel ujian
        INSERT INTO ujian (id_siswa, nama_penguji, nilai_materi, nilai_fisik, nilai_beladiri, tingkat_lama, tingkat_baru, tanggal_ujian, keterangan, id_kelayakan)
        VALUES (NEW.murid_id, '', '', '', '', '', '', NOW(), '', NEW.id_kelayakan);
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_status_kelayakan` BEFORE UPDATE ON `kelayakan_naik_tingkat` FOR EACH ROW BEGIN
    DECLARE jumlah_pertemuan INT;
    DECLARE jumlah_materi_dikuasai INT;
    
    -- Ambil nilai jumlah pertemuan, jumlah materi dikuasai, dan pertemuan_latihan_fisik dari baris yang di-update
    SET jumlah_pertemuan = NEW.jumlah_pertemuan;
    SET jumlah_materi_dikuasai =
        (NEW.salam_perguruan = 'hafal') + 
        (NEW.dasar_kaki = 'hafal') + 
        (NEW.dasar_tangan = 'hafal') + 
        (NEW.jurus_tangan = 'hafal') + 
        (NEW.jurus_kaki = 'hafal') + 
        (NEW.langkah_segitiga = 'hafal') + 
        (NEW.hindaran = 'hafal') + 
        (NEW.zigzag_abc = 'hafal') + 
        (NEW.pasangan = 'hafal') + 
        (NEW.seni = 'hafal');
    
    -- Update status_kelayakan jika memenuhi kondisi
    IF jumlah_pertemuan >= 60 AND jumlah_materi_dikuasai = 10 AND NEW.pertemuan_latihan_fisik >= 30 THEN
        SET NEW.status_kelayakan = 'layak';
    ELSE
        SET NEW.status_kelayakan = 'belum layak'; -- Update status_kelayakan menjadi "belum layak" jika syarat tidak terpenuhi
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `kenaikan_tingkat`
--

CREATE TABLE `kenaikan_tingkat` (
  `id_kenaikan_tingkat` int NOT NULL,
  `kelayakan_id` int NOT NULL,
  `tingkat_old` varchar(20) NOT NULL,
  `tingkat_new` varchar(20) NOT NULL,
  `nama_penguji` varchar(20) NOT NULL,
  `tanggal_kenaikan` date NOT NULL,
  `status_kenaikan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE `materi` (
  `id_materi` int NOT NULL,
  `nama_materi` varchar(25) NOT NULL,
  `foto_materi` varchar(255) NOT NULL,
  `deskripsi_materi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `materi`
--

INSERT INTO `materi` (`id_materi`, `nama_materi`, `foto_materi`, `deskripsi_materi`) VALUES
(2, ' Materi Dasar (Pemula)', 'download.jpeg', 'Materi dasar adalah tahap awal dalam pembelajaran pencak silat yang bertujuan untuk membentuk dasar gerak, mental, dan disiplin seorang pesilat. Di tingkat ini, peserta didik belum diajarkan teknik bertarung, tetapi difokuskan pada penguasaan postur tubuh, keseimbangan, serta koordinasi gerakan dasar.'),
(3, 'Pukulan Samping', '6ca57a98aed029fe4110394aa01f16ab.jpg', 'Pukulan samping adalah teknik serangan yang dilakukan dengan mengayunkan tangan dari arah samping tubuh menuju sasaran. Gerakan ini biasanya diawali dengan posisi tangan di dekat pinggang atau bahu, lalu digerakkan secara cepat ke arah target dengan memutar pinggang dan memanfaatkan kekuatan bahu. Tujuannya adalah memberikan tekanan atau benturan dari arah horizontal, sehingga lawan sulit mengantisipasi.');

-- --------------------------------------------------------

--
-- Table structure for table `merchandise`
--

CREATE TABLE `merchandise` (
  `id_merchandise` int NOT NULL,
  `nama_merchandise` varchar(25) NOT NULL,
  `harga_merchandise` int NOT NULL,
  `deskripsi_merchandise` varchar(255) NOT NULL,
  `foto_merchandise` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `merchandise`
--

INSERT INTO `merchandise` (`id_merchandise`, `nama_merchandise`, `harga_merchandise`, `deskripsi_merchandise`, `foto_merchandise`) VALUES
(1, 'Baju Silat', 50000, 'Ini baju silat', 'bajusilat2.jpg'),
(2, 'Sabuk', 20000, 'Ini adalah sabuk', 'sabuk.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id_message` int NOT NULL,
  `id_aktor` int NOT NULL,
  `nama_pengirim` varchar(100) NOT NULL,
  `email_pengirim` varchar(100) NOT NULL,
  `message` varchar(2000) NOT NULL,
  `balasan` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id_message`, `id_aktor`, `nama_pengirim`, `email_pengirim`, `message`, `balasan`) VALUES
(1, 1, 'Mubessirul Ummah', 'muba@gmail.com', 'aku mau kinderjoy akan tetapi aku memiliki susu indomilk yang sungguh lezat', 'Hai kak mubes, saya memahami perasaan anda bahwa kinderjoy sangat enak. tunggu kami untuk membelikannya untuk anda.terimakasih xie xie ~super admin nyunyu'),
(2, 1, 'Mubessirul Ummah', 'muba@gmail.com', 'gimana nih caranya membeli merchandise?', 'Hai kak mubes, cara membeli merchandise adalah dengan mempunyai uang!'),
(3, 2, 'soni', 'soni@gmail.com', 'aduh kejedot', '<p>ikan lele ikan marlin<br />\r\nwah syukurin</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran_spp`
--

CREATE TABLE `pembayaran_spp` (
  `id_pembayaran` int NOT NULL,
  `murid_id` int NOT NULL,
  `tanggal_bayar` date DEFAULT NULL,
  `nominal_bayar` int NOT NULL,
  `deadline_pembayaran` date NOT NULL,
  `status_bayar` varchar(25) NOT NULL,
  `bulan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pembayaran_spp`
--

INSERT INTO `pembayaran_spp` (`id_pembayaran`, `murid_id`, `tanggal_bayar`, `nominal_bayar`, `deadline_pembayaran`, `status_bayar`, `bulan`) VALUES
(1, 1, '2023-12-03', 20000, '2023-12-01', 'BELUM LUNAS', 'December 2023'),
(2, 12, '2025-08-01', 0, '2023-12-11', 'belum bayar', 'December 2023'),
(3, 1, NULL, 20000, '2025-08-06', 'belum lunas', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_lomba`
--

CREATE TABLE `pengajuan_lomba` (
  `id_pengajuan` int NOT NULL,
  `murid_id` int NOT NULL,
  `rekomendasi_id` int NOT NULL,
  `berat_badan` int NOT NULL,
  `tinggi_badan` int NOT NULL,
  `bukti_persetujuan_ortu` varchar(255) NOT NULL,
  `bukti_sehat` varchar(255) NOT NULL,
  `status_pengajuan` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penjual`
--

CREATE TABLE `penjual` (
  `id_penjual` int NOT NULL,
  `no_hp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `penjual`
--

INSERT INTO `penjual` (`id_penjual`, `no_hp`) VALUES
(1, '+6285378796567');

-- --------------------------------------------------------

--
-- Table structure for table `profile_perguruan`
--

CREATE TABLE `profile_perguruan` (
  `id_profil_perguruan` int NOT NULL,
  `sejarah` varchar(2000) NOT NULL,
  `visi_misi` varchar(2000) NOT NULL,
  `frame_map` varchar(2000) NOT NULL,
  `arti_lambang` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `profile_perguruan`
--

INSERT INTO `profile_perguruan` (`id_profil_perguruan`, `sejarah`, `visi_misi`, `frame_map`, `arti_lambang`) VALUES
(1, '<p>Dalam sebuah dusun kecil di Madura, perguruan silat tradisional Sumber Gaya, yang didirikan pada tahun 1964, hampir punah karena kondisi lingkungan yang sulit. Namun, semangat Suhaimi, salah satu muridnya, mendorongnya untuk mencari murid baru dan mengembangkan perguruan ini. Dengan dukungan dari tokoh seperti Bapak Nesman dan Bapak Marjuki, Suhaimi berhasil meraih gelar juara Nasional pada tahun 1975 dan 1976. Pada 21 Maret 1976, atas ilham Ilahi, perguruan ini diubah namanya menjadi &quot;JOKOTOLE,&quot; mengambil inspirasi dari seorang pahlawan Madura pada zaman Majapahit. Dengan Suhaimi sebagai pendiri dan dukungan enam tokoh lainnya, Perguruan Silat JOKOTOLE resmi terbentuk di desa Kamal, Kecamatan Kamal, Kabupaten Bangkalan, Madura, menandai kelahiran sebuah lembaga berharga dalam sejarah seni bela diri di Indonesia.</p>\r\n', '<ol>\r\n	<li>Dalam sebuah dusun kecil di Madura, perguruan silat tradisional Sumber Gaya, yang didirikan pada tahun 1964, hampir punah karena kondisi lingkungan yang sulit. Namun, semangat Suhaimi, salah satu muridnya, mendorongnya untuk mencari murid baru dan mengembangkan perguruan ini.</li>\r\n	<li>Dengan dukungan dari tokoh seperti Bapak Nesman dan Bapak Marjuki, Suhaimi berhasil meraih gelar juara Nasional pada tahun 1975 dan 1976. Pada 21 Maret 1976, atas ilham Ilahi, perguruan ini diubah namanya menjadi &quot;JOKOTOLE,&quot; mengambil inspirasi dari seorang pahlawan Madura pada zaman Majapahit.</li>\r\n	<li>Dengan Suhaimi sebagai pendiri dan dukungan enam tokoh lainnya, Perguruan Silat JOKOTOLE resmi terbentuk di desa Kamal, Kecamatan Kamal, Kabupaten Bangkalan, Madura, menandai kelahiran sebuah lembaga berharga dalam sejarah seni bela diri di Indonesia.</li>\r\n</ol>\r\n', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15839.264045796448!2d112.7388922187042!3d-7.030900191012783!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd805bc80a129f7%3A0x1f991459988025cd!2sKODIM%200829%2FBKL!5e0!3m2!1sid!2sid!4v1754437770853!5m2!1sid!2sid\" width=\"1200\" height=\"600\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', '<ol>\r\n	<li>Ukuran Bendera 120 x 180 cm</li>\r\n	<li>Warna Dasar Bendera : Hijau Berarti Kedamaian dan Siap setiap saat.</li>\r\n	<li>Warna Dasar Lambang Kuning Emas berarti Jokotole mempunyai masa keemasan atau kejayaan dalam masa-masa mendatang.</li>\r\n	<li>Bentuk Warna Tangga : Putih, Kuning, Merah, Coklat, Hijau, berarti menunjukkan tingkatan sabuk dari anggota PPS. JOKOTOLE</li>\r\n	<li>Pecut : Warna Cokelat agak Kuning Berarti melambangkan semangat panas PPS. Jokotole, semangat yang tak pernah luntur karena rintangan apapun serta tak lekang kepanasan dan tak lepuk kehujanan, maju tak gentar pantang mundur &ldquo; Berani Karena Benar dan Takut Karena Salah &ldquo;</li>\r\n	<li>Pintu Gerbang : Warna Coklat Berarti merupakan seni budaya artistik warisan nenek moyang yang harus dilestarikan.</li>\r\n	<li>Tulisan &ldquo; WICAKSANA &ldquo; Dalam Filsafah mempunyai arti secara mendalam, arif bijaksana, adil mengerti pada kehendak siapapun sebelum dilahirkan dengan kata-kata.</li>\r\n</ol>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `rekomendasi_lomba`
--

CREATE TABLE `rekomendasi_lomba` (
  `id_rekomendasi` int NOT NULL,
  `nama_perlombaan` varchar(25) NOT NULL,
  `tingkat_perlombaan` varchar(25) NOT NULL,
  `jenis_perlombaan` varchar(25) NOT NULL,
  `deskripsi_lomba` varchar(255) NOT NULL,
  `pamflet` varchar(255) NOT NULL,
  `tempat_lomba` varchar(150) NOT NULL,
  `tanggal_lomba` date NOT NULL,
  `referensi` varchar(255) NOT NULL,
  `jurusan_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ujian`
--

CREATE TABLE `ujian` (
  `id_ujian` int NOT NULL,
  `id_siswa` int NOT NULL,
  `nama_penguji` varchar(50) NOT NULL,
  `nilai_materi` int NOT NULL,
  `nilai_fisik` int NOT NULL,
  `nilai_beladiri` int NOT NULL,
  `tingkat_lama` int NOT NULL,
  `tingkat_baru` int NOT NULL,
  `tanggal_ujian` date NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `id_kelayakan` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ujian`
--

INSERT INTO `ujian` (`id_ujian`, `id_siswa`, `nama_penguji`, `nilai_materi`, `nilai_fisik`, `nilai_beladiri`, `tingkat_lama`, `tingkat_baru`, `tanggal_ujian`, `keterangan`, `id_kelayakan`) VALUES
(7, 12, 'soni', 88, 88, 88, 1, 2, '2023-12-12', 'lulus', 50);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absensi`),
  ADD KEY `jadwal_latihan_id` (`jadwal_latihan_id`),
  ADD KEY `murid_id` (`murid_id`);

--
-- Indexes for table `aktor`
--
ALTER TABLE `aktor`
  ADD PRIMARY KEY (`id_aktor`),
  ADD KEY `jurusan_id` (`jurusan_id`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id_berita`);

--
-- Indexes for table `evaluasi_diri`
--
ALTER TABLE `evaluasi_diri`
  ADD PRIMARY KEY (`id_evaluasi`),
  ADD KEY `murid_id` (`murid_id`),
  ADD KEY `pelatih_id` (`pelatih_id`),
  ADD KEY `jadwal_latihan_id` (`jadwal_latihan_id`);

--
-- Indexes for table `galeri_prestasi`
--
ALTER TABLE `galeri_prestasi`
  ADD PRIMARY KEY (`id_prestasi`),
  ADD KEY `murid_id` (`murid_id`);

--
-- Indexes for table `inventaris`
--
ALTER TABLE `inventaris`
  ADD PRIMARY KEY (`id_inventaris`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indexes for table `kelayakan_naik_tingkat`
--
ALTER TABLE `kelayakan_naik_tingkat`
  ADD PRIMARY KEY (`id_kelayakan`),
  ADD KEY `murid_id` (`murid_id`);

--
-- Indexes for table `kenaikan_tingkat`
--
ALTER TABLE `kenaikan_tingkat`
  ADD PRIMARY KEY (`id_kenaikan_tingkat`),
  ADD KEY `kelayakan_id` (`kelayakan_id`);

--
-- Indexes for table `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id_materi`);

--
-- Indexes for table `merchandise`
--
ALTER TABLE `merchandise`
  ADD PRIMARY KEY (`id_merchandise`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id_message`);

--
-- Indexes for table `pembayaran_spp`
--
ALTER TABLE `pembayaran_spp`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `murid_id` (`murid_id`);

--
-- Indexes for table `pengajuan_lomba`
--
ALTER TABLE `pengajuan_lomba`
  ADD PRIMARY KEY (`id_pengajuan`),
  ADD KEY `murid_id` (`murid_id`),
  ADD KEY `rekomendasi_id` (`rekomendasi_id`);

--
-- Indexes for table `penjual`
--
ALTER TABLE `penjual`
  ADD PRIMARY KEY (`id_penjual`);

--
-- Indexes for table `profile_perguruan`
--
ALTER TABLE `profile_perguruan`
  ADD PRIMARY KEY (`id_profil_perguruan`);

--
-- Indexes for table `rekomendasi_lomba`
--
ALTER TABLE `rekomendasi_lomba`
  ADD PRIMARY KEY (`id_rekomendasi`),
  ADD KEY `jurusan_id` (`jurusan_id`);

--
-- Indexes for table `ujian`
--
ALTER TABLE `ujian`
  ADD PRIMARY KEY (`id_ujian`),
  ADD KEY `id_kelayakan` (`id_kelayakan`),
  ADD KEY `id_siswa` (`id_siswa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id_absensi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `evaluasi_diri`
--
ALTER TABLE `evaluasi_diri`
  MODIFY `id_evaluasi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `galeri_prestasi`
--
ALTER TABLE `galeri_prestasi`
  MODIFY `id_prestasi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `inventaris`
--
ALTER TABLE `inventaris`
  MODIFY `id_inventaris` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `materi`
--
ALTER TABLE `materi`
  MODIFY `id_materi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `merchandise`
--
ALTER TABLE `merchandise`
  MODIFY `id_merchandise` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id_message` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pembayaran_spp`
--
ALTER TABLE `pembayaran_spp`
  MODIFY `id_pembayaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `profile_perguruan`
--
ALTER TABLE `profile_perguruan`
  MODIFY `id_profil_perguruan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ujian`
--
ALTER TABLE `ujian`
  MODIFY `id_ujian` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_ibfk_1` FOREIGN KEY (`jadwal_latihan_id`) REFERENCES `jadwal_latihan` (`id_jadwal`),
  ADD CONSTRAINT `absensi_ibfk_2` FOREIGN KEY (`murid_id`) REFERENCES `aktor` (`id_aktor`);

--
-- Constraints for table `aktor`
--
ALTER TABLE `aktor`
  ADD CONSTRAINT `aktor_ibfk_1` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusan` (`id_jurusan`);

--
-- Constraints for table `evaluasi_diri`
--
ALTER TABLE `evaluasi_diri`
  ADD CONSTRAINT `evaluasi_diri_ibfk_1` FOREIGN KEY (`murid_id`) REFERENCES `aktor` (`id_aktor`),
  ADD CONSTRAINT `evaluasi_diri_ibfk_2` FOREIGN KEY (`pelatih_id`) REFERENCES `aktor` (`id_aktor`),
  ADD CONSTRAINT `evaluasi_diri_ibfk_3` FOREIGN KEY (`jadwal_latihan_id`) REFERENCES `jadwal_latihan` (`id_jadwal`);

--
-- Constraints for table `galeri_prestasi`
--
ALTER TABLE `galeri_prestasi`
  ADD CONSTRAINT `galeri_prestasi_ibfk_1` FOREIGN KEY (`murid_id`) REFERENCES `aktor` (`id_aktor`);

--
-- Constraints for table `jadwal_latihan`
--
ALTER TABLE `jadwal_latihan`
  ADD CONSTRAINT `jadwal_latihan_ibfk_1` FOREIGN KEY (`pelatih_id`) REFERENCES `aktor` (`id_aktor`);

--
-- Constraints for table `kelayakan_naik_tingkat`
--
ALTER TABLE `kelayakan_naik_tingkat`
  ADD CONSTRAINT `kelayakan_naik_tingkat_ibfk_1` FOREIGN KEY (`murid_id`) REFERENCES `aktor` (`id_aktor`);

--
-- Constraints for table `kenaikan_tingkat`
--
ALTER TABLE `kenaikan_tingkat`
  ADD CONSTRAINT `kenaikan_tingkat_ibfk_1` FOREIGN KEY (`kelayakan_id`) REFERENCES `kelayakan_naik_tingkat` (`id_kelayakan`);

--
-- Constraints for table `pembayaran_spp`
--
ALTER TABLE `pembayaran_spp`
  ADD CONSTRAINT `pembayaran_spp_ibfk_1` FOREIGN KEY (`murid_id`) REFERENCES `aktor` (`id_aktor`);

--
-- Constraints for table `pengajuan_lomba`
--
ALTER TABLE `pengajuan_lomba`
  ADD CONSTRAINT `pengajuan_lomba_ibfk_1` FOREIGN KEY (`murid_id`) REFERENCES `aktor` (`id_aktor`),
  ADD CONSTRAINT `pengajuan_lomba_ibfk_2` FOREIGN KEY (`rekomendasi_id`) REFERENCES `rekomendasi_lomba` (`id_rekomendasi`);

--
-- Constraints for table `rekomendasi_lomba`
--
ALTER TABLE `rekomendasi_lomba`
  ADD CONSTRAINT `rekomendasi_lomba_ibfk_1` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusan` (`id_jurusan`);

--
-- Constraints for table `ujian`
--
ALTER TABLE `ujian`
  ADD CONSTRAINT `ujian_ibfk_1` FOREIGN KEY (`id_kelayakan`) REFERENCES `kelayakan_naik_tingkat` (`id_kelayakan`),
  ADD CONSTRAINT `ujian_ibfk_2` FOREIGN KEY (`id_siswa`) REFERENCES `aktor` (`id_aktor`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
