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

$id = $_GET['i'] == '' ? header('Location: index.php') : $_GET['i'];

$pembayaran = query("SELECT *,
                    pembayaran.id AS id_pembayaran, 
                    siswa.nama AS nama_siswa 
                FROM pembayaran
                JOIN siswa ON siswa.nisn = pembayaran.nisn
                JOIN kelas ON kelas.id = siswa.id_kelas
                JOIN spp ON spp.id = siswa.id_spp
                JOIN pengguna ON pengguna.id = pembayaran.id_petugas
                WHERE pembayaran.id = $id")[0];
?>

<table class="table">
    <tr>
        <td colspan="2">
            <span id="action">
                <h2>Detail Pembayaran</h2>
                <a href="index.php" class="badge grey">Kembali</a>
            </span>
        </td>
    </tr>
    <tr>
        <td class="text-bold">Nama petugas</td>
        <td><?= $pembayaran['nama']; ?></td>
    </tr>
    <tr>
        <td class="text-bold">Nama siswa</td>
        <td><?= $pembayaran['nama_siswa']; ?></td>
    </tr>
    <tr>
        <td class="text-bold">NISN (+00)</td>
        <td><?= $pembayaran['nisn']; ?></td>
    </tr>
    <tr>
        <td class="text-bold">NIS</td>
        <td><?= $pembayaran['nis']; ?></td>
    </tr>
    <tr>
        <td class="text-bold">Kelas</td>
        <td><?= $pembayaran['kelas']; ?></td>
    </tr>
    <tr>
        <td class="text-bold">Alamat</td>
        <td><?= $pembayaran['alamat']; ?></td>
    </tr>
    <tr>
        <td class="text-bold">No telepon (+62)</td>
        <td><?= $pembayaran['no_telepon']; ?></td>
    </tr>
    <tr>
        <td class="text-bold">Tanggal bayar</td>
        <td><?= $pembayaran['tanggal_bayar']; ?></td>
    </tr>
    <tr>
        <td class="text-bold">Bulan dibayar</td>
        <td><?= $pembayaran['bulan_dibayar']; ?></td>
    </tr>
    <tr>
        <td class="text-bold">Tahun dibayar</td>
        <td><?= $pembayaran['tahun_dibayar']; ?></td>
    </tr>
    <tr>
        <td class="text-bold">SPP</td>
        <td>Tahun. <?= $pembayaran['tahun']; ?> - Rp. <?= rupiah($pembayaran['nominal']); ?></td>
    </tr>
    <tr>
        <td class="text-bold">Jumlah bayar</td>
        <td>Rp. <?= rupiah($pembayaran['jumlah_bayar']); ?></td>
    </tr>
</table>

<?php include_once('../layouts/footer.php'); ?>