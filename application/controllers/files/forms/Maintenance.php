<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Maintenance extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->simple_login->cek_login(); // cek login
    $this->load->model([
      'M_form_template'     => 'm_form_template',
      'M_form_type'         => 'm_form_type'
    ]);
  }


  public function index()
  {
    // var_dump($this->session->userdata('idAssetMasterSelected'));
    // die;
    $result_role = $this->m_access_control->MyRole()['data']['roleACL'];

    $data['result_role'] = $result_role;
    $this->load->model('M_notifikasi', 'm_notifikasi');
    $data['notif'] = $this->m_notifikasi->list()['data'];

    if ($result_role[3]['subMenu1'][0]['subMenu2'][1]['isAllow'] != true) {
      exit('You dont have access!!');
    }

    $this->load->view('components/header');
    $this->load->view('components/sidebar', $data);
    $this->load->view('files/forms/form/maintenance_form');
    $this->load->view('files/forms/form_maintenance_index');
    $this->load->view('components/sidebar_footer');
    $this->load->view('components/footer');
    $this->load->view('files/files');
  }

  public function data_table()
  {
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }

    $q1 = $this->input->post('q1');
    $v1 = $this->input->post('v1');
    $q2 = $this->input->post('q2');
    $v2 = $this->input->post('v2');
    $idFormType = $this->input->post('formTypeId');

    $draw   = $this->input->post('draw');
    $start  = $this->input->post('start');
    $length = $this->input->post('length');

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

      $ftCode_query_params = [
        "column" => "ftCode",
        "value" => $array['search']
      ];
      array_push($query_params_like_or, $ftCode_query_params);

      $ftName_query_params = [
        "column" => "ftName",
        "value" => $array['search']
      ];
      array_push($query_params_like_or, $ftName_query_params);

      // $cat_code_query_params = [
      //     "column" => "catCode",
      //     "value" => $array['search']
      // ];
      // array_push($query_params_like_or, $cat_code_query_params);
    }

    if ($idFormType != '') {
      $idFormType_query_params = [
        "column" => "idFormType",
        "value" => (int)$idFormType
      ];
      array_push($query_params, $idFormType_query_params);
    }

    $query_groups_like_or = [];
    $query_groups = [];
    if ($idFormType != '') {
      $query_groups = [
        [
          "queryMethod" => "LIKEAND",
          "queryParams" => $query_params
        ]
      ];
    }

    if ($array['search'] != '') {
      $query_groups_like_or = [
        [
          "queryMethod" => "LIKEOR",
          "queryParams" => $query_params_like_or
        ]
      ];
    }

    $merge_query_groups = array_merge($query_groups, $query_groups_like_or);

    $count = $this->m_form_template->formTemplateQuery(
      [
        "queryGroupMethod" => "AND",
        "queryGroups" => $query_params ? $merge_query_groups : [],
        'page' => 1,
        'limit' => 1
      ]
    );
    $totalFiltered = $count['dataCount'];

    $page = ($start / $length) + 1;

    $request = [
      "queryGroupMethod" => "AND",
      "queryGroups" => $query_params ? $merge_query_groups : [],
      "sortingParams" => [
        [
          "column" => "idFormTemplate",
          "value" => "desc"
        ]
      ],
      "page" =>  $page,
      "limit" =>  !empty($length) ? (int)$length : 10
    ];

    $posts = $this->m_form_template->formTemplateQuery($request);

    if (sizeof($posts) > 0) {
      $no = 1;
      foreach ($posts['data'] as $key => $value) {
        $idFormTemplate = $value['idFormTemplate'];

        $assetName = [];
        foreach ($value['propZMasterForm'] as $propZMasterForm) {
          $assetName[] = $propZMasterForm['propAssetMaster']['assetMasterName'];
        }

        $assetMasterName = !empty($assetName) ? implode(', ', $assetName) : '';
        $assetMasterNameSubstr = $assetMasterName;

        $posts['data'][$key]['check_box_cuk'] = "<input  type='checkbox' id='delcheck_{$idFormTemplate}'  name='msg[]' class='delete_check' value='{$idFormTemplate}' />";
        $posts['data'][$key]['assetMasterName'] = "<p data-original-title='{$assetMasterName}' data-toggle='tooltip' data-placement='bottom' title='' style='white-space:pre-wrap; word-wrap:break-word; text-align:justify'>{$assetMasterNameSubstr}</p>";
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
      "query_message"   => $posts['queryMessage']
    ];

    echo json_encode($json_data);
  }

  public function break_text($name)
  {
    $name_asset = "";
    $br = "- <br>";
    if (count(array($name)) <= 50) {
      $name_asset = $name;
    } elseif (count(array($name)) > 50 && count(array($name)) <= 100) {
      $name_asset = $name . substr(0, 50) . $br;
      $name_asset += $name . substr(50, count(array($name)));
    } elseif (count(array($name)) > 100 && count(array($name)) <= 150) {
      $name_asset = $name . substr(0, 50) . $br;
      $name_asset = $name . substr(50, 100) . $br;
      $name_asset += $name . substr(100, count(array($name)));
    } elseif (count(array($name)) > 150 && count(array($name)) <= 200) {
      $name_asset = $name . substr(0, 50) . $br;
      $name_asset = $name . substr(50, 100) . $br;
      $name_asset = $name . substr(100, 150) . $br;
      $name_asset += $name . substr(150, count(array($name)));
    } elseif (count(array($name)) > 200) {
      $name_asset = $name . substr(0, 50) . $br;
      $name_asset = $name . substr(50, 100) . $br;
      $name_asset = $name . substr(100, 150) . $br;
      $name_asset = $name . substr(150, 200) . $br;
      $name_asset += $name . substr(200, count(array($name)));
    }

    return $name_asset;
  }

  public function delete()
  {
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }

    $idFormTemplate = [];

    if (!empty($this->input->post('idFormTemplate'))) {
      $idFormTemplate = $this->input->post('idFormTemplate');
    }

    // $id_asset = $this->input->post('idAsset');
    foreach ($idFormTemplate as $key => $id) {
      $form_template = $this->m_form_template->formTemplateDelete($id);
    }

    echo json_encode($form_template);
    exit;
  }


  public function store()
  {
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }
    $post = $this->security->xss_clean($this->input->post());
    $propFormTemplate = [
      "idFormTemplate" => !empty($post['idFormTemplate']) ? (int)$post['idFormTemplate'] : 0,
      "idFormType" => 2,
      "ftCode" => $post['ftCode'],
      "ftName" => $post['ftName'],
    ];
    $propZMasterForm = [];
    if (!empty($post['idAssetMaster'])) {
      foreach ($post['idAssetMaster'] as $key => $value) {
        $propZMasterForm[$key] = [
          "idAssetMaster" => (int)$post['idAssetMaster'][$key],
          "idFormTemplate" => !empty($post['idFormTemplate']) ? (int)$post['idFormTemplate'] : 0
        ];
      }
    }

    $propFormAlkur = [];
    if (!empty($post['assetNameFormAlkur'])) {
      foreach ($post['assetNameFormAlkur'] as $key => $value) {
        $propFormAlkur[$key] = [
          "idFpAlkur" => (int)$post['idFpAlkur'][$key],
          "idForm" => !empty($post['idForm']) ? (int)$post['idForm'] : 0,
          "idTemplate" => !empty($post['idFormTemplate']) ? (int)$post['idFormTemplate'] : 0,
          "idAsset" => (int)$post['idAssetFormAlkur'][$key],
          "assetName" => $post['assetNameFormAlkur'][$key],
          "assetMerk" => $post['assetMerkFormAlkur'][$key],
          "assetType" => $post['assetTypeFormAlkur'][$key],
          "assetSN" => $post['assetSNFormAlkur'][$key]
        ];
      }
    }

    $propFormTools = [];
    if (!empty($post['assetNameFormTools'])) {
      foreach ($post['assetNameFormTools'] as $key => $value) {
        $propFormTools[$key] = [
          "idFpTools" => (int)$post['idFpTools'][$key],
          "idForm" => !empty($post['idForm']) ? (int)$post['idForm'] : 0,
          "idTemplate" => !empty($post['idFormTemplate']) ? (int)$post['idFormTemplate'] : 0,
          "idAsset" => (int)$post['idAssetFormTools'][$key],
          "assetName" => $post['assetNameFormTools'][$key],
          "assetMerk" => $post['assetMerkFormTools'][$key],
          "assetType" => $post['assetTypeFormTools'][$key],
          "assetSN" => $post['assetSNFormTools'][$key]
        ];
      }
    }

    $propFormElect = [];
    if (!empty($post['electParam'])) {
      foreach ($post['electParam'] as $key => $value) {
        $propFormElect[$key] = [
          "idFpElect"   => (int)$post['idFpElect'][$key],
          "idForm" => !empty($post['idForm']) ? (int)$post['idForm'] : 0,
          "idTemplate" => !empty($post['idFormTemplate']) ? (int)$post['idFormTemplate'] : 0,
          "electParam" => $post['electParam'][$key],
          "electMeasure" => !empty($post['electMeasure']) ? (int)$post['electMeasure'][$key] : 0,
          "electUpper" => !empty($post['electUpper']) ? (int)$post['electUpper'][$key] : 0,
          "electLower" => !empty($post['electLower']) ? (int)$post['electLower'][$key] : 0,
          "electUnit" => !empty($post['electUnit']) ? $post['electUnit'][$key] : '',
          "electResult" => false,
        ];
      }
    }

    $propFormUkur = [];
    if (!empty($post['ukurSubjectFormUkur'])) {
      foreach ($post['ukurSubjectFormUkur'] as $key => $value) {
        $propFormUkur[$key] = [
          "idUkur" => !empty($post['idUkurFormUkur'][$key]) ? (int)$post['idUkurFormUkur'][$key] : 0,
          "idForm" => !empty($post['idForm']) ? (int)$post['idForm'] : 0,
          "idTemplate" => !empty($post['idFormTemplate']) ? (int)$post['idFormTemplate'] : 0,
          "ukurSubject" => $post['ukurSubjectFormUkur'][$key],
          "ukurUnit" => $post['ukurUnitFormUkur'][$key],
          "ukurSet" => (int)$post['ukurSetFormUkur'][$key],
          "ukurVal" => (int)$post['ukurVal'][$key],
          "ukurMin" => (int)$post['ukurMinFormUkur'][$key],
          "ukurMax" => (int)$post['ukurMaxFormUkur'][$key],
          "ukurAvg" => !empty($post['ukurAvgFormUkur'][$key]) ? (int)$post['ukurAvgFormUkur'][$key] : 0,
          "ukurResult" => '', //$post['ukurResultFormUkur'][$key]
        ];
      }
    }

    $propFormEncon = [
      "idFpEncon" => (int)$post['idFpEncon'],
      "idForm" => !empty($post['idForm']) ? (int)$post['idForm'] : 0,
      "idTemplate" => !empty($post['idFormTemplate']) ? (int)$post['idFormTemplate'] : 0,
      "tempStart" => (int)$post['tempStartFormEncon'],
      "tempEnd" => 0,
      "humidityStart" => (int)$post['humidityStartFormEncon'],
      "humidityEnd" => 0
    ];

    $propFormEqdata = [
      "idFpEqdata" => !empty($post['idFpEqdata']) ? (int)$post['idFpEqdata'] : 0,
      "idForm" => !empty($post['idForm']) ? (int)$post['idForm'] : 0,
      "idTemplate" => !empty($post['idFormTemplate']) ? (int)$post['idFormTemplate'] : 0,
      "eqCode" => $post['eqCodeFormEqdata'],
      "eqName" => $post['eqNameFormEqdata'],
      "eqMerk" => $post['eqMerkFormEqdata'],
      "eqType" => $post['eqTypeFormEqdata'],
      "eqSN" => $post['eqSNFormEqdata'],
      "eqLocation" => $post['eqLocationFormEqdata'],
      "idAsset" => (int)$post['idAsset'],
      "createdDate" => date('Y-m-d H:i:s')
    ];

    $propFormGen = [];
    if (!empty($post['genActionFormGen'])) {
      foreach ($post['genActionFormGen'] as $key => $value) {
        $propFormGen[$key] = [
          "idGen" => !empty($post['idGenFormGen'][$key]) ? (int)$post['idGenFormGen'][$key] : 0,
          "idForm" => !empty($post['idForm']) ? (int)$post['idForm'] : 0,
          "idTemplate" => !empty($post['idFormTemplate']) ? (int)$post['idFormTemplate'] : 0,
          "genAction" => $post['genActionFormGen'][$key],
          "genResult" => ''
        ];
      }
    }

    $propFormFisfung = [];
    if (!empty($post['fisfungItem'])) {
      foreach ($post['fisfungItem'] as $key => $value) {
        $propFormFisfung[$key] = [
          "idFisfung" => !empty($post['idFisfung'][$key]) ? (int)$post['idFisfung'][$key] : 0,
          "idTemplate" => !empty($post['idFormTemplate']) ? (int)$post['idFormTemplate'] : 0,
          "idForm" => !empty($post['idForm']) ? (int)$post['idForm'] : 0,
          "fisfungItem" => $post['fisfungItem'][$key],
          "fisfungResult" => ""
        ];
      }
    }

    $propFormTemplateitem = [
      "idTmpItem" => !empty($post['idTmpItem']) ? $post['idTmpItem'] : 0,
      "idTemplate" => !empty($post['idFormTemplate']) ? $post['idFormTemplate'] : 0,
      "idForm" => !empty($post['idForm']) ? (int)$post['idForm'] : 0,
      "tmpitemEQ" => false,
      "tmpitemEngineer" => !empty($post['tmpitemEngineer']) ? true :  false,
      "tmpitemAlkur" => !empty($post['tmpitemAlkur']) ? true :  false,
      "tmpitemTools" => !empty($post['tmpitemTools']) ? true :  false,
      "tmpitemEncon" => !empty($post['tmpitemEncon']) ? true :  false,
      "tmpitemESM" =>   !empty($post['tmpitemESM']) ? true : false,
      "tmpitemFisfung" => !empty($post['tmpitemFisfung']) ? true :  false,
      "tmpitemPerf" => !empty($post['tmpitemPerf']) ? true :  false,
      "tmpitemAction" => !empty($post['tmpitemAction']) ? true :  false,
      "tmpitemUseVendor" => !empty($post['tmpitemUseVendor']) ? true :  false,
      "tmpitemSignMode" =>   false,
    ];

    $propFormTemplate['propZMasterForm'] = $propZMasterForm;
    if (!empty($post['tmpitemAlkur'])) {
      $propFormTemplate['propFormAlkur'] = $propFormAlkur;
    } else {
      $propFormTemplate['propFormAlkur'] = [];
    }
    if (!empty($post['tmpitemTools'])) {
      $propFormTemplate['propFormTools'] = $propFormTools;
    } else {
      $propFormTemplate['propFormTools'] = [];
    }
    if (!empty($post['tmpitemESM'])) {
      $propFormTemplate['propFormElect'] = $propFormElect;
    } else {
      $propFormTemplate['propFormElect'] = [];
    }
    if (!empty($post['tmpitemESM'])) {
      $propFormTemplate['propFormEncon'] = $propFormEncon;
    } else {
      $propFormTemplate['propFormEncon'] = "";
    }
    $propFormTemplate['propFormEqdata'] = $propFormEqdata;

    if (!empty($post['tmpitemAction'])) {
      $propFormTemplate['propFormGen'] = $propFormGen;
    } else {
      $propFormTemplate['propFormGen'] = [];
    }

    if (!empty($post['tmpitemPerf'])) {
      $propFormTemplate['propFormUkur'] = $propFormUkur;
    } else {
      $propFormTemplate['propFormUkur'] = [];
    }

    if (!empty($post['tmpitemFisfung'])) {
      $propFormTemplate['propFormFisfung'] = $propFormFisfung;
    } else {
      $propFormTemplate['propFormFisfung'] = [];
    }
    $propFormTemplate['propFormTemplateitem'] = $propFormTemplateitem;

    // echo json_encode($propFormTemplate);
    // die;

    if ($post['formType'] == 'add') {
      $this->session->unset_userdata('idAssetMasterSelected');
      $this->session->set_userdata('idAssetMasterSelected', []);
      if ($propZMasterForm == []) {
        echo json_encode([
          "queryResult" => false,
          "queryMessage"  => "Master asset data is null, please select master asset data!"
        ]);
        die;
      } else {
        $save = $this->m_form_template->formTemplateInsert($propFormTemplate);
        echo json_encode($save);
        die;
      }
    } else {
      $this->session->unset_userdata('idAssetMasterSelected');
      $this->session->set_userdata('idAssetMasterSelected', []);
      if ($propZMasterForm == []) {
        echo json_encode([
          "queryResult" => false,
          "queryMessage"  => "Master asset data is null, please select master asset data!"
        ]);
        die;
      } else {
        $save = $this->m_form_template->formTemplateUpdate($propFormTemplate);
        echo json_encode($save);
        die;
      }
    }
  }

  public function forms_by_id()
  {
    $show = [];
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }
    $idFormTemplate = [];

    $idFormTemplate = $this->input->post('idFormTemplate');

    foreach ($idFormTemplate as $key => $id) {
      $result = $this->m_form_template->formTemplateById($id);
    }

    // buat data by id
    // $result2 = $this->m_asset_master->assetMasterList();
    $show['data_update'] = $result['data'];
    // $show['data_result'] = $result2['data'];
    // $show['data_edit'] = true;

    echo json_encode($show);
    exit;
  }
}
