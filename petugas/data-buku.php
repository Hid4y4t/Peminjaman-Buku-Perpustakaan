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
                                        Data Buku 

                                    </h5>
                                </div>
                                <div class="card-body">
                                   
                                <?php include 'root/table-data-buku.php ';?>
                                  

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