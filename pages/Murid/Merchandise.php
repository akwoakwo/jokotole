








<?php
require '../Super Admin/koneksidbMerch.php';

$merchandise = query("SELECT * FROM merchandise");


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merhandise</title>
</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@700;800&display=swap');

    body {
        background: #242624;
    }

    p.konten1 {
        max-width: 180px;
        word-wrap: break-word;
        /* Memaksa teks untuk mematahkan secara otomatis */
    }


    .flex-contain {
        display: flex;
        flex-direction: row;
        align-items: flex-start;
    }

    .btpesan {
        position: static;
        border: 2px solid black;
        border-radius: 25px;
        margin-top: 1.7rem;
        margin-right: 0.2rem;
        width: 10rem;
        height: 2rem;
        font-size: medium;
        font-weight: 700;
        font-family: 'Poppins', sans-serif;
        align-self: flex-starct;
        cursor: pointer;

    }

    .btpesan:hover {
        background: #33b249;
        color: white;
    }

    .grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        margin: 80px;
        grid-gap: 30px;
    }

    article>img {
        object-fit: cover;
    }



    .grid>article {
        box-shadow: 10px 5px 5px 0px black;
        border-radius: 30px;
        text-align: left;
        background: #3D553D;
        width: 350px;
        height: 375px;
        transition: transform;
    }

    .grid>article img {
        border-top-left-radius: 30px;
        border-top-right-radius: 30px;
    }


    .grid>article:hover {
        transform: scale(1.2);
    }

    @media (max-width:1200px) {
        .grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width:900px) {
        .grid {
            grid-template-columns: repeat(1, 1fr);
            align-items: center;
        }
    }
</style>

<body>

    <h1 style="text-align: center; font-size:50px; font-family:'Poppins', sans-serif; color:white"> MERCHANDISE</h1>

    <div style="justify-content: center;">
        <main class="grid">
            <?php foreach ($merchandise as $row) : ?>
                <article>
                    <img src="../../dist/img/<?php echo $row["foto_merchandise"]; ?>" width="350px" height="210px" />
                    <div class="konten">
                        <div class="flex-contain">
                            <div class="konten1" style=" flex-grow:8;">
                                <h2 style="margin-left: 5px; margin-top: 1px; ont-family:'Poppins', sans-serif;  color:white;"><?= $row["nama_merchandise"]; ?></h2>
                                <h3 style="margin-left: 5px; margin-top: 1px; font-family:'Poppins', sans-serif;  color:white; font-size:medium;">Rp.<?= $row["harga_merchandise"]; ?></h3>
                                <p style="margin-left: 7px; margin-top: 1px; font-family:'Poppins', sans-serif;  color:white; font-size:x-small;"><?= $row["deskripsi_merchandise"]; ?></p>
                            </div>
                            <div class="konten2">
                                <a href="beliMerch.php"><button class="btpesan">Pesan Sekarang</button></a>
                            </div>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </main>
    </div>
</body>

</html>