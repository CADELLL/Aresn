<?php
session_start();
// if (isset($_SESSION["level"]) != "admin") {
//     echo "
// 		<script>
//             alert('Tidak dapat mengakses fitur ini!');
//             window.history.back();
// 		</script>
// 	    ";
//     exit;
// }

include_once('../layouts/navbar.php');
include_once('../layouts/sidebar.php');
?>

<h1>Komponen</h1>
<h3>Table dan Input</h3>

<table class="table">
    <tr>
        <th colspan="2">
            <h3>Tabel dan Input</h3>
        </th>
    </tr>
    <tr>
        <td>Nama</td>
        <td>
            <input type="text" class="input-form" placeholder="Masukkan nama!" required>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align:center">
            <button class="button green">Tambah</button>
        </td>
    </tr>
</table>

<h3>Lencana</h3>
<a href="#" class="badge green">Hijau</a>
<a href="#" class="badge yellow">Kuning</a>
<a href="#" class="badge red">Merah</a>
<a href="#" class="badge grey">Abu-abu</a>

<h3>Tombol</h3>
<button class="button green">Hijau</button>
<button class="button yellow">Kuning</button>
<button class="button red">Merah</button>
<button class="button grey">Abu-abu</button>

<?php include_once('../layouts/footer.php'); ?>