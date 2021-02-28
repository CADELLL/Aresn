<?php
include_once('layouts/navbar.php');

$no = 1;
$month = month();
$siswa = query("SELECT * FROM siswa");
$pengguna = query("SELECT * FROM pengguna");
$kelas = query("SELECT * FROM kelas");
$pembayaran = query("SELECT * FROM pembayaran");

include_once('layouts/sidebar.php');
?>

<h2>Informasi Singkat</h2>
<section id="short">
    <a href="siswa" class="card">
        Jumlah Siswa
        <p class="total">
            <?= count($siswa); ?>
        </p>
    </a>
    <a href="petugas" class="card">
        Jumlah Pengguna
        <p class="total">
            <?= count($pengguna); ?>
        </p>
    </a>
    <a href="kelas" class="card">
        Jumlah Kelas
        <p class="total">
            <?= count($kelas); ?>
        </p>
    </a>
    <a href="pembayaran" class="card">
        Jumlah Pembayaran
        <p class="total">
            <?= count($pembayaran); ?>
        </p>
    </a>
</section>

<table class="table">
    <tr>
        <td colspan="10">
            <span id="action">
                <h2>Daftar Tidak Lunas</h2>
                <div>
                    <input type="text" class="input-form search" name="keyword">
                    <a href="create.php" class="button green"><i class="bx bx-search"></i></a>
                </div>
            </span>
        </td>
    </tr>
    <tr>
        <td>No</td>
    </tr>
</table>

<?php include_once('layouts/footer.php'); ?>