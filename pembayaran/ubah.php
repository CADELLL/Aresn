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

$pembayaran = query("SELECT *, 
                    tb_pembayaran.id AS id_pembayaran FROM tb_pembayaran 
                    JOIN tb_spp ON tb_spp.id = tb_pembayaran.id_spp
                    WHERE tb_pembayaran.id = $id")[0];

$spp = query('SELECT * FROM tb_spp');
$bulan = bulan();

if (isset($_POST['ubah'])) {
    if (ubahPembayaran($_POST) > 0) {
        echo "
            <script>
                alert('Data berhasil diubah!');
                document.location.href = 'index.php';
            </script>
            ";
    } else {
        echo "
            <script>
                alert('Data tidak diubah!');
                document.location.href = 'index.php';
            </script>
            ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah petugas</title>
    <link rel="stylesheet" href="../style.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <style>
        input[type=date] {
            border: 0;
            font-family: "Poppins", Arial, Helvetica, sans-serif;
            height: 38px;
            width: 100%;
            padding: 6px 10px;
            box-sizing: border-box;
            background-color: rgb(250, 250, 250);
            border-radius: 5px;
        }
    </style>
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
            <li><a href="../kelas"><span class="hide">Kelas </span><i class='bx bx-home-alt hide-icon'></i></a></li>
            <li><a href="../spp"><span class="hide">SPP </span><i class='bx bx-purchase-tag-alt hide-icon'></i></a></li>
            <li><a href="index.php" class="active"><span class="hide">Pembayaran </span><i class='bx bx-money hide-icon'></i></a></li>
            <li><a href="../autentikasi/keluar.php"><span class="hide">Keluar </span><i class='bx bx-log-out hide-icon'></i></a></li>
        </ul>
    </div>

    <div id="konten">
        <form action="" method="POST">
            <input type="hidden" name="id_pembayaran" value="<?= $pembayaran['id_pembayaran'] ?>">
            <input type="hidden" name="nisn_lama" value="<?= $pembayaran['nisn'] ?>">
            <input type="hidden" name="bulan_lama" value="<?= $pembayaran['bulan_dibayar']; ?>">
            <table>
                <tr>
                    <td colspan="2">
                        <span id="aksi">
                            <p class="h2">Ubah petugas</p>
                            <a href="index.php" class="href">Kembali</a>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td><label for="nisn">NISN</label></td>
                    <td><input type="text" name="nisn" class="input-form" id="nisn" placeholder="Masukkan NISN!" maxlength="10" value="<?= $pembayaran['nisn'] ?>" required autofocus autocomplete="off"></td>
                </tr>
                <tr>
                    <td><label for="bulan_dibayar">Bulan dibayar</label></td>
                    <td>
                        <select name="bulan_dibayar" id="bulan_dibayar" required>
                            <option value="<?= $pembayaran['bulan_dibayar'] ?>"><?= $pembayaran['bulan_dibayar'] ?></option>
                            <?php for ($i = 0; $i < count($bulan); $i++) : ?>
                                <option value="<?= $bulan[$i][0] ?>"><?= $bulan[$i][0] ?></option>
                            <?php endfor ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="tahun_dibayar">Tahun dibayar</label></td>
                    <td><input type="number" name="tahun_dibayar" class="input-form" id="tahun_dibayar" placeholder="Masukkan tahun dibayar!" value="<?= $pembayaran['tahun_dibayar'] ?>" maxlength="4" required autofocus autocomplete="off"></td>
                </tr>
                <tr>
                    <td><label for="jumlah_bayar">Jumlah bayar</label></td>
                    <td><input type="number" name="jumlah_bayar" class="input-form" id="jumlah_bayar" placeholder="Masukkan Jumlah!" value="<?= $pembayaran['jumlah_bayar']; ?>" required autocomplete="off"></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;"><button type="submit" name="ubah" class="hijau">Ubah</button></td>
                </tr>
            </table>

        </form>
    </div>

</body>

</html>