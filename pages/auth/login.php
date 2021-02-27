<?php
session_start();

if (isset($_SESSION["tingkat"]) != "") {
    echo "
    <script>
        alert('Tidak dapat mengakses fitur ini!');
        window.history.back();
    </script>
    ";
    exit;
}

if (isset($_POST["login"])) {
    $conn = mysqli_connect("localhost", "root", "", "spp");

    $email = $_POST["email"];
    $kataSandi = $_POST["kataSandi"];

    $results = mysqli_query($conn, "SELECT * FROM pengguna WHERE email = '$email'");

    // cek email
    if (mysqli_num_rows($results) === 1) {

        // cek kataSandi
        $row = mysqli_fetch_assoc($results);

        if ($kataSandi == $row["kataSandi"]) {
            if ($row["tingkat"] == "admin") {
                $_SESSION["id"] = $row['id'];
                $_SESSION["nama"] = $row['nama'];
                $_SESSION["tingkat"] = "admin";
                header('Location: ../admin');
            } else if ($row["tingkat"] == "petugas") {
                $_SESSION["id"] = $row['id'];
                $_SESSION["nama"] = $row['nama'];
                $_SESSION["tingkat"] = "petugas";
                header('Location: ../petugas');
            } else {
                header('Location: ../index.php');
            }
        }
    }

    $info = true;
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

            <?php if (isset($info)) : ?>
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
                    <td><label for="kataSandi">Kata sandi</label></td>
                    <td>
                        <input type="password" name="kataSandi" class="input-form" id="kataSandi" placeholder="Masukkan kata sandi!" required autocomplete="off">
                        <br>
                        <input type="checkbox" onclick="showPassword()"><label>Lihat password</label>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;"><button type="submit" class="button green" name="login">Masuk</button></td>
                </tr>
            </table>
        </form>
    </div>

    <script>
        function showPassword() {
            let result = document.getElementById("kataSandi");

            if (result.type === "password") {
                result.type = "text";
            } else {
                result.type = "password";
            }
        }
    </script>
</body>

</html>