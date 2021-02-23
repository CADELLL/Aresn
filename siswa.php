<?php

require 'functions.php';
$pembayaran = query("SELECT * FROM tb_pembayaran
                    JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn");
$no = 1;

if (isset($_POST['cari'])) {
    $pembayaran = cariPembayaranSiswa($_POST['kataKunci']);
}

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
        <form action="" method="POST">
            <input type="text" name="kataKunci" placeholder="Masukkan kata kunci..." autofocus autocomplete="off">
            <button type="submit" name="cari">Cari</button>
        </form>
        <p>SMKN 1 Kepanjen</p>
    </nav>

    <div id="sidebar">
        <p id="menu">Menu</p>
        <ul>
            <li><a href="index.php"><span class="hide">Dashboard </span><span class="hide-icon"><i class='bx bxs-dashboard'></i></span></a></li>
            <li><a href="siswa.php" class="active"><span class="hide">Pembayaran </span><span class="hide-icon"><i class='bx bx-money'></i></span></a></li>
            <li><a href="autentikasi/masuk.php"><span class="hide">Masuk </span><span class="hide-icon"><i class='bx bx-log-in'></i></span></a></li>
        </ul>
    </div>

    <div id="konten">
        <span id="aksi">
            <p class="h2">Daftar pembayaran</p>
        </span>
        <table>
            <tr>
                <td>No</td>
                <td>Nama</td>
                <th>NISN</th>
                <td>Tanggal</td>
                <td>Pengaturan</td>
            </tr>
            <?php foreach ($pembayaran as $p) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $p['nama']; ?></td>
                    <td><?= $p['nisn']; ?></td>
                    <td><?= $p['tanggal_bayar']; ?></td>
                    <td>
                        <form action="detail.php" method="GET">
                            <input type="hidden" name="nisn" value="" id="nisn">
                            <button class="href hijau" onclick="detail()">Detail</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <script>
        function detail() {
            let hasil;
            let nisn = prompt("Masukkan NISN!");
            if (nisn == null || nisn == "") {
                hasil = "";
            } else {
                hasil = nisn;
            }
            document.getElementById("nisn").value = hasil;
        }
    </script>
</body>

</html>