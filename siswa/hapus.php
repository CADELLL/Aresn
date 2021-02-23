<?php
session_start();
if (!isset($_SESSION["admin"])) {
	echo "
		<script>
			alert('Tidak dapat mengakses fitur!');
			document.location.href = '../index.php';
		</script>
	";
	exit;
}
require '../functions.php';

$nisn = $_GET["n"];

if (hapusSiswa($nisn) > 0) {
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
