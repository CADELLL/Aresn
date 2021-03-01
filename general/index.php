<?php
include_once('../layouts/navbar.php');
include_once('../layouts/sidebar.php');

// check level
if (isset($_SESSION["payment"])) {
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
                        pembayaran.id AS id_pembayaran 
                        FROM pembayaran
                    JOIN siswa ON siswa.nisn = pembayaran.nisn
                    JOIN kelas ON siswa.id_kelas = kelas.id");
?>

<table class="table">
    <tr>
        <td colspan="5">
            <span id="action">
                <h2>Daftar Pembayaran</h2>
            </span>
        </td>
    </tr>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Kelas</th>
        <th>Tanggal</th>
        <th>Pengaturan</th>
    </tr>
    <?php foreach ($pembayaran as $p) : ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $p['nama']; ?></td>
            <td><?= $p['kelas']; ?></td>
            <td><?= $p['tanggal_bayar']; ?></td>
            <td>
                <form action="detail.php" method="POST">
                    <input type="hidden" name="nisn" id="nisn">
                    <button class="button green" onclick="checkNisn()">Detail</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    <?php if ($pembayaran == []) : ?>
        <div class="info info-red">Data tidak ada!</div>
    <?php endif; ?>
</table>

<script>
    function checkNisn() {
        let nisn = prompt("Masukkan NISN!");
        if (nisn < 9999999999) {
            document.getElementById("nisn").value = nisn;
        } else if (isNaN(nisn)) {
            parseInt(prompt("Masukkan nomer NISN!"));
        } else {
            parseInt(prompt("Maksimal nomer NISN 10 digit!"));
        }
    }
</script>

<?php include_once('../layouts/footer.php'); ?>