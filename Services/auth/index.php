<?php

header('Content-Type: application/json');

switch ($_SERVER['REQUEST_URI']) {
    case '/login':
        require_once('Controllers/Login.php');
        Login::HandleLogin();
        break;
    case '/register':
        require_once('Controllers/Register.php');
        Register::HandleRegistration();
        break;
    case '/verification':
        require_once('Controllers/Verification.php');
        Verification::HandleVerification();
        break;

    default:
        http_response_code(404);
        echo json_encode([
            'status' => 'ERROR',
            'message' => 'Page not found.'
        ]);
        break;
}
