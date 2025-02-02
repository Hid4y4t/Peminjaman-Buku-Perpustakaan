<?php
include '../../koneksi/koneksi.php';

// Periksa apakah ada request POST yang dikirimkan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirimkan melalui form
    $id_instansi = $_POST['id_instansi'];
    $nama = $_POST['nama'];
    $keterangan = $_POST['keterangan'];
    
    // Periksa apakah file foto baru diunggah
    if ($_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        // Direktori penyimpanan foto
        $upload_dir = '../../logo/';

        // Mendapatkan ekstensi file foto
        $extension = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);

        // Membuat nama file yang unik berdasarkan timestamp dan hash
        $foto_name = md5(uniqid() . time()) . '.' . $extension;

        // Menyimpan file foto ke direktori penyimpanan dengan nama yang unik
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $upload_dir . $foto_name)) {
            // Query untuk update data instansi termasuk foto baru
            $query = "UPDATE instansi SET nama = '$nama', keterangan = '$keterangan', logo = '$foto_name' WHERE id_instansi = $id_instansi";
        } else {
            echo "Gagal mengupload foto baru.";
            exit; // Keluar dari script karena gagal mengupload foto
        }
    } else {
        // Jika tidak ada file foto baru diunggah, gunakan foto sebelumnya
        // Query untuk update data instansi tanpa mengubah foto
        $query = "UPDATE instansi SET nama = '$nama', keterangan = '$keterangan' WHERE id_instansi = $id_instansi";
    }

    // Jalankan query untuk update data instansi
    if (mysqli_query($koneksi, $query)) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }

    // Tutup koneksi
    mysqli_close($koneksi);
}
?>
