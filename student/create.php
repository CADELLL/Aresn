<?php
include_once('../layouts/navbar.php');
include_once('../layouts/sidebar.php');

// check level
if (!isset($_SESSION["admin"])) {
    echo "
		<script>
            alert('Tidak dapat mengakses fitur ini!');
            window.history.back();
		</script>
		";
    exit;
}

$kelas = query("SELECT * FROM kelas");
$spp = query("SELECT * FROM spp");

if (isset($_POST['create'])) {
    if (createStudent($_POST) > 0) {
        echo "
        <script>
    		alert('Data berhasil ditambahkan!');
    		document.location.href = 'index.php';
    	</script>
        ";
    } else {
        echo "
        <script>
    		alert('Data gagal ditambahkan!');
    		document.location.href = 'index.php';
    	</script>
        ";
    }
}
?>

<form action="" method="POST">
    <table class="table">
        <tr>
            <td colspan="2">
                <span id="action">
                    <h2>Tambah Siswa</h2>
                    <a href="index.php" class="href">Kembali</a>
                </span>
            </td>
        </tr>
        <tr>
            <td><label class="text-bold" for="nisn">NISN (+00)</label></td>
            <td><input type="number" name="nisn" class="input-form" id="nisn" placeholder="Masukkan NISN!" autocomplete="off" autofocus required></td>
        </tr>
        <tr>
            <td><label class="text-bold" for="nis">NIS</label></td>
            <td><input type="number" name="nis" class="input-form" id="nis" placeholder="Masukkan NIS!" autocomplete="off" required></td>
        </tr>
        <tr>
            <td><label class="text-bold" for="nama">Nama</label></td>
            <td><input type="text" name="nama" class="input-form" id="nama" placeholder="Masukkan nama!" maxlength="35" autocomplete="off" required></td>
        </tr>
        <tr>
            <td><label class="text-bold" for="id_kelas">Kelas</label></td>
            <td>
                <select name="id_kelas" id="id_kelas" class="input-form">
                    <?php foreach ($kelas as $k) : ?>
                        <option value="<?= $k['id'] ?>"><?= $k['kelas'] ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td><label class="text-bold" for="alamat">Alamat</label></td>
            <td>
                <input type="text" name="alamat" class="input-form" id="alamat" placeholder="Masukkan alamat!" autocomplete="off" required>
            </td>
        </tr>
        <tr>
            <td><label class="text-bold" for="no_telepon">No telepon (+62)</label></td>
            <td><input type="number" name="no_telepon" class="input-form" id="no_telepon" placeholder="Masukkan no telepon!" autocomplete="off" required></td>
        </tr>
        <tr>
            <td><label class="text-bold" for="id_spp">SPP</label></td>
            <td>
                <select name="id_spp" id="id_spp" class="input-form">
                    <?php foreach ($spp as $s) : ?>
                        <option value="<?= $s['id'] ?>">Tahun <?= $s['tahun'] ?> - Rp. <?= number_format($s['nominal'], 2, ',', '.') ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="center"><button type="submit" name="create" class="button green">Tambah</button></td>
        </tr>
    </table>
</form>

<?php include_once('../layouts/footer.php'); ?>