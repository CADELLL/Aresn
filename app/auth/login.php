<?php
session_start();

if (isset($_SESSION["level"]) != "") {
    echo "
    <script>
        alert('Tidak dapat mengakses fitur ini!');
        window.history.back();
    </script>
    ";
    exit;
}

require '../../functions.php';

if (isset($_POST["login"])) {
    $koneksi = mysqli_connect("localhost", "root", "", "db_spp");

    $email = $_POST["email"];
    $password = $_POST["password"];

    $hasil = mysqli_query($koneksi, "SELECT * FROM tb_users WHERE email = '$email'");

    // cek email
    if (mysqli_num_rows($hasil) === 1) {

        // cek password
        $row = mysqli_fetch_assoc($hasil);

        if ($password == $row["password"]) {
            if ($row["tingkat"] == "admin") {
                $_SESSION["id"] = $row['id'];
                $_SESSION["name"] = $row['name'];
                $_SESSION["level"] = "admin";
                header('Location: ../admin');
                exit;
            } else if ($row["tingkat"] == "petugas") {
                $_SESSION["id"] = $row['id'];
                $_SESSION["name"] = $row['name'];
                $_SESSION["level"] = "officer";
                header('Location: ../petugas');
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
    <link rel="stylesheet" href="../../style2.css">
</head>

<body>
    <div id="container">
        <form action="" method="POST">

            <?php if (isset($error)) : ?>
                <div class="info info-merah">Email/Kata sandi salah</div>
            <?php endif; ?>

            <table class="table">
                <tr>
                    <td colspan="2">
                        <span class="action">
                            <h2>Masuk akun</h2>
                            <a href="../../index.php">Halaman utama</a>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td><label for="email">Email</label></td>
                    <td><input type="email" name="email" class="input-form" id="email" placeholder="Masukkan email!" required autocomplete="off"></td>
                </tr>
                <tr>
                    <td><label for="password">Kata sandi</label></td>
                    <td>
                        <input type="password" name="password" class="input-form password" id="password" placeholder="Masukkan kata sandi!" required autocomplete="off">
                        <br>
                        <input type="checkbox" onclick="readPassword()"><label>Lihat password</label>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;"><button type="submit" class="button green" name="login">Masuk</button></td>
                </tr>
            </table>
        </form>
    </div>

    <script>
        function readPassword() {
            var x = document.getElementById("password");

            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</body>

</html>