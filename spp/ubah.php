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
$spp = query("SELECT * FROM tb_spp WHERE id = $id")[0];

if (isset($_POST['ubah'])) {
    if (ubahSPP($_POST) > 0) {
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
    <title>Ubah SPP</title>
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
            <li><a href="../kelas"><span class="hide">Kelas </span><span class="hide-icon"><i class='bx bx-home-alt'></i></span></a></li>
            <li><a href="index.php" class="active"><span class="hide">SPP </span><span class="hide-icon"><i class='bx bx-purchase-tag-alt'></i></span></a></li>
            <li><a href="../pembayaran"><span class="hide">Pembayaran </span><span class="hide-icon"><i class='bx bx-money'></i></span></a></li>
            <li><a href="../autentikasi/keluar.php"><span class="hide">Keluar </span><span class="hide-icon"><i class='bx bx-log-out'></i></span></a></li>
        </ul>
    </div>

    <div id="konten">
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?= $spp['id'] ?>">
            <table>
                <tr>
                    <td colspan="2">
                        <span id="aksi">
                            <p class="h2">Ubah SPP</p>
                            <a href="index.php" class="href">Kembali</a>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td><label for="tahun">Tahun</label></td>
                    <td><input type="number" name="tahun" class="input-form" id="tahun" value="<?= $spp['tahun']; ?>" placeholder="Masukkan tahun!" autofocus required autocomplete="off"></td>
                </tr>
                <tr>
                    <td><label for="nominal">Nominal</label></td>
                    <td><input type="number" name="nominal" class="input-form" id="nominal" value="<?= $spp['nominal']; ?>" placeholder="Masukkan nominal!" maxlength="4" required autocomplete="off"></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;"><button type="submit" name="ubah" class="hijau">Ubah</button></td>
                </tr>
            </table>

        </form>
    </div>

</body>

</html>