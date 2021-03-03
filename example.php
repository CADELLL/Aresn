<?php
require 'functions.php';

// ambil data
$bulan = month();
$pembayaran = query("SELECT * FROM pembayaran WHERE nisn = '18672619'");

// masukkan data bulan dibayar
$bulanBayar = [];
foreach ($pembayaran as $p) {
    $bulanBayar[] = $p['bulan_dibayar'];
}

// hitung kurang bulan belum dibayar
$minus = 12 - count($pembayaran);

// masukkan data kedalam bulan bayar
for ($i = 0; $i < $minus; $i++) {
    $bulanBayar[] = '';
}

// cek bulan apakah samadengan bulan sesuai dengan indexnya
for ($i = 0; $i < 12; $i++) {
    switch ($bulan[$i]) {
        case $bulan[$i] == $bulanBayar[0]:
            echo  $bulan[$i] . ' Lunas';
            break;
        case $bulan[$i] == $bulanBayar[1]:
            echo  $bulan[$i] . ' Lunas';
            break;
        case $bulan[$i] == $bulanBayar[2]:
            echo  $bulan[$i] . ' Lunas';
            break;
        case $bulan[$i] == $bulanBayar[3]:
            echo  $bulan[$i] . ' Lunas';
            break;
        case $bulan[$i] == $bulanBayar[4]:
            echo  $bulan[$i] . ' Lunas';
            break;
        case $bulan[$i] == $bulanBayar[5]:
            echo  $bulan[$i] . ' Lunas';
            break;
        case $bulan[$i] == $bulanBayar[6]:
            echo  $bulan[$i] . ' Lunas';
            break;
        case $bulan[$i] == $bulanBayar[7]:
            echo  $bulan[$i] . ' Lunas';
            break;
        case $bulan[$i] == $bulanBayar[8]:
            echo  $bulan[$i] . ' Lunas';
            break;
        case $bulan[$i] == $bulanBayar[9]:
            echo  $bulan[$i] . ' Lunas';
            break;
        case $bulan[$i] == $bulanBayar[10]:
            echo  $bulan[$i] . ' Lunas';
            break;
        case $bulan[$i] == $bulanBayar[11]:
            echo  $bulan[$i] . ' Lunas';
            break;
        default:
            echo  $bulan[$i] . ' Tidak lunas';
            break;
    }
    echo '<br>';
}
