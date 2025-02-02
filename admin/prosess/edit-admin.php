<?php
include '../../koneksi/koneksi.php';

// Terima data dari formulir
$id_admin = $_POST['id_anggota'];
$nama = $_POST['nama'];
$email = $_POST['email'];
$username = $_POST['username'];
$telepon = $_POST['telepon'];
$alamat = $_POST['alamat'];
$password = $_POST['password'];
$jabatan = $_POST['jabatan'];

// Periksa apakah password diinputkan, jika tidak gunakan password sebelumnya
if(empty($password)) {
    // Query untuk mendapatkan password sebelumnya
    $queryPassword = "SELECT password FROM admin WHERE id_admin = $id_admin";
    $resultPassword = mysqli_query($koneksi, $queryPassword);
    $row = mysqli_fetch_assoc($resultPassword);
    $password = $row['password'];
} else {
    // Enskripsi password baru
    $password = password_hash($password, PASSWORD_DEFAULT);
}

// Query untuk melakukan update data admin
$query = "UPDATE admin SET nama = '$nama', email = '$email', username = '$username', password = '$password', telepon = '$telepon', alamat = '$alamat', jabatan = '$jabatan' WHERE id_admin = $id_admin";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    // Redirect ke halaman lain atau tampilkan pesan sukses
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit();
} else {
    // Tampilkan pesan error jika query gagal
    echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
}

// Tutup koneksi
mysqli_close($koneksi);
?>
