<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master_instrument extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->simple_login->cek_login(); // cek login
  }


  public function index()
  {
    $result_role = $this->m_access_control->MyRole()['data']['roleACL'];

    $data['result_role'] = $result_role;
    $this->load->model('M_notifikasi', 'm_notifikasi');
    $data['notif'] = $this->m_notifikasi->list()['data'];

    $this->load->view('components/header');
    $this->load->view('components/sidebar', $data);
    // $this->load->view('master_data/brand/form/brand_form');
    $this->load->view('master_data/master_instrument/master_instrument_index');
    $this->load->view('master_data/master_data');
    $this->load->view('components/footer');
    $this->load->view('components/sidebar_footer');
  }
}
