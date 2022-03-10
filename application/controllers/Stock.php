<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Stock extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->simple_login->cek_login(); // cek login
        $this->load->model([
            'M_asset_master'        => 'm_asset_master',
            'M_brand'               => 'm_brand',
            'M_asset_propstock'               => 'm_asset_propstock',
            'M_asset_propbuilding_room'     => 'm_asset_propbuilding_room'
        ]);
    }

    // public function index()
    // {
    //     // $data = $this->session->userdata('assetStockIn');
    //     // // $data['propAssetStockin'] = $this->session->userdata('assetStockIn');
    //     // // $data['propAssetStockout'] = $this->session->userdata('assetStockOut');

    //     // $group = $data;
    //     // // $data['propAssetStockin'] = $this->session->userdata('assetStockIn');
    //     // // echo json_encode($data);
    //     // echo "<pre>";
    //     // var_dump($this->session->userdata('assetStockIn'));
    //     // die;
    //     // echo "</pre>";
    // }

    public function format_stock_session()
    {
        $no = 1;
        if (sizeof($_SESSION['assetStockIn']) > 0) {
            foreach ($_SESSION['assetStockIn'] as $key => $value) {
                $room = $this->m_asset_propbuilding_room->assetPropBuildingRoomById($value['idLocation']);
                $stocks['data'][] = [
                    'no'    => $no++,
                    'idLocation' => $value['idLocation'],
                    'propLocation' => $room['data'],
                    'inName' => $value['inName'],
                    'inDesc' => $value['inDesc'],
                    'inQty'  => $value['inQty'],
                    'lastUpdated'  => $value['lastUpdated'],
                ];
            }
        } else {
            $stocks['data'] = [];
        }

        return $stocks;
    }


    public function stock_list_session()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        echo json_encode($this->format_stock_session());
    }


    public function add_stock_in_session($id_asset = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        if ($id_asset) {
            $data_insert_stock = [
                'idAsset'         => $id_asset,
                'idLocation'      => $this->input->post('propAssetPropadmin_idRoom_stock'),
                'inName'     => htmlspecialchars($this->input->post('propAssetPropstock_stockName')),
                'inDesc'     => htmlspecialchars($this->input->post('propAssetPropstock_stockDesc')),
                'inQty'     => htmlspecialchars($this->input->post('propAssetPropstock_qtyCurrent')),
                'lastUpdated'     => date('Y-m-d H:i:s'),
            ];

            $this->m_asset_propstock->assetPropStockInInsert($data_insert_stock);

            echo json_encode($data_insert_stock, JSON_PRETTY_PRINT);
            die;
        } else {
            $data = [
                'idAsset'         => 0,
                'idLocation'      => $this->input->post('propAssetPropadmin_idRoom_stock'),
                'inName'     => $this->input->post('propAssetPropstock_stockName'),
                'inDesc'     => htmlspecialchars($this->input->post('propAssetPropstock_stockDesc')),
                'inQty'     => htmlspecialchars($this->input->post('propAssetPropstock_qtyCurrent')),
                'lastUpdated'     => date('Y-m-d H:i:s'),
            ];



            $this->session->userdata('assetStockIn');
            $session = $this->session->userdata();
            $session['assetStockIn'][] = $data;
            $this->session->set_userdata($session);

            echo json_encode($data, JSON_PRETTY_PRINT);
            die;
        }
    }

    public function delete_stock_in_session($lastUpdated)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $assetStock = [];
        if (sizeof($_SESSION['assetStockIn']) > 0) {
            foreach ($_SESSION['assetStockIn'] as $key => $value) {
                if (substr($_SESSION['assetStockIn'][$key]['lastUpdated'], 17) != $lastUpdated) {
                    $assetStock[] = $value;
                }
            }
        }
        $sukses = [
            'msg'    => 'sukses'
        ];
        // remove session asset file uploads data
        $session = $this->session->userdata();
        $session['assetStockIn'] = $assetStock;
        $this->session->set_userdata($session);
        echo json_encode($sukses);
    }

    public function delete_stock_in_data($id)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $result = $this->m_asset_propstock->assetPropStockInDelete($id);
        echo json_encode($result);
    }

    public function delete_stock_out_data($id)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $result = $this->m_asset_propstock->assetPropStockOutDelete($id);
        echo json_encode($result);
    }



    public function format_stock_out_session()
    {
        $no = 1;
        if (sizeof($_SESSION['assetStockOut']) > 0) {
            foreach ($_SESSION['assetStockOut'] as $key => $value) {
                $room = $this->m_asset_propbuilding_room->assetPropBuildingRoomById($value['idLocation']);
                $stocks['data'][] = [
                    'no'    => $no++,
                    'idLocation' => $value['idLocation'],
                    'propLocation' => $room['data'],
                    'outName' => $value['outName'],
                    'outDesc' => $value['outDesc'],
                    'outQty'  => $value['outQty'],
                    'lastUpdated'  => $value['lastUpdated'],
                ];
            }
        } else {
            $stocks['data'] = [];
        }

        return $stocks;
    }


    public function stock_list_out_session()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        echo json_encode($this->format_stock_out_session());
    }

    public function add_stock_out_session($id_asset = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        if ($id_asset) {
            $data_insert_stock = [
                'idAsset'         => $id_asset,
                'idLocation'      => $this->input->post('propAssetPropadmin_idRoom_stock'),
                'outName'     => htmlspecialchars($this->input->post('propAssetPropstock_stockName')),
                'outDesc'     => htmlspecialchars($this->input->post('propAssetPropstock_stockDesc')),
                'outQty'     => htmlspecialchars($this->input->post('propAssetPropstock_qtyCurrent')),
                'lastUpdated'     => date('Y-m-d H:i:s')
            ];

            $result =  $this->m_asset_propstock->assetPropStockOutInsert($data_insert_stock);

            echo json_encode($result, JSON_PRETTY_PRINT);
            die;
        } else {
            $data = [
                'idAsset'         => 0,
                'idLocation'      => $this->input->post('propAssetPropadmin_idRoom_stock'),
                'outName'     => htmlspecialchars($this->input->post('propAssetPropstock_stockName')),
                'outDesc'     => htmlspecialchars($this->input->post('propAssetPropstock_stockDesc')),
                'outQty'     => htmlspecialchars($this->input->post('propAssetPropstock_qtyCurrent')),
                'lastUpdated'     => date('Y-m-d H:i:s')
            ];

            $this->session->userdata('assetStockOut');
            $session = $this->session->userdata();
            $session['assetStockOut'][] = $data;
            $this->session->set_userdata($session);

            echo json_encode($data, JSON_PRETTY_PRINT);
            die;
        }
    }

    public function delete_stock_out_session($lastUpdated)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $assetStock = [];
        if (sizeof($_SESSION['assetStockOut']) > 0) {
            foreach ($_SESSION['assetStockOut'] as $key => $value) {
                if (substr($_SESSION['assetStockOut'][$key]['lastUpdated'], 17) != $lastUpdated) {

                    $assetStock[] = $value;
                }
            }
        }
        $sukses = [
            'msg'    => 'sukses'
        ];
        // remove session asset file uploads data
        $session = $this->session->userdata();
        $session['assetStockOut'] = $assetStock;
        $this->session->set_userdata($session);
        echo json_encode($sukses);
    }
}

/* End of file Stock.php */
