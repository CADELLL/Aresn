<?php
require 'functions.php';

$bulan = month();

$pembayaran = query("SELECT * FROM pembayaran JOIN siswa ON pembayaran.nisn = siswa.nisn")[0];

// echo $bayar[0]['month'];

echo $pembayaran['nama'];
foreach ($bulan as $b) {
    if ($pembayaran['bulan_dibayar'] != $b['month']) {
        echo $b['month'];
    }
    echo '</br>';
}
