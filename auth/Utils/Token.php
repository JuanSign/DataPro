<?php

class Token
{
    private $_SECRET;
    private static $_instance = null;

    private function __construct()
    {
        $env = parse_ini_file(__DIR__ . '/../.env');
        $this->_SECRET = $env['SECRET_KEY'];
    }

    public static function Generate(string $ID)
    {
        if (self::$_instance === null) self::$_instance = new Token();

        $header = json_encode([
            'alg' => 'HS256',
            'typ' => 'JWT'
        ]);

        $expirationTime = time() + 3600;

        $payload = json_encode([
            'sub' => $ID,
            'exp' => $expirationTime
        ]);

        $base64UrlHeader = Token::base64UrlEncode($header);
        $base64UrlPayload = Token::base64UrlEncode($payload);

        $signature = hash_hmac('sha256', $base64UrlHeader . '.' . $base64UrlPayload, self::$_instance->_SECRET, true);
        $base64UrlSignature = Token::base64UrlEncode($signature);

        $jwt = $base64UrlHeader . '.' . $base64UrlPayload . '.' . $base64UrlSignature;

        return $jwt;
    }

    public static function Verify($token)
    {
        if (self::$_instance === null) self::$_instance = new Token();

        list($base64UrlHeader, $base64UrlPayload, $base64UrlSignature) = explode('.', $token);

        $header = json_decode(Token::base64UrlDecode($base64UrlHeader), true);
        $payload = json_decode(Token::base64UrlDecode($base64UrlPayload), true);

        if ($header['alg'] !== 'HS256') {
            http_response_code(401);
            echo json_encode([
                'status' => 'ERROR',
                'message' => 'Invalid Token.'
            ]);
            return;
        }

        $signature = hash_hmac('sha256', $base64UrlHeader . '.' . $base64UrlPayload, self::$_instance->_SECRET, true);
        $base64UrlSignatureCheck = Token::base64UrlEncode($signature);

        if ($base64UrlSignature !== $base64UrlSignatureCheck) {
            http_response_code(401);
            echo json_encode([
                'status' => 'ERROR',
                'message' => 'Invalid Token.'
            ]);
            return;
        }

        if (isset($payload['exp']) && time() > $payload['exp']) {
            http_response_code(401);
            echo json_encode([
                'status' => 'ERROR',
                'message' => 'Token expired.'
            ]);
            return;
        }

        http_response_code(200);
        echo json_encode([
            'status' => 'SUCCESS',
            'message' => 'User allowed.',
            'ID' => $payload['sub']
        ]);
    }

    private static function base64UrlDecode($data)
    {
        return base64_decode(strtr($data, '-_', '+/'));
    }

    private static function base64UrlEncode($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }
}
