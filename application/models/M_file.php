<?php


defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class M_file extends CI_Model
{
    public function fileQuery($data)
    {
        try {

            $client = new Client();

            $headers = [
                'http_errors' => false,
                'Authorization' => config_api('auth_api'),
                "Content-Type" => "application/json",
            ];

            $request = $client->request('POST', config_api('url_api') . '/File/Query', [
                'headers' => $headers,
                'json' => $data
            ]);

            $status_code = $request->getStatusCode();

            if ($status_code == 401) {
                return $this->simple_login->status_code($status_code);
            }

            // var_dump($request);
            // die();

            $data = $request->getBody()->getContents();

            $data = json_decode($data, TRUE);

            return $data;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function fileUpload($data)
    {
        $userName = $data['userName'];
        $idCat = $data['idCat'];
        $folder = $data['folder'];
        $docNumber = !empty($data['docNumber']) ? $data['docNumber'] : '';

        try {
            $client = new Client();

            $path = FCPATH . $data['files'];

            $headers = [
                // 'http_errors' => false,
                'Authorization' => config_api('auth_api'),
                // "Content-Type" => "application/json",
            ];

            $request = $client->request("POST",  config_api('url_api') . "/File/Upload?userName={$userName}&idCat={$idCat}&folder={$folder}&docNumber={$docNumber}", [
                'headers' => $headers,
                'multipart' => [
                    [
                        'name'     => 'files',
                        'contents' => fopen($path, 'r'),
                    ],
                ],
            ]);

            $status_code = $request->getStatusCode();

            if ($status_code == 401) {
                return $this->simple_login->status_code($status_code);
            }

            $data = $request->getBody()->getContents();

            $data = json_decode($data, TRUE);

            return $data;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function fileRemove($id_file)
    {
        try {

            $client = new Client();

            $headers = [
                'http_errors' => false,
                'Authorization' => config_api('auth_api'),
                "Content-Type" => "application/json",
            ];

            $request = $client->request('POST', config_api('url_api') . "/File/Remove?idFile={$id_file}", [
                'headers' => $headers
            ]);

            $status_code = $request->getStatusCode();

            if ($status_code == 401) {
                return $this->simple_login->status_code($status_code);
            }

            // var_dump($request);
            // die();

            $data = $request->getBody()->getContents();

            $data = json_decode($data, TRUE);

            return $data;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function fileBase64($id_file)
    {
        try {

            $client = new Client();

            $headers = [
                'http_errors' => false,
                'Authorization' => config_api('auth_api'),
                "Content-Type" => "application/json",
            ];

            $request = $client->request('GET', config_api('url_api') . "/File/Base64?idFile={$id_file}", [
                'headers' => $headers
            ]);

            $status_code = $request->getStatusCode();

            if ($status_code == 401) {
                return $this->simple_login->status_code($status_code);
            }

            // var_dump($request);
            // die();

            $data = $request->getBody()->getContents();

            $data = json_decode($data, TRUE);

            return $data;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function fileDownload($id_file)
    {
        try {
            $client = new Client();
            $file = $this->byId($id_file);

            // echo json_encode($file);
            // die();
            $headers = [
                'http_errors' => false,
                'Authorization' => config_api('auth_api'),
                // "Content-Type" => "application/json",
            ];

            $path = FCPATH . $file['data']['fileLocation'] . $file['data']['fileName'];
            // chmod($path, 777);
            $resource = fopen($path, 'w');

            $request = $client->request(
                "GET",
                config_api('url_api') . "/File/Download?idFile={$id_file}",
                [
                    'headers' => $headers,
                    'sink' => fopen($path, 'w')
                ]
            );

            // Now you can use the original resource.
            fclose($resource);

            return $file['data'];
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function byId($id_file)
    {
        try {
            $client = new Client();

            $headers = [
                'http_errors' => false,
                'Authorization' => config_api('auth_api'),
                "Content-Type" => "application/json",
            ];

            $request = $client->request(
                "GET",
                config_api('url_api') . "/File/ById?idFile={$id_file}",
                [
                    'headers' => $headers,
                ]
            );

            $status_code = $request->getStatusCode();

            if ($status_code == 401) {
                return $this->simple_login->status_code($status_code);
            }

            $data = $request->getBody()->getContents();

            $data = json_decode($data, TRUE);

            return $data;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}

/* End of file M_file.php */
