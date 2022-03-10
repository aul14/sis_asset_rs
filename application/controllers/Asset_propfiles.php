<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Asset_propfiles extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->simple_login->cek_login(); // cek login
        $this->load->model([
            'M_file'       => 'm_file',
            'M_asset_propfiles'       => 'm_asset_propfiles',
        ]);
    }

    public function asset_propfiles_by_id_asset($id_asset)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $asset_propfiles = $this->m_asset_propfiles->assetPropFilesByIdAsset($id_asset);

        echo json_encode($asset_propfiles);
        exit;
    }

    public function asset_propfiles_delete_by_id_file($id_file)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $asset_propfiles = $this->m_asset_propfiles->assetPropFilesDeleteByIdFile($id_file);

        echo json_encode($asset_propfiles);
        exit;
    }
}

/* End of file Asset_propfiles.php */
