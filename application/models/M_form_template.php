<?php


defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class M_form_template extends CI_Model
{
    public function formTemplateQuery($data)
    {
        try {

            $client = new Client();

            $headers = [
                'http_errors' => false,
                'Authorization' => config_api('auth_api'),
                "Content-Type" => "application/json",
            ];

            $request = $client->request('POST', config_api('url_api') . "/FormTemplate/Query", [
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

    public function formTemplateInsert($data)
    {
        try {

            $client = new Client();

            $headers = [
                'http_errors' => false,
                'Authorization' => config_api('auth_api'),
                "Content-Type" => "application/json",
            ];

            $request = $client->request('POST', config_api('url_api') . "/FormTemplate/Insert", [
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

    public function formTemplateUpdate($data)
    {
        try {

            $client = new Client();

            $headers = [
                'http_errors' => false,
                'Authorization' => config_api('auth_api'),
                "Content-Type" => "application/json",
            ];

            $request = $client->request('POST', config_api('url_api') . "/FormTemplate/Update", [
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

    public function formTemplateDelete($idFormTemplate)
    {
        try {

            $client = new Client();

            $headers = [
                'http_errors' => false,
                'Authorization' => config_api('auth_api'),
                "Content-Type" => "application/json",
            ];

            $request = $client->request('POST', config_api('url_api') . "/FormTemplate/Delete?idFormTemplate={$idFormTemplate}", [
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

    public function formTemplateById($idFormTemplate)
    {
        try {

            $client = new Client();

            $headers = [
                'http_errors' => false,
                'Authorization' => config_api('auth_api'),
                "Content-Type" => "application/json",
            ];

            $request = $client->request('GET', config_api('url_api') . "/FormTemplate/ByID?idFormTemplate={$idFormTemplate}", [
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

    public function formTemplateByIdAssetMaster($idAssetMaster)
    {
        try {

            $client = new Client();

            $headers = [
                'http_errors' => false,
                'Authorization' => config_api('auth_api'),
                "Content-Type" => "application/json",
            ];

            $request = $client->request('GET', config_api('url_api') . "/FormTemplate/ByIdAssetMaster?idAssetMaster={$idAssetMaster}", [
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

    public function formTemplateByTypeMaster($idAssetMaster, $idFormType)
    {
        try {

            $client = new Client();

            $headers = [
                'http_errors' => false,
                'Authorization' => config_api('auth_api'),
                "Content-Type" => "application/json",
            ];

            $request = $client->request('GET', config_api('url_api') . "/FormTemplate/ByTypeMaster?idAssetMaster={$idAssetMaster}&idFormType={$idFormType}", [
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

/* End of file M_form_template.php */
