<?php


defined('BASEPATH') or exit('No direct script access allowed');

class M_asset_propsimak extends CI_Model
{

    public function data($idAsset, $simakCode, $nup)
    {
        $data = [
            "idAsset" => (int)$idAsset,
            "simakCode" => $simakCode,
            "nup" => (int)$nup,
        ];


        return $data;
    }
}

/* End of file M_asset_propsimak.php */
