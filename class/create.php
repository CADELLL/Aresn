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

$jurusan = departement();

if (isset($_POST['create'])) {
    if (createClass($_POST) > 0) {
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
                    <h2>Tambah Kelas</h2>
                    <a href="index.php" class="href">Kembali</a>
                </span>
            </td>
        </tr>
        <tr>
            <td><label class="text-bold" for="kelas">Nama kelas</label></td>
            <td><input type="text" name="kelas" class="input-form" id="kelas" placeholder="Masukkan nama kelas!" autocomplete="off" required></td>
        </tr>
        <tr>
            <td><label class="text-bold" for="kompetensi_keahlian">Kompetensi keahlian</label></td>
            <td>
                <select name="kompetensi_keahlian" id="kompetensi_keahlian" class="input-form">
                    <?php for ($i = 0; $i < count($jurusan); $i++) : ?>
                        <option value="<?= $jurusan[$i] ?>"><?= $jurusan[$i] ?></option>
                    <?php endfor; ?>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="center"><button type="submit" name="create" class="button green">Tambah</button></td>
        </tr>
    </table>
</form>

<?php include_once('../layouts/footer.php'); ?>