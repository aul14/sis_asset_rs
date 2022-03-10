<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Non extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->simple_login->cek_login(); // cek login

        $this->load->model([
            'M_asset_charts'  => 'm_asset_charts',
            'M_task_charts' => 'm_task_charts'
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
        $this->load->view('dashboard/non_medical_dashboard/index_nmd_dashboard');
        $this->load->view('components/footer');
        $this->load->view('components/sidebar_footer');
    }
    public function charts_data_year($dashType)
    {
        if ($dashType == 'assets') {
            $asset_depreciation = $this->m_asset_charts->asset_depreciation('NON');

            $newarray = [];
            foreach ($asset_depreciation['data'] as $key => $value) {
                $newarray[] = $value['depreYear'];
            }
            array_unshift($newarray, 'ALL');
            $val = array_values(array_flip(array_flip($newarray)));
        } elseif ($dashType == 'calibration') {
            $task_calibration = $this->m_task_charts->task_calibration('NON');

            $newarray = [];
            foreach ($task_calibration['data'] as $key => $value) {
                $newarray[] = $value['calibYear'];
            }
            array_unshift($newarray, 'ALL');
            $val = array_values(array_flip(array_flip($newarray)));
        } elseif ($dashType == 'inspection') {
            $task_inspection = $this->m_task_charts->task_inspection('NON');

            $newarray = [];
            foreach ($task_inspection['data'] as $key => $value) {
                $newarray[] = $value['inspYear'];
            }
            array_unshift($newarray, 'ALL');
            $val = array_values(array_flip(array_flip($newarray)));
        } elseif ($dashType == 'maintenance') {
            $task_maintenance = $this->m_task_charts->task_maintenance('NON');

            $newarray = [];
            foreach ($task_maintenance['data'] as $key => $value) {
                $newarray[] = $value['mtnYear'];
            }
            array_unshift($newarray, 'ALL');
            $val = array_values(array_flip(array_flip($newarray)));
        } elseif ($dashType == 'complain_repair') {
            $task_complain_repair = $this->m_task_charts->task_complain_repair('NON');

            $newarray = [];
            foreach ($task_complain_repair['data'] as $key => $value) {
                $newarray[] = $value['cplYear'];
            }
            array_unshift($newarray, 'ALL');
            $val = array_values(array_flip(array_flip($newarray)));
        } elseif ($dashType == 'mutation') {
            $task_mutation = $this->m_task_charts->task_mutation('NON');

            $newarray = [];
            foreach ($task_mutation['data'] as $key => $value) {
                $newarray[] = $value['mutYear'];
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
        $asset_condition = $this->m_asset_charts->asset_condition('NON')['data'];

        // echo json_encode($asset_condition);
        // die;
        return $asset_condition;
    }

    public function charts_asset_lifetime()
    {
        $asset_lifetime = $this->m_asset_charts->asset_lifetime('NON')['data'];

        // echo json_encode($asset_lifetime);
        // die;
        return $asset_lifetime;
    }

    public function charts_asset_ownership()
    {
        $asset_ownership = $this->m_asset_charts->asset_ownership('NON')['data'];

        // echo json_encode($asset_ownership);
        // die;
        return   $asset_ownership;
    }

    public function charts_asset_depreciation()
    {
        $asset_depreciation = $this->m_asset_charts->asset_depreciation('NON')['data'];

        // echo json_encode($asset_depreciation);
        // die;
        return $asset_depreciation;
    }

    public function charts_data($dashType)
    {
        if ($dashType == 'assets') {
            // $asset_condition = $this->m_asset_charts->asset_condition('NON');
            // $asset_lifetime = $this->m_asset_charts->asset_lifetime('NON');
            // $asset_ownership = $this->m_asset_charts->asset_ownership('NON');
            // $asset_depreciation = $this->m_asset_charts->asset_depreciation('NON');

            $data = array(
                'assets' => array(
                    'asset_condition' => $this->charts_asset_condition(),
                    'asset_lifetime' => $this->charts_asset_lifetime(),
                    'asset_ownership' => $this->charts_asset_ownership(),
                    'asset_investment' => $this->charts_asset_depreciation()
                )
            );
        } elseif ($dashType == 'calibration') {
            $task_calibration = $this->m_task_charts->task_calibration('NON');

            $data = array('calibration' => $task_calibration['data'],);
        } elseif ($dashType == 'inspection') {
            $task_inspection = $this->m_task_charts->task_inspection('NON');

            $data = array('inspection' => $task_inspection['data'],);
        } elseif ($dashType == 'maintenance') {
            $task_maintenance = $this->m_task_charts->task_maintenance('NON');

            $data = array('maintenance' => $task_maintenance['data'],);
        } elseif ($dashType == 'complain_repair') {
            $task_complain_repair = $this->m_task_charts->task_complain_repair('NON');

            $data = array('complain_repair' => $task_complain_repair['data'],);
        } elseif ($dashType == 'mutation') {
            $task_mutation = $this->m_task_charts->task_mutation('NON');

            $data = array('mutation' => $task_mutation['data']);
        } else {
            $data = array('NO_DATA');
        }
        echo json_encode($data);
    }
}

/* End of file Non.php */
