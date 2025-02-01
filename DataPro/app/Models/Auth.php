<?php

namespace App\Models;

use CodeIgniter\Model;

class Auth extends Model
{
    public function Login($username, $password)
    {

        $url = "https://datapro-services.onrender.com/login";

        $data = [
            'identifier' => $username,
            'password' => $password,
        ];

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);

        return json_decode($response, true);
    }

    public function Register($fname, $lname, $username, $email, $password)
    {

        $url = "https://datapro-services.onrender.com/register";

        $data = [
            "first_name" => $fname,
            "last_name" => $lname,
            "username" => $username,
            "email" => $email,
            "password" => $password
        ];

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);

        return json_decode($response, true);
    }
}
