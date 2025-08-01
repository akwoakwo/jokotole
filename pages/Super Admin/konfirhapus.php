<?php
require_once "../config.php";

if (isset($_POST['berita_id'])) {
    $berita_id = $_POST['berita_id'];
?>

    <!DOCTYPE html>
    <html>

    <head>
        <script>
            function konfirmasiHapus() {
                var r = confirm("Apakah Anda yakin ingin menghapus berita ini?");
                if (r == true) {
                    // Jika pengguna menekan "Ya", lanjutkan dengan penghapusan
                    window.location.href = "hapus_berita.php?berita_id=<?php echo $berita_id; ?>";
                } else {
                    // Jika pengguna membatalkan, tampilkan pesan
                    alert("Penghapusan dibatalkan.");
                    window.location.href = "beritaagenda_SuperAdmin.php";
                }
            }
        </script>
    </head>

    <body>
        <button onclick="konfirmasiHapus()">Hapus Berita</button>
    </body>

    </html>

<?php
} else {
    echo "Berita ID tidak ditemukan.";
}
?>