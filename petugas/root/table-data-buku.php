<table class="table table-striped" id="table1">
                                        <thead>
                                            <tr>
                                                <th>Foto</th>
                                                <th>ID Buku</th>
                                                <th>Nama</th>
                                                <th>Pengarang</th>
                                                <th>jenis</th>
                                                <th>Jumlah</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
    // Koneksi ke database
    include '../koneksi/koneksi.php';

  
    $data = mysqli_query($koneksi, "select * from buku");
    while ($d = mysqli_fetch_array($data)) {
        ?>


                                            <tr>
                                            <td class="col-4" > <center>
                                            <img style="max-width: 20%;  border-radius: 10px;"
                                                                                                    src="../buku/<?= $d['foto'] ?>"
                                                                                                    alt="">
                                            </center></td>
                                            <td><?= $d['id_buku'] ?></td>
                                                <td><?= $d['judul'] ?></td>
                                                <td><?= $d['pengarang'] ?></td>
                                                <td><?= $d['jenis'] ?></td>
                                                <td><?= $d['jumlah'] ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-outline-primary view-button"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#primary<?= $d['id_buku'] ?>"
                                                        data-book-id="<?= $d['id_buku'] ?>"><i class="bi bi-eye"></i>
                                                        Lihat</button>


                                                    <!-- lihat detail buku -->
                                                    <div class="modal fade text-left" id="primary<?= $d['id_buku'] ?>"
                                                        tabindex="-1" role="dialog" aria-labelledby="myModalLabel160"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                            role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-primary">
                                                                    <h5 class="modal-title white" id="myModalLabel160">
                                                                        Detail Buku
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-bs-dismiss="modal" aria-label="Close">
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
                                                                                                    src="../buku/<?= $d['foto'] ?>"
                                                                                                    alt="">
                                                                                            </center>
                                                                                            <div
                                                                                                class="form-group has-icon-left">
                                                                                                <label
                                                                                                    for="first-name-icon">Judul</label>
                                                                                                <div
                                                                                                    class="position-relative">
                                                                                                    <input type="text"
                                                                                                        readonly
                                                                                                        class="form-control"
                                                                                                        value="<?= $d['judul'] ?>"
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
                                                                                                    for="email-id-icon">Pengarang</label>
                                                                                                <div
                                                                                                    class="position-relative">
                                                                                                    <input type="text"
                                                                                                        readonly
                                                                                                        value="<?= $d['pengarang'] ?>"
                                                                                                        class="form-control"
                                                                                                        placeholder="Pengarang"
                                                                                                        id="email-id-icon">
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
                                                                                                <label
                                                                                                    for="email-id-icon">jenis</label>
                                                                                                <div
                                                                                                    class="position-relative">
                                                                                                    <input type="text"
                                                                                                        readonly
                                                                                                        value="<?= $d['jenis'] ?>"
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
                                                                                                    for="email-id-icon">Jumlah</label>
                                                                                                <div
                                                                                                    class="position-relative">
                                                                                                    <input type="text"
                                                                                                        readonly
                                                                                                        value="<?= $d['jumlah'] ?>"
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

                                                                                       

                                                                                        <div class="col-12">

                                                                                            <div
                                                                                                class="form-group has-icon-left">
                                                                                                <label
                                                                                                    for="email-id-icon">Tahun
                                                                                                    Terbit</label>
                                                                                                <div
                                                                                                    class="position-relative">
                                                                                                    <input type="text"
                                                                                                        readonly
                                                                                                        value="<?= $d['tahun_terbit'] ?>"
                                                                                                        class="form-control"
                                                                                                        placeholder="Tahun Terbit"
                                                                                                        id="email-id-icon">
                                                                                                    <div
                                                                                                        class="form-control-icon">
                                                                                                        <i
                                                                                                            class="bi bi-calendar"></i>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="col-12">

                                                                                            <div
                                                                                                class="form-group has-icon-left">
                                                                                                <label
                                                                                                    for="email-id-icon">Tersedia</label>
                                                                                                <div
                                                                                                    class="position-relative">
                                                                                                    <input type="text"
                                                                                                        readonly
                                                                                                        class="form-control"
                                                                                                        placeholder="Tersedia"
                                                                                                        id="email-id-icon"
                                                                                                        value="<?= $d['tersedia']  ?>">

                                                                                                    <div
                                                                                                        class="form-control-icon">
                                                                                                        <i
                                                                                                            class="bi bi-folder"></i>
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





                            
                                                </td>




                                                
                                            </tr>






                                            <?php
                                                }
                                                ?>
                                        </tbody>
                                    </table>