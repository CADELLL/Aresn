<?php

session_start();
if (isset($_SESSION["admin"])) {
    header("Location: admin.php");
    exit;
}
if (isset($_SESSION["petugas"])) {
    header("Location: petugas.php");
    exit;
}
require 'functions.php';

$nisn = $_POST['nisn'] ?? 0;

if ($nisn == '') {
    echo "
    <script>
        alert('NISN tidak terdaftar!');
        document.location.href = 'index.php';
    </script>
    ";
    exit;
}

$siswa = query("SELECT * FROM tb_siswa");
$pengguna = query("SELECT * FROM tb_pengguna WHERE tingkat = 'petugas'");
$kelas = query("SELECT * FROM tb_kelas");
$pembayaran = query("SELECT * FROM tb_pembayaran");

$pembayaranSiswa = query("SELECT * FROM tb_pembayaran
                    JOIN tb_pengguna ON tb_pengguna.id = tb_pembayaran.id_petugas 
                    JOIN tb_spp ON tb_spp.id = tb_pembayaran.id_spp
                    WHERE tb_pembayaran.nisn = $nisn");
$no = 1;


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar pembayaran</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <nav>
        <form action="index.php" method="POST">
            <input type="text" name="kataKunci" placeholder="Masukkan kata kunci..." autofocus autocomplete="off">
            <button type="submit" name="cari">Cari</button>
        </form>
        <p>SMK</p>
    </nav>

    <div id="sidebar">
        <p id="menu">Menu</p>
        <ul>
            <li><a href="index.php" class="active"><span class="hide">Dashboard </span><span class="hide-icon"><i class='bx bxs-dashboard'></i></span></a></li>
            <li><a href="autentikasi/masuk.php"><span class="hide">Masuk </span><span class="hide-icon"><i class='bx bx-log-in'></i></span></a></li>
        </ul>
    </div>

    <div id="konten">
        <span id="aksi">
            <p class="h2">Informasi singkat</p>
        </span>

        <section id="informasi">
            <a href="siswa" class="kartu">
                Jumlah siswa
                <div class="jumlah">
                    <?= count($siswa); ?>
                </div>
            </a>
            <a href="petugas" class="kartu">
                Jumlah pengguna
                <div class="jumlah">
                    <?= count($pengguna); ?>
                </div>
            </a>
            <a href="kelas" class="kartu">
                Jumlah kelas
                <div class="jumlah">
                    <?= count($kelas); ?>
                </div>
            </a>
            <a href="pembayaran" class="kartu">
                Jumlah pembayaran
                <div class="jumlah">
                    <?= count($pembayaran); ?>
                </div>
            </a>

        </section>
        <span id="aksi" style="margin-top: 40px;">
            <p class="h2">Detail pembayaran</p>
            <a href="index.php" class="href">Kembali</a>
        </span>
        <table>
            <tr>
                <td>No</td>
                <td>Nama</td>
                <td>Tanggal</td>
                <td>Bulan</td>
                <td>Tahun</td>
                <td>SPP</td>
                <td>Jumlah</td>
            </tr>
            <?php foreach ($pembayaranSiswa as $p) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $p['nama']; ?></td>
                    <td><?= $p['tanggal_bayar']; ?></td>
                    <td><?= $p['bulan_dibayar']; ?></td>
                    <td><?= $p['tahun_dibayar']; ?></td>
                    <td>Tahun <?= $p['tahun'] ?> <br>Nominal <?= rupiah($p['nominal']) ?></td>
                    <td><?= $p['jumlah_bayar']; ?></td>
                </tr>
            <?php endforeach; ?>
            <?php if ($pembayaranSiswa  == []) : ?>
                <div class="info info-merah">NISN tidak terdaftar!</div>
            <?php endif; ?>
        </table>
    </div>
</body>

</html>