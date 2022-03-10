<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Notifikasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->simple_login->cek_login(); // cek login
        $this->load->model('M_notifikasi', 'm_notifikasi');
    }

    public function read()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $idNotif = trim($this->input->post('idNotif'));

        $notif = $this->m_notifikasi->read($idNotif);

        echo json_encode($notif);
        die;
    }
}

/* End of file Notifikasi.php */
