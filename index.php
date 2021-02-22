<?php
require 'functions.php';
$siswa = query("SELECT * FROM tb_siswa");
$uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

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
            <button type="submit" name="cari">Cari</button>
        </form>
        <a href="profil.php">Profil</a>
    </nav>

    <div id="sidebar">
        <p id="menu">Menu</p>
        <ul>
            <li><a href="index.php" class="active"><span class="hide">Dashboard </span><i class='bx bx-user'></i></a></li>
            <li><a href="siswa/index.php"><span class="hide">Siswa </span><i class='bx bx-user'></i></a></li>
            <li><a href="petugas/index.php"><span class="hide">Petugas </span><i class='bx bx-user'></i></a></li>
            <li><a href="autentikasi/masuk.php"><span class="hide">Masuk </span><i class='bx bx-user'></i></a></li>
            <li><a href="autentikasi/daftar.php"><span class="hide">Daftar </span><i class='bx bx-user'></i></a></li>
        </ul>
    </div>

    <div id="konten">
        <span id="aksi">
            <p class="h2">Informasi Singkat</p>
        </span>

        <section id="informasi">
            <a href="siswa/index.php" class="kartu siswa">
                Jumlah Siswa
                <div class="jumlah">
                    <?= count($siswa); ?>
                </div>
            </a href="#">
            <a href="#" class="kartu pembayaran">
                Pembayaran
            </a href="#">
            <a href="#" class="kartu kelas">
                Kelas
            </a href="#">
            <a href="#" class="kartu pengguna">
                Pengguna
            </a href="#">
        </section>
    </div>

</body>

</html>