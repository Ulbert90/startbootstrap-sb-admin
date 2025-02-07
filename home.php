<h1 class="mt-4">Dashboard</h1>

<div class="mb-3">
    <input class="form-control form-control-lg" type="text" placeholder="Dashboard" aria-label="Disabled input example"
        disabled>
</div>

<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary text-white mb-4">
            <div class="card-body">
                <?php
                echo mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM kategori"));
                ?> Total Kategori
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="?page=kategori/kategori">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card bg-warning text-white mb-4">
            <div class="card-body">
                <?php
                echo mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM buku"));
                ?> Total Buku
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="?page=buku/buku">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card bg-success text-white mb-4">
            <div class="card-body">
                <?php
                echo mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM ulasan"));
                ?> Total Ulasan
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="?page=ulasan/ulasan">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card bg-danger text-white mb-4">
            <div class="card-body">
                <?php
                echo mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM users"));
                ?> Total User
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="#">View Details</a>
                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
            </div>
        </div>
    </div>
</div>
</div>