<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Brand extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->simple_login->cek_login(); // cek login
        $this->load->model('M_brand', 'm_brand');
    }


    public function index()
    {
        $result_role = $this->m_access_control->MyRole()['data']['roleACL'];

        $data['result_role'] = $result_role;
        $this->load->model('M_notifikasi', 'm_notifikasi');
        $data['notif'] = $this->m_notifikasi->list()['data'];

        $this->load->view('components/header');
        $this->load->view('components/sidebar', $data);
        $this->load->view('master_data/brands/form/brand_form');
        $this->load->view('master_data/brands/brand_index');
        $this->load->view('components/sidebar_footer');
        $this->load->view('components/footer');
        $this->load->view('master_data/master_data');
    }

    public function store()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $post = $this->security->xss_clean($this->input->post());
        $brand = [
            "idBrand" => isset($post['idBrand']) ? (int)$post['idBrand'] : 0,
            "brandName" => $post['brandName'],
        ];

        if ($post['formType'] == 'add') {
            $save = $this->m_brand->brandInsert($brand);
        } else {
            $save = $this->m_brand->brandUpdate($brand);
        }

        echo json_encode($save);
    }

    public function delete()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $idBrand = [];

        if (!empty($this->input->post('idBrand'))) {
            $idBrand = $this->input->post('idBrand');
        }

        // $id_asset = $this->input->post('idAsset');
        foreach ($idBrand as $key => $id) {
            $brand = $this->m_brand->brandDelete($id);
        }

        echo json_encode($brand);
        exit;
    }

    public function brand_by_id()
    {
        $show = [];
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $idBrand = [];

        if (!empty($this->input->post('idBrand'))) {
            $idBrand = $this->input->post('idBrand');
        }

        foreach ($idBrand as $key => $id) {
            $result = $this->m_brand->brandById($id);
        }
        $show['data_update'] = $result['data'];

        echo json_encode($show);
        exit;
    }


    public function data_table()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $idBrand   = $this->input->post('idBrand');
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

        if ($array['search'] != '') {

            $brandName_query_params = [
                "column" => "brandName",
                "value" => $array['search']
            ];
            array_push($query_params_like_or, $brandName_query_params);
        }

        $query_groups_like_or = [];
        $query_groups = [];

        // if($contactType != '') {
        //     $query_groups = [
        //         [
        //             "queryMethod" => "EXACTAND",//"LIKEAND",
        //             "queryParams" => $query_params
        //         ]
        //     ];
        // }

        if ($array['search'] != '') {
            $query_groups_like_or = [
                [
                    "queryMethod" => "LIKEOR",
                    "queryParams" => $query_params_like_or
                ]
            ];
        }

        $merge_query_groups = array_merge($query_groups, $query_groups_like_or);

        $count = $this->m_brand->brandQuery(
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
            "queryGroups" => $merge_query_groups ? $merge_query_groups : [],
            "sortingParams" => [
                [
                    "column" => "idBrand",
                    "value" => "desc"
                ]
            ],
            "page" =>  $page,
            "limit" =>  isset($length) ? (int)$length : 10
        ];

        $posts = $this->m_brand->brandQuery($request);
        if (sizeof($posts) > 0) {
            $no = $start + 1;
            foreach ($posts['data'] as $key => $value) {
                $idBrand = $value['idBrand'];

                $posts['data'][$key]['check_box_cuk'] = "<input type='checkbox' id='delcheck_{$idBrand}'  name='msg[]' class='delete_check' value='{$idBrand}' />";

                $posts['data'][$key]['no'] = $no;

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
