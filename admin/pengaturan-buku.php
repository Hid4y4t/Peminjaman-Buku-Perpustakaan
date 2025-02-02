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
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">
                                    jenis <button type="button" class="btn btn-outline-success"
                                            data-bs-toggle="modal" data-bs-target="#success">
                                            <i class="bi bi-plus"></i> Tambah jenis
                                        </button>

                                        <!-- form Tambah jenis -->
                                        <div class="modal fade text-left" id="success" tabindex="-1" role="dialog"
                                            aria-labelledby="myModalLabel160" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-success">
                                                        <h5 class="modal-title white" id="myModalLabel160">
                                                            Tambah jenis
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
                                                                    action="prosess/tambah-jenis.php">
                                                                    <div class="form-body">
                                                                        <div class="row">
                                                                            <div class="col-12">

                                                                                <div class="form-group has-icon-left">
                                                                                    <label for="first-name-icon">Nama
                                                                                    jenis</label>
                                                                                    <div class="position-relative">
                                                                                        <input type="text" name="jenis"
                                                                                            class="form-control"
                                                                                            placeholder="Novel"
                                                                                            id="first-name-icon">
                                                                                        <div class="form-control-icon">
                                                                                            <i class="bi bi-book"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-12">

                                                                                <div class="form-group has-icon-left">
                                                                                    <label for="email-id-icon">Lama
                                                                                        Peminjaman</label>
                                                                                    <div class="position-relative">
                                                                                        <input type="text"
                                                                                            name="hari_terlambat"
                                                                                            class="form-control"
                                                                                            placeholder="masukan angka berapa hari"
                                                                                            id="email-id-icon">
                                                                                        <div class="form-control-icon">
                                                                                            <i
                                                                                                class="bi bi-calendar-event"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12">

                                                                                <div class="form-group has-icon-left">
                                                                                    <label for="email-id-icon">Biaya
                                                                                        Denda Perhari</label>
                                                                                    <div class="position-relative">
                                                                                        <input type="text"
                                                                                            name="biaya_per_hari"
                                                                                            class="form-control"
                                                                                            id="email-id-icon">
                                                                                        <div class="form-control-icon">
                                                                                            <i
                                                                                                class="bi bi-currency-dollar"></i>
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
                                        <!--end tambah jenis -->
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-striped" id="table1">
                                        <thead>
                                            <tr>
                                                <th>Nama jenis</th>
                                                <th>Batas Waktu Peminjaman</th>
                                                <th>Nominal Denda Perhari</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
    // Koneksi ke database
    include '../koneksi/koneksi.php';

  
    $data = mysqli_query($koneksi, "select * from aturan_denda");
    while ($jenis = mysqli_fetch_array($data)) {
        ?>
                                            <tr>
                                                <td><?= $jenis['jenis'] ?></td>
                                                <td><?= $jenis['hari_terlambat'] ?> Hari</td>
                                                <td>
                                                    <?php
            // Menggunakan number_format() untuk memformat nilai biaya per hari menjadi mata uang Rupiah
            $biaya_per_hari = number_format($jenis['biaya_per_hari'], 0, ',', '.');
            ?>


                                                    <?= 'Rp'. $biaya_per_hari ?></td>

                                                <td>


                                                    <button type="button" class="btn btn-outline-warning"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#warning<?= $jenis['jenis'] ?>"><i
                                                            class="bi bi-eye"></i> Edit</button>



                                                    <!-- form edit jenis -->
                                                    <div class="modal fade text-left" id="warning<?= $jenis['jenis'] ?>"
                                                        tabindex="-1" role="dialog" aria-labelledby="myModalLabel160"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                            role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-warning">
                                                                    <h5 class="modal-title white" id="myModalLabel160">
                                                                        Edit jenis
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-bs-dismiss="modal" aria-label="Close">
                                                                        <i data-feather="x"></i>
                                                                    </button>
                                                                </div>



                                                                <div class="modal-body">
                                                                    <div class="card-content">
                                                                        <div class="card-body">
                                                                            <form class="form form-vertical"
                                                                                method="post"
                                                                                action="prosess/edit-jenis.php"
                                                                                enctype="multipart/form-data">
                                                                                <div class="form-body">
                                                                                    <div class="row">
                                                                                        <div class="col-12">

                                                                                            <div
                                                                                                class="form-group has-icon-left">
                                                                                                <label
                                                                                                    for="first-name-icon">Nama
                                                                                                    jenis</label>
                                                                                                <div
                                                                                                    class="position-relative">

                                                                                                    <input type="text"
                                                                                                        name="jenis"
                                                                                                        class="form-control"
                                                                                                        value="<?= $jenis['jenis'] ?>"
                                                                                                        id="first-name-icon">
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
                                                                                                    for="email-id-icon">Batas
                                                                                                    Waktu
                                                                                                    Peminjaman</label>
                                                                                                <div
                                                                                                    class="position-relative">
                                                                                                    <input type="text"
                                                                                                        name="hari_terlambat"
                                                                                                        value="<?= $jenis['hari_terlambat'] ?>"
                                                                                                        class="form-control"
                                                                                                        placeholder="Pengarang"
                                                                                                        id="email-id-icon">
                                                                                                    <div
                                                                                                        class="form-control-icon">
                                                                                                        <i
                                                                                                            class="bi bi-calendar-heart"></i>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="col-12">
                                                                                            <div
                                                                                                class="form-group has-icon-left">
                                                                                                <label
                                                                                                    for="email-id-icon">Biaya
                                                                                                    Perhari</label>
                                                                                                <div
                                                                                                    class="position-relative">

                                                                                                    <input type="text"
                                                                                                        name="biaya_per_hari"
                                                                                                        value="<?=  $jenis['biaya_per_hari'] ?>"
                                                                                                        class="form-control"
                                                                                                        placeholder="Biaya Perhari"
                                                                                                        id="email-id-icon">
                                                                                                    <div
                                                                                                        class="form-control-icon">
                                                                                                        <i
                                                                                                            class="bi bi-window"></i>
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
                                                                    <button type="button"
                                                                        class="btn btn-light-secondary"
                                                                        data-bs-dismiss="modal">
                                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                                        <span class="d-none d-sm-block">Close</span>
                                                                    </button>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end lihat detail buku -->




                                                    <a href="#" class="btn icon icon-left btn-danger delete-button" data-jenis="<?= $jenis['jenis'] ?>"><i class="bi bi-trash"></i> Hapus</a>


                                                </td>
                                            </tr>

                                            <?php
                                                }
                                                ?>
                                        </tbody>
                                    </table>

                                </div>

                        </section>
                    </div>

                </section>
            </div>
            <?php include 'root/footer.php'?>

        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const deleteButtons = document.querySelectorAll(".delete-button");

        deleteButtons.forEach(button => {
            button.addEventListener("click", function(e) {
                e.preventDefault(); // Mencegah aksi default dari link

                const jenis = this.getAttribute("data-jenis");
                if (confirm("Apakah Anda yakin ingin menghapus jenis ini?")) {
                    deletejenis(jenis);
                }
            });
        });

        function deletejenis(jenis) {
            // Kirim permintaan penghapusan ke server
            // Menggunakan metode POST
            fetch('prosess/delet-jenis.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'jenis=' + jenis,
                })
                .then(response => {
                    if (response.ok) {
                        // Refresh halaman setelah penghapusan berhasil
                        location.reload();
                    } else {
                        throw new Error('Gagal menghapus jenis');
                    }
                })
                .catch(error => console.error('Error deleting jenis:', error));
        }
    });
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