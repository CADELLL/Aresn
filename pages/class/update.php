<?php
include_once('../layout/navbar.php');
include_once('../layout/sidebar.php');

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

// get & check value
$id = $_GET['i'] == '' ? header('Location: index.php') : $_GET['i'];

$kelas = query("SELECT * FROM kelas WHERE id = $id")[0];

$jurusan = departement();

if (isset($_POST['update'])) {
    if (updateClass($_POST) > 0) {
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
?>

<form action="" method="POST">
    <input type="hidden" name="id" value="<?= $id; ?>">
    <table class="table">
        <tr>
            <td colspan="2">
                <span id="action">
                    <h2>Ubah Kelas</h2>
                    <a href="index.php" class="href">Kembali</a>
                </span>
            </td>
        </tr>
        <tr>
            <td><label class="text-bold" for="kelas">Nama kelas</label></td>
            <td><input type="text" name="kelas" class="input-form" id="kelas" placeholder="Masukkan nama kelas!" value="<?= $kelas['kelas']; ?>" autocomplete="off" autofocus required></td>
        </tr>
        <tr>
            <td><label class="text-bold" for="kompetensi_keahlian">Kompetensi keahlian</label></td>
            <td>
                <select name="kompetensi_keahlian" id="kompetensi_keahlian" class="input-form">
                    <option value="<?= $kelas['kompetensi_keahlian'] ?>"><?= $kelas['kompetensi_keahlian'] ?></option>
                    <?php for ($i = 0; $i < count($jurusan); $i++) : ?>
                        <?php if ($jurusan[$i] != $kelas['kompetensi_keahlian']) : ?>
                            <option value="<?= $jurusan[$i] ?>"><?= $jurusan[$i] ?></option>
                        <?php endif; ?>
                    <?php endfor; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="center"><button type="submit" name="update" class="button yellow">Ubah</button></td>
        </tr>
    </table>
</form>

<?php include_once('../layout/footer.php'); ?>