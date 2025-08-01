<?php

require '../Super Admin/koneksidbMerch.php';

$nowa = @query("SELECT * FROM penjual ")[0];


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Via Whatsapp</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@700;800&display=swap');

    #btwa {
        background-color: #4CAF50;
        color: black;
        padding: 10px 15px;
        margin-top: 5px;
        border: none;
        border-radius: 10px;
        cursor: pointer;
    }

    #btwa:hover {
        background: green;
        color: white;
    }

    #btback {
        background-color: #e0cb63;
        color: black;
        padding: 10px 15px;
        margin-top: 5px;
        border: none;
        border-radius: 10px;
        cursor: pointer;
    }

    #btback:hover {
        background: #f7cf05;

    }



    input[type=text]:focus {
        border: 4px solid #555;
        border-radius: 4px;
    }

    .mx-auto {
        width: 1000px;
        margin: 80px;
        margin-left: auto;
        margin-left: auto;
        padding: 10px;
        border: 7px solid green;
        border-radius: 10px;
        background-color: white;
    }

    textarea[type=text]:focus {
        border: 4px solid #555;
        border-radius: 4px;
    }

    textarea,
    input {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        border-radius: 10px;
    }

    @media (max-width:900px) {
        .mx-auto {
            width: 700px;
            margin: 80px;
            margin-left: auto;
            margin-left: auto;
            padding: 10px;
            border: 7px solid green;
            border-radius: 10px;
            background-color: white;
        }

        textarea,
        input {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            border-radius: 10px;
        }
    }

    @media (max-width:700px) {
        .mx-auto {
            width: 500px;
            margin: 80px;
            margin-left: auto;
            margin-left: auto;
            padding: 10px;
            border: 7px solid green;
            border-radius: 10px;
            background-color: white;
        }

        textarea,
        input {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            border-radius: 10px;
        }
    }

    @media (max-width:500px) {
        .mx-auto {
            width: 300px;
            margin: 80px;
            margin-left: auto;
            margin-left: auto;
            padding: 10px;
            border: 7px solid green;
            border-radius: 10px;
            background-color: white;
        }

        textarea,
        input {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            border-radius: 10px;
        }
    }
</style>

<body style="background-color: #242624;">
    <div class="mx-auto ">


        <form>
            <h1 style="text-align: center; margin-bottom: 40px; font-family:'Poppins', sans-serif;">Kirim Pemesanan Via Whatsapp</h1>

            <div class="mb-3">
                <label for="nama" class="form-label" style="font-weight:bold;">Nama :</label>
                <input type="text" class="nama" id="nama" placeholder="Contoh : Jhon Doe">
            </div>
            <div class="mb-3">
                <label for="pesan" class="form-label" style="font-weight:bold;">Pesanan :</label>
                <textarea class="pesan" id="pesan" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <button type="button" onclick="sendwhatsapp();" id="btwa">Send Via Whatsapp</button>
                <a href="../../index.php"><button type="button" id="btback">Kembali</button></a>
            </div>
        </form>
    </div>

    <!-- JS API WA-->
    <script>
        function sendwhatsapp() {
            var nohp = <?= $nowa["no_hp"]; ?>;

            var nama = document.querySelector('.nama').value;
            var pesan = document.querySelector('.pesan').value;

            var url = "https://wa.me/" + nohp + "?text=" +
                "Nama : " + encodeURIComponent(nama) + "%0a" +
                "Pesanan : " + "%0a" + encodeURIComponent(pesan);

            window.open(url, '_blank').focus();
        }
    </script>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>