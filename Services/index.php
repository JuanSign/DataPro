<?php

require_once('Utils/Response.php');

switch ($_SERVER['REQUEST_URI']) {

    case '/login':
        require_once('Controllers/Login.php');
        Login::HandleLogin();
        break;
    case '/register':
        require_once('Controllers/Register.php');
        Register::HandleRegistration();
        break;

    case '/algo':
        require_once('Controllers/Algo.php');
        Algo::HandleAlgo();
        break;

    default:
        Response::NOT_FOUND();
        break;
}
