<?php
defined('BASEPATH') or exit('No direct script access allowed');

class File_category extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->simple_login->cek_login(); // cek login
    $this->load->model('M_file_cat', 'm_file_cat');
  }


  public function index()
  {
    $result_role = $this->m_access_control->MyRole()['data']['roleACL'];

    $data['result_role'] = $result_role;
    $this->load->model('M_notifikasi', 'm_notifikasi');
    $data['notif'] = $this->m_notifikasi->list()['data'];

    $this->load->view('components/header');
    $this->load->view('components/sidebar', $data);
    $this->load->view('master_data/file_category/form/filecategory_form');
    $this->load->view('master_data/file_category/file_category_index');
    $this->load->view('master_data/master_data');
    $this->load->view('components/footer');
    $this->load->view('components/sidebar_footer');
  }

  public function store()
  {
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }

    $post = $this->security->xss_clean($this->input->post());

    $brand = [
      "idFileCat" => isset($post['idFileCat']) ? (int)$post['idFileCat'] : 0,
      "fileCatName" => $post['fileCatName'],
      "fileCatDesc" => $post['fileCatDesc'],
      "fileCatType" => $post['fileCatType'],
    ];

    if ($post['formType'] == 'add') {
      $save = $this->m_file_cat->fileCatInsert($brand);
    } else {
      $save = $this->m_file_cat->fileCatUpdate($brand);
    }

    echo json_encode($save);
  }

  public function delete()
  {
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }

    $idFileCat = [];

    if (!empty($this->input->post('idFileCat'))) {
      $idFileCat = $this->input->post('idFileCat');
    }

    // $id_asset = $this->input->post('idAsset');
    foreach ($idFileCat as $key => $id) {
      $file_cat = $this->m_file_cat->fileCatDelete($id);
    }

    echo json_encode($file_cat);
    exit;
  }

  public function filecat_by_id()
  {
    $show = [];
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }

    $idFileCat = [];

    if (!empty($this->input->post('idFileCat'))) {
      $idFileCat = $this->input->post('idFileCat');
    }

    foreach ($idFileCat as $key => $id) {
      $result = $this->m_file_cat->fileCatById($id);
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

      $fileCatName_query_params = [
        "column" => "fileCatName",
        "value" => $array['search']
      ];
      array_push($query_params_like_or, $fileCatName_query_params);
      $fileCatName_query_params = [
        "column" => "fileCatDesc",
        "value" => $array['search']
      ];
      array_push($query_params_like_or, $fileCatName_query_params);
      $fileCatName_query_params = [
        "column" => "fileCatType",
        "value" => $array['search']
      ];
      array_push($query_params_like_or, $fileCatName_query_params);
    }

    $query_groups_like_or = [];
    $query_groups = [];

    if ($array['search'] != '') {
      $query_groups_like_or = [
        [
          "queryMethod" => "LIKEOR",
          "queryParams" => $query_params_like_or
        ]
      ];
    }

    $merge_query_groups = array_merge($query_groups, $query_groups_like_or);

    $count = $this->m_file_cat->fileCatQuery(
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
          "column" => "fileCatName",
          "value" => "desc"
        ]
      ],
      "page" =>  $page,
      "limit" =>  isset($length) ? (int)$length : 10
    ];

    $posts = $this->m_file_cat->fileCatQuery($request);
    if (sizeof($posts) > 0) {
      $no = $start + 1;
      foreach ($posts['data'] as $key => $value) {
        $idFileCat = $value['idFileCat'];

        $posts['data'][$key]['check_box_cuk'] = "<input type='checkbox' id='delcheck_{$idFileCat}'  name='msg[]' class='delete_check' value='{$idFileCat}' />";

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
