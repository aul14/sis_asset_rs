<?php


defined('BASEPATH') or exit('No direct script access allowed');

class M_asset_propaspak extends CI_Model
{
    public function data($idAsset, $aspakCode, $idAspak, $akdAkl, $insCode)
    {
        $data = [
            "idAsset" => (int)$idAsset,
            "aspakCode" => $aspakCode,
            "idAspak" => (int)$idAspak,
            "akdAkl" => $akdAkl,
            "insCode" => $insCode
        ];

        return $data;
    }
}

/* End of file M_asset_propaspak.php */
