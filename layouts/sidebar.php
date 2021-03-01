<div id="sidebar">
    <p id="menu">Menu</p>
    <ul>
        <?php if (!isset($_SESSION['payment'])) : ?>
            <li><a href="<?= locationFile(); ?>index.php" class="<?= activeMainMenu('index.php'); ?>"><span class="hide">Dashboard </span><i class='bx bxs-dashboard hide-icon'></i></a></li>
            <li><a href="<?= locationFile(); ?>general" class="<?= activeMenu('general'); ?>"><span class="hide">Pembayaran </span><i class='bx bx-money hide-icon'></i></a></li>
        <?php endif; ?>
        <?php if (isset($_SESSION['admin'])) : ?>
            <li><a href="<?= locationFile(); ?>admin.php" class="<?= activeMainMenu('admin.php'); ?>"><span class="hide">Dashboard </span><i class='bx bxs-dashboard hide-icon'></i></a></li>
            <li><a href="<?= locationFile(); ?>class" class="<?= activeMenu('class'); ?>"><span class="hide">Kelas </span><i class='bx bx-home hide-icon'></i></a></li>
            <li><a href="<?= locationFile(); ?>student" class="<?= activeMenu('student'); ?>"><span class="hide">Siswa </span><i class='bx bx-user hide-icon'></i></a></li>
            <li><a href="<?= locationFile(); ?>user" class="<?= activeMenu('user'); ?>"><span class="hide">Pengguna </span><i class='bx bx-user hide-icon'></i></a></li>
            <li><a href="<?= locationFile(); ?>payment" class="<?= activeMenu('payment'); ?>"><span class="hide">Pembayaran </span><i class='bx bx-money hide-icon'></i></a></li>
            <li><a href="<?= locationFile(); ?>donation" class="<?= activeMenu('donation'); ?>"><span class="hide">SPP </span><i class='bx bx-money hide-icon'></i></a></li>
        <?php endif; ?>
        <?php if (isset($_SESSION['officer'])) : ?>
            <li><a href="<?= locationFile(); ?>officer.php" class="<?= activeMainMenu('officer.php'); ?>"><span class="hide">Dashboard </span><i class='bx bxs-dashboard hide-icon'></i></a></li>
            <li><a href="<?= locationFile(); ?>payment" class="<?= activeMenu('payment'); ?>"><span class="hide">Pembayaran </span><i class='bx bx-money hide-icon'></i></a></li>
        <?php endif; ?>
    </ul>
</div>