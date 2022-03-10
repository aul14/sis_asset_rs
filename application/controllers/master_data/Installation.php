<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Installation extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->simple_login->cek_login(); // cek login
    $this->load->model('M_org', 'm_org');
  }

  public function index()
  {
    $result_role = $this->m_access_control->MyRole()['data']['roleACL'];

    $data['result_role'] = $result_role;
    $this->load->model('M_notifikasi', 'm_notifikasi');
    $data['notif'] = $this->m_notifikasi->list()['data'];

    $this->load->view('components/header');
    $this->load->view('components/sidebar', $data);
    $this->load->view('master_data/installation/form/installation_form');
    $this->load->view('master_data/installation/installation_index');
    $this->load->view('components/sidebar_footer');
    $this->load->view('components/footer');
    $this->load->view('master_data/master_data');
  }

  public function query()
  {
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }

    $q = $this->input->post('q') ? $this->input->post('q') : "";

    $query_groups = [];
    if ($q != "") {
      $query_groups = [
        [
          "queryMethod" => "LIKEAND",
          "queryParams" => [
            [
              "column" => "orgCode",
              "value" => $q
            ]
          ]
        ]
      ];
    }

    $request = [
      "queryGroupMethod" => "AND",
      "queryGroups" => $query_groups,
      "page" =>  1,
      "limit" =>  40
    ];

    $org = $this->m_org->orgQuery($request);

    echo json_encode($org['data']);
  }

  public function store()
  {
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }

    $post = $this->security->xss_clean($this->input->post());
    $org = [
      "orgCode" => strtoupper($post['orgCode']),
      "orgParent" => isset($post['orgParent']) ? $post['orgParent'] : '',
      "orgName" => $post['orgName'],
      "orgType" => $post['orgType'],
      "orgDesc" => $post['orgDesc']
    ];

    if ($post['formType'] == 'add') {
      $save = $this->m_org->orgInsert($org);
    } else {
      $save = $this->m_org->orgUpdate($org);
    }

    echo json_encode($save);
  }

  public function delete()
  {
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }

    $orgCode = [];

    if (!empty($this->input->post('orgCode'))) {
      $orgCode = $this->input->post('orgCode');
    }

    // $id_asset = $this->input->post('idAsset');
    foreach ($orgCode as $key => $id) {
      $org = $this->m_org->orgDelete($id);
    }

    echo json_encode($org);
    exit;
  }

  public function org_by_id()
  {
    $show = [];
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }

    $orgCode = [];

    if (!empty($this->input->post('orgCode'))) {
      $orgCode = $this->input->post('orgCode');
    }

    foreach ($orgCode as $key => $id) {
      $result = $this->m_org->orgById($id);
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

      $orgCode_query_params = [
        "column" => "orgCode",
        "value" => $array['search']
      ];
      array_push($query_params_like_or, $orgCode_query_params);

      $orgName_query_params = [
        "column" => "orgName",
        "value" => $array['search']
      ];
      array_push($query_params_like_or, $orgName_query_params);
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

    $count = $this->m_org->orgQuery(
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
          "column" => "orgCode",
          "value" => "desc"
        ]
      ],
      "page" =>  $page,
      "limit" =>  isset($length) ? (int)$length : 10
    ];

    $posts = $this->m_org->orgQuery($request);

    if (sizeof($posts) > 0) {
      $no = $start + 1;
      foreach ($posts['data'] as $key => $value) {
        $orgCode = $value['orgCode'];

        $posts['data'][$key]['check_box_cuk'] = "<input type='checkbox' id='delcheck_{$orgCode}'  name='msg[]' class='delete_check' value='{$orgCode}' />";

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
