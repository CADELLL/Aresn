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
?>

<form action="detail.php" method="POST">
    <table class="table">
        <tr>
            <td colspan="2">
                <span id="action">
                    <h2>Cek Pembayaran</h2>
                </span>
            </td>
        </tr>
        <tr>
            <td><label for="nisn">NISN</label></td>
            <td><input type="text" name="nisn" class="input-form" id="nisn" placeholder="Masukkan NISN!" autocomplete="off" required></td>
        </tr>
        <tr>
            <td colspan="2" class="center"><button type="submit" class="button green">Cek NISN</button></td>
        </tr>
    </table>
</form>

<?php include_once('../layouts/footer.php'); ?>