<?php


defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class M_asset_propfiles extends CI_Model
{
    public function assetPropFilesInsert($data)
    {
        try {
            $client = new Client();

            $headers = [
                'http_errors' => false,
                'Authorization' => config_api('auth_api'),
                "Content-Type" => "application/json",
            ];

            $request = $client->request('POST', config_api('url_api') . '/AssetPropfiles/Insert', [
                'headers' => $headers,
                'json' => $data
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

    public function assetPropFilesDeleteByIdFile($id_file)
    {
        try {
            $client = new Client();

            $headers = [
                'http_errors' => false,
                'Authorization' => config_api('auth_api'),
                "Content-Type" => "application/json",
            ];

            $request = $client->request('POST', config_api('url_api') . "/AssetPropfiles/DeleteByIdFile?idFile={$id_file}", [
                'headers' => $headers,
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

    public function assetPropFilesByIdAsset($id_asset)
    {
        try {
            $client = new Client();

            $headers = [
                'http_errors' => false,
                'Authorization' => config_api('auth_api'),
                "Content-Type" => "application/json",
            ];

            $request = $client->request('GET', config_api('url_api') . "/AssetPropfiles/ByIdAsset?idAsset={$id_asset}", [
                'headers' => $headers,
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

    public function data(
        $idAsset,
        $idFile,
        $propFileName,
        $propFileDesc
    ) {
        $data = [
            "idAsset" => $idAsset,
            "idFile" => $idFile,
            "propFileName" => $propFileName,
            "propFileDesc" => $propFileDesc,
        ];

        return $data;
    }
}

/* End of file M_asset_propfiles.php */
