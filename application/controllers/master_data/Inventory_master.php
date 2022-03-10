<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inventory_master extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->simple_login->cek_login(); // cek login
    $this->load->model([
      'M_asset'               => 'm_asset',
      'M_asset_category'      => 'm_asset_category',
      'M_asset_master'        => 'm_asset_master',
      'M_file'                => 'm_file',
      'M_file_cat'             => 'm_file_cat',
      'M_form_template'       => 'm_form_template'
    ]);
  }


  public function index()
  {
    $assetcat = $this->m_asset_category->assetCatList();
    $data['assetcat'] = $assetcat['data'];

    $result_role = $this->m_access_control->MyRole()['data']['roleACL'];

    $data['result_role'] = $result_role;
    $this->load->model('M_notifikasi', 'm_notifikasi');
    $data['notif'] = $this->m_notifikasi->list()['data'];

    if ($result_role[4]['subMenu1'][4]['isAllow'] != true) {
      exit('You dont have access!!');
    }

    $this->load->view('components/header');
    $this->load->view('components/sidebar', $data);
    $this->load->view('master_data/inventory_master/form/inventorymaster_form', $data);
    $this->load->view('master_data/inventory_master/inventory_master_index');
    $this->load->view('components/sidebar_footer');
    $this->load->view('components/footer');
    $this->load->view('master_data/master_data');
  }

  public function save_id_asset_master_selected()
  {
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }

    $idAssetMastersSession =  $this->session->userdata('idAssetMasterSelected');
    $idAssetMasters =  $this->input->post('idAssetMasters');

    $idAssetMastersSession = array_merge($idAssetMastersSession, $idAssetMasters);

    $uniqueIdAssetMastersSession = array_unique($idAssetMastersSession);

    $result['idAssetMasterSelected'] = $uniqueIdAssetMastersSession;

    $this->session->set_userdata($result);
    echo json_encode($idAssetMasters);
    exit;
  }

  public function delete_id_asset_master_selected()
  {
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }

    $idAssetMaster = empty($this->input->post('idAssetMaster')) ? 0 : $this->input->post('idAssetMaster');

    // echo json_encode($idAssetMaster); die();

    $idAssetMastersSession = empty($this->session->userdata('idAssetMasterSelected')) ? [] : $this->session->userdata('idAssetMasterSelected');

    $newIdAssetMastersSession = [];
    foreach ($idAssetMastersSession as $k => $v) {
      if ($v != $idAssetMaster) {
        $newIdAssetMastersSession[] = $v;
      }
    }

    $this->session->unset_userdata('idAssetMasterSelected');

    $result['idAssetMasterSelected'] = $newIdAssetMastersSession;

    $this->session->set_userdata($result);

    echo json_encode($idAssetMastersSession);
    exit;
  }

  public function set_id_asset_master_for_form_edit()
  {
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }

    $idFormTemplate = $this->input->post('idFormTemplate');
    $formTemplate = $this->m_form_template->formTemplateById($idFormTemplate);

    $propZMasterForm = [];
    if (isset($formTemplate['data']['propZMasterForm'])) {
      foreach ($formTemplate['data']['propZMasterForm'] as $val) {
        $propZMasterForm[] = $val['idAssetMaster'];
      }
    }

    $uniqueIdAssetMasters = array_unique($propZMasterForm);

    $result['idAssetMasterSelected'] = $uniqueIdAssetMasters;
    $this->session->set_userdata($result);

    echo json_encode($result);
    exit;
  }

  public function show_id_asset_master_selected()
  {
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }

    $idAssetMasters = $this->session->userdata('idAssetMasterSelected');

    $uniqueIdAssetMasters = array_unique($idAssetMasters);

    // $result['idAssetMasterSelected'] = $uniqueIdAssetMasters;
    // $this->session->set_userdata($result);

    $assetMasters = [];
    // if (count($idAssetMasters) > 0) {

    foreach ($uniqueIdAssetMasters as $idAssetMaster) {
      $getAssetMaster = $this->m_asset_master->assetMasterByIDLite($idAssetMaster);

      $assetMasters[] = $getAssetMaster['data'];
    }
    // }

    echo json_encode($assetMasters);
    exit;
  }

  public function data_table()
  {
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }

    $idAssetMasters = empty($this->input->post('idAssetMasters')) ? [] : $this->input->post('idAssetMasters');

    $idAssetMaster = $this->input->post('idAssetMaster');
    $draw   = $this->input->post('draw');
    $start  = $this->input->post('start');
    $length = $this->input->post('length') ? $this->input->post('length') : 1;


    $idAssetMasterSelected = empty($this->session->userdata('idAssetMasterSelected')) ? [] : $this->session->userdata('idAssetMasterSelected');
    $idAssetMasters = array_merge($idAssetMasters, $idAssetMasterSelected);

    $search = str_replace("'", "", strtolower($this->input->post('search')['value']));
    $searchTerms = explode(" ",  $search);
    $orderColumn = !empty($this->input->post('order')[0]['column']) ? $this->input->post('order')[0]['column'] : '';
    $dir = !empty($this->input->post('order')[0]['dir']) ? $this->input->post('order')[0]['dir'] : '';

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

      $ecriCode_query_params = [
        "column" => "ecriCode",
        "value" => $array['search']
      ];
      array_push($query_params_like_or, $ecriCode_query_params);

      $simakCode_query_params = [
        "column" => "simakCode",
        "value" => $array['search']
      ];
      array_push($query_params_like_or, $simakCode_query_params);

      $aspakCode_query_params = [
        "column" => "aspakCode",
        "value" => $array['search']
      ];
      array_push($query_params_like_or, $aspakCode_query_params);
      $catCode_query_params = [
        "column" => "catCode",
        "value" => $array['search']
      ];
      array_push($query_params_like_or, $catCode_query_params);
      $assetMasterName_query_params = [
        "column" => "assetMasterName",
        "value" => $array['search']
      ];
      array_push($query_params_like_or, $assetMasterName_query_params);
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

    $count = $this->m_asset_master->assetMasterQuery(
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
          "column" => "idAssetMaster",
          "value" => "desc"
        ]
      ],
      "page" =>  $page,
      "limit" =>  !empty($length) ? (int)$length : 10
    ];

    $posts = $this->m_asset_master->assetMasterQuery($request);

    if (sizeof($posts) > 0) {
      $no = $start + 1;
      foreach ($posts['data'] as $key => $value) {
        $valIdAssetMaster = $value['idAssetMaster'];

        if ($idAssetMaster == $valIdAssetMaster) {
          $checked = 'checked';
        } else {
          $checked = '';
        }

        $check_box_checked = '';
        if (count($idAssetMasters) > 0) {
          if (in_array($valIdAssetMaster, $idAssetMasters)) {
            $check_box_checked = 'checked';
          }
        }

        $posts['data'][$key]['check_box_cuk'] = "<input {$check_box_checked} type='checkbox' id='delcheck_{$valIdAssetMaster}'  name='msg[]' class='delete_check' value='{$valIdAssetMaster}' />";
        $posts['data'][$key]['radioButton'] = "<input {$checked} type='radio' class='radioButtonAsset' id='radio{$no}' name='radio' value='{$valIdAssetMaster}'>";

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
      "search"          => !empty($array['search']) ?  $array['search'] : '',
      "query_groups"    => $request,
      "query_message"   => $posts['queryMessage'],
    ];

    echo json_encode($json_data);
  }

  public function data_table_2()
  {
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }

    $idAssetMasters = empty($this->input->post('idAssetMasters')) ? [] : $this->input->post('idAssetMasters');

    $idAssetMaster = $this->input->post('idAssetMaster');
    $draw   = $this->input->post('draw');
    $start  = $this->input->post('start');
    $length = $this->input->post('length') ? $this->input->post('length') : 1;


    $idAssetMasterSelected = empty($this->session->userdata('idAssetMasterSelected')) ? [] : $this->session->userdata('idAssetMasterSelected');
    $idAssetMasters = array_merge($idAssetMasters, $idAssetMasterSelected);

    $search = str_replace("'", "", strtolower($this->input->post('search')['value']));
    $searchTerms = explode(" ",  $search);
    $orderColumn = !empty($this->input->post('order')[0]['column']) ? $this->input->post('order')[0]['column'] : '';
    $dir = !empty($this->input->post('order')[0]['dir']) ? $this->input->post('order')[0]['dir'] : '';

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

      $ecriCode_query_params = [
        "column" => "ecriCode",
        "value" => $array['search']
      ];
      array_push($query_params_like_or, $ecriCode_query_params);

      $simakCode_query_params = [
        "column" => "simakCode",
        "value" => $array['search']
      ];
      array_push($query_params_like_or, $simakCode_query_params);

      $aspakCode_query_params = [
        "column" => "aspakCode",
        "value" => $array['search']
      ];
      array_push($query_params_like_or, $aspakCode_query_params);
      $catCode_query_params = [
        "column" => "catCode",
        "value" => $array['search']
      ];
      array_push($query_params_like_or, $catCode_query_params);
      $assetMasterName_query_params = [
        "column" => "assetMasterName",
        "value" => $array['search']
      ];
      array_push($query_params_like_or, $assetMasterName_query_params);
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

    $count = $this->m_asset_master->assetMasterQuery(
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
          "column" => "idAssetMaster",
          "value" => "desc"
        ]
      ],
      "page" =>  $page,
      "limit" =>  !empty($length) ? (int)$length : 10
    ];

    $posts = $this->m_asset_master->assetMasterQuery($request);

    if (sizeof($posts) > 0) {
      $no = $start + 1;
      foreach ($posts['data'] as $key => $value) {
        $valIdAssetMaster = $value['idAssetMaster'];

        if ($idAssetMaster == $valIdAssetMaster) {
          $checked = 'checked';
        } else {
          $checked = '';
        }

        $check_box_checked = '';
        if (count($idAssetMasters) > 0) {
          if (in_array($valIdAssetMaster, $idAssetMasters)) {
            $check_box_checked = 'checked';
          }
        }

        $posts['data'][$key]['check_box_cuk'] = "<input {$check_box_checked} type='checkbox' id='delcheck_{$valIdAssetMaster}'  name='msg[]' class='checkboxes' value='{$valIdAssetMaster}' />";
        $posts['data'][$key]['radioButton'] = "<input {$checked} type='radio' class='radioButtonAsset' id='radio{$no}' name='radio' value='{$valIdAssetMaster}'>";

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
      "search"          => !empty($array['search']) ?  $array['search'] : '',
      "query_groups"    => $request,
      "query_message"   => $posts['queryMessage'],
    ];

    echo json_encode($json_data);
  }

  public function store()
  {
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }

    $post = $this->security->xss_clean($this->input->post());

    $assetMaster = [
      "idAssetMaster" => !empty($post['idAssetMaster']) ? (int)$post['idAssetMaster'] : 0,
      "ecriCode" => $post['ecriCode'],
      "simakCode" => $post['simakCode'],
      "aspakCode" => $post['aspakCode'],
      "catCode" => $post['catCode'],
      "assetMasterName" => $post['assetMasterName'],
      "riskLevel" => $post['riskLevel'],
      "calibMust" => $post['calibMust'] == 1 ? true : false,
      "lifeTime" => !empty($post['lifeTime']) ? (int)$post['lifeTime'] : 0,
      "scoreMaintenance" => !empty($post['scoreMaintenance']) ? (int)$post['scoreMaintenance'] : 0,
      "scoreInspection" => !empty($post['scoreInspection']) ? (int)$post['scoreInspection'] : 0,
      "scoreRepair" => !empty($post['scoreRepair']) ? (int)$post['scoreRepair'] : 0,
      "createDate" => date('Y-m-d H:i:s')
    ];

    if ($post['catCode']) {
      $assetCat = $this->m_asset_category->ByCatCode($post['catCode']);
      $assetMaster['propAssetCat'] = $assetCat['data'];
    }


    if (empty($post['idAssetMaster'])) {
      $save = $this->m_asset_master->assetMasterInsert($assetMaster);
    } else {
      $save = $this->m_asset_master->assetMasterUpdate($assetMaster);
    }

    echo json_encode($save);
    exit;
  }

  public function master_by_id()
  {
    $show = [];
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }

    $idAssetMaster = [];

    if (!empty($this->input->post('idAssetMaster'))) {
      $idAssetMaster = $this->input->post('idAssetMaster');
    }

    foreach ($idAssetMaster as $key => $id) {
      $result = $this->m_asset_master->assetMasterByID($id);
    }
    $show['data_update'] = $result['data'];

    echo json_encode($show);
    exit;
  }

  public function delete()
  {
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }

    $idAssetMaster = [];

    if (!empty($this->input->post('idAssetMaster'))) {
      $idAssetMaster = $this->input->post('idAssetMaster');
    }

    // $id_asset = $this->input->post('idAsset');
    foreach ($idAssetMaster as $key => $id) {
      $asset_master = $this->m_asset_master->assetMasterDelete($id);
    }

    echo json_encode($asset_master);
    exit;
  }
}
