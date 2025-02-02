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

$query = "SELECT buku.judul, COUNT(*) AS total_peminjaman
          FROM peminjaman
          JOIN buku ON peminjaman.id_buku = buku.id_buku
          GROUP BY buku.judul
          ORDER BY total_peminjaman DESC";

$result = mysqli_query($koneksi, $query);

// Inisialisasi array untuk menyimpan data
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Membuat instance PDF
$pdf = new FPDF();
$pdf->AddPage();

// Ambil data instansi
$instansi = getInstansiData($koneksi);

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
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,1,'Laporan Jumlah Total Peminjaman Buku',0,1,'C');
$pdf->Ln(10);

// Tabel
$pdf->SetFont('Arial','B',12);
$pdf->Cell(15,10,'No',1,0,'C');
$pdf->Cell(100,10,'Judul Buku',1,0,'C');
$pdf->Cell(75,10,'Jumlah Total Peminjaman',1,1,'C');

$pdf->SetFont('Arial','',12);
$no = 1; // Inisialisasi nomor
foreach ($data as $row) {
    $pdf->Cell(15,10,$no,1,0,'C'); // Tampilkan nomor
    $pdf->Cell(100,10,$row['judul'],1,0,'L');
    $pdf->Cell(75,10,$row['total_peminjaman'],1,1,'C');
    $no++; // Increment nomor
}



// Output PDF
$pdf->Output();
?>
