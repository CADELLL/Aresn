<?php
include_once('pages/layout/navbar.php');
include_once('pages/layout/sidebar.php');

if (isset($_SESSION["admin"])) {
    echo "
		<script>
            alert('Tidak dapat mengakses fitur ini!');
            document.location.href = 'admin.php';
		</script>
		";
    exit;
}

if (isset($_SESSION["officer"])) {
    echo "
		<script>
            alert('Tidak dapat mengakses fitur ini!');
            document.location.href = 'officer.php';
		</script>
		";
    exit;
}

$siswa = query("SELECT * FROM siswa");
$pengguna = query("SELECT * FROM pengguna");
$kelas = query("SELECT * FROM kelas");
$pengumuman = query("SELECT * FROM pengumuman ORDER BY id DESC");
?>

<h2>Informasi Singkat</h2>
<section id="short">
    <a href="pages/student" class="card">
        Daftar Siswa
        <p class="total">
            <?= count($siswa); ?>
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

<h2>Pengumuman</h2>
<table class="table">
    <tr>
        <th>No</th>
        <th>Judul</th>
        <th>Tanggal</th>
        <th>Pengaturan</th>
    </tr>
    <?php $no = 1; ?>
    <?php foreach ($pengumuman as $p) : ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $p['judul'] ?></td>
            <td><?= $p['tanggal'] ?></td>
            <td><a href="pdf.php?i=<?= $p['id']; ?>" class="badge green">File PDF</a></td>
        </tr>
    <?php endforeach; ?>
</table>


<?php include_once('pages/layout/footer.php'); ?>