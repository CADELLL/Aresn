<?php
include_once('../layout/navbar.php');
include_once('../layout/sidebar.php');

// check payment
if (!isset($_SESSION["officer"])) {
    echo "
		<script>
            alert('Tidak dapat mengakses fitur ini!');
            window.history.back();
		</script>
		";
    exit;
}

$nisn = $_POST['nisn'] == '' ? header('Location: index.php') : htmlspecialchars($_POST['nisn']);
$bulan_dibayar = $_POST['bulan_dibayar'] == '' ? header('Location: index.php') : htmlspecialchars($_POST['bulan_dibayar']);

$bulan = month();
$siswa = query("SELECT * FROM siswa JOIN spp ON siswa.id_spp = spp.id WHERE nisn = '$nisn'")[0];

if (isset($_POST['create'])) {
    if (createPayment($_POST) > 0) {
        echo "
            <script>
                alert('Data berhasil ditambahkan!');
                document.location.href = 'student.php?nisn=$nisn';
            </script>
            ";
    }
}
?>

<form accept="" method="POST">
    <input type="hidden" name="nisn" value="<?= $nisn; ?>">
    <input type="hidden" name="bulan_dibayar" value="<?= $bulan_dibayar; ?>">
    <table class="table">
        <tr>
            <td colspan="2">
                <span id="action">
                    <h2>Tambah Pembayaran</h2>
                    <a href="index.php" class="badge grey">Kembali</a>
                </span>
            </td>
        </tr>
        <tr>
            <td><label class="text-bold">Nama siswa</label></td>
            <td><input type="text" class="input-form" value="<?= $siswa['nama']; ?>" disabled></td>
        </tr>
        <tr>
            <td><label class="text-bold" for="jumlah_bayar">Jumlah bayar</label></td>
            <td><input type="number" name="jumlah_bayar" class="input-form" id="jumlah_bayar" placeholder="Masukkan jumlah bayar minimum <?= rupiah($siswa['nominal']) ?>!" autocomplete="off" required></td>
        </tr>
        <tr>
            <td colspan="2" class="center"><button type="submit" name="create" class="button green">Tambah</button></td>
        </tr>
    </table>
</form>

<?php include_once('../layout/footer.php'); ?>