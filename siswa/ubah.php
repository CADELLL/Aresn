<?php

require '../functions.php';

$nisn = $_GET['n'];

$siswa = query("SELECT * FROM tb_siswa 
JOIN tb_kelas ON tb_siswa.id_kelas = tb_kelas.id 
JOIN tb_spp ON tb_siswa.id_spp = tb_spp.id 
WHERE tb_siswa.nisn = $nisn")[0];

$kelas = query("SELECT * FROM tb_kelas");
$spp = query("SELECT * FROM tb_spp");

if (isset($_POST['ubah'])) {
    if (ubahSiswa($_POST) > 0) {
        echo ("
        <script>
			alert('Data berhasil diubah!');
			document.location.href = 'index.php';
		</script>
        ");
        exit;
    } else {
        echo ("
        <script>
			alert('Data tidak diubah!');
			document.location.href = 'index.php';
		</script>
        ");
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah siswa</title>
    <link rel="stylesheet" href="../style.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <nav>
        <form action="index.php" method="POST">
            <input type="text" name="kataKunci" placeholder="Masukkan kata kunci..." autocomplete="off">
            <button type="submit" name="cari">Cari</button>
        </form>
        <a href="profil.php">Profil</a>
    </nav>

    <div id="sidebar">
        <p id="menu">Menu</p>
        <ul>
            <li><a href="../index.php"><span class="hide">Dashboard </span><span class="hide-icon"><i class='bx bxs-dashboard'></i></span></a></li>
            <li><a href="index.php" class="active"><span class="hide">Siswa </span><span class="hide-icon"><i class='bx bx-user'></i></span></a></li>
            <li><a href="../petugas/index.php"><span class="hide">Petugas </span><span class="hide-icon"><i class='bx bx-user'></i></span></a></li>
            <li><a href="../assets/"><span class="hide">Kelas </span><span class="hide-icon"><i class='bx bx-home-alt'></i></span></a></li>
        </ul>
    </div>

    <div id="konten">
        <span id="aksi">
            <p class="h2">Ubah siswa</p>
            <a href="index.php" class="href">Kembali</a>
        </span>

        <form action="" method="POST">
            <input type="hidden" name="nisn" value="<?= $siswa['nisn'] ?>">
            <input type="hidden" name="nisLama" value="<?= $siswa['nis'] ?>">
            <table>
                <tr>
                    <td><label for="nis">NIS</label></td>
                    <td><input type="number" name="nis" class="input-form" id="nis" value="<?= $siswa['nis']; ?>" maxlength="8" placeholder="Masukkan NIS!" autofocus required autocomplete="off"></td>
                </tr>
                <tr>
                    <td><label for="nama">Nama</label></td>
                    <td><input type="text" name="nama" class="input-form" id="nama" value="<?= $siswa['nama']; ?>" maxlength="35" placeholder="Masukkan nama!" required autocomplete="off"></td>
                </tr>
                <tr>
                    <td><label for="id_kelas">Kelas</label></td>
                    <td>
                        <select name="id_kelas" id="id_kelas" required>
                            <option value="<?= $siswa['id_kelas'] ?>"><?= $siswa['kelas'] ?></option>
                            <?php foreach ($kelas as $k) : ?>
                                <?php if ($k['id'] != $siswa['id_kelas']) : ?>
                                    <option value="<?= $k['id'] ?>"><?= $k['kelas'] ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="alamat">Alamat</label></td>
                    <td>
                        <input type="text" name="alamat" class="input-form" id="alamat" value="<?= $siswa['alamat'] ?>" placeholder="Masukkan alamat!" required autocomplete="off">
                    </td>
                </tr>
                <tr>
                    <td><label for="no_telepon">No telepon</label></td>
                    <td><input type="number" name="no_telepon" class="input-form" id="no_telepon" maxlength="13" value="<?= $siswa['no_telepon'] ?>" placeholder="Masukkan no telepon!" required autocomplete="off"></td>
                </tr>
                <tr>
                    <td><label for="id_spp">SPP</label></td>
                    <td>
                        <select name="id_spp" id="id_spp">
                            <option value="<?= $siswa['id_spp'] ?>">Tahun <?= $siswa['tahun'] ?> - Rp. <?= number_format($siswa['nominal'], 2, ',', '.') ?></option>
                            <?php foreach ($spp as $s) : ?>
                                <?php if ($s['id'] != $siswa['id_spp']) : ?>
                                    <option value="<?= $s['id'] ?>">Tahun <?= $s['tahun'] ?> - Rp. <?= number_format($s['nominal'], 2, ',', '.') ?></option>
                                <?php endif ?>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;"><button type="submit" name="ubah" class="hijau">Ubah</button></td>
                </tr>
            </table>

        </form>
    </div>

</body>

</html>