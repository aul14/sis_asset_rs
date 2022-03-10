<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Asset_propstock extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->simple_login->cek_login(); // cek login
        $this->load->model([
            'M_asset_master'        => 'm_asset_master',
            'M_brand'               => 'm_brand',
            'M_asset_propstock'               => 'm_asset_propstock',
        ]);
    }

    public function asset_propstock_in_by_id_asset($id_asset)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $asset_propstock = $this->m_asset_propstock->assetPropstockInByIdAsset($id_asset);

        echo json_encode($asset_propstock);
        exit;
    }

    public function asset_propstock_out_by_id_asset($id_asset)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $asset_propstock = $this->m_asset_propstock->assetPropstockOutByIdAsset($id_asset);

        echo json_encode($asset_propstock);
        exit;
    }
}

/* End of file Asset_propstock.php */
