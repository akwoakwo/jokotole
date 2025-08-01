<?php
$koneksi = mysqli_connect("localhost", "root", "", "jokotole");
$sql = "SELECT * FROM aktor ORDER BY id_aktor DESC LIMIT 1";
$hasil = mysqli_query($koneksi, $sql);
$baris = mysqli_fetch_assoc($hasil);

require_once __DIR__ . '/../../vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();

$kopSurat = '
    <table width="100%" style="border-bottom: 1px solid;">
        <tr>
            <td width="20%">
                <img src="../../dist/img/logo.png" alt="Logo" width="100">
            </td>
            <td width="60%" align="center">
                <h2>DEWAN PENGURUS CABANG BANGKALAN</h2>
                <h2>PERGURUAN PENCAK SILAT JOKOTOLE</h2>
                <h2>DIKLAT KODIM 0829</h2>
                <p>Sekretariat : Kodim 0829 Bangkalan Jl. Letnan Abdullah</p>
                <p>e - mail: ffayyumnoma07@gmail.com</p>
            </td>
        </tr>
    </table>
';

$content = '
    <h3 style="text-align: center;"> BIODATA ANGGOTA </h3>
    <table width="80%" style="margin: 0 auto;">
        <!-- ... -->
        <tr style="margin-bottom: 10px;">
            <td width="35%">Nama</td>
            <td width="5%"> : </td>
            <td>' . $baris['nama'] . '</td>
        </tr>
        <tr style="margin-bottom: 10px;">
            <td width="35%">Tanggal Lahir</td>
            <td width="5%"> : </td>
            <td>' . $baris['tanggal_lahir'] . '</td>
        </tr>
        <tr style="margin-bottom: 10px;">
            <td width="35%">Jenis Kelamin</td>
            <td width="5%"> : </td>
            <td>' . $baris['gender'] . '</td>
        </tr>
        <tr style="margin-bottom: 10px;">
            <td width="35%">Telepon</td>
            <td width="5%"> : </td>
            <td>' . $baris['telepon'] . '</td>
        </tr>
        <tr style="margin-bottom: 10px;">
            <td width="35%">Telepon Orang tua</td>
            <td width="5%"> : </td>
            <td>' . $baris['telepon_wali'] . '</td>
        </tr>
        <tr style="margin-bottom: 10px;">
            <td width="35%">Alamat</td>
            <td width="5%"> : </td>
            <td>' . $baris['alamat'] . '</td>
        </tr>
        <tr style="margin-bottom: 10px;">
            <td width="35%">
                <br>
                <img src="../../dist/assets/img/profile/'.$baris['foto'].'" width="125px">
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr style="margin-bottom: 10px;">
            <td></td>
            <td></td>
            <td style="text-align: center;">
                <p>Bangkalan, ' . date('d-m-Y') . '</p>
                <br><br><br>
                <hr width="50%">
                <p>Orang Tua Murid</p>
            </td>
        </tr>
    </table>

    <br><hr>

    <p> Tambahan : </p>
    <ul type="square">
        <li> <b>Uang Pendaftaran</b> sebesar Rp. 50.000</li>
        <li> Uang Iuran Rp. 20.000 </li>
        <li>
            Harga Pakaian :
            <ul>
                <li> Ukuran S : Rp. 185.000  </li>
                <li> Ukuran M : Rp. 195.000  </li>
                <li> Ukuran L : Rp. 205.000 </li>
                <li> Ukuran XL : Rp. 215.000 </li>
            </ul>
        </li>
    </ul>

    <br><br><br><br><br><br>

    <p style="color: red; font-size: 10px;">*Formulir dibawa saat jadwal pertama kali latihan</p>
';

$html = $kopSurat . $content;
$mpdf->WriteHTML($html);
// $mpdf->WriteHTML('<h1>Hello World</h1>');
$mpdf->Output();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<img src="../../dist/assets/img/profile/" alt="Logo" width="100">
    <a href="../../vendor/autoload.php"></a>
</body>
</html>