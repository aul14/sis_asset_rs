<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Contact extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->simple_login->cek_login(); // cek login

        $this->load->model([
            'M_contact'     => 'm_contact'
        ]);
    }

    public function index()
    {

        $result_role = $this->m_access_control->MyRole()['data']['roleACL'];

        $data['result_role'] = $result_role;
        $this->load->model('M_notifikasi', 'm_notifikasi');
        $data['notif'] = $this->m_notifikasi->list()['data'];

        $this->load->view('components/header');
        $this->load->view('components/sidebar', $data);
        $this->load->view('contact/form/contact_form');
        $this->load->view('contact/contact_index');
        $this->load->view('components/sidebar_footer');
        $this->load->view('components/footer');
        $this->load->view('contact/contact_js');
    }

    public function data_list()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $response = $this->m_contact->contactList();

        $data = $response['data'];

        echo json_encode($data);
        die;
    }

    public function data_count()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $response = $this->m_contact->contactCount();

        $data = $response;

        $data['all'] = $response['countPerson'] + $response['countSupplier'] + $response['countCustomer'] + $response['countCalibInstitution'] + $response['countOthers'];

        echo json_encode($data);
        die;
    }

    public function delete()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $idContact = trim($this->input->post('idContact'));

        $data = $this->m_contact->contactDelete($idContact);

        echo json_encode($data);
        die;
    }

    public function contact_by_id()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $idContact = trim($this->input->post('idContact'));

        $data = $this->m_contact->contactById($idContact)['data'];

        echo json_encode($data);
        die;
    }

    public function store()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $post = $this->security->xss_clean($this->input->post());
        $contact = [
            "idContact" => isset($post['idContact']) ? (int)$post['idContact'] : 0,
            "parentContact" => isset($post['parentContact']) ? (int)$post['parentContact'] : 0,
            "contactType" => $post['contactType'],
            "contactPerson" => $post['contactPerson'],
            "contactCompany" => $post['contactCompany'],
            "contactAddress1" => $post['contactAddress1'],
            "contactAddress2" => $post['contactAddress2'],
            "contactAddress3" => "",
            "contactPhone" => $post['contactPhone'],
            "contactMobile" => $post['contactMobile'],
            "contactEmail" => $post['contactEmail'],
        ];

        if ($post['formType'] == 'add') {
            $save = $this->m_contact->contactInsert($contact);
        } else {
            $save = $this->m_contact->contactUpdate($contact);
        }

        echo json_encode($save);
        die;
    }

    public function contact_query()
    {
        $q = $this->input->get('q');

        $query_groups = [];
        if (isset($q)) {
            $query_groups = [
                [
                    "queryMethod" => "LIKEOR",
                    "queryParams" => [
                        [
                            "column" => "contactCompany",
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

        $contact = $this->m_contact->contactQuery($request);

        echo json_encode($contact);
    }

    public function data_table()
    {
        $contactType = $this->input->post('contactType');

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

            $contactType_query_params = [
                "column" => "contactType",
                "value" => $array['search']
            ];
            array_push($query_params_like_or, $contactType_query_params);

            $contactPerson_query_params = [
                "column" => "contactPerson",
                "value" => $array['search']
            ];
            array_push($query_params_like_or, $contactPerson_query_params);

            $contactCompany_query_params = [
                "column" => "contactCompany",
                "value" => $array['search']
            ];
            array_push($query_params_like_or, $contactCompany_query_params);

            $contactPhone_query_params = [
                "column" => "contactPhone",
                "value" => $array['search']
            ];
            array_push($query_params_like_or, $contactPhone_query_params);

            $contactMobile_query_params = [
                "column" => "contactMobile",
                "value" => $array['search']
            ];
            array_push($query_params_like_or, $contactMobile_query_params);

            $contactEmail_query_params = [
                "column" => "contactEmail",
                "value" => $array['search']
            ];
            array_push($query_params_like_or, $contactEmail_query_params);
        }

        if ($contactType != '') {
            $contactType_query_params = [
                "column" => "contactType",
                "value" => $contactType
            ];

            array_push($query_params, $contactType_query_params);
        }

        $query_groups_like_or = [];
        $query_groups = [];

        if ($contactType != '') {
            $query_groups = [
                [
                    "queryMethod" => "EXACTAND", //"LIKEAND",
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

        $count = $this->m_contact->contactQuery(
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
            "page" =>  $page,
            "limit" =>  isset($length) ? (int)$length : 10
        ];

        $posts = $this->m_contact->contactQuery($request);

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

/* End of file Contact.php */
