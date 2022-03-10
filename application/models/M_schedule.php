<?php


defined('BASEPATH') or exit('No direct script access allowed');

class M_schedule extends CI_Model
{
    public function data(
        $idSchedule,
        $parentSchedule,
        $scheduleType,
        $scheduleName,
        $scheduleDesc,
        $scheduleStart,
        $scheduleEnd,
        $dayRepeat,
        $createBy,
        $scheduleSysCat
    ) {
        $data = [
            "idSchedule" => (int)$idSchedule,
            "parentSchedule" => (int)$parentSchedule,
            "scheduleType" => $scheduleType,
            "scheduleName" => $scheduleName,
            "scheduleDesc" => $scheduleDesc,
            "scheduleStart" => $scheduleStart,
            "scheduleEnd" => $scheduleEnd,
            "dayRepeat" => $dayRepeat,
            "createBy" => $createBy,
            "scheduleSysCat" => $scheduleSysCat,
        ];

        return $data;
    }
}

/* End of file M_schedule.php */
