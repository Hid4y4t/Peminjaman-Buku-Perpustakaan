<?php
// Membuat file PDF
require('../fpdf/fpdf.php');

// Mengambil data dari database
include '../../koneksi/koneksi.php'; // Menghubungkan ke database

// Fungsi untuk mengambil nama bulan dalam bahasa Indonesia
function getNamaBulan($bulan) {
    $nama_bulan = array(
        '01' => 'Januari',
        '02' => 'Februari',
        '03' => 'Maret',
        '04' => 'April',
        '05' => 'Mei',
        '06' => 'Juni',
        '07' => 'Juli',
        '08' => 'Agustus',
        '09' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember'
    );
    return $nama_bulan[$bulan];
}

$query = "SELECT DATE_FORMAT(tanggal_peminjaman, '%Y-%m') AS bulan_peminjaman, COUNT(*) AS total_peminjaman
          FROM peminjaman
          GROUP BY bulan_peminjaman";

$result = mysqli_query($koneksi, $query);

// Fungsi untuk mengambil data instansi
function getInstansiData($koneksi) {
    $query = "SELECT * FROM instansi LIMIT 1"; // Ambil satu baris data instansi
    $result = mysqli_query($koneksi, $query);
    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    } else {
        return false;
    }
}

// Query SQL untuk menghitung jumlah uang denda yang diterima oleh setiap anggota
$query = "SELECT anggota.id_anggota, anggota.nama AS nama_anggota, anggota.angkatan, COUNT(peminjaman.id_anggota) AS total_denda, SUM(peminjaman.denda) AS total_uang_denda
          FROM peminjaman
          JOIN anggota ON peminjaman.id_anggota = anggota.id_anggota
          WHERE peminjaman.denda > 0
          GROUP BY anggota.id_anggota
          ORDER BY total_denda DESC";
$result = mysqli_query($koneksi, $query);

// Inisialisasi variabel untuk menyimpan data
$data_anggota_denda = array();

// Memproses data yang diambil
while ($row = mysqli_fetch_assoc($result)) {
    $data_anggota_denda[] = $row;
}

// Ambil data instansi
$instansi = getInstansiData($koneksi);

// Menutup koneksi
mysqli_close($koneksi);

// Membuat instance PDF
$pdf = new FPDF();
$pdf->AddPage();

// Logo dan nama instansi
if ($instansi && !empty($instansi['logo'])) {
    $logo_path = '../../logo/' . $instansi['logo']; // Path menuju logo
    if (file_exists($logo_path)) {
        $pdf->Image($logo_path, 100, 10, 10); // Tampilkan logo jika file ada
    }
}
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,30, $instansi['nama'],0,1,'C'); // Gunakan nama dari tabel instansi
$pdf->Ln(-10);

// Judul
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(0, 1, 'Laporan Daftar Anggota dengan Total Denda', 0, 1, 'C');
$pdf->Ln(10);

// Tabel
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(10, 10, 'No', 1, 0, 'C');
$pdf->Cell(30, 10, 'ID Anggota', 1, 0, 'C');
$pdf->Cell(60, 10, 'Nama Anggota', 1, 0, 'C');
$pdf->Cell(30, 10, 'Angkatan', 1, 0, 'C');
$pdf->Cell(30, 10, 'Total Denda', 1, 0, 'C');
$pdf->Cell(30, 10, 'Total Uang ', 1, 1, 'C');

$pdf->SetFont('Arial', '', 11);
$no = 1;
foreach ($data_anggota_denda as $anggota) {
    $pdf->Cell(10, 10, $no++, 1, 0, 'C');
    $pdf->Cell(30, 10, $anggota['id_anggota'], 1, 0, 'C');
    $pdf->Cell(60, 10, $anggota['nama_anggota'], 1, 0, 'C');
    $pdf->Cell(30, 10, $anggota['angkatan'], 1, 0, 'C');
    $pdf->Cell(30, 10, $anggota['total_denda'], 1, 0, 'C');
    $pdf->Cell(30, 10, 'Rp ' . number_format($anggota['total_uang_denda'], 0, ',', '.'), 1, 1, 'R');
}



// Output PDF
$pdf->Output();
?>
