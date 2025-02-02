<?php
// Membuat file PDF
require('../fpdf/fpdf.php');
// Mengambil data dari database
include '../../koneksi/koneksi.php'; // Menghubungkan ke database

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

// Query SQL untuk mengambil jumlah total denda per bulan/tahun
$query = "SELECT DATE_FORMAT(tanggal_peminjaman, '%Y-%m') AS bulan_peminjaman, SUM(denda) AS total_denda, COUNT(DISTINCT id_anggota) AS jumlah_orang_denda
          FROM peminjaman
          GROUP BY DATE_FORMAT(tanggal_peminjaman, '%Y-%m')";
$result = mysqli_query($koneksi, $query);

// Inisialisasi variabel untuk menyimpan data
$data_denda = array();
$total_semua_denda = 0;
$total_orang_denda = 0;

// Memproses data yang diambil
while ($row = mysqli_fetch_assoc($result)) {
    if ($row['total_denda'] > 0) { // Hanya jika ada denda pada bulan tersebut
        $data_denda[$row['bulan_peminjaman']] = array(
            'total_denda' => $row['total_denda'],
            'jumlah_orang_denda' => $row['jumlah_orang_denda']
        );
        $total_semua_denda += $row['total_denda'];
        $total_orang_denda += $row['jumlah_orang_denda'];
    }
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
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 30, $instansi['nama'], 0, 1, 'C'); // Gunakan nama dari tabel instansi
$pdf->Ln(-10);

// Judul
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 1, 'Laporan Jumlah Total Denda per Bulan/Tahun', 0, 1, 'C');
$pdf->Ln(10);

// Tabel
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(15, 10, 'No', 1, 0, 'C');
$pdf->Cell(60, 10, 'Bulan/Tahun', 1, 0, 'C');
$pdf->Cell(60, 10, 'Total Denda', 1, 0, 'C');
$pdf->Cell(50, 10, 'Jumlah Orang ', 1, 1, 'C');

$pdf->SetFont('Arial', '', 12);
$no = 1;
foreach ($data_denda as $bulan_tahun => $data) {
    $pdf->Cell(15, 10, $no++, 1, 0, 'C');
    $pdf->Cell(60, 10, $bulan_tahun, 1, 0, 'C');
    $pdf->Cell(60, 10, 'Rp ' . number_format($data['total_denda'], 0, ',', '.'), 1, 0, 'R');
    $pdf->Cell(50, 10, $data['jumlah_orang_denda'], 1, 1, 'C');
}

// Total
$pdf->Cell(75, 10, 'Total', 1, 0, 'R'); // Adjusted width for Total
$pdf->Cell(60, 10, 'Rp ' . number_format($total_semua_denda, 0, ',', '.'), 1, 0, 'R');
$pdf->Cell(50, 10, $total_orang_denda, 1, 1, 'C');



// Output PDF
$pdf->Output();
?>
