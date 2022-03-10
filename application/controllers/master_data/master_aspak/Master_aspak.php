<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master_aspak extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->simple_login->cek_login(); // cek login
    $this->load->model([
      'M_master_aspak'      => 'm_master_aspak'
    ]);
  }


  public function index()
  {
    $result_role = $this->m_access_control->MyRole()['data']['roleACL'];

    $data['result_role'] = $result_role;
    $this->load->model('M_notifikasi', 'm_notifikasi');
    $data['notif'] = $this->m_notifikasi->list()['data'];

    $this->load->view('components/header');
    $this->load->view('components/sidebar', $data);
    // $this->load->view('master_data/brand/form/brand_form');
    $this->load->view('master_data/master_aspak/master_aspak_index');
    $this->load->view('components/sidebar_footer');
    $this->load->view('components/footer');
    $this->load->view('master_data/master_data');
  }

  public function aspak_item_query()
  {
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }

    $q = trim($this->input->post('q'));
    $query_groups = [];
    if (isset($q)) {
      $query_groups = [
        [
          "queryMethod" => "LIKEOR",
          "queryParams" => [
            [
              "column" => "aspakItemCode",
              "value" => $q
            ],
            [
              "column" => "aspakItemName",
              "value" => $q
            ]
          ]
        ]
      ];
    }

    $request = [
      "queryGroupMethod" => "AND",
      "queryGroups" => $query_groups,
      "limit" =>  20
    ];

    $result = $this->m_master_aspak->aspakItemQuery($request);

    echo json_encode($result['data']);
    exit;
  }

  public function data_table()
  {
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }

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

      $aspakCode_query_params = [
        "column" => "aspakRoom",
        "value" => $array['search']
      ];
      array_push($query_params_like_or, $aspakCode_query_params);

      $aspakCode_query_params = [
        "column" => "aspakName",
        "value" => $array['search']
      ];
      array_push($query_params_like_or, $aspakCode_query_params);

      $aspakCode_query_params = [
        "column" => "aspakCode",
        "value" => $array['search']
      ];
      array_push($query_params_like_or, $aspakCode_query_params);
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

    $count = $this->m_master_aspak->aspakQuery(
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
          "column" => "aspakCode",
          "value" => "desc"
        ]
      ],
      "page" =>  $page,
      "limit" =>  isset($length) ? (int)$length : 10
    ];

    $posts = $this->m_master_aspak->aspakQuery($request);

    if (sizeof($posts) > 0) {
      $no = $start + 1;
      foreach ($posts['data'] as $key => $value) {
        $idAspak = $value['idAspak'];

        $posts['data'][$key]['check_box_cuk'] = "<input type='checkbox' id='delcheck_{$idAspak}'  name='msg[]' class='delete_check' value='{$idAspak}' />";

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
