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
                $query = "SELECT * FROM anggota WHERE id_anggota = '$idAnggota'";
                $result = mysqli_query($koneksi, $query);

                // Periksa apakah data anggota ditemukan
                if (mysqli_num_rows($result) > 0) {
                    $anggota = mysqli_fetch_assoc($result);
                    $namaAnggota = $anggota['nama'];
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
                                    <h4 class="alert-heading"> Nama : <?= $namaAnggota ?></h4>
                                    <p> ID <?= isset($idAnggota) ? $idAnggota : "Tidak ditemukan" ?></p>
                                </div>

                                <div class="row">
                                    <div class="col-sm-10 mb-1">
                                        <div class="input-group input-group-lg">
                                            <span class="input-group-text" id="inputGroup-sizing-lg">ID BUKU</span>
                                            <input type="text" class="form-control" id="inputBookId"
                                                aria-label="Sizing example input"
                                                aria-describedby="inputGroup-sizing-lg">
                                        </div>
                                    </div>
                                    <div class="col-sm-2 mb-1">
                                        <button id="btnAddBook" class="btn btn-outline-info btn-lg">Tambah </button>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-10">
                                        <div id="bookList" class="mt-3"></div>
                                    </div>
                                </div>
                                 <!-- Tombol Kirim untuk menyimpan data peminjaman -->
                            <div class="mt-3">
                                <button id="btnSimpanPeminjaman" class="btn icon icon-left btn-success btn-lg"
                                    data-id-anggota="<?= isset($idAnggota) ? $idAnggota : "" ?>"> <i data-feather="check-circle"></i> Buat
                                    Peminjaman</button>


                            </div>
                            </div>
                           
                        </div>
                    </div>
                </section>
            </div>
            <?php include 'root/footer.php'?>

        </div>
    </div>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const inputBookId = document.getElementById('inputBookId');
        const bookList = document.getElementById('bookList');
        const btnSimpanPeminjaman = document.getElementById('btnSimpanPeminjaman');
        const btnAddBook = document.getElementById('btnAddBook');
        const idAnggota = btnSimpanPeminjaman.dataset.idAnggota;

        btnAddBook.addEventListener('click', function() {
            const bookId = inputBookId.value.trim();
            if (bookId !== '') {
                fetch('check_book.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: 'id_buku=' + bookId,
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'found') {
                            const bookItem = document.createElement('div');
                            bookItem.className = 'alert alert-info alert-dismissible show fade';
                            bookItem.innerHTML = `
                          <h3>  ${data.judul}</h3> ID Buku : ${data.id_buku} 
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        `;
                            bookItem.dataset.bookId = data.id_buku;
                            bookList.appendChild(bookItem);
                            btnSimpanPeminjaman.style.display = 'block';
                        } else if (data.status === 'not_found') {
                            alert('Buku tidak ditemukan');
                        } else {
                            alert('Terjadi kesalahan saat memeriksa buku');
                        }
                    })
                    .catch(error => console.error('Error checking book:', error));

                inputBookId.value = '';
            }
        });

        // Tombol Kirim Peminjaman
        // Tombol Kirim Peminjaman
        btnSimpanPeminjaman.addEventListener('click', function() {
            const idAnggota = '<?= isset($idAnggota) ? $idAnggota : "" ?>';
            const bookItems = bookList.querySelectorAll('.alert');
            const selectedBooks = [];
            bookItems.forEach(function(bookItem) {
                const bookId = bookItem.dataset.bookId;
                selectedBooks.push(bookId);
            });

            if (idAnggota !== '' && selectedBooks.length > 0) {
                // Nonaktifkan tombol
                btnSimpanPeminjaman.disabled = true;

                fetch('simpan_peminjaman.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: 'id_anggota=' + idAnggota + '&id_buku=' + selectedBooks.join(','),
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === "success") {
                            // Alihkan ke halaman peminjaman.php
                            window.location.href = 'peminjaman.php';
                        } else {
                            alert(data.message); // Tampilkan pesan dari server jika tidak berhasil
                            // Aktifkan kembali tombol
                            btnSimpanPeminjaman.disabled = false;
                        }
                    })
                    .catch(error => {
                        console.error('Error saving peminjaman:', error);
                        // Aktifkan kembali tombol jika terjadi kesalahan
                        btnSimpanPeminjaman.disabled = false;
                    });
            } else {
                alert('ID anggota dan setidaknya satu ID buku harus dipilih');
            }
        });

        if (bookList.children.length === 0) {
            btnSimpanPeminjaman.style.display = 'none';
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