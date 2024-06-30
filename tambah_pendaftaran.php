<?php

if(isset($_POST['simpan'])){

    $tgl = date("Y-m-d");
    $tahun = $_POST['tahun'];
    $nama = $_POST['nama'];
    $pendapatan = $_POST['pendapatan'];
    $ipk = $_POST['ipk'];
    $saudara = $_POST['saudara'];
    
    // validasi
    $sql = "SELECT * FROM pendaftaran WHERE tahun='$tahun' AND nim='$nama'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Data sudah digunakan</strong>
        </div>
        <?php
    } else {
        // proses simpan
        $sql = "INSERT INTO pendaftaran VALUES (Null, '$tgl','$tahun','$nama','$pendapatan','$ipk','$saudara')";
        if ($conn->query($sql) === TRUE) {
            header("Location:?page=pendaftaran");
        }
    }
}
?>

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                    <div class="card-header bg-primary text-white border-dark">
                        <strong>INPUT DATA PENDAFTARAN</strong>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Tahun</label>
                            <select class="form-control chosen" data-placeholder="Pilih Tahun" name="tahun">
                                <option value=""></option>
                                <?php
                                for($x = date("Y"); $x >= 2015; $x--) {
                                    echo "<option value='$x'>$x</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Mahasiswa</label>
                            <select class="form-control chosen" data-placeholder="Pilih Mahasiswa" name="nama">
                                <option value=""></option>
                                <?php
                                $sql = "SELECT * FROM mahasiswa ORDER BY nama_mahasiswa ASC";
                                $result = $conn->query($sql);
                                while($row = $result->fetch_assoc()) {
                                    echo "<option value='".$row['nim']."'>".$row['nim']." - ".$row['nama_mahasiswa']."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Pendapatan Orang Tua</label>
                            <input type="number" class="form-control" name="pendapatan" min="0" max="9999999999" required>
                        </div>
                        <div class="form-group">
                            <label for="">IPK Terakhir</label>
                            <input type="number" class="form-control" name="ipk" value="0.00" step="0.01" min="1" max="4" required>
                        </div>
                        <div class="form-group">
                            <label for="">Jumlah Saudara</label>
                            <input type="number" class="form-control" name="saudara" min="0" max="100" required>
                        </div>
                        <input class="btn btn-primary" type="submit" name="simpan" value="Simpan">
                        <a class="btn btn-danger" href="?page=pendaftaran">Batal</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
