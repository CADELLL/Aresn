<?php
$level = isset($_SESSION['level']);
$mainUrl = parse_url($_SERVER['PHP_SELF'], PHP_URL_PATH);

function locationFile()
{
    global $mainUrl;

    $folder = '/spp/index.php';

    return $mainUrl == $folder ? '' : '../../';
}

function activeMainMenu($file)
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
    <link rel="stylesheet" href="<?= locationFile(); ?>style2.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <nav id="navbar">
        <p><?= $_SESSION["name"] ?? "Web SPP" ?></p>
        <a href="pages/auth/<?= $level ? 'logout.php' : 'login.php' ?>"><?= $level ? 'Keluar' : 'Masuk' ?></a>
    </nav>
    <div id="content">