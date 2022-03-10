<?php

defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class M_task_mutation extends CI_Model
{

  public function query($data)
  {
    try {

      $client = new Client();

      $headers = [
        'http_errors' => false,
        'Authorization' => config_api('auth_api'),
        "Content-Type" => "application/json",
      ];

      $request = $client->request('POST', config_api('url_api') . '/TaskMutation/Query', [
        'headers' => $headers,
        'json' => $data
      ]);

      $status_code = $request->getStatusCode();

      if ($status_code == 401) {
        return $this->simple_login->status_code($status_code);
      }


      $data = $request->getBody()->getContents();

      $data = json_decode($data, TRUE);
    } catch (\Exception $e) {
    }
  }

  public function data(
    $idTask,
    $idAsset,
    $mutationStatus,
    $mutationScope,
    $mutationType,
    $mutationDesc,
    $returnDatePlan,
    $srcRoomID,
    $srcRoomName,
    $srcHospName,
    $dstRoomID,
    $dstRoomName,
    $dstHospName,
    $mutationNote
  ) {
    $data = [
      "idTask" => (int)$idTask,
      "idAsset" => (int)$idAsset,
      "mutationStatus" => $mutationStatus,
      "mutationScope" => $mutationScope,
      "mutationType" => $mutationType,
      "mutationDesc" => $mutationDesc,
      "returnDatePlan" => $returnDatePlan,
      "srcRoomID" => $srcRoomID,
      "srcRoomName" => $srcRoomName,
      "srcHospName" => $srcHospName,
      "dstRoomID" => $dstRoomID,
      "dstRoomName" => $dstRoomName,
      "dstHospName" => $dstHospName,
      "mutationNote" => $mutationNote,
    ];

    return $data;
  }
}
