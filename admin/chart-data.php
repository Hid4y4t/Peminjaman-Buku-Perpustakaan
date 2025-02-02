<?php
// Masukkan koneksi ke database Anda
include '../koneksi/koneksi.php';

// Query untuk mengambil data peminjaman
$query = "SELECT * FROM peminjaman";
$result = mysqli_query($koneksi, $query);

// Array untuk menyimpan data peminjaman
$dataPeminjaman = array();

// Memasukkan hasil query ke dalam array
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Tambahkan data ke dalam array
        $dataPeminjaman[] = $row;
    }
}

// Mengirimkan data dalam format JSON
header('Content-Type: application/json');
echo json_encode($dataPeminjaman);

// Tutup koneksi ke database
mysqli_close($koneksi);
?>
