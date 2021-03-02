<?php
$bulan = [
    ['Januari'],
    ['Februari'],
    ['Maret'],
    ['April'],
    ['Mei'],
    ['Juni'],
    ['Juli'],
    ['Agustus'],
    ['September'],
    ['Oktober'],
    ['November'],
    ['Desember']
];

$bulanDiBayar = ['Januari', 'Maret'];

$total = 12 - count($bulanDiBayar);
for ($i = 0; $i < $total; $i++) {
    $bulanDiBayar[] = [''];
}

// var_dump($bulanDiBayar);

// for ($i = 0; $i < count($bulan); $i++) {
//     // echo $bulan[$i][0];
//     // echo '</br>';
//     if ($bulan[$i][0] == $bulanDiBayar[$i][0]) {
//         echo $bulan[$i][0] . ' Lunas';
//     } else {
//         echo $bulan[$i][0] . ' Tidak lunas';
//     }
//     echo '</br>';
// }



// var_dump($bulanDiBayar);
for ($i = 0; $i < 12; $i++) {
    switch ($bulanDiBayar[$i]) {
        case 'Januari':
            echo 'Januari Lunas';
            break;
        case 'Februari':
            echo 'Februari Lunas';
            break;
        case 'Maret':
            echo 'Maret Lunas';
            break;
        case 'April':
            echo 'April Lunas';
            break;
        case 'Mei':
            echo 'Mei Lunas';
            break;
        case 'Juni':
            echo 'JuniLunas';
            break;
        case 'Juli':
            echo 'Juli Lunas';
            break;
        case 'Agustus':
            echo 'AgustusLunas';
            break;
        case 'September':
            echo 'September Lunas';
            break;
        case 'Oktober':
            echo 'Oktober Lunas';
            break;
        case 'November':
            echo 'November Lunas';
            break;
        case 'Desember':
            echo 'Desember Lunas';
            break;
        default:
            break;
    }
    echo '<br>';
}

// echo $bulanDiBayar[0] != 'Januari' ? 'oke' : 'sama aja';

for ($i = 0; $i < 12; $i++) {
    echo $i;
    if ($bulanDiBayar[$i] == 'Januari') {
        echo '';
    } else {
        echo 'Januari';
        break;
    }
    if ($bulanDiBayar[$i] == 'Februari') {
        echo '';
    } else {
        echo 'Februari';
        break;
    }
    if ($bulanDiBayar[$i] == 'Maret') {
        echo '';
    } else {
        echo 'Maret';
        break;
    }
    if ($bulanDiBayar[$i] == 'April') {
        echo '';
    } else {
        echo 'April';
        break;
    }
}

// function bulanBayar($data)
// {
//     switch ($data) {
//         case 'Januari':
//             return 'Januari';
//             break;
//         case 'Februari':
//             return 'Februari';
//             break;
//         case 'Maret':
//             return 'Maret';
//             break;
//         case 'April':
//             return 'April';
//             break;
//         case 'Mei':
//             return 'Mei';
//             break;
//         case 'Juni':
//             return 'Juni';
//             break;
//         case 'Juli':
//             return 'Juli';
//             break;
//         case 'Agustus':
//             return 'Agustus';
//             break;
//         case 'September':
//             return 'September';
//             break;
//         case 'Oktober':
//             return 'Oktober';
//             break;
//         case 'November':
//             return 'November';
//             break;
//         case 'Desember':
//             return 'Desember';
//             break;
//         default:
//             return '';
//             break;
//     }
// }
