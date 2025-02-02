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
                                <div class="card-body">
                                    <button onclick="cetakLaporan()" class="btn icon icon-left btn-success"><i
                                            data-feather="check-circle"></i>Cetak Laporan PDF</button>
                                    <div class="table-responsive datatable-minimal">

                                        <form action="prosess/hapus_peminjaman.php" method="post">
                                            <?php
        // Sambungkan ke database
        include '../koneksi/koneksi.php';

        // Query untuk mengambil data peminjaman beserta judul buku, nama anggota, dan angkatan
        $query = "SELECT peminjaman.*, buku.judul AS judul_buku, anggota.nama AS nama, anggota.angkatan AS angkatan 
                  FROM peminjaman 
                  JOIN buku ON peminjaman.id_buku = buku.id_buku 
                  JOIN anggota ON peminjaman.id_anggota = anggota.id_anggota";
        $result = mysqli_query($koneksi, $query);

        // Tampilkan tabel data peminjaman
        echo '<table class="table" id="table1">';
        echo '<thead><tr><th></th><th>Judul Buku</th><th>Nama</th><th>Angkatan</th><th>Tanggal Peminjaman</th><th>Tanggal Pengembalian</th><th>Denda</th></tr></thead>';
        echo '<tbody>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td></td>';
            echo '<td>' . $row['judul_buku'] . '</td>';
            echo '<td>' . $row['nama'] . '</td>';
            echo '<td>' . $row['angkatan'] . '</td>';
            echo '<td>' . $row['tanggal_peminjaman'] . '</td>';
            echo '<td>' . $row['tanggal_pengembalian'] . '</td>';
            echo '<td>' . $row['denda'] . '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
        ?>

                                            
                                        </form>

                                        <?php
    // Tutup koneksi database
    mysqli_close($koneksi);
    ?>

                                    </div>

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
        window.location.href = 'prosess/proses_cetak_laporan_peminjaman_all.php';

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