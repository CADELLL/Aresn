<?php
include_once('../layout/navbar.php');
include_once('../layout/sidebar.php');

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

$pengumuman = query("SELECT * FROM pengumuman WHERE id = $id")[0];

?>

<a href="index.php" class="badge grey">Kembali</a>
<h3>
    SMKN 1 Kepanjen
    <br>
    Pengumuman
</h3>
<hr>
<br>

<p style="line-height: 24px;">
    <?= $pengumuman['pembuka'] ?>
    <br><br>
    <?= $pengumuman['isi'] ?>
    <br><br>
    <?= $pengumuman['penutup'] ?>
    <br><br><br>
</p>

<div style='margin-left: 70%;'>
    <div style='text-align:center;'>
        <p>Malang, <?= $pengumuman['tanggal'] ?></p>
        <br><br><br>

        <hr style='width: 200px;'>
        <p>Hafid Ardiansyah</p>
    </div>
</div>


<?php include_once('../layout/footer.php'); ?>