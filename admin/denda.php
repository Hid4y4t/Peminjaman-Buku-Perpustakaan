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


                        <section class="row">
                            <div class="card">
                            <div class="card-header">
                                    <h5 class="card-title">
                                        <center>
                                        Laporan Jumlah Total Denda per Bulan/Tahun
                                        </center>
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <button onclick="cetakLaporan()" class="btn icon icon-left btn-success"><i
                                            data-feather="check-circle"></i>Cetak Laporan PDF</button>
                                    <div class="table-responsive datatable-minimal">
                                    <?php
include '../koneksi/koneksi.php'; // Menghubungkan ke database

// Query SQL untuk mengambil data peminjaman per bulan dengan denda
$query = "SELECT DATE_FORMAT(tanggal_peminjaman, '%Y-%m') AS bulan_peminjaman, SUM(denda) AS total_denda, COUNT(DISTINCT id_anggota) AS jumlah_orang_denda
          FROM peminjaman
          WHERE denda > 0
          GROUP BY DATE_FORMAT(tanggal_peminjaman, '%Y-%m')";
$result = mysqli_query($koneksi, $query);

// Inisialisasi variabel untuk menyimpan data
$data_denda = array();
$total_semua_denda = 0;
$total_orang_denda = 0;

// Memproses data yang diambil
while ($row = mysqli_fetch_assoc($result)) {
    $data_denda[$row['bulan_peminjaman']] = array(
        'total_denda' => $row['total_denda'],
        'jumlah_orang_denda' => $row['jumlah_orang_denda']
    );
    $total_semua_denda += $row['total_denda'];
    $total_orang_denda += $row['jumlah_orang_denda'];
}

// Menutup koneksi
mysqli_close($koneksi);
?>

<table class="table" id="table1">
    <thead>
        <tr>
            <th>Bulan/Tahun</th>
            <th>Total Denda</th>
            <th>Jumlah Orang yang Kena Denda</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data_denda as $bulan_tahun => $data): ?>
        <tr>
            <td><?php echo $bulan_tahun; ?></td>
            <td><?php echo 'Rp ' . number_format($data['total_denda'], 0, ',', '.'); ?></td>
            <td><?php echo $data['jumlah_orang_denda']; ?></td>
        </tr>
        <?php endforeach; ?>
        <tr>
            <td><strong>Total</strong></td>
            <td><strong><?php echo 'Rp ' . number_format($total_semua_denda, 0, ',', '.'); ?></strong></td>
            <td><strong><?php echo $total_orang_denda; ?></strong></td>
        </tr>
    </tbody>
</table>


                                    </div>

                                </div>
                            </div>

                        </section>

                        <section class="row">
                            <div class="card">

                            <div class="card-header">
                                    <h5 class="card-title">
                                        <center>
                                        Laporan Daftar Anggota dengan Total Denda

                                        </center>
                                    </h5>
                                </div>
                                <div class="card-body">

                                    <button onclick="cetakLaporan2()" class="btn icon icon-left btn-success"><i
                                            data-feather="check-circle"></i>Cetak Laporan PDF</button>

                                    <?php
include '../koneksi/koneksi.php'; // Menghubungkan ke database

// Query SQL untuk menghitung jumlah uang denda yang diterima oleh setiap anggota
$query = "SELECT anggota.id_anggota, anggota.nama AS nama_anggota, anggota.angkatan, COUNT(peminjaman.id_anggota) AS total_denda, SUM(peminjaman.denda) AS total_uang_denda
          FROM peminjaman
          JOIN anggota ON peminjaman.id_anggota = anggota.id_anggota
          WHERE peminjaman.denda > 0
          GROUP BY anggota.id_anggota
          ORDER BY total_denda DESC";
$result = mysqli_query($koneksi, $query);

// Inisialisasi variabel untuk menyimpan data
$data_anggota_denda = array();

// Memproses data yang diambil
while ($row = mysqli_fetch_assoc($result)) {
    $data_anggota_denda[] = $row;
}

// Menutup koneksi
mysqli_close($koneksi);
?>

                                    <table class="table" id="table1">
                                        <thead>
                                            <tr>
                                                <th>ID Anggota</th>
                                                <th>Nama Anggota</th>
                                                <th>Angkatan</th>
                                                <th>Total Denda</th>
                                                <th>Total Uang Denda</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($data_anggota_denda as $anggota): ?>
                                            <tr>
                                                <td><?php echo $anggota['id_anggota']; ?></td>
                                                <td><?php echo $anggota['nama_anggota']; ?></td>
                                                <td><?php echo $anggota['angkatan']; ?></td>
                                                <td><?php echo $anggota['total_denda']; ?></td>
                                                <td>Rp
                                                    <?php echo number_format($anggota['total_uang_denda'], 0, ',', '.'); ?>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>


                                </div>
                            </div>
                        </section>



                    </div>


            </div>
            <?php include 'root/footer.php'?>

        </div>
    </div>

    <script>
    function cetakLaporan() {
        // Mengarahkan pengguna ke halaman cetak laporan
        window.location.href = 'prosess/proses_cetak_laporan_denda.php';

    }

    function cetakLaporan2() {
        // Mengarahkan pengguna ke halaman cetak laporan
        window.location.href = 'prosess/proses_cetak_laporan_anggota_denda.php';
    }

    function cetakLaporan3() {
        // Mengarahkan pengguna ke halaman cetak laporan
        window.location.href = 'prosess/proses_cetak_laporan_jumlah_perbuku.php';

    }
    </script>

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