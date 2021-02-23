<?php
session_start();

if (!isset($_SESSION["petugas"])) {
	echo "
		<script>
            alert('Tidak dapat mengakses fitur ini!');
            window.history.back();
		</script>
	";
	exit;
}

require '../functions.php';

$id = $_GET["i"];

if (hapusPembayaran($id) > 0) {
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
