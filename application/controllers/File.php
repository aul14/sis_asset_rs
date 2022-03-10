<?php


defined('BASEPATH') or exit('No direct script access allowed');

class File extends CI_Controller
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
    // public function index()
    // {
    //     // $data = $this->session->userdata('assetFileUploads');
    //     // // $data['propAssetStockin'] = $this->session->userdata('assetStockIn');
    //     // // $data['propAssetStockout'] = $this->session->userdata('assetStockOut');

    //     // $group = $data;
    //     // // $data['propAssetStockin'] = $this->session->userdata('assetStockIn');
    //     // // echo json_encode($data);
    //     // echo "<pre>";
    //     // var_dump($group);
    //     // die;
    //     // echo "</pre>";
    // }
    public function format_file_list_session()
    {
        if (sizeof($_SESSION['assetFileUploads']) > 0) {
            foreach ($_SESSION['assetFileUploads'] as $key => $assetFileUploads) {
                $files['data'][] = [
                    'no'    => $key + 1,
                    'idAsset' => 0,
                    'propFile' => $assetFileUploads,
                    'propFileDesc' => $assetFileUploads['fileName'],
                    'propFileName' => $assetFileUploads['fileName'],
                    'data_null'     => ''
                ];
            }
        } else {
            $files['data'] = [];
        }

        return $files;
    }

    public function file_list_session()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        echo json_encode($this->format_file_list_session());
    }

    public function file_download($id_file)
    {
        $file = $this->m_file->fileDownload((int)$id_file);

        $resource = base_url() . $file['fileLocation'] . $file['fileName'];

        header("Content-Description: File Transfer");
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"" . basename($resource) . "\"");

        readfile($resource);
        exit();
    }

    public function delete_file_list_session($id_file)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $assetFileUploads = [];
        if (sizeof($_SESSION['assetFileUploads']) > 0) {
            foreach ($_SESSION['assetFileUploads'] as $key => $value) {

                if ($_SESSION['assetFileUploads'][$key]['idFile'] != $id_file) {

                    // delete file
                    $path = FCPATH . $value['fileLocation'] . $value['fileName'];
                    if (file_exists($path)) {
                        unlink($path);
                    }
                    // end delete file



                    $assetFileUploads[] = $value;
                }
            }
        }
        //remove data yg di database
        $this->m_file->fileRemove($id_file);

        $sukses = [
            'msg'    => 'sukses'
        ];
        // remove session asset file uploads data
        $session = $this->session->userdata();
        $session['assetFileUploads'] = $assetFileUploads;
        $this->session->set_userdata($session);
        // end remove session asset file uploads data

        // redirect($_SERVER['HTTP_REFERER']);
        echo json_encode($sukses);
    }

    public function file_upload($id_asset = NULL)
    {

        $filename = $_FILES['image']['name'];

        $dir = 'assets/upload/file/';

        if (!is_dir($dir)) {
            mkdir($dir, 0777, TRUE);
        }

        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        $target_file = $dir . basename($filename);


        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {

            $data = [
                'idCat' => $this->input->post('idCat'),
                'folder' => $dir,
                'files' => $dir . $filename,
                'userName' => $this->session->userdata('username')
            ];

            $file_upload = $this->m_file->fileUpload($data);

            if ($id_asset) {
                $insert = [
                    'idAsset' => $id_asset,
                    "idFile" => $file_upload['data']['idFile'],
                    "propFileName" => $file_upload['data']['fileName'],
                    "propFileDesc" => $file_upload['data']['fileName'],
                    "propFile" => $file_upload['data']
                ];

                $this->m_asset_propfiles->assetPropFilesInsert($insert);

                echo json_encode($file_upload, JSON_PRETTY_PRINT);
                die;
            }

            $asset_file_uploads = $this->session->userdata('assetFileUploads');

            $session = $this->session->userdata();
            $session['assetFileUploads'][] = $file_upload['data'];
            $session_asset_files = $this->session->set_userdata($session);

            echo json_encode($file_upload, JSON_PRETTY_PRINT);
            die;
        }
    }
}

/* End of file File.php */
