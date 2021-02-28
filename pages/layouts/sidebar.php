<div id="sidebar">
    <p id="menu">Menu</p>
    <ul>
        <li><a href="<?= locationFile(); ?>index.php" class="<?= activeMainMenu('index.php'); ?>"><span class="hide">Dashboard </span><i class='bx bxs-dashboard hide-icon'></i></a></li>
        <li><a href="<?= locationFile(); ?>pages/admin" class="<?= activeMenu('pages/admin'); ?>"><span class="hide">Admin </span><i class='bx bxs-dashboard hide-icon'></i></a></li>
        <li><a href="<?= locationFile(); ?>pages/class" class="<?= activeMenu('pages/class'); ?>"><span class="hide">Kelas </span><i class='bx bx-home hide-icon'></i></a></li>
        <li><a href="<?= locationFile(); ?>pages/students" class="<?= activeMenu('pages/students'); ?>"><span class="hide">Siswa </span><i class='bx bx-user hide-icon'></i></a></li>
        <li><a href="<?= locationFile(); ?>pages/users" class="<?= activeMenu('pages/users'); ?>"><span class="hide">Pengguna </span><i class='bx bx-user hide-icon'></i></a></li>
        <li><a href="<?= locationFile(); ?>pages/spp" class="<?= activeMenu('pages/spp'); ?>"><span class="hide">SPP </span><i class='bx bx-money hide-icon'></i></a></li>
    </ul>
</div>