<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Master_brand extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->simple_login->cek_login(); // cek login
        $this->load->model([
            'M_brand'      => 'm_brand'
        ]);
    }


    public function index()
    {
    }

    public function ajax_add_brand()
    {
        $brandName = htmlspecialchars($this->input->post('brandName'));

        $data = [
            'brandName'     => htmlspecialchars($brandName)
        ];

        $insert = $this->m_brand->brandInsert($data);
        echo json_encode($insert['queryResult']);
        exit;
    }
}

/* End of file Master_brand.php */
