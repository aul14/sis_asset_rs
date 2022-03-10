<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Asset_unit extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->simple_login->cek_login(); // cek login
        $this->load->model([
            'M_asset_unit'      => 'm_asset_unit'
        ]);
    }

    public function asset_unit_query()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $q = $this->input->get('q');

        $query_groups = [];
        if (isset($q)) {
            $query_groups = [
                [
                    "queryMethod" => "LIKEOR",
                    "queryParams" => [
                        [
                            "column" => "satuan",
                            "value" => $q
                        ],
                    ]
                ]
            ];
        }

        $request = [
            "queryGroupMethod" => "AND",
            "queryGroups" => $query_groups,
            "page" =>  1,
            "limit" =>  10
        ];

        $contact = $this->m_asset_unit->assetUnitQuery($request);

        echo json_encode($contact);
    }
}

/* End of file Asset_unit.php */
