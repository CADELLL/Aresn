<?php
require 'functions.php';

$bulan = month();

// $pembayaran = query("SELECT * FROM pembayaran JOIN siswa ON pembayaran.nisn = siswa.nisn")[0];

// echo $bayar[0]['month'];

// echo $pembayaran['nama'];
// foreach ($bulan as $b) {
//     if ($pembayaran['bulan_dibayar'] != $b['month']) {
//         echo $b['month'];
//     }
//     echo '</br>';
// }

$nisn = 78392758;

$pembayaran = query("SELECT * FROM pembayaran
                    WHERE pembayaran.nisn = $nisn");

$resultMonth = [];
foreach ($pembayaran as $p) {
    $resultMonth[] = $p['bulan_dibayar'];
}

$sisa = count($bulan) - count($pembayaran);

for ($i = 0; $i < $sisa; $i++) {
    $resultMonth[] = '';
}

// for ($i = 0; $i < count($resultMonth); $i++) {
//     echo $resultMonth[$i];
// }

// for ($i = 0; $i < count($bulan); $i++) {
//     if ($bulan[$i][0] != $) {
//         echo $bulan[$i][0];
//     }
//     echo '</br>';
// }

$i = 0;
$x = 0;
while ($i < count($resultMonth)) {
    if ($resultMonth[$x] != $bulan[$i][0]) {
        echo $bulan[$i][0];
    }
    echo '</br>';
    $x = 0;
    $i++;
}
