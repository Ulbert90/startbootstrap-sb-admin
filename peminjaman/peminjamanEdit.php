<div class="card mt-4">
    <div class="card-title text-center">
        <h1 class="mt-3 border-bottom">Pinjam Buku</h1>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <form method="post">
                    <?php
                    $id = $_GET['id'];
                        if (isset($_POST['submit'])) {
                            $bukuID = $_POST['bukuID'];
                            $userID = $_SESSION['users']['userID'];
                            $tanggalPeminjaman = $_POST['tanggalPeminjaman'];
                            $tanggalPengembalian = $_POST['tanggalPengembalian'];
                            $statusPeminjaman = $_POST['statusPeminjaman'];
                            $query = mysqli_query($koneksi, "UPDATE peminjaman SET bukuID = '$bukuID', tanggalPeminjaman = '$tanggalPeminjaman', tanggalPengembalian = '$tanggalPengembalian', statusPeminjaman = '$statusPeminjaman'  WHERE peminjamanID = $id");

                                if ($query) {
                                    echo '<script>alert("Tambah data berhasil");</script>';
                                } else {
                                    echo '<script>alert("Tambah data gagal: ' . mysqli_error($koneksi) . '");</script>';
                                }
                            }
                        
                            $query = mysqli_query($koneksi, "SELECT*FROM buku WHERE bukuID=$id");
                            $data = mysqli_fetch_array($query);
                        
                        ?>
                    <div class="row mb-3">
                        <label for="namaKategori" class="form-label">Pinjam Buku</label>
                        <select class="form-control" name="bukuID" id="bukuID">
                            <?php
                                $kat = mysqli_query($koneksi, "SELECT * FROM buku");
                                while ($data = mysqli_fetch_array($kat)) {
                                    $selected = ($data['statusPeminjaman'] == 'dikembalikan') ? 'selected' : ''; // Adjust the condition based on your needs
                                ?> 
                            <option value="<?= $data['bukuID'] ?>" <?= $selected ?>><?= $data['judul'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tanggalPeminjaman" class="form-label">tanggal peminjaman</label>
                        <input type="date" class="form-control" id="tanggalPeminjaman" name="tanggalPeminjaman"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="tanggalPengembalian" class="form-label">Tanggal Pengembalian</label>
                        <input type="date" class="form-control" id="tanggalPengembalian" name="tanggalPengembalian"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="statusPeminjaman" class="form-label">Status Pengembalian</label>
                        <select class="form-select" id="statusPeminjaman" name="statusPeminjaman">
                            <option value="dipinjam">Dipinjam</option>
                            <option value="dikembalikan">Dikembalikan</option>
                        </select>
                    </div>
                    <div class="d-flex mt-4 mx-3 justify-content-center">
                        <button type="submit" class="btn btn-primary ml-3" name="submit"><i
                                class="fas fa-floppy-disk"></i></button>&nbsp;
                        <button type="reset" class="btn btn-secondary ml-3"><i
                                class="fas fa-rotate-right"></i></button>&nbsp;
                        <a href="?page=peminjaman/peminjaman" class="btn btn-danger ml-3"><i
                                class="fas fa-arrow-left"></i></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>