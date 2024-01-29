<?php
$query = "SELECT kb.kategoriBukuID, b.judul, b.penulis, b.penerbit, b.tahunTerbit, k.namaKategori
          FROM kategoriBuku_relasi kb
          INNER JOIN buku b ON kb.bukuID = b.bukuID
          INNER JOIN kategoriBuku k ON kb.kategoriID = k.kategoriID";

$result = mysqli_query($koneksi, $query);

if (!$result) {
    die('Error: ' . mysqli_error($koneksi));
}
?>

<div class="card mt-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Data Buku
    </div>
    <div class="card-body">
        <table class="table table-bordered" width="100%">
            <thead>
                <tr>
                    <th width="1%">No</th>
                    <th>Nama Kategori</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Tahun Terbit</th>
                    <th width="14%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while ($data = mysqli_fetch_assoc($result)) {
                    ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $data['namaKategori']; ?></td>
                    <td><?php echo $data['judul']; ?></td>
                    <td><?php echo $data['penulis']; ?></td>
                    <td><?php echo $data['penerbit']; ?></td>
                    <td><?php echo $data['tahunTerbit']; ?></td>

                    <td class="d-grid gap-2 d-md-block">
                        <a href="?page=buku/bukuEdit&id=<?php echo $data['kategoriBukuID']; ?>" data-toggle="modal"
                            class="btn btn-warning text-white"><i class="fa fa-pencil"></i></a>
                        <a href="?page=buku/bukuHapus&id=<?php echo $data['kategoriBukuID']; ?>"
                            onclick="confirmDelete(<?php echo $data['kategoriBukuID']; ?>)"
                            class="btn btn-danger justify-content-end"><i class="fa fa-trash-can"></i></a>
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<div class="d-grid mt-3">
    <a href="?page=buku/bukuTambah" class="btn btn-primary"><i class="fas fa-plus"></i>Tambah Buku</a>
</div>
</div>