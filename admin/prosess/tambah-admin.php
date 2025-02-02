<?php
include '../../koneksi/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari formulir
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $telepon = $_POST['telepon'];
    $alamat = $_POST['alamat'];
    $jabatan = $_POST['jabatan'];

    // Enkripsi password sebelum disimpan ke dalam database
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // Query untuk menyimpan data admin ke dalam database
    $query = "INSERT INTO admin (nama, email, username, password, telepon, alamat, jabatan) VALUES ('$nama', '$email', '$username', '$passwordHash', '$telepon', '$alamat', '$jabatan')";

    // Menjalankan query
    if (mysqli_query($koneksi, $query)) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }

    // Menutup koneksi
    mysqli_close($koneksi);
}
?>
