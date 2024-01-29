    <div class="card mt-4">
        <div class="card-title text-center">
            <h1 class="mt-3 border-bottom">Tambah Data Buku</h1>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <form method="post">
                        <?php
                       if (isset($_POST['submit'])) {
                        $kategoriID = mysqli_real_escape_string($koneksi, $_POST['kategoriID']);
                        $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
                        $penulis = mysqli_real_escape_string($koneksi, $_POST['penulis']);
                        $penerbit = mysqli_real_escape_string($koneksi, $_POST['penerbit']);
                        $tahunTerbit = mysqli_real_escape_string($koneksi, $_POST['tahunTerbit']);
                    
                        // Debugging: Print the SQL query for inspection
                        $sql = "INSERT INTO buku (judul, penulis, penerbit, tahunTerbit) VALUES ('$judul','$penulis','$penerbit','$tahunTerbit')";
                        echo $sql;
                    
                        // Insert into buku table
                        $queryBuku = mysqli_query($koneksi, $sql);
                    
                        if ($queryBuku) {
                            // Get the bukuID of the inserted book
                            $bukuID = mysqli_insert_id($koneksi);
                    
                            // Insert into kategoriBuku_relasi table
                            $queryRelasi = mysqli_query($koneksi, "INSERT INTO kategoriBuku_relasi (bukuID, kategoriID) VALUES ('$bukuID', '$kategoriID')");
                    
                            if ($queryRelasi) {
                                echo '<script>
                                        alert("Data berhasil disimpan");
                                        window.location.href = "?page=buku/buku";
                                    </script>';
                            } else {
                                echo '<script>
                                        alert("Gagal menyimpan relasi: ' . mysqli_error($koneksi) . '");
                                    </script>';
                            }
                    
                            // Close the database connection
                            mysqli_close($koneksi);
                        } else {
                            echo '<script>
                                    alert("Gagal menyimpan data buku: ' . mysqli_error($koneksi) . '");
                                </script>';
                        }
                    }
                        ?>

                        <!-- Your HTML form remains unchanged -->


                        <div class="mb-3">
                            <label for="namaKategori" class="form-label">Kategori Buku</label>
                            <select class="form-control" name="kategoriID" id="kategoriID">
                                <?php
                            $query = mysqli_query($koneksi, "SELECT*FROM kategoriBuku");
                            while ($data = mysqli_fetch_array($query)) {
                                ?>
                                <option value="<?=$data['kategoriID']?>"><?=$data['namaKategori']?></option>
                                <?php
                            }

                            ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul Buku</label>
                            <input type="text" class="form-control" id="judul" name="judul" required>
                        </div>
                        <div class="mb-3">
                            <label for="penulis" class="form-label">Penulis</label>
                            <input type="text" class="form-control" id="penulis" name="penulis" required>
                        </div>
                        <div class="mb-3">
                            <label for="penerbit" class="form-label">Penerbit</label>
                            <input type="text" class="form-control" id="penerbit" name="penerbit" required>
                        </div>
                        <div class="mb-3">
                            <label for="tahunTerbit" class="form-label">Tahun Terbit</label>
                            <input type="number" class="form-control" id="tahunTerbit" name="tahunTerbit" required>
                        </div>
                        <div class="d-flex mt-4 mx-3 justify-content-center">
                            <button type="submit" class="btn btn-primary ml-3" name="submit"><i
                                    class="fas fa-floppy-disk"></i></button>&nbsp;
                            <button type="reset" class="btn btn-secondary ml-3"><i
                                    class="fas fa-rotate-right"></i></button>&nbsp;
                            <a href="?page=kategori/kategori" class="btn btn-danger ml-3"><i
                                    class="fas fa-arrow-left"></i></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>