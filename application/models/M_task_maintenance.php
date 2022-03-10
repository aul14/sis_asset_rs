<?php


defined('BASEPATH') or exit('No direct script access allowed');

class M_task_maintenance extends CI_Model
{
    public function data(
        $idTask,
        $idAsset,
        $isNeedPart,
        $idForm,
        $idFormTemplate,
        $maintenanceResult,
        $maintenanceNote
    ) {
        $data = [
            'idTask' => (int)$idTask,
            'idAsset' => (int)$idAsset,
            'isNeedPart' => (int)$isNeedPart,
            'idForm' => (int)$idForm,
            'idFormTemplate' => (int)$idFormTemplate,
            'maintenanceResult' => $maintenanceResult,
            'maintenanceNote' => $maintenanceNote,
        ];

        return $data;
    }
}

/* End of file M_task_maintenance.php */
