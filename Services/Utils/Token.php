<?php

class Token
{
    private $_SECRET;
    private static $_instance = null;

    private function __construct()
    {
        $env = parse_ini_file('/etc/secrets/.env');
        $this->_SECRET = $env['SECRET_KEY'];
    }

    public static function Generate(array $payload): string
    {
        if (self::$_instance === null) self::$_instance = new Token();

        $header = json_encode([
            'alg' => 'HS256',
            'typ' => 'JWT'
        ]);

        $expirationTime = time() + 3600;
        $payload['exp'] = $expirationTime;
        $payload = json_encode($payload);

        $base64UrlHeader = Token::base64UrlEncode($header);
        $base64UrlPayload = Token::base64UrlEncode($payload);

        $signature = hash_hmac('sha256', $base64UrlHeader . '.' . $base64UrlPayload, self::$_instance->_SECRET, true);
        $base64UrlSignature = Token::base64UrlEncode($signature);

        $jwt = $base64UrlHeader . '.' . $base64UrlPayload . '.' . $base64UrlSignature;

        return $jwt;
    }

    public static function Verify($token): array
    {
        if (self::$_instance === null) self::$_instance = new Token();

        $token_parts = explode('.', $token);
        if (count($token_parts) != 3) return ['STATUS' => 'ERROR', 'MESSAGE' => 'INVALID TOKEN!'];
        list($base64UrlHeader, $base64UrlPayload, $base64UrlSignature) = $token_parts;

        $header = json_decode(Token::base64UrlDecode($base64UrlHeader), true);
        $payload = json_decode(Token::base64UrlDecode($base64UrlPayload), true);

        if ($header['alg'] !== 'HS256') return ['STATUS' => 'ERROR', 'MESSAGE' => 'INVALID TOKEN!'];

        $signature = hash_hmac('sha256', $base64UrlHeader . '.' . $base64UrlPayload, self::$_instance->_SECRET, true);
        $base64UrlSignatureCheck = Token::base64UrlEncode($signature);

        if ($base64UrlSignature !== $base64UrlSignatureCheck) return ['STATUS' => 'ERROR', 'MESSAGE' => 'INVALID TOKEN!'];
        if (isset($payload['exp']) && time() > $payload['exp']) return ['STATUS' => 'ERROR', 'MESSAGE' => 'TOKEN EXPIRED!'];

        $payload['STATUS'] = 'SUCCESS';
        return $payload;
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
