<?php 
$id = $_GET['id'];

if(isset($_POST['update'])){
    $pendapatan = $_POST['pendapatan'];
    $ipk = $_POST['ipk'];
    $saudara = $_POST['saudara'];

    // proses update
    $sql = "UPDATE pendaftaran SET pendapatan_ortu='$pendapatan', ipk='$ipk', jml_saudara='$saudara' WHERE iddaftar='$id'";
    if ($conn->query($sql) === TRUE) {
        header("Location:?page=pendaftaran");
    }
}

$sql = "SELECT pendaftaran.iddaftar, pendaftaran.tgldaftar, pendaftaran.tahun, pendaftaran.nim, mahasiswa.nama_mahasiswa, pendaftaran.pendapatan_ortu, pendaftaran.ipk, pendaftaran.jml_saudara FROM mahasiswa INNER JOIN pendaftaran ON mahasiswa.nim=pendaftaran.nim WHERE iddaftar='$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                    <div class="card-header bg-primary text-white border-dark">
                        <strong>UPDATE DATA PENDAFTARAN</strong>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Tahun</label>
                            <input type="text" class="form-control" value="<?php echo $row["tahun"] ?>" name="tahun" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Mahasiswa</label>
                            <input type="text" class="form-control" value="<?php echo $row["nama_mahasiswa"] ?>" name="nama" maxlength="100" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Pendapatan Orang Tua</label>
                            <input type="number" class="form-control" value="<?php echo $row["pendapatan_ortu"] ?>" name="pendapatan" min="0" max="9999999999" required>
                        </div>
                        <div class="form-group">
                            <label for="">IPK Terakhir</label>
                            <input type="number" class="form-control" value="<?php echo $row["ipk"] ?>" name="ipk" step="0.01" min="1" max="4" required>
                        </div>
                        <div class="form-group">
                            <label for="">Jumlah Saudara</label>
                            <input type="number" class="form-control" value="<?php echo $row["jml_saudara"] ?>" name="saudara" min="0" max="100" required>
                        </div>

                        <input class="btn btn-primary" type="submit" name="update" value="Update">
                        <a class="btn btn-danger" href="?page=pendaftaran">Batal</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
