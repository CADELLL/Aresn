<?php
session_start();

$tingkat = isset($_SESSION['tingkat']);
$mainUrl = parse_url($_SERVER['PHP_SELF'], PHP_URL_PATH);

function locationFile()
{
    global $mainUrl;

    switch ($mainUrl) {
        case '/spp/index.php':
            return '';
            break;
        case '/spp/admin.php':
            return '';
            break;
        case '/spp/officer.php':
            return '';
            break;
        default:
            return '../';
            break;
    }
}

function activeMainMenu($file = '',)
{
    global $mainUrl;

    return $mainUrl == '/spp/' . $file ? 'active' : '';
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
    <link rel="stylesheet" href="<?= locationFile(); ?>style.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <nav id="navbar">
        <p><?= $_SESSION["nama"] ?? "Web SPP" ?></p>
        <a href="auth/<?= $tingkat ? 'logout.php' : 'login.php' ?>"><?= $tingkat ? 'Keluar' : 'Masuk' ?></a>
    </nav>
    <div id="content">