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

$query = "SELECT buku.jenis, DATEDIFF(peminjaman.tanggal_pengembalian, peminjaman.tanggal_peminjaman) AS durasi_peminjaman
          FROM peminjaman
          JOIN buku ON peminjaman.id_buku = buku.id_buku
          WHERE peminjaman.tanggal_pengembalian IS NOT NULL"; // Hanya hitung durasi peminjaman jika buku sudah dikembalikan

$result = mysqli_query($koneksi, $query);

// Inisialisasi array untuk menyimpan total durasi peminjaman dan jumlah buku untuk setiap jenis
$jenis_durasi = array();
$jenis_jumlah = array();

// Loop melalui hasil query
while ($row = mysqli_fetch_assoc($result)) {
    $jenis = $row['jenis'];
    $durasi_peminjaman = $row['durasi_peminjaman'];

    // Tambahkan durasi peminjaman ke total untuk jenis buku ini
    if (!isset($jenis_durasi[$jenis])) {
        $jenis_durasi[$jenis] = 0;
        $jenis_jumlah[$jenis] = 0;
    }
    $jenis_durasi[$jenis] += $durasi_peminjaman;
    $jenis_jumlah[$jenis]++;
}

// Hitung rata-rata durasi peminjaman untuk setiap jenis buku
$jenis_rata_rata = array();
foreach ($jenis_durasi as $jenis => $total_durasi) {
    $jumlah_buku = $jenis_jumlah[$jenis];
    $rata_rata = ($jumlah_buku > 0) ? $total_durasi / $jumlah_buku : 0;
    $jenis_rata_rata[$jenis] = round($rata_rata, 2);
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
$pdf->Cell(0,1,'Laporan Rata-rata Durasi Peminjaman Buku Berdasarkan Jenis',0,1,'C');
$pdf->Ln(10);

// Tabel
$pdf->SetFont('Arial','B',12);
$pdf->Cell(10,10,'No',1,0,'C');
$pdf->Cell(90,10,'Jenis Buku',1,0,'C');
$pdf->Cell(90,10,'Rata-rata Durasi (hari)',1,1,'C');

$pdf->SetFont('Arial','',12);
$no = 1;
foreach ($jenis_rata_rata as $jenis => $rata_rata) {
    $pdf->Cell(10,10,$no,1,0,'C');
    $pdf->Cell(90,10,$jenis,1,0,'C');
    $pdf->Cell(90,10,$rata_rata,1,1,'C');
    $no++;
}



// Output PDF
$pdf->Output();
?>
