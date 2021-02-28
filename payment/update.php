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

$id = $_GET['i'] == '' ? header('Location: index.php') : $_GET['i'];

$bulan = month();
$spp = query('SELECT * FROM spp');
$pembayaran = query("SELECT *, 
                    pembayaran.id AS id_pembayaran FROM pembayaran 
                    JOIN spp ON spp.id = pembayaran.id_spp
                    WHERE pembayaran.id = $id")[0];

if (isset($_POST['update'])) {
    if (updatePayment($_POST) > 0) {
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

<form accept="" method="POST">
    <input type="hidden" name="id_pembayaran" value="<?= $pembayaran['id_pembayaran'] ?>">
    <input type="hidden" name="nisn_lama" value="<?= $pembayaran['nisn'] ?>">
    <input type="hidden" name="bulan_lama" value="<?= $pembayaran['bulan_dibayar']; ?>">
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
            <td><label for="nisn">NISN</label></td>
            <td><input type="text" name="nisn" class="input-form" id="nisn" placeholder="Masukkan NISN!" autocomplete="off" value="<?= $pembayaran['nisn'] ?>" required autofocus></td>
        </tr>
        <tr>
            <td><label for="bulan_dibayar">Bulan dibayar</label></td>
            <td>
                <select name="bulan_dibayar" id="bulan_dibayar" class="input-form">
                    <option value="<?= $pembayaran['bulan_dibayar'] ?>"><?= $pembayaran['bulan_dibayar'] ?></option>
                    <?php for ($i = 0; $i < count($bulan); $i++) : ?>
                        <option value="<?= $bulan[$i][0] ?>"><?= $bulan[$i][0] ?></option>
                    <?php endfor ?>
                </select>
            </td>
        </tr>
        <tr>
            <td><label for="tahun_dibayar">Tahun dibayar</label></td>
            <td><input type="number" name="tahun_dibayar" class="input-form" id="tahun_dibayar" placeholder="Masukkan tahun dibayar!" autocomplete="off" value="<?= $pembayaran['tahun_dibayar'] ?>" required autofocus></td>
        </tr>
        <tr>
            <td><label for="jumlah_bayar">Jumlah bayar</label></td>
            <td><input type="number" name="jumlah_bayar" class="input-form" id="jumlah_bayar" placeholder="Masukkan jumlah bayar!" autocomplete="off" value="<?= $pembayaran['jumlah_bayar']; ?>" required></td>
        </tr>
        <tr>
            <td colspan="2" class="center"><button type="submit" name="update" class="button yellow">Update</button></td>
        </tr>
    </table>
</form>

<?php include_once('../layouts/footer.php'); ?>