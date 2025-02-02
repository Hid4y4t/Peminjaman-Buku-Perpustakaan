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
                                    Anggota <button type="button" class="btn btn-outline-success"
                                            data-bs-toggle="modal" data-bs-target="#success">
                                            <i class="bi bi-plus"></i> Tambah Anggota
                                        </button>

                                        <!-- form Tambah jenis -->
                                        <div class="modal fade text-left" id="success" tabindex="-1" role="dialog"
                                            aria-labelledby="myModalLabel160" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-success">
                                                        <h5 class="modal-title white" id="myModalLabel160">
                                                            Tambah Anggota
                                                        </h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                            <i data-feather="x"></i>
                                                        </button>
                                                    </div>



                                                    <div class="modal-body">
                                                        <div class="card-content">
                                                            <div class="card-body">
                                                            <form class="form form-vertical" method="post" action="prosess/tambah-anggota.php">

                                                                    <div class="form-body">
                                                                        <div class="row">
                                                                            <div class="col-12">

                                                                                <div class="form-group has-icon-left">
                                                                                    <label for="first-name-icon">Nama
                                                                                    </label>
                                                                                    <div class="position-relative">
                                                                                        <input type="text" name="nama"
                                                                                            class="form-control"
                                                                                            placeholder="Nama Lengkap"
                                                                                            id="first-name-icon">
                                                                                        <div class="form-control-icon">
                                                                                            <i class="bi bi-user"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-12">

                                                                                <div class="form-group has-icon-left">
                                                                                    <label for="email-id-icon">Email </label>
                                                                                    <div class="position-relative">
                                                                                        <input type="text"
                                                                                            name="email"
                                                                                            class="form-control"
                                                                                            placeholder="@"
                                                                                            id="email-id-icon">
                                                                                        <div class="form-control-icon">
                                                                                            <i
                                                                                                class="bi bi-mail"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12">
                                                                                <div class="form-group has-icon-left">
                                                                                    <label for="email-id-icon">Telepon</label>
                                                                                    <div class="position-relative">
                                                                                        <input type="number"
                                                                                            name="telepon"
                                                                                            class="form-control"
                                                                                            id="email-id-icon">
                                                                                        <div class="form-control-icon">
                                                                                            <i
                                                                                                class="bi bi-home"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-12">
                                                                                <div class="form-group has-icon-left">
                                                                                    <label for="email-id-icon">Angkatan</label>
                                                                                    <div class="position-relative">
                                                                                        <input type="text"
                                                                                            name="angkatan"
                                                                                            class="form-control"
                                                                                            id="email-id-icon">
                                                                                        <div class="form-control-icon">
                                                                                            <i
                                                                                                class="bi bi-home"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-12">
                                                                                <div class="form-group has-icon-left">
                                                                                    <label for="email-id-icon">Alamat</label>
                                                                                    <div class="position-relative">
                                                                                        <input type="text"
                                                                                            name="alamat"
                                                                                            class="form-control"
                                                                                            id="email-id-icon">
                                                                                        <div class="form-control-icon">
                                                                                            <i
                                                                                                class="bi bi-map-marker-alt"></i>
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
                                            <th>Nomor Anggota</th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>Telepon</th>
                                                <th>Angkatan</th>
                                                <th>Alamat</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
    // Koneksi ke database
    include '../koneksi/koneksi.php';

  
    $data = mysqli_query($koneksi, "select * from anggota");
    while ($ag = mysqli_fetch_array($data)) {
        ?>
                                            <tr>
                                            <td><?= $ag['id_anggota'] ?></td>
                                                <td><?= $ag['nama'] ?></td>
                                                <td><?= $ag['email'] ?> </td>
                                                <td>
                                                <?= $ag['telepon'] ?>
                                                </td>
                                                <td>
                                                <?= $ag['angkatan'] ?>
                                                </td>
                                                <td><?= $ag['alamat'] ?></td>
                                                <td>

                                                <a href="riwayat-peminjaman2.php?id_anggota=<?= $ag['id_anggota'] ?>?>" class="btn icon icon-left btn-success"><i class="bi bi-eye"></i>
                                Riwayat  </a>
                                                    <button type="button" class="btn btn-outline-warning"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#warning<?= $ag['id_anggota'] ?>"><i
                                                            class="bi bi-eye"></i> Edit</button>



                                                    <!-- form edit jenis -->
                                                    <div class="modal fade text-left" id="warning<?= $ag['id_anggota'] ?>"
                                                        tabindex="-1" role="dialog" aria-labelledby="myModalLabel160"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                            role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-warning">
                                                                    <h5 class="modal-title white" id="myModalLabel160">
                                                                        Edit Anngota
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
                                                                                action="prosess/edit-anggota.php"
                                                                                enctype="multipart/form-data">
                                                                                <div class="form-body">
                                                                                    <div class="row">
                                                                                        <div class="col-12">

                                                                                            <div
                                                                                                class="form-group has-icon-left">
                                                                                                <label
                                                                                                    for="first-name-icon">Nama
                                                                                                    </label>
                                                                                                <div
                                                                                                    class="position-relative">

                                                                                                    <input type="text" hidden
                                                                                                        name="id_anggota"
                                                                                                        class="form-control"
                                                                                                        value="<?= $ag['id_anggota'] ?>"
                                                                                                        id="first-name-icon">

                                                                                                    <input type="text"
                                                                                                        name="nama"
                                                                                                        class="form-control"
                                                                                                        value="<?= $ag['nama'] ?>"
                                                                                                        id="first-name-icon">
                                                                                                    <div
                                                                                                        class="form-control-icon">
                                                                                                        <i
                                                                                                            class="bi bi-user"></i>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="col-12">

                                                                                            <div
                                                                                                class="form-group has-icon-left">
                                                                                                <label
                                                                                                    for="email-id-icon">Email</label>
                                                                                                <div
                                                                                                    class="position-relative">
                                                                                                    <input type="text"
                                                                                                        name="email"
                                                                                                        value="<?= $ag['email'] ?>"
                                                                                                        class="form-control"
                                                                                                        placeholder="Pengarang"
                                                                                                        id="email-id-icon">
                                                                                                    <div
                                                                                                        class="form-control-icon">
                                                                                                        <i
                                                                                                            class="bi bi-envelope"></i>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="col-12">
                                                                                            <div
                                                                                                class="form-group has-icon-left">
                                                                                                <label
                                                                                                    for="email-id-icon">Telepon</label>
                                                                                                <div
                                                                                                    class="position-relative">

                                                                                                    <input type="number"
                                                                                                        name="telepon"
                                                                                                        value="<?=  $ag['telepon'] ?>"
                                                                                                        class="form-control"
                                                                                                       
                                                                                                        id="email-id-icon">
                                                                                                    <div
                                                                                                        class="form-control-icon">
                                                                                                        <i
                                                                                                            class="bi bi-address-book"></i>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12">
                                                                                            <div
                                                                                                class="form-group has-icon-left">
                                                                                                <label
                                                                                                    for="email-id-icon">Angkatan</label>
                                                                                                <div
                                                                                                    class="position-relative">

                                                                                                    <input type="text"
                                                                                                        name="angkatan"
                                                                                                        value="<?=  $ag['angkatan'] ?>"
                                                                                                        class="form-control"
                                                                                                       
                                                                                                        id="email-id-icon">
                                                                                                    <div
                                                                                                        class="form-control-icon">
                                                                                                        <i
                                                                                                            class="bi bi-address-book"></i>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="col-12">
                                                                                            <div
                                                                                                class="form-group has-icon-left">
                                                                                                <label
                                                                                                    for="email-id-icon">Alamat</label>
                                                                                                <div
                                                                                                    class="position-relative">

                                                                                                    <input type="text"
                                                                                                        name="alamat"
                                                                                                        value="<?=  $ag['alamat'] ?>"
                                                                                                        class="form-control"
                                                                                                       
                                                                                                        id="email-id-icon">
                                                                                                    <div
                                                                                                        class="form-control-icon">
                                                                                                        <i
                                                                                                            class="bi bi-map-marker-alt"></i>
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




                                                    <a href="#" class="btn icon icon-left btn-danger delete-button" data-anggota="<?= $ag['id_anggota'] ?>"><i class="bi bi-trash"></i> Hapus</a>


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

                const id_anggota = this.getAttribute("data-anggota");
                if (confirm("Apakah Anda yakin ingin menghapus anggota ini?")) {
                    deleteanggota(id_anggota);
                }
            });
        });

        function deleteanggota(id_anggota) {
            // Kirim permintaan penghapusan ke server
            // Menggunakan metode POST
            fetch('prosess/delet-anggota.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'id_anggota=' + id_anggota,
                })
                .then(response => {
                    if (response.ok) {
                        // Refresh halaman setelah penghapusan berhasil
                        location.reload();
                    } else {
                        throw new Error('Gagal menghapus anggota');
                    }
                })
                .catch(error => console.error('Error deleting anggota:', error));
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