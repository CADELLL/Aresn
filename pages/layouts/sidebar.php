<div id="sidebar">
    <p id="menu">Menu</p>
    <ul>
        <li><a href="<?= locationFile(); ?>index.php" class="<?= activeMenu(''); ?>"><span class="hide">Dashboard </span><i class='bx bxs-dashboard hide-icon'></i></a></li>
        <li><a href="<?= locationFile(); ?>pages/admin" class="<?= activeMenu('pages/admin'); ?>"><span class="hide">Admin </span><i class='bx bxs-dashboard hide-icon'></i></a></li>
        <li><a href="<?= locationFile(); ?>pages/class" class="<?= activeMenu('pages/class'); ?>"><span class="hide">Kelas </span><i class='bx bx-home hide-icon'></i></a></li>
    </ul>
</div>