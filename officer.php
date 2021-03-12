<?php
include_once('pages/layout/navbar.php');
include_once('pages/layout/sidebar.php');

// check level
if (!isset($_SESSION["officer"])) {
    echo "
		<script>
            alert('Tidak dapat mengakses fitur ini!');
            window.history.back();
		</script>
		";
    exit;
}

$siswa = query("SELECT * FROM siswa");
$pengguna = query("SELECT * FROM pengguna");
$kelas = query("SELECT * FROM kelas");
$pembayaran = query("SELECT * FROM pembayaran");
$spp = query("SELECT * FROM spp");
$totalPengumuman = query("SELECT * FROM pengumuman");

if (isset($_POST['search'])) {
    $keyword = $_POST['keyword'];
} else {
    $keyword = '';
}

$totalData = queryPagination("SELECT * FROM pengumuman 
                                WHERE judul LIKE '%$keyword%' OR
                                    tanggal LIKE '%$keyword%'
                                ORDER BY tanggal DESC");
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

$pengumuman = mysqli_query($conn, "SELECT * FROM pengumuman 
                                    WHERE judul LIKE '%$keyword%' OR
                                        tanggal LIKE '%$keyword%'
                                    ORDER BY tanggal DESC LIMIT $startData, $limit");
// data no
$no = numberData($limit, $curretPage);
?>

<h2>Informasi Singkat</h2>
<section id="short">
    <a href="pages/student" class="card">
        Daftar Siswa
        <p class="total">
            <?= count($siswa); ?>
        </p>
    </a>
    <a href="pages/class" class="card">
        Daftar Kelas
        <p class="total">
            <?= count($kelas); ?>
        </p>
    </a>
    <a href="pages/payment" class="card">
        Daftar Pembayaran
        <p class="total">
            <?= count($pembayaran); ?>
        </p>
    </a>
</section>

<section id="short">
    <a href="pages/spp" class="card">
        Daftar SPP
        <p class="total">
            <?= count($spp); ?>
        </p>
    </a>
    <a href="pages/user" class="card">
        Daftar Pengguna
        <p class="total">
            <?= count($pengguna); ?>
        </p>
    </a>
    <a href="pages/announcement" class="card">
        Daftar Pengumuman
        <p class="total">
            <?= count($totalPengumuman); ?>
        </p>
    </a>
</section>

<br>
<h2>Pengumuman</h2>
<table class="table">
    <tr>
        <th>No</th>
        <th>Judul</th>
        <th>Tanggal</th>
        <th>Pengaturan</th>
    </tr>
    <?php $no = 1; ?>
    <?php foreach ($pengumuman as $p) : ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $p['judul'] ?></td>
            <td><?= $p['tanggal'] ?></td>
            <td>
                <a href="pdf.php?i=<?= $p['id']; ?>" class="badge green">Unduh</a>
            </td>
        </tr>
    <?php endforeach; ?>
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
<?php include_once('pages/layout/footer.php'); ?>