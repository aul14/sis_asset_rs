<?php

defined('BASEPATH') or exit('No direct script access allowed');


class Invalid extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->output->set_status_header('404');
        $this->load->view('error404'); //loading in custom error view
    }
}


/* End of file filename.php */
