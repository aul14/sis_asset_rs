<?php


defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class M_notifikasi extends CI_Model
{
    public function list()
    {
        try {
            $client = new Client();

            $headers = [
                'http_errors' => false,
                'Authorization' => config_api('auth_api'),
                "Content-Type" => "application/json",
            ];

            $request = $client->request('GET', config_api('url_api') . '/Notification/List', [
                'headers' => $headers
            ]);

            $status_code = $request->getStatusCode();

            if ($status_code == 401) {
                return $this->simple_login->status_code($status_code);
            }


            $data = $request->getBody()->getContents();

            $data = json_decode($data, TRUE);
            // var_dump($data);
            // die();

            return $data;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function read($data)
    {
        try {
            $client = new Client();

            $headers = [
                'http_errors' => false,
                'Authorization' => config_api('auth_api'),
                "Content-Type" => "application/json",
            ];

            $request = $client->request('POST', config_api('url_api') . '/Notification/Read', [
                'headers' => $headers,
                'json' => $data
            ]);

            $status_code = $request->getStatusCode();

            if ($status_code == 401) {
                return $this->simple_login->status_code($status_code);
            }


            $data = $request->getBody()->getContents();

            $data = json_decode($data, TRUE);
            // var_dump($data);
            // die();

            return $data;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}

/* End of file M_notifikasi.php */
