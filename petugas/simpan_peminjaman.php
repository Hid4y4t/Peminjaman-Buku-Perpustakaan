<?php
include '../koneksi/koneksi.php';

// Pastikan data yang dibutuhkan ada dalam request
if(isset($_POST['id_anggota']) && isset($_POST['id_buku']) && !empty($_POST['id_anggota']) && !empty($_POST['id_buku'])) {
    // Ambil data dari request
    $idAnggota = $_POST['id_anggota'];
    $idBukuArray = explode(',', $_POST['id_buku']); // Pisahkan ID buku yang dikirimkan dalam bentuk string menjadi array

    // Lakukan penyimpanan data peminjaman ke dalam database
    $success = true; // Flag untuk menandakan keberhasilan penyimpanan data
    foreach ($idBukuArray as $idBuku) {
        // Lakukan pengecekan apakah buku dengan ID yang diberikan ada dalam database
        $query = "SELECT * FROM buku WHERE id_buku = '$idBuku'";
        $result = mysqli_query($koneksi, $query);
        if(mysqli_num_rows($result) > 0) {
            // Ambil data buku yang tersedia
            $row = mysqli_fetch_assoc($result);
            $tersedia = $row['tersedia'];
            // Kurangi jumlah buku yang tersedia
            $tersedia--;
            // Update jumlah buku yang tersedia di database
            $queryUpdate = "UPDATE buku SET tersedia = '$tersedia' WHERE id_buku = '$idBuku'";
            $resultUpdate = mysqli_query($koneksi, $queryUpdate);
            if(!$resultUpdate) {
                // Jika terjadi masalah saat mengupdate data, set flag success menjadi false
                $success = false;
            }
            // Jika jumlah buku yang tersedia berhasil diupdate, lakukan penyimpanan data peminjaman
            $tanggalPeminjaman = date('Y-m-d'); // Ambil tanggal peminjaman saat ini
            $queryInsert = "INSERT INTO peminjaman (id_buku, id_anggota, tanggal_peminjaman) VALUES ('$idBuku', '$idAnggota', '$tanggalPeminjaman')";
            $resultInsert = mysqli_query($koneksi, $queryInsert);
            if(!$resultInsert) {
                // Jika terjadi masalah saat menyimpan data, set flag success menjadi false
                $success = false;
            }
        } else {
            // Jika buku tidak ditemukan, set flag success menjadi false
            $success = false;
        }
    }

    // Berikan respons JSON
    if($success) {
        echo json_encode(array("status" => "success"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Gagal menyimpan data peminjaman"));
    }
} else {
    // Tampilkan pesan bahwa data tidak lengkap jika data yang diperlukan tidak ada
    echo json_encode(array("status" => "error", "message" => "Data tidak lengkap"));
}
?>
