<?php
// connection
$conn = mysqli_connect("localhost", "root", "", "db_spp");

// function query for query sintaks SQL
function query($query)
{
    global $conn;

    $result = mysqli_query($conn, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

// get url
$url = parse_url($_SERVER['PHP_SELF'], PHP_URL_PATH);

// active menu sidebar
function active_menu($file)
{
    global $url;
    return $url == '/spp/' . $file ? 'active' : '';
}

// dynamic title
function dynamic_title()
{
    global $url;
    switch ($url) {
        case '/spp/example.php':
            return 'Example Page';
            break;
        case '/spp/app/admin/index.php':
            return 'Admin Page';
            break;
        default;
            return;
    }
}
