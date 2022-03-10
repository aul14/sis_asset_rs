<?php


defined('BASEPATH') or exit('No direct script access allowed');


class Login extends CI_Controller
{
    public function result()
    {
        new M_res_login();
    }

    public function __construct()
    {
        parent::__construct();
        $this->load->model([
            'M_login' => 'm_login',
            'M_user'   => 'm_user',
            'M_access_control'  => 'm_access_control'
        ]);
    }


    public function index()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
        $email = htmlspecialchars(strip_tags($this->input->post('email')));
        $password = htmlspecialchars(strip_tags($this->input->post('password')));
        $recaptcha = $this->input->post('g-recaptcha-response');
        $response = $this->recaptcha->verifyResponse($recaptcha);

        // cek klo sudah login tidak bisa kembali lagi
        if ($this->session->userdata('token')) {
            redirect('dashboard/home', 'refresh');
        }


        if ($this->form_validation->run() == FALSE || !isset($response['success']) || $response['success'] <> true) {
            $data = [
                'captcha' => $this->recaptcha->getWidget(), // menampilkan recaptcha
                'script_captcha' => $this->recaptcha->getScriptTag(), // javascript recaptcha ditaruh di head
            ];
            $this->load->view('components/header');
            $this->load->view('auth/login', $data);
            $this->load->view('auth/login_js');
            $this->load->view('components/footer');
        } else {

            $data =  $this->m_login->data($email, $password);

            if (!empty($data)) {
                $result = $this->m_login->loginByEmail($data);
                $hospital = $result['propHospital'];

                if ($result['loginResult'] == true) {

                    if (count($hospital) == 0) {
                        $this->session->set_flashdata('error', 'You are not eligible to enter!');
                        redirect('login', 'refresh');
                    } elseif (count($hospital) ==  1) {
                        $this->session->set_userdata('token', $result['token']);
                        $login_hospital_1 = $this->m_login->loginSelectHospital($hospital[0]['idRs']);
                        $this->session->unset_userdata('token');
                        $this->session->set_userdata('token', $login_hospital_1['token']);

                        $assetFileUploads = [];
                        $taskStockopnameDetails = [];
                        $assetInstrument = [];
                        $assetStock = [];
                        $assetStockIn = [];
                        $assetStockOut = [];
                        $sesspropFormGen = [];
                        $sesspropFormPart = [];
                        $sesspropFormServices = [];
                        $sesspropFormTools = [];
                        $sesspropFormPic = [];
                        $idAssetMasterSelected = [];

                        $data_session = [
                            'username' => $result['userName'],
                            'email' => $result['userMail'],
                            'id_user'   => $result['idUser'],
                            'hospital'   => $hospital[0]['rsName'],
                            'propHospital' => $hospital,
                            'taskStockopnameDetails' => $taskStockopnameDetails,
                            'assetFileUploads' => $assetFileUploads,
                            'assetInstrument' => $assetInstrument,
                            'assetStock' => $assetStock,
                            'assetStockIn' => $assetStockIn,
                            'assetStockOut' => $assetStockOut,
                            'sesspropFormGen' => $sesspropFormGen,
                            'sesspropFormPart' => $sesspropFormPart,
                            'sesspropFormServices' => $sesspropFormServices,
                            'sesspropFormTools' => $sesspropFormTools,
                            'sesspropFormPic' => $sesspropFormPic,
                            'idAssetMasterSelected' => $idAssetMasterSelected,
                        ];

                        $this->session->set_userdata($data_session);

                        redirect('dashboard/home', 'refresh');
                    } else {
                        $assetFileUploads = [];
                        $taskStockopnameDetails = [];
                        $assetInstrument = [];
                        $assetStock = [];
                        $assetStockIn = [];
                        $assetStockOut = [];
                        $sesspropFormGen = [];
                        $sesspropFormPart = [];
                        $sesspropFormServices = [];
                        $sesspropFormTools = [];
                        $sesspropFormPic = [];
                        $idAssetMasterSelected = [];

                        $data_session = [
                            'token' => $result['token'],
                            'username' => $result['userName'],
                            'email' => $result['userMail'],
                            'id_user'   => $result['idUser'],
                            'hospital'   => $result['hospitalName'],
                            'propHospital' => $hospital,
                            'taskStockopnameDetails' => $taskStockopnameDetails,
                            'assetFileUploads' => $assetFileUploads,
                            'assetInstrument' => $assetInstrument,
                            'assetStock' => $assetStock,
                            'assetStockIn' => $assetStockIn,
                            'assetStockOut' => $assetStockOut,
                            'sesspropFormGen' => $sesspropFormGen,
                            'sesspropFormPart' => $sesspropFormPart,
                            'sesspropFormServices' => $sesspropFormServices,
                            'sesspropFormTools' => $sesspropFormTools,
                            'sesspropFormPic' => $sesspropFormPic,
                            'idAssetMasterSelected' => $idAssetMasterSelected,
                        ];

                        $this->session->set_userdata($data_session);

                        redirect('hospital', 'refresh');
                    }
                } else {
                    $this->session->set_flashdata('error', 'email or password incorrect!');
                    redirect('login', 'refresh');
                }
            } else {
                $this->session->set_flashdata('error', 'email or password incorrect!');
                redirect('login', 'refresh');
            }
        }
    }

    public function logout()
    {
        // $this->session->unset_userdata('token');
        // $this->session->unset_userdata('username');
        // $this->session->unset_userdata('email');
        // $this->session->unset_userdata('id_user');
        $this->session->sess_destroy();
        redirect('login', 'refresh');
    }
}

/* End of file Login.php */
