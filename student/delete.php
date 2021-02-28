<?php
require '../functions.php';

// get & check value
$nisn = $_GET['n'] == '' ? header('Location: index.php') : $_GET['n'];

if (deleteStudent($nisn) > 0) {
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
