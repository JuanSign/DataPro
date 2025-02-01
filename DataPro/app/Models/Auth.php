<?php

namespace App\Models;

use CodeIgniter\Model;

class Auth extends Model
{
    public function Login($username, $password)
    {
        log_message('info', 'Login attempt for user: ' . $username);

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

        echo $response;

        // if ($response === false) {
        //     log_message('error', 'Curl error: ' . curl_error($ch));
        // } else {
        //     log_message('info', 'Response from login API: ' . $response);
        // }

        // $decoded_response = json_decode($response, true);
        // if (empty($decoded_response)) {
        //     log_message('error', 'Empty response or invalid JSON received from login API.');
        // }

        // return $decoded_response;
    }

    public function Register($fname, $lname, $username, $email, $password)
    {
        log_message('info', 'Registration attempt for user: ' . $username);

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

        echo $response;

        // if ($response === false) {
        //     log_message('error', 'Curl error: ' . curl_error($ch));
        // } else {
        //     log_message('info', 'Response from register API: ' . $response);
        // }

        // $decoded_response = json_decode($response, true);
        // if (empty($decoded_response)) {
        //     log_message('error', 'Empty response or invalid JSON received from register API.');
        // }

        // return $decoded_response;
    }
}
