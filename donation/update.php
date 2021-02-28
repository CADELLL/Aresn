<?php
include_once('../layouts/navbar.php');

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

$spp = query("SELECT * FROM spp WHERE id = $id")[0];

if (isset($_POST['update'])) {
    if (updateSpp($_POST) > 0) {
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
                    <h2>Ubah SPP</h2>
                    <a href="index.php" class="href">Kembali</a>
                </span>
            </td>
        </tr>
        <tr>
            <td><label for="tahun">Tahun</label></td>
            <td><input type="number" name="tahun" class="input-form" id="tahun" placeholder="Masukkan tahun!" autocomplete="off" value="<?= $spp['tahun']; ?>" autofocus required></td>
        </tr>
        <tr>
            <td><label for="nominal">Nominal</label></td>
            <td><input type="number" name="nominal" class="input-form" id="nominal" placeholder="Masukkan nominal!" value="<?= $spp['nominal']; ?>" autocomplete="off" required></td>
        </tr>
        <td colspan="2" class="center"><button type="submit" name="update" class="button yellow">Ubah</button></td>
        </tr>
    </table>
</form>

<?php include_once('../layouts/footer.php'); ?>