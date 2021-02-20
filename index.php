<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasboard</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <nav>
        <form action="" method="POST">
            <input type="text" name="kataKunci" placeholder="Masukkan kata kunci..." autofocus autocomplete="off">
            <button type="submit" name="cari">Cari</button>
        </form>
        <a href="profil.php">Profil</a>
    </nav>

    <div id="sidebar">
        <ul>
            <li><a href="#"><span class="hide">User </span><i class='bx bx-user'></i></a></li>
            <li><a href="#"><span class="hide">User </span><i class='bx bx-user'></i></a></li>
        </ul>
    </div>

    <div id="konten">
        <section id="informasi">
            <div class="kartu siswa">
                Siswa
            </div>
            <div class="kartu pembayaran">
                Pembayaran
            </div>
            <div class="kartu kelas">
                Kelas
            </div>
            <div class="kartu pengguna">
                Pengguna
            </div>
        </section>
    </div>

    <footer>
        <a href="">Hafid Ardiansyah</a>
    </footer>
</body>

</html>