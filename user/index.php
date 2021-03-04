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

$totalData = queryPagination("SELECT * FROM pengguna 
                        WHERE nama LIKE '%$keyword%' OR
                            email LIKE '%$keyword%' OR
                            kata_sandi LIKE '%$keyword%'
                        ORDER BY tingkat ASC");
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

$pengguna = mysqli_query($conn, "SELECT * FROM pengguna 
                        WHERE nama LIKE '%$keyword%' OR
                            email LIKE '%$keyword%' OR
                            kata_sandi LIKE '%$keyword%'
                        ORDER BY tingkat ASC
                        LIMIT $startData, $limit");
// data no
$no = numberData($limit, $curretPage);
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
            <td><?= $no++;  ?></td>
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