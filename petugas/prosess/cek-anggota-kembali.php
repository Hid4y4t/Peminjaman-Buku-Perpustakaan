<?php
// Mulai session
session_start();

// Koneksi ke database
include '../../koneksi/koneksi.php';

// Pastikan ID anggota telah diterima dari formulir
if (isset($_POST['id_anggota'])) {
    $idAnggota = $_POST['id_anggota'];

    // Query untuk memeriksa apakah ID anggota ada dalam tabel anggota
    $query = "SELECT * FROM anggota WHERE id_anggota = '$idAnggota'";
    $result = mysqli_query($koneksi, $query);

    // Jika ID anggota ditemukan dalam tabel
    if (mysqli_num_rows($result) > 0) {
        // Alihkan ke halaman buat-pinjaman.php dengan membawa ID anggota
        header("Location: ../buat-pengembalian.php?id_anggota=$idAnggota");
        exit;
    } else {
        // Jika ID anggota tidak ditemukan dalam tabel, simpan pesan kesalahan dalam session
        $_SESSION['error_message'] = "ID Anggota tidak terdaftar";
        // Alihkan kembali ke halaman sebelumnya
        header("Location: ../pengembalian.php");
        exit;
    }
} else {
    // Jika ID anggota tidak diterima dari formulir, simpan pesan kesalahan dalam session
    $_SESSION['error_message'] = "ID Anggota tidak diberikan";
    // Alihkan kembali ke halaman sebelumnya
    header("Location: ../pengembalian
    .php");
    exit;
}

// Menutup koneksi
mysqli_close($koneksi);
?>
