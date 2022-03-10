<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inventory_category extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->simple_login->cek_login(); // cek login
    $this->load->model([
      'M_asset'                       => 'm_asset',
      'M_asset_category'     => 'm_asset_category',
      'M_asset_prop'     => 'm_asset_prop',
    ]);
  }


  public function index()
  {
    $asset_prop = $this->m_asset_prop->assetPropList();

    $data['asset_prop'] = $asset_prop['data'];

    $result_role = $this->m_access_control->MyRole()['data']['roleACL'];

    $data['result_role'] = $result_role;
    $this->load->model('M_notifikasi', 'm_notifikasi');
    $data['notif'] = $this->m_notifikasi->list()['data'];

    $this->load->view('components/header');
    $this->load->view('components/sidebar', $data);
    $this->load->view('master_data/inventory_category/form/inventorycategory_form', $data);
    $this->load->view('master_data/inventory_category/inventory_category_index');
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

    $assetCategory = [
      "catCode" => strtoupper($post['catCode']),
      "sysCatName" => $post['sysCatName'],
      "subSysCat" => $post['subSysCat'],
      "assetCatName" => $post['assetCatName'],
      "assetCatDesc" => $post['assetCatDesc'],
      "catHasParent" => $post['catHasParent'],
    ];

    $asset_cat_prop = [];

    if (!empty($post['propZAssetCatprop_idAssetProp'])) {
      foreach ($this->input->post('propZAssetCatprop_idAssetProp') as $key => $propZAssetCatprop_idAssetProp) {
        $asset_cat_prop[] = [
          "idAssetProp"   => $propZAssetCatprop_idAssetProp
        ];
      }
    }

    $assetCategory['propZAssetCatprop']   = $asset_cat_prop;

    // echo "<pre>";
    // var_dump($assetCategory);
    // die;
    // echo "</pre>";

    if ($post['formType'] == 'add') {
      $save = $this->m_asset_category->assetCatInsert($assetCategory);
    } else {
      $save = $this->m_asset_category->assetCatUpdate($assetCategory);
    }

    echo json_encode($save);
    exit;
  }

  public function delete()
  {
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }

    $catCode = [];

    if (!empty($this->input->post('catCode'))) {
      $catCode = $this->input->post('catCode');
    }

    // $id_asset = $this->input->post('idAsset');
    foreach ($catCode as $key => $id) {
      $asset_category = $this->m_asset_category->assetCatDelete($id);
    }

    echo json_encode($asset_category);
    exit;
  }

  public function category_by_id()
  {
    $show = [];
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }

    $catCode = [];

    if (!empty($this->input->post('catCode'))) {
      $catCode = $this->input->post('catCode');
    }

    foreach ($catCode as $key => $id) {
      $result = $this->m_asset_category->ById($id);
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

      $brandName_query_params = [
        "column" => "catCode",
        "value" => $array['search']
      ];
      array_push($query_params_like_or, $brandName_query_params);

      $brandName_query_params = [
        "column" => "assetCatName",
        "value" => $array['search']
      ];
      array_push($query_params_like_or, $brandName_query_params);

      $brandName_query_params = [
        "column" => "sysCatName",
        "value" => $array['search']
      ];
      array_push($query_params_like_or, $brandName_query_params);
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

    $count = $this->m_asset_category->assetCatQuery(
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
          "column" => "catCode",
          "value" => "asc"
        ]
      ],
      "page" =>  $page,
      "limit" =>  isset($length) ? (int)$length : 10
    ];

    $posts = $this->m_asset_category->assetCatQuery($request);

    if (sizeof($posts) > 0) {
      $no = $start + 1;
      foreach ($posts['data'] as $key => $value) {
        $catCode = $value['catCode'];

        $posts['data'][$key]['check_box_cuk'] = "<input type='checkbox' id='delcheck_{$catCode}'  name='msg[]' class='delete_check' value='{$catCode}' />";

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
