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

$kelas = query("SELECT * FROM tb_kelas");
$no = 1;

if (isset($_POST['cari'])) {
    $kelas = cariKelas($_POST['kataKunci']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar kelas</title>
    <link rel="stylesheet" href="../style.css">
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
            <li><a href="../index.php"><span class="hide">Dashboard </span><i class='bx bxs-dashboard hide-icon'></i></a></li>
            <li><a href="siswa.php"><span class="hide">Siswa </span><i class='bx bx-user hide-icon'></i></a></li>
            <li><a href="petugas.php"><span class="hide">Petugas </span><i class='bx bx-user hide-icon'></i></a></li>
            <li><a href="kelas.php" class="active"><span class="hide">Kelas </span><i class='bx bx-home-alt hide-icon'></i></a></li>
            <li><a href="pembayaran.php"><span class="hide">Pembayaran </span><i class='bx bx-money hide-icon'></i></a></li>
            <li><a href="../autentikasi/masuk.php"><span class="hide">Masuk </span><i class='bx bx-log-in hide-icon'></i></a></li>
        </ul>
    </div>

    <div id="konten">
        <table>
            <tr>
                <td colspan="3">
                    <span id="aksi">
                        <p class="h2">Daftar kelas</p>
                    </span>
                </td>
            </tr>
            <tr>
                <td>No</td>
                <td>Nama</td>
                <td>Kompetensi keahlian</td>
            </tr>
            <?php foreach ($kelas as $k) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $k['kelas']; ?></td>
                    <td><?= $k['kompetensi_keahlian']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>

</html>