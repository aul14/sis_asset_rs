<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Instrument extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->simple_login->cek_login(); // cek login
        $this->load->model([
            'M_asset_master'        => 'm_asset_master',
            'M_brand'               => 'm_brand',
            'M_asset'               => 'm_asset'
        ]);
    }

    // public function index()
    // {
    //     echo "<pre>";
    //     var_dump($this->session->userdata('assetInstrument'));
    //     die;
    //     echo "</pre>";
    // }

    public function delete_instrument_list_session($idAssetMaster)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $assetInstrument = [];
        if (sizeof($_SESSION['assetInstrument']) > 0) {
            foreach ($_SESSION['assetInstrument'] as $key => $value) {

                if ($_SESSION['assetInstrument'][$key]['idAssetMaster'] != $idAssetMaster) {

                    $assetInstrument[] = $value;
                }
            }
        }
        // remove session asset file uploads data
        $session = $this->session->userdata();
        $session['assetInstrument'] = $assetInstrument;
        $this->session->set_userdata($session);
        // end remove session asset file uploads data

        $msg['msg']     = 'sukses';

        // redirect($_SERVER['HTTP_REFERER']);
        echo json_encode($msg);
    }

    public function instrument_modal_list()
    {
        // $idAssetMasters = empty($this->input->post('idAssetMasters')) ? [] : $this->input->post('idAssetMasters');

        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $idAssetMaster = $this->input->post('idAssetMaster');
        $draw   = $this->input->post('draw');
        $start  = $this->input->post('start');
        $length = $this->input->post('length') ? $this->input->post('length') : 1;


        // $assetInstrument = empty($this->session->userdata('assetInstrument')) ? [] : $this->session->userdata('assetInstrument');
        // $idAssetMasters = array_merge($idAssetMasters, $assetInstrument);

        $idAssetMasters = [];
        $qty_ins = [];
        $price_ins = [];
        if (sizeof($_SESSION['assetInstrument']) > 0) {
            foreach ($_SESSION['assetInstrument'] as $key => $value) {
                $idAssetMasters[] = $value['idAssetMaster'];
                $qty_ins[] = $value['qty'];
                $price_ins[] = $value['price'];
            }
        }

        $search = str_replace("'", "", strtolower($this->input->post('search')['value']));
        $searchTerms = explode(" ",  $search);
        $orderColumn = isset($this->input->post('order')[0]['column']) ? $this->input->post('order')[0]['column'] : '';
        $dir = isset($this->input->post('order')[0]['dir']) ? $this->input->post('order')[0]['dir'] : '';

        $array = [];
        if ($searchTerms) {
            foreach ($searchTerms as $searchTerm) {
                $array['search'] = $searchTerm;
            }
        }

        if ($dir === 'asc') {
            $array['order'] = 'desc';
        }

        $query_params = [];
        $query_params_like_or = [];

        if ($array['search'] != '') {

            $ecriCode_query_params = [
                "column" => "ecriCode",
                "value" => $array['search']
            ];
            array_push($query_params_like_or, $ecriCode_query_params);

            $simakCode_query_params = [
                "column" => "simakCode",
                "value" => $array['search']
            ];
            array_push($query_params_like_or, $simakCode_query_params);

            $aspakCode_query_params = [
                "column" => "aspakCode",
                "value" => $array['search']
            ];
            array_push($query_params_like_or, $aspakCode_query_params);
            $catCode_query_params = [
                "column" => "catCode",
                "value" => $array['search']
            ];
            array_push($query_params_like_or, $catCode_query_params);
            $assetMasterName_query_params = [
                "column" => "assetMasterName",
                "value" => $array['search']
            ];
            array_push($query_params_like_or, $assetMasterName_query_params);
        }

        $query_groups_like_or = [];
        // $query_groups = [];

        $query_groups = [
            [
                "queryMethod" => "EXACTOR",
                "queryParams" => [
                    [
                        "column" => "catCode",
                        "value" => "MINS"
                    ],
                ]
            ]
        ];

        if ($array['search'] != '') {
            $query_groups_like_or = [
                [
                    "queryMethod" => "LIKEOR",
                    "queryParams" => $query_params_like_or
                ]
            ];
        }

        $merge_query_groups = array_merge($query_groups, $query_groups_like_or);

        $count = $this->m_asset_master->assetMasterQuery(
            [
                "queryGroupMethod" => "AND",
                "queryGroups" => $merge_query_groups ? $merge_query_groups : [],
                'page' => 1,
                'limit' => 1
            ]
        );
        $totalFiltered = $count['dataCount'];

        $page = ($start / $length) + 1;

        $request = [
            "queryGroupMethod" => "AND",
            "queryGroups" => $merge_query_groups ? $merge_query_groups : [],
            "sortingParams" => [
                [
                    "column" => "idAssetMaster",
                    "value" => "desc"
                ]
            ],
            "page" =>  $page,
            "limit" =>  isset($length) ? (int)$length : 10
        ];

        $posts = $this->m_asset_master->assetMasterQuery($request);

        if (sizeof($posts) > 0) {
            $no = $start + 1;
            foreach ($posts['data'] as $key => $value) {
                $valIdAssetMaster = $value['idAssetMaster'];
                $NameAssetMaster = $value['assetMasterName'];

                if ($idAssetMaster == $valIdAssetMaster) {
                    $checked = 'checked';
                } else {
                    $checked = '';
                }

                $check_box_checked = '';
                $qty_val = '';
                $price_val = '';
                if (count($idAssetMasters) > 0) {
                    if (in_array($valIdAssetMaster, $idAssetMasters)) {
                        $check_box_checked = 'checked';
                    }
                }

                $check_box = "<input {$check_box_checked} type='checkbox' id='data' name='idAssetMaster' class='checkboxes' value='{$valIdAssetMaster}' />";
                $alias_name = "<input type='text' id='assetName_instrument_{$valIdAssetMaster}' name='assetName_instrument' value='{$NameAssetMaster}' />";
                $qty = "<input type='number' id='qty_instrument_{$valIdAssetMaster}' name='qty_instrument' />";
                $price = "<input type='number' id='price_instrument_{$valIdAssetMaster}' name='price_instrument' />";
                $posts['data'][$key]['radioButton'] = "<input {$checked} type='radio' class='radioButtonAsset' id='radio{$no}' name='radio' value='{$valIdAssetMaster}'>";

                $posts['data'][$key]['no'] = $no;
                $posts['data'][$key]['check_box'] = $check_box;
                $posts['data'][$key]['alias_name'] = $alias_name;
                $posts['data'][$key]['qty'] = $qty;
                $posts['data'][$key]['price'] = $price;

                $no++;
            }
        }

        $json_data = [
            "page"            => $page,
            "limit"           => $length,
            "draw"            => $draw,
            "recordsTotal"    => $totalFiltered,
            "recordsFiltered" => $totalFiltered,
            "data"            => $posts['data'],
            "search"          => isset($array['search']) ?  $array['search'] : '',
            "query_groups"    => $request,
            "query_message"   => $posts['queryMessage'],
        ];

        echo json_encode($json_data);
    }

    public function prop_child_instrument($id_asset)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $data_instrument = $this->m_asset->assetById($id_asset);
        if (sizeof($data_instrument['data']) > 0) {
            $no = 1;
            foreach ($data_instrument['data']['propChildAsset'] as $key => $val) {
                $data_master_id = $this->m_asset_master->assetMasterByID($val['idAssetMaster']);
                $instrument['data'][] = [
                    'no'    => $no++,
                    'instrument_set_name' => $data_master_id['data']['assetMasterName'],
                    'idAssetMaster' => $val['idAssetMaster'],
                    'alias_name' => $val['childName'],
                    'qty' => $val['qty'],
                    'price' => $val['price'],
                    'data_btn'     => '<a onClick="return delete_confirmation_instrument(event, ' . $val['idAsset'] . ')" href="javascript:void(0);"  class="btn-deletefile btn btn btn-rounded btn-outline-danger mr-2 btn-sm" > <i class="ti-trash"></i></a>'
                ];
            }
        } else {
            $instrument['data'] = [];
        }

        echo json_encode($instrument);
        exit;
    }

    public function format_instrument_list_session()
    {
        if (sizeof($_SESSION['assetInstrument']) > 0) {
            $no = 1;
            foreach ($_SESSION['assetInstrument'] as $key => $assetInstrument) {
                $data_master_id = $this->m_asset_master->assetMasterByID($assetInstrument['idAssetMaster']);
                // $data_brand_id = $this->m_brand->brandById($assetInstrument['propAssetPropgenit_merk_instrument']);
                $instrument['data'][] = [
                    'no'    => $no++,
                    'instrument_set_name' => $data_master_id['data']['assetMasterName'],
                    'idAssetMaster' => $assetInstrument['idAssetMaster'],
                    'alias_name' => $assetInstrument['childName'],
                    'qty' => $assetInstrument['qty'],
                    'price' => $assetInstrument['price'],
                    // 'ajax_merk' => $data_brand_id['data']['brandName'],
                    'data_btn'     => '<a onClick="return delete_confirmation_instrument(event, ' . $assetInstrument['idAssetMaster'] . ')" href="javascript:void(0);"  class="btn-deletefile btn btn btn-rounded btn-outline-danger mr-2 btn-sm" > <i class="ti-trash"></i></a>'
                ];
            }
        } else {
            $instrument['data'] = [];
        }

        return $instrument;
    }

    public function ajax_instrument_master_add($id_asset = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        if ($id_asset) {
            $data = [
                'idAsset'       => $id_asset,
                'idAssetMaster'               => $this->input->post('idAssetMaster'),
                'catCode'                  => "MINS",
                'childName'                  => $this->input->post('assetName_instrument'),
                'qty'                  => $this->input->post('qty_instrument'),
                'price'                  => $this->input->post('price_instrument'),
                // 'propAssetPropgenit_merk_instrument'     => $this->input->post('propAssetPropgenit_merk_instrument'),
            ];
        } else {
            $data_no = [
                'idAssetMaster'               => $this->input->post('idAssetMaster'),
                'catCode'                  => "MINS",
                'childName'                  => $this->input->post('assetName_instrument'),
                'merk'                  => $this->input->post('merk_instrument'),
                'tipe'                  => $this->input->post('tipe_instrument'),
                'sn'                  => $this->input->post('sn_instrument'),
                'qty'                  => $this->input->post('qty_instrument'),
                'price'                  => $this->input->post('price_instrument'),
                // 'propAssetPropgenit_merk_instrument'     => $this->input->post('propAssetPropgenit_merk_instrument'),
            ];


            $this->session->userdata('assetInstrument');
            $session = $this->session->userdata();
            $session['assetInstrument'][] = $data_no;
            $this->session->set_userdata($session);

            echo json_encode($data_no, JSON_PRETTY_PRINT);
            die;
        }
    }

    // public function ajax_instrument_master_delete()
    // {
    //     if (!$this->input->is_ajax_request()) {
    //         exit('No direct script access allowed');
    //     }

    //     $idAssetMaster = empty($this->input->post('idAssetMaster')) ? 0 : $this->input->post('idAssetMaster');

    //     // echo json_encode($idAssetMaster); die();

    //     $idAssetMastersSession = empty($this->session->userdata('assetInstrument')) ? [] : $this->session->userdata('assetInstrument');

    //     $newIdAssetMastersSession = [];
    //     foreach ($idAssetMastersSession as $k => $v) {
    //         if ($v['idAssetMaster'] != $idAssetMaster) {
    //             $newIdAssetMastersSession[] = $v['idAssetMaster'];
    //         }
    //     }

    //     $this->session->unset_userdata('assetInstrument');

    //     $result['assetInstrument'] = $newIdAssetMastersSession;

    //     $this->session->set_userdata($result);

    //     echo json_encode($idAssetMastersSession);
    // }


    public function instrument_list_session()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        echo json_encode($this->format_instrument_list_session());
        die;
    }

    // public function ajax_instrument_master_add()
    // {
    //     $data = [
    //         'idAssetMaster'               => $this->input->post('idAssetMaster'),
    //         'assetName_instrument'                  => $this->input->post('assetName_instrument'),
    //         // 'propAssetPropgenit_merk_instrument'     => $this->input->post('propAssetPropgenit_merk_instrument'),
    //     ];

    //     $asset_instrument = $this->session->userdata('assetInstrument');
    //     $session = $this->session->userdata();
    //     $session['assetInstrument'][] = $data;
    //     $this->session->set_userdata($session);

    //     echo json_encode($data, JSON_PRETTY_PRINT);
    //     die;
    // }
}

/* End of file Instrument.php */
