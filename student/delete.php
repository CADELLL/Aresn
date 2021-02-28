<?php
require '../functions.php';

// check sesssion
if (!isset($_SESSION['tingkat'])) {
	header('Location: ../auth/login.php');
	exit;
}

// check level
if ($_SESSION['tingkat'] != 'admin') {
	echo "
		<script>
            alert('Tidak dapat mengakses fitur ini!');
            window.history.back();
		</script>
		";
	exit;
}

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
