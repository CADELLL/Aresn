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

$pembayaranSiswa = query("SELECT * FROM tb_pembayaran
                    JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn
                    JOIN tb_kelas ON tb_siswa.id_kelas = tb_kelas.id");

$no = 1;
if (isset($_POST['cari'])) {
    $pembayaranSiswa = cariUserPembayaran($_POST['kataKunci']);
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
                <td colspan="5">
                    <span id="aksi">
                        <p class="h2">Daftar pembayaran</p>
                    </span>
                </td>
            </tr>
            <tr>
                <td>No</td>
                <td>Nama</td>
                <th>Kelas</th>
                <td>Tanggal</td>
                <td>Pengaturan</td>
            </tr>
            <?php foreach ($pembayaranSiswa as $p) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $p['nama']; ?></td>
                    <td><?= $p['kelas']; ?></td>
                    <td><?= $p['tanggal_bayar']; ?></td>
                    <td>
                        <form action="detail.php" method="POST">
                            <input type="hidden" name="nisn" id="nisn">
                            <button class="hijau" onclick="cekNISN()">Detail</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if ($pembayaranSiswa  == []) : ?>
                <div class="info info-merah">Data tidak ada!</div>
            <?php endif; ?>
        </table>
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