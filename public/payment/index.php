<?php
include_once('../layout/navbar.php');
include_once('../layout/sidebar.php');

// check payment
if (!isset($_SESSION["payment"])) {
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

$name = $_SESSION['name'];

if (isset($_SESSION['admin'])) {
    $query = "SELECT *,
                pembayaran.id AS id_pembayaran, 
                siswa.nama AS nama_siswa 
            FROM pembayaran
            JOIN siswa ON siswa.nisn = pembayaran.nisn
            JOIN pengguna ON pengguna.id = pembayaran.id_petugas
            WHERE siswa.nama LIKE '%$keyword%' OR
                pengguna.nama LIKE '%$keyword%' OR
                pembayaran.nisn LIKE '%$keyword%' OR
                tanggal_bayar LIKE '%$keyword%' OR
                tahun_dibayar LIKE '%$keyword%' OR
                jumlah_bayar LIKE '%$keyword%' OR
                bulan_dibayar LIKE '%$keyword%'
            ORDER BY id_pembayaran DESC";
} else {
    $query = "SELECT *,
                pembayaran.id AS id_pembayaran, 
                siswa.nama AS nama_siswa 
            FROM pembayaran
            JOIN siswa ON siswa.nisn = pembayaran.nisn
            JOIN pengguna ON pengguna.id = pembayaran.id_petugas
            WHERE pengguna.nama = '$name'
            ORDER BY id_pembayaran DESC";
}


$totalData = queryPagination($query);
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

$pembayaran = mysqli_query($conn, $query . " LIMIT $startData, $limit");

// data no
$no = numberData($limit, $curretPage);
?>

<table class="table">
    <tr>
        <td colspan="10">
            <span id="action">
                <h2>Daftar Pembayaran</h2>
                <div>
                    <a href="pdf.php" class="badge <?= isset($_SESSION['admin']) ? 'green' : 'grey' ?>">File PDF</a>
                    <?php if (isset($_SESSION['officer'])) : ?>
                        <a href="create.php" class="badge green">Tambah</a>
                    <?php endif; ?>
                </div>
            </span>
        </td>
    </tr>
    <tr>
        <th>No</th>
        <th>Petugas</th>
        <th>Siswa</th>
        <th>NISN (+00)</th>
        <th>Tanggal</th>
        <th>Bulan</th>
        <th>Tahun</th>
        <th>Jumlah bayar</th>
        <th>Pengaturan</th>
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
            <td>Rp. <?= rupiah($p['jumlah_bayar']); ?></td>
            <td>
                <a href="detail.php?i=<?= $p['id_pembayaran'] ?>" class="badge grey">Detail</a>
                <?php if (isset($_SESSION['officer'])) : ?>
                    <a href="update.php?i=<?= $p['id_pembayaran'] ?>" class="badge yellow">Ubah</a>
                    <a href="delete.php?i=<?= $p['id_pembayaran'] ?>" class="badge red" onclick="return confirm('Apakah yakin menghapus data pembayaran siswa <?= $p['nama_siswa'] ?>?')">Hapus</a>
                <?php endif; ?>
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

<?php include_once('../layout/footer.php'); ?>