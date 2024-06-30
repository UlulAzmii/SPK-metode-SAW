<?php
date_default_timezone_set("Asia/Jakarta");
session_start();
require "config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistem Penerimaan Beasiswa</title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/datatables.min.css">
    <link rel="stylesheet" href="assets/css/all.css">
    <link rel="stylesheet" href="assets/css/bootstrap-chosen.css">
    <style>
    .navbar {
        background-color: #007bff;
        border-radius: 0 0 10px 10px;
        padding: 10px 20px;
    }
    .navbar-brand {
        color: white;
        font-size: 24px;
    }
    .navbar-nav .nav-link {
        color: white;
        font-size: 16px;
        margin-right: 10px;
        position: relative;
        transition: all 0.3s ease;
    }
    .navbar-nav .nav-link::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: #0056b3;
        z-index: -1;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .navbar-nav .nav-link:hover::before {
        opacity: 1;
    }
    .navbar-nav .nav-link:hover {
        font-size: 17px; 
    }
</style>


</head>
<body>

<!-- cek status login atau belum -->
<?php 
    if($_SESSION['status'] != "y"){
        header("Location: login.php");
    }
?>

<nav class="navbar navbar-expand-lg">
    <!-- <a class="navbar-brand" href="#">Sistem Penerimaan Beasiswa</a> -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php"><i class="fas fa-home"></i> Home</a>
            </li>
            <?php if($_SESSION['level'] == "Pimpinan"): ?>
                <li class="nav-item">
                    <a class="nav-link" href="?page=users"><i class="fas fa-user"></i> User</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=perangkingan&thn"><i class="fas fa-address-book"></i> Perangkingan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=report"><i class="fas fa-print"></i> Report</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="?page=mahasiswa"><i class="fas fa-user-circle"></i> Mahasiswa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=pendaftaran"><i class="fas fa-address-book"></i> Pendaftaran</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=perangkingan&thn"><i class="fas fa-address-book"></i> Perangkingan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=report"><i class="fas fa-print"></i> Report</a>
                </li>
            <?php endif; ?>
            <li class="nav-item">
                <a class="nav-link" href="?page=logout" onclick="return confirm('Apakah Anda yakin ingin logout?')"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-4">
    <?php
        $page = isset($_GET['page']) ? $_GET['page'] : "";
        $action = isset($_GET['action']) ? $_GET['action'] : "";

        if ($page==""){
            include "welcome.php";
        } elseif ($page=="mahasiswa"){
            if ($action==""){
                include "pageMahasiswa.php";
            } elseif($action=="tambah"){
                include "tambah_mahasiswa.php";
            } elseif($action=="update"){
                include "update_mahasiswa.php";
            } else {
                include "hapus_mahasiswa.php";
            }
        } elseif ($page=="pendaftaran"){
            if ($action==""){
                include "pagePendaftaran.php";
            } elseif($action=="tambah"){
                include "tambah_pendaftaran.php";
            } elseif($action=="update"){
                include "update_pendaftaran.php";
            } else {
                include "hapus_pendaftaran.php";
            }
        } elseif ($page=="perangkingan"){
            if ($action==""){
                include "perangkingan.php";
            }
        } elseif ($page=="users"){
            if ($action==""){
                include "tampil_users.php";
            } elseif($action=="tambah"){
                include "tambah_users.php";
            } elseif($action=="update"){
                include "update_users.php";
            } else {
                include "hapus_users.php";
            }
        } elseif ($page=="report"){
            if ($action==""){
                include "report.php";
            }        
        } else {
            if ($action==""){
                include "logout.php";
            }
        }
    ?>
</div>

<script src="assets/js/jquery-3.7.0.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/all.js"></script>
<script src="assets/js/datatables.min.js"></script>
<script>
   $(document).ready(function () {
       $('#myTable').dataTable();
   });
</script>

<script src="assets/js/chosen.jquery.min.js"></script>
<script>
 $(function() {
   $('.chosen').chosen();
 });
</script>

</body>
</html>
