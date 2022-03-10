<?php


defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class M_asset_propbuilding extends CI_Model
{
    public function data(
        $idAsset,
        $buildingName,
        $gpsLonglat,
        $lastUpdated,
        $buildingCode,
        $buildingDesc,
        $city,
        $phone,
        $luasTanah,
        $luasBangunan
    ) {
        $data = [
            "idAsset" => (int)$idAsset,
            "buildingName" => $buildingName,
            "gpsLonglat" => $gpsLonglat,
            "lastUpdated" => $lastUpdated,
            "buildingCode" => $buildingCode,
            "buildingDesc" => $buildingDesc,
            "city" => $city,
            "phone" => $phone,
            "luasTanah" => $luasTanah,
            "luasBangunan" => $luasBangunan,
        ];

        return $data;
    }

    public function assetPropbuildingById($id_asset)
    {
        try {

            $client = new Client();

            $headers = [
                'http_errors' => false,
                'Authorization' => config_api('auth_api'),
                "Content-Type" => "application/json",
            ];

            $request = $client->request('GET', config_api('url_api') . "/AssetPropbuilding/ByID?idAsset={$id_asset}", [
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

    public function assetPropbuildingQuery($data)
    {
        try {

            $client = new Client();

            $headers = [
                'http_errors' => false,
                'Authorization' => config_api('auth_api'),
                "Content-Type" => "application/json",
            ];

            $request = $client->request('POST', config_api('url_api') . "/AssetPropbuilding/Query", [
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
}

/* End of file M_asset_propbuilding.php */
