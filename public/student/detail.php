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

$nisn = $_GET['n'] == '' ? header('Location: index.php') : $_GET['n'];

$siswa = query("SELECT * FROM siswa
                JOIN kelas ON siswa.id_kelas = kelas.id
                JOIN spp ON siswa.id_spp = spp.id
                WHERE nisn = $nisn")[0];

$pembayaran = query("SELECT * FROM pembayaran WHERE pembayaran.nisn = $nisn");

$bulan = month();

$bulanBayar = [];
foreach ($pembayaran as $p) {
    $bulanBayar[] = $p['bulan_dibayar'];
}

$minus = 12 - count($pembayaran);
for ($i = 0; $i < $minus; $i++) {
    $bulanBayar[] = '';
}
$no = 1;
?>

<table class="table">
    <tr>
        <td colspan="2">
            <span id="action">
                <h2>Detail Siswa</h2>
                <a href="index.php" class="badge grey">Kembali</a>
            </span>
        </td>
    </tr>
    <tr>
        <td class="text-bold">NISN (+00)</td>
        <td><?= $siswa['nisn']; ?></td>
    </tr>
    <tr>
        <td class="text-bold">NIS</td>
        <td><?= $siswa['nis']; ?></td>
    </tr>
    <tr>
        <td class="text-bold">Nama</td>
        <td><?= $siswa['nama']; ?></td>
    </tr>
    <tr>
        <td class="text-bold">Kelas</td>
        <td><?= $siswa['kelas']; ?></td>
    </tr>
    <tr>
        <td class="text-bold">Alamat</td>
        <td><?= $siswa['alamat']; ?></td>
    </tr>
    <tr>
        <td class="text-bold">No telepon (+62)</td>
        <td><?= $siswa['no_telepon']; ?></td>
    </tr>
    <tr>
        <td class="text-bold">SPP</td>
        <td>Tahun <?= $siswa['tahun']; ?> - Nominal Rp. <?= rupiah($siswa['nominal']); ?></td>
    </tr>
</table>
<br>
<table class="table">
    <tr>
        <td colspan="8">
            <span id="action">
                <h2>Daftar SPP</h2>
                <span>
                    <a href="pdf_spp.php?n=<?= $nisn ?>" class="badge green">Unduh</a>
                </span>
            </span>
        </td>
    </tr>
    <tr>
        <th>No</th>
        <th>Bulan</th>
        <th>Status</th>
    </tr>
    <?php for ($i = 0; $i < $minus; $i++) : ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $bulan[$i]; ?></td>
            <td>
                <?php switch ($bulan[$i]) {
                    case $bulan[$i] == $bulanBayar[0]:
                        echo "<div class='badge green'>Lunas<div>";
                        break;
                    case $bulan[$i] == $bulanBayar[1]:
                        echo "<div class='badge green'>Lunas<div>";
                        break;
                    case $bulan[$i] == $bulanBayar[2]:
                        echo "<div class='badge green'>Lunas<div>";
                        break;
                    case $bulan[$i] == $bulanBayar[3]:
                        echo "<div class='badge green'>Lunas<div>";
                        break;
                    case $bulan[$i] == $bulanBayar[4]:
                        echo "<div class='badge green'>Lunas<div>";
                        break;
                    case $bulan[$i] == $bulanBayar[5]:
                        echo "<div class='badge green'>Lunas<div>";
                        break;
                    case $bulan[$i] == $bulanBayar[6]:
                        echo "<div class='badge green'>Lunas<div>";
                        break;
                    case $bulan[$i] == $bulanBayar[7]:
                        echo "<div class='badge green'>Lunas<div>";
                        break;
                    case $bulan[$i] == $bulanBayar[8]:
                        echo "<div class='badge green'>Lunas<div>";
                        break;
                    case $bulan[$i] == $bulanBayar[9]:
                        echo "<div class='badge green'>Lunas<div>";
                        break;
                    case $bulan[$i] == $bulanBayar[10]:
                        echo "<div class='badge green'>Lunas<div>";
                        break;
                    case $bulan[$i] == $bulanBayar[11]:
                        echo "<div class='badge green'>Lunas<div>";
                        break;
                    default:
                        echo "<div class='badge red'>Tidak lunas<div>";
                        break;
                }
                ?>
            </td>
        </tr>
    <?php endfor; ?>
</table>

<?php include_once('../layout/footer.php'); ?>