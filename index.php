<?php
// Requests from the same server don't have a HTTP_ORIGIN header
if (!array_key_exists('HTTP_ORIGIN', $_SERVER)) {
    $_SERVER['HTTP_ORIGIN'] = $_SERVER['SERVER_NAME'];
}

function __autoload($className) {
    if (file_exists("src/$className.php")) {
        require_once "src/$className.php";
        return true;
    }
    return false;
}

try {
    $api = new MyAPI($_SERVER['REQUEST_URI'], $_SERVER['HTTP_ORIGIN']);
    $api->handle();
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}