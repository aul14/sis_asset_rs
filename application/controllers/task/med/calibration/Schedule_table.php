<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Schedule_table extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->simple_login->cek_login(); // cek login
        $this->load->model([
            'M_task'                => 'm_task',
            'M_asset'               => 'm_asset',
            'M_file'                => 'm_file',
            'M_file_cat'            => 'm_file_cat',
            'M_task_complain'       => 'm_task_complain',
            'M_progress'            => 'm_progress',
            'M_task_files'          => 'm_task_files',
            'M_task_calibration'          => 'm_task_calibration',
            'M_contact'          => 'm_contact',
            'M_schedule'          => 'm_schedule',
        ]);
    }


    public function index()
    {
        $data['BULAN'] = array('1' => 'January', '2' => 'February', '3' => 'March', '4' => 'April', '5' => 'May', '6' => 'June', '7' => 'July', '8' => 'August', '9' => 'September', '10' => 'October', '11' => 'November', '12' => 'December');

        $scheduleSysCat = "MED";

        if ($this->input->get('years') == "" && $this->input->get('month') == "") {

            $date_next = new DateTime(date('Y-m-d'));
            $date_next->modify('first day of this month');
            $start_schedule = $date_next->format('Y-m-d');

            $date_prev = new DateTime(date('Y-m-d'));
            $date_prev->modify('last day of this month');
            $end_schedule = $date_prev->format('Y-m-d');
        } else {
            $date_next = new DateTime(date("{$this->input->get('years')}-{$this->input->get('month')}-d"));
            $date_next->modify('first day of this month');
            $start_schedule = $date_next->format('Y-m-d');

            $date_prev = new DateTime(date("{$this->input->get('years')}-{$this->input->get('month')}-d"));
            $date_prev->modify('last day of this month');
            $end_schedule = $date_prev->format('Y-m-d');
        }

        $scheduleStart = $start_schedule;

        $scheduleEnd = $end_schedule;

        $idAsset = $this->input->get('idAsset');
        $idRoom = $this->input->get('idRoom');
        $idFinishBy = $this->input->get('idFinishBy');

        $taskCode = "CAL";

        $query_params = [];
        $query_groups = [];

        $query_params_where_between = [];
        $query_groups_where_between = [];

        $query_params_exactor = [];
        $query_groups_exactor = [];

        if ($taskCode != '') {
            $taskCode_query_params = [
                "column" => "taskCode",
                "value" => $taskCode
            ];
            array_push($query_params_exactor, $taskCode_query_params);
        }

        if ($scheduleSysCat != '') {

            $scheduleSysCat_query_params = [
                "column" => "taskSysCat",
                "value" => $scheduleSysCat
            ];
            array_push($query_params, $scheduleSysCat_query_params);
        }

        if ($idAsset != '') {
            $idAsset_query_params = [
                "column" => "idAsset",
                "value" => $idAsset
            ];
            array_push($query_params, $idAsset_query_params);
        }

        if ($idRoom != '') {
            $idRoom_query_params = [
                "column" => "idRoom",
                "value" => $idRoom
            ];
            array_push($query_params, $idRoom_query_params);
        }

        if ($idFinishBy != '') {
            $idFinishBy_query_params = [
                "column" => "idFinishBy",
                "value" => $idFinishBy
            ];
            array_push($query_params, $idFinishBy_query_params);
        }

        if ($scheduleStart != '') {

            $scheduleStart_query_params = [
                "column" => "scheduleStart",
                "value" => $scheduleStart
            ];
            array_push($query_params_where_between, $scheduleStart_query_params);
        }

        if ($scheduleEnd != '') {

            $scheduleEnd_query_params = [
                "column" => "scheduleEnd",
                "value" => $scheduleEnd
            ];
            array_push($query_params_where_between, $scheduleEnd_query_params);
        }

        if ($taskCode != '') {
            $query_groups_exactor = [
                [
                    "queryMethod" => "EXACTOR",
                    "queryParams" => $query_params_exactor
                ]
            ];
        }

        if ($scheduleSysCat != '' || $idAsset != '' || $idRoom != '' || $idFinishBy != '') {
            $query_groups = [
                [
                    "queryMethod" => "LIKEAND",
                    "queryParams" => $query_params
                ]
            ];
        }

        if ($scheduleStart != '' || $scheduleEnd != '') {
            $query_groups_where_between = [
                [
                    "queryMethod" => "BETWEEN",
                    "queryParams" => $query_params_where_between
                ]
            ];
        }

        $merge_query_groups = array_merge($query_groups, $query_groups_where_between);
        $merge_query_groups = array_merge($merge_query_groups, $query_groups_exactor);

        $request = [
            "queryGroupMethod" => "AND",
            "queryGroups" => $merge_query_groups ? $merge_query_groups : [],
        ];

        $simpleQuery = '';
        if ($taskCode != '') {
            // if ($taskCode == 'MTN') {
            //     $simpleQuery = $this->Task_maintenance_model->simple_query($request);
            // } else if ($taskCode == 'INP') {
            //     $simpleQuery = $this->Task_inspection_model->simple_query($request);
            // } else if ($taskCode == 'CAL') {
            $simpleQuery = $this->m_task->taskQuery($request);
            // }
        }

        $schedules = $simpleQuery;

        $newSchedules = [];
        if (isset($schedules['data'])) {
            foreach ($schedules['data'] as $schedule) {
                if ($schedule['propTaskCalibration']) {
                    foreach ($schedule['propTaskCalibration'] as $key2 => $propTaskCalibration) {

                        if (isset($propTaskCalibration['propItemProgress']['progressStatus'])) {
                            $propProgress = $propTaskCalibration['propItemProgress']['progressStatus'];
                        } else {
                            $propProgress = $schedule['propProgress']['progressStatus'];
                        }

                        $newSchedules[] = [
                            "id" => $schedule['propSchedule']['idSchedule'] . ' ' . $schedule['propProgress']['progressStatus'],
                            "idReal" => $schedule['propSchedule']['idSchedule'],
                            "start" => $schedule['propSchedule']['scheduleStart'],
                            "end" => $schedule['propSchedule']['scheduleStart'],
                            "idTask" => $schedule['idTask'],
                            "idAsset" => $propTaskCalibration['propAsset']['idAsset'],
                            "assetName" => $propTaskCalibration['propAsset']['assetName'],
                            "assetCode" => $propTaskCalibration['propAsset']['assetCode'],
                            "roomName" => $propTaskCalibration['propAsset']['propAssetPropadmin']['propAssetPropbuildingRoom']['roomName'],
                            "progressStatus" => $propProgress
                        ];
                    }
                }
            }
        }
        // echo "<pre>";
        // var_dump($newSchedules);
        // die;
        // echo "</pre>";
        $data['schedule'] = $newSchedules;
        $data['scheduleSysCat'] = $scheduleSysCat;

        $result_role = $this->m_access_control->MyRole()['data']['roleACL'];

        $data['result_role'] = $result_role;
        $this->load->model('M_notifikasi', 'm_notifikasi');
        $data['notif'] = $this->m_notifikasi->list()['data'];

        if ($result_role[2]['subMenu1'][0]['subMenu2'][0]['subMenu3'][1]['isAllow'] != true) {
            exit('You dont have access!!');
        }

        $this->load->view('components/header');
        $this->load->view('components/sidebar', $data);
        $this->load->view('task/electromedic_task/calibration_schedule_med_table', $data);
        $this->load->view('task/task');
        $this->load->view('components/footer');
        $this->load->view('components/sidebar_footer');
    }

    public function calendar()
    {

        $scheduleSysCat = "MED";

        $date_next = new DateTime(date('Y-m-d'));
        $date_next->modify('first day of this month');

        $date_prev = new DateTime(date('Y-m-d'));
        $date_prev->modify('last day of this month');

        $start_schedule = ($this->input->get('start_date')) ?  $this->input->get('start_date') : $date_next->format('Y-m-d');
        $end_schedule = ($this->input->get('end_date')) ?  $this->input->get('end_date') : $date_prev->format('Y-m-d');

        $scheduleStart = $start_schedule;

        $scheduleEnd = $end_schedule;

        $taskCode = "CAL";

        $query_params = [];
        $query_groups = [];

        $query_params_where_between = [];
        $query_groups_where_between = [];

        $query_params_exactor = [];
        $query_groups_exactor = [];

        if ($taskCode != '') {
            $taskCode_query_params = [
                "column" => "taskCode",
                "value" => $taskCode
            ];
            array_push($query_params_exactor, $taskCode_query_params);
        }

        if ($scheduleSysCat != '') {

            $scheduleSysCat_query_params = [
                "column" => "taskSysCat",
                "value" => $scheduleSysCat
            ];
            array_push($query_params, $scheduleSysCat_query_params);
        }

        if ($scheduleStart != '') {

            $scheduleStart_query_params = [
                "column" => "scheduleStart",
                "value" => $scheduleStart
            ];
            array_push($query_params_where_between, $scheduleStart_query_params);
        }

        if ($scheduleEnd != '') {

            $scheduleEnd_query_params = [
                "column" => "scheduleEnd",
                "value" => $scheduleEnd
            ];
            array_push($query_params_where_between, $scheduleEnd_query_params);
        }

        if ($taskCode != '') {
            $query_groups_exactor = [
                [
                    "queryMethod" => "EXACTOR",
                    "queryParams" => $query_params_exactor
                ]
            ];
        }

        if ($scheduleSysCat != '') {
            $query_groups = [
                [
                    "queryMethod" => "LIKEAND",
                    "queryParams" => $query_params
                ]
            ];
        }

        if ($scheduleStart != '' || $scheduleEnd != '') {
            $query_groups_where_between = [
                [
                    "queryMethod" => "BETWEEN",
                    "queryParams" => $query_params_where_between
                ]
            ];
        }

        $merge_query_groups = array_merge($query_groups, $query_groups_where_between);
        $merge_query_groups = array_merge($merge_query_groups, $query_groups_exactor);

        $request = [
            "queryGroupMethod" => "AND",
            "queryGroups" => $merge_query_groups ? $merge_query_groups : [],
            "page" => 1,
            "limit" => 0
        ];

        $simpleQuery = '';
        if ($taskCode != '') {
            // if ($taskCode == 'MTN') {
            //     $simpleQuery = $this->Task_maintenance_model->simple_query($request);
            // } else if ($taskCode == 'INP') {
            //     $simpleQuery = $this->Task_inspection_model->simple_query($request);
            // } else if ($taskCode == 'CAL') {
            $simpleQuery = $this->m_task_calibration->simple_query($request);
            // }
        }

        $schedules = $simpleQuery;

        $newSchedules = [];
        if (isset($schedules['data'])) {
            foreach ($schedules['data'] as $schedule) {

                $newSchedules[] = [
                    "id" => $schedule['propSchedule']['idSchedule'] . ' ' . $schedule['propProgress']['progressStatus'],
                    "idReal" => $schedule['propSchedule']['idSchedule'],
                    "title" => $schedule['assetCode'] . '/' . $schedule['assetName'] . '/' . $schedule['roomName'] . '/' . $schedule['floorName'] . '/' . $schedule['buildingName'],
                    "start" => $schedule['propSchedule']['scheduleStart'],
                    "end" => $schedule['propSchedule']['scheduleStart'],
                    "idTask" => $schedule['idTask'],
                    "idAsset" => $schedule['idAsset'],
                    "assetName" => $schedule['assetName'],
                    "assetCode" => $schedule['assetCode'],
                    "roomName" => $schedule['roomName'],
                    "progressStatus" => $schedule['propProgress']['progressStatus'],
                    "className" => ['#ED1317']

                ];
            }
        }

        // echo json_encode($schedules);
        echo json_encode($newSchedules);
        // return $schedules;
    }
}
