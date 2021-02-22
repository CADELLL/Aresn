<?php
session_start();
session_start();
$_SESSION = [];
session_unset();
session_destroy();

header('Location: masuk.php');
exit;
