<?php


defined('BASEPATH') or exit('No direct script access allowed');

class M_asset_proptax extends CI_Model
{

    public function data(
        $idAsset,
        $taxCategory,
        $expectedLifeTime,
        $cost,
        $residuVal,
        $yearlyDep,
        $accuVal,
        $bookVal,
        $currentLifeTime,
        $percentLifeTime,
        $presentDate,
        $calcStart,
        $lastUpdated
    ) {
        $data = [
            "idAsset" => (int)$idAsset,
            "taxCategory" => $taxCategory,
            "expectedLifeTime" => (float)$expectedLifeTime,
            "lifeTimeUnit" => $expectedLifeTime,
            "cost" => (float)$cost,
            "residuVal" => (float)$residuVal,
            "yearlyDep" => (float)$yearlyDep,
            "accuVal" => (float)$accuVal,
            "bookVal" => (float)$bookVal,
            "currentLifeTime" => (float)$currentLifeTime,
            "percentLifeTime" => (float)$percentLifeTime,
            "presentDate" => $presentDate,
            "calcStart" => $calcStart,
            "lastUpdated" => $lastUpdated
        ];

        return $data;
    }
}

/* End of file M_asset_proptax.php */
