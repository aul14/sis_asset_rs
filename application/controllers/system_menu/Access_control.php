<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Access_control extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->simple_login->cek_login(); // cek login
    $this->load->model([
      'M_access_control'      => 'm_access_control',
      'M_app_menu'            => 'm_app_menu',
      'M_hospital'            => 'm_hospital'
    ]);
  }

  public function query()
  {
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }

    $q = trim($this->input->post('q'));

    $query_groups = [];

    if (!empty($q)) {
      $query_groups = [
        [
          "queryMethod" => "LIKEOR",
          "queryParams" => [
            [
              "column" => "roleName",
              "value" => $q
            ],
          ]
        ]
      ];
    }

    $data_request = [
      "queryGroupMethod" => "AND",
      "queryGroups" => $query_groups,
      "limit" =>  20
    ];

    $result = $this->m_access_control->RoleQuery($data_request);

    echo json_encode($result['data']);
    exit;
  }

  public function index()
  {

    $result_role = $this->m_access_control->MyRole()['data'];

    $data['result_role'] = $result_role['roleACL'];

    $data['hospital']     = $result_role['roleHospital'];

    $data['idrs_user']  = $result_role['idRS'];

    $data['role_group']   = $result_role['roleGroup'];

    $data['grp_code']   = $result_role['grpCode'];

    $data['roles_type'] = $result_role['roleSysType'];

    $this->load->model('M_notifikasi', 'm_notifikasi');
    $data['notif'] = $this->m_notifikasi->list()['data'];

    if ($result_role['roleACL'][6]['subMenu1'][2]['isAllow'] != true) {
      exit('You dont have access!!');
    }

    $this->load->view('components/header');
    $this->load->view('components/sidebar', $data);
    $this->load->view('system_menu/access_control/form/usercontrol_form', $data);
    $this->load->view('system_menu/access_control/user_control_index');
    $this->load->view('system_menu/system');
    $this->load->view('components/footer');
    $this->load->view('components/sidebar_footer');
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

      $roleName_query_params = [
        "column" => "roleName",
        "value" => $array['search']
      ];
      array_push($query_params_like_or, $roleName_query_params);

      $roleDescription_query_params = [
        "column" => "roleDescription",
        "value" => $array['search']
      ];
      array_push($query_params_like_or, $roleDescription_query_params);

      // 
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

    $count = $this->m_access_control->RoleQuery(
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
          "column" => "idRole",
          "value" => "desc"
        ]
      ],
      "page" =>  $page,
      "limit" =>  isset($length) ? (int)$length : 10
    ];

    $posts = $this->m_access_control->RoleQuery($request);
    if (sizeof($posts) > 0) {
      $no = $start + 1;
      foreach ($posts['data'] as $key => $value) {
        $idRole = $value['idRole'];

        $posts['data'][$key]['check_box_cuk'] = "<input type='checkbox' id='delcheck_{$idRole}'  name='msg[]' class='delete_check' value='{$idRole}' />";

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

  public function store()
  {
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }

    $post = $this->security->xss_clean($this->input->post());

    if (!empty($post['idRs'])) {
      foreach ($post['idRs'] as $key9 => $v) {
        $idrs_user = $v;
      }
    }

    $role = [
      'idRole' => isset($post['idRole']) ? (int)$post['idRole'] : 0,
      'roleHierarchi' => 'HOSP',
      'grpCode'   => empty($post['grpCode']) ? $post['roleGroup'] : $post['grpCode'],
      'idRS'      =>  $idrs_user,
      'roleSysType' => "",
      'sysRoleName' => '',
      'roleName' => $post['roleName'],
      'roleDescription' => $post['roleDescription'],
      'lastUpdated' => date('Y-m-d H:i:s'),
    ];

    $roleGroup = [];
    if (empty($post['grpCode'])) {
      $roleGroup[] = [
        'rsGroupCode' => $post['roleGroup']
      ];
    } else {
      $roleGroup[] = [
        'rsGroupCode' => $post['grpCode']
      ];
    }

    $role['roleGroup'] = $roleGroup;

    $roleACL = [];
    if (!empty($post['idMenu'])) {
      foreach (array_unique($post['idMenu']) as $key => $value) {
        $roleACL[] = [
          'idRole' => isset($post['idRole']) ? (int)$post['idRole'] : 0,
          'idMenu' => isset($post['idMenu']) ? $post['idMenu'][$key] : 0,
          'isAllow' => true
        ];
      }
    }
    $role['roleACL']    = $roleACL;

    $roleTask = [];

    $cuk = implode(",", array_unique($post['taskCode']));
    $cuk = explode(",", $cuk);
    foreach ($cuk as $key => $value) {
      if (!empty($value)) {
        $roleTask[] = [
          'taskCode' => !empty($post['taskCode']) ? $value : 0,
          "taskSysCode" => "",
        ];
      }
    }

    $role['roleTask']    = $roleTask;

    $roleHospital = [];
    $buildingList = [];
    $propAssetPropbuildingFloor = [];
    $propAssetPropbuildingRoom = [];

    $inerRoom = [];
    $inerCode = [];
    if (!empty($post['idRs'])) {
      foreach ($post['idRs'] as $key2 => $v) {
        $inerRoom = [];
        $inerCode = [];
        $role['roleHospital'][] = [
          'idRs'    => isset($post['idRs']) ? $post['idRs'][$key2] : 0,
        ];

        $role['roleHospital'][$key2]['buildingList'] = [];

        // untuk isi assetcatlist
        if (!empty($post['catCode'])) {
          foreach ($post['catCode'] as $k => $vcode) {
            $code = explode("|", $vcode);
            if ($code[1] == $v) {
              $inerCode[] = [
                'catCode' => $code[0]
              ];
            }
          }
        }
        $role['roleHospital'][$key2]['assetCatList'] = $inerCode;

        // datanya di explode dulu untuk mendapatkan id parentnya
        if (!empty($post['idRoom'])) {
          foreach ($post['idBuilding'] as $kunci => $val) {
            $build = explode("|", $val);
            if ($build[1] == $v) {
              foreach ($post['idFloor'] as $kunci2 => $val2) {
                $floor = explode("|", $val2);
                if ($floor[1] == $build[0] && $floor[2] == $build[1]) {
                  foreach ($post['idRoom'] as $kunci3 => $val3) {
                    $room = explode("|", $val3);
                    if ($room[1] == $floor[0] && $room[2] == $floor[1] && $room[3] == $floor[2]) {
                      $inerRoom[] = [
                        'idBuilding'    => $build[0],
                        'idFloor'       => $floor[0],
                        'idRoom'        => $room[0],
                        'isSelected'    => true
                      ];
                    }
                  }
                }
              }
            }
          }

          $role['roleHospital'][$key2]['buildingList'][]['propAssetPropbuildingFloor'][]['propAssetPropbuildingRoom'] = $inerRoom;
        }
      }
    }




    if ($post['formType'] == 'add') {
      $save = $this->m_access_control->RoleInsert($role);
    } else {
      $save = $this->m_access_control->RoleUpdate($role);
    }

    echo json_encode($save);
    die;
    // echo json_encode($role);
    // die;

    // echo "<pre>";
    // var_dump($role);
    // die;
    // echo "</pre>";
  }

  public function roles_by_id()
  {
    $show = [];
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }
    $idRole = [];

    $idRole = $this->input->post('idRole');

    foreach ($idRole as $key => $id) {
      $result = $this->m_access_control->by_id($id);
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

    $idRole = [];

    if (!empty($this->input->post('idRole'))) {
      $idRole = $this->input->post('idRole');
    }

    // $id_asset = $this->input->post('idAsset');
    foreach ($idRole as $key => $id) {
      $role = $this->m_access_control->RoleDelete($id);
    }

    echo json_encode($role);
    exit;
  }
}
