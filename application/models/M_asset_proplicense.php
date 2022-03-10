<?php


defined('BASEPATH') or exit('No direct script access allowed');

class M_asset_proplicense extends CI_Model
{

    public function data(
        $idAsset,
        $licType,
        $licStart,
        $licEnd,
        $licKey,
        $version,
        $lastUpdated,
        $propAssetProplicencehistory
    ) {
        $data = [
            "idAsset" => (int)$idAsset,
            "licType" => $licType,
            "licStart" => $licStart,
            "licEnd" => $licEnd,
            "licKey" => $licKey,
            "version" => $version,
            "lastUpdated" => $lastUpdated,
            "propAssetProplicencehistory" => $propAssetProplicencehistory
        ];

        return $data;
    }
}

/* End of file M_asset_proplicense.php */
