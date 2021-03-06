<?php
include_once('../layout/navbar.php');
include_once('../layout/sidebar.php');

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
$nisn = $_POST['nisn'] == '' ? header('Location: index.php') : $_POST['nisn'];

// check no nisn
$strNisn = strlen((string)$nisn);
if ($strNisn < 10) {
    echo "
          <script>
              alert('NISN minimum 10 karakter');
              window.history.back();
          </script>
          ";
    return false;
}

$siswa = query("SELECT * FROM siswa WHERE siswa.nisn = $nisn");

// check siswa
if ($siswa == []) {
    echo "
        <script>
            alert('NISN tidak terdaftar!');
            window.history.back();
        </script>
        ";
    exit;
}

// deklarasi
$no = 1;
// get month data
$bulan = month();
$pembayaran = query("SELECT * FROM pembayaran WHERE pembayaran.nisn = $nisn");

// add month to bulanbayar
$bulanBayar = [];
foreach ($pembayaran as $p) {
    $bulanBayar[] = $p['bulan_dibayar'] ?? '';
}

// add minus month to bulanbayar 
$minus = 12 - count($pembayaran);
for ($i = 0; $i < $minus; $i++) {
    $bulanBayar[] = '';
}

// get data
$siswa = query("SELECT * FROM siswa
        JOIN kelas ON kelas.id = siswa.id_kelas
        JOIN spp ON spp.id = siswa.id_spp
        WHERE siswa.nisn = $nisn")[0];

// totalpembayaran
$totalPembayaran = count($pembayaran);
?>

<h2>
    SMKN 1 Kepanjen<br>
    Struktur SPP
</h2>
<hr>
<p>
    NISN : <?= $siswa['nisn'] ?><br>
    Nama : <?= $siswa['nama'] ?><br>
    Kelas : <?= $siswa['kelas'] ?><br>
    SPP : Tahun <?= $siswa['tahun'] ?> - Nominal Rp. <?= rupiah($siswa['nominal']) ?>
</p>
<br><br>
<table class="table">
    <tr>
        <td colspan="8">
            <span id="action">
                <h3>Daftar SPP</h3>
                <span>
                    <a href="index.php" class="badge grey">Kembali</a>
                    <a href="pdf.php?n=<?= $nisn ?>" class="badge green">Unduh</a>
                </span>
            </span>
        </td>
    </tr>
    <tr>
        <th>No</th>
        <th>Bulan</th>
        <th>Status</th>
    </tr>
    <?php for ($i = 0; $i < 12; $i++) : ?>
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