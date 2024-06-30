<?php
// Query untuk menghitung jumlah total mahasiswa
$sql_total_mahasiswa = "SELECT COUNT(*) AS total_mahasiswa FROM mahasiswa";
$result_total_mahasiswa = $conn->query($sql_total_mahasiswa);
$row_total_mahasiswa = $result_total_mahasiswa->fetch_assoc();
$total_mahasiswa = $row_total_mahasiswa['total_mahasiswa'];
?>

<div class="container">
    <div class="row">
        <!-- Jumbotron untuk Pengantar -->
        <div class="col-md-12 mb-4">
            <div class="jumbotron">
                <h1 class="display-4">Sistem Penerimaan Beasiswa</h1>
                <p class="lead">Berbasis website menggunakan metode SAW</p>
                <hr class="my-4">
                <p>Metode SAW (Simple Additive Weighting) adalah salah satu metode yang digunakan dalam Sistem Pendukung Keputusan (SPK) untuk membantu pengambilan keputusan dengan berbagai kriteria. </p>
                <a class="btn btn-primary btn-lg" href="#" role="button">Lihat Informasi Beasiswa</a>
            </div>
        </div>

        <!-- List Group untuk Informasi Beasiswa -->
        <div class="col-md-4 mb-4">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action active">
                    Informasi Beasiswa
                </a>
                <a href="#" class="list-group-item list-group-item-action">Beasiswa Prestasi</a>
                <a href="#" class="list-group-item list-group-item-action">Beasiswa Bidang Studi</a>
                <a href="#" class="list-group-item list-group-item-action">Beasiswa Luar Negeri</a>
                <a href="#" class="list-group-item list-group-item-action">Beasiswa Penuh</a>
            </div>
        </div>

        <!-- Card Total Mahasiswa -->
        <div class="col-md-4 mb-4">
            <div class="card border-primary shadow">
                <div class="card-header bg-primary text-white">
                    Total Mahasiswa
                </div>
                <div class="card-body">
                    <h4 class="card-title"><?php echo $total_mahasiswa; ?></h4>
                    <p class="card-text">Mahasiswa Terdaftar</p>
                </div>
            </div>
        </div>

        <!-- Card Deadline Pendaftaran -->
        <div class="col-md-4 mb-4">
            <div class="card border-danger shadow">
                <div class="card-header bg-danger text-white">
                    Deadline Pendaftaran
                </div>
                <div class="card-body">
                    <h5 class="card-title">15 Juli 2024</h5>
                    <p class="card-text">kesempatan untuk mendaftar beasiswa tahun ini.</p>
                    <a href="#" class="btn btn-danger">Detail Pendaftaran</a>
                </div>
            </div>
        </div>
    </div>
</div>
