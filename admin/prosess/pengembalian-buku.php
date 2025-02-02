<?php
include '../../koneksi/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $idPeminjaman = $_POST['id_peminjaman'];
    $tanggalPengembalian = date('Y-m-d'); // Menggunakan tanggal saat ini
    $denda = $_POST['denda'];

    // Memulai transaksi
    mysqli_begin_transaction($koneksi);
    try {
        // Query untuk update tanggal pengembalian dan denda
        $queryPeminjaman = "UPDATE peminjaman SET tanggal_pengembalian = '$tanggalPengembalian', denda = '$denda' WHERE id_peminjaman = '$idPeminjaman'";
        
        // Eksekusi query untuk update peminjaman
        if (!mysqli_query($koneksi, $queryPeminjaman)) {
            throw new Exception("Gagal melakukan update data peminjaman.");
        }

        // Query untuk menambahkan 1 pada kolom tersedia di tabel buku
        $queryTersedia = "UPDATE buku SET tersedia = tersedia + 1 WHERE id_buku = (SELECT id_buku FROM peminjaman WHERE id_peminjaman = '$idPeminjaman')";
        
        // Eksekusi query untuk update kolom tersedia di tabel buku
        if (!mysqli_query($koneksi, $queryTersedia)) {
            throw new Exception("Gagal melakukan update kolom tersedia di tabel buku.");
        }

        // Commit transaksi jika semua query berhasil dijalankan
        mysqli_commit($koneksi);
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    } catch (Exception $e) {
        // Rollback transaksi jika terjadi kesalahan
        mysqli_rollback($koneksi);
        echo "Terjadi kesalahan: " . $e->getMessage();
    }
}
?>
