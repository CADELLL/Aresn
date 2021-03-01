<?php
include_once('../layouts/navbar.php');
include_once('../layouts/sidebar.php');

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

$no = 1;
$pengguna = query("SELECT * FROM pengguna");

if (isset($_POST['search'])) {
    $pengguna = searchUser($_POST['keyword']);
}
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
        <th>No</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Kata sandi</th>
        <th>Tingkat</th>
        <th>Pengaturan</th>
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