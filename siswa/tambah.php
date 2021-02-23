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

$kelas = query("SELECT * FROM tb_kelas");
$spp = query("SELECT * FROM tb_spp");

if (isset($_POST['tambah'])) {
    if (tambahSiswa($_POST) > 0) {
        echo ("<script>
                alert('Data berhasil ditambahkan!');
                document.location.href = 'index.php';
            </script>");
    } else {
        echo ("<script>
                alert('Data gagal ditambahkan!');
                document.location.href = 'index.php';
            </script>");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah siswa</title>
    <link rel="stylesheet" href="../style.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <nav>
        <form action="index.php" method="POST">
            <input type="text" name="kataKunci" placeholder="Masukkan kata kunci..." autocomplete="off">
            <button type="submit" name="cari">Cari</button>
        </form>
        <p><?= $_SESSION["nama"] ?></p>
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

        <form action="" method="POST">
            <table>
                <tr>
                    <td colspan="2">
                        <span id="aksi">
                            <p class="h2">Tambah siswa</p>
                            <a href="index.php" class="href">Kembali</a>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td><label for="nisn">NISN</label></td>
                    <td><input type="number" name="nisn" class="input-form" id="nisn" maxlength="10" placeholder="Masukkan NISN!" autofocus required autocomplete="off"></td>
                </tr>
                <tr>
                    <td><label for="nis">NIS</label></td>
                    <td><input type="number" name="nis" class="input-form" id="nis" maxlength="8" placeholder="Masukkan NIS!" required autocomplete="off"></td>
                </tr>
                <tr>
                    <td><label for="nama">Nama</label></td>
                    <td><input type="text" name="nama" class="input-form" id="nama" maxlength="35" placeholder="Masukkan nama!" required autocomplete="off"></td>
                </tr>
                <tr>
                    <td><label for="id_kelas">Kelas</label></td>
                    <td>
                        <select name="id_kelas" id="id_kelas" required>
                            <?php foreach ($kelas as $k) : ?>
                                <option value="<?= $k['id'] ?>"><?= $k['kelas'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="alamat">Alamat</label></td>
                    <td>
                        <input type="text" name="alamat" class="input-form" id="alamat" placeholder="Masukkan alamat!" required autocomplete="off">
                    </td>
                </tr>
                <tr>
                    <td><label for="no_telepon">No telepon</label></td>
                    <td><input type="number" name="no_telepon" class="input-form" id="no_telepon" maxlength="13" placeholder="Masukkan no telepon!" required autocomplete="off"></td>
                </tr>
                <tr>
                    <td><label for="id_spp">SPP</label></td>
                    <td>
                        <select name="id_spp" id="id_spp">
                            <?php foreach ($spp as $s) : ?>
                                <option value="<?= $s['id'] ?>">Tahun <?= $s['tahun'] ?> - Rp. <?= number_format($s['nominal'], 2, ',', '.') ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;"><button type="submit" name="tambah" class="hijau">Tambah</button></td>
                </tr>
            </table>

        </form>
    </div>

</body>

</html>