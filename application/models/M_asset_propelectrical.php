<?php


defined('BASEPATH') or exit('No direct script access allowed');

class M_asset_propelectrical extends CI_Model
{
    public function data(
        $idAsset,
        $voltageInput,
        $voltageOutput,
        $powerConsumption,
        $powerRating,
        $currentInput,
        $currentOutput,
        $lastUpdated
    ) {
        $data = [
            "idAsset" => (int)$idAsset,
            "voltageInput" => $voltageInput,
            "voltageOutput" => $voltageOutput,
            "powerConsumption" => $powerConsumption,
            "powerRating" => $powerRating,
            "currentInput" => $currentInput,
            "currentOutput" => $currentOutput,
            "lastUpdated" => $lastUpdated
        ];

        return $data;
    }
}

/* End of file M_asset_propelectrical.php */
