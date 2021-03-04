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

$id_kelas = $_GET['i'] == '' ? header('Location: index.php') : $_GET['i'];

$kelas = query("SELECT * FROM kelas WHERE id = $id_kelas")[0];
$totalData = queryPagination("SELECT * FROM siswa WHERE id_kelas = $id_kelas ORDER BY nama ASC");

// pagination
$limit = 10;
$totalPage = ceil($totalData / $limit);
// convert high value to number of rounds
$activePage = (isset($_GET['page'])) ? $_GET['page'] : 1;
$curretPage = $activePage ? $activePage : 1;
$startData = ($activePage * $limit) - $limit;

$link = 2;
$startNumber = startNumber($activePage, $link);
$endNumber = endNumber($activePage, $link, $totalPage);

$siswa = query("SELECT * FROM siswa WHERE id_kelas = $id_kelas ORDER BY nama ASC");

// data no
$no = numberData($limit, $curretPage);
?>

<table class="table">
    <tr>
        <td colspan="10">
            <span id="action">
                <h2>Kelas <?= $kelas['kelas']; ?></h2>
                <div>
                    <a href="index.php" class="badge grey">Kembali</a>
                    <a href="pdf_siswa.php?i=<?= $id_kelas ?>" class="badge green">File PDF</a>
                </div>
            </span>
        </td>
    </tr>
    <tr>
        <th>No</th>
        <th>NISN (+00)</th>
        <th>NIS</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>No telepon</th>
    </tr>
    <?php foreach ($siswa as $s) : ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $s['nisn']; ?></td>
            <td><?= $s['nis']; ?></td>
            <td><?= $s['nama']; ?></td>
            <td><?= $s['alamat']; ?></td>
            <td><?= $s['no_telepon']; ?></td>
        </tr>
    <?php endforeach; ?>
    <?php if ($siswa == []) : ?>
        <div class="info info-red">Data siswa tidak ada!</div>
    <?php endif; ?>
</table>

<div class="pagination">
    <a href="?page=1" class="badge grey">Awal</a>

    <?php if ($activePage > 1) : ?>
        <a href="?page=<?= $activePage - 1; ?>"><i class='bx bx-caret-left badge grey'></i></a>
    <?php endif; ?>

    <?php for ($i = $startNumber; $i <= $endNumber; $i++) : ?>
        <?php if ($i == $activePage) : ?>
            <a href="?page=<?= $i; ?>" class="badge green"><?= $i; ?></a>
        <?php else : ?>
            <a href="?page=<?= $i; ?>" class="badge grey"><?= $i; ?></a>
        <?php endif; ?>
    <?php endfor; ?>

    <?php if ($activePage < $totalPage) : ?>
        <a href="?page=<?= $activePage + 1; ?>"><i class='bx bx-caret-right badge grey'></i></a>
    <?php endif; ?>

    <a href="?page=<?= $totalPage; ?>" class="badge grey">Akhir</a>
</div>

<?php include_once('../layouts/footer.php'); ?>