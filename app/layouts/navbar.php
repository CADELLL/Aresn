<?php
$url = parse_url($_SERVER['PHP_SELF'], PHP_URL_PATH);

function active_menu($file)
{
    global $url;
    return $url == '/spp/' . $file ? 'active' : '';
}

function dynamic_title()
{
    global $url;
    switch ($url) {
        case '/spp/example.php':
            return 'Example Page';
            break;
        default;
            return;
    }
}

$tingkat = isset($_SESSION['tingkat']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= dynamic_title(); ?></title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <nav id="navbar">
        <p><?= $_SESSION["nama"] ?? "Web SPP" ?></p>
        <a href="autentikasi/<?= $tingkat ? 'keluar.php' : 'masuk.php' ?>"><?= $tingkat ? 'Keluar' : 'Masuk' ?></a>
    </nav>
    <div id="content">