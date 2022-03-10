<?php
defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;
/**
 *
 */
class M_task_charts extends CI_Model
{

  public function task_calibration($sysCode)
  {
    try {
      $client = new Client();

      $headers = [
          'http_errors' => false,
          'Authorization' => config_api('auth_api'),
          "Content-Type" => "application/json",
      ];

      $request = $client->request('GET', config_api('url_api') . '/HdashTaskCalib/BySysCat?sysCat='.$sysCode, [
          'headers' => $headers
      ]);

      $status_code = $request->getStatusCode();

      if ($status_code == 401) {
        return $this->simple_login->status_code($status_code);
      }

      $data = $request->getBody()->getContents();

      $data = json_decode($data, TRUE);

      return $data;
    } catch (\Exception $e) {
      return $e->getMessage();
    }
  }
  public function task_inspection($sysCode)
  {
    try {
      $client = new Client();

      $headers = [
          'http_errors' => false,
          'Authorization' => config_api('auth_api'),
          "Content-Type" => "application/json",
      ];

      $request = $client->request('GET', config_api('url_api') . '/HdashTaskInspection/BySysCat?sysCat='.$sysCode, [
          'headers' => $headers
      ]);

      $status_code = $request->getStatusCode();

      if ($status_code == 401) {
        return $this->simple_login->status_code($status_code);
      }

      $data = $request->getBody()->getContents();

      $data = json_decode($data, TRUE);

      return $data;
    } catch (\Exception $e) {
      return $e->getMessage();
    }
  }
  public function task_maintenance($sysCode)
  {
    try {
      $client = new Client();

      $headers = [
          'http_errors' => false,
          'Authorization' => config_api('auth_api'),
          "Content-Type" => "application/json",
      ];

      $request = $client->request('GET', config_api('url_api') . '/HdashTaskMaintenance/BySysCat?sysCat='.$sysCode, [
          'headers' => $headers
      ]);

      $status_code = $request->getStatusCode();

      if ($status_code == 401) {
        return $this->simple_login->status_code($status_code);
      }

      $data = $request->getBody()->getContents();

      $data = json_decode($data, TRUE);

      return $data;
    } catch (\Exception $e) {
      return $e->getMessage();
    }
  }
  public function task_complain_repair($sysCode)
  {
    try {
      $client = new Client();

      $headers = [
          'http_errors' => false,
          'Authorization' => config_api('auth_api'),
          "Content-Type" => "application/json",
      ];

      $request = $client->request('GET', config_api('url_api') . '/HdashTaskComplain/BySysCat?sysCat='.$sysCode, [
          'headers' => $headers
      ]);

      $status_code = $request->getStatusCode();

      if ($status_code == 401) {
        return $this->simple_login->status_code($status_code);
      }

      $data = $request->getBody()->getContents();

      $data = json_decode($data, TRUE);

      return $data;
    } catch (\Exception $e) {
      return $e->getMessage();
    }
  }
  public function task_mutation($sysCode)
  {
    try {
      $client = new Client();

      $headers = [
          'http_errors' => false,
          'Authorization' => config_api('auth_api'),
          "Content-Type" => "application/json",
      ];

      $request = $client->request('GET', config_api('url_api') . '/HdashTaskMutation/BySysCat?sysCat='.$sysCode, [
          'headers' => $headers
      ]);

      $status_code = $request->getStatusCode();

      if ($status_code == 401) {
        return $this->simple_login->status_code($status_code);
      }

      $data = $request->getBody()->getContents();

      $data = json_decode($data, TRUE);

      return $data;
    } catch (\Exception $e) {
      return $e->getMessage();
    }
  }
}
