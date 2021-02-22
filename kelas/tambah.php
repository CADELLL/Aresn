<?php
session_start();

if (isset($_SESSION["tingkat"]) !== 'admin') {
    echo "
		<script>
        alert('Tidak dapat mengakses fitur ini!');
        window.history.back();
		</script>
	";
    exit;
}

require '../functions.php';

if (isset($_POST['tambah'])) {
    if (tambahKelas($_POST) > 0) {
        echo ("
        <script>
			alert('Data berhasil ditambahkan!');
			document.location.href = 'index.php';
		</script>
        ");
        exit;
    } else {
        echo ("
        <script>
			alert('Data gagal ditambahkan!');
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
    <title>Tambah kelas</title>
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
            <li><a href="../siswa"><span class="hide">Siswa </span><span class="hide-icon"><i class='bx bx-user'></i></span></a></li>
            <li><a href="../petugas"><span class="hide">Petugas </span><span class="hide-icon"><i class='bx bx-user'></i></span></a></li>
            <li><a href="index.php" class="active"><span class="hide">Kelas </span><span class="hide-icon"><i class='bx bx-home-alt'></i></span></a></li>
            <li><a href="../pembayaran"><span class="hide">Pembayaran </span><span class="hide-icon"><i class='bx bx-money'></i></span></a></li>
            <li><a href="../autentikasi/keluar.php"><span class="hide">Keluar </span><span class="hide-icon"><i class='bx bx-log-out'></i></span></a></li>
        </ul>
    </div>

    <div id="konten">
        <span id="aksi">
            <p class="h2">Tambah kelas</p>
            <a href="index.php" class="href">Kembali</a>
        </span>

        <form action="" method="POST">
            <table>
                <tr>
                    <td><label for="nama">Nama</label></td>
                    <td><input type="text" name="nama" class="input-form" id="nama" placeholder="Masukkan nama kelas!" autofocus required autocomplete="off"></td>
                </tr>
                <tr>
                    <td><label for="kompetensi_keahlian">Kompetensi keahlian</label></td>
                    <td>
                        <select name="kompetensi_keahlian" id="kompetensi_keahlian">
                            <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option>
                            <option value="Multimedia">Multimedia</option>
                            <option value="Teknik Komputer dan Jaringan">Teknik Komputer dan Jaringan</option>
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