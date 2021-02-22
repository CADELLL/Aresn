<?php
session_start();

if (isset($_SESSION["tingkat"]) != 'admin') {
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
    if (tambahPetugas($_POST) > 0) {
        echo ("
        <script>
			alert('Data berhasil ditambahkan!');
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
    <title>Tambah petugas</title>
    <link rel="stylesheet" href="../style.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <style>
        input[type=password],
        input[type=email] {
            border: 0;
            font-family: "Poppins", Arial, Helvetica, sans-serif;
            height: 38px;
            width: 100%;
            padding: 6px 10px;
            box-sizing: border-box;
            background-color: rgb(250, 250, 250);
            border-radius: 5px;
        }

        input[type=checkbox] {
            cursor: pointer;
            width: 16px;
            height: 16px;
            margin-top: 8px
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
            <p class="h2">Tambah petugas</p>
            <a href="index.php" class="href">Kembali</a>
        </span>

        <form action="" method="POST">
            <table>
                <tr>
                    <td><label for="nama">Nama</label></td>
                    <td><input type="text" name="nama" class="input-form" id="nama" placeholder="Masukkan nama!" required autofocus autocomplete="off"></td>
                </tr>
                <tr>
                    <td><label for="email">Email</label></td>
                    <td><input type="email" name="email" class="input-form" id="email" placeholder="Masukkan email!" required autocomplete="off"></td>
                </tr>
                <tr>
                    <td><label for="kata_sandi2">Kata sandi</label></td>
                    <td><input type="password" name="kata_sandi" class="input-form" id="kata_sandi" placeholder="Masukkan kata sandi!" min="3" required autocomplete="off"></td>
                </tr>
                <tr>
                    <td><label for="kata_sandi2">Ulangi kata sandi</label></td>
                    <td>
                        <input type="password" name="kata_sandi2" class="input-form" id="kata_sandi2" placeholder="Masukkan kata sandi!" min="3" required autocomplete="off">
                        <br>
                        <input type="checkbox" onclick="lihatPassword()"><label style="font-size:14px; color: #333;">Lihat password</label>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;"><button type="submit" name="tambah" class="hijau">Tambah</button></td>
                </tr>
            </table>

        </form>
    </div>

    <script>
        function lihatPassword() {
            var kataSandi1 = document.getElementById("kata_sandi");
            var kataSandi2 = document.getElementById("kata_sandi2");
            if (kataSandi1.type === "password" && kataSandi1.type === "password") {
                kataSandi1.type = "text";
                kataSandi2.type = "text";
            } else {
                kataSandi1.type = "password";
                kataSandi2.type = "password";
            }
        }
    </script>

</body>

</html>