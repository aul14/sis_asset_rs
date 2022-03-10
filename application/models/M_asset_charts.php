<?php

defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class M_asset_charts extends CI_Model
{

    public function asset_condition($sysCode)
    {
      try {
        $client = new Client();

        $headers = [
            'http_errors' => false,
            'Authorization' => config_api('auth_api'),
            "Content-Type" => "application/json",
        ];

        $request = $client->request('GET', config_api('url_api') . '/HdashAssetCatCondition/BySysCat?sysCat='.$sysCode, [
            'headers' => $headers
        ]);

        $status_code = $request->getStatusCode();

        if ($status_code == 401) {
          return $this->simple_login->status_code($status_code);
        }

        $data = $request->getBody()->getContents();

        $data = json_decode($data, TRUE);

        return $data;
      } catch (\Exception $th) {
        return $th->getMessage();
      }

    }
    public function asset_lifetime($sysCode)
    {
      try {
        $client = new Client();

        $headers = [
            'http_errors' => false,
            'Authorization' => config_api('auth_api'),
            "Content-Type" => "application/json",
        ];

        $request = $client->request('GET', config_api('url_api') . '/HdashAssetAgeCount/BySysCat?sysCat='.$sysCode, [
            'headers' => $headers
        ]);

        $status_code = $request->getStatusCode();

        if ($status_code == 401) {
          return $this->simple_login->status_code($status_code);
        }

        $data = $request->getBody()->getContents();

        $data = json_decode($data, TRUE);

        return $data;
      } catch (\Exception $th) {
        return $th->getMessage();
      }
    }
    public function asset_ownership($sysCode)
    {
      try {
        $client = new Client();

        $headers = [
            'http_errors' => false,
            'Authorization' => config_api('auth_api'),
            "Content-Type" => "application/json",
        ];

        $request = $client->request('GET', config_api('url_api') . '/HdashAssetOwnership/BySysCat?sysCat='.$sysCode, [
            'headers' => $headers
        ]);

        $status_code = $request->getStatusCode();

        if ($status_code == 401) {
          return $this->simple_login->status_code($status_code);
        }

        $data = $request->getBody()->getContents();

        $data = json_decode($data, TRUE);

        return $data;
      } catch (\Exception $th) {
        return $th->getMessage();
      }
    }
    public function asset_depreciation($sysCode)
    {
      try {
        $client = new Client();

        $headers = [
            'http_errors' => false,
            'Authorization' => config_api('auth_api'),
            "Content-Type" => "application/json",
        ];

        $request = $client->request('GET', config_api('url_api') . '/HdashAssetDepreciation/BySysCat?sysCat='.$sysCode, [
            'headers' => $headers
        ]);

        $status_code = $request->getStatusCode();

        if ($status_code == 401) {
          return $this->simple_login->status_code($status_code);
        }

        $data = $request->getBody()->getContents();

        $data = json_decode($data, TRUE);

        return $data;
      } catch (\Exception $th) {
        return $th->getMessage();
      }
    }
}
