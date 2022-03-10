<?php


defined('BASEPATH') or exit('No direct script access allowed');

class M_asset_propadmin extends CI_Model
{
    public function data(
        $idAsset,
        $idLocation,
        $riskLevel,
        $ownershipType,
        $condition,
        $status,
        $inactive_date,
        $yearProcurement,
        $procureDate,
        $receivedDate,
        $reff,
        $poNumb,
        $priceBuy,
        $depreciationMode,
        $keterangan,
        $idSupplier,
        $lastUpdated,
        $idBuilding,
        $idFloor,
        $idRoom,
        $idFund
    ) {
        $data = [
            "idAsset" => (int)$idAsset,
            "idLocation" => (int)$idLocation,
            "riskLevel" => $riskLevel,
            "ownershipType" => $ownershipType,
            "condition" => $condition,
            "status" => $status,
            "inactive_date" => $inactive_date,
            "yearProcurement" => $yearProcurement,
            "procureDate" => $procureDate,
            "receivedDate" => $receivedDate,
            "reff" => $reff,
            "poNumb" => $poNumb,
            "priceBuy" => $priceBuy,
            "depreciationMode" => $depreciationMode,
            "keterangan" => $keterangan,
            "idSupplier" => (int)$idSupplier,
            "lastUpdated" => $lastUpdated,
            "idBuilding" => (int)$idBuilding,
            "idFloor" => (int)$idFloor,
            "idRoom" => (int)$idRoom,
            "idFund" => (int)$idFund,
        ];

        return $data;
    }
}

/* End of file M_asset_propadmin.php */
