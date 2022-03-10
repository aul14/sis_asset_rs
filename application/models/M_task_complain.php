<?php


defined('BASEPATH') or exit('No direct script access allowed');

class M_task_complain extends CI_Model
{
    public function data(
        $idTask,
        $idAsset,
        $complainRequest,
        $complainAction,
        $complainPriority
    ) {
        $data = [
            'idTask' => (int)$idTask,
            'idAsset' => (int)$idAsset,
            'complainRequest' => $complainRequest,
            'complainAction' => $complainAction,
            'complainPriority' => $complainPriority
        ];

        return $data;
    }
}

/* End of file M_task_complain.php */
