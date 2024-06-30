<?php

$search = isset($_GET['search']) ? $_GET['search'] : '';
$entries = isset($_GET['entries']) ? (int)$_GET['entries'] : 5; // Mengubah default menjadi 5 entri per halaman
$page = isset($_GET['pageno']) ? (int)$_GET['pageno'] : 1;
$offset = ($page - 1) * $entries;

$sql = "SELECT pendaftaran.iddaftar, pendaftaran.tgldaftar, pendaftaran.tahun, pendaftaran.nim, mahasiswa.nama_mahasiswa, pendaftaran.pendapatan_ortu, pendaftaran.ipk, pendaftaran.jml_saudara FROM mahasiswa INNER JOIN pendaftaran ON mahasiswa.nim = pendaftaran.nim";
if (!empty($search)) {
    $sql .= " WHERE pendaftaran.nim LIKE '%$search%' OR mahasiswa.nama_mahasiswa LIKE '%$search%' OR pendaftaran.tahun LIKE '%$search%' OR pendaftaran.pendapatan_ortu LIKE '%$search%' OR pendaftaran.ipk LIKE '%$search%' OR pendaftaran.jml_saudara LIKE '%$search%'";
}
$sql .= " ORDER BY iddaftar DESC LIMIT $offset, $entries";
$result = $conn->query($sql);

// Get the total number of records for pagination
$count_sql = "SELECT COUNT(*) AS total FROM pendaftaran INNER JOIN mahasiswa ON mahasiswa.nim = pendaftaran.nim";
if (!empty($search)) {
    $count_sql .= " WHERE pendaftaran.nim LIKE '%$search%' OR mahasiswa.nama_mahasiswa LIKE '%$search%' OR pendaftaran.tahun LIKE '%$search%' OR pendaftaran.pendapatan_ortu LIKE '%$search%' OR pendaftaran.ipk LIKE '%$search%' OR pendaftaran.jml_saudara LIKE '%$search%'";
}
$count_result = $conn->query($count_sql);
$total_rows = $count_result->fetch_assoc()['total'];
$total_pages = ceil($total_rows / $entries);

?>


<div class="card border-primary shadow">
    <div class="card-header bg-primary text-white">
        <strong>Data Pendaftaran</strong>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-between mb-2">
            <form class="form-inline" method="get" action="">
                <input type="hidden" name="page" value="pendaftaran">
                <input type="text" name="search" class="form-control mr-sm-2" placeholder="Cari Pendaftaran" value="<?php echo htmlspecialchars($search); ?>">
                <button type="submit" class="btn btn-outline-success">Cari</button>
            </form>
            <div>
                <a class="btn btn-primary" href="?page=pendaftaran&action=tambah">Tambah</a>
            </div>
        </div>
        <form method="get" action="">
            <input type="hidden" name="page" value="pendaftaran">
            <div class="form-group">
                <label for="entries">Show entries:</label>
                <select name="entries" id="entries" class="form-control w-auto d-inline" onchange="this.form.submit()">
                    <option value="5" <?php echo isset($_GET['entries']) && $_GET['entries'] == 5 ? 'selected' : ''; ?>>5</option>
                    <option value="10" <?php echo isset($_GET['entries']) && $_GET['entries'] == 10 ? 'selected' : ''; ?>>10</option>
                    <option value="25" <?php echo isset($_GET['entries']) && $_GET['entries'] == 25 ? 'selected' : ''; ?>>25</option>
                    <option value="50" <?php echo isset($_GET['entries']) && $_GET['entries'] == 50 ? 'selected' : ''; ?>>50</option>
                </select>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th width="10px">No</th>
                        <th width="30px">Tanggal</th>
                        <th width="30px">Tahun</th>
                        <th width="40px">NIM</th>
                        <th width="100px">Nama</th>
                        <th width="80px">Pendapatan</th>
                        <th width="20px">IPK</th>
                        <th width="10px">Saudara</th>
                        <th width="150px"></th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Proses penampilan data -->
                    <?php
                    $i = $offset + 1;
                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $row['tgldaftar']; ?></td>
                            <td><?php echo $row['tahun']; ?></td>
                            <td><?php echo $row['nim']; ?></td>
                            <td><?php echo $row['nama_mahasiswa']; ?></td>
                            <td><?php echo $row['pendapatan_ortu']; ?></td>
                            <td><?php echo $row['ipk']; ?></td>
                            <td><?php echo $row['jml_saudara']; ?></td>
                            <td align="center">
                                <a class="btn btn-warning btn-sm mr-2" href="?page=pendaftaran&action=update&id=<?php echo $row['iddaftar']; ?>">
                                    <span class="far fa-edit"></span> Edit
                                </a>
                                <a onclick="return confirm('Yakin menghapus data ini ?')" class="btn btn-danger btn-sm" href="?page=pendaftaran&action=hapus&id=<?php echo $row['iddaftar']; ?>">
                                    <span class="fas fa-times"></span> Hapus
                                </a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                    <!-- Proses penampilan data end -->
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        <nav>
            <ul class="pagination justify-content-center">
                <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                    <li class="page-item <?php if ($page == $i) echo 'active'; ?>">
                        <a class="page-link" href="?page=pendaftaran&pageno=<?php echo $i; ?>&entries=<?php echo $entries; ?>&search=<?php echo htmlspecialchars($search); ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    </div>
</div>
