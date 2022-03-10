<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Repair_datatable extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->simple_login->cek_login(); // cek login
        $this->load->model([
            'M_task'                => 'm_task'
        ]);
    }

    public function task_data_table()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        // $vmode = $this->input->get('vmode');
        $subDetails = true;

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
        $status = htmlspecialchars($this->input->post('status'));
        $taskSysCat = htmlspecialchars($this->input->post('taskSysCat'));
        $idRelatedTask = htmlspecialchars($this->input->post('idRelatedTask'));
        $taskCode = htmlspecialchars($this->input->post('taskCode'));

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

        $timeAssign = htmlspecialchars($this->input->post('timeAssign'));
        $idAssignee = htmlspecialchars($this->input->post('idAssignee'));
        $assignTo = htmlspecialchars($this->input->post('assignTo'));

        $draw   = $this->input->post('draw');
        $start  = $this->input->post('start');
        $length = $this->input->post('length') ? $this->input->post('length') : 1;

        $search = str_replace("'", "", strtolower($this->input->post('search')['value']));
        $searchTerms = explode(" ",  $search);
        $orderColumn = isset($this->input->post('order')[0]['column']) ? $this->input->post('order')[0]['column'] : '';
        $dir = isset($this->input->post('order')[0]['dir']) ? $this->input->post('order')[0]['dir'] : '';

        $array = [];
        if ($searchTerms) {
            foreach ($searchTerms as $searchTerm) {
                $array['search'] = $searchTerm;
            }
        }

        if ($dir === 'asc') {
            $array['order'] = 'desc';
        }

        $query_params = [];
        $query_params_like_or = [];
        $query_params_where_between = [];
        $query_groups_where_between = [];

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

        if ($array['search'] != '') {

            $idTask_query_params = [
                "column" => "idTask",
                "value" => $array['search']
            ];
            array_push($query_params_like_or, $idTask_query_params);

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

        if ($status != '') {
            $status_query_params = [
                "column" => "mutationStatus",
                "value" => $status
            ];

            array_push($query_params, $status_query_params);
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

        if ($array['search'] != '') {
            $query_groups_like_or = [
                [
                    "queryMethod" => "LIKEOR",
                    "queryParams" => $query_params_like_or
                ]
            ];
        }

        if ($startDateq3 != '' || $startDatev3 != '' || $startDatebq3 != '' || $startDatebv3 != '' || $startDateq4 != '' || $startDatev4 != '' || $startDatebq4 != '' || $startDatebv4 != '' || $startDateq5 != '' || $startDatev5 != '' || $startDatebq5 != '' || $startDatebv5 != '') {
            $query_groups_where_between = [
                [
                    "queryMethod" => "BETWEEN",
                    "queryParams" => $query_params_where_between
                ]
            ];
        }

        $merge_query_groups = array_merge($query_groups, $query_groups_like_or);
        $merge_query_groups = array_merge($merge_query_groups, $query_groups_where_between);


        $count_asset = $this->m_task->taskQuery(
            [
                "queryGroupMethod" => "AND",
                "queryGroups" => $query_params ? $merge_query_groups : [],
                'page' => 1,
                'limit' => 1
            ]
        );
        $totalFiltered = $count_asset['dataCount'];

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
            "limit" =>  isset($length) ? (int)$length : 10,
            "withDetails" => true,
            "subDetails" => $subDetails,
        ];

        $posts = $this->m_task->taskQuery($request);

        if (sizeof($posts) > 0) {
            $no = 1;
            foreach ($posts['data'] as $key => $value) {

                if ($value['propTaskComplain']) {

                    $idTask = $value['idTask'];
                    $posts['data'][$key]['radioButton'] = "<input type='radio' class='radioButtonTask' id='radio{$no}' name='radio' value='{$idTask}'>";
                    $posts['data'][$key]['check_box_cuk'] = "<input type='checkbox' id='delcheck_{$idTask}'  name='msg[]' class='delete_check' value='{$idTask}' />";

                    // complain only one data
                    $posts['data'][$key]['propTaskComplain'] = $value['propTaskComplain'][0];

                    $status_img = '';
                    if ($value['propProgress']['timeInit'] != '' && $value['propProgress']['timeRespon'] == '' && $value['propProgress']['timeAssign'] == '' && $value['propProgress']['timeStart'] == '') {
                        $status = 'WAITING RESPONSE';
                        $status_img = '<a href="#"><img src="' . base_url() . '/assets/images/icon/cross.png" alt="WAITING RESPONSE" style="height:14px; display:block; margin:0 auto;" title="WAITING RESPONSE" class="tip"></a>';
                    } elseif ($value['propProgress']['timeInit'] != '' && $value['propProgress']['timeRespon'] != '' && $value['propProgress']['timeAssign'] == '' && $value['propProgress']['timeStart'] == '') {
                        $status = 'NOT ASSIGNED, ALREADY RESPONSE';
                        $status_img = '<a href="#"><img src="' . base_url() . '/assets/images/icon/signal.png" alt="NOT ASSIGNED, ALREADY RESPONSE" style="height:14px; display:block; margin:0 auto;" title="NOT ASSIGNED, ALREADY RESPONSE" class="tip"></a>';
                    } elseif ($value['propProgress']['timeInit'] != '' && $value['propProgress']['timeRespon'] != '' && $value['propProgress']['timeAssign'] != '' && $value['propProgress']['timeStart'] == '') {
                        $status = 'WAITING REPAIR, ALREADY RESPONSE';
                        $status_img = '<a href="#"><img src="' . base_url() . '/assets/images/icon/waiting.png" alt="WAITING REPAIR, ALREADY RESPONSE" style="height:14px; display:block; margin:0 auto;" title="WAITING REPAIR, ALREADY RESPONSE" class="tip"></a>';
                    } elseif ($value['propProgress']['timeInit'] != '' && $value['propProgress']['timeRespon'] != '' && $value['propProgress']['timeAssign'] != '' && $value['propProgress']['timeStart'] != '' && $value['propProgress']['timePending'] != '' && $value['propProgress']['timeFinish'] == '') {
                        $status = 'PENDING';
                        $status_img = '<img src="' . base_url() . '/assets/images/icon/pending.png" alt="PENDING" style="height:14px; display:block; margin:0 auto;" title="PENDING" class="tip">';
                    } elseif ($value['propProgress']['timeInit'] != '' && $value['propProgress']['timeRespon'] != '' && $value['propProgress']['timeAssign'] != '' && $value['propProgress']['timeStart'] != '' && $value['propProgress']['timePending'] == '' && $value['propProgress']['timeFinish'] == '') {
                        $status = 'START WORK';
                        $status_img = '<img src="' . base_url() . '/assets/images/icon/progress.png" alt="START WORK" style="height:14px; display:block; margin:0 auto;" title="START WORK" class="tip">';
                    } elseif (
                        $value['propProgress']['timeInit'] != '' && $value['propProgress']['timeRespon'] != ''
                        && $value['propProgress']['timeAssign'] != '' && $value['propProgress']['timeStart'] != ''
                        && $value['propProgress']['timeFinish'] != '' && $value['propProgress']['timeApproved'] == ''
                        // && $value['propProgress']['timePending'] != '' 
                    ) {
                        $status = 'FINISH, WAITING APPROVE';
                        $status_img = '<img src="' . base_url() . '/assets/images/icon/check_red.png" alt="WAITING APPROVE" style="height:14px; display:block; margin:0 auto;" title="FINISH, WAITING APPROVE" class="tip">';
                    } elseif (
                        $value['propProgress']['timeInit'] != '' && $value['propProgress']['timeRespon'] != ''
                        && $value['propProgress']['timeAssign'] != '' && $value['propProgress']['timeStart'] != ''
                        && $value['propProgress']['timeFinish'] != '' && $value['propProgress']['timeApproved'] != ''
                        // && $value['propProgress']['timePending'] != '' 
                    ) {
                        $status = 'FINISH';
                        $status_img = '<img src="' . base_url() . '/assets/images/icon/check.png" alt="FINISH" style="height:14px; display:block; margin:0 auto;" title="Done" class="tip">';
                    }

                    $time_finish = $value['propProgress']['timeFinish'] == '' ? date('Y-m-d H:i:s') : $value['propProgress']['timeFinish'];
                    $complain_duration = $this->differenceTimestamps($value['propProgress']['timeInit'], $time_finish);

                    if ($value['propTaskComplain'][0]['complainPriority'] == 1) {
                        $posts['data'][$key]['propTaskComplain']['taskComplainCode'] = '<p style="color:red">' . $value['taskCode'] . '-' . $value['idTask'] . '</p>';
                        $posts['data'][$key]['taskName'] = '<p style="color:red">' . $value['taskName'] . '</p>';
                        $posts['data'][$key]['taskDesc'] = '<p style="color:red">' . $value['taskDesc'] . '</p>';
                        $posts['data'][$key]['propTaskComplain']['propAsset']['assetCode'] = '<p style="color:red">' . $value['propTaskComplain'][0]['propAsset']['assetCode'] . '</p>';
                        $posts['data'][$key]['propTaskComplain']['propAsset']['assetName'] = '<p style="color:red">' . $value['propTaskComplain'][0]['propAsset']['assetName'] . '</p>';
                        $posts['data'][$key]['propTaskComplain']['propAsset']['propAssetPropgenit']['merk'] = '<p style="color:red">' . $value['propTaskComplain'][0]['propAsset']['propAssetPropgenit']['merk'] . '</p>';
                        $posts['data'][$key]['propTaskComplain']['propAsset']['propAssetPropgenit']['tipe'] = '<p style="color:red">' . $value['propTaskComplain'][0]['propAsset']['propAssetPropgenit']['tipe'] . '</p>';
                        $posts['data'][$key]['propTaskComplain']['propAsset']['propAssetPropgenit']['serialNumber'] = '<p style="color:red">' . $value['propTaskComplain'][0]['propAsset']['propAssetPropgenit']['serialNumber'] . '</p>';
                        $posts['data'][$key]['propTaskComplain']['propAsset']['propAssetPropadmin']['propAssetPropbuildingRoom']['roomName'] = '<p style="color:red">' . $value['propTaskComplain'][0]['propAsset']['propAssetPropadmin']['propAssetPropbuildingRoom']['roomName'] . '</p>';
                        $posts['data'][$key]['propSchedule']['scheduleStart'] = '<p style="color:red">' . $value['propSchedule']['scheduleStart'] . '</p>';
                        $posts['data'][$key]['propSchedule']['scheduleEnd'] = '<p style="color:red">' . $value['propSchedule']['scheduleEnd'] . '</p>';
                        $posts['data'][$key]['propProgress']['initBy'] = '<p style="color:red">' . $value['propProgress']['initBy'] . '</p>';
                        $posts['data'][$key]['propProgress']['assignTo'] = '<p style="color:red">' . $value['propProgress']['assignTo'] . '</p>';
                        $posts['data'][$key]['propProgress']['complainDuration'] = '<p style="color:red">' . $complain_duration . '</p>';
                        $posts['data'][$key]['propTaskComplain']['complainRequest'] = '<p style="color:red">' . $value['propTaskComplain'][0]['complainRequest'] . '</p>';
                        $posts['data'][$key]['propTaskComplain']['complainAction'] = '<p style="color:red">' . $value['propTaskComplain'][0]['complainAction'] . '</p>';
                    } else {
                        $posts['data'][$key]['propTaskComplain']['taskComplainCode'] = $value['taskCode'] . '-' . $value['idTask'];
                        $posts['data'][$key]['propProgress']['complainDuration'] = $complain_duration;
                    }

                    $posts['data'][$key]['propTaskComplain']['status'] = $status_img;
                } else {
                    $posts['data'][$key]['propTaskComplain'] = '';
                }

                // $isCheckedFalse = [];
                // $isCheckedTrue = [];
                $countItem = 0;
                $countScan = 0;
                if ($value['propTaskStockopname']) {
                    foreach ($value['propTaskStockopname'] as $propTaskStockopname) {

                        $countItem = $propTaskStockopname['countItem'];
                        $countScan = $propTaskStockopname['countScan'];
                    }
                }

                $notScanned = $countItem - $countScan;

                $posts['data'][$key]['scanned'] = "<a href='#' style='color: blue'>{$countScan}</a>";
                $posts['data'][$key]['notScanned'] = "<a href='#' style='color: blue'>{$notScanned}</a>";
                $posts['data'][$key]['totalAsset'] = $countItem;


                if ($value['propTaskMutation']) {
                    foreach ($value['propTaskMutation'] as $propTaskMutation) {
                        if ($propTaskMutation['mutationStatus'] == 'Open') {
                            $status = 'Open';
                            $status_img = '<a href="#"><img src="' . base_url() . '/assets/images/icon/signal.png" alt="Open" style="height:14px; display:block; margin:0 auto;" title="Open" class="tip"></a>';
                        } elseif ($propTaskMutation['mutationStatus'] == 'Not Approved') {
                            $status = 'Not Approved';
                            $status_img = '<a href="#"><img src="' . base_url() . '/assets/images/icon/cross.png" alt="Not Approved" style="height:14px; display:block; margin:0 auto;" title="Not Approved" class="tip"></a>';
                        } elseif ($propTaskMutation['mutationStatus'] == 'Borrowed') {
                            $status = 'Borrowed';
                            $status_img = '<a href="#"><img src="' . base_url() . '/assets/images/icon/countdown.png" alt="Borrowed" style="height:14px; display:block; margin:0 auto;" title="Borrowed" class="tip"></a>';
                        } elseif ($propTaskMutation['mutationStatus'] == 'Expired') {
                            $status = 'Expired';
                            $status_img = '<a href="#"><img src="' . base_url() . '/assets/images/icon/no.png" alt="Expired" style="height:14px; display:block; margin:0 auto;" title="Expired" class="tip"></a>';
                        } elseif ($propTaskMutation['mutationStatus'] == 'Returned') {
                            $status = 'Returned';
                            $status_img = '<a href="#"><img src="' . base_url() . '/assets/images/icon/return_unconfirmed.png" alt="Returned" style="height:14px; display:block; margin:0 auto;" title="Returned" class="tip"></a>';
                        } elseif ($propTaskMutation['mutationStatus'] == 'Return Completed') {
                            $status = 'Return Completed';
                            $status_img = '<a href="#"><img src="' . base_url() . '/assets/images/icon/return_confirm.png" alt="Return Completed" style="height:14px; display:block; margin:0 auto;" title="Return Completed" class="tip"></a>';
                        } elseif ($propTaskMutation['mutationStatus'] == 'Move Completed') {
                            $status = 'Move Completed';
                            $status_img = '<a href="#"><img src="' . base_url() . '/assets/images/icon/moved.png" alt="Move Completed" style="height:14px; display:block; margin:0 auto;" title="Move Completed" class="tip"></a>';
                        }
                    }

                    // mutation only one data
                    $posts['data'][$key]['propTaskMutation'] = $value['propTaskMutation'][0];
                    $posts['data'][$key]['propTaskMutation']['taskMutationCode'] = $value['taskCode'] . '-' . $value['idTask'];
                    $posts['data'][$key]['propTaskMutation']['status'] = $status_img;
                    $posts['data'][$key]['propTaskMutation']['propAsset']['assetCode'] = $value['propTaskMutation'][0]['propAsset']['assetCode'];
                }
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

    public function differenceTimestamps($timestamps1, $timestamps2)
    {
        $datetime1 = new DateTime($timestamps1); //start time
        $datetime2 = new DateTime($timestamps2); //end time
        $interval = $datetime1->diff($datetime2);

        $get_years = $interval->format('%Y');
        $get_months = $interval->format('%m');
        $get_days = $interval->format('%d');
        $get_hours = $interval->format('%H');
        $get_minutes = $interval->format('%i');

        $years = $get_years != 00 ? $get_years . ' years' : '';
        $months = $get_months != 0 ? $get_months . ' months' : '';
        $days = $get_days != 0 ? $get_days . ' days' : '';
        $hours = $get_hours != 00 ? $get_hours . ' hours' : '';
        $minutes = $get_minutes != 0 ? $get_minutes . ' minutes' : '';

        return $interval->format("{$years} {$months} {$days} {$hours} {$minutes}"); //00 years 0 months 0 days 00 hours 0 minutes 0 seconds
    }
}

/* End of file Repair_datatable.php */
