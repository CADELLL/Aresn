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

if (isset($_POST['search'])) {
    $keyword = $_POST['keyword'];
} else {
    $keyword = '';
}

$totalData = queryPagination("SELECT * FROM spp WHERE 
                            tahun LIKE '%$keyword%' OR
                            nominal LIKE '%$keyword%'
                            ORDER BY tahun DESC");
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

$spp = mysqli_query($conn, "SELECT * FROM spp WHERE 
                                tahun LIKE '%$keyword%' OR
                                nominal LIKE '%$keyword%'
                                ORDER BY tahun DESC
                                LIMIT $startData, $limit");
// data no
$no = numberData($limit, $curretPage);
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
        <th>No</th>
        <th>Tahun</th>
        <th>Nominal</th>
        <th>Pengaturan</th>
    </tr>
    <?php foreach ($spp as $s) : ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $s['tahun']; ?></td>
            <td>Rp. <?= rupiah($s['nominal']); ?></td>
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