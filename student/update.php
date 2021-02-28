<?php
include_once('../layouts/navbar.php');

if (isset($_SESSION['tingkat']) != 'admin') {
    echo "
		<script>
            alert('Tidak dapat mengakses fitur ini!');
            window.history.back();
		</script>
		";
    exit;
}

// get & check value
$nisn = $_GET['n'] == '' ? header('Location: index.php') : $_GET['n'];

$siswa = query("SELECT * FROM siswa 
                JOIN kelas ON siswa.id_kelas = kelas.id 
                JOIN spp ON siswa.id_spp = spp.id 
                WHERE siswa.nisn = $nisn")[0];

$kelas = query("SELECT * FROM kelas");
$spp = query("SELECT * FROM spp");

if (isset($_POST['update'])) {
    if (updateStudent($_POST) > 0) {
        echo "
        <script>
    		alert('Data berhasil diubah!');
    		document.location.href = 'index.php';
    	</script>
        ";
    } else {
        echo "
        <script>
    		alert('Data tidak diubah!');
    		document.location.href = 'index.php';
    	</script>
        ";
    }
}

include_once('../layouts/sidebar.php');
?>

<form action="" method="POST">
    <input type="hidden" name="nisLama" value="<?= $siswa['nis'] ?>">
    <input type="hidden" name="nisnLama" value="<?= $siswa['nisn'] ?>">
    <table class="table">
        <tr>
            <td colspan="2">
                <span id="action">
                    <h2>Ubah Siswa</h2>
                    <a href="index.php" class="href">Kembali</a>
                </span>
            </td>
        </tr>
        <tr>
            <td><label for="nisn">NISN (+00)</label></td>
            <td><input type="number" name="nisn" class="input-form" id="nisn" placeholder="Masukkan NISN!" value="<?= $siswa['nisn']; ?>" minlength="10" autocomplete="off" autofocus required></td>
        </tr>
        <tr>
            <td><label for="nis">NIS</label></td>
            <td><input type="number" name="nis" class="input-form" id="nis" placeholder="Masukkan NIS!" value="<?= $siswa['nis']; ?>" minlength="8" autocomplete="off" required></td>
        </tr>
        <tr>
            <td><label for="nama">Nama</label></td>
            <td><input type="text" name="nama" class="input-form" id="nama" placeholder="Masukkan nama!" value="<?= $siswa['nama']; ?>" maxlength="35" autocomplete="off" required></td>
        </tr>
        <tr>
            <td><label for="id_kelas">Kelas</label></td>
            <td>
                <select name="id_kelas" id="id_kelas" class="input-form">
                    <option value="<?= $siswa['id_kelas'] ?>"><?= $siswa['kelas'] ?></option>
                    <?php foreach ($kelas as $k) : ?>
                        <?php if ($k['id'] != $siswa['id_kelas']) : ?>
                            <option value="<?= $k['id'] ?>"><?= $k['kelas'] ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td><label for="alamat">Alamat</label></td>
            <td>
                <input type="text" name="alamat" class="input-form" id="alamat" placeholder="Masukkan alamat!" value="<?= $siswa['alamat']; ?>" autocomplete="off" required>
            </td>
        </tr>
        <tr>
            <td><label for="no_telepon">No telepon (+62)</label></td>
            <td><input type="number" name="no_telepon" class="input-form" id="no_telepon" minlength="12" placeholder="Masukkan no telepon!" value="<?= $siswa['no_telepon']; ?>" autocomplete="off" required></td>
        </tr>
        <tr>
            <td><label for="id_spp">SPP</label></td>
            <td>
                <select name="id_spp" id="id_spp" class="input-form">
                    <option value="<?= $siswa['id_spp'] ?>">Tahun <?= $siswa['tahun'] ?> - Rp. <?= number_format($siswa['nominal'], 2, ',', '.') ?></option>
                    <?php foreach ($spp as $s) : ?>
                        <?php if ($s['id'] != $siswa['id_spp']) : ?>
                            <option value="<?= $s['id'] ?>">Tahun <?= $s['tahun'] ?> - Rp. <?= number_format($s['nominal'], 2, ',', '.') ?></option>
                        <?php endif ?>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="center"><button type="submit" name="update" class="button yellow">Ubah</button></td>
        </tr>
    </table>
</form>

<?php include_once('../layouts/footer.php'); ?>