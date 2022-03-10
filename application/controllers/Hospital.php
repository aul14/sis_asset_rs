<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Hospital extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->simple_login->cek_login(); // cek login
        $this->load->model([
            'M_login'       => 'm_login',
            'M_access_control'  => 'm_access_control'
        ]);
    }

    public function index()
    {
        $data['propHospital'] = $this->session->userdata('propHospital');

        $this->load->view('components/header');
        $this->load->view('auth/hospital', $data);
        $this->load->view('auth/hospital_js');
        $this->load->view('components/footer');
    }

    public function new_request($id)
    {
        $result = $this->m_login->loginSelectHospital($id);


        $this->session->unset_userdata('hospital');
        $this->session->unset_userdata('token');

        $this->session->set_userdata('hospital', $result['hospitalName']);
        $this->session->set_userdata('token', $result['token']);

        //     $result_role = $this->m_access_control->MyRole()['data']['roleACL'];
        // $this->session->set_userdata('propRole', $result_role);

        redirect('dashboard/home', 'refresh');
    }
}

/* End of file Hospital.php */
