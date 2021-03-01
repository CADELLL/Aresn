<?php
include_once('layouts/navbar.php');
include_once('layouts/sidebar.php');

$siswa = query("SELECT * FROM siswa");
$pengguna = query("SELECT * FROM pengguna");
$kelas = query("SELECT * FROM kelas");
$pembayaran = query("SELECT * FROM pembayaran");
?>

<h2>Informasi Singkat</h2>
<section id="short">
    <a href="student" class="card">
        Jumlah Siswa
        <p class="total">
            <?= count($siswa); ?>
        </p>
    </a>
    <a href="user" class="card">
        Jumlah Pengguna
        <p class="total">
            <?= count($pengguna); ?>
        </p>
    </a>
    <a href="class" class="card">
        Jumlah Kelas
        <p class="total">
            <?= count($kelas); ?>
        </p>
    </a>
    <a href="payment" class="card">
        Jumlah Pembayaran
        <p class="total">
            <?= count($pembayaran); ?>
        </p>
    </a>
</section>

<table class="table">
    <tr>
        <td>
            <h3>
                SMKN 1 KEPANJEN</br>
                STRUKTUR PEMBAYARAN SPP
            </h3>
        </td>
    </tr>
    <tr>
        <td>
            <hr>
        </td>
    </tr>
    <tr>
        <td>
            Nama : Hafid Ardiansyah</br>
            NISN : 23443223213</br>
            Kelas : XII RPL 3
        </td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <tr>
        <td>Bulan sudah dibayar: Agustus, Juli</td>
    </tr>
    <tr>
        <td>Tanggal: 15 Juli 2020</td>
    </tr>
    <tr>
        <td>Total bayar: 200</td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <tr>
        <td style="text-align:right">Malang, 25 Juli 2020</td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <tr>
        <td style="text-align:right">
            <hr style="width: 100px;">
        </td>
    </tr>
    <tr>
        <td style="text-align:right">Petugas Hafid Ardiansyah</td>
    </tr>
</table>

<?php include_once('layouts/footer.php'); ?>