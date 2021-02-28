<?php
include_once('../layouts/navbar.php');

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
$pembayaran = query("SELECT *,
                        pembayaran.id AS id_pembayaran, 
                        siswa.nama AS nama_siswa FROM pembayaran
                    JOIN siswa ON siswa.nisn = pembayaran.nisn
                    JOIN pengguna ON pengguna.id = pembayaran.id_petugas
                    JOIN spp ON spp.id = pembayaran.id_spp");

include_once('../layouts/sidebar.php');
?>

<table class="table">
    <tr>
        <td colspan="10">
            <span id="action">
                <h2>Daftar Pembayaran</h2>
                <div>
                    <a href="pdf.php" class="badge grey">File PDF</a>
                    <a href="create.php" class="badge green">Tambah</a>
                </div>
            </span>
        </td>
    </tr>
    <tr>
        <td>No</td>
        <td>Petugas</td>
        <td>Siswa</td>
        <th>NISN</th>
        <td>Tanggal</td>
        <td>Bulan</td>
        <td>Tahun</td>
        <td>SPP</td>
        <td>Jumlah</td>
        <td>Pengaturan</td>
    </tr>
    <?php foreach ($pembayaran as $p) : ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $p['nama']; ?></td>
            <td><?= $p['nama_siswa']; ?></td>
            <td><?= $p['nisn']; ?></td>
            <td><?= $p['tanggal_bayar']; ?></td>
            <td><?= $p['bulan_dibayar']; ?></td>
            <td><?= $p['tahun_dibayar']; ?></td>
            <td>Tahun <?= $p['tahun'] ?> <br>Nominal Rp. <?= rupiah($p['nominal']) ?></td>
            <td>Rp. <?= rupiah($p['jumlah_bayar']); ?></td>
            <td>
                <a href="update.php?i=<?= $p['id_pembayaran'] ?>" class="badge yellow block-mb-5">Ubah</a>
                <a href="delete.php?i=<?= $p['id_pembayaran'] ?>" class="badge red block-mb-5" onclick="return confirm('Apakah yakin menghapus data pembayaran siswa <?= $p['nama_siswa'] ?>?')">Hapus</a>
            </td>
        </tr>
    <?php endforeach; ?>
    <?php if ($pembayaran == []) : ?>
        <div class="info info-red">Data tidak ada!</div>
    <?php endif; ?>
</table>

<?php include_once('../layouts/footer.php'); ?>