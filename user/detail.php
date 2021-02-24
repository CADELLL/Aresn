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
require '../functions.php';

$nisn = $_POST['nisn'] ?? 0;

if ($nisn == '') {
    echo "
    <script>
        alert('NISN tidak terdaftar!');
        document.location.href = 'pembayaran.php';
    </script>
    ";
    exit;
}

$no = 1;
$total = 0;
$bulan = bulan();
$pembayaranSiswa = query("SELECT * FROM tb_pembayaran
                    JOIN tb_pengguna ON tb_pengguna.id = tb_pembayaran.id_petugas 
                    JOIN tb_spp ON tb_spp.id = tb_pembayaran.id_spp
                    WHERE tb_pembayaran.nisn = $nisn");

$cekPembayaran = mysqli_query($koneksi, "SELECT bulan_dibayar FROM tb_pembayaran WHERE tb_pembayaran.nisn = $nisn");
$cekSPP = mysqli_query($koneksi, "SELECT nominal FROM tb_siswa JOIN tb_spp ON tb_siswa.id_spp = tb_spp.id WHERE tb_siswa.nisn = $nisn");

foreach ($cekSPP as $c) {
    $spp = $c['nominal'];
}

$total += ($spp * mysqli_num_rows($cekPembayaran)) - $spp * 12;
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
        <form action="pembayaran.php" method="POST">
            <input type="text" name="kataKunci" placeholder="Masukkan kata kunci..." autofocus autocomplete="off">
            <button type="submit" name="cari">Cari</button>
        </form>
        <p>SMK</p>
    </nav>

    <div id="sidebar">
        <p id="menu">Menu</p>
        <ul>
            <li><a href="../index.php"><span class="hide">Dashboard </span><span class="hide-icon"><i class='bx bxs-dashboard'></i></span></a></li>
            <li><a href="siswa.php"><span class="hide">Siswa </span><span class="hide-icon"><i class='bx bx-user'></i></span></a></li>
            <li><a href="petugas.php"><span class="hide">Petugas </span><span class="hide-icon"><i class='bx bx-user'></i></span></a></li>
            <li><a href="kelas.php"><span class="hide">Kelas </span><span class="hide-icon"><i class='bx bx-home-alt'></i></span></a></li>
            <li><a href="pembayaran.php" class="active"><span class="hide">Pembayaran </span><span class="hide-icon"><i class='bx bx-money'></i></span></a></li>
            <li><a href="../autentikasi/masuk.php"><span class="hide">Masuk </span><span class="hide-icon"><i class='bx bx-log-in'></i></span></a></li>
        </ul>
    </div>

    <div id="konten">
        <table>
            <tr>
                <td colspan="8">
                    <span id="aksi">
                        <p class="h2">Detail pembayaran</p>
                        <span>
                            <a href="pembayaran.php" class="href">Kembali</a>
                            <a href="pdf.php?n=<?= $nisn ?>" class="href hijau">Konversi PDF</a>
                        </span>
                    </span>
                </td>
            </tr>
            <tr>
                <td>No</td>
                <td>Petugas</td>
                <td>Tanggal</td>
                <td>Bulan</td>
                <td>Tahun</td>
                <td>SPP</td>
                <td>Jumlah</td>
                <td>Uang kembali</td>
            </tr>
            <?php foreach ($pembayaranSiswa as $p) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $p['nama']; ?></td>
                    <td><?= $p['tanggal_bayar']; ?></td>
                    <td><?= $p['bulan_dibayar']; ?></td>
                    <td><?= $p['tahun_dibayar']; ?></td>
                    <td>Rp. <?= rupiah($p['nominal']) ?></td>
                    <td>Rp. <?= rupiah($p['jumlah_bayar']); ?></td>
                    <td>Rp. <?= rupiah($p['jumlah_bayar'] - 150000); ?></td>
                </tr>
            <?php endforeach; ?>

            <tr>
                <td colspan="2">Daftar SPP belum dibayar</td>
                <td colspan="6"></td>
            </tr>

            <tr>
                <td colspan="2"><?= rupiah($total) >  $spp * 12 ? 'Lunas, Uang kembali' : 'Total belum dibayar' ?></td>
                <td colspan="6">
                    <p style="color: brown; font-weight: bold">Rp. <?= rupiah($total); ?></p>
                </td>
            </tr>

            <?php if ($pembayaranSiswa  == []) : ?>
                <div class="info info-merah">NISN tidak terdaftar!</div>
            <?php endif; ?>
        </table>
    </div>
</body>

</html>