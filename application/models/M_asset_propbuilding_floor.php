<?php


defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class M_asset_propbuilding_floor extends CI_Model
{
    public function data($idBuilding, $buildingName, $idFloor, $floorNumber, $floorCode, $floorName, $floorDesc)
    {
        $data = [
            "idBuilding" => (int)$idBuilding,
            "buildingName" => $buildingName,
            "idFloor" => (int)$idFloor,
            "floorNumber" => (int)$floorNumber,
            "floorCode" => $floorCode,
            "floorName" => $floorName,
            "floorDesc" => $floorDesc,
        ];

        return $data;
    }

    public function assetPropbuildingFlooeById($id_floor)
    {
        try {

            $client = new Client();

            $headers = [
                'http_errors' => false,
                'Authorization' => config_api('auth_api'),
                "Content-Type" => "application/json",
            ];

            $request = $client->request('GET', config_api('url_api') . "/AssetPropbuildingFloor/ByID?idFloor={$id_floor}", [
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

    public function assetPropbuildingFloorByIdBuilding($id_building)
    {
        try {

            $client = new Client();

            $headers = [
                'http_errors' => false,
                'Authorization' => config_api('auth_api'),
                "Content-Type" => "application/json",
            ];

            $request = $client->request('GET', config_api('url_api') . "/AssetPropbuildingFloor/ByIdBuilding?idBuilding={$id_building}", [
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

/* End of file M_asset_propbuilding_floor.php */
