<?php


defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class M_brand extends CI_Model
{

    public function brandQuery($data)
    {
        try {

            $client = new Client();

            $headers = [
                'http_errors' => false,
                'Authorization' => config_api('auth_api'),
                "Content-Type" => "application/json",
            ];

            $request = $client->request('POST', config_api('url_api') . '/Brand/Query', [
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

    public function brandById($id_brand)
    {
        try {

            $client = new Client();

            $headers = [
                'http_errors' => false,
                'Authorization' => config_api('auth_api'),
                "Content-Type" => "application/json",
            ];

            $request = $client->request('GET', config_api('url_api') . "/Brand/ByID?idBrand={$id_brand}", [
                'headers' => $headers,
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

    public function brandInsert($data)
    {
        try {

            $client = new Client();

            $headers = [
                'http_errors' => false,
                'Authorization' => config_api('auth_api'),
                "Content-Type" => "application/json",
            ];

            $request = $client->request('POST', config_api('url_api') . '/Brand/Insert', [
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

    public function brandUpdate($data)
    {
        try {

            $client = new Client();

            $headers = [
                'http_errors' => false,
                'Authorization' => config_api('auth_api'),
                "Content-Type" => "application/json",
            ];

            $request = $client->request('POST', config_api('url_api') . '/Brand/Update', [
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

    public function brandDelete($idBrand)
    {
        try {

            $client = new Client();

            $headers = [
                'http_errors' => false,
                'Authorization' => config_api('auth_api'),
                "Content-Type" => "application/json",
            ];

            $request = $client->request('POST', config_api('url_api') . "/Brand/Delete?idBrand={$idBrand}", [
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
}

/* End of file M_brand.php */
