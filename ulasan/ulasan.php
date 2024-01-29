<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ulasan</title>
    <!-- Tambahkan CSS atau library yang dibutuhkan disini -->
</head>

<body>
    <div class="container">
        <h1 class="my-4">Daftar Ulasan</h1>

        <!-- Tambahkan card untuk tabel ulasan -->
        <div class="card mt-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Ulasan
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="1%">#</th>
                                <th>Judul Buku</th>
                                <th>Nama Pengguna</th>
                                <th>Ulasan</th>
                                <th>Rating</th>
                                <th width="14%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            $query = mysqli_query($koneksi, "SELECT * FROM ulasanBuku JOIN buku ON ulasanBuku.bukuID = buku.bukuID JOIN users ON ulasanBuku.userID = users.userID");
                            while ($data = mysqli_fetch_array($query)) {
                            ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $data['judul']; ?></td>
                                <td><?php echo $data['namaLengkap']; ?></td>
                                <td><?php echo $data['ulasan']; ?></td>
                                <td><?php echo $data['rating']; ?></td>
                                <td class="d-grid gap-2 d-md-block">
                                    <a href="?page=ulasan/ulasanEdit&id=<?php echo $data['ulasanID']; ?>"
                                        data-toggle="modal" class="btn btn-warning text-white"><i
                                            class="fa fa-pencil"></i></a>
                                    <a onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');"
                                        href="?page=ulasan/ulasanHapus&id=<?php echo $data['ulasanID']; ?>"
                                        data-toggle="modal" class="btn btn-danger justify-content-end">
                                        <i class="fa fa-trash-can"></i>
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
        <div class="d-grid mt-3">
            <a href="?page=ulasan/ulasanTambah" class="btn btn-primary"><i class="fas fa-plus"></i>Tambah
                Ulasan</a>
        </div>
    </div>
    </div>
</body>

</html>