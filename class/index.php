<?php
include_once('../layouts/navbar.php');

$no = 1;
$kelas = query("SELECT * FROM kelas");

include_once('../layouts/sidebar.php');
?>

<table class="table">
    <tr>
        <td colspan="4">
            <span id="action">
                <h2>Daftar Kelas</h2>
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
        <td>Kompetensi keahlian</td>
        <td>Pengaturan</td>
    </tr>
    <?php foreach ($kelas as $k) : ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $k['kelas']; ?></td>
            <td><?= $k['kompetensi_keahlian']; ?></td>
            <td>
                <a href="update.php?i=<?= $k['id'] ?>" class="badge yellow">Ubah</a>
                <a href="delete.php?i=<?= $k['id'] ?>" class="badge red" onclick="return confirm('Apakah yakin menghapus data kelas <?= $k['kelas'] ?>?')">Hapus</a>
            </td>
        </tr>
    <?php endforeach; ?>
    <?php if ($kelas == []) : ?>
        <div class="info info-red">Data tidak ada!</div>
    <?php endif; ?>
</table>

<?php include_once('../layouts/footer.php'); ?>