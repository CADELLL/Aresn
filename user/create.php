<?php
include_once('../layouts/navbar.php');

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
    if (createUser($_POST) > 0) {
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

include_once('../layouts/sidebar.php');
?>

<form action="" method="POST">
    <table class="table">
        <tr>
            <td colspan="2">
                <span id="action">
                    <h2>Tambah Pengguna</h2>
                    <a href="index.php" class="href">Kembali</a>
                </span>
            </td>
        </tr>
        <tr>
            <td><label for="nama">Nama pengguna</label></td>
            <td><input type="text" name="nama" class="input-form" id="nama" placeholder="Masukkan nama pengguna!" autocomplete="off" autofocus required></td>
        </tr>
        <tr>
            <td><label for="email">Email</label></td>
            <td><input type="email" name="email" class="input-form" id="email" placeholder="Masukkan email!" autocomplete="off" required></td>
        </tr>
        <tr>
            <td><label for="kata_sandi">Kata sandi</label></td>
            <td><input type="text" name="kata_sandi" class="input-form" id="kata_sandi" placeholder="Masukkan kata sandi!" autocomplete="off" min="3" required></td>
        </tr>
        <tr>
            <td><label for="tingkat">Tingkat</label></td>
            <td>
                <select name="tingkat" id="tingkat" class="input-form">
                    <option value="admin">Admin</option>
                    <option value="petugas">Petugas</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="center"><button type="submit" name="create" class="button green">Tambah</button></td>
        </tr>
    </table>
</form>

<?php include_once('../layouts/footer.php'); ?>