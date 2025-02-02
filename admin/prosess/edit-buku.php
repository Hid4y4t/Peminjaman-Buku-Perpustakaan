<?php
// Koneksi ke database
include '../../koneksi/koneksi.php';

// Terima input dari formulir
$id_buku = $_POST['id_buku'];
$judul = $_POST['judul'];
$pengarang = $_POST['pengarang'];
$jenis = $_POST['jenis'];
$jumlah = $_POST['jumlah'];
$jenis = $_POST['jenis'];
$tahun_terbit = $_POST['tahun_terbit'];
$tersedia = $_POST['tersedia'];;

// Proses upload foto baru jika ada
if ($_FILES['foto']['name']) {
    $nama_file_baru = $_FILES['foto']['name'];
    $lokasi_file_baru = $_FILES['foto']['tmp_name'];
    $folder_upload = '../../buku/';

    // Hapus foto lama (jika ada)
    $query_foto_lama = "SELECT foto FROM buku WHERE id_buku='$id_buku'";
    $result_foto_lama = mysqli_query($koneksi, $query_foto_lama);
    $foto_lama = mysqli_fetch_assoc($result_foto_lama)['foto'];
    if ($foto_lama) {
        unlink($folder_upload . $foto_lama);
    }

    // Pindahkan foto baru ke folder upload
    move_uploaded_file($lokasi_file_baru, $folder_upload . $nama_file_baru);
} else {
    // Jika tidak ada foto baru diunggah, gunakan foto lama
    $query_foto_lama = "SELECT foto FROM buku WHERE id_buku='$id_buku'";
    $result_foto_lama = mysqli_query($koneksi, $query_foto_lama);
    $foto_lama = mysqli_fetch_assoc($result_foto_lama)['foto'];
    $nama_file_baru = $foto_lama;
}

// Update entri buku dalam database dengan data baru
$query_update = "UPDATE buku SET judul='$judul', pengarang='$pengarang', jenis='$jenis', jumlah='$jumlah', jenis='$jenis', tahun_terbit='$tahun_terbit', tersedia='$tersedia', foto='$nama_file_baru' WHERE id_buku='$id_buku'";
$result_update = mysqli_query($koneksi, $query_update);

// Periksa apakah proses update berhasil
if ($result_update) {
    // Redirect ke halaman yang sesuai
    header("Location: ../data-buku.php");
    exit();
} else {
    echo "Terjadi kesalahan saat memperbarui buku.";
}

// Menutup koneksi
mysqli_close($koneksi);
?>
