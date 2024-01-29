<?php
require_once 'config.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_array($result);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['users'] = $row;
        header('Location: index.php');
    } else {
        echo '<script>alert("Maaf, username/password salah.");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/bootstrap.min.js"></script>
    <title>login perpus palapa</title>
</head>
<style>
body {
    background-image: url('https://img.freepik.com/free-photo/hand-painted-watercolor-background-with-sky-clouds-shape_24972-1095.jpg?w=996&t=st=1705748883~exp=1705749483~hmac=6cd79cc787cc69c8e099876aa976d75d18add4e21f35109276961b2b12c5352c');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    margin: 0;
    padding: 0;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>

<body>
    <section>
        <div class="card" style="background-color: #EFFAFC;">
            <div class="row g-0">
                <div class="col-md-6">
                    <img src="https://img.freepik.com/free-vector/hand-drawn-flat-design-stack-books-illustration_23-2149341898.jpg?w=740&t=st=1706196959~exp=1706197559~hmac=2d2ea10148375cc4f110ec0819281656f866d6355c8762f671df7aaa59f6ae91"
                        class="card-img-top" alt="User Image">
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <h5 class="card-title text-center mt-3">Login Perpus</h5>
                        <hr>

                        <!-- Login Form -->
                        <form method="post">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-success" type="submit" name="login">Login</button>
                            </div>
                            <p class="mt-2">Belum Punya Akun?<a href="register.php"> Register</p>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>