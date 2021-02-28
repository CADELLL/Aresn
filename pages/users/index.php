<?php
include_once('../layouts/navbar.php');

$no = 1;
$pengguna = query("SELECT * FROM pengguna");

include_once('../layouts/sidebar.php');
?>

<table class="table">
    <tr>
        <td colspan="6">
            <span id="action">
                <h2>Daftar Pengguna</h2>
                <a href="add.php" class="badge green">Tambah</a>
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
                <a href="edit.php?i=<?= $p['id'] ?>" class="badge yellow">Ubah</a>
                <a href="delete.php?i=<?= $p['id'] ?>" class="badge red" onclick="return confirm('Apakah yakin menghapus data kelas <?= $k['kelas'] ?>?')">Hapus</a>
            </td>
        </tr>
    <?php endforeach; ?>
    <?php if ($pengguna == []) : ?>
        <div class="info info-red">Data tidak ada!</div>
    <?php endif; ?>
</table>

<?php include_once('../layouts/footer.php'); ?>