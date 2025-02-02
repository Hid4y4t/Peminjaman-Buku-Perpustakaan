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
                                        Data Buku <button type="button" class="btn btn-outline-success"
                                            data-bs-toggle="modal" data-bs-target="#success">
                                            <i class="bi bi-plus"></i> Tambah Buku
                                        </button>
 
                                        <!-- form Tambah buku -->
                                        <div class="modal fade text-left" id="success" tabindex="-1" role="dialog"
                                            aria-labelledby="myModalLabel160" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-success">
                                                        <h5 class="modal-title white" id="myModalLabel160">
                                                            Tambah Buku
                                                        </h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                            <i data-feather="x"></i>
                                                        </button>
                                                    </div>



                                                    <div class="modal-body">
                                                        <div class="card-content">
                                                            <div class="card-body">
                                                                <?php include 'root/form-tambah-buku.php';?>
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
                                        <!--end tambah buku -->

                                    </h5>
                                </div>
                                <div class="card-body">
                                   
                                <?php include 'root/table-data-buku.php ';?>
                                    <!-- form edit buku -->
                                    <div class="modal fade text-left" id="warning" tabindex="-1" role="dialog"
                                        aria-labelledby="myModalLabel160" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                            role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-warning">
                                                    <h5 class="modal-title white" id="myModalLabel160">
                                                        Edit Buku
                                                    </h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i data-feather="x"></i>
                                                    </button>
                                                </div>



                                                <div class="modal-body">
                                                    <div class="card-content">
                                                        <div class="card-body">
                                                            <form class="form form-vertical">
                                                                <div class="form-body">
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <center>
                                                                                <img style="max-width: 50%; border-radius: 10px;"
                                                                                    src="assets/compiled/jpg/1.jpg"
                                                                                    alt="">
                                                                            </center>
                                                                            <div class="form-group has-icon-left">
                                                                                <label
                                                                                    for="first-name-icon">Judul</label>
                                                                                <div class="position-relative">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        placeholder="Belajar Coding"
                                                                                        id="first-name-icon">
                                                                                    <div class="form-control-icon">
                                                                                        <i class="bi bi-book"></i>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-12">

                                                                            <div class="form-group has-icon-left">
                                                                                <label
                                                                                    for="email-id-icon">Pengarang</label>
                                                                                <div class="position-relative">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        placeholder="Pengarang"
                                                                                        id="email-id-icon">
                                                                                    <div class="form-control-icon">
                                                                                        <i class="bi bi-person"></i>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-12">

                                                                            <div class="form-group has-icon-left">
                                                                                <label for="email-id-icon">jenis</label>
                                                                                <div class="position-relative">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        placeholder="jenisv"
                                                                                        id="email-id-icon">
                                                                                    <div class="form-control-icon">
                                                                                        <i class="bi bi-window"></i>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-12">

                                                                            <div class="form-group has-icon-left">
                                                                                <label
                                                                                    for="email-id-icon">Jumlah</label>
                                                                                <div class="position-relative">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        placeholder="Jumlah"
                                                                                        id="email-id-icon">
                                                                                    <div class="form-control-icon">
                                                                                        <i class="bi bi-calculator"></i>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-12">

                                                                            <div class="form-group has-icon-left">
                                                                                <label for="email-id-icon">Jenis</label>
                                                                                <div class="position-relative">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        placeholder="Jenis"
                                                                                        id="email-id-icon">
                                                                                    <div class="form-control-icon">
                                                                                        <i class="bi bi-tag"></i>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-12">

                                                                            <div class="form-group has-icon-left">
                                                                                <label for="email-id-icon">Tahun
                                                                                    Terbit</label>
                                                                                <div class="position-relative">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        placeholder="Tahun Terbit"
                                                                                        id="email-id-icon">
                                                                                    <div class="form-control-icon">
                                                                                        <i class="bi bi-calendar"></i>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-12">

                                                                            <div class="form-group has-icon-left">
                                                                                <label
                                                                                    for="email-id-icon">Tersedia</label>
                                                                                <div class="position-relative">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        placeholder="Tersedia"
                                                                                        id="email-id-icon">
                                                                                    <div class="form-control-icon">
                                                                                        <i class="bi bi-folder"></i>
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
                                    <!--end lihat detail buku -->

                                </div>
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

            const bookId = this.getAttribute("data-book-id");
            if (confirm("Apakah Anda yakin ingin menghapus buku ini?")) {
                deleteBook(bookId);
            }
        });
    });

    function deleteBook(bookId) {
        // Kirim permintaan penghapusan ke server
        // Menggunakan metode POST
        fetch('root/delete_book.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'id_buku=' + bookId,
            })
            .then(response => {
                if (response.ok) {
                    // Refresh halaman setelah penghapusan berhasil
                    location.reload();
                } else {
                    throw new Error('Gagal menghapus buku');
                }
            })
            .catch(error => console.error('Error deleting book:', error));
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