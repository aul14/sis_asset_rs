<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Progress extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->simple_login->cek_login(); // cek login
        $this->load->model('M_progress', 'm_progress');
    }

    public function update()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $post = $this->security->xss_clean($this->input->post());


        $idProgress = $post['idProgress'];
        $get_progress = $this->m_progress->progressById($idProgress);

        $get_progress['data']['timeApproved'] = date('Y-m-d H:i:s');
        $get_progress['data']['idApproveBy'] = $this->session->userdata('id_user');
        $get_progress['data']['approveBy'] = $this->session->userdata('username');

        $update = $this->m_progress->progressUpdate($get_progress['data']);

        $result['data'] = $update['queryResult'];

        $result['data_detail'] = $get_progress;

        echo json_encode($result);
        die;
    }

    public function bulk_update()
    {
        $status = $this->input->get('status');
        $idProgress = $this->input->get('idProgress');
        $idAssign = $this->input->get('idAssign');
        $technicianName = $this->input->get('technicianName');

        if ($status == 'null' || $status == '') {
            $message = [
                'message' => 'The status is required',
                'code' => '402'
            ];
            echo json_encode($message);
            die();
        }

        if (!is_array($idProgress)) {
            $message = [
                'message' => 'The idProgress must array',
                'code' => '402'
            ];

            echo json_decode($message);
            die();
        }

        if ($status == 'assign_only') {
            if ($idAssign == 'null' || $idAssign == '') {
                $message = [
                    'message' => 'The technician is required',
                    'code' => '402'
                ];
                echo json_encode($message);
                die();
            }

            if ($technicianName == 'null' || $technicianName == '') {
                $message = [
                    'message' => 'The technician name is required',
                    'code' => '402'
                ];
                echo json_encode($message);
                die();
            }
        }

        $get_progress = [];
        foreach ($idProgress as $id) {
            $get_progress[] = $this->m_progress->progressById((int)$id)['data'];
        }

        if ($status == 'approve') {
            foreach ($get_progress as $key => $value) {

                if ($value['timeFinish'] == '' || $value['idFinishBy'] == 0 || $value['finishBy'] == '') {
                    $message = [
                        'message' => 'Please finish the repair first',
                        'code' => 402
                    ];

                    echo json_encode($message);
                    die();
                } else {
                    $message = [
                        'message' => 'Success',
                        'code' => 200,
                        'data' => $get_progress,
                    ];

                    echo json_encode($message);
                    die();
                }
            }
        }

        if ($status == 'assignAndWork') {
            foreach ($get_progress as $key => $value) {

                if ($value['startBy'] != '' || $value['finishBy'] != '' || $value['approveBy'] != '' || $value['pendingBy'] != '') {
                    $message = [
                        'message' => 'Complain already start work',
                        'code' => 402
                    ];

                    echo json_encode($message);
                    die();
                } else {
                    $message = [
                        'message' => 'Success',
                        'code' => 200,
                        'data' => $get_progress,
                    ];

                    echo json_encode($message);
                    die();
                }
            }
        }

        // start work
        if ($status == 'start') {
            foreach ($get_progress as $key => $value) {
                if ($value['idAssignee'] == '') {
                    $message = [
                        'message' => 'You must assign technician',
                        'code' => 402
                    ];

                    echo json_encode($message);
                    die();
                }

                if ($value['startBy'] != '' || $value['finishBy'] != '' || $value['approveBy'] != '' || $value['pendingBy'] != '') {
                    $message = [
                        'message' => 'Complain already start work',
                        'code' => 402
                    ];

                    echo json_encode($message);
                    die();
                }

                $get_progress[$key]['idStartBy'] = $this->session->userdata('id_user');
                $get_progress[$key]['startBy'] = $this->session->userdata('username');
                $get_progress[$key]['timeStart'] =  date('Y-m-d H:i:s');
            }

            $update = $this->m_progress->progressBulkUpdate($get_progress);

            if ($update) {
                $message = [
                    'message' => 'Success',
                    'code' => 200,
                    'data' => $update,
                ];

                echo json_encode($message);
                die();
            }
        }

        // assign only
        if ($status == 'assign_only') {
            foreach ($get_progress as $key => $value) {

                if ($value['timeAssign'] != '') {
                    $message = [
                        'message' => 'Already assign',
                        'code' => 402
                    ];

                    echo json_encode($message);
                    die();
                }

                $get_progress[$key]['idResponBy'] = $value['idResponBy'] == '' ? $this->session->userdata('id_user') : $value['idResponBy'];
                $get_progress[$key]['responBy'] = $value['responBy'] == '' ? $this->session->userdata('username') : $value['responBy'];
                $get_progress[$key]['timeRespon'] = $value['timeRespon'] == '' ? date('Y-m-d H:i:s') : $value['timeRespon'];

                $get_progress[$key]['idAssignee'] = $idAssign;
                $get_progress[$key]['assignTo'] = $technicianName;
                $get_progress[$key]['timeAssign'] = date('Y-m-d H:i:s');

                $get_progress[$key]['idDelegator'] = $this->session->userdata('id_user');;
                $get_progress[$key]['delegateBy'] = $this->session->userdata('username');;
                $get_progress[$key]['timeDelegate'] = date('Y-m-d H:i:s');
            }

            $update = $this->m_progress->progressBulkUpdate($get_progress);

            if ($update) {
                $message = [
                    'message' => 'Success',
                    'code' => 200,
                    'data' => $update,
                ];

                echo json_encode($message);
                die();
            }
        }

        // response only
        if ($status == 'response') {
            foreach ($get_progress as $key => $value) {

                if ($value['timeRespon'] != '') {
                    $message = [
                        'message' => 'Already response',
                        'code' => 402
                    ];

                    echo json_encode($message);
                    die();
                }

                $get_progress[$key]['idResponBy'] = $this->session->userdata('id_user');
                $get_progress[$key]['responBy'] = $this->session->userdata('username');
                $get_progress[$key]['timeRespon'] = date('Y-m-d H:i:s');
            }

            $update = $this->m_progress->progressBulkUpdate($get_progress);

            if ($update) {
                $message = [
                    'message' => 'Success',
                    'code' => 200,
                    'data' => $update,
                ];

                echo json_encode($message);
                die();
            }
        }
    }
}

/* End of file Progress.php */
