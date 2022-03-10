<?php


defined('BASEPATH') or exit('No direct script access allowed');

class M_task_repair extends CI_Model
{
    public function data(
        $idTask,
        $idAsset,
        $idComplain,
        $idForm,
        $isPending,
        $isNeedPart,
        $repairProblem,
        $repairResult,
        $repairAction,
        $repairNote
    ) {
        $data = [
            'idTask' => (int)$idTask,
            'idAsset' => (int)$idAsset,
            'idComplain' => (int)$idComplain,
            'idForm' => (int)$idForm,
            'isPending' => (int)$isPending,
            'isNeedPart' => (int)$isNeedPart,
            'repairProblem' => $repairProblem,
            'repairResult' => $repairResult,
            'repairAction' => $repairAction,
            'repairNote' => $repairNote
        ];

        return $data;
    }
}

/* End of file M_task_repair.php */
