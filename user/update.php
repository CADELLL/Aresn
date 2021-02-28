<?php
include_once('../layouts/navbar.php');
include_once('../layouts/sidebar.php');

//check level
if (!isset($_SESSION["admin"])) {
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

$pengguna = query("SELECT * FROM pengguna WHERE id = $id")[0];

if (isset($_POST['edit'])) {
    if (updateUser($_POST) > 0) {
        echo "
        <script>
			alert('Data berhasil diubah!');
			document.location.href = 'index.php';
		</script>
        ";
    } else {
        echo "
        <script>
			alert('Data tidak diubah!');
			document.location.href = 'index.php';
		</script>
        ";
    }
}
?>

<form action="" method="POST">
    <input type="hidden" name="id" value="<?= $id; ?>">
    <input type="hidden" name="emailLama" value="<?= $pengguna['email']; ?>">
    <table class="table">
        <tr>
            <td colspan="2">
                <span id="action">
                    <h2>Ubah Pengguna</h2>
                    <a href="index.php" class="href">Kembali</a>
                </span>
            </td>
        </tr>
        <tr>
            <td><label for="nama">Nama pengguna</label></td>
            <td><input type="text" name="nama" class="input-form" id="nama" placeholder="Masukkan nama pengguna!" value="<?= $pengguna['nama'] ?>" autocomplete="off" autofocus required></td>
        </tr>
        <tr>
            <td><label for="email">Email</label></td>
            <td><input type="email" name="email" class="input-form" id="email" placeholder="Masukkan email!" value="<?= $pengguna['email'] ?>" autocomplete="off" required></td>
        </tr>
        <tr>
            <td><label for="kata_sandi">Kata sandi</label></td>
            <td><input type="text" name="kata_sandi" class="input-form" id="kata_sandi" placeholder="Masukkan kata sandi!" value="<?= $pengguna['kata_sandi'] ?>" autocomplete="off" min="3" required></td>
        </tr>
        <tr>
            <td><label for="tingkat">Tingkat</label></td>
            <td>
                <select name="tingkat" id="tingkat" class="input-form">
                    <option value="<?= $pengguna['tingkat'] ?>"><?= $pengguna['tingkat'] ?></option>
                    <option value="admin">Admin</option>
                    <option value="petugas">Petugas</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2" class="center"><button type="submit" name="edit" class="button yellow">Edit</button></td>
        </tr>
    </table>
</form>

<?php include_once('../layouts/footer.php'); ?>