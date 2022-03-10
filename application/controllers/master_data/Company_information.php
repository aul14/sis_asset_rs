<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Company_information extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->simple_login->cek_login(); // cek login
    $this->load->model('M_hospital', 'm_hospital');
    $this->load->model('m_file');
    $this->load->model('m_file_cat');
  }


  public function index()
  {
    $result_role = $this->m_access_control->MyRole()['data']['roleACL'];
    $this->load->model('M_notifikasi', 'm_notifikasi');

    $data['result_role'] = $result_role;
    $data['notif'] = $this->m_notifikasi->list()['data'];

    if ($result_role[4]['subMenu1'][0]['isAllow'] != true) {
      exit('You dont have access!!');
    }

    $this->load->view('components/header');
    $this->load->view('components/sidebar', $data);
    $this->load->view('master_data/company_information/form/companyinfo_form');
    $this->load->view('master_data/company_information/company_index');
    $this->load->view('master_data/master_data');
    $this->load->view('components/sidebar_footer');
    $this->load->view('components/footer');
  }

  private function logo_file_upload($file)
  {

    $filename = $file['name'];

    $dir = 'assets/upload/file/';

    if (!is_dir($dir)) {
      mkdir($dir, 0777, TRUE);
      // chmod(FCPATH . $dir, 0777);
    }

    $ext = pathinfo($filename, PATHINFO_EXTENSION);

    $target_file = $dir . basename($filename);

    $fileCat = $this->m_file_cat->fileCatByFileCatName('CompanyLogo');
    $idFileCat = $fileCat['queryResult'] == true ? $fileCat['data']['idFileCat'] : 0;

    // chmod(FCPATH . $dir, 0777);
    if (move_uploaded_file($file["tmp_name"], $target_file)) {

      $data = [
        'idCat' => $idFileCat,
        'folder' => $dir,
        'files' => $dir . $filename,
        'userName' => $this->session->userdata('username')
      ];

      $file_upload = $this->m_file->fileUpload($data);
      // var_dump(json_encode($file_upload));
      // die;

      return $file_upload;
      die();
    }

    return false;
  }

  public function data_information()
  {
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }

    $data = $this->m_hospital->information()['data'];

    if ($data['rsLogoFileID'] != 0) {
      $file = $this->m_file->fileBase64($data['rsLogoFileID'])['data'];
    } else {
      $file = "";
    }

    $data['logo_rs'] = $file;
    echo json_encode($data);
    die;
  }
  public function check_by_id()
  {
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }
    $data = $this->m_hospital->ById($this->input->post('idRs'))['data'];

    if ($data['rsLogoFileID'] != 0) {
      $file = $this->m_file->fileBase64($data['rsLogoFileID'])['data'];
    } else {
      $file = "";
    }

    $data['logo_rs'] = $file;

    echo json_encode($data);
    die;
  }

  public function store()
  {
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }

    $post = $this->security->xss_clean($this->input->post());

    $company = $this->m_hospital->information();

    $logo_file = $_FILES['rsLogoFileID'] ? $this->logo_file_upload($_FILES['rsLogoFileID']) : '';

    $company['data']['rsCode'] = $post['rsCode'];
    $company['data']['rsName'] = $post['rsName'];
    $company['data']['rsAlamat'] = $post['rsAlamat'];
    $company['data']['rsPhone'] = $post['rsPhone'];
    $company['data']['rsCity'] = $post['rsCity'];
    $company['data']['rsLogoFileID'] = $logo_file == "" ? $post['idFileLogo'] : $logo_file['data']['idFile'];

    // $data = $this->m_hospital->information_update($company['data']);

    echo json_encode($company['data']);
    die;
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

      $rsCode_query_params = [
        "column" => "rsCode",
        "value" => $array['search']
      ];
      array_push($query_params_like_or, $rsCode_query_params);

      $rsName_query_params = [
        "column" => "rsName",
        "value" => $array['search']
      ];
      array_push($query_params_like_or, $rsName_query_params);

      $rsAlamat_query_params = [
        "column" => "rsAlamat",
        "value" => $array['search']
      ];
      array_push($query_params_like_or, $rsAlamat_query_params);
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

    $count = $this->m_hospital->query(
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
          "column" => "rsName",
          "value" => "desc"
        ]
      ],
      "page" =>  $page,
      "limit" =>  isset($length) ? (int)$length : 10
    ];

    $posts = $this->m_hospital->query($request);

    if (sizeof($posts) > 0) {
      $no = $start + 1;
      foreach ($posts['data'] as $key => $value) {
        $idRs = $value['idRs'];

        $posts['data'][$key]['check_box_cuk'] = "<input type='checkbox' id='delcheck_{$idRs}'  name='msg[]' class='delete_check' value='{$idRs}' />";

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
