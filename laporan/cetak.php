<h2 class="text-center border-bottom">BUKTI LAPORAN<br>PERPUSTAKAAN PALAPA</h2>
<table border="1" cellspacing="0" cellpadding="5" style="margin-top: 20px;" width="100%">
    <tr>
        <th>No</th>
        <th>User</th>
        <th>Buku</th>
        <th>Tanggal Peminjaman</th>
        <th>Tanggal Pengembalian</th>
        <th>Status</th>
    </tr>
    <?php
        $i = 1;
        $query = mysqli_query($koneksi, "SELECT * FROM peminjaman 
                                          JOIN buku ON peminjaman.bukuID = buku.bukuID 
                                          JOIN users ON peminjaman.userID = users.userID");
        while ($data = mysqli_fetch_array($query)) {
        ?>
    <tr>
        <td><?php echo $i++; ?></td>
        <td><?php echo $data['nama']; ?></td>
        <td><?php echo $data['judul']; ?></td>
        <td><?php echo $data['tanggalPeminjaman']; ?></td>
        <td><?php echo $data['tanggalPengembalian']; ?></td>
        <td><?php echo $data['statusPeminjaman']; ?></td>
    </tr>
    <?php
        }
        ?>
</table>

<script>
window.print();
setTimeout(function() {
    window.close();
})
</script>