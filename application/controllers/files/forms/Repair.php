<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Repair extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->simple_login->cek_login(); // cek login
    }


    public function index()
    {
      $this->load->view('components/header');
      $this->load->view('components/sidebar');
      $this->load->view('files/forms/form/repair_form');
      $this->load->view('files/forms/form_repair_index');
      $this->load->view('files/files');
      $this->load->view('components/footer');
      $this->load->view('components/sidebar_footer');
    }

}
