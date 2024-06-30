<div class="card">
    <div class="card-header bg-primary text-white border-dark">
        <strong>Laporan Perangkingan</strong>
    </div>
    <div class="card-body">
        <form action="preview.php" method="POST" target="_blank">
            <div class="form-group">
                <label for="tahun">Tahun</label>
                <select class="form-control chosen" id="tahun" name="tahun" required>
                    <option value="">Pilih Tahun</option>
                    <?php
                    // Generate options for years from current year to 2015
                    for ($x = date("Y"); $x >= 2015; $x--) {
                        echo "<option value='$x'>$x</option>";
                    }
                    ?>
                </select>
            </div>
            <input class="btn btn-primary mb-2" type="submit" name="cetak" value="Cetak">
        </form>
    </div>
</div>
