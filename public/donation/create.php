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

if (isset($_POST['create'])) {
    if (createDonation($_POST) > 0) {
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
                    <h2>Tambah SPP</h2>
                    <a href="index.php" class="href">Kembali</a>
                </span>
            </td>
        </tr>
        <tr>
            <td><label class="text-bold" for="tahun">Tahun</label></td>
            <td><input type="number" name="tahun" class="input-form" id="tahun" placeholder="Masukkan tahun!" autocomplete="off" autofocus required></td>
        </tr>
        <tr>
            <td><label class="text-bold" for="nominal">Nominal</label></td>
            <td><input type="number" name="nominal" class="input-form" id="nominal" placeholder="Masukkan nominal!" autocomplete="off" required></td>
        </tr>
        <tr>
            <td colspan="2" class="center"><button type="submit" name="create" class="button green">Tambah</button></td>
        </tr>
    </table>
</form>

<?php include_once('../layout/footer.php'); ?>