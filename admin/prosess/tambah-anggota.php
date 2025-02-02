
<?php
// Koneksi ke database
include '../../koneksi/koneksi.php';

// Pastikan data yang diperlukan telah diterima
if (isset($_POST['nama'], $_POST['email'], $_POST['telepon'], $_POST['angkatan'],$_POST['alamat'])) {
    // Tangkap data dari form
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $angkatan = $_POST['angkatan'];
    $alamat = $_POST['alamat'];

    // Buat ID anggota secara acak terdiri dari 5 angka
    $id_anggota = str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);

    // Query untuk menyimpan data anggota ke database
    $query = "INSERT INTO anggota (id_anggota, nama, email, telepon, angkatan,alamat) VALUES ('$id_anggota', '$nama', '$email', '$telepon', '$angkatan', '$alamat')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Jika penyimpanan berhasil, arahkan kembali ke halaman sebelumnya
        header("Location: " . $_SERVER["HTTP_REFERER"]);
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
