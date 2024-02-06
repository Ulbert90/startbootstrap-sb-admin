<?php
include_once 'config.php';

if (!isset($_SESSION['users'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan | ADMIN</title>
</head>

<body>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="my-4">Peminjaman</h1>
        </div>
        <div class="card mt-4">
            <div class="card-header d-flex">
                <div>
                    <i class="fas fa-floppy-disk me-1"></i>
                    Pinjam Buku
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="1%">#</th>
                                <th>User</th>
                                <th>Buku</th>
                                <th>Tanggal Peminjaman</th>
                                <th>Tanggal Pengembalian</th>
                                <th>Status</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            $loggedInUserID = $_SESSION['users']['userID'];
                            $loggedInUserRole = $_SESSION['users']['role'];

                            // Adjusted query based on role and user ID
                            $query = mysqli_query($koneksi, "SELECT * FROM peminjaman 
                                JOIN buku ON peminjaman.bukuID = buku.bukuID 
                                JOIN users ON peminjaman.userID = users.userID
                                WHERE " . (($loggedInUserRole == 'admin') ? '1' : "peminjaman.userID = $loggedInUserID"));

                            while ($data = mysqli_fetch_array($query)) {
                            ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $data['nama']; ?></td>
                                <td><?php echo $data['judul']; ?></td>
                                <td><?php echo date('d F Y', strtotime($data['tanggalPeminjaman'])); ?></td>
                                <td><?php echo date('d F Y', strtotime($data['tanggalPengembalian'])); ?></td>

                                <td
                                    class="<?php echo ($data['statusPeminjaman'] == 'dipinjam') ? 'text-success' : (($data['statusPeminjaman'] == 'dikembalikan') ? 'text-primary' : ''); ?>">
                                    <?php echo $data['statusPeminjaman']; ?></td>

                                <td class="d-flex justify-content-between">
                                    <?php
                                    $isAdmin = ($loggedInUserRole == 'admin');
                                    $isUser = ($loggedInUserID == $data['userID']);

                                    if ($isAdmin || $isUser) {
                                    ?>
                                    <a href="?page=peminjaman/peminjamanEdit&id=<?php echo $data['peminjamanID']; ?>"
                                        data-toggle="modal" class="btn btn-info text-white" title="Edit Peminjaman">
                                        <i class="fa-solid fa-rotate-left"></i>
                                    </a>
                                    <?php
                                    }

                                    if (!$isAdmin && $isUser) {
                                        ?>
                                    <a href="?page=peminjaman/peminjamanHapus&id=<?php echo $data['peminjamanID']; ?>"
                                        data-toggle="modal"
                                        class="btn btn-danger text-white <?php echo ($data['statusPeminjaman'] != 'dikembalikan') ? 'disabled' : ''; ?>"
                                        title="Kembalikan Buku">
                                        <i class="fa-solid fa-delete-left"></i>
                                    </a>
                                    <?php
                                    }

                                    if ($isAdmin && $data['statusPeminjaman'] == 'dikembalikan') {
                                        ?>
                                    <a href="?page=peminjaman/peminjamanHapus&id=<?php echo $data['peminjamanID']; ?>"
                                        data-toggle="modal" class="btn btn-danger text-white" title="Hapus Peminjaman">
                                        <i class="fa-solid fa-delete-left"></i>
                                    </a>
                                    <?php
                                    }
                                    ?>
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
            <a href="?page=peminjaman/peminjamanTambah" class="btn btn-success"><i class="fas fa-plus"></i> Pinjam
                Buku</a>
        </div>
    </div>
</body>

</html>