<?php


defined('BASEPATH') or exit('No direct script access allowed');

class M_asset_propgenit extends CI_Model
{
    public function data_propfilecat($idFileCat, $fileCatName, $fileCatDesc, $fileCatType)
    {
        $data = [
            "idFileCat"    => (int)$idFileCat,
            "fileCatName"    => $fileCatName,
            "fileCatDesc"    => $fileCatDesc,
            "fileCatType"    => $fileCatType
        ];

        return $data;
    }

    public function data_propfile($idFile, $idFileCat, $docNumber, $fileName, $fileExt, $fileLocation, $fileSize, $createBy, $createDate)
    {
        $data = [
            "idFile"    => (int)$idFile,
            "idFileCat"    => (int)$idFileCat,
            "docNumber"    => $docNumber,
            "fileName"    => $fileName,
            "fileExt"    => $fileExt,
            "fileLocation"    => $fileLocation,
            "fileSize"    => $fileSize,
            "createBy"    => $createBy,
            "createDate"    => $createDate
        ];

        return $data;
    }

    public function data(
        $idAsset,
        $idFilePicture,
        $merk,
        $tipe,
        $spesifikasi,
        $manufacture,
        $serialNumber,
        $dimension,
        $warrantyExpired,
        $lastUpdated,
        $idSupplier
    ) {
        $data = [
            "idAsset" => (int)$idAsset,
            "idFilePicture" => (int)$idFilePicture,
            "merk" => $merk,
            "tipe" => $tipe,
            "spesifikasi" => $spesifikasi,
            "manufacture" => $manufacture,
            "serialNumber" => $serialNumber,
            "dimension" => $dimension,
            "warrantyExpired" => $warrantyExpired,
            "lastUpdated" => $lastUpdated,
            "idSupplier" => (int)$idSupplier,
        ];


        return $data;
    }
}

/* End of file M_asset_propgenit.php */
