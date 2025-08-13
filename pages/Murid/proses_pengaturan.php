<?php
    $koneksi = mysqli_connect('localhost', 'urbeing1_jokotole_user', 'jokotoleuser0', 'urbeing1_jokotole');

    // if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //     if (isset($_FILES["image"])) {
    //         $targetDirectory = "C:/xampp/htdocs/pepeel/PPL/dist/img/profile/";
    //         $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);
    
    //         if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
    //             // Gambar berhasil diunggah
    //             // Simpan nama file di variabel sesi atau database (ganti ini sesuai kebutuhan Anda)
    //             $_SESSION['profile_image'] = basename($_FILES["image"]["name"]);
    
    //             // Arahkan pengguna kembali ke halaman pengaturan.php
    //             header('Location: pengaturan.php');
    //             exit; // Pastikan untuk keluar agar kode selanjutnya tidak dijalankan
    //         } else {
    //             // Gagal mengunggah gambar
    //         }
    //     }
    // }
    
    // if (isset($_POST['submit'])){
    //     $img_tmp_name = $_FILES['usr_img']['tmp_name'];
    //     $img_size = $_FILES['usr_img']['size'];
    //     $name = basename($_FILES["usr_img"]["name"]);
    //     $ext = array("jpg", "jpeg", "png");
  
    //     $file_path = 'img/'.$name;
  
    //     $file_ext_proc = explode(".",$_FILES['usr_img']['name']);
    //     $file_ext = end($file_ext_proc);
        
    //     if ($img_size > 1000000){
    //       echo "gambar tidak boleh lebih dari 1mb";
    //       return;
    //     }
    //     if (!in_array($file_ext, $ext)){
    //       echo "mohon masukan format yang benar";
    //       return;
    //     }
    //     move_uploaded_file($img_tmp_name, $file_path);
    // }
    
    if (isset($_POST['submit'])) {
        // Ambil data yang di-submit dari form
        $username = $_POST['username'];
        $password = $_POST['password'];
        $nama = $_POST['nama'];
        $tanggal_lahir = $_POST['tanggal_lahir'];
        $email = $_POST['email'];
        $telepon = $_POST['telepon'];
        $gender = $_POST['gender'];
        $alamat = $_POST['alamat'];
        $telepon_wali = $_POST['telepon_wali'];
        $tingkatan = $_POST['tingkatan'];

        // Lakukan validasi data di sini jika diperlukan

        // Update data pengguna ke database
        $koneksi = mysqli_connect("localhost", "username_db", "password_db", "jokotole");

        if (!$koneksi) {
            die("Koneksi database gagal: " . mysqli_connect_error());
        }

        $query = "UPDATE aktor SET password='$password', nama='$nama', tanggal_lahir='$tanggal_lahir', email='$email', telepon='$telepon', gender='$gender', alamat='$alamat', foto='$foto', telepon_wali='$telepon_wali', tingkatan='$tingkatan' WHERE username='$username'";
        $hasil = mysqli_query($koneksi, $query);

        if ($hasil) {
            echo "Data berhasil diupdate.";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
        }

        mysqli_close($koneksi);
    }
    ?>
