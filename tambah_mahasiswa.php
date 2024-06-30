<?php

if (isset($_POST['simpan'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['telp'];

    // Validasi
    $sql = "SELECT * FROM mahasiswa WHERE nim='$nim'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>NIM sudah digunakan</strong>
        </div>
        <?php
    } else {
        // Proses simpan
        $sql = "INSERT INTO mahasiswa (nim, nama_mahasiswa, alamat, telp) VALUES ('$nim', '$nama', '$alamat', '$telp')";
        if ($conn->query($sql) === TRUE) {
            header("Location:?page=mahasiswa");
        }
    }
}
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-primary shadow">
                <div class="card-header bg-primary text-white">
                    <strong>Input Data Mahasiswa</strong>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="nim">NIM</label>
                            <input type="text" class="form-control" name="nim" maxlength="10" required>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Mahasiswa</label>
                            <input type="text" class="form-control" name="nama" maxlength="100" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" name="alamat" maxlength="100" required>
                        </div>
                        <div class="form-group">
                            <label for="telp">No. Telpon</label>
                            <input type="text" class="form-control" name="telp" maxlength="15" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                        <a class="btn btn-danger" href="?page=mahasiswa">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
