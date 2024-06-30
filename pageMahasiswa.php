<div class="card border-primary shadow">
    <div class="card-header bg-primary text-white">
        <strong>Data Mahasiswa</strong>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-between mb-2">
            <form class="form-inline" method="get" action="">
                <input type="hidden" name="page" value="mahasiswa">
                <input type="text" name="search" class="form-control mr-sm-2" placeholder="Cari Mahasiswa" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                <button type="submit" class="btn btn-outline-success">Cari</button>
            </form>
            <div>
                <a class="btn btn-primary" href="?page=mahasiswa&action=tambah">Tambah</a>
            </div>
        </div>
        <form method="get" action="">
            <input type="hidden" name="page" value="mahasiswa">
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
                        <th width="100px">NIM</th>
                        <th width="200px">Nama Mahasiswa</th>
                        <th width="100px">Alamat</th>
                        <th width="100px">No. Telpon</th>
                        <th width="120px"></th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Proses penampilan data -->
                    <?php
                    $search = isset($_GET['search']) ? $_GET['search'] : '';
                    $entries = isset($_GET['entries']) ? (int)$_GET['entries'] : 5; // Menampilkan 5 entri per halaman
                    $page = isset($_GET['pageno']) ? (int)$_GET['pageno'] : 1;
                    $offset = ($page - 1) * $entries;

                    $sql = "SELECT * FROM mahasiswa";
                    if (!empty($search)) {
                        $sql .= " WHERE nim LIKE '%$search%' OR nama_mahasiswa LIKE '%$search%' OR alamat LIKE '%$search%' OR telp LIKE '%$search%'";
                    }
                    $sql .= " ORDER BY nim ASC LIMIT $offset, $entries";
                    $result = $conn->query($sql);

                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?php echo $row['nim']; ?></td>
                            <td><?php echo $row['nama_mahasiswa']; ?></td>
                            <td><?php echo $row['alamat']; ?></td>
                            <td><?php echo $row['telp']; ?></td>
                            <td align="center">
                                <a class="btn btn-warning btn-sm mr-2" href="?page=mahasiswa&action=update&nim=<?php echo $row['nim']; ?>">
                                    <span class="far fa-edit"></span> Edit
                                </a>
                                <a onclick="return confirm('Yakin menghapus data ini ?')" class="btn btn-danger btn-sm" href="?page=mahasiswa&action=hapus&nim=<?php echo $row['nim']; ?>">
                                    <span class="fas fa-times"></span> Hapus
                                </a>
                            </td>
                        </tr>
                    <?php
                    }

                    // Get the total number of records for pagination
                    $count_sql = "SELECT COUNT(*) AS total FROM mahasiswa";
                    if (!empty($search)) {
                        $count_sql .= " WHERE nim LIKE '%$search%' OR nama_mahasiswa LIKE '%$search%' OR alamat LIKE '%$search%' OR telp LIKE '%$search%'";
                    }
                    $count_result = $conn->query($count_sql);
                    $total_rows = $count_result->fetch_assoc()['total'];
                    $total_pages = ceil($total_rows / $entries);

                    $conn->close();
                    ?>
                    <!-- Proses penampilan data end -->
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        <nav>
            <ul class="pagination justify-content-center">
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php if ($page == $i) echo 'active'; ?>">
                        <a class="page-link" href="?page=mahasiswa&pageno=<?php echo $i; ?>&entries=<?php echo $entries; ?>&search=<?php echo $search; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    </div>
</div>
