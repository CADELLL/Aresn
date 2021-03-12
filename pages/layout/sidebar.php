<div id="sidebar">
    <p id="menu">Menu</p>
    <ul>
        <?php if (!isset($_SESSION['payment'])) : ?>
            <li><a href="<?= locationFile(); ?>index.php" class="<?= activeMainMenu('index.php'); ?>"><span class="hide">Dashboard </span><i class='bx bxs-dashboard hide-icon'></i></a></li>
            <li><a href="<?= locationFile(); ?>pages/general" class="<?= activeMenu('pages/general'); ?>"><span class="hide">SPP </span><i class='bx bxs-school hide-icon'></i></a></li>
        <?php endif; ?>
        <?php if (isset($_SESSION['admin'])) : ?>
            <li><a href="<?= locationFile(); ?>admin.php" class="<?= activeMainMenu('admin.php'); ?>"><span class="hide">Dashboard </span><i class='bx bxs-dashboard hide-icon'></i></a></li>
            <li><a href="<?= locationFile(); ?>pages/class" class="<?= activeMenu('pages/class'); ?>"><span class="hide">Kelas </span><i class='bx bx-home hide-icon'></i></a></li>
            <li><a href="<?= locationFile(); ?>pages/student" class="<?= activeMenu('pages/student'); ?>"><span class="hide">Siswa </span><i class='bx bx-user hide-icon'></i></a></li>
            <li><a href="<?= locationFile(); ?>pages/user" class="<?= activeMenu('pages/user'); ?>"><span class="hide">Pengguna </span><i class='bx bxs-user-account hide-icon'></i></a></li>
            <li><a href="<?= locationFile(); ?>pages/payment" class="<?= activeMenu('pages/payment'); ?>"><span class="hide">Pembayaran </span><i class='bx bx-money hide-icon'></i></a></li>
            <li><a href="<?= locationFile(); ?>pages/donation" class="<?= activeMenu('pages/donation'); ?>"><span class="hide">SPP </span><i class='bx bxs-school hide-icon'></i></a></li>
            <li><a href="<?= locationFile(); ?>pages/announcement" class="<?= activeMenu('pages/announcement'); ?>"><span class="hide">Pengumuman </span><i class='bx bx-notification hide-icon'></i></a></li>
        <?php endif; ?>
        <?php if (isset($_SESSION['officer'])) : ?>
            <li><a href="<?= locationFile(); ?>officer.php" class="<?= activeMainMenu('officer.php'); ?>"><span class="hide">Dashboard </span><i class='bx bxs-dashboard hide-icon'></i></a></li>
            <li><a href="<?= locationFile(); ?>pages/payment" class="<?= activeMenu('pages/payment'); ?>"><span class="hide">Pembayaran </span><i class='bx bx-money hide-icon'></i></a></li>
        <?php endif; ?>
        <?php if (isset($_SESSION['payment'])) : ?>
            <li><a href="<?= locationFile(); ?>pages/auth/logout.php" class="<?= activeMenu('pages/auth/logout.php'); ?>"><span class="hide">Keluar </span><i class='bx bx-exit hide-icon'></i></a></li>
        <?php endif; ?>
        <?php if (!isset($_SESSION['payment'])) : ?>
            <li><a href="<?= locationFile(); ?>pages/auth/login.php" class="<?= activeMenu('pages/auth/login.php'); ?>"><span class="hide">Masuk </span><i class='bx bx-log-in hide-icon'></i></a></li>
        <?php endif; ?>
    </ul>
</div>