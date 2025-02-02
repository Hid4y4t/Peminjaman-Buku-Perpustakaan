<footer>
<?php
    // Koneksi ke database
    include '../koneksi/koneksi.php';

  
    $data = mysqli_query($koneksi, "select * from instansi");
    while ($d = mysqli_fetch_array($data)) {
        ?>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2024 &copy;  <?= $d['nama'] ?></p>
                    </div>
                   
                </div>
                <?php
                                                }
                                                ?>
            </footer>