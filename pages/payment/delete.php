<?php
session_start();
// check payment
if (!isset($_SESSION["officer"])) {
	echo "
		<script>
            alert('Tidak dapat mengakses fitur ini!');
            window.history.back();
		</script>
		";
	exit;
}

require '../../functions.php';

// get & check value
$id = $_GET['i'] == '' ? header('Location: index.php') : $_GET['i'];

if (deletePayment($id) > 0) {
	echo "
		<script>
			alert('Data berhasil dihapus!');
			document.location.href = 'index.php';
		</script>
		";
} else {
	echo "
		<script>
			alert('Data gagal dihapus!');
			document.location.href = 'index.php';
		</script>
		";
}
