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
