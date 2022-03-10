<?php


defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class M_master_simak extends CI_Model
{
    public function simakQuery($data)
    {
        try {

            $client = new Client();

            $headers = [
                'http_errors' => false,
                'Authorization' => config_api('auth_api'),
                "Content-Type" => "application/json",
            ];

            $request = $client->request('POST', config_api('url_api') . '/MasterSimak/Query', [
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
    public function masterSimakBySimakCode($simak_code)
    {
        try {

            $client = new Client();

            $headers = [
                'http_errors' => false,
                'Authorization' => config_api('auth_api'),
                "Content-Type" => "application/json",
            ];

            $request = $client->request('GET', config_api('url_api') . "/MasterSimak/BySimakCode?simakCode={$simak_code}", [
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

    public function data($simakCode, $simakUraian, $simakParent)
    {
        $data = [
            "simakCode" => $simakCode,
            "simakUraian" => $simakUraian,
            "simakParent" => $simakParent
        ];

        return $data;
    }
}

/* End of file M_master_simak.php */
