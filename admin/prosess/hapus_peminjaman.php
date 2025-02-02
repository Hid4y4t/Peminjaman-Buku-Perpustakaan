<?php
// Sambungkan ke database
include '../../koneksi/koneksi.php';

if (isset($_POST['hapus'])) {
    $peminjaman_ids = $_POST['hapus'];

    // Buat string berisi id peminjaman yang dipilih, dipisahkan oleh koma
    $peminjaman_ids_str = implode(',', $peminjaman_ids);

    // Query untuk menghapus data peminjaman yang dipilih
    $query = "DELETE FROM peminjaman WHERE id_peminjaman IN ($peminjaman_ids_str)";
    
    // Eksekusi query
    if (mysqli_query($koneksi, $query)) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }
}

// Tutup koneksi database
mysqli_close($koneksi);
?>
