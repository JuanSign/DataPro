<?php

require_once(__DIR__ . '/../Utils/Token.php');

class Verification
{
    public static function HandleVerification()
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
        $token = @$requestBody['token'];

        if (empty($token)) {
            http_response_code(400);
            echo json_encode([
                'status' => 'ERROR',
                'message' => 'Please provide a token.'
            ]);
            return;
        }

        Token::Verify($token);
    }
}
