<?php


defined('BASEPATH') or exit('No direct script access allowed');

// use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\{QRCode, QROptions};

class Qr_print extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->simple_login->cek_login(); // cek login
        $this->load->model([
            'M_asset'               => 'm_asset',
            'M_asset_category'      => 'm_asset_category',
            'M_asset_master'        => 'm_asset_master',
            'M_brand'               => 'm_brand',
            'M_contact'                     => 'm_contact',
            'M_funding'                     => 'm_funding',
            'M_file'                    => 'm_file',
            'M_file_cat'                    => 'm_file_cat',
            'M_asset_propbuilding_room'     => 'm_asset_propbuilding_room',
            'M_asset_propadmin'             => 'm_asset_propadmin',
            'M_asset_propaspak'             => 'm_asset_propaspak',
            'M_asset_propbuilding'          => 'm_asset_propbuilding',
            'M_asset_propelectrical'          => 'm_asset_propelectrical',
            'M_asset_propgenit'          => 'm_asset_propgenit',
            'M_asset_propinstrument'          => 'm_asset_propinstrument',
            'M_asset_propland'          => 'm_asset_propland',
            'M_asset_propsimak'          => 'm_asset_propsimak',
            'M_asset_propmedeq'          => 'm_asset_propmedeq',
            'M_master_simak'          => 'm_master_simak',
            'M_asset_proptax'          => 'm_asset_proptax',
            'M_asset_proptax_other'          => 'm_asset_proptax_other',
            'M_asset_propvehicle'          => 'm_asset_propvehicle',
            'M_asset_propbuilding_floor'          => 'm_asset_propbuilding_floor',
            'M_asset_proplicense'          => 'm_asset_proplicense'
        ]);
    }

    public function fullsize_qr()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        // $asset_list = [];
        $asset_list = $this->input->post('assetList');
        // }
        if (!empty($this->input->post('assetList'))) {
            $data_list = [];
            foreach ($asset_list as $field) {
                $data_list[] = $this->m_asset->assetById($field)['data'];
            }

            $data['data_list'] = $data_list;
            // echo json_encode($data);
            // die;
            $this->load->view('assets/qr/print_qr', $data);
        } else if (isset($this->input->post()['roomList'])) {
            $room_list = $this->input->post('roomList');

            $data_room = [];
            foreach ($room_list as $field) {
                $data_room[] = $this->m_asset_propbuilding_room->assetPropBuildingRoomById($field)['data'];
            }

            $data['data_room_list'] = $data_room;

            // echo json_encode($data);
            // die;
            $this->load->view('assets/qr/print_qr', $data);
        }
    }

    public function smallsize_qr()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        // $asset_list = [];
        $asset_list = $this->input->post('assetList');
        if (!empty($this->input->post('assetList'))) {
            $data_list = [];
            foreach ($asset_list as $field) {
                $data_list[] = $this->m_asset->assetById($field)['data'];
            }

            $data['data_list'] = $data_list;

            // echo json_encode($data);
            // die;
            $this->load->view('assets/qr/print_qr_small', $data);
        } else if (isset($this->input->post()['roomList'])) {
            $room_list = $this->input->post('roomList');

            $data_room = [];
            foreach ($room_list as $field) {
                $data_room[] = $this->m_asset_propbuilding_room->assetPropBuildingRoomById($field)['data'];
            }

            $data['data_room_list'] = $data_room;

            // echo json_encode($data);
            // die;
            $this->load->view('assets/qr/print_qr_small', $data);
        }
    }
}

/* End of file qr_print.php */
