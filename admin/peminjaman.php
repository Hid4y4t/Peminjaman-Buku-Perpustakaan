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
                                        Peminjaman Buku
                                    </h5>
                                </div>
                                <div class="card-body">



                                    <!-- Tampilkan formulir -->
                                    <form class="form form-vertical" method="post" action="prosess/cek-anggota.php">
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
                                        Peminjaman Buku Hari ini
                                    </h5>
                                </div>
                                <div class="card-body">
                                <div class="table-responsive">
                                <table class="table table-lg">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Judul Buku</th>
                                            <th>Tanggal </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
include '../koneksi/koneksi.php';

// Tanggal yang ingin Anda cari
$tanggal = date('Y-m-d'); // Misalnya tanggal hari ini

// Query untuk mengambil data peminjaman pada tanggal tertentu
$query = "SELECT anggota.nama, buku.judul, peminjaman.tanggal_peminjaman
          FROM peminjaman
          JOIN anggota ON peminjaman.id_anggota = anggota.id_anggota
          JOIN buku ON peminjaman.id_buku = buku.id_buku
          WHERE peminjaman.tanggal_peminjaman = '$tanggal'";

$result = mysqli_query($koneksi, $query);

if(mysqli_num_rows($result) > 0) {
    // Jika ada data, tampilkan dalam tabel
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td class='text-bold-500'>" . $row['nama'] . "</td>";
        echo "<td>" . $row['judul'] . "</td>";
        echo "<td class='text-bold-500'>" . $row['tanggal_peminjaman'] . "</td>";
        echo "</tr>";
    }
} else {
    // Jika tidak ada data, tampilkan pesan kosong
    echo "<tr><td colspan='3'>Tidak ada data peminjaman pada tanggal $tanggal.</td></tr>";
}
?>
                                       
                                    </tbody>
                                </table>
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