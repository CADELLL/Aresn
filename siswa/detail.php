<?php

session_start();
if (!isset($_SESSION["admin"])) {
    echo "
		<script>
			alert('Tidak dapat mengakses fitur!');
			document.location.href = '../index.php';
		</script>
	";
    exit;
}
require '../functions.php';

$nisn = $_GET['n'] ?? 0;

if ($nisn == '') {
    echo "
    <script>
        alert('NISN tidak terdaftar!');
        document.location.href = 'pembayaran.php';
    </script>
    ";
    exit;
    die;
}

$no = 1;
$pembayaranSiswa = query("SELECT *,tb_pembayaran.id AS id_pembayaran, tb_siswa.nama AS nama_siswa FROM tb_pembayaran
                    JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn
                    JOIN tb_pengguna ON tb_pengguna.id = tb_pembayaran.id_petugas
                    JOIN tb_spp ON tb_spp.id = tb_pembayaran.id_spp
                    WHERE tb_pembayaran.nisn = $nisn");
$cekPembayaran = mysqli_query($koneksi, "SELECT bulan_dibayar FROM tb_pembayaran WHERE tb_pembayaran.nisn = $nisn");

$total = 0;
foreach ($pembayaranSiswa as $p) {
    $total += ($p['nominal'] - $p['jumlah_bayar']);
}

$bulan = bulan();
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
            <li><a href="../admin.php"><span class="hide">Dashboard </span><span class="hide-icon"><i class='bx bxs-dashboard'></i></span></a></li>
            <li><a href="index.php" class="active"><span class="hide">Siswa </span><span class="hide-icon"><i class='bx bx-user'></i></span></a></li>
            <li><a href="../petugas"><span class="hide">Petugas </span><span class="hide-icon"><i class='bx bx-user'></i></span></a></li>
            <li><a href="../kelas"><span class="hide">Kelas </span><span class="hide-icon"><i class='bx bx-home-alt'></i></span></a></li>
            <li><a href="../spp"><span class="hide">SPP </span><span class="hide-icon"><i class='bx bx-purchase-tag-alt'></i></span></a></li>
            <li><a href="../pembayaran"><span class="hide">Pembayaran </span><span class="hide-icon"><i class='bx bx-money'></i></span></a></li>
            <li><a href="../autentikasi/keluar.php"><span class="hide">Keluar </span><span class="hide-icon"><i class='bx bx-log-out'></i></span></a></li>
        </ul>
    </div>

    <div id="konten">
        <table>
            <tr>
                <td colspan="9">
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
                <td>Siswa</td>
                <td>NISN</td>
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
                    <td><?= $p['nama_siswa']; ?></td>
                    <td><?= $p['nisn']; ?></td>
                    <td><?= $p['tanggal_bayar']; ?></td>
                    <td><?= $p['bulan_dibayar']; ?></td>
                    <td><?= $p['tahun_dibayar']; ?></td>
                    <td>Tahun <?= $p['tahun'] ?> <br>Nominal Rp. <?= rupiah($p['nominal']) ?></td>
                    <td>Rp. <?= rupiah($p['jumlah_bayar']); ?></td>
                </tr>
            <?php endforeach; ?>

            <tr>
                <td colspan="2">Daftar bulan dibayar</td>
                <td colspan="7">
                    <?php for ($i = 0; $i < count($bulan); $i++) : ?>
                        <?php foreach ($cekPembayaran as $p) : ?>
                            <?php if ($bulan[$i][0] != $p['bulan_dibayar']) : ?>
                                <?= $bulan[$i][0] . '. ' ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endfor; ?>
                </td>
            </tr>

            <tr>
                <td colspan="2">Total belum dibayar</td>
                <td colspan="7">
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