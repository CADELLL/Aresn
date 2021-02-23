<?php
session_start();

if (!isset($_SESSION["admin"])) {
    echo "
		<script>
            alert('Tidak dapat mengakses fitur ini!');
			document.location.href = '../index.php';
		</script>
	";
    exit;
}

require '../functions.php';

$petugas = query("SELECT * FROM tb_pengguna WHERE tingkat = 'petugas'");
$no = 1;

if (isset($_POST['cari'])) {
    $petugas = cariPetugas($_POST['kataKunci']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar petugas</title>
    <link rel="stylesheet" href="../style.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <nav>
        <form action="" method="POST">
            <input type="text" name="kataKunci" placeholder="Masukkan kata kunci..." autofocus autocomplete="off">
            <button type="submit" name="cari">Cari</button>
        </form>
        <p><?= $_SESSION["nama"] ?></p>
    </nav>

    <div id="sidebar">
        <p id="menu">Menu</p>
        <ul>
            <li><a href="../admin.php"><span class="hide">Dashboard </span><span class="hide-icon"><i class='bx bxs-dashboard'></i></span></a></li>
            <li><a href="../siswa"><span class="hide">Siswa </span><span class="hide-icon"><i class='bx bx-user'></i></span></a></li>
            <li><a href="index.php" class="active"><span class="hide">Petugas </span><span class="hide-icon"><i class='bx bx-user'></i></span></a></li>
            <li><a href="../kelas"><span class="hide">Kelas </span><span class="hide-icon"><i class='bx bx-home-alt'></i></span></a></li>
            <li><a href="../pembayaran"><span class="hide">Pembayaran </span><span class="hide-icon"><i class='bx bx-money'></i></span></a></li>
            <li><a href="../autentikasi/keluar.php"><span class="hide">Keluar </span><span class="hide-icon"><i class='bx bx-log-out'></i></span></a></li>
        </ul>
    </div>

    <div id="konten">
        <span id="aksi">
            <p class="h2">Daftar petugas</p>
            <a href="tambah.php" class="href hijau">Tambah</a>
        </span>
        <table>
            <tr>
                <td>No</td>
                <td>Nama</td>
                <td>Email</td>
                <td>Kata sandi</td>
                <td>Pengaturan</td>
            </tr>
            <?php foreach ($petugas as $p) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $p['nama']; ?></td>
                    <td><?= $p['email']; ?></td>
                    <td><?= $p['kata_sandi']; ?></td>
                    <td>
                        <a href="ubah.php?i=<?= $p['id'] ?>" class="href kuning">Ubah</a>
                        <a href="hapus.php?i=<?= $p['id'] ?>" class="href merah" onclick="return confirm('Apakah yakin menghapus data petugas <?= $p['nama'] ?>?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>

</html>