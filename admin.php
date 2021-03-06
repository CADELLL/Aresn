<?php
include_once('pages/layout/navbar.php');
include_once('pages/layout/sidebar.php');

// check level
if (!isset($_SESSION["admin"])) {
    echo "
		<script>
            alert('Tidak dapat mengakses fitur ini!');
            window.history.back();
		</script>
		";
    exit;
}

$siswa = query("SELECT * FROM siswa");
$pengguna = query("SELECT * FROM pengguna");
$kelas = query("SELECT * FROM kelas");
$pembayaran = query("SELECT * FROM pembayaran");
$spp = query("SELECT * FROM spp");
?>

<h2>Informasi Singkat</h2>
<section id="short">
    <a href="pages/student" class="card">
        Daftar Siswa
        <p class="total">
            <?= count($siswa); ?>
        </p>
    </a>
    <a href="pages/payment" class="card">
        Daftar Pembayaran
        <p class="total">
            <?= count($pembayaran); ?>
        </p>
    </a>
</section>

<section id="short">
    <a href="pages/spp" class="card">
        Daftar SPP
        <p class="total">
            <?= count($spp); ?>
        </p>
    </a>
    <a href="pages/user" class="card">
        Daftar Pengguna
        <p class="total">
            <?= count($pengguna); ?>
        </p>
    </a>
    <a href="pages/class" class="card">
        Daftar Kelas
        <p class="total">
            <?= count($kelas); ?>
        </p>
    </a>
</section>

<?php include_once('pages/layout/footer.php'); ?>