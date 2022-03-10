<?php


defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class M_form_services extends CI_Model
{
    public function formServicesByIdForm($id_form)
    {
        try {

            $client = new Client();

            $headers = [
                'http_errors' => false,
                'Authorization' => config_api('auth_api'),
                "Content-Type" => "application/json",
            ];

            $request = $client->request('GET', config_api('url_api') . "/FormServices/ByIdForm?idForm={$id_form}", [
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

    public function formServicesInsert($data)
    {
        try {

            $client = new Client();

            $headers = [
                'http_errors' => false,
                'Authorization' => config_api('auth_api'),
                "Content-Type" => "application/json",
            ];

            $request = $client->request('POST', config_api('url_api') . '/FormServices/Insert', [
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

    public function formServicesDelete($idFServices)
    {
        try {

            $client = new Client();

            $headers = [
                'http_errors' => false,
                'Authorization' => config_api('auth_api'),
                "Content-Type" => "application/json",
            ];

            $request = $client->request('POST', config_api('url_api') . "/FormServices/Delete?idFService={$idFServices}", [
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
}

/* End of file M_form_gen.php */
