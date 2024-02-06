<?php
$koneksi = mysqli_connect('localhost', 'root', '', 'perpusrxz');

if (mysqli_connect_errno()) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Query untuk menampilkan data dari tabel koleksi dengan INNER JOIN ke tabel buku
$query = "SELECT koleksi.koleksiID, koleksi.userID, koleksi.bukuID, buku.judul, buku.penulis, buku.penerbit, buku.tahunTerbit, buku.deskripsi, kategori.kategori
FROM koleksi
INNER JOIN buku ON koleksi.bukuID = buku.bukuID
LEFT JOIN kategori ON buku.kategoriID = kategori.kategoriID;
";

$result = mysqli_query($koneksi, $query);

// Periksa hasil query
if (!$result) {
    die("Query error: " . mysqli_error($koneksi));
}
?>
<div class="card mt-4">
    <div class="card-header">
        <i class="fas fa-heart text-danger"></i>
        Koleksimu
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th width="1%">No</th>
                        <th width="8%">Nama Kategori</th>
                        <th width="10%">Judul</th>
                        <th width="10%">Penulis</th>
                        <th width="10%">Penerbit</th>
                        <th width="10%">Tahun Terbit</th>
                        <th width="10%">Deskripsi</th>
                        <th width="1%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    while ($data = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $i++; ?>
                            </td>
                            <td>
                                <?php echo $data['kategori']; ?>
                            </td>
                            <td>
                                <?php echo $data['judul']; ?>
                            </td>
                            <td>
                                <?php echo $data['penulis']; ?>
                            </td>
                            <td>
                                <?php echo $data['penerbit']; ?>
                            </td>
                            <td>
                                <?php echo $data['tahunTerbit']; ?>
                            </td>
                            <td>
                                <?php echo $data['deskripsi']; ?>
                            </td>
                            <td>
                                <a href="?page=koleksi/koleksiHapus&id=<?php echo $data['koleksiID']; ?>"
                                    data-toggle="modal" class="btn btn-light text-danger border-dark">
                                    <i class="fa fa-heart"></i>
                                </a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
</div>