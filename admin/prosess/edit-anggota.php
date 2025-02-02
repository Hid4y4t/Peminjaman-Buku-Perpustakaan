<?php
// Koneksi ke database
include '../../koneksi/koneksi.php';

// Pastikan data yang diperlukan telah diterima
if (isset($_POST['id_anggota'], $_POST['nama'], $_POST['email'], $_POST['telepon'], $_POST['angkatan'], $_POST['alamat'])) {
    // Tangkap data dari form
    $id_anggota = $_POST['id_anggota'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $angkatan = $_POST['angkatan'];
    $alamat = $_POST['alamat'];

    // Query untuk menyimpan data anggota ke database
    $query = "UPDATE anggota SET nama='$nama', email='$email', telepon='$telepon', angkatan='$angkatan', alamat='$alamat' WHERE id_anggota='$id_anggota'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Jika penyimpanan berhasil, arahkan kembali ke halaman sebelumnya
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        // echo "berhasil menyimpan data anggota.";
        exit;
    } else {
        // Jika penyimpanan gagal
        echo "Gagal menyimpan data anggota.";
    }
} else {
    // Jika data yang diperlukan tidak diterima
    echo "Data yang diperlukan tidak lengkap.";
}

// Menutup koneksi
mysqli_close($koneksi);
?>
