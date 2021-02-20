<?php
require '../functions.php';
$siswa = query("SELECT * FROM tb_siswa");
$no = 1;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Siswa</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <a href="tambah.php">Tambah Data</a>
    <h1>Daftar Siswa</h1>
    <hr>
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
                <td><?= $s['id_kelas']; ?></td>
                <td><?= $s['alamat']; ?></td>
                <td><?= $s['no_telepon']; ?></td>
                <td>
                    <a href="edit.php">Edit</a> | <a href="hapus.php">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>