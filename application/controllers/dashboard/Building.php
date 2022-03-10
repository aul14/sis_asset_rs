<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Building extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->simple_login->cek_login(); // cek login

    $this->load->model([
      'M_asset_charts'  => 'm_asset_charts',
    ]);
  }


  public function index()
  {
    $result_role = $this->m_access_control->MyRole()['data']['roleACL'];

    $data['result_role'] = $result_role;
    $this->load->model('M_notifikasi', 'm_notifikasi');
    $data['notif'] = $this->m_notifikasi->list()['data'];

    if ($result_role[0]['subMenu1'][2]['isAllow'] != true) {
      exit('You dont have access!!');
    }

    $this->load->view('components/header');
    $this->load->view('components/sidebar', $data);
    $this->load->view('dashboard/building_dashboard/index_bld_dashboard');
    $this->load->view('components/footer');
    $this->load->view('components/sidebar_footer');
  }
  public function charts_data_year($dashType)
  {
    if ($dashType == 'assets') {
      $asset_depreciation = $this->m_asset_charts->asset_depreciation('BLD');

      $newarray = [];
      foreach ($asset_depreciation['data'] as $key => $value) {
        $newarray[] = $value['depreYear'];
      }
      array_unshift($newarray, 'ALL');
      $val = array_values(array_flip(array_flip($newarray)));
    } elseif ($dashType == 'calibration') {
      $task_calibration = $this->m_task_charts->task_calibration('BLD');

      $newarray = [];
      foreach ($task_calibration['data'] as $key => $value) {
        $newarray[] = $value['calibYear'];
      }
      array_unshift($newarray, 'ALL');
      $val = array_values(array_flip(array_flip($newarray)));
    } elseif ($dashType == 'inspection') {
      $task_calibration = $this->m_task_charts->task_inspection('BLD');

      $newarray = [];
      foreach ($task_calibration['data'] as $key => $value) {
        $newarray[] = $value['inspYear'];
      }
      array_unshift($newarray, 'ALL');
      $val = array_values(array_flip(array_flip($newarray)));
    } elseif ($dashType == 'maintenance') {
      $task_calibration = $this->m_task_charts->task_maintenance('BLD');

      $newarray = [];
      foreach ($task_calibration['data'] as $key => $value) {
        $newarray[] = $value['mtnYear'];
      }
      array_unshift($newarray, 'ALL');
      $val = array_values(array_flip(array_flip($newarray)));
    } else {
      $val = array('NO_DATA');
    }
    echo json_encode($val);
  }
  public function charts_asset_condition()
  {
    $asset_condition = $this->m_asset_charts->asset_condition('BLD')['data'];

    // echo json_encode($asset_condition);
    // die;
    return $asset_condition;
  }

  public function charts_asset_lifetime()
  {
    $asset_lifetime = $this->m_asset_charts->asset_lifetime('BLD')['data'];

    // echo json_encode($asset_lifetime);
    // die;
    return $asset_lifetime;
  }

  public function charts_asset_ownership()
  {
    $asset_ownership = $this->m_asset_charts->asset_ownership('BLD')['data'];

    // echo json_encode($asset_ownership);
    // die;
    return   $asset_ownership;
  }

  public function charts_asset_depreciation()
  {
    $asset_depreciation = $this->m_asset_charts->asset_depreciation('BLD')['data'];

    // echo json_encode($asset_depreciation);
    // die;
    return $asset_depreciation;
  }
  public function charts_data($dashType)
  {
    if ($dashType == 'assets') {

      $data = array(
        'assets' => array(
          'asset_condition' => $this->charts_asset_condition(),
          'asset_lifetime' => $this->charts_asset_lifetime(),
          'asset_ownership' => $this->charts_asset_ownership(),
          'asset_investment' => $this->charts_asset_depreciation()
        )
      );
    } else {
      $data = array('NO_DATA');
    }
    echo json_encode($data);
  }
}

/* End of file Building.php */
