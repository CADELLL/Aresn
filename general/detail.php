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
$nisn = $_POST['nisn'] == '' ? header('Location: index.php') : htmlspecialchars($_POST['nisn']);

$no = 1;
$spp = 0;
$totalBayar = 0;
$totalKembali = 0;
$totalTidakBayar = 0;
$bulan = month();
$bulanDiBayar = [];

$pembayaran = query("SELECT * FROM pembayaran
                    JOIN pengguna ON pengguna.id = pembayaran.id_petugas 
                    JOIN spp ON spp.id = pembayaran.id_spp
                    WHERE pembayaran.nisn = $nisn");

if ($pembayaran == []) {
    echo "
        <script>
            alert('NISN tidak terdaftar!');
            window.history.back();
        </script>
        ";
    exit;
}

$siswa = query("SELECT * FROM siswa
        JOIN kelas ON kelas.id = siswa.id_kelas
        JOIN spp ON spp.id = siswa.id_spp
        WHERE siswa.nisn = $nisn")[0];

$totalPembayaran = count($pembayaran);

foreach ($pembayaran as $p) {
    $spp += $p['nominal'];
    $totalBayar += $p['jumlah_bayar'];
    $bulanDiBayar[] = $p['bulan_dibayar'];
    $totalKembali += $p['jumlah_bayar'] - $p['nominal'];
}

$totalTidakBayar += $spp * $totalPembayaran;
?>
<h2>
    SMKN 1 Kepanjen<br>
    Struktur Pembayaran
</h2>
<hr>
<p>
    NISN: 00<?= $siswa['nisn'] ?><br>
    Nama: <?= $siswa['nama'] ?><br>
    Kelas: <?= $siswa['kelas'] ?><br>
    SPP: Tahun <?= $siswa['tahun'] ?> - Rp. <?= rupiah($p['nominal']) ?>
</p>
<br><br>
<table class="table">
    <tr>
        <td colspan="8">
            <span id="action">
                <h3>Detail Pembayaran</h3>
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
            <td>Rp. <?= rupiah($p['jumlah_bayar']); ?></td>
            <td>Rp. <?= rupiah($p['jumlah_bayar'] - $p['nominal']); ?></td>
        </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="2">Total belum dibayar</td>
        <td colspan="2">
            <p class="text-bold text-red">Rp. <?= rupiah($totalTidakBayar); ?></p>
        </td>
        <td>Total</td>
        <td>
            <p class="text-bold text-green">Rp. <?= rupiah($totalBayar); ?></p>
        </td>
        <td>
            <p class="text-bold">Rp. <?= rupiah($totalKembali); ?></p>
        </td>
    </tr>
</table>

<?php include_once('../layouts/footer.php'); ?>