<?php


defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class M_progress_detail extends CI_Model
{
    public function byIdProgress($idProgress)
    {
        try {

            $client = new Client();

            $headers = [
                'http_errors' => false,
                'Authorization' => config_api('auth_api'),
                "Content-Type" => "application/json",
            ];

            $request = $client->request('GET', config_api('url_api') . "/ProgressDetail/ByIdProgress?idProgress={$idProgress}", [
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

    public function data(
        $idProgresDet,
        $idProgress,
        $pdetStatus,
        $pdetDesc,
        $pdetTime
    ) {
        $data = [
            "idProgresDet" => (int)$idProgresDet,
            "idProgress" => (int)$idProgress,
            "pdetStatus" => $pdetStatus,
            "pdetDesc" => $pdetDesc,
            "pdetTime" => $pdetTime
        ];

        return $data;
    }
}

/* End of file M_progress_detail.php */
