<?php
// Sambungkan ke database
include '../../koneksi/koneksi.php';

// Load library FPDF
require('../fpdf/fpdf.php');

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

// Buat instance PDF dengan orientasi landscape
$pdf = new FPDF('L', 'mm', 'A4');
$pdf->AddPage();


// Ambil data instansi
$instansi = getInstansiData($koneksi);

// Logo dan nama instansi
if ($instansi && !empty($instansi['logo'])) {
    $logo_path = '../../logo/' . $instansi['logo']; // Path menuju logo
    if (file_exists($logo_path)) {
        $pdf->Image($logo_path, 140, 10, 10); // Tampilkan logo jika file ada
    }
}
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,30, $instansi['nama'],0,1,'C'); // Gunakan nama dari tabel instansi
$pdf->Ln(-14);

// Judul laporan
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Laporan Peminjaman Buku', 0, 1, 'C');

// Tambahkan tabel data peminjaman
$pdf->SetFont('Arial', '', 12);
$pdf->SetFillColor(230, 230, 230);
$pdf->Cell(15, 10, 'No', 1, 0, 'C', true);
$pdf->Cell(25, 10, 'ID Buku', 1, 0, 'C', true); // Judul diganti menjadi ID Buku
$pdf->Cell(70, 10, 'Nama', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Angkatan', 1, 0, 'C', true);
$pdf->Cell(35, 10, ' Peminjaman', 1, 0, 'C', true);
$pdf->Cell(35, 10, ' Pengembalian', 1, 0, 'C', true);
$pdf->Cell(45, 10, 'Denda', 1, 1, 'C', true);

// Query untuk mengambil data peminjaman beserta judul buku, nama anggota, dan angkatan
$query = "SELECT peminjaman.*, buku.id_buku AS id_buku, anggota.nama AS nama, anggota.angkatan AS angkatan 
          FROM peminjaman 
          JOIN buku ON peminjaman.id_buku = buku.id_buku 
          JOIN anggota ON peminjaman.id_anggota = anggota.id_anggota";
$result = mysqli_query($koneksi, $query);

// Tampilkan data peminjaman dalam tabel
$no = 1;
$baris_per_halaman = 35; // Batas baris per halaman
$baris = 0; // Variabel untuk menghitung jumlah baris yang telah ditambahkan
while ($row = mysqli_fetch_assoc($result)) {
    // Cek apakah jumlah baris sudah mencapai batas per halaman
    if ($baris >= $baris_per_halaman) {
        $pdf->AddPage(); // Tambahkan halaman baru
        $pdf->SetFont('Arial', '', 12);
        // Tambahkan header tabel di halaman baru
        $pdf->SetFillColor(230, 230, 230);
        $pdf->Cell(15, 10, 'No', 1, 0, 'C', true);
        $pdf->Cell(25, 10, 'ID Buku', 1, 0, 'C', true);
        $pdf->Cell(70, 10, 'Nama', 1, 0, 'C', true);
        $pdf->Cell(30, 10, 'Angkatan', 1, 0, 'C', true);
        $pdf->Cell(35, 10, 'Tanggal Peminjaman', 1, 0, 'C', true);
        $pdf->Cell(35, 10, 'Tanggal Pengembalian', 1, 0, 'C', true);
        $pdf->Cell(45, 10, 'Denda', 1, 1, 'C', true);
        $baris = 0; // Reset jumlah baris untuk halaman baru
    }
    // Tambahkan data peminjaman
    $pdf->Cell(15, 10, $no++, 1, 0, 'C');
    $pdf->Cell(25, 10, $row['id_buku'], 1, 0, 'C'); // Judul diganti menjadi ID Buku
    $pdf->Cell(70, 10, $row['nama'], 1, 0, 'L');
    $pdf->Cell(30, 10, $row['angkatan'], 1, 0, 'C');
    $pdf->Cell(35, 10, $row['tanggal_peminjaman'], 1, 0, 'C');
    $pdf->Cell(35, 10, $row['tanggal_pengembalian'], 1, 0, 'C');
    // Format denda menjadi mata uang Rupiah
    $pdf->Cell(45, 10, 'Rp ' . number_format($row['denda'], 0, ',', '.'), 1, 1, 'C');
    $baris++; // Tambah jumlah baris
}

// Posisikan tabel di tengah halaman
$pdf->SetY(($pdf->GetPageHeight() - $pdf->GetY()) / 2 - 5); // Posisi vertikal setengah halaman




// Output PDF
$pdf->Output();
?>
