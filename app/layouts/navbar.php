<?php

function location_file()
{
    $url = parse_url($_SERVER['PHP_SELF'], PHP_URL_PATH);
    return $url == '/spp/index.php' ? '' : '../../';
}

require location_file() . 'functions.php';

$level = isset($_SESSION['level']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= dynamic_title(); ?></title>
    <link rel="stylesheet" href="<?= location_file(); ?>style2.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <nav id="navbar">
        <p><?= $_SESSION["name"] ?? "Web SPP" ?></p>
        <a href="auth/<?= $level ? 'keluar.php' : 'masuk.php' ?>"><?= $level ? 'Keluar' : 'Masuk' ?></a>
    </nav>
    <div id="content">