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
                        <?php
include '../koneksi/koneksi.php';

// Periksa apakah parameter id_anggota ada dalam URL
if (isset($_GET['id_anggota'])) {
    $idAnggota = $_GET['id_anggota'];

    // Query untuk mendapatkan informasi anggota berdasarkan ID anggota
    $queryAnggota = "SELECT * FROM anggota WHERE id_anggota = '$idAnggota'";
    $resultAnggota = mysqli_query($koneksi, $queryAnggota);

    // Periksa apakah data anggota ditemukan
    if (mysqli_num_rows($resultAnggota) > 0) {
        // Ambil nama anggota
        $anggota = mysqli_fetch_assoc($resultAnggota);
        $namaAnggota = $anggota['nama'];

        // Query untuk mendapatkan data riwayat peminjaman yang sesuai dengan ID anggota
        $queryPeminjaman = "SELECT buku.judul, buku.jenis, peminjaman.tanggal_peminjaman, peminjaman.tanggal_pengembalian, peminjaman.denda
                            FROM peminjaman
                            JOIN buku ON peminjaman.id_buku = buku.id_buku
                            WHERE peminjaman.id_anggota = '$idAnggota'";
        $resultPeminjaman = mysqli_query($koneksi, $queryPeminjaman);
    } else {
        // Jika data anggota tidak ditemukan, set nama anggota menjadi string kosong
        $namaAnggota = "Tidak ditemukan";
    }
} else {
    // Jika parameter id_anggota tidak diberikan dalam URL, set nama anggota menjadi string kosong
    $namaAnggota = "Tidak ditemukan";
}
?>
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">
                                        Riwayat Peminjaman <a href="anggota.php?id_anggota=<?= isset($idAnggota) ? $idAnggota : "Tidak ditemukan" ?>" class="btn icon icon-left btn-success"><i class="bi bi-back"></i>
                                Kembali </a>
                                    </h5>
                                </div>
                                <div class="card-body">

                                    <div class="table-responsive datatable-minimal">
                                    

<div class="alert alert-primary">
    <h4 class="alert-heading"><?= $namaAnggota ?></h4>
    <table>
        <tr>
            <td>ID</td>
            <td> :<?= isset($idAnggota) ? $idAnggota : "Tidak ditemukan" ?></td>
        </tr>
        
        </tr>
    </table>
</div>

<table class="table" id="table1">
    <thead>
        <tr>
            <th>Judul</th>
            <th>Tanggal Peminjaman</th>
            <th>Tanggal Pengembalian</th>
            <th>Denda</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Loop melalui hasil query untuk menampilkan data riwayat peminjaman
        while ($row = mysqli_fetch_assoc($resultPeminjaman)) {
            // Tentukan kelas untuk latar belakang berdasarkan nilai denda
            $bgClass = ($row['denda'] > 1) ? 'bg-danger' : 'bg-success';
            ?>
            <tr>
                <td><?= $row['judul'] ?></td>
                <td><?= $row['tanggal_peminjaman'] ?></td>
                <td><?= $row['tanggal_pengembalian'] ?></td>
                <td>
                    <span class="badge <?= $bgClass ?>">Rp. <?= number_format($row['denda'], 0, ',', '.') ?></span>
                </td>
            </tr>
        <?php } ?>
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