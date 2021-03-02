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

$nisn = $_GET['n'] == '' ? header('Location: index.php') : $_GET['n'];

$siswa = query("SELECT * FROM siswa
                JOIN kelas ON siswa.id_kelas = kelas.id
                WHERE nisn = $nisn")[0];
?>

<table class="table">
    <tr>
        <td colspan="2">
            <span id="action">
                <h2>Detail Siswa</h2>
                <a href="index.php" class="badge grey">Kembali</a>
            </span>
        </td>
    </tr>
    <tr>
        <td class="text-bold">NISN (+00)</td>
        <td><?= $siswa['nisn']; ?></td>
    </tr>
    <tr>
        <td class="text-bold">NIS</td>
        <td><?= $siswa['nis']; ?></td>
    </tr>
    <tr>
        <td class="text-bold">Nama</td>
        <td><?= $siswa['nama']; ?></td>
    </tr>
    <tr>
        <td class="text-bold">Kelas</td>
        <td><?= $siswa['kelas']; ?></td>
    </tr>
    <tr>
        <td class="text-bold">Alamat</td>
        <td><?= $siswa['alamat']; ?></td>
    </tr>
    <tr>
        <td class="text-bold">No telepon</td>
        <td><?= $siswa['no_telepon']; ?></td>
    </tr>

    <?php if ($siswa == []) : ?>
        <div class="info info-red">Data tidak ada!</div>
    <?php endif; ?>
</table>

<?php include_once('../layouts/footer.php'); ?>