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

$query = "SELECT DATE_FORMAT(tanggal_peminjaman, '%Y-%m') AS bulan_peminjaman, COUNT(*) AS total_peminjaman
          FROM peminjaman
          GROUP BY bulan_peminjaman";

$result = mysqli_query($koneksi, $query);

// Inisialisasi array untuk menyimpan data per bulan
$data_per_bulan = array();

// Memproses data yang diambil
while ($row = mysqli_fetch_assoc($result)) {
    $data_per_bulan[$row['bulan_peminjaman']] = $row['total_peminjaman'];
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
$pdf->Cell(0,1,'Laporan Jumlah Peminjaman Buku per Bulan',0,1,'C');
$pdf->Ln(10);

// Tabel
$pdf->SetFont('Arial','B',12);
$pdf->Cell(15,10,'No',1,0,'C'); // Tambahkan kolom nomor
$pdf->Cell(70,10,'Bulan Peminjaman',1,0,'C');
$pdf->Cell(70,10,'Total Peminjaman Buku',1,1,'C');

$pdf->SetFont('Arial','',12);
$no = 1; // Inisialisasi nomor
foreach ($data_per_bulan as $bulan => $total_peminjaman) {
    $pdf->Cell(15,10,$no,1,0,'C'); // Tampilkan nomor
    $pdf->Cell(70,10,getNamaBulan(substr($bulan, 5)) . ' ' . substr($bulan, 0, 4),1,0,'C'); // Format bulan dan tahun
    $pdf->Cell(70,10,$total_peminjaman,1,1,'C');
    $no++; // Increment nomor
}

// Posisikan tabel di tengah halaman
$pdf->SetY(($pdf->GetPageHeight() - $pdf->GetY()) / 2 - 5); // Posisi vertikal setengah halaman



// Output PDF
$pdf->Output();
?>
