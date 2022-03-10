<?php


defined('BASEPATH') or exit('No direct script access allowed');

class M_asset_propinstrument extends CI_Model
{
    public function data($idAsset, $merk, $tipe, $isSet, $lastUpdated)
    {
        $data = [
            "idAsset" => (int)$idAsset,
            "merk" => $merk,
            "tipe" => $tipe,
            "isSet" => (int)$isSet,
            "lastUpdated" => $lastUpdated
        ];

        return $data;
    }
}

/* End of file M_asset_propinstrument.php */
