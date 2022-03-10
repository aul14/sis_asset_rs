<?php


defined('BASEPATH') or exit('No direct script access allowed');

class M_asset_propmedeq extends CI_Model
{

    public function data(
        $idAsset,
        $lifetimeExpired,
        $calibrationMust,
        $calibrationCertFile,
        $lastUpdated
    ) {
        $data = [
            "idAsset" => (int)$idAsset,
            "lifetimeExpired" => $lifetimeExpired,
            "calibrationMust" => (int)$calibrationMust,
            "calibrationCertFile" => (int)$calibrationCertFile,
            "lastUpdated" => $lastUpdated,
        ];

        // echo '<pre>';
        // var_dump($data);
        // echo '<pre>';

        return $data;
    }
}

/* End of file M_asset_propmedeq.php */
