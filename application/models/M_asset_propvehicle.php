<?php


defined('BASEPATH') or exit('No direct script access allowed');

class M_asset_propvehicle extends CI_Model
{

    public function data(
        $idAsset,
        $platNumber,
        $frameNumber,
        $machineNumber,
        $bpkbNumber,
        $vCC,
        $vColor,
        $lastUpdated
    ) {
        $data = [
            "idAsset" => (int)$idAsset,
            "platNumber" => $platNumber,
            "frameNumber" => $frameNumber,
            "machineNumber" => $machineNumber,
            "bpkbNumber" => $bpkbNumber,
            "vCC" => $vCC,
            "vColor" => $vColor,
            "lastUpdated" => $lastUpdated
        ];

        return $data;
    }
}

/* End of file M_asset_propvehicle.php */
