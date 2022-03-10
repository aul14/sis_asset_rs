<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chillerlan\QRCode\QRCode;

class Repair extends CI_Controller
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
            'M_schedule'          => 'm_schedule',
            'M_task_repair'          => 'm_task_repair',
            'M_progress_detail'          => 'm_progress_detail',
            'M_form_gen'          => 'm_form_gen',
            'M_form_pic'        => 'm_form_pic',
            'M_form_services'        => 'm_form_services',
            'M_form_tools'        => 'm_form_tools',
            'M_otp'          => 'm_otp'
        ]);
    }


    public function index()
    {
        $result_role = $this->m_access_control->MyRole()['data']['roleACL'];

        $data['result_role'] = $result_role;
        $this->load->model('M_notifikasi', 'm_notifikasi');
        $data['notif'] = $this->m_notifikasi->list()['data'];

        if ($result_role[2]['subMenu1'][0]['subMenu2'][5]['isAllow'] != true) {
            exit('You dont have access!!');
        }

        $this->load->view('components/header');
        $this->load->view('components/sidebar', $data);
        $this->load->view('task/electromedic_task/repair_med_index');
        $this->load->view('task/electromedic_task/form/repair_form');
        $this->load->view('task/electromedic_task/details/complain_repair_details');
        $this->load->view('task/electromedic_task/print/repair/task_print');
        $this->load->view('task/electromedic_task/approve/complain_repair_approve');
        $this->load->view('components/sidebar_footer');
        $this->load->view('components/footer');
        $this->load->view('task/task');
    }

    public function files_by_id_task()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $id_task = $this->input->post('idTask');

        $result = $this->m_task_files->taskFilesByIdTask($id_task);

        $show['data_file'] = $result['data'];

        echo json_encode($show);
        exit;
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

        $fileCat = $this->m_file_cat->fileCatByFileCatName('RPRPict');
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

            return $file_upload;
            die();
        }

        return false;
    }

    public function finishSignDraw()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $post = $this->input->post();

        $idTask = isset($post['idTask']) ? $post['idTask'] : 89;
        $signHash = "DRAW-" . $this->session->userdata('id_user') . ".png";

        $task = $this->m_task->taskById($idTask);
        $task['data']['propProgress']['finishSign'] = $signHash;
        $task['data']['propProgress']['idFinishBy'] = $this->session->userdata('id_user');
        $task['data']['propProgress']['finishBy'] = $this->session->userdata('username');

        $propProgress = $task['data']['propProgress'];

        $update = $this->m_progress->progressUpdate($propProgress);

        echo json_encode($signHash);
        die;
    }

    public function approveSignDraw()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $post = $this->input->post();

        $idTask = isset($post['idTask']) ? $post['idTask'] : 89;
        $signHash = "DRAW-" . $this->session->userdata('id_user') . ".png";
        $username = $this->session->userdata('username');

        $task = $this->m_task->taskById($idTask);
        $task['data']['propProgress']['approveSign'] = $signHash;
        $task['data']['propProgress']['idApproveBy'] = $this->session->userdata('id_user');
        $task['data']['propProgress']['approveBy'] = $this->session->userdata('username');
        $task['data']['propProgress']['timeApproved'] = date('Y-m-d H:i:s');

        $propProgress = $task['data']['propProgress'];

        $update = $this->m_progress->progressUpdate($propProgress);

        echo json_encode([
            "signHash"      => $signHash,
            "username"      => $username,
        ]);
        die;
    }

    public function finishSign()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $post = $this->input->post();

        $idTask = isset($post['idTask']) ? $post['idTask'] : 89;
        $signHash = isset($post['signHash']) ? $post['signHash'] : 'sdfdsfs';
        $task['data']['propProgress']['idFinishBy'] = $this->session->userdata('id_user');
        $task['data']['propProgress']['finishBy'] = $this->session->userdata('username');

        $task = $this->m_task->taskById($idTask);
        $task['data']['propProgress']['finishSign'] = $signHash;

        $propProgress = $task['data']['propProgress'];

        $update = $this->m_progress->progressUpdate($propProgress);

        echo json_encode($update);
        die;
    }

    public function approveSign()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $post = $this->input->post();

        $idTask = isset($post['idTask']) ? $post['idTask'] : 89;
        $signHash = isset($post['signHash']) ? $post['signHash'] : 'sdfdsfs';

        $task = $this->m_task->taskById($idTask);
        $task['data']['propProgress']['approveSign'] = $signHash;
        $task['data']['propProgress']['idApproveBy'] = $this->session->userdata('id_user');
        $task['data']['propProgress']['approveBy'] = $this->session->userdata('username');
        $task['data']['propProgress']['timeApproved'] = date('Y-m-d H:i:s');

        $propProgress = $task['data']['propProgress'];

        $update = $this->m_progress->progressUpdate($propProgress);

        echo json_encode($update);
        die;
    }

    public function generate_ttd()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $post = $this->input->post();

        // $idTask = isset($post['idTask']) ? $post['idTask'] : 89;
        $signHash = isset($post['signHash']) ? $post['signHash'] : '';

        $generate = $signHash == '' ? '' : $this->m_otp->signatureByHash($signHash);

        $ttd['otp'] = $generate == '' ? '' : (new QRCode)->render(json_encode($generate));
        $ttd['otp_name'] = $generate == '' ? '' : $generate['signPerson'];

        echo json_encode($ttd);
        die;
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
        $taskCode = "RPR";

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
            $html = $this->load->view('task/electromedic_task/print/repair/pdf', $data, TRUE);
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

            $this->load->view('task/electromedic_task/print/repair/excell', $data);
        }
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
            $taskCode = 'RPR', //complain
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
        $task['propProgress'] = "";

        $schedule = $this->m_schedule->data(
            !empty($post['idSchedule']) ? $post['idSchedule'] : 0,
            $parentSchedule = 0,
            $scheduleType = 'DAILY',
            $scheduleName = !empty($post['taskName']) ? $post['taskName'] : '',
            $scheduleDesc = !empty($post['taskDesc']) ? $post['taskDesc'] : '',
            !empty($post['scheduleStart']) ? $post['scheduleStart'] : '',
            !empty($post['scheduleEnd']) ? $post['scheduleEnd'] : '',
            $dayRepeat = '',
            $createBy = $this->session->userdata('username'),
            'MED'
        );
        $task['propSchedule'] = $schedule;

        $propTaskRepair[] = $this->m_task_repair->data(
            !empty($post['idTask']) ? $post['idTask'] : 0,
            !empty($post['idAsset']) ? $post['idAsset'] : 0,
            !empty($post['idComplain']) ? $post['idComplain'] : 0,
            !empty($post['idForm']) ? $post['idForm'] : 0,
            !empty($post['isPending']) ?  false  : true,
            !empty($post['isNeedPart'])  ? true  : false,
            !empty($post['complainRequest']) ? $post['complainRequest'] : '', //repairProblem
            !empty($post['repairResult']) ? $post['repairResult'] : '',
            !empty($post['complainAction']) ? $post['complainAction'] : '', //repairAction
            $post['repairNote'] ? $post['repairNote'] : ''
        );
        $task['propTaskRepair'] = $propTaskRepair;

        $form = [
            'idForm'    => !empty($post['idForm']) ? $post['idForm'] : 0,
            'idFormType'    => 3,
            'formName'    => !empty($post['formName']) ? $post['formName'] : "",
            'formCode'    => !empty($post['formCode']) ? $post['formCode'] : "",
            'finalResult'    => !empty($post['repairResult']) ? $post['repairResult'] : "",
            'finalNote'    => !empty($post['finalNote']) ? $post['finalNote'] : "",
        ];
        $formType = [
            'idFormType'    =>  3,
            'formTypeName'    =>  "Repair Forms",
            'propFormTypeprop'  => []
        ];
        $task['propTaskRepair'][0]['propForm'] = $form;
        $task['propTaskRepair'][0]['propForm']['propFormType'] = $formType;
        $task['propTaskRepair'][0]['propForm']['propFormAlkur'] = [];

        if (empty($post['idTask'])) {
            $task['propTaskRepair'][0]['propForm']['propFormTools'] = !empty($_SESSION['sesspropFormTools']) ? $_SESSION['sesspropFormTools'] : [];
        } else {
            $tools = $this->m_form_tools->by_id_form($post['idForm']);
            $task['propTaskRepair'][0]['propForm']['propFormTools'] = $tools['data'];
        }

        $task['propTaskRepair'][0]['propForm']['propFormElectrical'] =  '';
        $task['propTaskRepair'][0]['propForm']['propFormEncon'] =  '';
        $task['propTaskRepair'][0]['propForm']['propFormEqdata'] =  [
            'idForm'    => !empty($post['idForm']) ? $post['idForm'] : 0,
            'idTemplate'    => !empty($post['idTemplate']) ? $post['idTemplate'] : 0,
            'eqCode'    => !empty($post['catCode']) ? $post['catCode'] : "",
            'eqName'    => !empty($post['assetName']) ? $post['assetName'] : "",
            'eqMerk'    => !empty($post['merk']) ? $post['merk'] : "",
            'eqType'    => !empty($post['tipe']) ? $post['tipe'] : "",
            'eqSN'    => !empty($post['serialNumber']) ? $post['serialNumber'] : "",
            'eqLocation'    => !empty($post['roomName']) ? $post['roomName'] : "",
            'idAsset'    => !empty($post['idAsset']) ? $post['idAsset'] : 0,
            'createdDate'    => date('Y-m-d H:i:s')
        ];

        if (empty($post['idTask'])) {
            $task['propTaskRepair'][0]['propForm']['propFormGen'] = !empty($_SESSION['sesspropFormGen']) ? $_SESSION['sesspropFormGen'] : [];
        } else {
            $gen = $this->m_form_gen->formGenByIdForm($post['idForm']);
            $task['propTaskRepair'][0]['propForm']['propFormGen'] = $gen['data'];
        }

        if (empty($post['idTask'])) {
            $task['propTaskRepair'][0]['propForm']['propFormPart'] = !empty($_SESSION['sesspropFormPart']) ? $_SESSION['sesspropFormPart'] : [];
            $task['propTaskRepair'][0]['propForm']['propFormServices'] = !empty($_SESSION['sesspropFormServices']) ? $_SESSION['sesspropFormServices'] : [];
            $task['propTaskRepair'][0]['propForm']['propFormPic'] = !empty($_SESSION['sesspropFormPic']) ? $_SESSION['sesspropFormPic'] : [];
        } else {
            $services = $this->m_form_services->formServicesByIdForm($post['idForm']);
            $pic = $this->m_form_pic->by_idform($post['idForm']);
            $task['propTaskRepair'][0]['propForm']['propFormServices'] = $services['data'];
            $task['propTaskRepair'][0]['propForm']['propFormPic'] = $pic['data'];
        }

        $idAsset = !empty($post['idAsset']) ? $post['idAsset'] : 0;
        $asset = $this->m_asset->assetById($idAsset);
        $task['propTaskRepair'][0]['propAsset'] = $asset['data'];

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


        if (empty($post['idTask'])) {
            $task_insert = $this->m_task->taskInsert($task);
            $idTaskSRC = $post['idComplain'] ? $post['idComplain'] : 0;
            $idTaskDST = $task_insert['data']; //$post['idTask'] ? $post['idTask'] : 0;
            $this->m_task->taskSetRelation($idTaskSRC, $idTaskDST);

            if (!empty($post['idVendor'])) {
                $task_cpl = $this->m_task->taskById($post['idRelatedTask']);

                $task_cpl['data']['idVendor'] = $post['idVendor'];

                $this->m_task->taskUpdate($task_cpl['data']);
            }

            if (empty($post['isPending'])) {
                $idProgress = !empty($post['idProgress']) ? $post['idProgress'] : 0;
                $get_progress = $this->m_progress->progressById($idProgress);

                $get_progress['data']['timeRespon'] = date('Y-m-d H:i:s');
                $get_progress['data']['idResponBy'] = $this->session->userdata('id_user');
                $get_progress['data']['responBy'] = $this->session->userdata('username');

                $get_progress['data']['idDelegator'] = $this->session->userdata('id_user');
                $get_progress['data']['delegateBy'] = $this->session->userdata('username');
                $get_progress['data']['timeDelegate'] = date('Y-m-d H:i:s');

                $get_progress['data']['timeStart'] = date('Y-m-d H:i:s');
                $get_progress['data']['idStartBy'] = $this->session->userdata('id_user');
                $get_progress['data']['startBy'] = $this->session->userdata('username');

                $get_progress['data']['timePending'] = date('Y-m-d H:i:s');
                $get_progress['data']['idPendingBy'] = $this->session->userdata('id_user');
                $get_progress['data']['pendingBy'] = $this->session->userdata('username');

                $get_progress['data']['timeAssign'] = date('Y-m-d H:i:s');
                $get_progress['data']['idAssignee'] = $this->session->userdata('id_user');
                $get_progress['data']['assignTo'] = $this->session->userdata('username');

                $progress_update = $this->m_progress->progressUpdate($get_progress['data']);
                // $task['propProgress'] = $progress_update;
            } else {
                $idProgress = !empty($post['idProgress']) ? $post['idProgress'] : 0;
                $get_progress = $this->m_progress->progressById($idProgress);

                $get_progress['data']['timeRespon'] = date('Y-m-d H:i:s');
                $get_progress['data']['idResponBy'] = $this->session->userdata('id_user');
                $get_progress['data']['responBy'] = $this->session->userdata('username');

                $get_progress['data']['idDelegator'] = $this->session->userdata('id_user');
                $get_progress['data']['delegateBy'] = $this->session->userdata('username');
                $get_progress['data']['timeDelegate'] = date('Y-m-d H:i:s');

                $get_progress['data']['timeStart'] = date('Y-m-d H:i:s');
                $get_progress['data']['idStartBy'] = $this->session->userdata('id_user');
                $get_progress['data']['startBy'] = $this->session->userdata('username');

                $get_progress['data']['timeFinish'] = date('Y-m-d H:i:s');
                $get_progress['data']['idFinishBy'] = $this->session->userdata('id_user');
                $get_progress['data']['finishBy'] = $this->session->userdata('username');

                $get_progress['data']['timeAssign'] = date('Y-m-d H:i:s');
                $get_progress['data']['idAssignee'] = $this->session->userdata('id_user');
                $get_progress['data']['assignTo'] = $this->session->userdata('username');

                $progress_update = $this->m_progress->progressUpdate($get_progress['data']);

                // $get_asset = $this->m_asset->assetById($post['idAsset']);
                $asset['data']['propAssetPropadmin']['condition'] = $post['repairResult'];

                $this->m_asset->assetUpdate($asset['data']);

                // $task['propProgress'] = $progress_update;
            }


            // var_dump($progress_update);
            // die;

            if ($task_insert['queryResult'] == true && $progress_update['queryResult'] == true) {
                // $this->session->set_flashdata('sukses', "Success, data saved successfully");

                $this->session->unset_userdata('sesspropFormTools');
                $this->session->set_userdata('sesspropFormTools', []);
                $this->session->unset_userdata('sesspropFormGen');
                $this->session->set_userdata('sesspropFormGen', []);
                $this->session->unset_userdata('sesspropFormPart');
                $this->session->set_userdata('sesspropFormPart', []);
                $this->session->unset_userdata('sesspropFormServices');
                $this->session->set_userdata('sesspropFormServices', []);
                $this->session->unset_userdata('sesspropFormPic');
                $this->session->set_userdata('sesspropFormPic', []);
                // redirect('task/med/repair', 'refresh');

                echo json_encode($task_insert);
                die;
            } else {
                $task_message = $task_insert['queryMessage'] ? $task_insert['queryMessage'] : 'Failed';
                $progress_message = $progress_update['queryMessage'] ? $progress_update['queryMessage'] : 'Failed';

                // $this->session->set_flashdata('error', $task_message . ' ' . $progress_message);
                $this->session->unset_userdata('sesspropFormTools');
                $this->session->set_userdata('sesspropFormTools', []);
                $this->session->unset_userdata('sesspropFormGen');
                $this->session->set_userdata('sesspropFormGen', []);
                $this->session->unset_userdata('sesspropFormPart');
                $this->session->set_userdata('sesspropFormPart', []);
                $this->session->unset_userdata('sesspropFormServices');
                $this->session->set_userdata('sesspropFormServices', []);
                $this->session->unset_userdata('sesspropFormPic');
                $this->session->set_userdata('sesspropFormPic', []);
                // redirect('task/med/repair', 'refresh');
                echo json_encode($task_insert);
                die;
            }
        } else {
            $idProgress = isset($post['idProgress']) ? $post['idProgress'] : 0;
            $get_progress = $this->m_progress->progressById($idProgress);

            if ($get_progress['data']['timeAssign'] == '' && $get_progress['data']['idAssignee'] == 0 && $get_progress['data']['assignTo'] == '') {
                // $this->session->set_flashdata('error', 'Repair not assign to technician');

                $this->session->unset_userdata('sesspropFormTools');
                $this->session->set_userdata('sesspropFormTools', []);
                $this->session->unset_userdata('sesspropFormGen');
                $this->session->set_userdata('sesspropFormGen', []);
                $this->session->unset_userdata('sesspropFormPart');
                $this->session->set_userdata('sesspropFormPart', []);
                $this->session->unset_userdata('sesspropFormServices');
                $this->session->set_userdata('sesspropFormServices', []);
                // redirect('task/med/repair', 'refresh');
                // die();
                echo json_encode([
                    "queryMessage"  => "Repair not assign to technician"
                ]);
                die;
            }

            if ($get_progress['data']['timeStart'] == '' && $get_progress['data']['idStartBy'] == 0 && $get_progress['data']['startBy'] == '') {
                // $this->session->set_flashdata('error', 'Repair not start working');

                $this->session->unset_userdata('sesspropFormTools');
                $this->session->set_userdata('sesspropFormTools', []);
                $this->session->unset_userdata('sesspropFormGen');
                $this->session->set_userdata('sesspropFormGen', []);
                $this->session->unset_userdata('sesspropFormPart');
                $this->session->set_userdata('sesspropFormPart', []);
                $this->session->unset_userdata('sesspropFormServices');
                $this->session->set_userdata('sesspropFormServices', []);
                // redirect('task/med/repair', 'refresh');
                // die();
                echo json_encode([
                    "queryMessage"  => "Repair not start working"
                ]);
                die;
            }


            if (empty($post['isPending'])) {
                $get_progress_detail = [
                    $this->m_progress_detail->data(
                        $idProgresDet = 0,
                        $idProgress = $idProgress,
                        $pdetStatus = 'Pending',
                        $post['pdetDesc'],
                        $pdetTime = date('Y-m-d H:i:s')
                    )
                ];

                $propProgressDetail = array_merge($get_progress_detail, $get_progress['data']['propProgressDetail']);

                $get_progress['data']['timePending'] = date('Y-m-d H:i:s');
                $get_progress['data']['idPendingBy'] = $this->session->userdata('id_user');
                $get_progress['data']['pendingBy'] = $this->session->userdata('username');
                $get_progress['data']['propProgressDetail'] = $propProgressDetail;

                $progress_update = $this->m_progress->progressUpdate($get_progress['data']);
            } else {
                $get_progress['data']['timeFinish'] = date('Y-m-d H:i:s');
                $get_progress['data']['idFinishBy'] = $this->session->userdata('id_user');
                $get_progress['data']['finishBy'] = $this->session->userdata('username');

                $progress_update = $this->m_progress->progressUpdate($get_progress['data']);
            }

            $task_update = $this->m_task->taskUpdate($task);

            if (!empty($post['idVendor'])) {
                $task_cpl = $this->m_task->taskById($post['idRelatedTask']);

                $task_cpl['data']['idVendor'] = $post['idVendor'];

                $this->m_task->taskUpdate($task_cpl['data']);
            }

            // var_dump($task_update, $progress_update);
            // die;

            $idTaskSRC = $post['idComplain'] ? $post['idComplain'] : 0;
            $idTaskDST = $post['idTask'] ? $post['idTask'] : 0;
            $this->m_task->taskSetRelation($idTaskSRC, $idTaskDST);


            if ($task_update['queryResult'] == true) {
                // $this->session->set_flashdata('sukses', "Success, data updated successfully");

                $this->session->unset_userdata('sesspropFormTools');
                $this->session->set_userdata('sesspropFormTools', []);
                $this->session->unset_userdata('sesspropFormGen');
                $this->session->set_userdata('sesspropFormGen', []);
                $this->session->unset_userdata('sesspropFormPart');
                $this->session->set_userdata('sesspropFormPart', []);
                $this->session->unset_userdata('sesspropFormServices');
                $this->session->set_userdata('sesspropFormServices', []);
                // redirect('task/med/repair', 'refresh');

                echo json_encode($task_update);
                die;
            } else {
                $message = $task_update['queryMessage'] ? $task_update['queryMessage'] : 'Failed';
                // $this->session->set_flashdata('error', $message);

                $this->session->unset_userdata('sesspropFormTools');
                $this->session->set_userdata('sesspropFormTools', []);
                $this->session->unset_userdata('sesspropFormGen');
                $this->session->set_userdata('sesspropFormGen', []);
                $this->session->unset_userdata('sesspropFormPart');
                $this->session->set_userdata('sesspropFormPart', []);
                $this->session->unset_userdata('sesspropFormServices');
                $this->session->set_userdata('sesspropFormServices', []);
                // redirect('task/med/repair', 'refresh');
                echo json_encode($task_update);
                die;
            }
        }
    }
}
