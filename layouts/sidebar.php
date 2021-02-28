<div id="sidebar">
    <p id="menu">Menu</p>
    <ul>
        <li><a href="<?= locationFile(); ?>index.php" class="<?= activeMainMenu('index.php'); ?>"><span class="hide">Dashboard </span><i class='bx bxs-dashboard hide-icon'></i></a></li>
        <li><a href="<?= locationFile(); ?>admin.php" class="<?= activeMainMenu('admin.php'); ?>"><span class="hide">Dashboard </span><i class='bx bxs-dashboard hide-icon'></i></a></li>
        <li><a href="<?= locationFile(); ?>class" class="<?= activeMenu('class'); ?>"><span class="hide">Kelas </span><i class='bx bx-home hide-icon'></i></a></li>
        <li><a href="<?= locationFile(); ?>students" class="<?= activeMenu('students'); ?>"><span class="hide">Siswa </span><i class='bx bx-user hide-icon'></i></a></li>
        <li><a href="<?= locationFile(); ?>users" class="<?= activeMenu('users'); ?>"><span class="hide">Pengguna </span><i class='bx bx-user hide-icon'></i></a></li>
        <li><a href="<?= locationFile(); ?>payment" class="<?= activeMenu('payment'); ?>"><span class="hide">Pembayaran </span><i class='bx bx-money hide-icon'></i></a></li>
        <li><a href="<?= locationFile(); ?>donation" class="<?= activeMenu('donation'); ?>"><span class="hide">SPP </span><i class='bx bx-money hide-icon'></i></a></li>
    </ul>
</div>