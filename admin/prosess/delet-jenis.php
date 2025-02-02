<?php
// Koneksi ke database
include '../../koneksi/koneksi.php';

// Pastikan data yang diperlukan telah diterima
if (isset($_POST['jenis'])) {
    $jenis = $_POST['jenis'];

    // Query untuk menghapus jenis dari database
    $query = "DELETE FROM aturan_denda WHERE jenis = '$jenis'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Jika penghapusan berhasil, arahkan kembali ke halaman sebelumnya
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit;
    } else {
        // Jika penghapusan gagal
        echo "Gagal menghapus jenis.";
    }
} else {
    // Jika data yang diperlukan tidak diterima
    echo "Data yang diperlukan tidak lengkap.";
}

// Menutup koneksi
mysqli_close($koneksi);
?>
