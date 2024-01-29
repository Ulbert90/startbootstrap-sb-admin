<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if (isset($_POST['submit'])) {
        $kategoriID = $_POST['kategoriID'];
        $judul = $_POST['judul'];
        $penulis = $_POST['penulis'];
        $penerbit = $_POST['penerbit'];
        $tahunTerbit = $_POST['tahunTerbit'];

        $sqlBuku = "INSERT INTO buku (judul, penulis, penerbit, tahunTerbit) VALUES (?, ?, ?, ?)";
        $stmtBuku = mysqli_prepare($koneksi, $sqlBuku);
        mysqli_stmt_bind_param($stmtBuku, "ssss", $judul, $penulis, $penerbit, $tahunTerbit);
        $queryBuku = mysqli_stmt_execute($stmtBuku);
        mysqli_stmt_close($stmtBuku);
        if ($queryBuku) {
            $bukuID = mysqli_insert_id($koneksi);

            $sqlRelasi = "INSERT INTO kategoriBuku_relasi (bukuID, kategoriID) VALUES ('$bukuID', '$kategoriID')";
            $queryRelasi = mysqli_query($koneksi, $sqlRelasi);

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
        }
    }

    $query = mysqli_query($koneksi, "SELECT * FROM kategoriBuku_relasi WHERE kategoriBukuID=$id");
    $data = mysqli_fetch_array($query);
?>

<div class="card mt-4">
    <div class="card-title text-center">
        <h1 class="mt-3 border-bottom">Edit Data Buku</h1>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <form method="post">
                    <div class="mb-3">
                        <label for="namaKategori" class="form-label">Kategori Buku</label>
                        <select class="form-control" name="kategoriID" id="kategoriID" disabled>
                            <?php
                                $query = mysqli_query($koneksi, "SELECT * FROM kategoriBuku");
                                while ($kategori = mysqli_fetch_array($query)) {
                                ?>
                            <option
                                <?php if (isset($data['kategoriID']) && $kategori['kategoriID'] == $data['kategoriID']) echo 'selected'; ?>
                                value="<?php echo $kategori['kategoriID']; ?>">
                                <?php echo $kategori['namaKategori']; ?>
                            </option>
                            <?php
                                }
                                ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Buku</label>
                        <input type="text" value="<?php echo isset($data['judul']) ? $data['judul'] : ''; ?>"
                            class="form-control" id="judul" name="judul" required>

                    </div>
                    <div class="mb-3">
                        <label for="penulis" class="form-label">Penulis</label>
                        <input type="text" value="<?php echo isset($data['penulis']) ? $data['penulis'] : ''; ?>"
                            class="form-control" id="penulis" name="penulis" required>

                    </div>
                    <div class="mb-3">
                        <label for="penerbit" class="form-label">Penerbit</label>
                        <input type="text" value="<?php echo isset($data['penerbit']) ? $data['penerbit'] : ''; ?>"
                            class="form-control" id="penerbit" name="penerbit" required>

                    </div>
                    <div class="mb-3">
                        <label for="tahunTerbit" class="form-label">Tahun Terbit</label>
                        <input type="number"
                            value="<?php echo isset($data['tahunTerbit']) ? $data['tahunTerbit'] : ''; ?>"
                            class="form-control" id="tahunTerbit" name="tahunTerbit" required>

                    </div>
                    <div class="d-flex mt-4 mx-3 justify-content-center">
                        <button type="submit" class="btn btn-primary ml-3" name="submit"><i
                                class="fas fa-floppy-disk"></i></button>&nbsp;
                        <button type="reset" class="btn btn-secondary ml-3"><i
                                class="fas fa-rotate-right"></i></button>&nbsp;
                        <a href="?page=buku/buku" class="btn btn-danger ml-3"><i class="fas fa-arrow-left"></i></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
}
?>