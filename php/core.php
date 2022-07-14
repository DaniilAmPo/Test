<?php
$action = $_POST['func'];
require_once 'function.php';

switch ($action) {
    case 'register':
        register();
        break;
    case 'updata':
        updata();
        break;
    case 'login':
        login();
        break;
    default:
}