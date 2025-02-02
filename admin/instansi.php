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
                            <div class="row">


                                <?php
    // Koneksi ke database
    include '../koneksi/koneksi.php';

  
    $data = mysqli_query($koneksi, "select * from instansi");
    while ($d = mysqli_fetch_array($data)) {
        ?>



                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-body py-4 px-4">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-xl">
                                                    <img src="../logo/<?= $d['logo'] ?>" alt="Face 1">
                                                </div>
                                                <div class="ms-3 name">
                                                    <h5 class="font-bold"><?= $d['nama'] ?></h5>
                                                    <h6 class="text-muted mb-0"><?= $d['keterangan'] ?></h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-8 ">
                                    <div class="card">

                                        <div class="card-content">
                                            <div class="card-body">

                                                <div class="list-group list-group-horizontal-sm mb-1 text-center"
                                                    role="tablist">
                                                    <a class="list-group-item list-group-item-action active"
                                                        id="list-sunday-list" data-bs-toggle="list" href="#list-sunday"
                                                        role="tab">Identitas Instansi</a>
                                                    <a class="list-group-item list-group-item-action"
                                                        id="list-monday-list" data-bs-toggle="list" href="#list-monday"
                                                        role="tab">Edit Identitas Instansi</a>

                                                </div>
                                                <div class="tab-content text-justify">
                                                    <div class="tab-pane fade show active" id="list-sunday"
                                                        role="tabpanel" aria-labelledby="list-sunday-list">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <form class="form form-vertical">
                                                                    <div class="form-body">
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <div class="form-group has-icon-left">
                                                                                    <label for="first-name-icon">NAMA
                                                                                        INSTANSI</label>
                                                                                    <div class="position-relative">
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            readonly
                                                                                            value="<?= $d['nama'] ?>"
                                                                                            id="first-name-icon">
                                                                                        <div class="form-control-icon">
                                                                                            <i class="bi bi-pin"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-12">
                                                                                <div class="form-group has-icon-left">
                                                                                    <label
                                                                                        for="mobile-id-icon">KEterangan</label>
                                                                                    <div class="position-relative">
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            readonly
                                                                                            value="<?= $d['keterangan'] ?>"
                                                                                            id="mobile-id-icon">
                                                                                        <div class="form-control-icon">
                                                                                            <i class="bi bi-book"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="list-monday" role="tabpanel"
                                                        aria-labelledby="list-monday-list">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <form class="form form-vertical" method="post"
                                                                    action="prosess/instansi.php"
                                                                    enctype="multipart/form-data">
                                                                    <div class="form-body">
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <div class="form-group has-icon-left">
                                                                                    <label for="first-name-icon">NAMA
                                                                                        INSTANSI</label>
                                                                                    <div class="position-relative">


                                                                                        <input type="text"
                                                                                            class="form-control" hidden
                                                                                            value="<?= $d['id_instansi'] ?>"
                                                                                            name="id_instansi">


                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            name="nama"
                                                                                            value="<?= $d['nama'] ?>"
                                                                                            id="first-name-icon">
                                                                                        <div class="form-control-icon">
                                                                                            <i class="bi bi-pin"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-12">
                                                                                <div class="form-group has-icon-left">
                                                                                    <label
                                                                                        for="mobile-id-icon">KETERANGAN</label>
                                                                                    <div class="position-relative">
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            value="<?= $d['keterangan'] ?>"
                                                                                            name="keterangan"
                                                                                            id="mobile-id-icon">
                                                                                        <div class="form-control-icon">
                                                                                            <i class="bi bi-book"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12">
                                                                                <div class="form-group ">
                                                                                    <label for="formFileMultiple"
                                                                                        class="form-label">MASUKAN FOTO
                                                                                        BARU</label>
                                                                                    <input class="form-control"
                                                                                        type="file" name="foto"
                                                                                        id="formFileMultiple" multiple>
                                                                                </div>
                                                                            </div>

                                                                            <div
                                                                                class="col-12 d-flex justify-content-end">
                                                                                <button type="submit"
                                                                                    class="btn btn-primary me-1 mb-1">Submit</button>
                                                                                <button type="reset"
                                                                                    class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                                                }
                                                ?>
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