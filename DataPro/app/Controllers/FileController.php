<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class FileController extends BaseController
{
    public function Upload()
    {
        $file = $this->request->getFile('file');
        $type = $this->request->getPost('type');

        $token = session()->get('token');

        $url = 'https://datapro-services.onrender.com/algo';

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $token,
        ]);

        $postData = [
            'file' => new \CURLFile($file->getTempName(), $file->getMimeType(), $file->getName()),
            'type' => $type,
        ];

        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch) || $httpCode != 200) {
            $errorMessage = curl_error($ch);
            curl_close($ch);
            return $this->response->setJSON(['error' => 'Failed to upload file: ' . $errorMessage]);
        }

        curl_close($ch);

        return $this->response->setJSON(['type' => $type, 'filename' => $file->getName(), 'api_response' => json_decode($response)]);
    }
}
