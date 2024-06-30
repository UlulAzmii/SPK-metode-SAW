<div class="card border-primary shadow">
    <div class="card-header bg-primary text-white">
        <strong>Perangkingan</strong>
    </div>
    <div class="card-body">
        <!-- Form untuk memilih tahun -->
        <form action="" method="POST">
            <div class="form-group">
                <label for="tahun">Tahun</label>
                <select class="form-control chosen" id="tahun" name="tahun" required>
                    <option value="">Pilih Tahun</option>
                    <?php
                    // Generate options for years from current year to 2015
                    for ($x = date("Y"); $x >= 2015; $x--) {
                        $selected = isset($_POST['tahun']) && $_POST['tahun'] == $x ? 'selected' : '';
                        echo "<option value='$x' $selected>$x</option>";
                    }
                    ?>
                </select>
            </div>
            <input class="btn btn-primary mb-2" type="submit" name="proses" value="Proses">
        </form>

        <!-- Tabel untuk menampilkan hasil perangkingan -->
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th width="100px">No.</th>
                        <th width="100px">NIM</th>
                        <th width="200px">Nama Mahasiswa</th>
                        <th width="300px">n_Pendapatan</th>
                        <th width="100px">n_IPK</th>
                        <th width="100px">n_Saudara</th>
                        <th width="100px">Preferensi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_POST['proses'])) {
                        //mengambil data tahun dari input
                        $tahun = $_POST['tahun'];

                        //mengambil data dari tabel pendaftaran  
                        $sql = "SELECT * FROM pendaftaran WHERE tahun = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $tahun);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows > 0) {
                            //mencari nilai max dan min
                            $sql = "SELECT MIN(pendapatan_ortu) AS mpendapatan, MAX(ipk) AS mipk, MAX(jml_saudara) AS msaudara FROM pendaftaran WHERE tahun = ?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("i", $tahun);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $row = $result->fetch_assoc();

                            //mengambil nilai max dan min
                            $mpendapatan = $row["mpendapatan"];
                            $mipk = $row["mipk"];
                            $msaudara = $row["msaudara"];

                            //menghapus data perangkingan yg lama
                            $sql = "DELETE FROM perangkingan WHERE iddaftar IN (SELECT iddaftar FROM pendaftaran WHERE tahun = ?)";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("i", $tahun);
                            $stmt->execute();

                            //proses normalisasi
                            $sql = "SELECT * FROM pendaftaran WHERE tahun = ?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("i", $tahun);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            while ($row = $result->fetch_assoc()) {
                                //mengambil data pendaftaran  
                                $iddaftar = $row["iddaftar"];
                                $pendapatan = $row["pendapatan_ortu"];
                                $ipk = $row["ipk"];
                                $saudara = $row["jml_saudara"];

                                //hitung normalisasi
                                $npendapatan = $mpendapatan / $pendapatan;
                                $nipk = $ipk / $mipk;
                                $nsaudara = $saudara / $msaudara;

                                //menghitung nilai preferensi 
                                $preferensi = ($npendapatan * 0.5) + ($nipk * 0.3) + ($nsaudara * 0.2);

                                //simpan data perangkitan
                                $sql = "INSERT INTO perangkingan (iddaftar, n_pendapatan, n_ipk, n_saudara, preferensi) VALUES (?, ?, ?, ?, ?)";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("idddd", $iddaftar, $npendapatan, $nipk, $nsaudara, $preferensi);
                                $stmt->execute();
                            }

                            // Query untuk menampilkan data perangkingan sesuai tahun yang dipilih
                            $sql = "SELECT perangkingan.idperangkingan, pendaftaran.nim, mahasiswa.nama_mahasiswa, perangkingan.n_pendapatan, perangkingan.n_ipk, perangkingan.n_saudara, perangkingan.preferensi
                                    FROM perangkingan 
                                    INNER JOIN pendaftaran ON perangkingan.iddaftar = pendaftaran.iddaftar 
                                    INNER JOIN mahasiswa ON pendaftaran.nim = mahasiswa.nim 
                                    WHERE pendaftaran.tahun = ?
                                    ORDER BY perangkingan.preferensi DESC";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("i", $tahun);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $i = 1;
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $row['nim']; ?></td>
                                    <td><?php echo $row['nama_mahasiswa']; ?></td>
                                    <td><?php echo $row['n_pendapatan']; ?></td>
                                    <td><?php echo $row['n_ipk']; ?></td>
                                    <td><?php echo $row['n_saudara']; ?></td>
                                    <td><?php echo $row['preferensi']; ?></td>
                                </tr>
                                <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="7" class="text-center">Data tidak ditemukan untuk tahun <?php echo $tahun; ?>.</td>
                            </tr>
                            <?php
                        }
                        $stmt->close();
                    } else {
                        ?>
                        <tr>
                            <td colspan="7" class="text-center">Silakan pilih tahun dan tekan tombol "Proses".</td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
