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

$no = 1;
$siswa = query("SELECT * FROM tb_siswa");
$petugas = query("SELECT * FROM tb_pengguna WHERE tingkat = 'petugas'");
$kelas = query("SELECT * FROM tb_kelas");
$pembayaran = query("SELECT * FROM tb_pembayaran");
$pembayaranSiswa = query("SELECT * FROM tb_pembayaran
                            JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn
                            JOIN tb_kelas ON tb_siswa.id_kelas = tb_kelas.id");

if (isset($_POST['cari'])) {
    $pembayaranSiswa = cariPembayaranSiswa($_POST['kataKunci']);
}

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
        <p>SMK</p>
    </nav>

    <div id="sidebar">
        <p id="menu">Menu</p>
        <ul>
            <li><a href="index.php" class="active"><span class="hide">Dashboard </span><i class='bx bxs-dashboard hide-icon'></i></a></li>
            <li><a href="user/siswa.php"><span class="hide">Siswa </span><i class='bx bx-user hide-icon'></i></a></li>
            <li><a href="user/petugas.php"><span class="hide">Petugas </span><i class='bx bx-user hide-icon'></i></a></li>
            <li><a href="user/kelas.php"><span class="hide">Kelas </span><i class='bx bx-home-alt hide-icon'></i></a></li>
            <li><a href="user/pembayaran.php"><span class="hide">Pembayaran </span><i class='bx bx-money hide-icon'></i></a></li>
            <li><a href="autentikasi/masuk.php"><span class="hide">Masuk </span><i class='bx bx-log-in hide-icon'></i></a></li>
        </ul>
    </div>

    <div id="konten">
        <span id="aksi" style="margin-bottom: 10px;">
            <p class="h2">Informasi singkat</p>
        </span>

        <section id="informasi">
            <a href="user/siswa.php" class="kartu">
                Jumlah siswa
                <div class="jumlah">
                    <?= count($siswa); ?>
                </div>
            </a>
            <a href="user/petugas.php" class="kartu">
                Jumlah petugas
                <div class="jumlah">
                    <?= count($petugas); ?>
                </div>
            </a>
            <a href="user/kelas.php" class="kartu">
                Jumlah kelas
                <div class="jumlah">
                    <?= count($kelas); ?>
                </div>
            </a>
            <a href="user/pembayaran.php" class="kartu">
                Jumlah pembayaran
                <div class="jumlah">
                    <?= count($pembayaran); ?>
                </div>
            </a>
        </section>

        <span id="aksi" style="margin: 20px 0px 10px">
            <p class="h2">Gallery</p>
        </span>

        <section id="responsive">
            <div class="gallery">
                <a target="_blank" href="https://dummyimage.com/600x400/f2f2f2/333">
                    <img src="https://dummyimage.com/600x400/f2f2f2/333" alt="Cinque Terre" width="600" height="400">
                </a>
                <div class="desc">Add a description of the image here</div>
            </div>
            <div class="gallery">
                <a target="_blank" href="https://dummyimage.com/600x400/f2f2f2/333">
                    <img src="https://dummyimage.com/600x400/f2f2f2/333" alt="Cinque Terre" width="600" height="400">
                </a>
                <div class="desc">Add a description of the image here</div>
            </div>
            <div class="gallery">
                <a target="_blank" href="https://dummyimage.com/600x400/f2f2f2/333">
                    <img src="https://dummyimage.com/600x400/f2f2f2/333" alt="Cinque Terre" width="600" height="400">
                </a>
                <div class="desc">Add a description of the image here</div>
            </div>
            <div class="gallery">
                <a target="_blank" href="https://dummyimage.com/600x400/f2f2f2/333">
                    <img src="https://dummyimage.com/600x400/f2f2f2/333" alt="Cinque Terre" width="600" height="400">
                </a>
                <div class="desc">Add a description of the image here</div>
            </div>
        </section>
    </div>

    <script>
        function cekNISN() {
            let nisn = prompt("Masukkan NISN!");
            if (nisn < 9999999999) {
                document.getElementById("nisn").value = nisn;
            } else if (isNaN(nisn)) {
                parseInt(prompt("Masukkan nomer NISN!"));
            } else {
                parseInt(prompt("Maksimal nomber NISN 10 digit!", ""));
            }
        }
    </script>
</body>

</html>