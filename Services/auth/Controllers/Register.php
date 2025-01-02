<?php

require_once(__DIR__ . '/../Utils/UserModel.php');

class Register
{
    public static function HandleRegistration()
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
        $first_name = @$requestBody['first_name'];
        $last_name = @$requestBody['last_name'];
        $username = @$requestBody['username'];
        $email = @$requestBody['email'];
        $password = @$requestBody['password'];

        if (empty($first_name)) {
            http_response_code(400);
            echo json_encode([
                'status' => 'ERROR',
                'message' => 'Please provide a valid first name.'
            ]);
            return;
        }
        if (empty($last_name)) {
            http_response_code(400);
            echo json_encode([
                'status' => 'ERROR',
                'message' => 'Please provide a valid last name.'
            ]);
            return;
        }
        if (empty($username) || !ctype_alnum($username)) {
            http_response_code(400);
            echo json_encode([
                'status' => 'ERROR',
                'message' => 'Please provide a valid alpha-numeric username.'
            ]);
            return;
        }
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            http_response_code(400);
            echo json_encode([
                'status' => 'ERROR',
                'message' => 'Please provide a valid email.',
                'uname' => ctype_alnum($username)
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

        UserModel::AttemptRegister(
            $first_name,
            $last_name,
            $username,
            $email,
            $password
        );
    }
}
