<?php

session_start();

if (!isset($_SESSION["petugas"])) {
    echo "
		<script>
            alert('Tidak dapat mengakses fitur ini!');
            window.history.back();
		</script>
	";
    exit;
}

require '../functions.php';

$pembayaran = query("SELECT *, tb_pembayaran.id AS id_pembayaran FROM tb_pembayaran
                    JOIN tb_pengguna ON tb_pengguna.id = tb_pembayaran.id_petugas 
                    JOIN tb_spp ON tb_spp.id = tb_pembayaran.id_spp");
$no = 1;

if (isset($_POST['cari'])) {
    $pembayaran = cariPembayaran($_POST['kataKunci']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar pembayaran</title>
    <link rel="stylesheet" href="../style.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <nav>
        <form action="" method="POST">
            <input type="text" name="kataKunci" placeholder="Masukkan kata kunci..." autofocus autocomplete="off">
            <button type="submit" name="cari">Cari</button>
        </form>
        <p><?= $_SESSION["nama"] ?></p>
    </nav>

    <div id="sidebar">
        <p id="menu">Menu</p>
        <ul>
            <li><a href="../petugas.php"><span class="hide">Dashboard </span><span class="hide-icon"><i class='bx bxs-dashboard'></i></span></a></li>
            <li><a href="index.php" class="active"><span class="hide">Pembayaran </span><span class="hide-icon"><i class='bx bx-money'></i></span></a></li>
            <li><a href="../autentikasi/keluar.php"><span class="hide">Keluar </span><span class="hide-icon"><i class='bx bx-log-out'></i></span></a></li>
        </ul>
    </div>

    <div id="konten">
        <span id="aksi">
            <p class="h2">Daftar pembayaran</p>
            <div>
                <a href="pdf.php" class="href">Konversi PDF</a>
                <a href="tambah.php" class="href hijau">Tambah</a>
            </div>
        </span>
        <table>
            <tr>
                <td>No</td>
                <td>Nama</td>
                <th>NISN</th>
                <td>Tanggal</td>
                <td>Bulan</td>
                <td>Tahun</td>
                <td>SPP</td>
                <td>Jumlah</td>
                <td>Pengaturan</td>
            </tr>
            <?php foreach ($pembayaran as $p) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $p['nama']; ?></td>
                    <td><?= $p['nisn']; ?></td>
                    <td><?= $p['tanggal_bayar']; ?></td>
                    <td><?= $p['bulan_dibayar']; ?></td>
                    <td><?= $p['tahun_dibayar']; ?></td>
                    <td>Tahun <?= $p['tahun'] ?> <br>Nominal <?= rupiah($p['nominal']) ?></td>
                    <td><?= $p['jumlah_bayar']; ?></td>
                    <td>
                        <a href="ubah.php?i=<?= $p['id_pembayaran'] ?>" class="href kuning">Ubah</a>
                        <a href="hapus.php?i=<?= $p['id_pembayaran'] ?>" class="href merah" onclick="return confirm('Apakah yakin menghapus data petugas <?= $p['nama'] ?>?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>

</html>