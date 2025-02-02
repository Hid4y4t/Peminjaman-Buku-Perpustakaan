<?php
include 'koneksi/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari formulir
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk mendapatkan data admin berdasarkan username
    $query = "SELECT * FROM admin WHERE username = '$username'";
    $result = mysqli_query($koneksi, $query);

    // Periksa apakah username ditemukan dalam database
    if (mysqli_num_rows($result) == 1) {
        // Ambil data admin
        $admin = mysqli_fetch_assoc($result);
        // Periksa kecocokan password
        if (password_verify($password, $admin['password'])) {
            // Autentikasi berhasil, simpan data sesi
            session_start();
            $_SESSION['id_admin'] = $admin['id_admin'];
            $_SESSION['nama'] = $admin['nama'];
            $_SESSION['username'] = $admin['username'];
            $_SESSION['jabatan'] = $admin['jabatan'];
            // Periksa jabatan untuk mengarahkan ke halaman yang sesuai
            if ($admin['jabatan'] == 'Admin') {
                header("Location: admin/index.php");
            } else {
                header("Location: petugas/index.php");
            }
            exit();
        } else {
            // Password tidak cocok, kirim kembali ke halaman login dengan pesan error
            header("Location: index.php?error=Password salah.");
            exit();
        }
    } else {
        // Username tidak ditemukan, kirim kembali ke halaman login dengan pesan error
        header("Location: index.php?error=Username tidak ditemukan.");
        exit();
    }
} else {
    // Permintaan bukan POST, kirim kembali ke halaman login dengan pesan error
    header("Location: index.php?error=Metode permintaan tidak valid.");
    exit();
}
?>
