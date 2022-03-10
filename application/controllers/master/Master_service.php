<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Master_service extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->simple_login->cek_login(); // cek login
        $this->load->model([
            'M_master_service'      => 'm_master_service'
        ]);
    }

    public function index()
    {
    }

    public function master_service_query()
    {
        $q = trim($this->input->post('q'));

        $query_groups = [];

        if (!empty($q)) {
            $query_groups = [
                [
                    "queryMethod" => "LIKEOR",
                    "queryParams" => [
                        [
                            "column" => "insName",
                            "value" => $q
                        ],
                    ]
                ]
            ];
        }

        $data_request = [
            "queryGroupMethod" => "AND",
            "queryGroups" => $query_groups,
            "limit" =>  15
        ];

        $result = $this->m_master_service->masterServiceQuery($data_request);
        echo json_encode($result['data']);
        exit;
    }
}

/* End of file Master_service.php */
