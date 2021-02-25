<?php
session_start();

if (!isset($_SESSION["admin"])) {
    echo "
		<script>
            alert('Tidak dapat mengakses fitur ini!');
            document.location.href = '../index.php';
		</script>
	    ";
    exit;
}

require '../functions.php';

$spp = query("SELECT * FROM tb_spp");
$no = 1;

if (isset($_POST['cari'])) {
    $spp = cariSPP($_POST['kataKunci']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar SPP</title>
    <link rel="stylesheet" href="../style.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <nav>
        <form action="" method="POST">
            <input type="text" name="kataKunci" placeholder="Masukkan kata kunci..." autofocus autocomplete="off">
            <button type="submit" name="cari"><span class="hide">Cari </span><i class="bx bx-search hide-icon"></i></button>
        </form>
        <p><?= $_SESSION["nama"] ?></p>
    </nav>

    <div id="sidebar">
        <p id="menu">Menu</p>
        <ul>
            <li><a href="../admin.php"><span class="hide">Dashboard </span><i class='bx bxs-dashboard hide-icon'></i></a></li>
            <li><a href="../siswa"><span class="hide">Siswa </span><i class='bx bx-user hide-icon'></i></a></li>
            <li><a href="../petugas"><span class="hide">Petugas </span><i class='bx bx-user hide-icon'></i></a></li>
            <li><a href="../kelas"><span class="hide">Kelas </span><i class='bx bx-home-alt hide-icon'></i></a></li>
            <li><a href="index.php" class="active"><span class="hide">SPP </span><i class='bx bx-purchase-tag-alt hide-icon'></i></a></li>
            <li><a href="../pembayaran"><span class="hide">Pembayaran </span><i class='bx bx-money hide-icon'></i></a></li>
            <li><a href="../autentikasi/keluar.php"><span class="hide">Keluar </span><i class='bx bx-log-out hide-icon'></i></a></li>
        </ul>
    </div>

    <div id="konten">
        <table>
            <tr>
                <td colspan="4">
                    <span id="aksi">
                        <p class="h2">Daftar SPP</p>
                        <a href="tambah.php" class="href hijau">Tambah</a>
                    </span>
                </td>
            </tr>
            <tr>
                <td>No</td>
                <td>Tahun</td>
                <td>Nominal</td>
                <td>Pengaturan</td>
            </tr>
            <?php foreach ($spp as $s) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $s['tahun']; ?></td>
                    <td><?= rupiah($s['nominal']); ?></td>
                    <td>
                        <a href="ubah.php?i=<?= $s['id'] ?>" class="href kuning">Ubah</a>
                        <a href="hapus.php?i=<?= $s['id'] ?>" class="href merah" onclick="return confirm('Apakah yakin menghapus data spp & pembayaran tahun <?= $s['tahun'] ?>?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if ($spp == []) : ?>
                <div class="info info-merah">Data tidak ada!</div>
            <?php endif; ?>
        </table>
    </div>
</body>

</html>