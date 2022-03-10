<?php


defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class M_progress extends CI_Model
{
    public function progressById($id)
    {
        try {

            $client = new Client();

            $headers = [
                'http_errors' => false,
                'Authorization' => config_api('auth_api'),
                "Content-Type" => "application/json",
            ];

            $request = $client->request('GET', config_api('url_api') . "/Progress/ByID?idProgress={$id}", [
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

    public function progressUpdate($data)
    {
        try {

            $client = new Client();

            $headers = [
                'http_errors' => false,
                'Authorization' => config_api('auth_api'),
                "Content-Type" => "application/json",
            ];

            $request = $client->request('POST', config_api('url_api') . "/Progress/Update", [
                'headers' => $headers,
                'json'    => $data
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

    public function progressInsert($data)
    {
        try {

            $client = new Client();

            $headers = [
                'http_errors' => false,
                'Authorization' => config_api('auth_api'),
                "Content-Type" => "application/json",
            ];

            $request = $client->request('POST', config_api('url_api') . "/Progress/Insert", [
                'headers' => $headers,
                'json'    => $data
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

    public function progressBulkUpdate($data)
    {
        try {

            $client = new Client();

            $headers = [
                'http_errors' => false,
                'Authorization' => config_api('auth_api'),
                "Content-Type" => "application/json",
            ];

            $request = $client->request('POST', config_api('url_api') . "/Progress/BulkUpdate", [
                'headers' => $headers,
                'json'    => $data
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
        $idProgress,
        $progressStatus,
        $timeInit,
        $timeRespon,
        $timeStart,
        $timeFinish,
        $timePending,
        $timeApproved,
        $timeDelegate,
        $timeAssign,
        $idInitBy,
        $idResponBy,
        $idStartBy,
        $idFinishBy,
        $idPendingBy,
        $idApproveBy,
        $idAssignee,
        $idDelegator,
        $initBy,
        $responBy,
        $startBy,
        $finishBy,
        $pendingBy,
        $approveBy,
        $delegateBy,
        $assignTo
    ) {
        $data = [
            "idProgress" => (int)$idProgress,
            "progressStatus" => $progressStatus,
            "timeInit" => $timeInit,
            "timeRespon" => $timeRespon,
            "timeStart" => $timeStart,
            "timeFinish" => $timeFinish,
            "timePending" => $timePending,
            "timeApproved" => $timeApproved,
            "timeDelegate" => $timeDelegate,
            "timeAssign" => $timeAssign,
            "idInitBy" => (int)$idInitBy,
            "idResponBy" => (int)$idResponBy,
            "idStartBy" => (int)$idStartBy,
            "idFinishBy" => (int)$idFinishBy,
            "idPendingBy" => (int)$idPendingBy,
            "idApproveBy" => (int)$idApproveBy,
            "idAssignee" => (int)$idAssignee,
            "idDelegator" => (int)$idDelegator,
            "initBy" => $initBy,
            "responBy" => $responBy,
            "startBy" => $startBy,
            "finishBy" => $finishBy,
            "pendingBy" => $pendingBy,
            "approveBy" => $approveBy,
            "delegateBy" => $delegateBy,
            "assignTo" => $assignTo,
        ];

        return $data;
    }
}

/* End of file M_progress.php */
