<?php
$level = isset($_SESSION['level']);

function locationFile()
{
    $url = parse_url($_SERVER['PHP_SELF'], PHP_URL_PATH);
    return $url == '/spp/index.php' ? '' : '../../';
}

require locationFile() . 'functions.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= dynamicTitle(); ?></title>
    <link rel="stylesheet" href="<?= locationFile(); ?>style2.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <nav id="navbar">
        <p><?= $_SESSION["name"] ?? "Web SPP" ?></p>
        <a href="app/auth/<?= $level ? 'logout.php' : 'login.php' ?>"><?= $level ? 'Keluar' : 'Masuk' ?></a>
    </nav>
    <div id="content">