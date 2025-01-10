<?php

require_once(__DIR__ . '/../Models/UserModel.php');

class Register
{
    public static function HandleRegistration()
    {
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Response::METHOD_NOT_ALLOWED();
            return;
        }

        $REQUEST_BODY = json_decode(file_get_contents('php://input'), true);

        if (!Register::ValidateRequest($REQUEST_BODY)) return;

        if (!UserModel::CheckUser($REQUEST_BODY['username'], $REQUEST_BODY['email'])) {
            Response::CONFLICT('USERNAME / EMAIL ALREADY REGISTERED!');
            return;
        }
        if (!UserModel::CreateUser($REQUEST_BODY)) {
            Response::INTERNAL_SERVER_ERROR('FAILED TO REGISTER USER!');
            return;
        }

        $data['STATUS'] = 'SUCCESS';
        $data['MESSAGE'] = 'User registered.';
        Response::CUSTOM(201, $data);
    }

    private static function ValidateRequest(array $REQUEST_BODY = null): bool
    {

        if (!isset($REQUEST_BODY['first_name'])) {
            Response::BAD_REQUEST("Please provide a first name.");
            return false;
        }
        if (!isset($REQUEST_BODY['last_name'])) {
            Response::BAD_REQUEST("Please provide a last name.");
            return false;
        }
        if (!isset($REQUEST_BODY['username'])) {
            Response::BAD_REQUEST("Please provide a username.");
            return false;
        } elseif (!ctype_alnum($REQUEST_BODY['username'])) {
            Response::BAD_REQUEST("Please provide an alpha-numeric username.");
            return false;
        }
        if (!isset($REQUEST_BODY['email'])) {
            Response::BAD_REQUEST("Please provide a email.");
            return false;
        } elseif (!filter_var($REQUEST_BODY['email'], FILTER_VALIDATE_EMAIL)) {
            Response::BAD_REQUEST("Please provide a valid email.");
            return false;
        }
        if (!isset($REQUEST_BODY['password'])) {
            Response::BAD_REQUEST("Please provide a password.");
            return false;
        }

        return true;
    }
}
