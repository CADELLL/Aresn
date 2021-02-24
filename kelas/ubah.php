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

$id = $_GET['i'];
$kelas = query("SELECT * FROM tb_kelas WHERE id = $id")[0];

if (isset($_POST['ubah'])) {
    if (ubahKelas($_POST) > 0) {
        echo ("
        <script>
			alert('Data berhasil diubah!');
			document.location.href = 'index.php';
		</script>
        ");
    } else {
        echo ("
        <script>
			alert('Data tidak diubah!');
			document.location.href = 'index.php';
		</script>
        ");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah kelas</title>
    <link rel="stylesheet" href="../style.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <nav>
        <form action="index.php" method="POST">
            <input type="text" name="kataKunci" placeholder="Masukkan kata kunci..." autocomplete="off">
            <button type="submit" name="cari"><span class="hide">Cari </span><i class="bx bx-search hide-icon"></i></button>
        </form>
        <p><?= $_SESSION["nama"] ?></p>
    </nav>

    <div id="sidebar">
        <p id="menu">Menu</p>
        <ul>
            <li><a href="../admin.php"><span class="hide">Dashboard </span><i class='bx bxs-dashboard hide-icon'></i></a></li>
            <li><a href="../siswa"><span class="hide">Siswa </span><i class='bx bx-user hide-icon'></i></a></li>
            <li><a href="../petugas"><span class="hide">Petugas </span><i class='bx bx-user hide-icon'></i></a></li>
            <li><a href="index.php" class="active"><span class="hide">Kelas </span><i class='bx bx-home-alt hide-icon'></i></a></li>
            <li><a href="../spp"><span class="hide">SPP </span><i class='bx bx-purchase-tag-alt hide-icon'></i></a></li>
            <li><a href="../pembayaran"><span class="hide">Pembayaran </span><i class='bx bx-money hide-icon'></i></a></li>
            <li><a href="../autentikasi/keluar.php"><span class="hide">Keluar </span><i class='bx bx-log-out hide-icon'></i></a></li>
        </ul>
    </div>

    <div id="konten">
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?= $kelas['id'] ?>">
            <table>
                <tr>
                    <td colspan="2">
                        <span id="aksi">
                            <p class="h2">Ubah kelas</p>
                            <a href="index.php" class="href">Kembali</a>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td><label for="nama">Nama</label></td>
                    <td><input type="text" name="nama" class="input-form" id="nama" value="<?= $kelas['kelas']; ?>" placeholder="Masukkan nama kelas!" autofocus required autocomplete="off"></td>
                </tr>
                <tr>
                    <td><label for="kompetensi_keahlian">Kelas</label></td>
                    <td><input type="text" name="kompetensi_keahlian" class="input-form" id="kompetensi_keahlian" placeholder="Masukkan kompetensi keahlian!" value="<?= $kelas['kompetensi_keahlian'] ?>" required autocomplete="off"></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;"><button type="submit" name="ubah" class="hijau">Ubah</button></td>
                </tr>
            </table>

        </form>
    </div>

</body>

</html>