<?php
// Koneksi ke database
include '../../koneksi/koneksi.php';

// Pastikan ID buku telah diterima
if (isset($_POST['id_buku'])) {
    $book_id = $_POST['id_buku'];

    // Query untuk menghapus buku dari database
    $query = "DELETE FROM buku WHERE id_buku = $book_id";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Jika penghapusan berhasil, arahkan kembali ke halaman sebelumnya
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit;
    } else {
        // Jika penghapusan gagal
        http_response_code(500); // Internal Server Error
        echo json_encode(array('error' => 'Gagal menghapus buku'));
    }
} else {
    // Jika ID buku tidak diberikan
    http_response_code(400); // Bad Request
    echo json_encode(array('error' => 'Book ID is not provided'));
}

// Menutup koneksi
mysqli_close($koneksi);
?>
