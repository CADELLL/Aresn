<div id="sidebar">
    <p id="menu">Menu</p>
    <ul>
        <?php if (!isset($_SESSION['payment'])) : ?>
            <li><a href="<?= locationFile(); ?>index.php" class="<?= activeMainMenu('index.php'); ?>"><span class="hide">Dashboard </span><i class='bx bxs-dashboard hide-icon'></i></a></li>
            <li><a href="<?= locationFile(); ?>public/general" class="<?= activeMenu('public/general'); ?>"><span class="hide">SPP </span><i class='bx bxs-school hide-icon'></i></a></li>
        <?php endif; ?>
        <?php if (isset($_SESSION['admin'])) : ?>
            <li><a href="<?= locationFile(); ?>admin.php" class="<?= activeMainMenu('admin.php'); ?>"><span class="hide">Dashboard </span><i class='bx bxs-dashboard hide-icon'></i></a></li>
            <li><a href="<?= locationFile(); ?>public/class" class="<?= activeMenu('public/class'); ?>"><span class="hide">Kelas </span><i class='bx bx-home hide-icon'></i></a></li>
            <li><a href="<?= locationFile(); ?>public/student" class="<?= activeMenu('public/student'); ?>"><span class="hide">Siswa </span><i class='bx bx-user hide-icon'></i></a></li>
            <li><a href="<?= locationFile(); ?>public/user" class="<?= activeMenu('public/user'); ?>"><span class="hide">Pengguna </span><i class='bx bxs-user-account hide-icon'></i></a></li>
            <li><a href="<?= locationFile(); ?>public/payment" class="<?= activeMenu('public/payment'); ?>"><span class="hide">Pembayaran </span><i class='bx bx-money hide-icon'></i></a></li>
            <li><a href="<?= locationFile(); ?>public/donation" class="<?= activeMenu('public/donation'); ?>"><span class="hide">SPP </span><i class='bx bxs-school hide-icon'></i></a></li>
        <?php endif; ?>
        <?php if (isset($_SESSION['officer'])) : ?>
            <li><a href="<?= locationFile(); ?>officer.php" class="<?= activeMainMenu('officer.php'); ?>"><span class="hide">Dashboard </span><i class='bx bxs-dashboard hide-icon'></i></a></li>
            <li><a href="<?= locationFile(); ?>public/payment" class="<?= activeMenu('public/payment'); ?>"><span class="hide">Pembayaran </span><i class='bx bx-money hide-icon'></i></a></li>
        <?php endif; ?>
        <?php if (isset($_SESSION['payment'])) : ?>
            <li><a href="<?= locationFile(); ?>public/auth/logout.php" class="<?= activeMenu('public/auth/logout.php'); ?>"><span class="hide">Keluar </span><i class='bx bx-exit hide-icon'></i></a></li>
        <?php endif; ?>
        <?php if (!isset($_SESSION['payment'])) : ?>
            <li><a href="<?= locationFile(); ?>public/auth/login.php" class="<?= activeMenu('public/auth/login.php'); ?>"><span class="hide">Masuk </span><i class='bx bx-log-in hide-icon'></i></a></li>
        <?php endif; ?>
    </ul>
</div>