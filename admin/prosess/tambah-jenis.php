<?php
// Koneksi ke database
include '../../koneksi/koneksi.php';

// Pastikan data yang diperlukan telah diterima
if (isset($_POST['jenis'], $_POST['hari_terlambat'], $_POST['biaya_per_hari'])) {
    // Tangkap data dari form
    $jenis = $_POST['jenis'];
    $hari_terlambat = $_POST['hari_terlambat'];
    $biaya_per_hari = $_POST['biaya_per_hari'];

    // Query untuk menyimpan data jenis ke database
    $query = "INSERT INTO aturan_denda (jenis, hari_terlambat, biaya_per_hari) VALUES ('$jenis', '$hari_terlambat', '$biaya_per_hari')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Jika penyimpanan berhasil, arahkan kembali ke halaman sebelumnya
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit;
    } else {
        // Jika penyimpanan gagal
        echo "Gagal menyimpan data jenis.";
    }
} else {
    // Jika data yang diperlukan tidak diterima
    echo "Data yang diperlukan tidak lengkap.";
}

// Menutup koneksi
mysqli_close($koneksi);
?>
