<?php
session_start();
if (!isset($_SESSION['nama']) && !isset($_SESSION['id_aktor'])) {
    header("Location: index.php");
}
require 'koneksidbMerch.php';

$id = $_GET["id"];

if (delete($id) > 0) {
    echo "
        <script>
            alert('Data Berhasil Dihapus');
            document.location.href = 'Kelola_Merchandise.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Data Gagal Dihapus');
            document.location.href = 'Kelola_Merchandise.php';
        </script>
    ";
}
