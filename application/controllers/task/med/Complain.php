<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chillerlan\QRCode\QRCode;

class Complain extends CI_Controller
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
            'M_otp'          => 'm_otp',
            'M_user'                => 'm_user',
        ]);
    }


    public function index()
    {
        $result_role = $this->m_access_control->MyRole()['data']['roleACL'];

        $data['result_role'] = $result_role;
        $this->load->model('M_notifikasi', 'm_notifikasi');
        $data['notif'] = $this->m_notifikasi->list()['data'];

        if ($result_role[2]['subMenu1'][0]['subMenu2'][4]['isAllow'] != true) {
            exit('You dont have access!!');
        }

        $this->load->view('components/header');
        $this->load->view('components/sidebar', $data);
        $this->load->view('task/electromedic_task/complain_med_index');
        $this->load->view('task/electromedic_task/form/complain_form');
        $this->load->view('task/electromedic_task/form/repair_form_directTo');
        $this->load->view('task/electromedic_task/details/complain_repair_details');
        $this->load->view('task/electromedic_task/print/complain/task_print');
        $this->load->view('task/electromedic_task/approve/complain_repair_approve');
        $this->load->view('components/sidebar_footer');
        $this->load->view('components/footer');
        $this->load->view('task/task');
    }

    private function task_file_upload($file)
    {

        $filename = $file['name'];

        $dir = 'assets/upload/file/';

        if (!is_dir($dir)) {
            mkdir($dir, 0777, TRUE);
            // chmod(FCPATH . $dir, 0777);
        }

        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        $target_file = $dir . basename($filename);

        $fileCat = $this->m_file_cat->fileCatByFileCatName('CPLPict');
        $idFileCat = $fileCat['queryResult'] == true ? $fileCat['data']['idFileCat'] : 0;

        // chmod(FCPATH . $dir, 0777);
        if (move_uploaded_file($file["tmp_name"], $target_file)) {

            $data = [
                'idCat' => $idFileCat,
                'folder' => $dir,
                'files' => $dir . $filename,
                'userName' => $this->session->userdata('username')
            ];

            $file_upload = $this->m_file->fileUpload($data);
            // var_dump(json_encode($file_upload));
            // die;

            return $file_upload;
            die();
        }

        return false;
    }

    public function delete()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $id_task = [];

        if (!empty($this->input->post('idTask'))) {
            $id_task = $this->input->post('idTask');
        }

        // $id_asset = $this->input->post('idAsset');
        foreach ($id_task as $key => $id) {
            $asset = $this->m_task->taskDelete($id);
        }

        echo json_encode($asset);
        exit;
    }

    public function information_setting()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $user = $this->m_user->userById($this->session->userdata('id_user'))['data'];

        // $propSetting = $user['propUserSetting'];

        // if (count($propSetting) > 0 && $propSetting[0]['userVar'] == "signature|ttd") {
        //     $set_file['set_file'] = $this->m_file->fileBase64($propSetting[0]['userVal'])['data'];
        // } else {
        //     $set_file['set_file'] = "";
        // }

        $set_file['userVar'] =  $user['propUserSetting'][0]['userVar'];

        echo json_encode($set_file);
        die;
    }

    public function complain_by_id()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $show = [];
        $id_task = [];

        $id_task = $this->input->post('idTask');

        foreach ($id_task as $key => $id) {
            $result = $this->m_task->taskById($id);
        }

        if ($result['data']['idRelatedTask'] != 0) {
            $file_relatedTask = $this->m_task_files->taskFilesByIdTask($result['data']['idRelatedTask']);
            $show['data_file_related']  = $file_relatedTask['data'];
            if (!empty($file_relatedTask)) {
                $id_file = [];
                foreach ($file_relatedTask['data'] as $key => $value) {
                    $id_file[] = $value['idFile'];
                }
                foreach ($id_file as $key2 => $id) {
                    $view_file_related[] = $this->m_file->fileBase64($id)['data'];
                }
                if (!empty($view_file_related)) {
                    $show['view_file_related'] = $view_file_related;
                } else {
                    $show['view_file_related'] = "";
                }
            }
        }

        if ($result['data']['propTaskFiles'] != null) {
            $id_task_file = [];
            foreach ($result['data']['propTaskFiles'] as $key3 => $val) {
                # code...
                $id_task_file[] = $val['idFile'];
            }
            foreach ($id_task_file as $key4 => $id2) {
                $view_task_file[] = $this->m_file->fileBase64($id2)['data'];
            }
            if (!empty($view_task_file)) {
                $show['view_task_file'] = $view_task_file;
            } else {
                $show['view_task_file'] = "";
            }
        }

        $show['data_update'] = $result['data'];

        $approveSign = $result['data']['propProgress']['approveSign'];
        $finishSign = $result['data']['propProgress']['finishSign'];



        $finishDraw = strpos($finishSign, "DRAW");

        if ($finishDraw !== FALSE) {
            $approveSign2 = $approveSign ? $approveSign : '';
            $show['approveSign'] = $approveSign2 == '' ? '' : $approveSign2;

            $finishSign2 = $finishSign ? $finishSign : '';
            $show['finishSign'] = $finishSign2 == '' ? '' : $finishSign2;
        } else {
            $approveSign2 = $approveSign ? $this->m_otp->signatureByHash($approveSign) : '';
            $show['approveSign'] = $approveSign2 == '' ? '' : (new QRCode)->render(json_encode($approveSign2));

            $finishSign2 = $finishSign ? $this->m_otp->signatureByHash($finishSign) : '';
            $show['finishSign'] = $finishSign2 == '' ? '' : (new QRCode)->render(json_encode($finishSign2));
        }

        echo json_encode($show);
        exit;
    }

    public function complain_by_id_no_array()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $show = [];


        $id_task = trim($this->input->post('idTask'));

        $result = $this->m_task->taskById($id_task);


        if ($result['data']['idRelatedTask'] != 0) {
            $file_relatedTask = $this->m_task_files->taskFilesByIdTask($result['data']['idRelatedTask']);
            $show['data_file_related']  = $file_relatedTask['data'];
            if (!empty($file_relatedTask)) {
                $id_file = [];
                foreach ($file_relatedTask['data'] as $key => $value) {
                    $id_file[] = $value['idFile'];
                }
                foreach ($id_file as $key2 => $id) {
                    $view_file_related[] = $this->m_file->fileBase64($id)['data'];
                }
                if (!empty($view_file_related)) {
                    $show['view_file_related'] = $view_file_related;
                } else {
                    $show['view_file_related'] = "";
                }
            }
        }

        if ($result['data']['propTaskFiles'] != null) {
            $id_task_file = [];
            foreach ($result['data']['propTaskFiles'] as $key3 => $val) {
                # code...
                $id_task_file[] = $val['idFile'];
            }
            foreach ($id_task_file as $key4 => $id2) {
                $view_task_file[] = $this->m_file->fileBase64($id2)['data'];
            }
            if (!empty($view_task_file)) {
                $show['view_task_file'] = $view_task_file;
            } else {
                $show['view_task_file'] = "";
            }
        }

        $show['data_update'] = $result['data'];

        echo json_encode($show);
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
            $taskCode = 'CPL', //complain
            !empty($post['idProgress']) ? $post['idProgress'] : 0,
            !empty($post['idSchedule']) ? $post['idSchedule'] : 0,
            !empty($post['idRelatedTask']) ? $post['idRelatedTask'] : 0,
            !empty($post['taskType']) ? $post['taskType'] : '',
            !empty($post['assetCode']) ? $post['assetCode'] : $post['assetCode'], //taskName
            !empty($post['assetName']) ? $post['assetName'] : $post['assetName'], //taskDesc
            !empty($post['idVendor']) ? $post['idVendor'] : 0,
            !empty($post['taskKpi']) ? $post['taskKpi'] : 0,
            !empty($post['taskAmount']) ? $post['taskAmount'] : 0,
            'MED'
        );

        //insert data ke dalam segment progress
        if (!empty($post['idTask'])) {
            $idProgress = $post['idProgress'] ? $post['idProgress'] : 0;

            $getProgress = $this->m_progress->progressById($idProgress);
            $progress = $getProgress['data'];
        } else {
            $progress = $this->m_progress->data(
                $post['idProgress'] ? $post['idProgress'] : 0,
                $progressStatus = 'NEW',
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
        }
        $task['propProgress'] = $progress;

        $task['propSchedule'] = NULL;

        //insert data task complain
        $propTaskComplain[] = $this->m_task_complain->data(
            !empty($post['idTask']) ? $post['idTask'] : 0,
            !empty($post['idAsset']) ? $post['idAsset'] : 0,
            !empty($post['complainRequest']) ? $post['complainRequest'] : 0,
            !empty($post['complainAction']) ? $post['complainAction'] : '',
            !empty($post['complainPriority']) ? 1 : 0
        );
        $task['propTaskComplain'] = $propTaskComplain;

        //insert data ke dalam task files
        $task_files = [];
        if ($_FILES['taskFile1']['name'] == '') {
            $task_files[] = $this->m_task_files->data(
                $post['idTaskFile1'] ? $post['idTaskFile1'] : 0,
                $post['idTask'] ? $post['idTask'] : 0,
                $post['idFile1'] ? $post['idFile1'] : 0,
                $post['fileDesc1'] ? $post['fileDesc1'] : ''
            );
        } else {

            $task_file1 = $_FILES['taskFile1'] ? $this->task_file_upload($_FILES['taskFile1']) : '';

            if (!empty($task_file1['queryResult'])) {
                if ($task_file1['queryResult'] == true) {
                    $task_files[] = $this->m_task_files->data(
                        $post['idTaskFile1'] ? $post['idTaskFile1'] : 0,
                        $post['idTask'] ? $post['idTask'] : 0,
                        $post['idFile1'] ? $post['idFile1'] : $task_file1['data']['idFile'],
                        $_FILES['taskFile1']['name'] //fileDesc
                    );
                }
            }
        }

        if ($_FILES['taskFile2']['name'] == '') {
            $task_files[] = $this->m_task_files->data(
                $post['idTaskFile2'] ? $post['idTaskFile2'] : 0,
                $post['idTask'] ? $post['idTask'] : 0,
                $post['idFile2'] ? $post['idFile2'] : 0,
                $post['fileDesc2'] ? $post['fileDesc2'] : ''
            );
        } else {
            $task_file2 = $_FILES['taskFile2'] ? $this->task_file_upload($_FILES['taskFile2']) : '';

            if (!empty($task_file2['queryResult'])) {
                if ($task_file2['queryResult'] == true) {
                    $task_files[] = $this->m_task_files->data(
                        $post['idTaskFile2'] ? $post['idTaskFile2'] : 0,
                        $post['idTask'] ? $post['idTask'] : 0,
                        $post['idFile2'] ? $post['idFile2'] : $task_file2['data']['idFile'],
                        $_FILES['taskFile2']['name'] //fileDesc
                    );
                }
            }
        }

        $task_files_insert = [];
        foreach ($task_files as $task_file) {
            if ($task_file['idFile'] != 0) {
                $task_files_insert[] = $task_file;
            }
        }

        $task['propTaskFiles'] = $task_files_insert;

        if (!empty($post['idTask'])) {
            $task_update = $this->m_task->taskUpdate($task);
            // $asset_parent_id = $asset_insert['data'];
            // if ($task_update['queryResult'] == true) {
            //     $this->session->set_flashdata('sukses', "Success, data updated successfully with code CPL-{$post['idTask']}");
            // } else {
            //     $message = $task_update['queryMessage'] ? $task_update['queryMessage'] : 'Failed';
            //     $this->session->set_flashdata('error', $message);
            // }

            // redirect('task/med/complain', 'refresh');

            echo json_encode($task_update);
            die;
        } else {
            $task_insert = $this->m_task->taskInsert($task);
            // $task_parent_id = $task_insert['data'];

            // // var_dump($asset_insert);
            // // die;
            // if ($task_insert['queryResult'] == true) {
            //     $this->session->set_flashdata('sukses', "Success, data saved successfully with code CPL-{$task_parent_id}");
            // } else {
            //     $message = $task_insert['queryMessage'] ? $task_insert['queryMessage'] : 'Failed';
            //     $this->session->set_flashdata('error', $message);
            // }

            // redirect('task/med/complain', 'refresh');
            echo json_encode($task_insert);
            die;
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
        $taskSysCat = "MED";
        $idRelatedTask = $this->input->post('idRelatedTask');
        $taskCode = "CPL";

        $periode = $this->input->post('periode');

        $startDate = $this->input->post('startDate');
        $endDate = $this->input->post('endDate');

        $timeAssign = $this->input->post('timeAssign');
        $idAssignee = $this->input->post('idAssignee');
        $assignTo = $this->input->post('assignTo');

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

        if ($button_pdf == 'pdf') {
            $query_params = [];
            $query_params_like_or = [];
            $query_params_where_between = [];
            $query_groups_where_between = [];

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
                    "column" => "timeInit",
                    "value" => $scheduleStart->format('Y-m-d 00:00:00'),
                ];
                array_push($query_params_where_between, $scheduleStart_query_params);
            }

            if ($periode != '') {

                $scheduleEnd_query_params = [
                    "column" => "timeInit",
                    "value" => $scheduleEnd->format('Y-m-d 23:59:59'),
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

                    if ($taskCode == 'SOM') {
                        $subDetails = false;
                    }
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

            $query_groups_or = [];
            $query_groups_where_or = [];
            if ($status != '') {
                if ($status != 'ALL') {

                    $progressStatus = '';
                    if ($status == 1) {
                        // belum di kerjakan
                        $status_query_params = [
                            "column" => "progressStatus",
                            "value" => "NEW"
                        ];
                        array_push($query_groups_where_or, $status_query_params);
                    } elseif ($status == 2) {
                        $status_query_params = [
                            "column" => "progressStatus",
                            "value" => "NEW-RESPONDED-ASSIGNED-STARTED-PENDING"
                        ];
                        array_push($query_groups_where_or, $status_query_params);
                    } elseif ($status == 3) {
                        $status_query_params = [
                            "column" => "progressStatus",
                            "value" => "NEW-RESPONDED-ASSIGNED-STARTED-FINISHED"
                        ];
                        array_push($query_groups_where_or, $status_query_params);

                        $status_query_params = [
                            "column" => "progressStatus",
                            "value" => "NEW-RESPONDED-ASSIGNED-STARTED-PENDING-FINISHED"
                        ];
                        array_push($query_groups_where_or, $status_query_params);
                    } elseif ($status == 4) {
                        $status_query_params = [
                            "column" => "progressStatus",
                            "value" => "NEW-RESPONDED-ASSIGNED-STARTED-FINISHED-APPROVED"
                        ];
                        array_push($query_groups_where_or, $status_query_params);

                        $status_query_params = [
                            "column" => "progressStatus",
                            "value" => "NEW-RESPONDED-ASSIGNED-STARTED-PENDING-FINISHED-APPROVED"
                        ];
                        array_push($query_groups_where_or, $status_query_params);
                    }
                }
            }

            $query_groups_like_or = [];
            $query_groups = [];
            if ($q1 != null || $q2 != null || $q3 != null || $bq3 != null || $q4 != null || $bq4 != null || $q5 != null || $bq5 != null || $q6 != null || $bq6 != null || $q7 != null || $bq7 != null || $q8 != null || $bq8 != null || $q9 != null || $bq9 != null || $q10 != null || $bq10 != null || $taskSysCat != 'ALL' || $status != '' || $taskCode != 'ALL') {

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
                        "queryMethod" => "LIKEAND", //"LIKEAND",
                        "queryParams" => $query_params
                    ]
                ];
            }


            if ($status == 1 || $status == 2 || $status == 3 || $status == 4) {
                $query_groups_or = [
                    [
                        "queryMethod" => "EXACTOR",
                        "queryParams" => $query_groups_where_or
                    ]
                ];
            }

            if ($startDateq3 != '' || $startDatev3 != '' || $startDatebq3 != '' || $startDatebv3 != '' || $startDateq4 != '' || $startDatev4 != '' || $startDatebq4 != '' || $startDatebv4 != '' || $startDateq5 != '' || $startDatev5 != '' || $startDatebq5 != '' || $startDatebv5 != '' || $periode != '') {
                $query_groups_where_between = [
                    [
                        "queryMethod" => "BETWEEN",
                        "queryParams" => $query_params_where_between
                    ]
                ];
            }

            $merge_query_groups = array_merge($query_groups, $query_groups_like_or);
            $merge_query_groups = array_merge($merge_query_groups, $query_groups_or);
            $merge_query_groups = array_merge($merge_query_groups, $query_groups_where_between);

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
            ];

            $data['tasks'] = $this->m_task->taskQuery($request);

            // echo json_encode($data);
            // die;

            $mpdfConfig = array(
                'debug' => true,
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
            $html = $this->load->view('task/electromedic_task/print/complain/pdf', $data, TRUE);
            $mpdf->WriteHTML($html);
            $mpdf->shrink_tables_to_fit = 1;
            $mpdf->Output();
        } else {
            $query_params = [];
            $query_params_like_or = [];
            $query_params_where_between = [];
            $query_groups_where_between = [];

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
                    "column" => "timeInit",
                    "value" => $scheduleStart->format('Y-m-d 00:00:00'),
                ];
                array_push($query_params_where_between, $scheduleStart_query_params);
            }

            if ($periode != '') {

                $scheduleEnd_query_params = [
                    "column" => "timeInit",
                    "value" => $scheduleEnd->format('Y-m-d 23:59:59'),
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

                    if ($taskCode == 'SOM') {
                        $subDetails = false;
                    }
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

            $query_groups_or = [];
            $query_groups_where_or = [];
            if ($status != '') {
                if ($status != 'ALL') {

                    $progressStatus = '';
                    if ($status == 1) {
                        // belum di kerjakan
                        $status_query_params = [
                            "column" => "progressStatus",
                            "value" => "NEW"
                        ];
                        array_push($query_groups_where_or, $status_query_params);
                    } elseif ($status == 2) {
                        $status_query_params = [
                            "column" => "progressStatus",
                            "value" => "NEW-RESPONDED-ASSIGNED-STARTED-PENDING"
                        ];
                        array_push($query_groups_where_or, $status_query_params);
                    } elseif ($status == 3) {
                        $status_query_params = [
                            "column" => "progressStatus",
                            "value" => "NEW-RESPONDED-ASSIGNED-STARTED-FINISHED"
                        ];
                        array_push($query_groups_where_or, $status_query_params);

                        $status_query_params = [
                            "column" => "progressStatus",
                            "value" => "NEW-RESPONDED-ASSIGNED-STARTED-PENDING-FINISHED"
                        ];
                        array_push($query_groups_where_or, $status_query_params);
                    } elseif ($status == 4) {
                        $status_query_params = [
                            "column" => "progressStatus",
                            "value" => "NEW-RESPONDED-ASSIGNED-STARTED-FINISHED-APPROVED"
                        ];
                        array_push($query_groups_where_or, $status_query_params);

                        $status_query_params = [
                            "column" => "progressStatus",
                            "value" => "NEW-RESPONDED-ASSIGNED-STARTED-PENDING-FINISHED-APPROVED"
                        ];
                        array_push($query_groups_where_or, $status_query_params);
                    }
                }
            }

            $query_groups_like_or = [];
            $query_groups = [];
            if ($q1 != null || $q2 != null || $q3 != null || $bq3 != null || $q4 != null || $bq4 != null || $q5 != null || $bq5 != null || $q6 != null || $bq6 != null || $q7 != null || $bq7 != null || $q8 != null || $bq8 != null || $q9 != null || $bq9 != null || $q10 != null || $bq10 != null || $taskSysCat != 'ALL' || $status != '' || $taskCode != 'ALL') {

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
                        "queryMethod" => "LIKEAND", //"LIKEAND",
                        "queryParams" => $query_params
                    ]
                ];
            }


            if ($status == 1 || $status == 2 || $status == 3 || $status == 4) {
                $query_groups_or = [
                    [
                        "queryMethod" => "EXACTOR",
                        "queryParams" => $query_groups_where_or
                    ]
                ];
            }

            if ($startDateq3 != '' || $startDatev3 != '' || $startDatebq3 != '' || $startDatebv3 != '' || $startDateq4 != '' || $startDatev4 != '' || $startDatebq4 != '' || $startDatebv4 != '' || $startDateq5 != '' || $startDatev5 != '' || $startDatebq5 != '' || $startDatebv5 != '' || $periode != '') {
                $query_groups_where_between = [
                    [
                        "queryMethod" => "BETWEEN",
                        "queryParams" => $query_params_where_between
                    ]
                ];
            }

            $merge_query_groups = array_merge($query_groups, $query_groups_like_or);
            $merge_query_groups = array_merge($merge_query_groups, $query_groups_or);
            $merge_query_groups = array_merge($merge_query_groups, $query_groups_where_between);

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
            ];

            $data['tasks'] = $this->m_task->taskQuery($request);

            $this->load->view('task/electromedic_task/print/complain/excell', $data);
        }
    }
}
