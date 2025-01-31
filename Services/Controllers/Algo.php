<?php

require_once(__DIR__ . '/../Utils/Token.php');
require_once(__DIR__ . '/../Utils/Mailer.php');

class Algo
{
    public static function HandleAlgo()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Response::METHOD_NOT_ALLOWED();
            return;
        }

        $AUTH_HEADER = Algo::CheckToken(getallheaders());
        if ($AUTH_HEADER['STATUS'] == 'ERROR') {
            Response::AUTHENTICATION_ERROR($AUTH_HEADER['MESSAGE']);
            return;
        }

        $TOKEN = $AUTH_HEADER['MESSAGE'];

        $USER_DATA = Token::Verify($TOKEN);
        if ($USER_DATA['STATUS'] != 'SUCCESS') {
            Response::AUTHENTICATION_ERROR($USER_DATA['MESSAGE']);
            return;
        }

        // Check that exactly one file is provided
        if (empty($_FILES) || count($_FILES) !== 1) {
            Response::BAD_REQUEST('Please provide exactly one file.');
            return;
        }

        // Extract the file key and validate the file
        $file = reset($_FILES);
        if ($file['error'] !== UPLOAD_ERR_OK) {
            Response::BAD_REQUEST($file['error']);
            return;
        }
        if (pathinfo($file['name'], PATHINFO_EXTENSION) !== 'csv') {
            Response::BAD_REQUEST('Please provide a CSV file.');
            return;
        }

        // Validate the 'type' parameter
        if (!isset($_REQUEST['type'])) {
            Response::BAD_REQUEST('Please provide the type of operation.');
            return;
        } elseif (!in_array($_REQUEST['type'], ['stats', 'clsfy'])) {
            Response::BAD_REQUEST('Please provide a valid type of operation.');
            return;
        }

        if ($_REQUEST['type'] == 'stats') {
            $filePath = $_FILES['file']['tmp_name'];
            $pythonScript = __DIR__ . '/../Algorithms/stats.py';

            $basename = pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);
            $command = escapeshellcmd("venv/bin/python3 $pythonScript " . escapeshellarg($filePath) . ' ' . escapeshellarg($basename));

            $output = shell_exec($command);

            if ($output === null) {
                Response::INTERNAL_SERVER_ERROR('Error executing Python script.');
            } else {
                if ($output == 'SUCCESS') {
                    $mailer = new Mailer();

                    $subject = 'DataPro : Generated PDF Report';
                    $body = 'Please find the attached PDF report generated from the CSV file.';
                    $pdf = '/tmp/' . $basename . '_stats.pdf';

                    $result = $mailer->sendEmailWithPDF($USER_DATA['email'], $subject, $body, $pdf);
                    if ($result == 'SUCCESS') {
                        Response::CUSTOM(200, ['status' => 'success']);
                        return;
                    } else {
                        Response::INTERNAL_SERVER_ERROR($result);
                        return;
                    }
                } else {
                    Response::INTERNAL_SERVER_ERROR($output);
                }
            }
        }
    }

    private static function CheckToken($headers): array
    {
        if (isset($headers['Authorization'])) {
            $authHeader = $headers['Authorization'];
            if (preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
                $token = $matches[1];
                return ['STATUS' => 'SUCCESS', 'MESSAGE' => $token];
            } else {
                return ['STATUS' => 'ERROR', 'MESSAGE' => 'Invalid Authorization header format.'];
            }
        } else {
            return ['STATUS' => 'ERROR', 'MESSAGE' => 'Authorization header not found.'];
        }
    }
}
