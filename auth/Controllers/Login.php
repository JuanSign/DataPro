<?php

require_once(__DIR__ . '/../Utils/UserModel.php');

class Login
{
    public static function HandleLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            http_response_code(400);
            echo json_encode([
                'status' => 'ERROR',
                'message' => 'Method not allowed.'
            ]);
            return;
        }

        $requestBody = json_decode(file_get_contents('php://input'), true);
        $identifier = @$requestBody['username'] ?? @$requestBody['email'];
        $password = @$requestBody['password'];

        if (empty($identifier)) {
            http_response_code(400);
            echo json_encode([
                'status' => 'ERROR',
                'message' => 'Please provide a valid email or username.'
            ]);
            return;
        }
        if (empty($password)) {
            http_response_code(400);
            echo json_encode([
                'status' => 'ERROR',
                'message' => 'Please provide a valid password.'
            ]);
            return;
        }

        UserModel::AttemptLogin($identifier, $password);
    }
}
