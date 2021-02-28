<?php
include_once('../layouts/navbar.php');

// get & check value
$id = $_GET['i'] == '' ? header('Location: index.php') : $_GET['i'];

$kelas = query("SELECT * FROM kelas WHERE id = $id")[0];

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

include_once('../layouts/sidebar.php');
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
            <td><label for="kelas">Nama kelas</label></td>
            <td><input type="text" name="kelas" class="input-form" id="kelas" placeholder="Masukkan nama kelas!" value="<?= $kelas['kelas']; ?>" autocomplete="off" autofocus required></td>
        </tr>
        <tr>
            <td><label for="kompetensi_keahlian">Kompetensi keahlian</label></td>
            <td>
                <select name="kompetensi_keahlian" id="kompetensi_keahlian" class="input-form">
                    <option value="<?= $kelas['kompetensi_keahlian'] ?>"><?= $kelas['kompetensi_keahlian'] ?></option>
                    <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option>
                    <option value="Teknik Komputer dan Jaringan">Teknik Komputer dan Jaringan</option>
                    <option value="Teknik Industri">Teknik Industri</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="center"><button type="submit" name="update" class="button yellow">Ubah</button></td>
        </tr>
    </table>
</form>

<?php include_once('../layouts/footer.php'); ?>