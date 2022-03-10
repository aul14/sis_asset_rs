<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master_simak extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->simple_login->cek_login(); // cek login
    $this->load->model([
      'M_master_simak'    => 'm_master_simak'
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
    $this->load->view('master_data/master_simak/master_simak_index');
    $this->load->view('components/sidebar_footer');
    $this->load->view('components/footer');
    $this->load->view('master_data/master_data');
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

      $simakCode_query_params = [
        "column" => "simakCode",
        "value" => $array['search']
      ];
      array_push($query_params_like_or, $simakCode_query_params);

      $simakCode_query_params = [
        "column" => "simakUraian",
        "value" => $array['search']
      ];
      array_push($query_params_like_or, $simakCode_query_params);

      $simakCode_query_params = [
        "column" => "simakParent",
        "value" => $array['search']
      ];
      array_push($query_params_like_or, $simakCode_query_params);
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

    $count = $this->m_master_simak->simakQuery(
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
          "column" => "simakCode",
          "value" => "desc"
        ]
      ],
      "page" =>  $page,
      "limit" =>  isset($length) ? (int)$length : 10
    ];

    $posts = $this->m_master_simak->simakQuery($request);
    if (sizeof($posts) > 0) {
      $no = $start + 1;
      foreach ($posts['data'] as $key => $value) {
        $simakCode = $value['simakCode'];

        $posts['data'][$key]['check_box_cuk'] = "<input type='checkbox' id='delcheck_{$simakCode}'  name='msg[]' class='delete_check' value='{$simakCode}' />";

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

  public function query()
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
              "column" => "simakCode",
              "value" => $q
            ],
            [
              "column" => "simakUraian",
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

    $result = $this->m_master_simak->simakQuery($request);

    echo json_encode($result['data']);
    exit;
  }
}
