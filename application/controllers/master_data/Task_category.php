<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Task_category extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->simple_login->cek_login(); // cek login
    $this->load->model('M_task_category', 'm_task_category');
  }

  public function index()
  {
    $result_role = $this->m_access_control->MyRole()['data']['roleACL'];

    $data['result_role'] = $result_role;
    $this->load->model('M_notifikasi', 'm_notifikasi');
    $data['notif'] = $this->m_notifikasi->list()['data'];

    $this->load->view('components/header');
    $this->load->view('components/sidebar', $data);
    $this->load->view('master_data/task_category/form/taskcategory_form');
    $this->load->view('master_data/task_category/task_category_index');
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

    $taskCategory = [
      "taskCode" => strtoupper($post['taskCode']),
      "taskSysCode" => $post['taskSysCode'],
      "taskName" => $post['taskName'],
      "needApproval" => $post['needApproval'],
      "needForm" => $post['needForm'],
      "taskTable" => $post['taskTable'],
    ];

    if ($post['formType'] == 'add') {
      $save = $this->m_task_category->insert($taskCategory);
    } else {
      $save = $this->m_task_category->update($taskCategory);
    }

    echo json_encode($save);
  }

  public function delete()
  {
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }

    $taskCode = [];

    if (!empty($this->input->post('taskCode'))) {
      $taskCode = $this->input->post('taskCode');
    }

    // $id_asset = $this->input->post('idAsset');
    foreach ($taskCode as $key => $id) {
      $org = $this->m_task_category->delete($id);
    }

    echo json_encode($org);
    exit;
  }

  public function taskcategory_by_id()
  {
    $show = [];
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }

    $taskCode = [];

    if (!empty($this->input->post('taskCode'))) {
      $taskCode = $this->input->post('taskCode');
    }

    foreach ($taskCode as $key => $id) {
      $result = $this->m_task_category->byid($id);
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

      $taskCode_query_params = [
        "column" => "taskCode",
        "value" => $array['search']
      ];
      array_push($query_params_like_or, $taskCode_query_params);

      $taskSysCode_query_params = [
        "column" => "taskSysCode",
        "value" => $array['search']
      ];
      array_push($query_params_like_or, $taskSysCode_query_params);

      $taskName_query_params = [
        "column" => "taskName",
        "value" => $array['search']
      ];
      array_push($query_params_like_or, $taskName_query_params);
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

    $count = $this->m_task_category->query(
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
          "column" => "taskName",
          "value" => "asc"
        ]
      ],
      "page" =>  $page,
      "limit" =>  isset($length) ? (int)$length : 10
    ];

    $posts = $this->m_task_category->query($request);
    if (sizeof($posts) > 0) {
      $no = $start + 1;
      foreach ($posts['data'] as $key => $value) {
        $taskCode = $value['taskCode'];

        $posts['data'][$key]['check_box_cuk'] = "<input type='checkbox' id='delcheck_{$taskCode}'  name='msg[]' class='delete_check' value='{$taskCode}' />";

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
