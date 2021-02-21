<?php
require '../functions.php';

if (isset($_POST["masuk"])) {

    $email = $_POST["email"];
    $kata_sandi = $_POST["kata_sandi"];

    $result = mysqli_query($koneksi, "SELECT * FROM tb_pengguna WHERE email = '$email'");

    // cek email
    if (mysqli_num_rows($result) === 1) {

        // cek kata_sandi
        $row = mysqli_fetch_assoc($result);
        if (password_verify($kata_sandi, $row["kata_sandi"])) {
            header("Location: ../index.php");
            exit;
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
    <title>Masuk</title>
    <link rel="stylesheet" href="../style.css">
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
    </style>
</head>

<body>
    <form action="" method="POST" style="margin: auto; width: 90%; margin-top: 10%">
        <span id="aksi">
            <p class="h2">Masuk Akun</p>
            <a href="daftar.php">Belum Punya Akun?</a>
        </span>
        <?php if (isset($error)) : ?>
            <div class="info info-merah">Email / Kata Sandi Salah</div>
        <?php endif; ?>
        <table>
            <tr>
                <td><label for="email">Email</label></td>
                <td><input type="email" name="email" class="input-form" id="email" placeholder="Masukkan Email!" required autocomplete="off"></td>
            </tr>
            <tr>
                <td><label for="kata_sandi">Kata Sandi</label></td>
                <td><input type="password" name="kata_sandi" class="input-form password" id="kata_sandi" placeholder="Masukkan Kata Sandi!" required autocomplete="off"></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;"><button type="submit" class="hijau" name="masuk">Masuk</button></td>
            </tr>
        </table>
    </form>
</body>

</html>