<?php

require_once(__DIR__ . '/../Models/UserModel.php');
require_once(__DIR__ . '/../Utils/Token.php');

class Login
{
    public static function HandleLogin(): void
    {
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Response::METHOD_NOT_ALLOWED();
            return;
        }

        $REQUEST_BODY = json_decode(file_get_contents('php://input'), true);

        if (!Login::ValidateRequest($REQUEST_BODY)) return;

        $credentials = UserModel::GetUser($REQUEST_BODY['identifier']);
        if ($credentials['ID'] === null) {
            Response::NOT_FOUND('USER');
            return;
        }

        if (!password_verify($REQUEST_BODY['password'], $credentials['password'])) {
            Response::AUTHENTICATION_ERROR('WRONG PASSWORD');
            return;
        } else {
            unset($credentials['password']);
            $data['STATUS'] = 'SUCCESS';
            $data['MESSAGE'] = 'Logged in.';
            $data['TOKEN'] = Token::Generate($credentials);
            $data['fname'] = $credentials['fname'];
            $data['lname'] = $credentials['lname'];
            $data['email'] = $credentials['email'];
            Response::CUSTOM(200, $data);
        }
    }

    private static function ValidateRequest(array $REQUEST_BODY = null): bool
    {

        if (!isset($REQUEST_BODY['identifier'])) {
            Response::BAD_REQUEST("NO IDENTIFIER PROVIDED!");
            return false;
        }
        if (!isset($REQUEST_BODY['password'])) {
            Response::BAD_REQUEST("NO PASSWORD PROVIDED!");
            return false;
        }
        return true;
    }
}
