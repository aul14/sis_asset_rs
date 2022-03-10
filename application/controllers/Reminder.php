<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Reminder extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->simple_login->cek_login(); // cek login
        $this->load->model('m_reminder');
        $this->load->model('m_task');
    }

    public function get_reminder()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $date_mulai = trim($this->input->post('date_mulai'));
        $date_akhir = trim($this->input->post('date_akhir'));
        $data_syscat = trim($this->input->post('data_syscat'));
        $data_code = trim($this->input->post('data_code'));
        $data_status = trim($this->input->post('data_status'));

        $query_groups = [
            [
                "queryMethod" => "EXACTOR",
                "queryParams" => [
                    [
                        "column" => "progressStatus",
                        "value" => "$data_status"
                    ]
                ]
            ],
            [
                "queryMethod" => "EXACTAND",
                "queryParams" => [
                    [
                        "column" => "taskSysCat",
                        "value" => "$data_syscat"
                    ],
                    [
                        "column" => "taskCode",
                        "value" => "$data_code"
                    ]
                ]
            ],
            [
                "queryMethod" => "BETWEEN",
                "queryParams" => [
                    [
                        "column" => "scheduleStart",
                        "value" => "$date_mulai"
                    ],
                    [
                        "column" => "scheduleStart",
                        "value" => "$date_akhir"
                    ]
                ]
            ]
        ];

        $data_request = [
            "withDetails" => true,
            "subDetails" => true,
            "queryGroupMethod" => "AND",
            "queryGroups" => $query_groups
        ];

        $request = $this->m_task->taskQuery($data_request)['data'];

        echo json_encode($request);
        die;
    }
}

/* End of file Reminder.php */
