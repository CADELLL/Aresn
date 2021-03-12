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

if (isset($_POST['create'])) {
    if (createAnnouncement($_POST) > 0) {
        echo "
        <script>
    		alert('Data berhasil ditambahkan!');
    		document.location.href = 'index.php';
    	</script>
        ";
    } else {
        echo "
        <script>
    		alert('Data gagal ditambahkan!');
    		document.location.href = 'index.php';
    	</script>
        ";
    }
}
?>

<form action="" method="POST">
    <table class="table">
        <tr>
            <td colspan="2">
                <span id="action">
                    <h2>Tambah Pengumuman</h2>
                    <a href="index.php" class="badge grey">Kembali</a>
                </span>
            </td>
        </tr>
        <tr>
            <td><label class="text-bold" for="judul">Judul</label></td>
            <td><input type="text" name="judul" class="input-form" id="judul" placeholder="Masukkan judul!" autocomplete="off" required></td>
        </tr>
        <tr>
            <td><label class="text-bold" for="pembuka">Pembuka</label></td>
            <td>
                <textarea name="pembuka" id="pembuka" cols="30" rows="10" class="input-form" placeholder="Masukkan pembuka!"></textarea>
            </td>
        </tr>
        <tr>
            <td><label class="text-bold" for="isi">Isi</label></td>
            <td>
                <textarea name="isi" id="isi" cols="30" rows="10" class="input-form" placeholder="Masukkan isi!"></textarea>
            </td>
        </tr>
        <tr>
            <td><label class="text-bold" for="penutup">penutup</label></td>
            <td>
                <textarea name="penutup" id="penutup" cols="30" rows="10" class="input-form" placeholder="Masukkan penutup!"></textarea>
            </td>
        </tr>
        <tr>
            <td><label class="text-bold" for="tanggal">Tanggal</label></td>
            <td><input type="date" name="tanggal" class="input-form" id="tanggal" required></td>
        </tr>
        <tr>
            <td colspan="2" class="center"><button type="submit" name="create" class="button green">Tambah</button></td>
        </tr>
    </table>
</form>

<?php include_once('../layout/footer.php'); ?>