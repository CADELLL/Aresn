<?php
include_once('../layouts/navbar.php');
include_once('../layouts/sidebar.php');

// check level
if (isset($_SESSION["payment"])) {
    echo "
		<script>
            alert('Tidak dapat mengakses fitur ini!');
            window.history.back();
		</script>
		";
    exit;
}

// get value
$nisn = htmlspecialchars($_POST['nisn']);

$no = 1;
$total = 0;
$spp = 0;
$totalBayar = 0;
$pembayaran = query("SELECT * FROM pembayaran
                    JOIN pengguna ON pengguna.id = pembayaran.id_petugas 
                    JOIN spp ON spp.id = pembayaran.id_spp
                    WHERE pembayaran.nisn = $nisn");

foreach ($pembayaran as $p) {
    $spp += $p['nominal'];
}

foreach ($pembayaran as $p) {
    $totalBayar += $p['jumlah_bayar'];
}

$total += $spp * count($pembayaran);
?>

<table class="table">
    <tr>
        <td colspan="8">
            <span id="action">
                <h2>Detail Pembayaran</h2>
                <span>
                    <a href="index.php" class="badge grey">Kembali</a>
                    <a href="pdf.php?n=<?= $nisn ?>" class="badge green">File PDF</a>
                </span>
            </span>
        </td>
    </tr>
    <tr>
        <th>No</th>
        <th>Petugas</th>
        <th>Tanggal</th>
        <th>Bulan</th>
        <th>Tahun</th>
        <th>SPP</th>
        <th>Jumlah bayar</th>
        <th>Uang kembali</th>
    </tr>
    <?php foreach ($pembayaran as $p) : ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $p['nama']; ?></td>
            <td><?= $p['tanggal_bayar']; ?></td>
            <td><?= $p['bulan_dibayar']; ?></td>
            <td><?= $p['tahun_dibayar']; ?></td>
            <td>Tahun <?= $p['tahun'] ?><br>Rp. <?= rupiah($p['nominal']) ?></td>
            <td>Rp. <?= rupiah($p['jumlah_bayar']); ?></td>
            <td>Rp. <?= rupiah($p['jumlah_bayar'] - $p['nominal']); ?></td>
        </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="3">Total belum dibayar</td>
        <td colspan="2">
            <p class="text-bold text-red">Rp. <?= rupiah($total); ?></p>
        </td>
        <td>Total bayar</td>
        <td colspan="2">
            <p class="text-bold text-green">Rp. <?= rupiah($totalBayar); ?></p>
        </td>
    </tr>
    <?php if ($pembayaran == []) : ?>
        <div class="info info-red">NISN tidak terdaftar!</div>
    <?php endif; ?>
</table>

<?php include_once('../layouts/footer.php'); ?>