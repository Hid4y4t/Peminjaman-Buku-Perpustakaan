<?php
// Koneksi ke database
include '../../koneksi/koneksi.php';

// Pastikan data yang diperlukan telah diterima
if (isset($_POST['id_admin'])) {
    $id_admin = $_POST['id_admin'];
    
    // Admin master yang tidak boleh dihapus
    $admin_masternya = 1; // Ganti dengan id admin yang tidak boleh dihapus

    // Pastikan id admin yang akan dihapus bukanlah admin masternya
    if ($id_admin != $admin_masternya) {
        // Query untuk menghapus admin dari database
        $query = "DELETE FROM admin WHERE id_admin = '$id_admin'";
        $result = mysqli_query($koneksi, $query);

        if ($result) {
            // Jika penghapusan berhasil, arahkan kembali ke halaman sebelumnya
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            exit;
        } else {
            // Jika penghapusan gagal
            echo "Gagal menghapus admin.";
        }
    } else {
        // Admin master tidak dapat dihapus
        echo "Admin master tidak dapat dihapus.";
    }
} else {
    // Jika data yang diperlukan tidak diterima
    echo "Data yang diperlukan tidak lengkap.";
}

// Menutup koneksi
mysqli_close($koneksi);
?>
