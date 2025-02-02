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
                    <div class="col-12 col-lg-9">
                        <div class="row">
                            <?php
                                // Include koneksi ke database
                                include '../koneksi/koneksi.php';

                                // Query untuk menghitung jumlah anggota
                                $query = "SELECT COUNT(*) AS jumlah_anggota FROM anggota";
                                $result = mysqli_query($koneksi, $query);

                                // Ambil jumlah anggota dari hasil query
                                if ($result && mysqli_num_rows($result) > 0) {
                                    $row = mysqli_fetch_assoc($result);
                                    $jumlahAnggota = $row['jumlah_anggota'];
                                } else {
                                    // Jika query gagal atau tidak ada data, set jumlah anggota ke 0
                                    $jumlahAnggota = 0;
                                }

                                // Query untuk menghitung jumlah pengurus
                                $query = "SELECT COUNT(*) AS jumlah_pengurus FROM admin ";
                                $result = mysqli_query($koneksi, $query);

                                // Ambil jumlah pengurus dari hasil query
                                if ($result && mysqli_num_rows($result) > 0) {
                                    $row = mysqli_fetch_assoc($result);
                                    $jumlahPengurus = $row['jumlah_pengurus'];
                                } else {
                                    // Jika query gagal atau tidak ada data, set jumlah pengurus ke 0
                                    $jumlahPengurus = 0;
                                }
                                // Query untuk menghitung jumlah buku
                                $query = "SELECT SUM(jumlah) AS jumlah_buku FROM buku";
                                $result = mysqli_query($koneksi, $query);

                                // Ambil jumlah buku dari hasil query
                                if ($result && mysqli_num_rows($result) > 0) {
                                    $row = mysqli_fetch_assoc($result);
                                    $jumlahBuku = $row['jumlah_buku'];
                                } else {
                                    // Jika query gagal atau tidak ada data, set jumlah buku ke 0
                                    $jumlahBuku = 0;
                                }

                                // Query untuk menghitung jumlah kategori
                                $query = "SELECT COUNT(DISTINCT jenis) AS jumlah_kategori FROM aturan_denda";
                                $result = mysqli_query($koneksi, $query);

                                // Ambil jumlah kategori dari hasil query
                                if ($result && mysqli_num_rows($result) > 0) {
                                    $row = mysqli_fetch_assoc($result);
                                    $jumlahKategori = $row['jumlah_kategori'];
                                } else {
                                    // Jika query gagal atau tidak ada data, set jumlah kategori ke 0
                                    $jumlahKategori = 0;
                                }
                                // Tutup koneksi ke database
                                mysqli_close($koneksi);
                             ?>

                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-4 py-4-5">
                                        <div class="row">
                                            <div
                                                class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                <div class="stats-icon purple mb-2">
                                                    <i class="iconly-boldShow"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                <h6 class="text-muted font-semibold">Anggota</h6>
                                                <h6 class="font-extrabold mb-0"><?= $jumlahAnggota ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-4 py-4-5">
                                        <div class="row">
                                            <div
                                                class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                <div class="stats-icon blue mb-2">
                                                    <i class="iconly-boldProfile"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                <h6 class="text-muted font-semibold">Pengurus</h6>
                                                <h6 class="font-extrabold mb-0"><?= $jumlahPengurus ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-4 py-4-5">
                                        <div class="row">
                                            <div
                                                class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                <div class="stats-icon green mb-2">
                                                    <i class="bi-book"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                <h6 class="text-muted font-semibold">Jumlah Buku</h6>
                                                <h6 class="font-extrabold mb-0"><?= $jumlahBuku ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-4 py-4-5">
                                        <div class="row">
                                            <div
                                                class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                <div class="stats-icon red mb-2">
                                                    <i class="iconly-boldBookmark"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                <h6 class="text-muted font-semibold">Kategori Buku</h6>
                                                <h6 class="font-extrabold mb-0"><?= $jumlahKategori ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Grafik Peminjaman Buku</h4>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="peminjamanChart" width="800" height="400"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-12 col-xl-12">
                                <div class="card">

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

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-3">
                        <div class="card">
                            <div class="card-body py-4 px-4">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-xl">
                                        <img src="assets/static/images/faces/user (1).png" alt="Face 1">
                                    </div>
                                    <div class="ms-3 name">
                                        <h5 class="font-bold"><?= $_SESSION['nama'] ?></h5>
                                        <h6 class="text-muted mb-0"><?= $_SESSION['username'] ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4>Pengurus Perpus</h4>
                            </div>
                            <div class="card-content pb-4">
    <?php
    // Sambungkan ke database
    include '../koneksi/koneksi.php';

    // Query untuk mengambil data admin
    $query = "SELECT nama, username FROM admin";
    $result = mysqli_query($koneksi, $query);

    // Tampilkan data admin dalam format yang diinginkan
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="recent-message d-flex px-4 py-3">';
        echo '<div class="avatar avatar-lg">';
        echo '<img src="assets/static/images/faces/user.png">';
        echo '</div>';
        echo '<div class="name ms-4">';
        echo '<h5 class="mb-1">' . $row['nama'] . '</h5>';
        echo '<h6 class="text-muted mb-0">@' . $row['username'] . '</h6>';
        echo '</div>';
        echo '</div>';
    }

    // Tutup koneksi database
    mysqli_close($koneksi);
    ?>
</div>

                        </div>

                    </div>
                </section>
            </div>
            <?php include 'root/footer.php'?>

        </div>
    </div>
    <script>
    // Fungsi untuk mengambil data peminjaman dari server
    function getData() {
        fetch('chart-data.php')
            .then(response => response.json())
            .then(data => {
                // Memproses data yang diterima
                const counts = {};
                data.forEach(item => {
                    const date = new Date(item.tanggal_peminjaman);
                    const month = date.getMonth() + 1; // Bulan dimulai dari 0 (Januari)
                    counts[month] = (counts[month] || 0) + 1;
                });

                // Pisahkan data bulan dan jumlah peminjaman
                const bulan = Object.keys(counts).map(month => {
                    return 'Bulan ' + month;
                });
                const jumlahPeminjaman = Object.values(counts);

                // Buat grafik menggunakan Chart.js
                const ctx = document.getElementById('peminjamanChart').getContext('2d');
                const chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: bulan,
                        datasets: [{
                            label: 'Jumlah Peminjaman Buku',
                            data: jumlahPeminjaman,
                            backgroundColor: 'skyblue'
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    // Panggil fungsi untuk mengambil data dan membuat grafik
    getData();
    </script>
    <script src="assets/static/js/components/dark.js"></script>
    <script src="assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>


    <script src="assets/compiled/js/app.js"></script>



    <!-- Need: Apexcharts -->
    <script src="assets/extensions/apexcharts/apexcharts.min.js"></script>
    <script src="assets/static/js/pages/dashboard.js"></script>

</body>

</html>