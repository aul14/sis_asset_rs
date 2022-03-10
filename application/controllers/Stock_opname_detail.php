<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Stock_opname_detail extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->simple_login->cek_login(); // cek login
        $this->load->model([
            'M_task'                => 'm_task',
            'M_asset'               => 'm_asset',
            'M_task_stockopname_detail'               => 'm_task_stockopname_detail',
        ]);
    }

    private function get_asset($catCodes, $idRooms, $sysCatNames)
    {
        // sysCatName
        $sysCatName_query_params = [];
        if (sizeof($sysCatNames) > 0) {
            foreach ($sysCatNames as $sysCatName) {
                if ($sysCatName != 'ALL') {
                    $sysCatName_query_params[] = [
                        "column" => "sysCatName",
                        "value" => $sysCatName
                    ];
                } else {
                }
            }
        }

        $sysCatName_query_groups = [
            [
                "queryMethod" => "EXACTOR",
                "queryParams" => $sysCatName_query_params
            ]
        ];
        // end sysCatName

        // catcode
        $catCode_query_params = [];
        if (sizeof($catCodes) > 0) {
            foreach ($catCodes as $catCode) {
                if ($catCode != 'ALL') {
                    $catCode_query_params[] = [
                        "column" => "catCode",
                        "value" => $catCode
                    ];
                } else {
                }
            }
        }

        $catCode_query_groups = [
            [
                "queryMethod" => "EXACTOR",
                "queryParams" => $catCode_query_params
            ]
        ];
        // end catcode

        // idroom
        $idRoom_query_params = [];
        if (sizeof($idRooms) > 0) {
            foreach ($idRooms as $idRoom) {
                $idRoom_query_params[] = [
                    "column" => "idRoom",
                    "value" => $idRoom
                ];
            }
        }

        $idRoom_query_groups = [
            [
                "queryMethod" => "EXACTOR",
                "queryParams" => $idRoom_query_params
            ]
        ];
        // end idroom

        if (sizeof($catCode_query_params) > 0) {
            $query_groups = array_merge($catCode_query_groups, $idRoom_query_groups);
            $query_groups = array_merge($query_groups, $sysCatName_query_groups);
        } else {
            $query_groups = $idRoom_query_groups;
        }

        $request = [
            "queryGroupMethod" => "AND",
            "queryGroups" => $query_groups,
        ];

        $asset = $this->m_asset->assetQuery($request);

        return $asset;
    }

    public function store_to_session()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $assets = $this->get_asset(
            $this->input->post('catasset'),
            $this->input->post('lokasiasset'),
            $this->input->post('sysCatName')
        );

        $session = $this->session->userdata();

        if (isset($assets['data'])) {
            foreach ($assets['data'] as $asset) {
                array_push($session['taskStockopnameDetails'], $asset);
            }

            $this->session->unset_userdata('getAsset');
            $session['getAsset'] = $assets;
        }

        $this->session->set_userdata($session);

        // $data['msg'] = "Sukses";

        echo json_encode($session);
    }

    public function delete_from_session($idAsset = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $taskStockopnameDetails = [];
        if ($idAsset != NULL) {
            if (sizeof($_SESSION['taskStockopnameDetails']) > 0) {
                foreach ($_SESSION['taskStockopnameDetails'] as $key => $value) {
                    if ($value['idAsset'] != $idAsset) {
                        $taskStockopnameDetails[] = $value;
                    }
                }
            }
        }

        // remove session task stock opanme detail data
        $session = $this->session->userdata();
        $session['taskStockopnameDetails'] = $taskStockopnameDetails;

        $this->session->set_userdata($session);
        // end remove session task stock opanme detail data

        // redirect($_SERVER['HTTP_REFERER']);
        // $data['msg'] = "Sukses";
        echo json_encode($session);
    }

    public function data_table_from_session()
    {
        $session = $this->session->userdata();

        $taskStockopnameDetails = [];
        if (sizeof($session['taskStockopnameDetails']) > 0) {

            $uniqueTaskStockopnameDetails = array_map("unserialize", array_unique(array_map("serialize", $session['taskStockopnameDetails'])));

            foreach ($uniqueTaskStockopnameDetails as $key => $value) {
                $value['assetCode'] = $value['catCode'] . '-' . $value['idAsset'];

                $taskStockopnameDetails['data'][]['propAsset'] = $value;
            }
        } else {
            $taskStockopnameDetails['data'] = [];
        }

        echo json_encode($taskStockopnameDetails);
    }

    public function data_table_task_stockopname_detail($idTask)
    {
        $task = $this->m_task->taskById($idTask);

        $tasks = [
            'data' => $task['data']['propTaskStockopname'][0]['propTaskStockopnameDetail'],
        ];

        echo json_encode($tasks);
    }

    public function DeleteByIdTaskOpname($idTaskOpname)
    {
        $task_stockopname_detail = $this->m_task_stockopname_detail->DeleteByIdTaskOpname((int)$idTaskOpname);

        echo json_encode($task_stockopname_detail);
    }

    public function delete_task_stockopname_detail($idTaskOpname, $idAsset)
    {
        $task_stockopname_detail = $this->m_task_stockopname_detail->delete((int)$idTaskOpname, (int)$idAsset);

        echo json_encode($task_stockopname_detail);
    }

    public function bulk_insert($idTaskOpname)
    {
        $asset = $this->get_asset(
            $this->input->post('catasset'),
            $this->input->post('lokasiasset'),
            $this->input->post('sysCatName')
        );

        $taskStockopnameDetail = [];
        if (sizeof($asset['data']) > 0) {
            foreach ($asset['data'] as $asset) {

                $task_stockopname_detail_by_id = $this->m_task_stockopname_detail->by_id($idTaskOpname, $asset['idAsset']);

                // check duplicate asset
                if ($task_stockopname_detail_by_id['data']['idAsset'] != $asset['idAsset']) {
                    $task_stockopname_detail = $this->m_task_stockopname_detail->data(
                        $idTaskOpname,
                        $asset['idAsset'],
                        $isChecked = '',
                        $checkedByID = '',
                        $checkedByName = '',
                        $checkedTime = ''
                    );
                    $task_stockopname_detail['propAsset'] = $asset;

                    $taskStockopnameDetail[] = $task_stockopname_detail;
                }
            }
        }

        if (sizeof($taskStockopnameDetail) > 0) {
            $bulk_insert = $this->m_task_stockopname_detail->bulk_insert($taskStockopnameDetail);
        } else {
            $bulk_insert[] = [
                "data" => $taskStockopnameDetail,
                "queryMessage" => "Data sudah ada",
                "queryResult" => true
            ];
        }

        echo json_encode($bulk_insert[0], JSON_PRETTY_PRINT);
    }
}

/* End of file Stock_opname_detail.php */
