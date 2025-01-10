<?php

class Response
{
    static function AUTHENTICATION_ERROR(string $message)
    {
        http_response_code(401);
        echo json_encode([
            'STATUS' => 'ERROR',
            'MESSAGE' => $message
        ]);
    }
    static function BAD_REQUEST(string $message)
    {
        http_response_code(400);
        echo json_encode([
            'STATUS' => 'ERROR',
            'MESSAGE' => $message
        ]);
    }
    static function CUSTOM(int $code, array $data)
    {
        http_response_code($code);
        echo json_encode($data);
    }
    static function CONFLICT(string $message)
    {
        http_response_code(409);
        echo json_encode([
            'STATUS' => 'ERROR',
            'MESSAGE' => $message
        ]);
    }
    static function INTERNAL_SERVER_ERROR(string $message)
    {
        http_response_code(500);
        echo json_encode([
            'STATUS' => 'ERROR',
            'MESSAGE' => $message
        ]);
    }
    static function METHOD_NOT_ALLOWED()
    {
        http_response_code(405);
        echo json_encode([
            'STATUS' => 'ERROR',
            'MESSAGE' => 'METHOD NOT ALLOWED!'
        ]);
    }
    static function NOT_FOUND(string $content = 'PAGE')
    {
        http_response_code(404);
        echo json_encode([
            'STATUS' => 'ERROR',
            'MESSAGE' => $content . ' NOT FOUND!'
        ]);
    }
}
