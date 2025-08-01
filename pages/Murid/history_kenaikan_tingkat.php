<?php
$koneksi = mysqli_connect("localhost", "root", "", "jokotole");
$sql = "SELECT a.nama,k.* FROM kelayakan_naik_tingkat k INNER JOIN aktor a ON k.pelatih_id = a.id_aktor WHERE murid_id = 2";
// $sql = "SELECT COUNT(*) FROM kelayakan_naik_tingkat WHERE murid_id = SESSION['murid_id']";
// $tampil1 = mysqli_query($koneksi2, $sql1);
$tampil = mysqli_query($koneksi, $sql);

$colorDictionary = array(
    'MERAH1' => 'red',
    'MERAH2' => 'red',
    'COKLAT' => 'brown',
    'HIJAU' => 'green',
    'KUNING1' => 'yellow',
    'KUNING2' => 'yellow',
    'PUTIH' => 'white',
    // Tambahkan warna lainnya sesuai kebutuhan Anda
);
function translateColor($colorName, $colorDictionary)
{
    // Default, jika tidak ada padanan, gunakan nama asli
    $translatedColor = $colorName;

    // Cek apakah nama warna ada dalam kamus
    if (array_key_exists($colorName, $colorDictionary)) {
        $translatedColor = $colorDictionary[$colorName];
    }

    return $translatedColor;
}
$sql1 = "SELECT tingkatan FROM aktor WHERE id_aktor = 2";
// $sql1 = "SELECT tingkatan FROM aktor WHERE id_aktor = SESSION['murid_id']";
$sql2 = "SELECT COUNT(*) AS JUMLAH FROM kelayakan_naik_tingkat WHERE murid_id = 2";
$tampil1 = mysqli_query($koneksi, $sql1);
$tampil2 = mysqli_query($koneksi, $sql2);

// Loop melalui hasil query dan terjemahkan warna
while ($data = mysqli_fetch_array($tampil1)) {
    $namaWarnaBahasaIndonesia = $data['tingkatan'];

    // Dapatkan warna terjemahan
    $translatedColor = translateColor($namaWarnaBahasaIndonesia, $colorDictionary);
}
while ($data1 = mysqli_fetch_array($tampil2)) {
    $counter = $data1['JUMLAH'];
}






?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../dist/css/kel1-1.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <style>
        .container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            column-gap: 20rem;
        }

        .c1 {
            padding-top: 0.5rem;
            padding-left: 0.5rem;
            padding-right: 0.5rem;
            padding-bottom: 0.5rem;
            background-color: white;
            display: grid;
            grid-template-columns: 1fr 1fr;
            border-radius: 10%;
        }

        .c11 {
            border-radius: 10%;
            padding-top: 0.5rem;
            padding-left: 0.5rem;
            padding-right: 0.5rem;
            padding-bottom: 0.5rem;
            background-color: black;
            color: white;
        }

        .c12 {
            text-align: center;
            padding-top: 0.5rem;
            padding-left: 0.5rem;
            padding-right: 0.5rem;
            padding-bottom: 0.5rem;

        }

        .c2 {
            padding-top: 0.5rem;
            padding-left: 0.5rem;
            padding-right: 0.5rem;
            padding-bottom: 0.5rem;
            background-color: <?php echo $translatedColor; ?>;
            display: grid;
            grid-template-columns: 1fr 1fr;
            border-radius: 10%;
        }

        .c21 {
            border-radius: 10%;
            border: 2px solid black;
            padding-top: 0.5rem;
            padding-left: 0.5rem;
            padding-right: 0.5rem;
            padding-bottom: 0.5rem;
            background-color: white;
            color: black;
        }

        .c22 {
            text-align: center;
            padding-top: 2.5rem;
            padding-left: 0.5rem;
            padding-right: 0.5rem;
            padding-bottom: 0.5rem;
            color: white;
            text-shadow: 2px 2px 3px #000000;

        }

        .container2 {
            background-color: white;
            margin-top: 0.5rem;
        }
    </style>
</head>

