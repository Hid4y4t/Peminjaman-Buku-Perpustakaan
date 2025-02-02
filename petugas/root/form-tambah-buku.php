<form class="form form-vertical" method="post"
                                                                    action="prosess/tambah-buku.php"
                                                                    enctype="multipart/form-data">
                                                                    <div class="form-body">
                                                                        <div class="row">
                                                                            <div class="col-12">

                                                                                <div class="form-group has-icon-left">
                                                                                    <label
                                                                                        for="first-name-icon">Judul</label>
                                                                                    <div class="position-relative">
                                                                                        <input type="text" name="judul"
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
                                                                                            name="pengarang"
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
                                                                                    <label for="jenis">jenis</label>
                                                                                    <div class="position-relative">
                                                                                        <select name="jenis"
                                                                                            class="form-control"
                                                                                            id="jenis">
                                                                                            <option value="">Pilih jenis
                                                                                            </option>
                                                                                            <?php
                // Koneksi ke database
               include '../koneksi/koneksi.php';
                // Query untuk mengambil data jenis dari tabel jenis
                $query = "SELECT * FROM aturan_denda";
                $result = mysqli_query($koneksi, $query);

                // Menampilkan data jenis sebagai opsi dalam elemen select
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<option value="' . $row['jenis'] . '">' . $row['jenis'] . '</option>';
                }

                // Menutup koneksi
                mysqli_close($koneksi);
                ?>
                                                                                        </select>
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
                                                                                        <input type="text" name="jumlah"
                                                                                            class="form-control"
                                                                                            placeholder="Jumlah"
                                                                                            id="email-id-icon">
                                                                                        <div class="form-control-icon">
                                                                                            <i
                                                                                                class="bi bi-calculator"></i>
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
                                                                                            name="tahun_terbit"
                                                                                            class="form-control"
                                                                                            placeholder="Tahun Terbit"
                                                                                            id="email-id-icon">
                                                                                        <div class="form-control-icon">
                                                                                            <i
                                                                                                class="bi bi-calendar"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12">

<div class="form-group has-icon-left">
    <label
        for="email-id-icon">Jumlah Tersedia </label>
    <div class="position-relative">
        <input type="text" name="tersedia"
            class="form-control"
            placeholder="tersedia"
            id="email-id-icon">
        <div class="form-control-icon">
            <i class="bi bi-tag"></i>
        </div>
    </div>
</div>
</div>

                                                                            <div class="col-12">

                                                                                <div class="form-group has-icon-left">
                                                                                    <label for="formFile"
                                                                                        class="form-label">Masukan Foto
                                                                                        Buku</label>
                                                                                    <div class="position-relative">

                                                                                        <input class="form-control"
                                                                                            name="foto" type="file"
                                                                                            id="formFile">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <button type="submit"
                                                                                class="btn btn-primary me-1 mb-1">Simpan</button>
                                                                        </div>
                                                                    </div>

                                                                </form>