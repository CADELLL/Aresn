<?php
session_start();
if (!isset($_SESSION["petugas"])) {
    echo "
		<script>
			alert('Tidak dapat mengakses fitur!');
            window.history.back();
		</script>
	    ";
    exit;
}

require 'functions.php';

$siswa = query("SELECT * FROM tb_siswa");
$pengguna = query("SELECT * FROM tb_pengguna WHERE tingkat = 'petugas'");
$kelas = query("SELECT * FROM tb_kelas");
$pembayaran = query("SELECT * FROM tb_pembayaran");

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
            <button type="submit" name="cari"><span class="hide">Cari </span><i class="bx bx-search hide-icon"></i></button>
        </form>
        <p><?= $_SESSION["nama"] ?></p>
    </nav>

    <div id="sidebar">
        <p id="menu">Menu</p>
        <ul>
            <li><a href="index.php" class="active"><span class="hide">Dashboard </span><i class='bx bxs-dashboard'></i></a></li>
            <li><a href="pembayaran_petugas"><span class="hide">Pembayaran </span><i class='bx bx-money'></i></a></li>
            <li><a href="autentikasi/keluar.php"><span class="hide">Keluar </span><i class='bx bx-log-out'></i></a></li>
        </ul>
    </div>

    <div id="konten">
        <span id="aksi" style="margin-bottom: 10px;">
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
    </div>

</body>

</html>