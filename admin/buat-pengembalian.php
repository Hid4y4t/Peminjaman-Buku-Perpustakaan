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
                        
                      <div class="card">
                      <div class="card-body">
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

        // Query untuk mendapatkan data peminjaman yang sesuai dengan ID anggota dan tanggal_pengembalian kosong
        $queryPeminjaman = "SELECT buku.judul, buku.jenis, peminjaman.tanggal_peminjaman, peminjaman.id_peminjaman, aturan_denda.biaya_per_hari, aturan_denda.hari_terlambat
                            FROM peminjaman
                            JOIN buku ON peminjaman.id_buku = buku.id_buku
                            LEFT JOIN aturan_denda ON buku.jenis = aturan_denda.jenis
                            WHERE peminjaman.id_anggota = '$idAnggota' AND peminjaman.tanggal_pengembalian IS NULL";
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
                            <div class="alert alert-primary">
                                <h4 class="alert-heading"><?= $namaAnggota ?></h4>
                               <table>
                                <tr>
                                    <td>ID</td>
                                    <td> :<?= isset($idAnggota) ? $idAnggota : "Tidak ditemukan" ?></td>
                                </tr>
                          
                                <tr>
                                    <td>Riwayat Peminjaman</td>
                                    <td> : <a href="riwayat_peminjaman.php?id_anggota=<?= isset($idAnggota) ? $idAnggota : "" ?>" class="btn icon icon-left btn-success">
                    <i data-feather="check-circle"></i>
                    Lihat Riwayat Peminjaman
                </a></td>
                                </tr>
                               </table>
                            </div>



                            <div class="table-responsive">
                                <table class="table table-hover table-lg">
                                    <thead>
                                        <tr>
                                            <th>Judul Buku</th>
                                            <th>Jenis</th>
                                            <th>Tanggal Peminjaman</th>
                                            <th>Denda</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
        // Periksa apakah ada data peminjaman yang ditemukan
        if (isset($resultPeminjaman) && mysqli_num_rows($resultPeminjaman) > 0) {
            while ($row = mysqli_fetch_assoc($resultPeminjaman)) {
                // Perhitungan denda
                $tanggalPeminjaman = new DateTime($row['tanggal_peminjaman']);
                $tanggalSekarang = new DateTime();
                $hariTerlambat = $tanggalSekarang->diff($tanggalPeminjaman)->days - $row['hari_terlambat'];
                $denda = max(0, $hariTerlambat) * $row['biaya_per_hari'];
                ?>
                                        <tr>
                                            <td><?= $row['judul'] ?></td>
                                            <td><?= $row['jenis'] ?></td>
                                            <td><?= $row['tanggal_peminjaman'] ?></td>
                                            <td><?= "Rp " . number_format($denda, 0, ',', '.') ?></td>
                                            <td>
                                                <button type="button" class="btn btn-outline-warning"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#warning<?= $row['id_peminjaman'] ?>"><i
                                                        class="bi bi-eye"></i> Pengembalian </button>

                                            </td>


                                            <!-- form pengembalian -->
                                            <div class="modal fade text-left" id="warning<?= $row['id_peminjaman'] ?>"
                                                tabindex="-1" role="dialog" aria-labelledby="myModalLabel160"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                    role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-warning">
                                                            <h5 class="modal-title white" id="myModalLabel160">
                                                                Pengembalian Buku
                                                            </h5>
                                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                                <i data-feather="x"></i>
                                                            </button>
                                                        </div>



                                                        <div class="modal-body">
                                                            <div class="card-content">
                                                                <div class="card-body">
                                                                    <form class="form form-vertical" method="post"
                                                                        action="prosess/pengembalian-buku.php"
                                                                        enctype="multipart/form-data">
                                                                        <div class="form-body">
                                                                            <div class="row">
                                                                                <div class="col-12">

                                                                                    <div
                                                                                        class="form-group has-icon-left">
                                                                                        <label
                                                                                            for="first-name-icon">Nama</label>
                                                                                        <div class="position-relative">
                                                                                            <input type="text"
                                                                                                name="id_peminjaman"
                                                                                                hidden
                                                                                                value="<?= $row['id_peminjaman'] ?>">
                                                                                            <input type="text"
                                                                                                name="judul" readonly
                                                                                                class="form-control"
                                                                                                value="<?= $namaAnggota ?>"
                                                                                                id="first-name-icon">
                                                                                            <div
                                                                                                class="form-control-icon">
                                                                                                <i
                                                                                                    class="bi bi-person"></i>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-12">

                                                                                    <div
                                                                                        class="form-group has-icon-left">
                                                                                        <label for="email-id-icon">Judul
                                                                                            Buku</label>
                                                                                        <div class="position-relative">
                                                                                            <input type="text"
                                                                                                name="judul" readonly
                                                                                                value="<?= $row['judul'] ?>"
                                                                                                class="form-control"
                                                                                                placeholder="Pengarang"
                                                                                                id="email-id-icon">
                                                                                            <div
                                                                                                class="form-control-icon">
                                                                                                <i
                                                                                                    class="bi bi-book"></i>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-12">

                                                                                    <div
                                                                                        class="form-group has-icon-left">
                                                                                        <label
                                                                                            for="email-id-icon">Tanggal
                                                                                            Peminjaman</label>
                                                                                        <div class="position-relative">
                                                                                            <input type="text" readonly
                                                                                                name="tanggal_peminjaman"
                                                                                                value="<?= $row['tanggal_peminjaman'] ?>"
                                                                                                class="form-control"
                                                                                                placeholder="jenis"
                                                                                                id="email-id-icon">
                                                                                            <div
                                                                                                class="form-control-icon">
                                                                                                <i
                                                                                                    class="bi bi-window"></i>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-12">

                                                                                    <div
                                                                                        class="form-group has-icon-left">
                                                                                        <label
                                                                                            for="email-id-icon">Denda</label>
                                                                                        <div class="position-relative">
                                                                                        <input type="text" name="denda" hidden value="<?= $denda ?>" class="form-control" placeholder="Jumlah" id="email-id-icon">
                                                                                            <input type="text"
                                                                                                name="" readonly
                                                                                                value="<?= "Rp " . number_format($denda, 0, ',', '.') ?>"
                                                                                                class="form-control"
                                                                                                placeholder="Jumlah"
                                                                                                id="email-id-icon">
                                                                                            <div
                                                                                                class="form-control-icon">
                                                                                                <i
                                                                                                    class="bi bi-calculator"></i>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <button type="submit"
                                                                                    class="btn btn-primary me-1 mb-1">Simpan</button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light-secondary"
                                                                data-bs-dismiss="modal">
                                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Close</span>
                                                            </button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end Pengembalian -->
                                        </tr>
                                        <?php
            }
        } else {
            ?>
                                        <tr>
                                            <td colspan="5">Tidak ada data peminjaman yang sesuai ditemukan.</td>
                                        </tr>
                                        <?php
        }
        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                      </div>


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