<body>
    <div class="pembungkus">
        <div class="sidebar">
            <div class="profile">
                <div class="foto">
                    <img src="../../dist/img/silat.png" alt="silat">
                </div>
                <div class="description">
                    <h4>Nama Profil</h4>
                    <p>Jurusan</p>
                </div>
            </div>
            <div class="main">
                <div class="list_item">
                    <a href=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
                            <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z" />
                        </svg>
                        Pengaturan
                    </a>
                </div>
                <div class="list_item">
                    <a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list-task" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M2 2.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5V3a.5.5 0 0 0-.5-.5H2zM3 3H2v1h1V3z" />
                            <path d="M5 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM5.5 7a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 4a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9z" />
                            <path fill-rule="evenodd" d="M1.5 7a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5V7zM2 7h1v1H2V7zm0 3.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5H2zm1 .5H2v1h1v-1z" />
                        </svg>
                        Jadwal
                    </a>
                </div>
                <div class="list_item">
                    <a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar3" viewBox="0 0 16 16">
                            <path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z" />
                            <path d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                        </svg>
                        Absensi</a>
                </div>
                <div class="list_item">
                    <a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16">
                            <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z" />
                            <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z" />
                            <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z" />
                        </svg>
                        Riwayat</a>
                </div>
                <div class="list_item">
                    <a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-text-fill" viewBox="0 0 16 16">
                            <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM4.5 9a.5.5 0 0 1 0-1h7a.5.5 0 0 1 0 1h-7zM4 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 1 0-1h4a.5.5 0 0 1 0 1h-4z" />
                        </svg>
                        Evaluasi Latihan</a>
                </div>
                <div class="list_item">
                    <a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trophy" viewBox="0 0 16 16">
                            <path d="M2.5.5A.5.5 0 0 1 3 0h10a.5.5 0 0 1 .5.5c0 .538-.012 1.05-.034 1.536a3 3 0 1 1-1.133 5.89c-.79 1.865-1.878 2.777-2.833 3.011v2.173l1.425.356c.194.048.377.135.537.255L13.3 15.1a.5.5 0 0 1-.3.9H3a.5.5 0 0 1-.3-.9l1.838-1.379c.16-.12.343-.207.537-.255L6.5 13.11v-2.173c-.955-.234-2.043-1.146-2.833-3.012a3 3 0 1 1-1.132-5.89A33.076 33.076 0 0 1 2.5.5zm.099 2.54a2 2 0 0 0 .72 3.935c-.333-1.05-.588-2.346-.72-3.935zm10.083 3.935a2 2 0 0 0 .72-3.935c-.133 1.59-.388 2.885-.72 3.935zM3.504 1c.007.517.026 1.006.056 1.469.13 2.028.457 3.546.87 4.667C5.294 9.48 6.484 10 7 10a.5.5 0 0 1 .5.5v2.61a1 1 0 0 1-.757.97l-1.426.356a.5.5 0 0 0-.179.085L4.5 15h7l-.638-.479a.501.501 0 0 0-.18-.085l-1.425-.356a1 1 0 0 1-.757-.97V10.5A.5.5 0 0 1 9 10c.516 0 1.706-.52 2.57-2.864.413-1.12.74-2.64.87-4.667.03-.463.049-.952.056-1.469H3.504z" />
                        </svg>
                        Pengajuan Lomba</a>
                </div>
                <div class="list_item">
                    <a href="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" />
                            <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                        </svg>
                        Logout</a>
                </div>
            </div>
            <div class="btn_back">
                <a class="btn btn-success" href="#" role="button">Back</a>

            </div>
        </div>
        <div class="r">
            <div class="main-content" style="padding-top: 1rem;">
                <h1 style="color: white;">HISTORY KENAIKAN TINGKAT</h1>
                <div class="container">
                    <div class="c1">
                        <div class="c11">
                            <h4>Berapa kali perubahan</h4>
                        </div>
                        <div class="c12">
                            <h4 style="font-size: 5rem;"><?php echo $counter ?></h4>
                        </div>
                    </div>
                    <div class="c2">
                        <div class="c21">
                            <h4>Tingkatan Saat ini</h4>
                        </div>
                        <div class="c22">
                            <h3><?php echo $namaWarnaBahasaIndonesia ?></h3>
                        </div>
                    </div>
                </div>
                <div class="container2" style="width: 56.5rem;margin-left: 1.6rem;border-radius:10%;">
                    <?php
                    while ($row = mysqli_fetch_assoc($tampil)) {
                        $warnalama = $row['tingkat_lama'];
                        $warnabaru = $row['tingkat_baru'];

                        // Dapatkan warna terjemahan
                        $translatedColor1 = translateColor($warnalama, $colorDictionary);
                        $translatedColor2 = translateColor($warnabaru, $colorDictionary);
                    ?>
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button style="background-image: linear-gradient(to right,<?php echo $translatedColor1; ?> , <?php echo $translatedColor2; ?>);width:56.5rem;color:white;text-shadow: 2px 2px 3px #000000;" class="accordion-button-color" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <?php echo $row['tingkat_lama']; ?> -> <?php echo $row['tingkat_baru']; ?>
                                    </button>
                                    <!-- <button style="background-image: linear-gradient(to right, <?php echo $row['tingkat_old']; ?> , <?php echo $row['tingkat_baru']; ?>);width:56.5rem;color:white;text-shadow: 2px 2px 3px #000000;" class="accordion-button-color" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            MERAH -> PUTIH
                        </button> -->
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body" style="display: grid;grid-template-columns:1fr 1fr 1fr;">
                                        <div style="background-color: white;color:black;width:8rem;height:5rem;text-align:center;border: 3px solid black;border-radius:0px 0px 20px 20px">
                                            <div style="background-color: black;border-bottom: 5px solid black;height:2rem;color:white;">
                                                <p>---Tanggal---</p>
                                            </div>
                                            <p style="font-size: 0.9rem;padding-top:0.3rem;"><?php echo $row['tanggal_kenaikan']; ?></p>
                                        </div>
                                        <div style="background-color: white;color:black;margin-left:0rem;width:35rem;text-align:center;border: 3px solid black;border-radius:0px 0px 20px 20px">
                                            <div style="background-color: black;border-bottom: 5px solid black;height:2rem;color:white;">
                                                <p>---MATERI YANG DIUJIKAN---</p>
                                            </div>
                                            <div style="display: grid;grid-template-columns:1fr 1fr 1fr 1fr;">
                                                <div>
                                                    <p style="font-size: 0.9rem;padding-top:0.3rem;">-PERTEMUAN-</p>
                                                    <p style="font-size: 0.9rem;"><?php echo $row['jumlah_pertemuan']; ?></p>
                                                </div>
                                                <div>
                                                    <p style="font-size: 0.9rem;padding-top:0.3rem;">-HAFAL MATERI-</p>
                                                    <p style="font-size: 0.9rem;"><?php echo $row['hafal_materi']; ?></p>
                                                </div>
                                                <div>
                                                    <p style="font-size: 0.9rem;padding-top:0.3rem;">-FISIK-</p>
                                                    <p style="font-size: 0.9rem;"><?php echo $row['fisik']; ?></p>
                                                </div>
                                                <div>
                                                    <p style="font-size: 0.9rem;padding-top:0.3rem;">-BELADIRI-</p>
                                                    <p style="font-size: 0.9rem;"><?php echo $row['beladiri']; ?></p>

                                                </div>
                                            </div>
                                        </div>
                                        <div style="background-color: white;color:black;width:8rem;height:5rem;margin-left:1.4rem;text-align:center;border: 3px solid black;border-radius:0px 0px 20px 20px">
                                            <div style="background-color: black;border-bottom: 5px solid black;height:2rem;color:white;">
                                                <p>---PELATIH---</p>
                                            </div>
                                            <p style="font-size: 0.9rem;padding-top:0.3rem;"><?php echo $row['nama']; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>

            </div>
        </div>
        <script>

        </script>




        </script>
</body>

</html>