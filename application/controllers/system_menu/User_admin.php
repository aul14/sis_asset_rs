<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->simple_login->cek_login(); // cek login
        $this->load->model([
            'M_user'                => 'm_user',
            'M_access_control'      => 'm_access_control',
        ]);
    }


    public function index()
    {
        $result_role = $this->m_access_control->MyRole()['data']['roleACL'];

        $data['result_role'] = $result_role;
        $this->load->model('M_notifikasi', 'm_notifikasi');
        $data['notif'] = $this->m_notifikasi->list()['data'];

        if ($result_role[6]['subMenu1'][1]['isAllow'] != true) {
            exit('You dont have access!!');
        }

        $this->load->view('components/header');
        $this->load->view('components/sidebar', $data);
        $this->load->view('system_menu/user_administration/form/adduser_form');
        $this->load->view('system_menu/user_administration/user_administration_index');
        $this->load->view('components/sidebar_footer');
        $this->load->view('components/footer');
        $this->load->view('system_menu/system');
    }

    public function user_query()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $q = $this->input->get('q');

        $query_groups = [];
        if (isset($q)) {
            $query_groups = [
                [
                    "queryMethod" => "LIKEOR",
                    "queryParams" => [
                        [
                            "column" => "userFullName",
                            "value" => $q
                        ],
                    ]
                ]
            ];
        }

        $request = [
            "queryGroupMethod" => "AND",
            "queryGroups" => $query_groups,
            "page" =>  1,
            "limit" =>  10
        ];

        $contact = $this->m_user->userQuery($request);

        echo json_encode($contact);
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

            $userName_query_params = [
                "column" => "userName",
                "value" => $array['search']
            ];
            array_push($query_params_like_or, $userName_query_params);

            $userFullName_query_params = [
                "column" => "userFullName",
                "value" => $array['search']
            ];
            array_push($query_params_like_or, $userFullName_query_params);

            $userMail_query_params = [
                "column" => "userMail",
                "value" => $array['search']
            ];
            array_push($query_params_like_or, $userMail_query_params);

            $userPhone_query_params = [
                "column" => "userPhone",
                "value" => $array['search']
            ];
            array_push($query_params_like_or, $userPhone_query_params);

            // $roleName_query_params = [
            //     "column" => "roleName",
            //     "value" => $array['search']
            // ];
            // array_push($query_params_like_or, $roleName_query_params);
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

        $count = $this->m_user->userQuery(
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
                    "column" => "idUser",
                    "value" => "desc"
                ]
            ],
            "page" =>  $page,
            "limit" =>  isset($length) ? (int)$length : 10
        ];

        $posts = $this->m_user->userQuery($request);
        if (sizeof($posts) > 0) {
            $no = $start + 1;
            foreach ($posts['data'] as $key => $value) {
                $idUser = $value['idUser'];

                $posts['data'][$key]['check_box_cuk'] = "<input type='checkbox' id='delcheck_{$idUser}'  name='msg[]' class='delete_check' value='{$idUser}' />";

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
        $post = $this->security->xss_clean($this->input->post());

        if ($post['formType'] == 'add') {
            $user = [
                "userMail" => $post['userMail'],
                "userPass" => isset($post['userPass']) ? $post['userPass'] : '',
                "userName" => $post['userName'],
                "userFullName" => $post['userFullName'],
                "userPhone" => $post['userPhone'],
                "idRole" => (int)$post['idRole']
            ];
            // echo "<pre>";
            // var_dump($user);
            // die;
            // echo "</pre>";
            $save = $this->m_user->loginRegisterByEmail($user);
        } else {
            $user = [
                "idUser" => $post['idUser'],
                "userName" => $post['userName'],
                "userFullName" => $post['userFullName'],
                // "userPass" => isset($post['userPass']) ? $post['userPass'] : '',
                // "userMail" => $post['userMail'],
                "userPhone" => $post['userPhone'],
                "emailConfirm" => true,
                "isActive" => false,
                "createDate" => date('Y-m-d H:i:s'),
                "lastLogin" => "",
                "session" => "",
                "token1" => "",
                "token2" => "",
                "idRole" => (int)$post['idRole'],
                "idHospital" => (int)$post['idHospital'],
                // "idFilePict" => isset($upload['data']['idFile']) ? (int)$upload['data']['idFile'] : 0
            ];

            $save = $this->m_user->userUpdate($user);
        }
        echo json_encode($save);
        die;
    }

    public function user_by_id()
    {
        $show = [];
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $idUser = [];

        $idUser = $this->input->post('idUser');

        foreach ($idUser as $key => $id) {
            $result = $this->m_user->userById($id);
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

        $idUser = [];

        if (!empty($this->input->post('idUser'))) {
            $idUser = $this->input->post('idUser');
        }

        // $id_asset = $this->input->post('idAsset');
        foreach ($idUser as $key => $id) {
            $user = $this->m_user->userDelete($id);
        }

        echo json_encode($user);
        exit;
    }
}
