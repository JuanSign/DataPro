<?php

namespace App\Models;

use CodeIgniter\Model;

class Auth extends Model
{
    public function Login($username, $password)
    {
        echo "<script>console.log('PHP Message: Login $username');</script>";

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

        if ($response === false) {
            $error = curl_error($ch);
            echo "<script>console.log('Curl Error: $error');</script>";
        } else {
            $response_json = json_encode($response);
            $response_json = str_replace(["\n", "\r", "\t"], '', $response_json);

            echo "<script>console.log('API response: $response_json');</script>";
        }


        $decoded_response = json_decode($response, true);
        if (empty($decoded_response)) {
            echo "<script>console.log('Invalid response from login API');</script>";
        }

        return $decoded_response;
    }

    public function Register($fname, $lname, $username, $email, $password)
    {
        echo "<script>console.log('PHP Message: Register $username');</script>";

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

        if ($response === false) {
            echo "<script>console.log('Curl Error: $ch');</script>";
        } else {
            echo "<script>console.log('API response: $response');</script>";
        }

        $decoded_response = json_decode($response, true);
        if (empty($decoded_response)) {
            echo "<script>console.log('Invalid response from login API');</script>";
        }

        return $decoded_response;
    }
}
