<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Funding_category extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->simple_login->cek_login(); // cek login
    $this->load->model('M_funding', 'm_funding');
  }

  public function index()
  {
    $result_role = $this->m_access_control->MyRole()['data']['roleACL'];

    $data['result_role'] = $result_role;
    $this->load->model('M_notifikasi', 'm_notifikasi');
    $data['notif'] = $this->m_notifikasi->list()['data'];

    $this->load->view('components/header');
    $this->load->view('components/sidebar', $data);
    $this->load->view('master_data/funding_category/form/fundingcategory_form');
    $this->load->view('master_data/funding_category/funding_category_index');
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
    $fund = [
      "idFund" => isset($post['idFund']) ? (int)$post['idFund'] : 0,
      "fundName" => $post['fundName'],
      "fundDesc" => $post['fundDesc'],
    ];

    if ($post['formType'] == 'add') {
      $save = $this->m_funding->fundingInsert($fund);
    } else {
      $save = $this->m_funding->fundingUpdate($fund);
    }

    echo json_encode($save);
    exit;
  }

  public function delete()
  {
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }

    $idFund = [];

    if (!empty($this->input->post('idFund'))) {
      $idFund = $this->input->post('idFund');
    }

    // $id_asset = $this->input->post('idAsset');
    foreach ($idFund as $key => $id) {
      $funding = $this->m_funding->fundingDelete($id);
    }

    echo json_encode($funding);
    exit;
  }

  public function funding_by_id()
  {

    $show = [];
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }

    $idFund = [];

    if (!empty($this->input->post('idFund'))) {
      $idFund = $this->input->post('idFund');
    }

    foreach ($idFund as $key => $id) {
      $result = $this->m_funding->fundingById($id);
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

      $fundName_query_params = [
        "column" => "fundName",
        "value" => $array['search']
      ];
      array_push($query_params_like_or, $fundName_query_params);

      $fundName_query_params = [
        "column" => "fundDesc",
        "value" => $array['search']
      ];
      array_push($query_params_like_or, $fundName_query_params);
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

    $count = $this->m_funding->fundingQuery(
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
          "column" => "idFund",
          "value" => "desc"
        ]
      ],
      "page" =>  $page,
      "limit" =>  isset($length) ? (int)$length : 10
    ];

    $posts = $this->m_funding->fundingQuery($request);

    if (sizeof($posts) > 0) {
      $no = $start + 1;
      foreach ($posts['data'] as $key => $value) {
        $idFund = $value['idFund'];

        $posts['data'][$key]['check_box_cuk'] = "<input type='checkbox' id='delcheck_{$idFund}'  name='msg[]' class='delete_check' value='{$idFund}' />";

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
