<?php


defined('BASEPATH') or exit('No direct script access allowed');

class M_asset_propland extends CI_Model
{

    public function data(
        $idAsset,
        $certNumber,
        $areal,
        $lastUpdated
    ) {
        $data = [
            "idAsset" => (int)$idAsset,
            "certNumber" => $certNumber,
            "areal" => $areal,
            "lastUpdated" => $lastUpdated
        ];

        return $data;
    }
}

/* End of file M_asset_propland.php */
