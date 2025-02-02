<?php
// Koneksi ke database
include '../../koneksi/koneksi.php';

// Pastikan data yang diperlukan telah diterima
if (isset($_POST['jenis'], $_POST['hari_terlambat'], $_POST['biaya_per_hari'])) {
    // Tangkap data dari form
    $jenis = $_POST['jenis'];
    $hari_terlambat = $_POST['hari_terlambat'];
    $biaya_per_hari = $_POST['biaya_per_hari'];

    // Query untuk mengupdate data jenis
    $query = "UPDATE aturan_denda SET hari_terlambat = '$hari_terlambat', biaya_per_hari = '$biaya_per_hari' WHERE jenis = '$jenis'";

    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Jika update berhasil, arahkan kembali ke halaman sebelumnya
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit;
    } else {
        // Jika update gagal
        echo "Gagal melakukan update data jenis.";
    }
} else {
    // Jika data yang diperlukan tidak diterima
    echo "Data yang diperlukan tidak lengkap.";
}

// Menutup koneksi
mysqli_close($koneksi);
?>
