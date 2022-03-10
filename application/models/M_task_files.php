<?php


defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class M_task_files extends CI_Model
{
    public function data(
        $idTaskFile,
        $idTask,
        $idFile,
        $fileDesc
    ) {
        $data = [
            "idTaskFile" => (int)$idTaskFile,
            "idTask" => (int)$idTask,
            "idFile" => (int)$idFile,
            "fileDesc" => $fileDesc,
        ];

        return $data;
    }

    public function taskFilesByIdTask($id_task)
    {
        try {

            $client = new Client();

            $headers = [
                'http_errors' => false,
                'Authorization' => config_api('auth_api'),
                "Content-Type" => "application/json",
            ];

            $request = $client->request('GET', config_api('url_api') . "/TaskFiles/ByIdTask?idTask={$id_task}", [
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

/* End of file M_task_files.php */
