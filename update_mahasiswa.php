<?php 

if (isset($_POST['update'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['telp'];

    // Proses update
    $sql = "UPDATE mahasiswa SET nama_mahasiswa='$nama', alamat='$alamat', telp='$telp' WHERE nim='$nim'";
    if ($conn->query($sql) === TRUE) {
        header("Location:?page=mahasiswa");
    }
}

$nim = $_GET['nim'];

$sql = "SELECT * FROM mahasiswa WHERE nim='$nim'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-primary shadow">
                <div class="card-header bg-primary text-white">
                    <strong>Update Data Mahasiswa</strong>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="nim">NIM</label>
                            <input type="text" class="form-control" value="<?php echo $row["nim"] ?>" name="nim" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Mahasiswa</label>
                            <input type="text" class="form-control" value="<?php echo $row["nama_mahasiswa"] ?>" name="nama" maxlength="100" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" value="<?php echo $row["alamat"] ?>" name="alamat" maxlength="100" required>
                        </div>
                        <div class="form-group">
                            <label for="telp">No. Telepon</label>
                            <input type="text" class="form-control" value="<?php echo $row["telp"] ?>" name="telp" maxlength="15" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="update">Update</button>
                        <a class="btn btn-danger" href="?page=mahasiswa">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
