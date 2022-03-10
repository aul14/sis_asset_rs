<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mutation extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->simple_login->cek_login(); // cek login
        $this->load->model([
            'M_task_mutation'       => 'M_task_mutation',
            'M_task'                => 'm_task',
            'M_asset'               => 'm_asset',
            'M_file'                => 'm_file',
            'M_file_cat'            => 'm_file_cat',
            'M_task_complain'       => 'm_task_complain',
            'M_progress'            => 'm_progress',
            'M_task_files'          => 'm_task_files',
            'M_task_mutation'          => 'm_task_mutation',
            'M_progress_detail'     => 'm_progress_detail',
            'M_asset_propbuilding_room'     => 'm_asset_propbuilding_room',
            'M_otp'          => 'm_otp'
        ]);
    }


    public function index()
    {
        $result_role = $this->m_access_control->MyRole()['data']['roleACL'];

        $data['result_role'] = $result_role;
        $this->load->model('M_notifikasi', 'm_notifikasi');
        $data['notif'] = $this->m_notifikasi->list()['data'];

        if ($result_role[2]['subMenu1'][0]['subMenu2'][3]['isAllow'] != true) {
            exit('You dont have access!!');
        }

        // echo json_encode($this->session->userdata('token'));
        // die;

        $this->load->view('components/header');
        $this->load->view('components/sidebar', $data);
        $this->load->view('task/electromedic_task/form/mutation_form');
        $this->load->view('task/electromedic_task/approve/mutation_approve');
        $this->load->view('task/electromedic_task/return/mutation_return');
        $this->load->view('task/electromedic_task/confirm/mutation_confirm');
        $this->load->view('task/electromedic_task/mutation_med_index');
        $this->load->view('components/sidebar_footer');
        $this->load->view('components/footer');
        $this->load->view('task/task');
    }

    public function store()
    {
        $post = $this->security->xss_clean($this->input->post());

        $task = $this->m_task->data(
            isset($post['idTask']) ? $post['idTask'] : 0,
            $taskCode = 'MUT', //complain
            isset($post['idProgress']) ? $post['idProgress'] : 0,
            isset($post['idSchedule']) ? $post['idSchedule'] : 0,
            isset($post['idRelatedTask']) ? $post['idRelatedTask'] : 0,
            isset($post['taskType']) ? $post['taskType'] : '',
            isset($post['assetCode']) ? $post['assetCode'] : $post['assetCode'], //taskName
            isset($post['assetCode']) ? $post['assetCode'] : $post['assetCode'], //taskDesc
            isset($post['idVendor']) ? $post['idVendor'] : 0,
            isset($post['taskKpi']) ? $post['taskKpi'] : 0,
            isset($post['taskAmount']) ? $post['taskAmount'] : 0,
            "MED"
        );

        $progress = $this->m_progress->data(
            $post['idProgress'] ? $post['idProgress'] : 0,
            $progressStatus = 'NEW',
            $timeInit = date('Y-m-d H:i:s'),
            $timeRespon = '',
            $timeStart = '',
            $timeFinish = isset($post['finishBy']) ? date('Y-m-d H:i:s') : '',
            $timePending = isset($post['timePending']) ? $post['timePending'] . " " . date('H:i:s') : '',
            $timeApproved =  '',
            $timeDelegate = '',
            $timeAssign = isset($post['idAssignee']) ? date('Y-m-d H:i:s') : '',
            $idInitBy = $this->session->userdata('id_user'),
            $idResponBy = 0,
            $idStartBy = 0,
            $idFinishBy = isset($post['finishBy']) ? $this->session->userdata('id_user') : 0,
            $idPendingBy = isset($post['timePending']) ? $this->session->userdata('id_user') : 0,
            $idApproveBy =  0,
            $idAssignee = isset($post['idAssignee']) ? $post['idAssignee'] : 0,
            $idDelegator = 0,
            $initBy = $this->session->userdata('username'),
            $responBy = '',
            $startBy = '',
            $finishBy = isset($post['finishBy']) ? $post['finishBy'] : '',
            $pendingBy = isset($post['timePending']) ? $this->session->userdata('username') : '',
            $approveBy = '',
            $delegateBy = '',
            $assignTo = isset($post['assignTo']) ? $post['assignTo'] : ''
        );

        if ($post['mutationStatus'] == 'approve') {
            if ($post['mutationType'] == 'Permanent') {
                if ($post['requestApproval'] == 'NO') {
                    $mutationStatus = 'Not Approved';
                } elseif ($post['requestApproval'] == 'YES') {
                    $mutationStatus = 'Mutation Completed';
                }
            } elseif ($post['mutationType'] == 'Temporary') {
                if ($post['requestApproval'] == 'NO') {
                    $mutationStatus = 'Not Approved';
                } elseif ($post['requestApproval'] == 'YES') {
                    $mutationStatus = 'Borrowed';
                }
            }
        } elseif ($post['mutationStatus'] == 'back') {
            $mutationStatus = 'Returned';
        } elseif ($post['mutationStatus'] == 'confirm') {
            $mutationStatus = 'Return Completed';
        } else {
            $mutationStatus = 'Open';
        }

        $propTaskMutation = $this->m_task_mutation->data(
            $post['idTask'] ? $post['idTask'] : 0,
            $post['idAsset'] ? $post['idAsset'] : 0,
            $mutationStatus,
            "INTERNAL",
            $post['mutationType'] ? $post['mutationType'] : '',
            $post['mutationDesc'] ? $post['mutationDesc'] : '',
            isset($post['timePending']) ? $post['timePending'] . " " . date('H:i:s') : '',
            isset($post['srcRoomID']) ? $post['srcRoomID'] : '',
            isset($post['srcRoomName']) ? $post['srcRoomName'] : '',
            isset($post['srcHospName']) ? $post['srcHospName'] : '',
            isset($post['dstRoomID']) ? $post['dstRoomID'] : '',
            isset($post['dstRoomName']) ? $post['dstRoomName'] : '',
            isset($post['dstHospName']) ? $post['dstHospName'] : '',
            isset($post['mutationNote']) ? $post['mutationNote'] : ''
        );

        $idAsset = $post['idAsset'] ? $post['idAsset'] : 0;
        $asset = $this->m_asset->assetById($idAsset);

        $get_progress_detail = $this->m_progress_detail->byIdProgress($post['idProgress']);

        if (isset($post['approveNote']) && isset($post['confirmNote'])) {
            $pdetStatus = 'ASSIGN';
            $pdetDesc = $post['confirmNote'];
        } elseif (isset($post['confirmNote']) && !isset($post['confirmNote'])) {
            $pdetStatus = 'APPROVE';
            $pdetDesc = $post['approveNote'];
        } else {
            $pdetStatus = '';
            $pdetDesc = '';
        }

        $task['propTaskMutation'][] = $propTaskMutation;
        $task['propTaskMutation'][0]['propAsset'] = $asset['data'];
        $task['propProgress'] = $progress;
        $task['propSchedule'] = NULL;



        if ($pdetDesc && $pdetStatus) {
            $progress_detail = $this->m_progress_detail->data(
                $idProgresDet = 0,
                $post['idProgress'],
                $pdetStatus,
                $pdetDesc,
                date('Y-m-d H:i:s')
            );

            $propProgressDetail = array_merge($get_progress_detail['data'], $progress_detail);
            $task['propProgress']['propProgressDetail'][] = $propProgressDetail;
        }

        // echo json_encode($task);
        // die;

        if ($post['formType'] == 'add') {
            $task_insert = $this->m_task->taskInsert($task);
            if ($task_insert['queryResult'] == true) {
                $this->session->set_flashdata('sukses', "Success, data saved successfully");
            } else {
                $message = $task_insert['queryMessage'] ? $task_insert['queryMessage'] : 'Failed';
                $this->session->set_flashdata('error', $message);
            }
        } else {
            $task_update = $this->m_task->taskUpdate($task);
            // var_dump($asset_insert);
            // die;
            if ($task_update['queryResult'] == true) {
                $this->session->set_flashdata('sukses', "Success, data updated successfully");
            } else {
                $message = $task_update['queryMessage'] ? $task_update['queryMessage'] : 'Failed';
                $this->session->set_flashdata('error', $message);
            }
        }


        redirect('task/med/mutation', 'refresh');
    }

    public function store_return()
    {
        $post = $this->security->xss_clean($this->input->post());

        $idTaskReturn = $post['idTaskReturn'];
        $idAssetReturn = $post['idAssetReturn'];
        $dstRoomIDReturn = $post['dstRoomIDReturn'];

        if ($post['mutationStatusReturn'] == 'approve') {
            if ($post['mutationTypeReturn'] == 'Permanent') {
                if ($post['requestApproval'] == 'NO') {
                    $mutationStatus = 'Not Returnd';
                } elseif ($post['requestApproval'] == 'YES') {
                    $mutationStatus = 'Mutation Completed';
                }
            } elseif ($post['mutationTypeReturn'] == 'Temporary') {
                if ($post['requestApproval'] == 'NO') {
                    $mutationStatus = 'Not Returnd';
                } elseif ($post['requestApproval'] == 'YES') {
                    $mutationStatus = 'Borrowed';
                }
            }
        } elseif ($post['mutationStatusReturn'] == 'back') {
            $mutationStatus = 'Returned';
        } elseif ($post['mutationStatusReturn'] == 'confirm') {
            $mutationStatus = 'Return Completed';
        } else {
            $mutationStatus = 'Open';
        }

        $task = $this->m_task->taskById($idTaskReturn);

        $task['data']['propProgress']['idAssignee'] = $this->session->userdata('id_user');
        $task['data']['propProgress']['assignTo'] = $this->session->userdata('username');
        $task['data']['propProgress']['timeAssign'] = date('Y-m-d H:i:s');

        $task['data']['propTaskMutation'][0]['mutationStatus'] = $mutationStatus;

        $task_update = $this->m_task->taskUpdate($task['data']);

        if ($task_update['queryResult'] == true) {
            $this->session->set_flashdata('sukses', "Success, data updated successfully");
        } else {
            $message = $task_update['queryMessage'] ? $task_update['queryMessage'] : 'Failed';
            $this->session->set_flashdata('error', $message);
        }

        redirect('task/med/mutation', 'refresh');
    }

    public function store_confirm()
    {
        $post = $this->security->xss_clean($this->input->post());

        $idTaskConfirm = $post['idTaskConfirm'];
        $idAssetConfirm = $post['idAssetConfirm'];
        $dstRoomIDConfirm = $post['dstRoomIDConfirm'];
        $srcRoomIDConfirm = $post['srcRoomIDConfirm'];

        if ($post['mutationStatusConfirm'] == 'approve') {
            if ($post['mutationTypeConfirm'] == 'Permanent') {
                if ($post['requestApproval'] == 'NO') {
                    $mutationStatus = 'Not Confirmd';
                } elseif ($post['requestApproval'] == 'YES') {
                    $mutationStatus = 'Mutation Completed';
                }
            } elseif ($post['mutationTypeConfirm'] == 'Temporary') {
                if ($post['requestApproval'] == 'NO') {
                    $mutationStatus = 'Not Confirmd';
                } elseif ($post['requestApproval'] == 'YES') {
                    $mutationStatus = 'Borrowed';
                }
            }
        } elseif ($post['mutationStatusConfirm'] == 'back') {
            $mutationStatus = 'Returned';
        } elseif ($post['mutationStatusConfirm'] == 'confirm') {
            $mutationStatus = 'Return Completed';
        } else {
            $mutationStatus = 'Open';
        }

        $task = $this->m_task->taskById($idTaskConfirm);

        $task['data']['propProgress']['idFinishBy'] = $this->session->userdata('id_user');
        $task['data']['propProgress']['finishBy'] = $this->session->userdata('username');
        $task['data']['propProgress']['finishSign'] = $post['finishSign'];

        $task['data']['propProgress']['timeFinish'] = date('Y-m-d H:i:s');

        $task['data']['propTaskMutation'][0]['mutationStatus'] = $mutationStatus;

        $task_update = $this->m_task->taskUpdate($task['data']);

        $room = $this->m_asset_propbuilding_room->assetPropBuildingRoomById($srcRoomIDConfirm);
        $asset = $this->m_asset->assetById($idAssetConfirm);

        $asset['data']['propAssetPropadmin']['idBuilding'] = $room['data']['idBuilding'];
        $asset['data']['propAssetPropadmin']['idFloor'] = $room['data']['idFloor'];
        $asset['data']['propAssetPropadmin']['idRoom'] = $room['data']['idRoom'];

        $asset_update = $this->m_asset->assetUpdate($asset['data']);

        if ($task_update['queryResult'] == true) {
            $this->session->set_flashdata('sukses', "Success, data updated successfully");
        } else {
            $message = $task_update['queryMessage'] ? $task_update['queryMessage'] : 'Failed';
            $this->session->set_flashdata('error', $message);
        }

        redirect('task/med/mutation', 'refresh');
    }

    public function store_approve()
    {
        $post = $this->security->xss_clean($this->input->post());


        $idTaskApprove = $post['idTaskApprove'];
        $idAssetApprove = $post['idAssetApprove'];
        $dstRoomIDApprove = $post['dstRoomIDApprove'];

        if ($post['mutationStatusApprove'] == 'approve') {
            if ($post['mutationTypeApprove'] == 'Permanent') {
                if ($post['requestApproval'] == 'NO') {
                    $mutationStatus = 'Not Approved';
                } elseif ($post['requestApproval'] == 'YES') {
                    $mutationStatus = 'Mutation Completed';
                }
            } elseif ($post['mutationTypeApprove'] == 'Temporary') {
                if ($post['requestApproval'] == 'NO') {
                    $mutationStatus = 'Not Approved';
                } elseif ($post['requestApproval'] == 'YES') {
                    $mutationStatus = 'Borrowed';
                }
            }
        } elseif ($post['mutationStatusApprove'] == 'back') {
            $mutationStatus = 'Returned';
        } elseif ($post['mutationStatusApprove'] == 'confirm') {
            $mutationStatus = 'Return Completed';
        } else {
            $mutationStatus = 'Open';
        }

        $task = $this->m_task->taskById($idTaskApprove);

        if ($post['requestApproval'] == 'NO') {
            $task['data']['propProgress']['idRejectBy'] = $this->session->userdata('id_user');
            $task['data']['propProgress']['rejectBy'] = $this->session->userdata('username');
            $task['data']['propProgress']['timeReject'] = date('Y-m-d H:i:s');
        } else {
            $task['data']['propProgress']['idApproveBy'] = $this->session->userdata('id_user');
            $task['data']['propProgress']['approveBy'] = $this->session->userdata('username');
            $task['data']['propProgress']['timeApproved'] = date('Y-m-d H:i:s');
        }

        $task['data']['propTaskMutation'][0]['mutationStatus'] = $mutationStatus;
        $task['data']['propTaskMutation'][0]['mutationNote'] = $post['approveNote'];

        // echo json_encode($task['data']);
        // die;

        $task_update = $this->m_task->taskUpdate($task['data']);

        if ($post['requestApproval'] == 'YES') {
            $room = $this->m_asset_propbuilding_room->assetPropBuildingRoomById($dstRoomIDApprove);
            $asset = $this->m_asset->assetById($idAssetApprove);

            $asset['data']['propAssetPropadmin']['idBuilding'] = $room['data']['idBuilding'];
            $asset['data']['propAssetPropadmin']['idFloor'] = $room['data']['idFloor'];
            $asset['data']['propAssetPropadmin']['idRoom'] = $room['data']['idRoom'];

            $asset_update = $this->m_asset->assetUpdate($asset['data']);
            // echo json_encode($asset_update);
            // die;
        }

        if ($task_update['queryResult'] == true) {
            $this->session->set_flashdata('sukses', "Success, data updated successfully");
        } else {
            $message = $task_update['queryMessage'] ? $task_update['queryMessage'] : 'Failed';
            $this->session->set_flashdata('error', $message);
        }

        redirect('task/med/mutation', 'refresh');
    }

    public function task_by_id()
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

        $show['data_update'] = $result['data'];

        echo json_encode($show);
        exit;
    }
}
