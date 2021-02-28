<?php
include_once('../layouts/navbar.php');

// check sesssion
if (!isset($_SESSION['tingkat'])) {
    header('Location: ../auth/login.php');
    exit;
}

// check level
if ($_SESSION['tingkat'] != 'admin') {
    echo "
		<script>
            alert('Tidak dapat mengakses fitur ini!');
            window.history.back();
		</script>
		";
    exit;
}

$no = 1;
$pengguna = query("SELECT * FROM pengguna");

include_once('../layouts/sidebar.php');
?>

<table class="table">
    <tr>
        <td colspan="6">
            <span id="action">
                <h2>Daftar Pengguna</h2>
                <div>
                    <a href="pdf.php" class="badge grey">File PDF</a>
                    <a href="create.php" class="badge green">Tambah</a>
                </div>
            </span>
        </td>
    </tr>
    <tr>
        <td>No</td>
        <td>Nama</td>
        <td>Email</td>
        <td>Kata sandi</td>
        <td>Tingkat</td>
        <td>Pengaturan</td>
    </tr>
    <?php foreach ($pengguna as $p) : ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $p['nama']; ?></td>
            <td><?= $p['email']; ?></td>
            <td><?= $p['kata_sandi']; ?></td>
            <td><?= $p['tingkat']; ?></td>
            <td>
                <a href="update.php?i=<?= $p['id'] ?>" class="badge yellow">Ubah</a>
                <a href="delete.php?i=<?= $p['id'] ?>" class="badge red" onclick="return confirm('Apakah yakin menghapus data user <?= $p['nama'] ?>?')">Hapus</a>
            </td>
        </tr>
    <?php endforeach; ?>
    <?php if ($pengguna == []) : ?>
        <div class="info info-red">Data tidak ada!</div>
    <?php endif; ?>
</table>

<?php include_once('../layouts/footer.php'); ?>