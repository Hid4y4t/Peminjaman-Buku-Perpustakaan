<?php
session_start();
if(!isset($_SESSION['id_admin'])){
    // Jika session id_admin tidak ada, kembalikan ke halaman login
    header('Location: ../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<?php include 'root/head.php'?>

<?php

// Periksa apakah ada pesan kesalahan dalam session
if (isset($_SESSION['error_message'])) {
    $errorMessage = $_SESSION['error_message'];
    // Hapus pesan kesalahan dari session agar tidak ditampilkan lagi
    unset($_SESSION['error_message']);
} else {
    $errorMessage = ""; // Set pesan kosong jika tidak ada pesan kesalahan
}
?>

<body>
    <script src="assets/static/js/initTheme.js"></script>
    <div id="app">
        <?php include 'root/menu.php'?>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">

            </div>
            <div class="page-content">
                <section class="row">
                    <div class="col-md-12">
                        <section class="section">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">
                                        Pengembalian Buku
                                    </h5>
                                </div>
                                <div class="card-body">



                                    <!-- Tampilkan formulir -->
                                    <form class="form form-vertical" method="post"
                                        action="prosess/cek-anggota-kembali.php">
                                        <div class="form-body">
                                            <!-- Tampilkan pesan kesalahan jika ada -->
                                            <?php if (!empty($errorMessage)) : ?>
                                            <div class="alert alert-danger" role="alert">
                                                <?= $errorMessage ?>
                                            </div>
                                            <?php
// Cek apakah parameter success ada dalam URL
if (isset($_GET['success']) && $_GET['success'] == true) {
    // Jika parameter success ada dan nilainya 1, tampilkan pesan berhasil
    echo '<div class="alert alert-success" role="alert">Data peminjaman berhasil disimpan!</div>';
}
?>

                                            <?php endif; ?>
                                            <div class="row">
                                                <div class="col-sm-10 mb-1">
                                                    <div class="input-group input-group-lg">
                                                        <span class="input-group-text" id="inputGroup-sizing-lg">ID
                                                            ANGGOTA</span>
                                                        <input type="text" name="id_anggota" class="form-control"
                                                            aria-label="Sizing example input"
                                                            aria-describedby="inputGroup-sizing-lg">
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <button type="submit"
                                                        class="btn btn-outline-info btn-lg">Kirim</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>



                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">
                                        Angggota Yang Jatoh tempo Belum Mengembalikan buku
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <?php
include '../koneksi/koneksi.php';

// Query untuk mengambil data peminjaman yang belum dikembalikan, tanggal pengembalian kosong, dan sudah melewati batas waktu
$query = "SELECT anggota.nama, peminjaman.tanggal_peminjaman, aturan_denda.biaya_per_hari, aturan_denda.hari_terlambat, peminjaman.denda
          FROM peminjaman
          JOIN anggota ON peminjaman.id_anggota = anggota.id_anggota
          JOIN buku ON peminjaman.id_buku = buku.id_buku
          LEFT JOIN aturan_denda ON buku.jenis = aturan_denda.jenis
          WHERE peminjaman.tanggal_pengembalian IS NULL 
          AND DATEDIFF(CURRENT_DATE(), peminjaman.tanggal_peminjaman) > aturan_denda.hari_terlambat";

$result = mysqli_query($koneksi, $query);

if (mysqli_num_rows($result) > 0) {
    ?>
                                        <table class="table table-lg">
                                            <thead>
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>Tanggal Peminjaman</th>
                                                    <th>Denda</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
            while ($row = mysqli_fetch_assoc($result)) {
                // Hitung denda
                $tanggalPeminjaman = new DateTime($row['tanggal_peminjaman']);
                $tanggalSekarang = new DateTime();
                $hariTerlambat = $tanggalSekarang->diff($tanggalPeminjaman)->days;
                
                // Ambil jumlah hari terlambat sesuai aturan denda
                $hariTerlambatAturan = max(0, $hariTerlambat - $row['hari_terlambat']);
                
                // Hitung denda berdasarkan biaya per hari dari aturan denda
                $denda = $hariTerlambatAturan * $row['biaya_per_hari'];
                ?>
                                                <tr>
                                                    <td><?= $row['nama'] ?></td>
                                                    <td><?= $row['tanggal_peminjaman'] ?></td>
                                                    <td><?= "Rp " . number_format($denda, 0, ',', '.') ?></td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <?php
} else {
    echo "Tidak ada data peminjaman yang sesuai.";
}
?>

                                    </div>
                                </div>
                            </div>

                        </section>
                    </div>

                </section>
            </div>
            <?php include 'root/footer.php'?>

        </div>
    </div>



    <script src="assets/static/js/components/dark.js"></script>
    <script src="assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>


    <script src="assets/compiled/js/app.js"></script>



    <!-- Need: Apexcharts -->
    <script src="assets/extensions/apexcharts/apexcharts.min.js"></script>
    <script src="assets/static/js/pages/dashboard.js"></script>

    <script src="assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
    <script src="assets/static/js/pages/simple-datatables.js"></script>
</body>

</html>