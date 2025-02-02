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
                                    <div class="card-header">
                                        <h5 class="card-title">
                                            <center>
                                                Pedoman Penggunaan Aplikasi
                                            </center>
                                        </h5>
                                    </div>



                                    <div class="card-body">

                                        <div class="accordion" id="accordionExample">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingOne">
                                                    <button class="accordion-button" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                        aria-expanded="true" aria-controls="collapseOne">
                                                        <b>Peminjaman Buku</b>
                                                    </button>
                                                </h2>
                                                <div id="collapseOne" class="accordion-collapse collapse show"
                                                    aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <ol>
                                                            <li> Pastikan untuk melakukan login terlebih dahulu sebelum
                                                                menggunakan fitur-fitur aplikasi.</li>
                                                            <li> Untuk melakukan peminjaman buku, pilih menu
                                                                " <a href="peminjaman.php" class='sidebar-link'>
                                                                    <i class="bi bi-server"></i>
                                                                    <span>Peminjaman </span>
                                                                </a>" di halaman utama.</li>
                                                            <li> Masukkan ID anggota pada kolom yang tersedia, kemudian
                                                                klik tombol " <button type=""
                                                                    class="btn btn-outline-info btn-sm">Kirim</button>
                                                                ".</li>
                                                            <li> Jika ID anggota sesuai dan benar, Anda akan dialihkan
                                                                ke halaman "Buat Peminjaman".</li>
                                                            <li> Pada halaman "Buat Peminjaman", masukkan ID buku yang
                                                                ingin dipinjam, lalu klik tombol " <button type=""
                                                                    class="btn btn-outline-info btn-sm">Kirim</button>
                                                                ".</li>
                                                            <li> Jika ID buku benar dan sesuai, akan ditampilkan daftar
                                                                nama buku yang akan dipinjam.</li>
                                                            <li> Setelah semua buku dipindai, klik tombol "Buat
                                                                Peminjaman" untuk menyelesaikan proses.</li>
                                                        </ol>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingTwo">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                        aria-expanded="false" aria-controls="collapseTwo">
                                                        <b>Pengembalian Buku</b>
                                                    </button>
                                                </h2>
                                                <div id="collapseTwo" class="accordion-collapse collapse"
                                                    aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <ol>
                                                            <li>Pilih menu " <a href="pengembalian.php"
                                                                    class='sidebar-link'>
                                                                    <i class="bi bi-clipboard-check"></i>
                                                                    <span>Pengembalian</span>
                                                                </a> " di aplikasi.</li>
                                                            <li>Masukkan ID pengguna pada kolom yang tersedia, kemudian
                                                                klik tombol " <button type=""
                                                                    class="btn btn-outline-info btn-sm">Kirim</button>
                                                                ".</li>
                                                            <li>Jika ID pengguna sesuai dan benar, Anda akan dialihkan
                                                                ke halaman "Buat Pengembalian".</li>
                                                            <li>Pada halaman "Buat Pengembalian", akan ditampilkan tabel
                                                                data berisi informasi peminjaman buku yang belum
                                                                dikembalikan.</li>
                                                            <li>Jika ada buku yang belum dikembalikan, Anda dapat
                                                                melihat detailnya dan kemudian menekan tombol
                                                                "Kembalikan".</li>
                                                            <li>Setelah menekan tombol " <button type=""
                                                                    class="btn btn-outline-info btn-sm">Kembalikan</button>
                                                                ", akan muncul pop-up
                                                                untuk menampilkan detail peminjaman tersebut.</li>
                                                            <li>Selanjutnya, tekan tombol " <button type=""
                                                                    class="btn btn-outline-info btn-sm">Kembalikan</button>
                                                                " untuk
                                                                menyelesaikan proses pengembalian.</li>
                                                        </ol>

                                                    </div>
                                                </div>
                                            </div>
                                           

                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingFive">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseFive"
                                                        aria-expanded="false" aria-controls="collapseFive">
                                                        <b>Cetak Laporan</b>
                                                    </button>
                                                </h2>
                                                <div id="collapseFive" class="accordion-collapse collapse"
                                                    aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <ul>
                                                            <li>Pilih menu " <a href="#" class='sidebar-link'>
                                                                    <i class="bi bi-memory"></i>
                                                                    <span>Laporan</span>
                                                                </a> " di aplikasi.</li>
                                                            <li>Pilih salah satu dari jenis laporan yang ingin dicetak:
                                                                peminjaman, data buku, atau denda.</li>
                                                            <li>Pada halaman laporan yang dipilih, akan ditampilkan
                                                                tabel dengan data yang sesuai.</li>
                                                            <li>Diatas tabel, akan ada tombol "<button
                                                                    onclick="cetakLaporan2()"
                                                                    class="btn icon icon-left btn-success"><i
                                                                        data-feather="check-circle"></i>Cetak Laporan
                                                                    PDF</button> ".</li>
                                                            <li>Klik tombol " <button onclick="cetakLaporan2()"
                                                                    class="btn icon icon-left btn-success"><i
                                                                        data-feather="check-circle"></i>Cetak Laporan
                                                                    PDF</button> " untuk memulai proses
                                                                pencetakan laporan.</li>
                                                            <li>Setelah menekan tombol, Anda akan diarahkan ke halaman
                                                                untuk mencetak laporan dalam format PDF.</li>
                                                            <li>Pada halaman tersebut, Anda dapat memilih opsi cetak
                                                                untuk mencetak laporan sesuai kebutuhan.</li>
                                                        </ul>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>



                    </div>


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