<?php
$koneksi = mysqli_connect('localhost', 'root', 'root', 'perpus');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $userID = (int)$_POST["userID"];
    $bukuID = (int)$_POST["bukuID"];
    $ulasan = $_POST["ulasan"];
    $rating = (int)$_POST["rating"];

    // Check if the combination of userID and bukuID already exists
    $checkQuery = "SELECT * FROM ulasanBuku WHERE userID = '$userID' AND bukuID = '$bukuID'";
    $checkResult = mysqli_query($koneksi, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        // Combination already exists, perform an update
        $updateQuery = "UPDATE ulasanBuku SET ulasan = '$ulasan', rating = '$rating' WHERE userID = '$userID' AND bukuID = '$bukuID'";
        $updateResult = mysqli_query($koneksi, $updateQuery);

        if ($updateResult) {
            // Update successful, you can redirect or display a success message
            echo "<script> alert('Data berhasil diupdate'); window.location.href='?page=ulasan/ulasan'; </script>";
        } else {
            // Update failed, handle the error (e.g., display an error message)
            echo "Error: " . mysqli_error($koneksi);
        }
    } else {
        // Combination does not exist, display an error message
        echo "Error: Ulasan for this user and book does not exist!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Ulasan</title>
    <!-- Include your CSS or libraries here -->
</head>

<body>
    <div class="container">
        <h1 class="my-4">Tambah Ulasan</h1>

        <!-- Add a form for adding or updating reviews -->
        <form method="post" action="?page=ulasan/ulasanTambah">
            <div class="mb-3">
                <label for="userID" class="form-label">Pilih Pengguna:</label>
                <select class="form-control" name="userID" id="userID">
                    <?php
                    $query = mysqli_query($koneksi, "SELECT * FROM users");
                    while ($data = mysqli_fetch_array($query)) {
                        ?>
                    <option value="<?= $data['userID'] ?>"><?= $data['username'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="bukuID" class="form-label">Pilih Buku:</label>
                <select class="form-control" name="bukuID" id="bukuID">
                    <?php
                    $query = mysqli_query($koneksi, "SELECT * FROM buku");
                    while ($data = mysqli_fetch_array($query)) {
                        ?>
                    <option value="<?= $data['bukuID'] ?>"><?= $data['judul'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="ulasan" class="form-label">Isi Ulasan:</label>
                <textarea class="form-control" name="ulasan" required></textarea>
            </div>

            <div class="mb-3">
                <label for="rating" class="form-label">Rating:</label>
                <input type="number" class="form-control" name="rating" required min="1" max="5">
            </div>

            <div class="d-flex mt-4 mx-3 justify-content-center">
                <button type="submit" class="btn btn-primary ml-3" name="submit"><i
                        class="fas fa-floppy-disk"></i></button>&nbsp;
                <button type="reset" class="btn btn-secondary ml-3"><i class="fas fa-rotate-right"></i></button>&nbsp;
                <a href="?page=ulasan/ulasan" class="btn btn-danger ml-3"><i class="fas fa-arrow-left"></i></a>
            </div>
        </form>
    </div>

    <!-- Include your JavaScript or libraries here -->
</body>

</html>