<?php
include_once('../layouts/navbar.php');
include_once('../layouts/sidebar.php');

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

$bulan = month();

if (isset($_POST['create'])) {
    if (createPayment($_POST) > 0) {
        echo "
            <script>
                alert('Data berhasil ditambahkan!');
                document.location.href = 'index.php';
            </script>
            ";
    }
}
?>

<form accept="" method="POST">
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
            <td><label class="text-bold" for="nisn">NISN (+00)</label></td>
            <td><input type="text" name="nisn" class="input-form" id="nisn" placeholder="Masukkan NISN!" autocomplete="off" required autofocus></td>
        </tr>
        <tr>
            <td><label class="text-bold" for="bulan_dibayar">Bulan dibayar</label></td>
            <td>
                <select name="bulan_dibayar" id="bulan_dibayar" class="input-form">
                    <?php for ($i = 0; $i < count($bulan); $i++) : ?>
                        <option value="<?= $bulan[$i] ?>"><?= $bulan[$i] ?></option>
                    <?php endfor ?>
                </select>
            </td>
        </tr>
        <!-- <tr>
            <td><label class="text-bold" for="tahun_dibayar">Tahun dibayar</label></td>
            <td><input type="number" name="tahun_dibayar" class="input-form" id="tahun_dibayar" placeholder="Masukkan tahun dibayar!" autocomplete="off" required autofocus></td>
        </tr> -->
        <tr>
            <td><label class="text-bold" for="jumlah_bayar">Jumlah bayar</label></td>
            <td><input type="number" name="jumlah_bayar" class="input-form" id="jumlah_bayar" placeholder="Masukkan jumlah bayar!" autocomplete="off" required></td>
        </tr>
        <tr>
            <td colspan="2" class="center"><button type="submit" name="create" class="button green">Tambah</button></td>
        </tr>
    </table>
</form>

<?php include_once('../layouts/footer.php'); ?>