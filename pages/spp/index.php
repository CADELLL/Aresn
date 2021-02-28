<?php
include_once('../layouts/navbar.php');

$no = 1;
$spp = query("SELECT * FROM spp");

include_once('../layouts/sidebar.php');
?>

<table class="table">
    <tr>
        <td colspan="4">
            <span id="action">
                <h2>Daftar SPP</h2>
                <a href="create.php" class="badge green">Tambah</a>
            </span>
        </td>
    </tr>
    <tr>
        <td>No</td>
        <td>Tahun</td>
        <td>Nominal</td>
        <td>Pengaturan</td>
    </tr>
    <?php foreach ($spp as $s) : ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $s['tahun']; ?></td>
            <td><?= $s['nominal']; ?></td>
            <td>
                <a href="update.php?i=<?= $s['id'] ?>" class="badge yellow">Ubah</a>
                <a href="delete.php?i=<?= $s['id'] ?>" class="badge red" onclick="return confirm('Apakah yakin menghapus data SPP tahun <?= $s['tahun'] ?>?')">Hapus</a>
            </td>
        </tr>
    <?php endforeach; ?>
    <?php if ($spp == []) : ?>
        <div class="info info-red">Data tidak ada!</div>
    <?php endif; ?>
</table>

<?php include_once('../layouts/footer.php'); ?>