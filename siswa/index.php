<?php
require '../functions.php';
$siswa = query("SELECT * FROM tb_siswa JOIN tb_kelas ON tb_siswa.id_kelas = tb_kelas.id");
$no = 1;

if (isset($_POST['cari'])) {
    $siswa = cariSiswa($_POST['kataKunci']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Siswa</title>
    <link rel="stylesheet" href="../style.css">
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
            <li><a href="../index.php"><span class="hide">Dashboard </span><i class='bx bx-user'></i></a></li>
            <li><a href="index.php" class="active"><span class="hide">Siswa </span><i class='bx bx-user'></i></a></li>
        </ul>
    </div>

    <div id="konten">
        <span id="aksi">
            <p class="h2">Daftar Siswa</p>
            <a href="tambah.php" class="href hijau">Tambah Data</a>
        </span>
        <table>
            <tr>
                <td>No</td>
                <td>Nisn</td>
                <td>Nis</td>
                <td>Nama</td>
                <td>Kelas</td>
                <td>Alamat</td>
                <td>No telepon</td>
                <td>Pengaturan</td>
            </tr>
            <?php foreach ($siswa as $s) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $s['nisn']; ?></td>
                    <td><?= $s['nis']; ?></td>
                    <td><?= $s['nama']; ?></td>
                    <td><?= $s['kelas']; ?></td>
                    <td><?= $s['alamat']; ?></td>
                    <td><?= $s['no_telepon']; ?></td>
                    <td>
                        <a href="ubah.php?n=<?= $s['nisn'] ?>" class="href kuning">Ubah</a>
                        <a href="hapus.php?n=<?= $s['nisn'] ?>" class="href merah" onclick="return confirm('Apakah yakin menghapus data siswa <?= $s['nama'] ?>?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>

</html>