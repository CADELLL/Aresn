<?php
require '../../functions.php';

if (isset($_SESSION['tingkat']) != 'admin') {
	echo "
		<script>
            alert('Tidak dapat mengakses fitur ini!');
            window.history.back();
		</script>
		";
	exit;
}

// get & check value
$id = $_GET['i'] == '' ? header('Location: index.php') : $_GET['i'];

if (deleteClass($id) > 0) {
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
