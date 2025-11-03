<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$public_pages = ['login.php', 'auth_login.php', 'logout.php', 'index.php', 'about.php'];

$current_page = basename($_SERVER['PHP_SELF']);

if (!isset($_SESSION['user_id']) && !in_array($current_page, $public_pages)) {
    header('Location: login.php');
    exit();
}

if (isset($_SESSION['user_id']) && $current_page === 'login.php') {
    header('Location: index.php');
    exit();
}
?>