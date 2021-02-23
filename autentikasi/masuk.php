<?php
session_start();
if (isset($_SESSION["admin"])) {
    header("Location: ../admin.php");
    exit;
}
if (isset($_SESSION["petugas"])) {
    header("Location: ../petugas.php");
    exit;
}

require '../functions.php';

if (isset($_POST["masuk"])) {

    $koneksi = mysqli_connect("localhost", "root", "", "db_spp");

    $email = $_POST["email"];
    $kataSandi = $_POST["kata_sandi"];

    $hasil = mysqli_query($koneksi, "SELECT * FROM tb_pengguna WHERE email = '$email'");

    // cek email
    if (mysqli_num_rows($hasil) === 1) {

        // cek kata_sandi
        $row = mysqli_fetch_assoc($hasil);
        if ($kataSandi == $row["kata_sandi"]) {
            if ($row["tingkat"] == "admin") {
                $_SESSION["id"] = $row['id'];
                $_SESSION["nama"] = $row['nama'];
                $_SESSION["admin"] = true;
                header('Location: ../admin.php');
                exit;
            } else if ($row["tingkat"] == "petugas") {
                $_SESSION["id"] = $row['id'];
                $_SESSION["nama"] = $row['nama'];
                $_SESSION["petugas"] = true;
                header('Location: ../petugas.php');
                exit;
                // } else if ($row["tingkat"] == "siswa") {
                //     $_SESSION["id"] = $row['id'];
                //     $_SESSION["nama"] = $row['nama'];
                //     $_SESSION["tingkat"] = "siswa";
                //     header('Location: ../siswa.php');
                //     exit;
            } else {
                header('Location: ../index.php');
                exit;
            }
        }
    }
    $error = true;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk akun</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        a {
            color: #333;
        }

        input[type=password],
        input[type=email] {
            border: 0;
            height: 38px;
            width: 100%;
            font-family: "Poppins", Arial, Helvetica, sans-serif;
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
    <form action="" method="POST" style="margin: auto; width: 90%; margin-top: 150px">

        <?php if (isset($error)) : ?>
            <div class="info info-merah">Email/Kata sandi salah</div>
        <?php endif; ?>

        <table>
            <tr>
                <td colspan="2">
                    <span id="aksi">
                        <p class="h2">Masuk akun</p>
                        <a href="../index.php">Halaman utama</a>
                    </span>
                </td>
            </tr>
            <tr>
                <td><label for="email">Email</label></td>
                <td><input type="email" name="email" class="input-form" id="email" placeholder="Masukkan email!" required autocomplete="off"></td>
            </tr>
            <tr>
                <td><label for="kata_sandi">Kata sandi</label></td>
                <td>
                    <input type="password" name="kata_sandi" class="input-form password" id="kata_sandi" placeholder="Masukkan kata sandi!" required autocomplete="off">
                    <br>
                    <input type="checkbox" onclick="lihatPassword()"><label style="font-size:14px; color: #333;">Lihat password</label>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;"><button type="submit" class="hijau" name="masuk">Masuk</button></td>
            </tr>
        </table>
    </form>

    <script>
        function lihatPassword() {
            var x = document.getElementById("kata_sandi");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</body>

</html>