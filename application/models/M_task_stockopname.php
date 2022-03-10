<?php


defined('BASEPATH') or exit('No direct script access allowed');

class M_task_stockopname extends CI_Model
{
    public function data(
        $idTaskOpname,
        $idTask,
        $taskDesc,
        $lastUpdated
    ) {
        $data = [
            "idTaskOpname" => (int)$idTaskOpname,
            "idTask" => (int)$idTask,
            "taskDesc" => $taskDesc,
            "lastUpdated" => $lastUpdated,
        ];

        return $data;
    }
}

/* End of file M_task_stockopname.php */
