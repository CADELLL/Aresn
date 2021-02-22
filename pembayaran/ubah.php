<?php
session_start();

if (isset($_SESSION["tingkat"]) == "") {
    echo "
		<script>
            alert('Tidak dapat mengakses fitur ini!');
            window.history.back();
		</script>
	";
    exit;
}

require '../functions.php';

$id = $_GET['i'];

$pembayaran = query("SELECT *, tb_pembayaran.id AS id_pembayaran FROM tb_pembayaran 
                    -- JOIN tb_pengguna ON tb_pengguna.id = tb_pembayaran.id_petugas 
                    JOIN tb_spp ON tb_spp.id = tb_pembayaran.id_spp
                    WHERE tb_pembayaran.id = $id")[0];

$spp = query('SELECT * FROM tb_spp');

if (isset($_POST['ubah'])) {
    if (ubahPembayaran($_POST) > 0) {
        echo ("<script>
                alert('Data berhasil diubah!');
                document.location.href = 'index.php';
            </script>");
        exit;
    } else {
        echo ("<script>
                alert('Data tidak diubah!');
                document.location.href = 'index.php';
            </script>");
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
            <button type="submit" name="cari">Cari</button>
        </form>
        <p><?= $_SESSION["nama"] ?></p>
    </nav>

    <div id="sidebar">
        <p id="menu">Menu</p>
        <ul>
            <li><a href="../<?= $_SESSION['tingkat'] ?>.php"><span class="hide">Dashboard </span><span class="hide-icon"><i class='bx bxs-dashboard'></i></span></a></li>
            <?php if ($_SESSION["tingkat"] == "admin") : ?>
                <li><a href="../siswa"><span class="hide">Siswa </span><span class="hide-icon"><i class='bx bx-user'></i></span></a></li>
                <li><a href="../petugas"><span class="hide">Petugas </span><span class="hide-icon"><i class='bx bx-user'></i></span></a></li>
                <li><a href="../kelas"><span class="hide">Kelas </span><span class="hide-icon"><i class='bx bx-home-alt'></i></span></a></li>
            <?php endif ?>
            <li><a href="index.php" class="active"><span class="hide">Pembayaran </span><span class="hide-icon"><i class='bx bx-money'></i></span></a></li>
            <li><a href="../autentikasi/keluar.php"><span class="hide">Keluar </span><span class="hide-icon"><i class='bx bx-log-out'></i></span></a></li>
        </ul>
    </div>

    <div id="konten">
        <span id="aksi">
            <p class="h2">Ubah petugas</p>
            <a href="index.php" class="href">Kembali</a>
        </span>

        <form action="" method="POST">
            <input type="hidden" name="id_petugas" value="<?= $_SESSION['id'] ?>">
            <input type="hidden" name="id_pembayaran" value="<?= $pembayaran['id_pembayaran'] ?>">
            <input type="hidden" name="nisn_lama" value="<?= $pembayaran['nisn'] ?>">
            <table>
                <tr>
                    <td><label for="nisn">NISN</label></td>
                    <td><input type="text" name="nisn" class="input-form" id="nisn" placeholder="Masukkan NISN!" maxlength="10" value="<?= $pembayaran['nisn'] ?>" required autofocus autocomplete="off"></td>
                </tr>
                <tr>
                    <td><label for="tanggal_bayar">Tanggal bayar</label></td>
                    <td><input type="date" name="tanggal_bayar" class="input-form" id="tanggal_bayar" placeholder="Masukkan tanggal!" value="<?= $pembayaran['tanggal_bayar'] ?>" required autocomplete="off"></td>
                </tr>
                <tr>
                    <td><label for="bulan_dibayar">Bulan dibayar</label></td>
                    <td>
                        <select name="bulan_dibayar" id="bulan_dibayar" required>
                            <option value="<?= $pembayaran['bulan_dibayar'] ?>"><?= $pembayaran['bulan_dibayar'] ?></option>
                            <option value="Januari">Januari</option>
                            <option value="Februari">Februari</option>
                            <option value="Maret">Maret</option>
                            <option value="April">April</option>
                            <option value="Mei">Mei</option>
                            <option value="Juni">Juni</option>
                            <option value="Juli">Juli</option>
                            <option value="Agustus">Agustus</option>
                            <option value="September">September</option>
                            <option value="Oktober">Oktober</option>
                            <option value="November">November</option>
                            <option value="Desember">Desember</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="tahun_dibayar">Tahun dibayar</label></td>
                    <td><input type="number" name="tahun_dibayar" class="input-form" id="tahun_dibayar" placeholder="Masukkan tahun dibayar!" value="<?= $pembayaran['tahun_dibayar'] ?>" maxlength="4" required autofocus autocomplete="off"></td>
                </tr>
                <tr>
                    <td><label for="id_spp">SPP</label></td>
                    <td>
                        <select name="id_spp" id="id_spp" required>
                            <option value="<?= $pembayaran['id_spp'] ?>">Tahun <?= $pembayaran['tahun'] ?> - Nominal <?= rupiah($pembayaran['nominal']) ?></option>
                            <?php foreach ($spp as $s) : ?>
                                <?php if ($s['id'] != $pembayaran['id_spp']) : ?>
                                    <option value="<?= $s['id'] ?>">Tahun <?= $s['tahun'] ?> - Nominal <?= rupiah($s['nominal']) ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </td>
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