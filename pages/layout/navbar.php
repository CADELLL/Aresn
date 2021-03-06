<?php
session_start();

$name = isset($_SESSION['name']);
$mainUrl = parse_url($_SERVER['PHP_SELF'], PHP_URL_PATH);

function locationFile()
{
    global $mainUrl;

    switch ($mainUrl) {
        case '/spp/index.php':
            return '';
            break;
        case '/spp/student.php':
            return '';
            break;
        case '/spp/admin.php':
            return '';
            break;
        case '/spp/officer.php':
            return '';
            break;
        default:
            return '../../';
            break;
    }
}

function activeMainMenu($file = '')
{
    global $mainUrl;

    if ($mainUrl == '/spp/' . $file) {
        return 'active';
    }
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
    <link rel="shortcut icon" href="<?= locationFile(); ?>assets/images/favicon.ico">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <nav id="navbar">
        <p id="name"><?= $_SESSION["name"] ?? "" ?></p>
        <div id="search">
            <form action="" method="POST">
                <input type="text" class="input-form search" name="keyword" autocomplete="off" placeholder="Masukkan kata kunci..">
                <button type="submit" name="search" class="button green"><span class="hide">Cari </span><i class='bx bx-search hide-icon'></i></button>
            </form>
        </div>
    </nav>
    <div id="content">