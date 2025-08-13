<?php

// Koneksi ke database
$koneksi = mysqli_connect('localhost', 'urbeing1_jokotole_user', 'jokotoleuser0', 'urbeing1_jokotole');

// Query untuk mengambil data inventaris barang
$sql = "SELECT * FROM inventaris";
$hasil = mysqli_query($koneksi, $sql);


require('../dist/fpdf185/fpdf.php');
$gambarPath = '../dist/img/Jokotole.png';

class PDF extends FPDF
{
    function letak($gambar)
    {
        $this->Image($gambar, 10, 10, 20, 25);
    }
    function judul($teks1, $teks2, $teks3, $teks4, $teks5)
    {
        $this->Cell(25);
        $this->SetFont('Times', 'B', '14');
        $this->Cell(0, 5, $teks1, 0, 1, 'C');
        $this->Cell(25);
        $this->Cell(0, 5, $teks2, 0, 1, 'C');
        $this->Cell(25);
        $this->SetFont('Times', 'B', '14');
        $this->Cell(0, 5, $teks3, 0, 1, 'C');
        $this->Cell(25);
        $this->SetFont('Times', 'I', '7');
        $this->Cell(0, 5, $teks4, 0, 1, 'C');
        $this->Cell(25);
        $this->Cell(0, 3, $teks5, 0, 1, 'C');
    }
    function garis()
    {
        $this->SetLineWidth(1);
        $this->Line(10, 37, 138, 37);
        $this->SetLineWidth(0);
        $this->Line(10, 38, 138, 38);
    }
    // Fungsi untuk membuat header tabel
    function JudulTabel($textjudul)
    {
        $this->SetFont('Times', 'B', '12');
        $this->Cell(0, 25, $textjudul, 0, 1, 'C');
        $this->SetY($this->GetY() - 5);
    }

    function th()
    {
        // Tambahkan tabel di bawah kop surat
        $this->SetFont('Times', 'B', '10');
        $this->Cell(8, 6, 'No', 1, 0, 'C');
        $this->Cell(50, 6, 'Nama Barang', 1, 0, 'C');
        $this->Cell(30, 6, 'Jumlah Barang', 1, 1, 'C');
    }

    // Fungsi untuk membuat baris tabel
    function td($no, $nama_barang, $jumlah_barang)
    {
        $this->SetFont('Times', '', 8);
        $this->Cell(8, 6, $no, 1, 0, 'C');
        $this->Cell(50, 6, $nama_barang, 1, 0, 'C');
        $this->Cell(30, 6, $jumlah_barang, 1, 1, 'C');
    }
    function ttd($tanngal, $ttd, $nama)
    {
        $this->SetY($this->GetY() + 10);
        $this->Cell(75);
        $this->SetFont('Times', '', '10');
        $this->Cell(0, 5, $tanngal, 0, 1, 'C');

        // Menyimpan posisi Y sebelum memasukkan gambar
        $posisiY = $this->GetY();

        // Menyimpan posisi X saat ini
        $posisiX = $this->GetX();

        // Menghitung lebar gambar
        $gambarLebar = 20;

        // Menyisipkan gambar di sebelah kanan halaman
        $this->Image($ttd, 100, $this->GetY() + 0, $gambarLebar, 25);

        // Mengatur posisi Y untuk nama
        $this->SetY($posisiY + 17); // Menyesuaikan dengan tinggi gambar dan menambahkan jarak
        $this->Cell(75);
        $this->SetFont('Times', '', '10');
        $this->Cell(0, 5, $nama, 0, 1, 'C');
    }
}

// Membuat objek PDF
$pdf = new PDF();

$pdf = new pdf();

//Mulai dokumen
$pdf->AddPage('P', 'A5');
//meletakkan gambar
$pdf->letak('../dist/img/Jokotole.png');
//meletakkan judul disamping logo diatas
$pdf->judul('DEWAN PENGURUS CABANG BANGKALAN', 'PERGURUAN PENCAK SILAT JOKOTOLE', 'DIKLAT KODIM 0829', 'Jl. Letnam Abdullah, Rw. 07, Keraton, Kec. Bangkalan, Kabupaten Bangkalan, Jawa Timur 69115', 'Telp. (082)132331949 | Website: http://jokotolekodim0829 | E-Mail: jokotolekodim0829@gmail.com');
//membuat garis ganda tebal dan tipis
$pdf->garis();

$pdf->JudulTabel('DAFTAR BARANG INVENTARIS');

$tabelLebar = 88;
$posisiX = ($pdf->GetPageWidth() - $tabelLebar) / 2;
$pdf->SetX($posisiX);
$pdf->th();

$no = 1;
while ($baris = mysqli_fetch_assoc($hasil)) {
    $tabelLebar = 88;
    $posisiX = ($pdf->GetPageWidth() - $tabelLebar) / 2;
    $pdf->SetX($posisiX);
    $pdf->td($no++, $baris['nama_barang'], $baris['jumlah_barang']);
}

$pdf->ttd('Bangkalan, ' . date('d-m-Y'), '../dist/img/ttd.png', 'KA.Diklat');

// Menampilkan data ke dalam tabel


// Menyimpan file PDF dengan nama 'inventaris_barang.pdf'
$pdf->Output('inventaris_barang.pdf', 'I');

// Atur header Content-Disposition untuk menampilkan file PDF di tab baru
header('Content-Disposition: inline; filename="inventaris_barang.pdf"');
