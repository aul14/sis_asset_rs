<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->simple_login->cek_login(); // cek login
    $this->load->model([
      'M_user'                => 'm_user',
      'M_file'                => 'm_file'
    ]);
  }


  public function index()
  {
    $token = $this->session->userdata('token');
    $result_role = $this->m_access_control->MyRole()['data']['roleACL'];

    $data['result_role'] = $result_role;


    $this->load->model('M_notifikasi', 'm_notifikasi');
    $data['notif'] = $this->m_notifikasi->list()['data'];


    // echo json_encode($token);
    // die;

    // echo "Anda berhasil login dengan nomor " . $token;
    $this->load->view('components/header');
    $this->load->view('components/sidebar', $data);
    $this->load->view('modal_show/popup_task');
    $this->load->view('modal_show/rating');
    $this->load->view('dashboard/home', $data);
    $this->load->view('components/footer');
    $this->load->view('components/sidebar_footer');
  }

  public function fetch()
  {
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }
    $user = $this->m_user->userById($this->session->userdata('id_user'))['data'];

    if ($user['propFile']['idFile'] == 0) {
      $picture = 'assets/images/users/avataruser.jpg';
      $show['picture'] =  base_url() . $picture;
    } else {
      $picture = $this->m_file->fileBase64($user['idFilePict'])['data'];
      $show['picture'] = "data:image/png;base64,"  . $picture;
    }

    $data = [
      // 'shortcut' => [
      //   0 => [
      //     'id' => 1,
      //     'menu_name' => 'Inventory',
      //     'type' => 'ASSETS',
      //     'parent' => 'MED',
      //     'icon' => 'fas fa-archive',
      //     'link' => base_url() . '/',
      //   ],
      //   1 => [
      //     'id' => 2,
      //     'menu_name' => 'Sparepart & Disposable',
      //     'type' => 'ASSETS',
      //     'parent' => 'MED',
      //     'icon' => 'fas fa-wrench',
      //     'link' => base_url() . '/',
      //   ],
      //   2 => [
      //     'id' => 3,
      //     'menu_name' => 'Inventory',
      //     'type' => 'ASSETS',
      //     'parent' => 'NON',
      //     'icon' => 'fas fa-archive',
      //     'link' => base_url() . '/',
      //   ],
      //   3 => [
      //     'id' => 4,
      //     'menu_name' => 'Sparepart & Disposable',
      //     'type' => 'ASSETS',
      //     'parent' => 'NON',
      //     'icon' => 'fas fa-wrench',
      //     'link' => base_url() . '/',
      //   ],
      //   4 => [
      //     'id' => 5,
      //     'menu_name' => 'Inspection',
      //     'type' => 'TASK',
      //     'parent' => 'MED',
      //     'icon' => 'fas fa-check',
      //     'link' => base_url() . '/',
      //   ],
      //   5 => [
      //     'id' => 6,
      //     'menu_name' => 'Maintenance',
      //     'type' => 'TASK',
      //     'parent' => 'MED',
      //     'icon' => 'fas fa-toolbox',
      //     'link' => base_url() . '/',
      //   ],
      //   6 => [
      //     'id' => 7,
      //     'menu_name' => 'Complain',
      //     'type' => 'TASK',
      //     'parent' => 'MED',
      //     'icon' => 'fas fa-bullhorn',
      //     'link' => base_url() . '/',
      //   ],
      //   7 => [
      //     'id' => 8,
      //     'menu_name' => 'Inspection',
      //     'type' => 'TASK',
      //     'parent' => 'MED',
      //     'icon' => 'fas fa-tools',
      //     'link' => base_url() . '/',
      //   ],
      //   8 => [
      //     'id' => 9,
      //     'menu_name' => 'Inspection',
      //     'type' => 'TASK',
      //     'parent' => 'NON',
      //     'icon' => 'fas fa-check',
      //     'link' => base_url() . '/',
      //   ],
      //   9 => [
      //     'id' => 10,
      //     'menu_name' => 'Maintenance',
      //     'type' => 'TASK',
      //     'parent' => 'NON',
      //     'icon' => 'fas fa-toolbox',
      //     'link' => base_url() . '/',
      //   ],
      //   10 => [
      //     'id' => 11,
      //     'menu_name' => 'Complain',
      //     'type' => 'TASK',
      //     'parent' => 'NON',
      //     'icon' => 'fas fa-bullhorn',
      //     'link' => base_url() . '/',
      //   ],
      //   11 => [
      //     'id' => 12,
      //     'menu_name' => 'Inspection',
      //     'type' => 'TASK',
      //     'parent' => 'NON',
      //     'icon' => 'fas fa-tools',
      //     'link' => base_url() . '/',
      //   ],
      //   12 => [
      //     'id' => 13,
      //     'menu_name' => 'Contact',
      //     'type' => 'GENERAL',
      //     'parent' => '',
      //     'icon' => 'fas fa-id-card',
      //     'link' => base_url() . 'contact/',
      //   ],
      // ],
      'info' => [
        'id' =>  $this->session->userdata('id_user'),
        'email' => $user['userMail'],
        'username' => $user['userFullName'],
        'role' => $user['propRole']['roleName'],
        'picture' => $show['picture']
      ]
    ];
    echo json_encode($data);
  }
}

/* End of file Home.php */
