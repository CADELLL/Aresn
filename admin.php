<?php
session_start();
if (!isset($_SESSION["admin"])) {
    echo "
		<script>
            alert('Tidak dapat mengakses fitur ini!');
            window.history.back();
		</script>
	    ";
    exit;
}

require 'functions.php';

$siswa = query("SELECT * FROM tb_siswa");
$petugas = query("SELECT * FROM tb_pengguna WHERE tingkat = 'petugas'");
$kelas = query("SELECT * FROM tb_kelas");
$pembayaran = query("SELECT * FROM tb_pembayaran");
$cekPembayaran = query("SELECT * FROM tb_siswa JOIN tb_pembayaran ON tb_siswa.nisn = tb_pembayaran.nisn");
$bulan = bulan();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <nav>
        <form action="" method="POST">
            <input type="text" name="kataKunci" placeholder="Masukkan kata kunci..." autofocus autocomplete="off">
            <button type="submit" name="cari"><span class="hide">Cari </span><i class='bx bx-search hide-icon'></i></button>
        </form>
        <p><?= $_SESSION["nama"] ?></p>
    </nav>

    <div id="sidebar">
        <p id="menu">Menu</p>
        <ul>
            <li><a href="index.php" class="active"><span class="hide">Dashboard </span><i class='bx bxs-dashboard hide-icon'></i></a></li>
            <li><a href="siswa"><span class="hide">Siswa </span><i class='bx bx-user hide-icon'></i></a></li>
            <li><a href="petugas"><span class="hide">Petugas </span><i class='bx bx-user hide-icon'></i></a></li>
            <li><a href="kelas"><span class="hide">Kelas </span><i class='bx bx-home-alt hide-icon'></i></a></li>
            <li><a href="spp"><span class="hide">SPP </span><i class='bx bx-purchase-tag-alt hide-icon'></i></a></li>
            <li><a href="pembayaran"><span class="hide">Pembayaran </span><i class='bx bx-money hide-icon'></i></a></li>
            <li><a href="autentikasi/keluar.php"><span class="hide">Keluar </span><i class='bx bx-log-out hide-icon'></i></a></li>
        </ul>
    </div>

    <div id="konten">
        <span id="aksi" style="margin-bottom: 15px;">
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
                Jumlah petugas
                <div class="jumlah">
                    <?= count($petugas); ?>
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

        <span id="aksi" style="margin: 30px 0px 15px;">
            <p class="h2">Daftar siswa SPP</p>
        </span>

        <table>
            <tr>
                <th>Nama</th>
                <?php for ($i = 0; $i < count($bulan); $i++) : ?>
                    <th><?= $bulan[$i][0] ?></th>
                <?php endfor; ?>
            </tr>
            <tr>
                <?php foreach ($cekPembayaran as $c) : ?>
                    <th><?= $c['nama'] ?></th>
                    <?php for ($i = 0; $i < count($bulan); $i++) : ?>
                        <?php if ($bulan[$i][0] == $c['bulan_dibayar']) : ?>
                            <td><i class='bx bx-check'></i></td>
                        <?php else : ?>
                            <td><?= ''; ?></td>
                        <?php endif; ?>
                    <?php endfor; ?>
                <?php endforeach; ?>
            </tr>
        </table>
    </div>

</body>

</html>