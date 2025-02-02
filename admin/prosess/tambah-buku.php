<?php

include '../../koneksi/koneksi.php';

// Memeriksa apakah request adalah POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil nilai dari formulir
    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $jenis = $_POST['jenis'];
    $jumlah = $_POST['jumlah'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $tersedia = $_POST['tersedia'];

    // Membuat id_buku secara acak dengan panjang 9 digit
    $id_buku = rand(100000000, 999999999);

    // Proses penyimpanan foto
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        // Direktori penyimpanan foto
        $upload_dir = '../../buku/';

        // Mendapatkan ekstensi file foto
        $extension = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);

        // Membuat nama file yang unik berdasarkan timestamp dan hash
        $foto_name = md5(uniqid() . time()) . '.' . $extension;

        // Menyimpan file foto ke direktori penyimpanan dengan nama yang unik
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $upload_dir . $foto_name)) {
            echo "Foto buku berhasil diupload.";
        } else {
            echo "Gagal mengupload foto buku.";
        }
    } else {
        echo "Gagal mengupload foto buku.";
    }

    // Proses penyimpanan data ke database
    
    // Query untuk menyimpan data buku ke tabel buku
    $query = "INSERT INTO buku (id_buku, judul, pengarang, jenis, jumlah, tahun_terbit, tersedia, foto) VALUES ('$id_buku', '$judul', '$pengarang', '$jenis', '$jumlah', '$tahun_terbit','$tersedia', '$foto_name')";

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
