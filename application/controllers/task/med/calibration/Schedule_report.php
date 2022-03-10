<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Schedule_report extends CI_Controller
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
        $data['taskCode'] = "CAL";
        $data['contact']  = $this->m_contact->contactSupplier()['data'];

        $result_role = $this->m_access_control->MyRole()['data']['roleACL'];

        $data['result_role'] = $result_role;
        $this->load->model('M_notifikasi', 'm_notifikasi');
        $data['notif'] = $this->m_notifikasi->list()['data'];

        if ($result_role[2]['subMenu1'][0]['subMenu2'][0]['subMenu3'][0]['isAllow'] != true) {
            exit('You dont have access!!');
        }

        $this->load->view('components/header');
        $this->load->view('components/sidebar', $data);
        $this->load->view('task/electromedic_task/calibration_schedule_med_report');
        $this->load->view('task/electromedic_task/form/calibration_form', $data);
        $this->load->view('task/electromedic_task/print/calibration/task_print');
        $this->load->view('components/sidebar_footer');
        $this->load->view('components/footer');
        $this->load->view('task/task');
    }

    public function by_id_calibration()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $idTask = trim($this->input->post('idTask'));
        $idAsset = trim($this->input->post('idAsset'));

        $show = $this->m_task_calibration->by_id($idTask, $idAsset)['data'];

        echo json_encode($show);
        exit;
    }

    private function task_file_upload($file, $docNumber = NULL)
    {

        $filename = $file['name'];

        $dir = 'assets/upload/file/';

        if (!is_dir($dir)) {
            mkdir($dir, 0777, TRUE);
            // chmod (FCPATH . $dir, 0777);
        }

        pathinfo($filename, PATHINFO_EXTENSION);

        $target_file = $dir . basename($filename);

        $fileCat = $this->m_file_cat->fileCatByFileCatName('CALFile');

        // chmod (FCPATH . $dir, 0777);
        if (move_uploaded_file($file["tmp_name"], $target_file)) {

            $data = [
                'idCat' => $fileCat['queryResult'] == true ? $fileCat['data']['idFileCat'] : 0,
                'folder' => $dir,
                'files' => $dir . $filename,
                'docNumber' => $docNumber,
                'userName' => $this->session->userdata('username')
            ];

            $file_upload = $this->m_file->fileUpload($data);
            // var_dump($file_upload);
            // die;

            return $file_upload;
            die();
        }

        return false;
    }

    public function update_action()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $post = $this->security->xss_clean($this->input->post());

        if ($post['finishDate'] == '') {
            $data = [
                'queryMessage' => 'implementation date is required',
                'queryResult' => false,
            ];

            echo json_encode($data);
            die();
        }

        if ($post['idVendor'] == '' || $post['idVendor'] == 0) {
            $data = [
                'queryMessage' => 'calibration institution is required',
                'queryResult' => false,
            ];

            echo json_encode($data);
            die();
        }

        if ($post['servicePrice'] == '') {
            $data = [
                'queryMessage' => 'service price is required',
                'queryResult' => false,
            ];

            echo json_encode($data);
            die();
        }

        if ($post['sertificateNumber'] == '') {
            $data = [
                'queryMessage' => 'sertificate number is required',
                'queryResult' => false,
            ];

            echo json_encode($data);
            die();
        }

        if ($post['calibrationResult'] == '') {
            $data = [
                'queryMessage' => 'calibration result is required',
                'queryResult' => false,
            ];

            echo json_encode($data);
            die();
        }

        $idTask = $post['idTaskReport'];
        $idAsset = $post['idAssetReport'];

        $query_params = [];

        if ($idTask != '') {
            $idTask_query_params = [
                "column" => "idTask",
                "value" => $idTask
            ];

            array_push($query_params, $idTask_query_params);
        }

        if ($idAsset != '') {
            $idAsset_query_params = [
                "column" => "idAsset",
                "value" => $idAsset
            ];

            array_push($query_params, $idAsset_query_params);
        }

        $query_groups = [];
        if ($idTask != '' || $idAsset != '') {
            $query_groups = [
                [
                    "queryMethod" => "EXACTAND",
                    "queryParams" => $query_params
                ]
            ];
        }

        $request = [
            "queryGroupMethod" => "AND",
            "queryGroups" => $query_groups,
            "page" => 1,
            "limit" => 1
        ];

        $posts = $this->m_task_calibration->query($request);

        $task = $this->m_task->taskById($idTask);



        $idSchedule = $task['data']['propSchedule']['idSchedule'];

        $taskCalibration = $posts['data'][0];

        $task_file = isset($_FILES['file']) ? $this->task_file_upload($_FILES['file'], $post['sertificateNumber']) : '';
        // var_dump($task_file);
        // die;
        $calitemProgress = $taskCalibration['calitemProgress'];

        if ($calitemProgress == 0) {
            $propProgress = $task['data']['propProgress'];
            $propProgress['idProgress'] = $task['data']['propProgress']['idProgress'];

            $propProgress['timeFinish'] = $post['finishDate'];
            $propProgress['finishBy'] = $this->session->userdata('username');
            $propProgress['idFinishBy'] = $this->session->userdata('id_user');

            $propProgress['timeApproved'] = $post['finishDate'];
            $propProgress['approveBy'] = $this->session->userdata('username');
            $propProgress['idApproveBy'] = $this->session->userdata('id_user');

            $insertProgress = $this->m_progress->progressUpdate($propProgress);
        } else {
            $propProgress = $taskCalibration['propProgress'];

            $propProgress['timeFinish'] = $post['finishDate'];
            $propProgress['finishBy'] = $this->session->userdata('username');
            $propProgress['idFinishBy'] = $this->session->userdata('id_user');

            $propProgress['timeApproved'] = $post['finishDate'];
            $propProgress['approveBy'] = $this->session->userdata('username');
            $propProgress['idApproveBy'] = $this->session->userdata('id_user');
        }

        $taskCalibration['calitemProgress'] =  (int)$task['data']['propProgress']['idProgress'];
        $taskCalibration['calitemSchedule'] = (int)$idSchedule;
        $taskCalibration['calitemVendor'] = isset($post['idVendor']) ? (int)$post['idVendor'] : 0;
        $taskCalibration['calitemPrice'] = (float)$post['servicePrice'];
        $taskCalibration['calibResult'] = $post['calibrationResult'];
        $taskCalibration['noteCalib'] = $post['note'];


        if (isset($_FILES['file'])) {
            $taskCalibration['idFileCert'] = isset($task_file['data']) ? $task_file['data']['idFile'] : 0;
            $taskCalibration['propCertificate'] = isset($task_file['data']) ? $task_file['data'] : '';
        }

        $taskCalibration['caltemProgress'] = $propProgress;


        $update = $this->m_task_calibration->update($taskCalibration);

        if ($update['queryResult'] == true) {
            $taskNext = $this->m_task->data(
                0,
                $taskCode = 'CAL', //calibration
                0,
                0,
                !empty($post['idRelatedTask']) ? $post['idRelatedTask'] : 0,
                !empty($post['taskType']) ? $post['taskType'] : '',
                $taskName = 'CALIBRATION',
                $taskDesc = 'CALIBRATION',
                0,
                !empty($post['taskKpi']) ? $post['taskKpi'] : 0,
                !empty($post['taskAmount']) ? $post['taskAmount'] : 0,
                'MED'
            );

            $scheduleNext = $this->m_schedule->data(
                0,
                $parentSchedule = 0,
                $scheduleType = 'ONCE', //$post['scheduleType'],
                $scheduleName = 'CALIBRATION',
                $scheduleDesc = 'CALIBRATION',
                $post['scheduleStartNext'],
                $post['scheduleStartNext'], //$post['scheduleEnd'], 
                $dayRepeat = '',
                $createBy = $this->session->userdata('username'),
                'MED'
            );

            $taskCalibrationNext[] = [
                "idTask" =>  0,
                "idAsset" => $post['idAssetReport'],
                "timeStart" => date('Y-m-d H:i:s'),
                "timeEnd" => date('Y-m-d H:i:s'),
                "idForm" => isset($post['idForm']) ? $post['idForm'] : 0,
                "calibResult" =>  '',
                "noteCalib" =>  '',
                "noteLocation" =>  '',
                "idFileCert" =>  0,
            ];

            $taskNext['propSchedule'] = $scheduleNext;
            $taskNext['propTaskCalibration'] = $taskCalibrationNext;
            $scheduleStartNext =  $post['scheduleStartNext'];

            $taskNextInsert = $this->m_task->taskInsert($taskNext);

            // if ($taskNextInsert['queryResult'] == true) {
            //     $this->session->set_flashdata('sukses', "Success, data updated and saved with planning date {$scheduleStartNext} successfully");
            // } else {
            //     $message = $taskNextInsert['queryMessage'] ? $taskNextInsert['queryMessage'] : 'Failed';
            //     $this->session->set_flashdata('error', $message);
            // }
        } else {
            // $message = $update['queryMessage'] ? $update['queryMessage'] : 'Failed';
            // $this->session->set_flashdata('error', $message);
        }

        echo json_encode($taskNextInsert);
        die;
        // redirect('task/med/calibration/schedule_report', 'refresh');
    }

    public function update_action_approve()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $post = $this->security->xss_clean($this->input->post());

        if ($post['finishDate'] == '') {
            $data = [
                'queryMessage' => 'implementation date is required',
                'queryResult' => false,
            ];

            echo json_encode($data);
            die();
        }

        if ($post['idVendor'] == '' || $post['idVendor'] == 0) {
            $data = [
                'queryMessage' => 'calibration institution is required',
                'queryResult' => false,
            ];

            echo json_encode($data);
            die();
        }

        if ($post['servicePrice'] == '') {
            $data = [
                'queryMessage' => 'service price is required',
                'queryResult' => false,
            ];

            echo json_encode($data);
            die();
        }

        if ($post['sertificateNumber'] == '') {
            $data = [
                'queryMessage' => 'sertificate number is required',
                'queryResult' => false,
            ];

            echo json_encode($data);
            die();
        }

        if ($post['calibrationResult'] == '') {
            $data = [
                'queryMessage' => 'calibration result is required',
                'queryResult' => false,
            ];

            echo json_encode($data);
            die();
        }

        $idTask = $post['idTaskReport'];
        $idAsset = $post['idAssetReport'];

        $query_params = [];

        if ($idTask != '') {
            $idTask_query_params = [
                "column" => "idTask",
                "value" => $idTask
            ];

            array_push($query_params, $idTask_query_params);
        }

        if ($idAsset != '') {
            $idAsset_query_params = [
                "column" => "idAsset",
                "value" => $idAsset
            ];

            array_push($query_params, $idAsset_query_params);
        }

        $query_groups = [];
        if ($idTask != '' || $idAsset != '') {
            $query_groups = [
                [
                    "queryMethod" => "EXACTAND",
                    "queryParams" => $query_params
                ]
            ];
        }

        $request = [
            "queryGroupMethod" => "AND",
            "queryGroups" => $query_groups,
            "page" => 1,
            "limit" => 1
        ];

        $posts = $this->m_task_calibration->query($request);

        $task = $this->m_task->taskById($idTask);
        // echo "<pre>";
        // var_dump($posts);
        // die;
        // echo "</pre>";

        $idSchedule = $task['data']['propSchedule']['idSchedule'];

        $taskCalibration = $posts['data'][0];


        $task_file = isset($_FILES['file']) ? $this->task_file_upload($_FILES['file'], $post['sertificateNumber']) : '';
        $calitemProgress = $post['calitemProgress'];


        if ($calitemProgress == 0) {
            $propProgress = $task['data']['propProgress'];
            $propProgress['idProgress'] = $task['data']['propProgress']['idProgress'];

            $propProgress['timeFinish'] = $post['finishDate'];
            $propProgress['finishBy'] = $this->session->userdata('username');
            $propProgress['idFinishBy'] = $this->session->userdata('id_user');

            $propProgress['timeApproved'] = $post['finishDate'];
            $propProgress['approveBy'] = $this->session->userdata('username');
            $propProgress['idApproveBy'] = $this->session->userdata('id_user');

            $insertProgress = $this->m_progress->progressUpdate($propProgress);
        } else {
            $propProgress = $taskCalibration['propItemProgress'];

            $propProgress['timeFinish'] = $post['finishDate'];
            $propProgress['finishBy'] = $this->session->userdata('username');
            $propProgress['idFinishBy'] = $this->session->userdata('id_user');

            $propProgress['timeApproved'] = $post['finishDate'];
            $propProgress['approveBy'] = $this->session->userdata('username');
            $propProgress['idApproveBy'] = $this->session->userdata('id_user');
        }

        $taskCalibration['calitemProgress'] =  (int)$task['data']['propProgress']['idProgress'];
        $taskCalibration['calitemSchedule'] = (int)$idSchedule;
        $taskCalibration['calitemVendor'] = isset($post['idVendor']) ? (int)$post['idVendor'] : 0;
        $taskCalibration['calitemPrice'] = (float)$post['servicePrice'];
        $taskCalibration['calibResult'] = $post['calibrationResult'];
        $taskCalibration['noteCalib'] = $post['note'];

        if (isset($_FILES['file'])) {
            $taskCalibration['idFileCert'] = isset($task_file['data']) ? $task_file['data']['idFile'] : 0;
            $taskCalibration['propCertificate'] = isset($task_file['data']) ? $task_file['data'] : '';
        }

        $taskCalibration['caltemProgress'] = $propProgress;
        // echo "<pre>";
        // var_dump($taskCalibration);
        // die;
        // echo "</pre>";

        $update = $this->m_task_calibration->update($taskCalibration);

        // if ($update['queryResult'] == true) {
        //     $this->session->set_flashdata('sukses', "Success, data updated successfully");
        // } else {
        //     $message = $update['queryMessage'] ? $update['queryMessage'] : 'Failed';
        //     $this->session->set_flashdata('error', $message);
        echo json_encode($update);
        die;
        // }

        // redirect('task/med/calibration/schedule_report', 'refresh');
    }

    public function auto_date()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $scheduleStart = $this->input->post('scheduleStart');

        $show = date('Y-m-d', strtotime("$scheduleStart +1 years"));

        echo json_encode($show);
    }

    public function next_range_date()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $next_range = $this->input->post('next_range');
        $day_date = $this->input->post('scheduleStart');

        if ($next_range == '6month') {
            $show = date('Y-m-d', strtotime("$day_date +6 month"));
        } elseif ($next_range == '2years') {
            $show = date('Y-m-d', strtotime("$day_date +2 years"));
        } else {
            $show = date('Y-m-d', strtotime("$day_date +1 years"));
        }

        echo json_encode($show);
    }

    public function delete()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $idTask = [];
        $idAsset = [];

        if (!empty($this->input->post('idTask'))) {
            $idTask = $this->input->post('idTask');
            $idAsset = $this->input->post('idAsset');
        }

        // $id_asset = $this->input->post('idAsset');
        foreach ($idTask as $key => $id) {
            foreach ($idAsset as $key2 => $id2) {
                $task = $this->m_task_calibration->delete($id, $id2);
            }
            // $task = $this->m_task_calibration->delete($id, $idAsset);
        }

        echo json_encode($task);
        exit;
    }

    public function by_id_task()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $idTask = [];

        if (!empty($this->input->post('idTask'))) {
            $idTask = $this->input->post('idTask');
        }

        // $id_asset = $this->input->post('idAsset');
        foreach ($idTask as $key => $id) {
            $task = $this->m_task->taskById($id)['data'];
            // $task = $this->m_task_calibration->delete($id, $idAsset);
        }

        echo json_encode($task);
        exit;
    }

    public function store()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $post = $this->security->xss_clean($this->input->post());

        //insert data ke dalam segment task
        $task = $this->m_task->data(
            !empty($post['idTask']) ? $post['idTask'] : 0,
            $taskCode = 'CAL', //calibration
            !empty($post['idProgress']) ? $post['idProgress'] : 0,
            !empty($post['idSchedule']) ? $post['idSchedule'] : 0,
            !empty($post['idRelatedTask']) ? $post['idRelatedTask'] : 0,
            !empty($post['taskType']) ? $post['taskType'] : '',
            $taskName = 'CALIBRATION',
            $taskDesc = 'CALIBRATION',
            !empty($post['idVendor']) ? $post['idVendor'] : 0,
            !empty($post['taskKpi']) ? $post['taskKpi'] : 0,
            !empty($post['taskAmount']) ? $post['taskAmount'] : 0,
            'MED'
        );

        $progress = $this->m_progress->data(
            $post['idProgress'] ? $post['idProgress'] : 0,
            $progressStatus = '',
            $timeInit = date('Y-m-d H:i:s'),
            $timeRespon = '',
            $timeStart = '',
            $timeFinish = '',
            $timePending = '',
            $timeApproved = '',
            $timeDelegate = '',
            $timeAssign = '',
            $idInitBy = $this->session->userdata('id_user'),
            $idResponBy = 0,
            $idStartBy = 0,
            $idFinishBy = 0,
            $idPendingBy = 0,
            $idApproveBy = 0,
            $idAssignee = 0,
            $idDelegator = 0,
            $initBy = $this->session->userdata('username'),
            $responBy = '',
            $startBy = '',
            $finishBy = '',
            $pendingBy = '',
            $approveBy = '',
            $delegateBy = '',
            $assignTo = ''
        );


        $schedule = $this->m_schedule->data(
            $post['idSchedule'],
            $parentSchedule = 0,
            $scheduleType = 'ONCE', //$post['scheduleType'],
            $scheduleName = 'CALIBRATION',
            $scheduleDesc = 'CALIBRATION',
            $post['scheduleStart'],
            $post['scheduleStart'], //$post['scheduleEnd'], 
            $dayRepeat = '',
            $createBy = $this->session->userdata('username'),
            'MED'
        );


        $task['propProgress'] = $progress;
        $task['propSchedule'] = $schedule;


        if ($post['formType'] == 'add') {
            // if (!empty($post['idAsset'])) {
            if (empty($post['idAsset'])) {
                echo json_encode([
                    "queryResult" => false,
                    "queryMessage"  => "Asset data is null, please select asset data!"
                ]);
                die;
            }
            foreach ($post['idAsset'] as $key => $value) {
                $taskCalibration = [];

                $taskCalibration[] = [
                    "idTask" => $post['idTask'] ? $post['idTask'] : 0,
                    "idAsset" => $post['idAsset'][$key],
                    "timeStart" => date('Y-m-d H:i:s'),
                    "timeEnd" => date('Y-m-d H:i:s'),
                    "idForm" => isset($post['idForm']) ? $post['idForm'] : 0,
                    "calibResult" => isset($post['calibResult']) ? $post['calibResult'] : '',
                    "noteCalib" => isset($post['noteCalib']) ? $post['noteCalib'] : '',
                    "noteLocation" => isset($post['noteLocation']) ? $post['noteLocation'] : '',
                    "idFileCert" => isset($post['idFileCert']) ? $post['idFileCert'] : 0,
                ];


                $task['propTaskCalibration'] = $taskCalibration;

                $task_insert = $this->m_task->taskAutoInsert($task);
            }
            // }
            $this->session->unset_userdata('idAssetSelected');
            echo json_encode($task_insert);
            die;
            // if ($task_insert['queryResult'] == true) {

            //     $this->session->unset_userdata('idAssetSelected');

            //     $this->session->set_flashdata('sukses', "Success, data saved successfully");
            // } else {
            //     $this->session->unset_userdata('idAssetSelected');

            //     $message = $task_insert['queryMessage'] ? $task_insert['queryMessage'] : 'Failed';
            //     $this->session->set_flashdata('error', $message);
            // }

            // redirect('task/med/calibration/schedule_report', 'refresh');
        } else {
            $task_update = $this->m_task->taskUpdate($task);

            $this->session->unset_userdata('idAssetSelected');
            echo json_encode($task_update);
            die;

            // if ($task_update['queryResult'] == true) {
            //     $this->session->unset_userdata('idAssetSelected');

            //     $this->session->set_flashdata('sukses', "Success, data updated successfully");
            // } else {
            //     $this->session->unset_userdata('idAssetSelected');

            //     $message = $task_update['queryMessage'] ? $task_update['queryMessage'] : 'Failed';
            //     $this->session->set_flashdata('error', $message);
            // }

            // redirect('task/med/calibration/schedule_report', 'refresh');
        }
    }

    public function report()
    {
        $q1 = htmlspecialchars($this->input->post('q1'));
        $v1 = htmlspecialchars($this->input->post('v1'));
        $q2 = htmlspecialchars($this->input->post('q2'));
        $v2 = htmlspecialchars($this->input->post('v2'));
        $q3 = htmlspecialchars($this->input->post('q3'));
        $v3 = htmlspecialchars($this->input->post('v3'));
        $bq3 = htmlspecialchars($this->input->post('bq3'));
        $bv3 = htmlspecialchars($this->input->post('bv3'));
        $q4 = htmlspecialchars($this->input->post('q4'));
        $v4 = htmlspecialchars($this->input->post('v4'));
        $bq4 = htmlspecialchars($this->input->post('bq4'));
        $bv4 = htmlspecialchars($this->input->post('bv4'));
        $q5 = htmlspecialchars($this->input->post('q5'));
        $v5 = htmlspecialchars($this->input->post('v5'));
        $bq5 = htmlspecialchars($this->input->post('bq5'));
        $bv5 = htmlspecialchars($this->input->post('bv5'));
        $q6 = htmlspecialchars($this->input->post('q6'));
        $v6 = htmlspecialchars($this->input->post('v6'));
        $bq6 = htmlspecialchars($this->input->post('bq6'));
        $bv6 = htmlspecialchars($this->input->post('bv6'));
        $q7 = htmlspecialchars($this->input->post('q7'));
        $v7 = htmlspecialchars($this->input->post('v7'));
        $bq7 = htmlspecialchars($this->input->post('bq7'));
        $bv7 = htmlspecialchars($this->input->post('bv7'));
        $q8 = htmlspecialchars($this->input->post('q8'));
        $v8 = htmlspecialchars($this->input->post('v8'));
        $bq8 = htmlspecialchars($this->input->post('bq8'));
        $bv8 = htmlspecialchars($this->input->post('bv8'));
        $q9 = htmlspecialchars($this->input->post('q9'));
        $v9 = htmlspecialchars($this->input->post('v9'));
        $bq9 = htmlspecialchars($this->input->post('bq9'));
        $bv9 = htmlspecialchars($this->input->post('bv9'));
        $q10 = htmlspecialchars($this->input->post('q10'));
        $v10 = htmlspecialchars($this->input->post('v10'));
        $bq10 = htmlspecialchars($this->input->post('bq10'));
        $bv10 = htmlspecialchars($this->input->post('bv10'));
        $postIdAsset = htmlspecialchars($this->input->post('idAsset'));

        $startDateq3 = htmlspecialchars($this->input->post('startDateq3'));
        $startDatev3 = htmlspecialchars($this->input->post('startDatev3'));
        $startDatebq3 = htmlspecialchars($this->input->post('startDatebq3'));
        $startDatebv3 = htmlspecialchars($this->input->post('startDatebv3'));

        $startDateq4 = htmlspecialchars($this->input->post('startDateq4'));
        $startDatev4 = htmlspecialchars($this->input->post('startDatev4'));
        $startDatebq4 = htmlspecialchars($this->input->post('startDatebq4'));
        $startDatebv4 = htmlspecialchars($this->input->post('startDatebv4'));

        $startDateq5 = htmlspecialchars($this->input->post('startDateq5'));
        $startDatev5 = htmlspecialchars($this->input->post('startDatev5'));
        $startDatebq5 = htmlspecialchars($this->input->post('startDatebq5'));
        $startDatebv5 = htmlspecialchars($this->input->post('startDatebv5'));
        $status = htmlspecialchars($this->input->post('status'));

        $any_toogle = $this->input->post('toogle_signature');
        $lokasi_print = $this->input->post('lokasi_print');
        $tgl_print = $this->input->post('tgl_print');
        $button_pdf = $this->input->post('button_pdf');
        $button_excel = $this->input->post('button_excel');
        $officer = $this->input->post('officer');

        $data['any_toogle'] = $any_toogle;
        $data['lokasi_print'] = $lokasi_print;
        $data['tgl_print'] = $tgl_print;
        $data['officer'] = $officer;

        $query_params = [];
        $query_params_like_or = [];
        $query_params_where_between = [];
        $query_groups_between = [];

        if ($button_pdf == 'pdf') {
            ///////// ADVANCED SEACRH DATE ///////////////////
            if ($startDateq3 != '') {

                $startDateq3_query_params = [
                    "column" => $startDateq3,
                    "value" => $startDatev3,
                ];
                array_push($query_params_where_between, $startDateq3_query_params);
            }

            if ($startDatebq3 != '') {

                $startDatebq3_query_params = [
                    "column" => $startDatebq3,
                    "value" => $startDatebv3,
                ];
                array_push($query_params_where_between, $startDatebq3_query_params);
            }

            if ($startDateq4 != '') {

                $startDateq4_query_params = [
                    "column" => $startDateq4,
                    "value" => $startDatev4,
                ];
                array_push($query_params_where_between, $startDateq4_query_params);
            }

            if ($startDatebq4 != '') {

                $startDatebq4_query_params = [
                    "column" => $startDatebq4,
                    "value" => $startDatebv4,
                ];
                array_push($query_params_where_between, $startDatebq4_query_params);
            }

            if ($startDateq5 != '') {

                $startDateq5_query_params = [
                    "column" => $startDateq5,
                    "value" => $startDatev5,
                ];
                array_push($query_params_where_between, $startDateq5_query_params);
            }

            if ($startDatebq5 != '') {

                $startDatebq5_query_params = [
                    "column" => $startDatebq5,
                    "value" => $startDatebv5,
                ];
                array_push($query_params_where_between, $startDatebq5_query_params);
            }

            ///////// ADVANCED SEACRH DATE ///////////////////

            $taskSysCat_query_params = [
                "column" => "taskSysCat",
                "value" => "MED"
            ];
            array_push($query_params, $taskSysCat_query_params);



            $taskCode_query_params = [
                "column" => "taskCode",
                "value" => "CAL"
            ];
            array_push($query_params, $taskCode_query_params);


            if ($q1 != '') {

                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $q1_query_params = [
                        "column" => $q1,
                        "value" => $v1
                    ];
                    array_push($query_params_like_or, $q1_query_params);
                } else {
                    $q1_query_params = [
                        "column" => $q1,
                        "value" => $v1
                    ];

                    array_push($query_params, $q1_query_params);
                }
            }

            if ($q2 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $q2_query_params = [
                        "column" => $q2,
                        "value" => $v2
                    ];
                    array_push($query_params_like_or, $q2_query_params);
                } else {
                    $q2_query_params = [
                        "column" => $q2,
                        "value" => $v2
                    ];

                    array_push($query_params, $q2_query_params);
                }
            }

            if ($q3 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $q3_query_params = [
                        "column" => $q3,
                        "value" => $v3
                    ];
                    array_push($query_params_like_or, $q3_query_params);
                } else {
                    $q3_query_params = [
                        "column" => $q3,
                        "value" => $v3
                    ];

                    array_push($query_params, $q3_query_params);
                }
            }

            if ($bq3 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $bq3_query_params = [
                        "column" => $bq3,
                        "value" => $bv3
                    ];
                    array_push($query_params_like_or, $bq3_query_params);
                } else {
                    $bq3_query_params = [
                        "column" => $bq3,
                        "value" => $bv3
                    ];

                    array_push($query_params, $bq3_query_params);
                }
            }

            if ($q4 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $q4_query_params = [
                        "column" => $q4,
                        "value" => $v4
                    ];
                    array_push($query_params_like_or, $q4_query_params);
                } else {
                    $q4_query_params = [
                        "column" => $q4,
                        "value" => $v4
                    ];

                    array_push($query_params, $q4_query_params);
                }
            }

            if ($bq4 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $bq4_query_params = [
                        "column" => $bq4,
                        "value" => $bv4
                    ];
                    array_push($query_params_like_or, $bq4_query_params);
                } else {
                    $bq4_query_params = [
                        "column" => $bq4,
                        "value" => $bv4
                    ];

                    array_push($query_params, $bq4_query_params);
                }
            }

            if ($q5 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $q5_query_params = [
                        "column" => $q5,
                        "value" => $v5
                    ];
                    array_push($query_params_like_or, $q5_query_params);
                } else {
                    $q5_query_params = [
                        "column" => $q5,
                        "value" => $v5
                    ];

                    array_push($query_params, $q5_query_params);
                }
            }

            if ($bq5 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $bq5_query_params = [
                        "column" => $bq5,
                        "value" => $bv5
                    ];
                    array_push($query_params_like_or, $bq5_query_params);
                } else {
                    $bq5_query_params = [
                        "column" => $bq5,
                        "value" => $bv5
                    ];

                    array_push($query_params, $bq5_query_params);
                }
            }

            if ($q6 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $q6_query_params = [
                        "column" => $q6,
                        "value" => $v6
                    ];
                    array_push($query_params_like_or, $q6_query_params);
                } else {
                    $q6_query_params = [
                        "column" => $q6,
                        "value" => $v6
                    ];

                    array_push($query_params, $q6_query_params);
                }
            }

            if ($bq6 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $bq6_query_params = [
                        "column" => $bq6,
                        "value" => $bv6
                    ];
                    array_push($query_params_like_or, $bq6_query_params);
                } else {
                    $bq6_query_params = [
                        "column" => $bq6,
                        "value" => $bv6
                    ];

                    array_push($query_params, $bq6_query_params);
                }
            }

            if ($q7 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $q7_query_params = [
                        "column" => $q7,
                        "value" => $v7
                    ];
                    array_push($query_params_like_or, $q7_query_params);
                } else {
                    $q7_query_params = [
                        "column" => $q7,
                        "value" => $v7
                    ];

                    array_push($query_params, $q7_query_params);
                }
            }

            if ($bq7 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $bq7_query_params = [
                        "column" => $bq7,
                        "value" => $bv7
                    ];
                    array_push($query_params_like_or, $bq7_query_params);
                } else {
                    $bq7_query_params = [
                        "column" => $q7,
                        "value" => $v7
                    ];

                    array_push($query_params, $bq7_query_params);
                }
            }

            if ($q8 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $q8_query_params = [
                        "column" => $q8,
                        "value" => $v8
                    ];
                    array_push($query_params_like_or, $q8_query_params);
                } else {
                    $q8_query_params = [
                        "column" => $q8,
                        "value" => $v8
                    ];

                    array_push($query_params, $q8_query_params);
                }
            }

            if ($bq8 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $bq8_query_params = [
                        "column" => $bq8,
                        "value" => $bv8
                    ];
                    array_push($query_params_like_or, $bq8_query_params);
                } else {
                    $bq8_query_params = [
                        "column" => $bq8,
                        "value" => $bv8
                    ];

                    array_push($query_params, $bq8_query_params);
                }
            }

            if ($q9 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $q9_query_params = [
                        "column" => $q9,
                        "value" => $v9
                    ];
                    array_push($query_params_like_or, $q9_query_params);
                } else {
                    $q9_query_params = [
                        "column" => $q9,
                        "value" => $v9
                    ];

                    array_push($query_params, $q9_query_params);
                }
            }

            if ($bq9 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $bq9_query_params = [
                        "column" => $bq9,
                        "value" => $bv9
                    ];
                    array_push($query_params_like_or, $bq9_query_params);
                } else {
                    $bq9_query_params = [
                        "column" => $bq9,
                        "value" => $bv9
                    ];

                    array_push($query_params, $bq9_query_params);
                }
            }

            if ($q10 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $q10_query_params = [
                        "column" => $q10,
                        "value" => $v10
                    ];
                    array_push($query_params_like_or, $q10_query_params);
                } else {
                    $q10_query_params = [
                        "column" => $q10,
                        "value" => $v10
                    ];

                    array_push($query_params, $q10_query_params);
                }
            }

            if ($bq10 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $bq10_query_params = [
                        "column" => $bq10,
                        "value" => $bv10
                    ];
                    array_push($query_params_like_or, $bq10_query_params);
                } else {
                    $bq10_query_params = [
                        "column" => $bq10,
                        "value" => $bv10
                    ];

                    array_push($query_params, $bq10_query_params);
                }
            }

            if ($status != '') {
                if ($status != 'ALL') {

                    $progressStatus = '';
                    if ($status == 1) {
                        // belum di kerjakan
                        $progressStatus = 'NEW-ASSIGNED';
                    } else if ($status == 2) {
                        // belum approve
                        $progressStatus = 'NEW-ASSIGNED-STARTED-FINISHED';
                    } else if ($status == 3) {
                        // approve
                        $progressStatus = 'NEW-ASSIGNED-STARTED-FINISHED-APPROVED';
                    }

                    $status_query_params = [
                        "column" => "progressStatus",
                        "value" => $progressStatus
                    ];
                    array_push($query_params, $status_query_params);
                }
            }

            $query_groups = [
                [
                    "queryMethod" => "LIKEAND",
                    "queryParams" => $query_params
                ]
            ];


            if ($startDateq3 != '' || $startDatev3 != '' || $startDatebq3 != '' || $startDatebv3 != '' || $startDateq4 != '' || $startDatev4 != '' || $startDatebq4 != '' || $startDatebv4 != '' || $startDateq5 != '' || $startDatev5 != '' || $startDatebq5 != '' || $startDatebv5 != '') {
                $query_groups_where_between = [
                    [
                        "queryMethod" => "BETWEEN",
                        "queryParams" => $query_params_where_between
                    ]
                ];
            }

            $merge_query_groups = array_merge($query_groups, $query_groups_between);

            $request = [
                "queryGroupMethod" => "AND",
                "queryGroups" => $merge_query_groups,
                "sortingParams" => [
                    [
                        "column" => 'idTask',
                        "value" => "desc"
                    ]
                ],
                // "page" => 1,
                // "limit" => 2,
                "withDetails" => true,
                "subDetails" => true
            ];

            $posts = $this->m_task->taskQuery($request);

            $mpdfConfig = array(
                'tempDir' => sys_get_temp_dir() . DIRECTORY_SEPARATOR,
                'mode' => 'utf-8',
                'format' => 'A4',    // format - A4, for example, default ''
                'margin_left' => 5,        // 15 margin_left
                'margin_right' => 5,        // 15 margin right
                // 'margin_top' => 5,        // 15 margin right
                // 'margin_bottom' => 5,        // 15 margin right
                'orientation' => 'L'      // L - landscape, P - portrait
            );
            $mpdf = new \Mpdf\Mpdf($mpdfConfig);
            $data['mpdf'] = $mpdf;
            $data['tasks'] = $posts;

            $data['asset_propbuilding_rooms'] = $posts;
            $html = $this->load->view('task/electromedic_task/print/calibration/pdf', $data, TRUE);
            $mpdf->WriteHTML($html);
            $mpdf->Output();
        } else {
            ///////// ADVANCED SEACRH DATE ///////////////////
            if ($startDateq3 != '') {

                $startDateq3_query_params = [
                    "column" => $startDateq3,
                    "value" => $startDatev3,
                ];
                array_push($query_params_where_between, $startDateq3_query_params);
            }

            if ($startDatebq3 != '') {

                $startDatebq3_query_params = [
                    "column" => $startDatebq3,
                    "value" => $startDatebv3,
                ];
                array_push($query_params_where_between, $startDatebq3_query_params);
            }

            if ($startDateq4 != '') {

                $startDateq4_query_params = [
                    "column" => $startDateq4,
                    "value" => $startDatev4,
                ];
                array_push($query_params_where_between, $startDateq4_query_params);
            }

            if ($startDatebq4 != '') {

                $startDatebq4_query_params = [
                    "column" => $startDatebq4,
                    "value" => $startDatebv4,
                ];
                array_push($query_params_where_between, $startDatebq4_query_params);
            }

            if ($startDateq5 != '') {

                $startDateq5_query_params = [
                    "column" => $startDateq5,
                    "value" => $startDatev5,
                ];
                array_push($query_params_where_between, $startDateq5_query_params);
            }

            if ($startDatebq5 != '') {

                $startDatebq5_query_params = [
                    "column" => $startDatebq5,
                    "value" => $startDatebv5,
                ];
                array_push($query_params_where_between, $startDatebq5_query_params);
            }

            ///////// ADVANCED SEACRH DATE ///////////////////

            $taskSysCat_query_params = [
                "column" => "taskSysCat",
                "value" => "MED"
            ];
            array_push($query_params, $taskSysCat_query_params);



            $taskCode_query_params = [
                "column" => "taskCode",
                "value" => "CAL"
            ];
            array_push($query_params, $taskCode_query_params);


            if ($q1 != '') {

                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $q1_query_params = [
                        "column" => $q1,
                        "value" => $v1
                    ];
                    array_push($query_params_like_or, $q1_query_params);
                } else {
                    $q1_query_params = [
                        "column" => $q1,
                        "value" => $v1
                    ];

                    array_push($query_params, $q1_query_params);
                }
            }

            if ($q2 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $q2_query_params = [
                        "column" => $q2,
                        "value" => $v2
                    ];
                    array_push($query_params_like_or, $q2_query_params);
                } else {
                    $q2_query_params = [
                        "column" => $q2,
                        "value" => $v2
                    ];

                    array_push($query_params, $q2_query_params);
                }
            }

            if ($q3 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $q3_query_params = [
                        "column" => $q3,
                        "value" => $v3
                    ];
                    array_push($query_params_like_or, $q3_query_params);
                } else {
                    $q3_query_params = [
                        "column" => $q3,
                        "value" => $v3
                    ];

                    array_push($query_params, $q3_query_params);
                }
            }

            if ($bq3 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $bq3_query_params = [
                        "column" => $bq3,
                        "value" => $bv3
                    ];
                    array_push($query_params_like_or, $bq3_query_params);
                } else {
                    $bq3_query_params = [
                        "column" => $bq3,
                        "value" => $bv3
                    ];

                    array_push($query_params, $bq3_query_params);
                }
            }

            if ($q4 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $q4_query_params = [
                        "column" => $q4,
                        "value" => $v4
                    ];
                    array_push($query_params_like_or, $q4_query_params);
                } else {
                    $q4_query_params = [
                        "column" => $q4,
                        "value" => $v4
                    ];

                    array_push($query_params, $q4_query_params);
                }
            }

            if ($bq4 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $bq4_query_params = [
                        "column" => $bq4,
                        "value" => $bv4
                    ];
                    array_push($query_params_like_or, $bq4_query_params);
                } else {
                    $bq4_query_params = [
                        "column" => $bq4,
                        "value" => $bv4
                    ];

                    array_push($query_params, $bq4_query_params);
                }
            }

            if ($q5 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $q5_query_params = [
                        "column" => $q5,
                        "value" => $v5
                    ];
                    array_push($query_params_like_or, $q5_query_params);
                } else {
                    $q5_query_params = [
                        "column" => $q5,
                        "value" => $v5
                    ];

                    array_push($query_params, $q5_query_params);
                }
            }

            if ($bq5 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $bq5_query_params = [
                        "column" => $bq5,
                        "value" => $bv5
                    ];
                    array_push($query_params_like_or, $bq5_query_params);
                } else {
                    $bq5_query_params = [
                        "column" => $bq5,
                        "value" => $bv5
                    ];

                    array_push($query_params, $bq5_query_params);
                }
            }

            if ($q6 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $q6_query_params = [
                        "column" => $q6,
                        "value" => $v6
                    ];
                    array_push($query_params_like_or, $q6_query_params);
                } else {
                    $q6_query_params = [
                        "column" => $q6,
                        "value" => $v6
                    ];

                    array_push($query_params, $q6_query_params);
                }
            }

            if ($bq6 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $bq6_query_params = [
                        "column" => $bq6,
                        "value" => $bv6
                    ];
                    array_push($query_params_like_or, $bq6_query_params);
                } else {
                    $bq6_query_params = [
                        "column" => $bq6,
                        "value" => $bv6
                    ];

                    array_push($query_params, $bq6_query_params);
                }
            }

            if ($q7 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $q7_query_params = [
                        "column" => $q7,
                        "value" => $v7
                    ];
                    array_push($query_params_like_or, $q7_query_params);
                } else {
                    $q7_query_params = [
                        "column" => $q7,
                        "value" => $v7
                    ];

                    array_push($query_params, $q7_query_params);
                }
            }

            if ($bq7 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $bq7_query_params = [
                        "column" => $bq7,
                        "value" => $bv7
                    ];
                    array_push($query_params_like_or, $bq7_query_params);
                } else {
                    $bq7_query_params = [
                        "column" => $q7,
                        "value" => $v7
                    ];

                    array_push($query_params, $bq7_query_params);
                }
            }

            if ($q8 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $q8_query_params = [
                        "column" => $q8,
                        "value" => $v8
                    ];
                    array_push($query_params_like_or, $q8_query_params);
                } else {
                    $q8_query_params = [
                        "column" => $q8,
                        "value" => $v8
                    ];

                    array_push($query_params, $q8_query_params);
                }
            }

            if ($bq8 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $bq8_query_params = [
                        "column" => $bq8,
                        "value" => $bv8
                    ];
                    array_push($query_params_like_or, $bq8_query_params);
                } else {
                    $bq8_query_params = [
                        "column" => $bq8,
                        "value" => $bv8
                    ];

                    array_push($query_params, $bq8_query_params);
                }
            }

            if ($q9 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $q9_query_params = [
                        "column" => $q9,
                        "value" => $v9
                    ];
                    array_push($query_params_like_or, $q9_query_params);
                } else {
                    $q9_query_params = [
                        "column" => $q9,
                        "value" => $v9
                    ];

                    array_push($query_params, $q9_query_params);
                }
            }

            if ($bq9 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $bq9_query_params = [
                        "column" => $bq9,
                        "value" => $bv9
                    ];
                    array_push($query_params_like_or, $bq9_query_params);
                } else {
                    $bq9_query_params = [
                        "column" => $bq9,
                        "value" => $bv9
                    ];

                    array_push($query_params, $bq9_query_params);
                }
            }

            if ($q10 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $q10_query_params = [
                        "column" => $q10,
                        "value" => $v10
                    ];
                    array_push($query_params_like_or, $q10_query_params);
                } else {
                    $q10_query_params = [
                        "column" => $q10,
                        "value" => $v10
                    ];

                    array_push($query_params, $q10_query_params);
                }
            }

            if ($bq10 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $bq10_query_params = [
                        "column" => $bq10,
                        "value" => $bv10
                    ];
                    array_push($query_params_like_or, $bq10_query_params);
                } else {
                    $bq10_query_params = [
                        "column" => $bq10,
                        "value" => $bv10
                    ];

                    array_push($query_params, $bq10_query_params);
                }
            }

            if ($status != '') {
                if ($status != 'ALL') {

                    $progressStatus = '';
                    if ($status == 1) {
                        // belum di kerjakan
                        $progressStatus = 'NEW-ASSIGNED';
                    } else if ($status == 2) {
                        // belum approve
                        $progressStatus = 'NEW-ASSIGNED-STARTED-FINISHED';
                    } else if ($status == 3) {
                        // approve
                        $progressStatus = 'NEW-ASSIGNED-STARTED-FINISHED-APPROVED';
                    }

                    $status_query_params = [
                        "column" => "progressStatus",
                        "value" => $progressStatus
                    ];
                    array_push($query_params, $status_query_params);
                }
            }

            $query_groups = [
                [
                    "queryMethod" => "LIKEAND",
                    "queryParams" => $query_params
                ]
            ];


            if ($startDateq3 != '' || $startDatev3 != '' || $startDatebq3 != '' || $startDatebv3 != '' || $startDateq4 != '' || $startDatev4 != '' || $startDatebq4 != '' || $startDatebv4 != '' || $startDateq5 != '' || $startDatev5 != '' || $startDatebq5 != '' || $startDatebv5 != '') {
                $query_groups_where_between = [
                    [
                        "queryMethod" => "BETWEEN",
                        "queryParams" => $query_params_where_between
                    ]
                ];
            }

            $merge_query_groups = array_merge($query_groups, $query_groups_between);

            $request = [
                "queryGroupMethod" => "AND",
                "queryGroups" => $merge_query_groups,
                "sortingParams" => [
                    [
                        "column" => 'idTask',
                        "value" => "desc"
                    ]
                ],
                // "page" => 1,
                // "limit" => 2,
                "withDetails" => true,
                "subDetails" => true
            ];

            $posts = $this->m_task->taskQuery($request);

            $data['tasks'] = $posts;

            $data['asset_propbuilding_rooms'] = $posts;

            $this->load->view('task/electromedic_task/print/calibration/excell', $data);
        }
    }

    public function data_table()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $q1 = htmlspecialchars($this->input->post('q1'));
        $v1 = htmlspecialchars($this->input->post('v1'));
        $q2 = htmlspecialchars($this->input->post('q2'));
        $v2 = htmlspecialchars($this->input->post('v2'));
        $q3 = htmlspecialchars($this->input->post('q3'));
        $v3 = htmlspecialchars($this->input->post('v3'));
        $bq3 = htmlspecialchars($this->input->post('bq3'));
        $bv3 = htmlspecialchars($this->input->post('bv3'));
        $q4 = htmlspecialchars($this->input->post('q4'));
        $v4 = htmlspecialchars($this->input->post('v4'));
        $bq4 = htmlspecialchars($this->input->post('bq4'));
        $bv4 = htmlspecialchars($this->input->post('bv4'));
        $q5 = htmlspecialchars($this->input->post('q5'));
        $v5 = htmlspecialchars($this->input->post('v5'));
        $bq5 = htmlspecialchars($this->input->post('bq5'));
        $bv5 = htmlspecialchars($this->input->post('bv5'));
        $q6 = htmlspecialchars($this->input->post('q6'));
        $v6 = htmlspecialchars($this->input->post('v6'));
        $bq6 = htmlspecialchars($this->input->post('bq6'));
        $bv6 = htmlspecialchars($this->input->post('bv6'));
        $q7 = htmlspecialchars($this->input->post('q7'));
        $v7 = htmlspecialchars($this->input->post('v7'));
        $bq7 = htmlspecialchars($this->input->post('bq7'));
        $bv7 = htmlspecialchars($this->input->post('bv7'));
        $q8 = htmlspecialchars($this->input->post('q8'));
        $v8 = htmlspecialchars($this->input->post('v8'));
        $bq8 = htmlspecialchars($this->input->post('bq8'));
        $bv8 = htmlspecialchars($this->input->post('bv8'));
        $q9 = htmlspecialchars($this->input->post('q9'));
        $v9 = htmlspecialchars($this->input->post('v9'));
        $bq9 = htmlspecialchars($this->input->post('bq9'));
        $bv9 = htmlspecialchars($this->input->post('bv9'));
        $q10 = htmlspecialchars($this->input->post('q10'));
        $v10 = htmlspecialchars($this->input->post('v10'));
        $bq10 = htmlspecialchars($this->input->post('bq10'));
        $bv10 = htmlspecialchars($this->input->post('bv10'));

        $startDateq3 = htmlspecialchars($this->input->post('startDateq3'));
        $startDatev3 = htmlspecialchars($this->input->post('startDatev3'));
        $startDatebq3 = htmlspecialchars($this->input->post('startDatebq3'));
        $startDatebv3 = htmlspecialchars($this->input->post('startDatebv3'));

        $startDateq4 = htmlspecialchars($this->input->post('startDateq4'));
        $startDatev4 = htmlspecialchars($this->input->post('startDatev4'));
        $startDatebq4 = htmlspecialchars($this->input->post('startDatebq4'));
        $startDatebv4 = htmlspecialchars($this->input->post('startDatebv4'));

        $startDateq5 = htmlspecialchars($this->input->post('startDateq5'));
        $startDatev5 = htmlspecialchars($this->input->post('startDatev5'));
        $startDatebq5 = htmlspecialchars($this->input->post('startDatebq5'));
        $startDatebv5 = htmlspecialchars($this->input->post('startDatebv5'));

        $status = $this->input->post('status');
        $taskSysCat = $this->input->post('taskSysCat');
        $idRelatedTask = $this->input->post('idRelatedTask');
        $taskCode = $this->input->post('taskCode');

        $periode = $this->input->post('periode');

        $startDate = $this->input->post('startDate');
        $endDate = $this->input->post('endDate');

        $timeAssign = $this->input->post('timeAssign');
        $idAssignee = $this->input->post('idAssignee');
        $assignTo = $this->input->post('assignTo');

        $draw   = $this->input->post('draw');
        $start  = $this->input->post('start');
        $length = $this->input->post('length') ? $this->input->post('length') : 1;

        $search = str_replace("'", "", strtolower($this->input->post('search')['value']));
        $searchTerms = explode(" ",  $search);
        $orderColumn = isset($this->input->post('order')[0]['column']) ? $this->input->post('order')[0]['column'] : '';
        $dir = isset($this->input->post('order')[0]['dir']) ? $this->input->post('order')[0]['dir'] : '';

        $query_params = [];
        $query_params_like_or = [];
        $query_params_where_between = [];

        $scheduleStart = '';
        $scheduleEnd = '';
        if ($periode != '') {
            if ($periode == 'this_year') {

                $firstDate  = new DateTime(date('Y-m-d H:i:s'));
                $secondDate  = new DateTime(date('Y-m-d H:i:s'));

                $scheduleEnd = $firstDate;
                $scheduleStart = $secondDate->modify("-1 year");
            } elseif ($periode == 'last_year') {

                $firstDate  = new DateTime(date('Y-m-d H:i:s'));
                $secondDate  = new DateTime(date('Y-m-d H:i:s'));

                $scheduleEnd = $firstDate->modify("-1 year");
                $scheduleStart = $secondDate->modify("-2 year");
            } elseif ($periode == 'next_year') {

                $firstDate  = new DateTime(date('Y-m-d H:i:s'));
                $secondDate  = new DateTime(date('Y-m-d H:i:s'));

                $scheduleStart = $firstDate;
                $scheduleEnd = $secondDate->modify("+1 year");
            } elseif ($periode == 'last_month') {

                $firstDate  = new DateTime(date('Y-m-d H:i:s'));
                $secondDate  = new DateTime(date('Y-m-d H:i:s'));

                $scheduleEnd = $firstDate->modify("-1 month");
                $scheduleStart = $secondDate->modify("-2 month");
            } elseif ($periode == 'next_month') {

                $firstDate  = new DateTime(date('Y-m-d H:i:s'));
                $secondDate  = new DateTime(date('Y-m-d H:i:s'));

                $scheduleStart = $firstDate;
                $scheduleEnd = $secondDate->modify("+1 month");
            } elseif ($periode == 'this_month') {

                $firstDate  = new DateTime(date('Y-m-d H:i:s'));
                $secondDate  = new DateTime(date('Y-m-d H:i:s'));

                $scheduleEnd = $firstDate;
                $scheduleStart = $secondDate->modify("-1 month");
            }
        }

        if ($periode != '') {

            $scheduleStart_query_params = [
                "column" => "scheduleStart",
                "value" => $scheduleStart->format('Y-m-d'),
            ];
            array_push($query_params_where_between, $scheduleStart_query_params);
        }

        if ($periode != '') {

            $scheduleEnd_query_params = [
                "column" => "scheduleEnd",
                "value" => $scheduleEnd->format('Y-m-d'),
            ];
            array_push($query_params_where_between, $scheduleEnd_query_params);
        }
        ///////// ADVANCED SEACRH DATE ///////////////////
        if ($startDateq3 != '') {

            $startDateq3_query_params = [
                "column" => $startDateq3,
                "value" => $startDatev3,
            ];
            array_push($query_params_where_between, $startDateq3_query_params);
        }

        if ($startDatebq3 != '') {

            $startDatebq3_query_params = [
                "column" => $startDatebq3,
                "value" => $startDatebv3,
            ];
            array_push($query_params_where_between, $startDatebq3_query_params);
        }

        if ($startDateq4 != '') {

            $startDateq4_query_params = [
                "column" => $startDateq4,
                "value" => $startDatev4,
            ];
            array_push($query_params_where_between, $startDateq4_query_params);
        }

        if ($startDatebq4 != '') {

            $startDatebq4_query_params = [
                "column" => $startDatebq4,
                "value" => $startDatebv4,
            ];
            array_push($query_params_where_between, $startDatebq4_query_params);
        }

        if ($startDateq5 != '') {

            $startDateq5_query_params = [
                "column" => $startDateq5,
                "value" => $startDatev5,
            ];
            array_push($query_params_where_between, $startDateq5_query_params);
        }

        if ($startDatebq5 != '') {

            $startDatebq5_query_params = [
                "column" => $startDatebq5,
                "value" => $startDatebv5,
            ];
            array_push($query_params_where_between, $startDatebq5_query_params);
        }

        ///////// ADVANCED SEACRH DATE ///////////////////
        $array = [];
        if ($searchTerms) {
            foreach ($searchTerms as $searchTerm) {
                $array['search'] = $searchTerm;
            }
        }

        if ($dir === 'asc') {
            $array['order'] = 'desc';
        }

        if ($array['search'] != '') {

            $idTask_query_params = [
                "column" => "idTask",
                "value" => $array['search']
            ];
            array_push($query_params_like_or, $idTask_query_params);

            $idAsset_query_params = [
                "column" => "idAsset",
                "value" => $array['search']
            ];
            array_push($query_params_like_or, $idAsset_query_params);

            $taskCode_query_params = [
                "column" => "taskCode",
                "value" => $array['search']
            ];
            array_push($query_params_like_or, $taskCode_query_params);

            $taskName_query_params = [
                "column" => "taskName",
                "value" => $array['search']
            ];
            array_push($query_params_like_or, $taskName_query_params);

            $assignTo_query_params = [
                "column" => "assignTo",
                "value" => $array['search']
            ];
            array_push($query_params_like_or, $assignTo_query_params);

            $taskDesc_query_params = [
                "column" => "taskDesc",
                "value" => $array['search']
            ];
            array_push($query_params_like_or, $taskDesc_query_params);

            $scheduleStart_query_params = [
                "column" => "scheduleStart",
                "value" => $array['search']
            ];
            array_push($query_params_like_or, $scheduleStart_query_params);

            $scheduleEnd_query_params = [
                "column" => "scheduleEnd",
                "value" => $array['search']
            ];
            array_push($query_params_like_or, $scheduleEnd_query_params);
        }

        if ($idRelatedTask != '') {
            $idRelatedTask_query_params = [
                "column" => "idRelatedTask",
                "value" => (int)$idRelatedTask
            ];
            array_push($query_params, $idRelatedTask_query_params);
        }

        if ($timeAssign != '') {
            $timeAssign_query_params = [
                "column" => "timeAssign",
                "value" => $timeAssign
            ];
            array_push($query_params, $timeAssign_query_params);
        }

        if ($idAssignee != '') {
            $idAssignee_query_params = [
                "column" => "idAssignee",
                "value" => $idAssignee
            ];
            array_push($query_params, $idAssignee_query_params);
        }

        if ($assignTo != '') {
            $assignTo_query_params = [
                "column" => "assignTo",
                "value" => $assignTo
            ];
            array_push($query_params, $assignTo_query_params);
        }

        if ($taskSysCat != 'ALL') {
            if ($taskSysCat != '') {
                $taskSysCat_query_params = [
                    "column" => "taskSysCat",
                    "value" => $taskSysCat
                ];
                array_push($query_params, $taskSysCat_query_params);
            }
        }

        if ($taskCode != 'ALL') {
            if ($taskCode != '') {
                $taskCode_query_params = [
                    "column" => "taskCode",
                    "value" => strtoupper($taskCode)
                ];
                array_push($query_params, $taskCode_query_params);
            }
        }

        if ($q1 != '') {

            if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                $q1_query_params = [
                    "column" => $q1,
                    "value" => $v1
                ];
                array_push($query_params_like_or, $q1_query_params);
            } else {
                $q1_query_params = [
                    "column" => $q1,
                    "value" => $v1
                ];

                array_push($query_params, $q1_query_params);
            }
        }

        if ($q2 != '') {
            if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                $q2_query_params = [
                    "column" => $q2,
                    "value" => $v2
                ];
                array_push($query_params_like_or, $q2_query_params);
            } else {
                $q2_query_params = [
                    "column" => $q2,
                    "value" => $v2
                ];

                array_push($query_params, $q2_query_params);
            }
        }

        if ($q3 != '') {
            if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                $q3_query_params = [
                    "column" => $q3,
                    "value" => $v3
                ];
                array_push($query_params_like_or, $q3_query_params);
            } else {
                $q3_query_params = [
                    "column" => $q3,
                    "value" => $v3
                ];

                array_push($query_params, $q3_query_params);
            }
        }

        if ($bq3 != '') {
            if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                $bq3_query_params = [
                    "column" => $bq3,
                    "value" => $bv3
                ];
                array_push($query_params_like_or, $bq3_query_params);
            } else {
                $bq3_query_params = [
                    "column" => $bq3,
                    "value" => $bv3
                ];

                array_push($query_params, $bq3_query_params);
            }
        }

        if ($q4 != '') {
            if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                $q4_query_params = [
                    "column" => $q4,
                    "value" => $v4
                ];
                array_push($query_params_like_or, $q4_query_params);
            } else {
                $q4_query_params = [
                    "column" => $q4,
                    "value" => $v4
                ];

                array_push($query_params, $q4_query_params);
            }
        }

        if ($bq4 != '') {
            if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                $bq4_query_params = [
                    "column" => $bq4,
                    "value" => $bv4
                ];
                array_push($query_params_like_or, $bq4_query_params);
            } else {
                $bq4_query_params = [
                    "column" => $bq4,
                    "value" => $bv4
                ];

                array_push($query_params, $bq4_query_params);
            }
        }

        if ($q5 != '') {
            if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                $q5_query_params = [
                    "column" => $q5,
                    "value" => $v5
                ];
                array_push($query_params_like_or, $q5_query_params);
            } else {
                $q5_query_params = [
                    "column" => $q5,
                    "value" => $v5
                ];

                array_push($query_params, $q5_query_params);
            }
        }

        if ($bq5 != '') {
            if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                $bq5_query_params = [
                    "column" => $bq5,
                    "value" => $bv5
                ];
                array_push($query_params_like_or, $bq5_query_params);
            } else {
                $bq5_query_params = [
                    "column" => $bq5,
                    "value" => $bv5
                ];

                array_push($query_params, $bq5_query_params);
            }
        }

        if ($q6 != '') {
            if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                $q6_query_params = [
                    "column" => $q6,
                    "value" => $v6
                ];
                array_push($query_params_like_or, $q6_query_params);
            } else {
                $q6_query_params = [
                    "column" => $q6,
                    "value" => $v6
                ];

                array_push($query_params, $q6_query_params);
            }
        }

        if ($bq6 != '') {
            if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                $bq6_query_params = [
                    "column" => $bq6,
                    "value" => $bv6
                ];
                array_push($query_params_like_or, $bq6_query_params);
            } else {
                $bq6_query_params = [
                    "column" => $bq6,
                    "value" => $bv6
                ];

                array_push($query_params, $bq6_query_params);
            }
        }

        if ($q7 != '') {
            if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                $q7_query_params = [
                    "column" => $q7,
                    "value" => $v7
                ];
                array_push($query_params_like_or, $q7_query_params);
            } else {
                $q7_query_params = [
                    "column" => $q7,
                    "value" => $v7
                ];

                array_push($query_params, $q7_query_params);
            }
        }

        if ($bq7 != '') {
            if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                $bq7_query_params = [
                    "column" => $bq7,
                    "value" => $bv7
                ];
                array_push($query_params_like_or, $bq7_query_params);
            } else {
                $bq7_query_params = [
                    "column" => $q7,
                    "value" => $v7
                ];

                array_push($query_params, $bq7_query_params);
            }
        }

        if ($q8 != '') {
            if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                $q8_query_params = [
                    "column" => $q8,
                    "value" => $v8
                ];
                array_push($query_params_like_or, $q8_query_params);
            } else {
                $q8_query_params = [
                    "column" => $q8,
                    "value" => $v8
                ];

                array_push($query_params, $q8_query_params);
            }
        }

        if ($bq8 != '') {
            if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                $bq8_query_params = [
                    "column" => $bq8,
                    "value" => $bv8
                ];
                array_push($query_params_like_or, $bq8_query_params);
            } else {
                $bq8_query_params = [
                    "column" => $bq8,
                    "value" => $bv8
                ];

                array_push($query_params, $bq8_query_params);
            }
        }

        if ($q9 != '') {
            if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                $q9_query_params = [
                    "column" => $q9,
                    "value" => $v9
                ];
                array_push($query_params_like_or, $q9_query_params);
            } else {
                $q9_query_params = [
                    "column" => $q9,
                    "value" => $v9
                ];

                array_push($query_params, $q9_query_params);
            }
        }

        if ($bq9 != '') {
            if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                $bq9_query_params = [
                    "column" => $bq9,
                    "value" => $bv9
                ];
                array_push($query_params_like_or, $bq9_query_params);
            } else {
                $bq9_query_params = [
                    "column" => $bq9,
                    "value" => $bv9
                ];

                array_push($query_params, $bq9_query_params);
            }
        }

        if ($q10 != '') {
            if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                $q10_query_params = [
                    "column" => $q10,
                    "value" => $v10
                ];
                array_push($query_params_like_or, $q10_query_params);
            } else {
                $q10_query_params = [
                    "column" => $q10,
                    "value" => $v10
                ];

                array_push($query_params, $q10_query_params);
            }
        }

        if ($bq10 != '') {
            if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                $bq10_query_params = [
                    "column" => $bq10,
                    "value" => $bv10
                ];
                array_push($query_params_like_or, $bq10_query_params);
            } else {
                $bq10_query_params = [
                    "column" => $bq10,
                    "value" => $bv10
                ];

                array_push($query_params, $bq10_query_params);
            }
        }

        if ($status != '') {
            $progressStatus = '';
            if ($status == 1) {
                // belum di kerjakan
                $progressStatus = 'NEW-ASSIGNED';
            } else if ($status == 2) {
                // belum approve
                $progressStatus = 'NEW-ASSIGNED-STARTED-FINISHED';
            } else if ($status == 3) {
                // approve
                $progressStatus = 'NEW-ASSIGNED-STARTED-FINISHED-APPROVED';
            }

            $status_query_params = [
                "column" => "progressStatus",
                "value" => $progressStatus
            ];
            array_push($query_params, $status_query_params);
        }

        $query_groups_like_or = [];
        $query_groups_where_between = [];
        $query_groups = [];
        // if($q1 != '' || $q2 != '' || $status != '' || $taskSysCat) {
        if ($q1 != null || $q2 != null || $q3 != null || $bq3 != null || $q4 != null || $bq4 != null || $q5 != null || $bq5 != null || $q6 != null || $bq6 != null || $q7 != null || $bq7 != null || $q8 != null || $bq8 != null || $q9 != null || $bq9 != null || $q10 != null || $bq10 != null || $status != '' || $taskSysCat) {

            if (($q1 != '' && $q2 != '') || ($q3 != '' && $bq3 != '') || ($q4 != '' && $bq4 != '') ||  ($q5 != '' && $bq5 != '')  || ($q6 != '' && $bq6 != '') || ($q7 != '' && $bq7 != '') || ($q8 != '' && $bq8 != '') || ($q9 != '' && $bq9 != '') || ($q10 != '' && $bq10 != '')) {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $query_groups_like_or = [
                        [
                            "queryMethod" => "LIKEOR",
                            "queryParams" => $query_params_like_or
                        ]
                    ];
                }
            }

            $query_groups = [
                [
                    "queryMethod" => "EXACTAND", //"LIKEAND",
                    "queryParams" => $query_params
                ]
            ];
        }

        if ($array['search'] != '') {
            $query_groups_like_or = [
                [
                    "queryMethod" => "LIKEOR",
                    "queryParams" => $query_params_like_or
                ]
            ];
        }

        if ($periode != '' || $startDateq3 != '' || $startDatev3 != '' || $startDatebq3 != '' || $startDatebv3 != '' || $startDateq4 != '' || $startDatev4 != '' || $startDatebq4 != '' || $startDatebv4 != '' || $startDateq5 != '' || $startDatev5 != '' || $startDatebq5 != '' || $startDatebv5 != '') {
            $query_groups_where_between = [
                [
                    "queryMethod" => "BETWEEN",
                    "queryParams" => $query_params_where_between
                ]
            ];
        }

        $merge_query_groups = array_merge($query_groups, $query_groups_like_or);
        $merge_query_groups = array_merge($merge_query_groups, $query_groups_where_between);

        $page = ($start / $length) + 1;

        $request = [
            "queryGroupMethod" => "AND",
            "queryGroups" => $query_params ? $merge_query_groups : [],
            "sortingParams" => [
                [
                    "column" => "idTask",
                    "value" => "desc"
                ]
            ],
            "withDetails" => true,
            "subDetails" => true,
            "page" =>  $page,
            "limit" =>  isset($length) ? (int)$length : 15
        ];


        $posts = $this->m_task->taskQuery($request);

        $totalFiltered = $posts['dataCount'];

        if (sizeof($posts) > 0) {
            $no = 1;

            foreach ($posts['data'] as $key => $value) {
                if ($value['propTaskCalibration']) {
                    foreach ($value['propTaskCalibration'] as $key2 => $propTaskCalibration) {
                        $idAsset = $propTaskCalibration['idAsset'];
                        $idTask = $propTaskCalibration['idTask'];
                        $scheduleStart1 = $value['propSchedule']['scheduleStart'];
                        $status_img = '';
                        $posts['data'][$key]['check_box_cuk'] = "<input type='checkbox' id='delcheck_{$idTask}' data-asset='{$idAsset}' data-task='{$idTask}'  name='msg[]' class='delete_check' value='{$idTask}' />";

                        $posts['data'][$key]['idAsset'] = $idAsset;

                        if (isset($propTaskCalibration['propItemProgress']['progressStatus'])) {
                            $propProgress = $propTaskCalibration['propItemProgress']['progressStatus'];

                            if ($propProgress == 'NEW') {
                                $status_img = '<a href="javascript:void(0)" data-idtask="' . $idTask . '" data-idasset="' . $idAsset . '" data-schedule="' . $scheduleStart1 . '" id="update-cal"><img src="' . base_url() . '/assets/images/icon/cross.png" 
                                    alt="" style="height:14px; display:block; margin:0 auto;" 
                                    title="None" class="tip"></a>';
                            } else {
                                $status_img = '<a href="javascript:void(0)" data-idtask="' . $idTask . '" data-idasset="' . $idAsset . '" data-schedule="' . $scheduleStart1 . '" id="update-approve-cal"><img src="' . base_url() . '/assets/images/icon/check.png" 
                                    alt="" style="height:14px; display:block; margin:0 auto;" 
                                    title="Sudah Approve" class="tip"></a>';
                            }
                        } else {
                            $propProgress = $value['propProgress']['progressStatus'];

                            if ($propProgress == 'NEW') {
                                $status_img = '<a href="javascript:void(0)" data-idtask="' . $idTask . '" data-idasset="' . $idAsset . '" data-schedule="' . $scheduleStart1 . '" id="update-cal"><img src="' . base_url() . '/assets/images/icon/cross.png" 
                                    alt="" style="height:14px; display:block; margin:0 auto;" 
                                    title="None" class="tip"></a>';
                            } else {
                                $status_img = '<a href="javascript:void(0)" data-idtask="' . $idTask . '" data-idasset="' . $idAsset . '" data-schedule="' . $scheduleStart1 . '" id="update-approve-cal"><img src="' . base_url() . '/assets/images/icon/check.png" 
                                alt="" style="height:14px; display:block; margin:0 auto;" 
                                title="Sudah Approve" class="tip"></a>';
                            }
                        }


                        $calibration_service_price = $propTaskCalibration['calitemPrice'];

                        if (isset($propTaskCalibration['propItemProgress']['timeFinish'])) {
                            $timeFinish = date('Y-m-d', strtotime($propTaskCalibration['propItemProgress']['timeFinish']));
                        } else {
                            $timeFinish = "-";
                        }

                        $implementation_date = $timeFinish;

                        if (isset($propTaskCalibration['propCertificate']['docNumber'])) {
                            $docNumber = $propTaskCalibration['propCertificate']['docNumber'];
                        } else {
                            $docNumber = '';
                        }

                        $sertificate_number = $docNumber;

                        $calibResult = $propTaskCalibration['calibResult'];

                        if (isset($propTaskCalibration['propCertificate'])) {
                            $file = $propTaskCalibration['propCertificate']['fileName'];
                            $url = base_url('file/file_download/' . $propTaskCalibration['propCertificate']['idFile']);
                            $fileName = "<a href='{$url}' target='_blank'>{$file}</a>";
                        } else {
                            $fileName = '';
                        }

                        $file =  $fileName;

                        $note = $propTaskCalibration['noteCalib'];

                        $posts['data'][$key]['assetCode']      =  $propTaskCalibration['propAsset']['assetCode'];
                        $posts['data'][$key]['scheduleStart']      =  $scheduleStart1;
                        $posts['data'][$key]['assetName']      =  $propTaskCalibration['propAsset']['assetName'];
                        $posts['data'][$key]['merk']      =  $propTaskCalibration['propAsset']['propAssetPropgenit']['merk'];
                        $posts['data'][$key]['tipe']      =  $propTaskCalibration['propAsset']['propAssetPropgenit']['tipe'];
                        $posts['data'][$key]['serialNumber']      =  $propTaskCalibration['propAsset']['propAssetPropgenit']['serialNumber'];
                        $posts['data'][$key]['roomName']      =  $propTaskCalibration['propAsset']['propAssetPropadmin']['propAssetPropbuildingRoom']['roomName'];
                        $posts['data'][$key]['floorName']      =  $propTaskCalibration['propAsset']['propAssetPropadmin']['propAssetPropbuildingRoom']['floorName'];
                        $posts['data'][$key]['buildingName']      =  $propTaskCalibration['propAsset']['propAssetPropadmin']['propAssetPropbuildingRoom']['buildingName'];

                        $posts['data'][$key]['status_img'] = $status_img;
                        $posts['data'][$key]['implementation_date'] = $implementation_date;
                        $posts['data'][$key]['calibration_service_price'] = $calibration_service_price;
                        $posts['data'][$key]['sertificate_number'] = $sertificate_number;
                        $posts['data'][$key]['calibResult'] = $propTaskCalibration['calibResult'];
                        $posts['data'][$key]['contactCompany'] = isset($propTaskCalibration['propItemVendor']['contactCompany']) ? $propTaskCalibration['propItemVendor']['contactCompany'] : '-';;
                        $posts['data'][$key]['file'] = $file;
                        $posts['data'][$key]['note'] = $note;
                    }
                }
            }
        }

        $json_data = [
            "page"            => $page,
            "limit"           => $length,
            "draw"            => $draw,
            "recordsTotal"    => $totalFiltered,
            "recordsFiltered" => $totalFiltered,
            "data"            => $posts['data'],
            "search"          => isset($array['search']) ?  $array['search'] : '',
            "query_groups"    => $request,
            "query_message"   => $posts['queryMessage']
        ];

        echo json_encode($json_data);
    }

    public function data_table_old()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $q1 = htmlspecialchars($this->input->post('q1'));
        $v1 = htmlspecialchars($this->input->post('v1'));
        $q2 = htmlspecialchars($this->input->post('q2'));
        $v2 = htmlspecialchars($this->input->post('v2'));
        $q3 = htmlspecialchars($this->input->post('q3'));
        $v3 = htmlspecialchars($this->input->post('v3'));
        $bq3 = htmlspecialchars($this->input->post('bq3'));
        $bv3 = htmlspecialchars($this->input->post('bv3'));
        $q4 = htmlspecialchars($this->input->post('q4'));
        $v4 = htmlspecialchars($this->input->post('v4'));
        $bq4 = htmlspecialchars($this->input->post('bq4'));
        $bv4 = htmlspecialchars($this->input->post('bv4'));
        $q5 = htmlspecialchars($this->input->post('q5'));
        $v5 = htmlspecialchars($this->input->post('v5'));
        $bq5 = htmlspecialchars($this->input->post('bq5'));
        $bv5 = htmlspecialchars($this->input->post('bv5'));
        $q6 = htmlspecialchars($this->input->post('q6'));
        $v6 = htmlspecialchars($this->input->post('v6'));
        $bq6 = htmlspecialchars($this->input->post('bq6'));
        $bv6 = htmlspecialchars($this->input->post('bv6'));
        $q7 = htmlspecialchars($this->input->post('q7'));
        $v7 = htmlspecialchars($this->input->post('v7'));
        $bq7 = htmlspecialchars($this->input->post('bq7'));
        $bv7 = htmlspecialchars($this->input->post('bv7'));
        $q8 = htmlspecialchars($this->input->post('q8'));
        $v8 = htmlspecialchars($this->input->post('v8'));
        $bq8 = htmlspecialchars($this->input->post('bq8'));
        $bv8 = htmlspecialchars($this->input->post('bv8'));
        $q9 = htmlspecialchars($this->input->post('q9'));
        $v9 = htmlspecialchars($this->input->post('v9'));
        $bq9 = htmlspecialchars($this->input->post('bq9'));
        $bv9 = htmlspecialchars($this->input->post('bv9'));
        $q10 = htmlspecialchars($this->input->post('q10'));
        $v10 = htmlspecialchars($this->input->post('v10'));
        $bq10 = htmlspecialchars($this->input->post('bq10'));
        $bv10 = htmlspecialchars($this->input->post('bv10'));

        $startDateq3 = htmlspecialchars($this->input->post('startDateq3'));
        $startDatev3 = htmlspecialchars($this->input->post('startDatev3'));
        $startDatebq3 = htmlspecialchars($this->input->post('startDatebq3'));
        $startDatebv3 = htmlspecialchars($this->input->post('startDatebv3'));

        $startDateq4 = htmlspecialchars($this->input->post('startDateq4'));
        $startDatev4 = htmlspecialchars($this->input->post('startDatev4'));
        $startDatebq4 = htmlspecialchars($this->input->post('startDatebq4'));
        $startDatebv4 = htmlspecialchars($this->input->post('startDatebv4'));

        $startDateq5 = htmlspecialchars($this->input->post('startDateq5'));
        $startDatev5 = htmlspecialchars($this->input->post('startDatev5'));
        $startDatebq5 = htmlspecialchars($this->input->post('startDatebq5'));
        $startDatebv5 = htmlspecialchars($this->input->post('startDatebv5'));

        $status = $this->input->post('status');
        $taskSysCat = $this->input->post('taskSysCat');
        $idRelatedTask = $this->input->post('idRelatedTask');
        $taskCode = $this->input->post('taskCode');

        $periode = $this->input->post('periode');

        $startDate = $this->input->post('startDate');
        $endDate = $this->input->post('endDate');

        $timeAssign = $this->input->post('timeAssign');
        $idAssignee = $this->input->post('idAssignee');
        $assignTo = $this->input->post('assignTo');

        $draw   = $this->input->post('draw');
        $start  = $this->input->post('start');
        $length = $this->input->post('length') ? $this->input->post('length') : 1;

        $search = str_replace("'", "", strtolower($this->input->post('search')['value']));
        $searchTerms = explode(" ",  $search);
        $orderColumn = isset($this->input->post('order')[0]['column']) ? $this->input->post('order')[0]['column'] : '';
        $dir = isset($this->input->post('order')[0]['dir']) ? $this->input->post('order')[0]['dir'] : '';

        $query_params = [];
        $query_params_like_or = [];
        $query_params_where_between = [];

        $scheduleStart = '';
        $scheduleEnd = '';
        if ($periode != '') {
            if ($periode == 'this_year') {

                $firstDate  = new DateTime(date('Y-m-d H:i:s'));
                $secondDate  = new DateTime(date('Y-m-d H:i:s'));

                $scheduleEnd = $firstDate;
                $scheduleStart = $secondDate->modify("-1 year");
            } elseif ($periode == 'last_year') {

                $firstDate  = new DateTime(date('Y-m-d H:i:s'));
                $secondDate  = new DateTime(date('Y-m-d H:i:s'));

                $scheduleEnd = $firstDate->modify("-1 year");
                $scheduleStart = $secondDate->modify("-2 year");
            } elseif ($periode == 'next_year') {

                $firstDate  = new DateTime(date('Y-m-d H:i:s'));
                $secondDate  = new DateTime(date('Y-m-d H:i:s'));

                $scheduleStart = $firstDate;
                $scheduleEnd = $secondDate->modify("+1 year");
            } elseif ($periode == 'last_month') {

                $firstDate  = new DateTime(date('Y-m-d H:i:s'));
                $secondDate  = new DateTime(date('Y-m-d H:i:s'));

                $scheduleEnd = $firstDate->modify("-1 month");
                $scheduleStart = $secondDate->modify("-2 month");
            } elseif ($periode == 'next_month') {

                $firstDate  = new DateTime(date('Y-m-d H:i:s'));
                $secondDate  = new DateTime(date('Y-m-d H:i:s'));

                $scheduleStart = $firstDate;
                $scheduleEnd = $secondDate->modify("+1 month");
            } elseif ($periode == 'this_month') {

                $firstDate  = new DateTime(date('Y-m-d H:i:s'));
                $secondDate  = new DateTime(date('Y-m-d H:i:s'));

                $scheduleEnd = $firstDate;
                $scheduleStart = $secondDate->modify("-1 month");
            }
        }

        if ($periode != '') {

            $scheduleStart_query_params = [
                "column" => "scheduleStart",
                "value" => $scheduleStart->format('Y-m-d'),
            ];
            array_push($query_params_where_between, $scheduleStart_query_params);
        }

        if ($periode != '') {

            $scheduleEnd_query_params = [
                "column" => "scheduleEnd",
                "value" => $scheduleEnd->format('Y-m-d'),
            ];
            array_push($query_params_where_between, $scheduleEnd_query_params);
        }
        ///////// ADVANCED SEACRH DATE ///////////////////
        if ($startDateq3 != '') {

            $startDateq3_query_params = [
                "column" => $startDateq3,
                "value" => $startDatev3,
            ];
            array_push($query_params_where_between, $startDateq3_query_params);
        }

        if ($startDatebq3 != '') {

            $startDatebq3_query_params = [
                "column" => $startDatebq3,
                "value" => $startDatebv3,
            ];
            array_push($query_params_where_between, $startDatebq3_query_params);
        }

        if ($startDateq4 != '') {

            $startDateq4_query_params = [
                "column" => $startDateq4,
                "value" => $startDatev4,
            ];
            array_push($query_params_where_between, $startDateq4_query_params);
        }

        if ($startDatebq4 != '') {

            $startDatebq4_query_params = [
                "column" => $startDatebq4,
                "value" => $startDatebv4,
            ];
            array_push($query_params_where_between, $startDatebq4_query_params);
        }

        if ($startDateq5 != '') {

            $startDateq5_query_params = [
                "column" => $startDateq5,
                "value" => $startDatev5,
            ];
            array_push($query_params_where_between, $startDateq5_query_params);
        }

        if ($startDatebq5 != '') {

            $startDatebq5_query_params = [
                "column" => $startDatebq5,
                "value" => $startDatebv5,
            ];
            array_push($query_params_where_between, $startDatebq5_query_params);
        }

        ///////// ADVANCED SEACRH DATE ///////////////////
        $array = [];
        if ($searchTerms) {
            foreach ($searchTerms as $searchTerm) {
                $array['search'] = $searchTerm;
            }
        }

        if ($dir === 'asc') {
            $array['order'] = 'desc';
        }

        if ($array['search'] != '') {

            $idTask_query_params = [
                "column" => "idTask",
                "value" => $array['search']
            ];
            array_push($query_params_like_or, $idTask_query_params);

            $idAsset_query_params = [
                "column" => "idAsset",
                "value" => $array['search']
            ];
            array_push($query_params_like_or, $idAsset_query_params);

            $taskCode_query_params = [
                "column" => "taskCode",
                "value" => $array['search']
            ];
            array_push($query_params_like_or, $taskCode_query_params);

            $taskName_query_params = [
                "column" => "taskName",
                "value" => $array['search']
            ];
            array_push($query_params_like_or, $taskName_query_params);

            // $contactCompany_query_params = [
            //     "column" => "contactCompany",
            //     "value" => $array['search']
            // ];
            // array_push($query_params_like_or, $contactCompany_query_params);

            $taskDesc_query_params = [
                "column" => "taskDesc",
                "value" => $array['search']
            ];
            array_push($query_params_like_or, $taskDesc_query_params);

            $scheduleStart_query_params = [
                "column" => "scheduleStart",
                "value" => $array['search']
            ];
            array_push($query_params_like_or, $scheduleStart_query_params);

            $scheduleEnd_query_params = [
                "column" => "scheduleEnd",
                "value" => $array['search']
            ];
            array_push($query_params_like_or, $scheduleEnd_query_params);
        }

        if ($idRelatedTask != '') {
            $idRelatedTask_query_params = [
                "column" => "idRelatedTask",
                "value" => (int)$idRelatedTask
            ];
            array_push($query_params, $idRelatedTask_query_params);
        }

        if ($timeAssign != '') {
            $timeAssign_query_params = [
                "column" => "timeAssign",
                "value" => $timeAssign
            ];
            array_push($query_params, $timeAssign_query_params);
        }

        if ($idAssignee != '') {
            $idAssignee_query_params = [
                "column" => "idAssignee",
                "value" => $idAssignee
            ];
            array_push($query_params, $idAssignee_query_params);
        }

        if ($assignTo != '') {
            $assignTo_query_params = [
                "column" => "assignTo",
                "value" => $assignTo
            ];
            array_push($query_params, $assignTo_query_params);
        }

        if ($taskSysCat != 'ALL') {
            if ($taskSysCat != '') {
                $taskSysCat_query_params = [
                    "column" => "taskSysCat",
                    "value" => $taskSysCat
                ];
                array_push($query_params, $taskSysCat_query_params);
            }
        }

        if ($q1 != '') {

            if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                $q1_query_params = [
                    "column" => $q1,
                    "value" => $v1
                ];
                array_push($query_params_like_or, $q1_query_params);
            } else {
                $q1_query_params = [
                    "column" => $q1,
                    "value" => $v1
                ];

                array_push($query_params, $q1_query_params);
            }
        }

        if ($q2 != '') {
            if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                $q2_query_params = [
                    "column" => $q2,
                    "value" => $v2
                ];
                array_push($query_params_like_or, $q2_query_params);
            } else {
                $q2_query_params = [
                    "column" => $q2,
                    "value" => $v2
                ];

                array_push($query_params, $q2_query_params);
            }
        }

        if ($q3 != '') {
            if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                $q3_query_params = [
                    "column" => $q3,
                    "value" => $v3
                ];
                array_push($query_params_like_or, $q3_query_params);
            } else {
                $q3_query_params = [
                    "column" => $q3,
                    "value" => $v3
                ];

                array_push($query_params, $q3_query_params);
            }
        }

        if ($bq3 != '') {
            if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                $bq3_query_params = [
                    "column" => $bq3,
                    "value" => $bv3
                ];
                array_push($query_params_like_or, $bq3_query_params);
            } else {
                $bq3_query_params = [
                    "column" => $bq3,
                    "value" => $bv3
                ];

                array_push($query_params, $bq3_query_params);
            }
        }

        if ($q4 != '') {
            if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                $q4_query_params = [
                    "column" => $q4,
                    "value" => $v4
                ];
                array_push($query_params_like_or, $q4_query_params);
            } else {
                $q4_query_params = [
                    "column" => $q4,
                    "value" => $v4
                ];

                array_push($query_params, $q4_query_params);
            }
        }

        if ($bq4 != '') {
            if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                $bq4_query_params = [
                    "column" => $bq4,
                    "value" => $bv4
                ];
                array_push($query_params_like_or, $bq4_query_params);
            } else {
                $bq4_query_params = [
                    "column" => $bq4,
                    "value" => $bv4
                ];

                array_push($query_params, $bq4_query_params);
            }
        }

        if ($q5 != '') {
            if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                $q5_query_params = [
                    "column" => $q5,
                    "value" => $v5
                ];
                array_push($query_params_like_or, $q5_query_params);
            } else {
                $q5_query_params = [
                    "column" => $q5,
                    "value" => $v5
                ];

                array_push($query_params, $q5_query_params);
            }
        }

        if ($bq5 != '') {
            if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                $bq5_query_params = [
                    "column" => $bq5,
                    "value" => $bv5
                ];
                array_push($query_params_like_or, $bq5_query_params);
            } else {
                $bq5_query_params = [
                    "column" => $bq5,
                    "value" => $bv5
                ];

                array_push($query_params, $bq5_query_params);
            }
        }

        if ($q6 != '') {
            if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                $q6_query_params = [
                    "column" => $q6,
                    "value" => $v6
                ];
                array_push($query_params_like_or, $q6_query_params);
            } else {
                $q6_query_params = [
                    "column" => $q6,
                    "value" => $v6
                ];

                array_push($query_params, $q6_query_params);
            }
        }

        if ($bq6 != '') {
            if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                $bq6_query_params = [
                    "column" => $bq6,
                    "value" => $bv6
                ];
                array_push($query_params_like_or, $bq6_query_params);
            } else {
                $bq6_query_params = [
                    "column" => $bq6,
                    "value" => $bv6
                ];

                array_push($query_params, $bq6_query_params);
            }
        }

        if ($q7 != '') {
            if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                $q7_query_params = [
                    "column" => $q7,
                    "value" => $v7
                ];
                array_push($query_params_like_or, $q7_query_params);
            } else {
                $q7_query_params = [
                    "column" => $q7,
                    "value" => $v7
                ];

                array_push($query_params, $q7_query_params);
            }
        }

        if ($bq7 != '') {
            if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                $bq7_query_params = [
                    "column" => $bq7,
                    "value" => $bv7
                ];
                array_push($query_params_like_or, $bq7_query_params);
            } else {
                $bq7_query_params = [
                    "column" => $q7,
                    "value" => $v7
                ];

                array_push($query_params, $bq7_query_params);
            }
        }

        if ($q8 != '') {
            if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                $q8_query_params = [
                    "column" => $q8,
                    "value" => $v8
                ];
                array_push($query_params_like_or, $q8_query_params);
            } else {
                $q8_query_params = [
                    "column" => $q8,
                    "value" => $v8
                ];

                array_push($query_params, $q8_query_params);
            }
        }

        if ($bq8 != '') {
            if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                $bq8_query_params = [
                    "column" => $bq8,
                    "value" => $bv8
                ];
                array_push($query_params_like_or, $bq8_query_params);
            } else {
                $bq8_query_params = [
                    "column" => $bq8,
                    "value" => $bv8
                ];

                array_push($query_params, $bq8_query_params);
            }
        }

        if ($q9 != '') {
            if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                $q9_query_params = [
                    "column" => $q9,
                    "value" => $v9
                ];
                array_push($query_params_like_or, $q9_query_params);
            } else {
                $q9_query_params = [
                    "column" => $q9,
                    "value" => $v9
                ];

                array_push($query_params, $q9_query_params);
            }
        }

        if ($bq9 != '') {
            if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                $bq9_query_params = [
                    "column" => $bq9,
                    "value" => $bv9
                ];
                array_push($query_params_like_or, $bq9_query_params);
            } else {
                $bq9_query_params = [
                    "column" => $bq9,
                    "value" => $bv9
                ];

                array_push($query_params, $bq9_query_params);
            }
        }

        if ($q10 != '') {
            if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                $q10_query_params = [
                    "column" => $q10,
                    "value" => $v10
                ];
                array_push($query_params_like_or, $q10_query_params);
            } else {
                $q10_query_params = [
                    "column" => $q10,
                    "value" => $v10
                ];

                array_push($query_params, $q10_query_params);
            }
        }

        if ($bq10 != '') {
            if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                $bq10_query_params = [
                    "column" => $bq10,
                    "value" => $bv10
                ];
                array_push($query_params_like_or, $bq10_query_params);
            } else {
                $bq10_query_params = [
                    "column" => $bq10,
                    "value" => $bv10
                ];

                array_push($query_params, $bq10_query_params);
            }
        }

        if ($status != '') {
            if ($status != 'ALL') {

                $progressStatus = '';
                if ($status == 1) {
                    // belum di kerjakan
                    $progressStatus = 'NEW-ASSIGNED';
                } else if ($status == 2) {
                    // belum approve
                    $progressStatus = 'NEW-ASSIGNED-STARTED-FINISHED';
                } else if ($status == 3) {
                    // approve
                    $progressStatus = 'NEW-ASSIGNED-STARTED-FINISHED-APPROVED';
                }

                $status_query_params = [
                    "column" => "progressStatus",
                    "value" => $progressStatus
                ];
                array_push($query_params, $status_query_params);
            }
        }

        $query_groups_like_or = [];
        $query_groups_where_between = [];
        $query_groups = [];
        // if($q1 != '' || $q2 != '' || $status != '' || $taskSysCat) {
        if ($q1 != null || $q2 != null || $q3 != null || $bq3 != null || $q4 != null || $bq4 != null || $q5 != null || $bq5 != null || $q6 != null || $bq6 != null || $q7 != null || $bq7 != null || $q8 != null || $bq8 != null || $q9 != null || $bq9 != null || $q10 != null || $bq10 != null || $status != '' || $taskSysCat) {

            if (($q1 != '' && $q2 != '') || ($q3 != '' && $bq3 != '') || ($q4 != '' && $bq4 != '') ||  ($q5 != '' && $bq5 != '')  || ($q6 != '' && $bq6 != '') || ($q7 != '' && $bq7 != '') || ($q8 != '' && $bq8 != '') || ($q9 != '' && $bq9 != '') || ($q10 != '' && $bq10 != '')) {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $query_groups_like_or = [
                        [
                            "queryMethod" => "LIKEOR",
                            "queryParams" => $query_params_like_or
                        ]
                    ];
                }
            }

            $query_groups = [
                [
                    "queryMethod" => "EXACTAND", //"LIKEAND",
                    "queryParams" => $query_params
                ]
            ];
        }

        if ($array['search'] != '') {
            $query_groups_like_or = [
                [
                    "queryMethod" => "LIKEOR",
                    "queryParams" => $query_params_like_or
                ]
            ];
        }

        if ($periode != '' || $startDateq3 != '' || $startDatev3 != '' || $startDatebq3 != '' || $startDatebv3 != '' || $startDateq4 != '' || $startDatev4 != '' || $startDatebq4 != '' || $startDatebv4 != '' || $startDateq5 != '' || $startDatev5 != '' || $startDatebq5 != '' || $startDatebv5 != '') {
            $query_groups_where_between = [
                [
                    "queryMethod" => "BETWEEN",
                    "queryParams" => $query_params_where_between
                ]
            ];
        }

        $merge_query_groups = array_merge($query_groups, $query_groups_like_or);
        $merge_query_groups = array_merge($merge_query_groups, $query_groups_where_between);

        $count = $this->m_task_calibration->simple_query(
            [
                "queryGroupMethod" => "AND",
                "queryGroups" => $merge_query_groups ? $merge_query_groups : [],
                'page' => 1,
                'limit' => 1
            ]
        );
        $totalFiltered = $count['dataCount'];

        $page = ($start / $length) + 1;

        $request = [
            "queryGroupMethod" => "AND",
            "queryGroups" => $query_params ? $merge_query_groups : [],
            "sortingParams" => [
                [
                    "column" => "idTask",
                    "value" => "desc"
                ]
            ],
            "page" =>  $page,
            "limit" =>  isset($length) ? (int)$length : 15
        ];

        $posts = $this->m_task_calibration->simple_query($request);

        if (sizeof($posts) > 0) {
            $no = 1;
            foreach ($posts['data'] as $key => $value) {
                $idTask = $value['idTask'];
                $idAsset = $value['idAsset'];
                $scheduleStart1 = $value['propSchedule']['scheduleStart'];

                $posts['data'][$key]['check_box_cuk'] = "<input type='checkbox' id='delcheck_{$idTask}' data-asset='{$idAsset}' data-task='{$idTask}'  name='msg[]' class='delete_check' value='{$idTask}' />";

                $url = base_url() . "task_calibration/form_edit/" . $taskSysCat . "/mtn/edit/" . $value['idTask'] . "/" . $value['idAsset'];
                $status_img = '';

                if (isset($value['propItemProgress']['progressStatus'])) {
                    $propProgress = $value['propItemProgress']['progressStatus'];

                    if ($propProgress == 'NEW') {
                        $status_img = '<a href="javascript:void(0)" data-idtask="' . $idTask . '" data-idasset="' . $idAsset . '" data-schedule="' . $scheduleStart1 . '" id="update-cal"><img src="' . base_url() . '/assets/images/icon/cross.png" 
                            alt="" style="height:14px; display:block; margin:0 auto;" 
                            title="None" class="tip"></a>';
                    } else {
                        $status_img = '<a href="javascript:void(0)" data-idtask="' . $idTask . '" data-idasset="' . $idAsset . '" data-schedule="' . $scheduleStart1 . '" id="update-approve-cal"><img src="' . base_url() . '/assets/images/icon/check.png" 
                            alt="" style="height:14px; display:block; margin:0 auto;" 
                            title="Sudah Approve" class="tip"></a>';
                    }
                } else {
                    $propProgress = $value['propProgress']['progressStatus'];

                    if ($propProgress == 'NEW') {
                        $status_img = '<a href="javascript:void(0)" data-idtask="' . $idTask . '" data-idasset="' . $idAsset . '" data-schedule="' . $scheduleStart1 . '" id="update-cal"><img src="' . base_url() . '/assets/images/icon/cross.png" 
                            alt="" style="height:14px; display:block; margin:0 auto;" 
                            title="None" class="tip"></a>';
                    } else {
                        $status_img = '<a href="javascript:void(0)" data-idtask="' . $idTask . '" data-idasset="' . $idAsset . '" data-schedule="' . $scheduleStart1 . '" id="update-approve-cal"><img src="' . base_url() . '/assets/images/icon/check.png" 
                        alt="" style="height:14px; display:block; margin:0 auto;" 
                        title="Sudah Approve" class="tip"></a>';
                    }
                }

                $calibResult = $value['calibResult'];

                $idContact = isset($value['calitemVendor']) ? $value['calitemVendor'] : 0;

                $calibration_institusi = '';

                $calibResult == 'Laik' ? 'selected' : '';
                $calibResult == 'Tidak Laik' ? 'selected' : '';

                if (isset($value['propItemProgress']['timeFinish'])) {
                    $timeFinish = date('Y-m-d', strtotime($value['propItemProgress']['timeFinish']));
                } else {
                    $timeFinish = "-";
                }

                $implementation_date = $timeFinish;

                $idContact = isset($value['calitemVendor']) ? $value['calitemVendor'] : 0;

                $calibration_service_price = $value['calitemPrice'];

                if (isset($value['propCertificate']['docNumber'])) {
                    $docNumber = $value['propCertificate']['docNumber'];
                } else {
                    $docNumber = '';
                }

                $sertificate_number = $docNumber;
                $calibration_result = $calibResult;

                if (isset($value['propCertificate'])) {
                    $file = $value['propCertificate']['fileName'];
                    $url = base_url('file/file_download/' . $value['propCertificate']['idFile']);
                    $fileName = "<a href='{$url}' target='_blank'>{$file}</a>";
                } else {
                    $fileName = '';
                }

                $file =  $fileName;

                $note = $value['noteCalib'];


                $posts['data'][$key]['status_img'] = $status_img;
                $posts['data'][$key]['implementation_date'] = $implementation_date;
                $posts['data'][$key]['calibration_service_price'] = $calibration_service_price;
                $posts['data'][$key]['sertificate_number'] = $sertificate_number;
                $posts['data'][$key]['calibration_result'] = $calibration_result;
                $posts['data'][$key]['calibration_institusi'] = $calibration_institusi;
                $posts['data'][$key]['file'] = $file;
                $posts['data'][$key]['note'] = $note;
                // $posts['data'][$key]['action'] = $action;

                $no++;
            }
        }

        $json_data = [
            "page"            => $page,
            "limit"           => $length,
            "draw"            => $draw,
            "recordsTotal"    => $totalFiltered,
            "recordsFiltered" => $totalFiltered,
            "data"            => $posts['data'],
            "search"          => isset($array['search']) ?  $array['search'] : '',
            "query_groups"    => $request,
            "query_message"   => $posts['queryMessage']
        ];

        echo json_encode($json_data);
    }
}
