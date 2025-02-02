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


                        <section class="row">
                            <div class="card">

                                <div class="card-header">
                                    <h5 class="card-title">
                                        <center>
                                            Laporan Rata-rata Durasi Peminjaman Buku Berdasarkan Jenis
                                        </center>
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <button onclick="cetakLaporan()" class="btn icon icon-left btn-success"><i
                                            data-feather="check-circle"></i>Cetak Laporan PDF</button>
                                    <?php
include '../koneksi/koneksi.php'; // Menghubungkan ke database

// Query SQL untuk mengambil data peminjaman buku dan informasi jenis buku
$query = "SELECT buku.jenis, DATEDIFF(peminjaman.tanggal_pengembalian, peminjaman.tanggal_peminjaman) AS durasi_peminjaman
          FROM peminjaman
          JOIN buku ON peminjaman.id_buku = buku.id_buku
          WHERE peminjaman.tanggal_pengembalian IS NOT NULL"; // Hanya hitung durasi peminjaman jika buku sudah dikembalikan

$result = mysqli_query($koneksi, $query);

// Inisialisasi array untuk menyimpan total durasi peminjaman dan jumlah buku untuk setiap jenis
$jenis_durasi = array();
$jenis_jumlah = array();

// Loop melalui hasil query
while ($row = mysqli_fetch_assoc($result)) {
    $jenis = $row['jenis'];
    $durasi_peminjaman = $row['durasi_peminjaman'];

    // Tambahkan durasi peminjaman ke total untuk jenis buku ini
    if (!isset($jenis_durasi[$jenis])) {
        $jenis_durasi[$jenis] = 0;
        $jenis_jumlah[$jenis] = 0;
    }
    $jenis_durasi[$jenis] += $durasi_peminjaman;
    $jenis_jumlah[$jenis]++;
}

// Hitung rata-rata durasi peminjaman untuk setiap jenis buku
$jenis_rata_rata = array();
foreach ($jenis_durasi as $jenis => $total_durasi) {
    $jumlah_buku = $jenis_jumlah[$jenis];
    $rata_rata = ($jumlah_buku > 0) ? $total_durasi / $jumlah_buku : 0;
    $jenis_rata_rata[$jenis] = round($rata_rata, 2);
}

// Tampilkan hasil
echo '<div class="table-responsive3">';
echo '<table class="table" id="table3">';
echo '<thead>';
echo '<tr>';
echo '<th>Jenis Buku</th>';
echo '<th>Rata-rata Lamanya Dipinjam (hari)</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';

foreach ($jenis_rata_rata as $jenis => $rata_rata) {
    echo '<tr>';
    echo '<td>' . $jenis . '</td>';
    echo '<td>' . $rata_rata . '</td>';
    echo '</tr>';
}

echo '</tbody>';
echo '</table>';
echo '</div>';
  // Menutup koneksi
  mysqli_close($koneksi);
// Anda juga bisa menampilkan data dalam bentuk grafik atau tabel jika diinginkan
?>

                                </div>
                            </div>

                        </section>

                        <section class="row">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">
                                        <center>
                                            Laporan Jumlah Total Peminjaman Buku

                                        </center>
                                    </h5>
                                </div>
                                <div class="card-body">

                                    <button onclick="cetakLaporan2()" class="btn icon icon-left btn-success"><i
                                            data-feather="check-circle"></i>Cetak Laporan PDF</button>
                                    <?php
include '../koneksi/koneksi.php'; // Menghubungkan ke database

// Query SQL untuk mengambil data peminjaman buku
$query = "SELECT DATE_FORMAT(tanggal_peminjaman, '%Y-%m') AS bulan_peminjaman, COUNT(*) AS total_peminjaman
          FROM peminjaman
          GROUP BY bulan_peminjaman";

$result = mysqli_query($koneksi, $query);

// Inisialisasi array untuk menyimpan data per bulan
$data_per_bulan = array();

// Memproses data yang diambil
while ($row = mysqli_fetch_assoc($result)) {
    $data_per_bulan[$row['bulan_peminjaman']] = $row['total_peminjaman'];
}

// Tampilkan data dalam bentuk tabel
echo '<div class="table-responsive">';
echo '<table class="table" id="table2">';
echo '<thead>';
echo '<tr>';
echo '<th>Bulan Peminjaman</th>';
echo '<th>Total Peminjaman Buku</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';

foreach ($data_per_bulan as $bulan => $total_peminjaman) {
    echo '<tr>';
    echo "<td>$bulan</td>";
    echo "<td>$total_peminjaman</td>";
    echo '</tr>';
}

echo '</tbody>';
echo '</table>';
echo '</div>';
?>


                                </div>
                            </div>
                        </section>


                        <section class="row">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">
                                        <center>
                                            Laporan Rata-rata Durasi Peminjaman Buku Berdasarkan Jenis
                                        </center>
                                    </h5>
                                </div>

                                <div class="card-body">
                                    <button onclick="cetakLaporan3()" class="btn icon icon-left btn-success"><i
                                            data-feather="check-circle"></i>Cetak Laporan PDF</button>
                                    <?php
include '../koneksi/koneksi.php'; // Menghubungkan ke database

// Query SQL untuk mengambil data peminjaman buku
$query = "SELECT buku.judul, COUNT(*) AS total_peminjaman
          FROM peminjaman
          JOIN buku ON peminjaman.id_buku = buku.id_buku
          GROUP BY buku.judul
          ORDER BY total_peminjaman DESC";

$result = mysqli_query($koneksi, $query);

// Tampilkan data dalam bentuk tabel
echo '<div class="table-responsive">';
echo '<table class="table" id="table1">';
echo '<thead>';
echo '<tr>';
echo '<th>Judul Buku</th>';
echo '<th>Jumlah Total Peminjaman</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';

while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr>';
    echo '<td>' . $row['judul'] . '</td>';
    echo '<td>' . $row['total_peminjaman'] . '</td>';
    echo '</tr>';
}

echo '</tbody>';
echo '</table>';
echo '</div>';
  // Menutup koneksi
  mysqli_close($koneksi);
// Atau, tampilkan data dalam bentuk grafik menggunakan library tertentu seperti Chart.js atau Google Charts
?>


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
        window.location.href = 'prosess/proses_cetak_laporan.php';

    }

    function cetakLaporan2() {
        // Mengarahkan pengguna ke halaman cetak laporan
        window.location.href = 'prosess/proses_cetak_laporan_jumlah_pinjam_buku.php';
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