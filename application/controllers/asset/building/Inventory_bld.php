<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Inventory_bld extends CI_Controller
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
        ]);
    }

    public function index()
    {
        // function menampilkan data asset kategori

        $query_groups = [
            [
                "queryMethod" => "EXACTAND",
                "queryParams" => [
                    [
                        "column" => "sysCatName",
                        "value" => "BLD"
                    ],
                ]
            ],
            [
                "queryMethod" => "EXACTOR",
                "queryParams" => [
                    [
                        "column" => "subSysCat",
                        "value" => "BLDG"
                    ],
                    [
                        "column" => "subSysCat",
                        "value" => "FLOR"
                    ]
                ]
            ]
        ];

        $data_request = [
            "queryGroupMethod" => "AND",
            "queryGroups" => $query_groups
        ];

        $result = $this->m_asset_category->assetCatQuery($data_request);
        // end

        // function menampilkan data funding
        $result_funding = $this->m_funding->fundingList();
        // end


        $data = [
            'data_kategori' => $result['data'],
            'data_funding'  => $result_funding['data']
        ];

        $vmode = $this->input->get('vmode') ? $this->input->get('vmode') : '';

        switch ($vmode) {
            case "Inventory":
                $data['columns'] = [
                    'Code',
                    // 'Simak Code',
                    'Asset Name', 'Address', 'Phone', 'Flour Amount',  'Surface Area', 'Building Area', 'Present Date',
                    'Calculation Date', 'Residual Value', 'Yearly Depreciation', 'Procurement Year', 'Purchase Price', 'Expectation Life Time',
                    'Present Date', 'Accumulated Depreciation', 'Book Values'
                ];

                $data['rows'] = [
                    'assetCode',
                    // 'propAssetPropsimak.simakCode',
                    'assetName', 'propAssetPropbuilding.buildingDesc', 'propAssetPropbuilding.phone', 'flourAmount',
                    'propAssetPropbuilding.luasTanah', 'propAssetPropbuilding.luasBangunan', 'propAssetProptax.presentDate',
                    'propAssetProptax.calcStart', 'residuVal', 'yearlyDep', 'propAssetPropadmin.procureDate', 'cost', 'expectedLifeTime',
                    'propAssetProptax.presentDate', 'accuVal', 'bookVal'
                ];
                break;
            case "Aspak":
                $data['columns'] = [
                    'Code',
                    // 'Simak Code', 
                    'Label Code', 'Aspak Code', 'Asset Name', 'Year Procurement', 'Condition',
                    'LAST CALIBRATED'
                ];

                $data['rows'] = [
                    'assetCode',
                    // 'propAssetPropsimak.simakCode',
                    'kodeBar', 'propAssetMaster.aspakCode', 'assetName',
                    'propAssetPropadmin.yearProcurement', 'propAssetPropadmin.condition', 'lastCalibrated',
                ];

                break;
            case "Finance":
                $data['columns'] = [
                    'Code', 'Asset Name',  'Present Date',
                    'Yearly Depreciation', 'Procurement Year', 'Purchase Price', 'Expectation Life Time',
                    'Present Date', 'Accumulated Depreciation', 'Book Values'
                ];

                $data['rows'] = [
                    'assetCode', 'assetName', 'propAssetProptax.presentDate',
                    'yearlyDep', 'propAssetPropadmin.procureDate', 'cost', 'expectedLifeTime',
                    'propAssetProptax.presentDate', 'accuVal', 'bookVal'
                ];

                break;

            case "Utilization":
                $data['columns'] = ['Code', 'Asset Name', 'Condition'];
                $data['rows'] = [
                    'assetCode', 'assetName', 'propAssetPropadmin.condition',
                ];

                break;
            case "Performance":
                $data['columns'] = ['Code', 'Asset Name', 'Status'];
                $data['rows'] = [
                    'assetCode', 'assetName', 'propAssetPropadmin.status',
                ];

                break;
            default:
                $data['columns'] = [
                    'Code',
                    // 'Simak Code',
                    'Asset Name', 'Address', 'Phone', 'Flour Amount',  'Surface Area', 'Building Area', 'Present Date',
                    'Calculation Date', 'Residual Value', 'Yearly Depreciation', 'Procurement Year', 'Purchase Price', 'Expectation Life Time',
                    'Present Date', 'Accumulated Depreciation', 'Book Values'
                ];

                $data['rows'] = [
                    'assetCode',
                    // 'propAssetPropsimak.simakCode',
                    'assetName', 'propAssetPropbuilding.buildingDesc', 'propAssetPropbuilding.phone', 'flourAmount',
                    'propAssetPropbuilding.luasTanah', 'propAssetPropbuilding.luasBangunan', 'propAssetProptax.presentDate',
                    'propAssetProptax.calcStart', 'residuVal', 'yearlyDep', 'propAssetPropadmin.procureDate', 'cost', 'expectedLifeTime',
                    'propAssetProptax.presentDate', 'accuVal', 'bookVal'
                ];
        }

        // $data_explode = $data['columns'];

        $result_role = $this->m_access_control->MyRole()['data']['roleACL'];

        $data['result_role'] = $result_role;
        $this->load->model('M_notifikasi', 'm_notifikasi');
        $data['notif'] = $this->m_notifikasi->list()['data'];

        if ($result_role[1]['subMenu1'][2]['subMenu2'][0]['isAllow'] != true) {
            exit('You dont have access!!');
        }

        $this->load->view('components/header');
        $this->load->view('components/sidebar', $data);
        $this->load->view('assets/building/inventory_bld_index', $data);
        $this->load->view('assets/building/form/bld_form');
        $this->load->view('assets/building/details/inventory_details');
        $this->load->view('assets/building/print/assets_print_inv_bld');
        $this->load->view('components/sidebar_footer');
        $this->load->view('components/footer');
        $this->load->view('assets/assets_inv_bld');

        // var_dump($this->session->userdata('token'));
        // die;
    }

    public function store()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $input = $this->security->xss_clean($this->input->post());

        $catCode =  $this->security->xss_clean($this->input->post('catcode_kategori'));
        $catCodes = $this->input->post('catCodes');

        // get field asset
        $asset = $this->m_asset->data(
            !empty($input['idAsset']) ? $input['idAsset'] : 0,
            $catCode,
            !empty($input['idAssetMaster']) ? $input['idAssetMaster'] : 0,
            !empty($input['parentAssetID']) ? $input['parentAssetID'] : 0,
            $input['assetName'],
            $input['assetDesc'],
            $createDate = date('Y-m-d H:i:s'),
            $selected = 0,
            $noUrut = 0,
            $assetCode = '',
            $oldID = 0,
            !empty($input['otherCode1']) ? $input['otherCode1'] : '',
            !empty($input['otherCode2']) ? $input['otherCode2'] : '',
            !empty($input['kodeAlat']) ? $input['kodeAlat'] : '',
            !empty($input['kodeTera']) ? $input['kodeTera'] : '',
            !empty($input['kodeBar']) ? $input['kodeBar'] : ''
        );

        // $test_group = array_merge($asset, $asset2);

        // get data asset cat dari model
        $asset_cat = $this->m_asset_category->ByCatCode($catCode);
        $asset_cat_search = $asset_cat['data'];

        // get field asset category
        $asset_cat = $this->m_asset_category->data(
            $asset_cat_search['catCode'],
            $asset_cat_search['sysCatName'],
            $asset_cat_search['assetCatName'],
            $asset_cat_search['assetCatDesc']
        );

        // // push new elemen array
        $asset['propAssetCat'] = $asset_cat;
        $asset['propAssetCat']['propZAssetCatprop'] = $asset_cat_search['propZAssetCatprop'];

        //get data asset master berdasarkan id dari model
        $asset_master = $this->m_asset_master->assetMasterByID(
            !empty($input['idAssetMaster']) ? $input['idAssetMaster'] : 0
        );
        $asset_master_search = $asset_master['data'];

        $asset_propadmin = $this->m_asset_propadmin->data(
            !empty($input['idAsset']) ? $input['idAsset'] : 0,
            $idLocation = 0,
            !empty($input['propAssetPropadmin_riskLevel']) ? $input['propAssetPropadmin_riskLevel'] : 'Low',
            !empty($input['propAssetPropadmin_ownershipType']) ? $input['propAssetPropadmin_ownershipType'] : 'Owned',
            !empty($input['propAssetPropadmin_condition']) ? $input['propAssetPropadmin_condition'] : 'Baik',
            !empty($input['propAssetPropadmin_status']) ? $input['propAssetPropadmin_status'] : 'Active',
            !empty($input['propAssetPropadmin_inactive_date']) ? $input['propAssetPropadmin_inactive_date'] : '',
            !empty($input['propAssetPropadmin_yearProcurement']) ? $input['propAssetPropadmin_yearProcurement'] : '',
            !empty($input['propAssetPropadmin_procureDate']) ? $input['propAssetPropadmin_procureDate'] : '',
            $receivedDate = '',
            $reff = '',
            !empty($input['propAssetPropadmin_poNumb']) ? $input['propAssetPropadmin_poNumb'] : '',
            !empty($input['propAssetPropadmin_priceBuy']) ? $this->remove_comma($input['propAssetPropadmin_priceBuy']) : 0,
            $depreciationMode = '',
            $keterangan = '',
            !empty($input['propAssetPropgenit_idSupplier']) ? $input['propAssetPropgenit_idSupplier'] : 0,
            $lastUpdated = date('Y-m-d H:i:s'),
            !empty($input['propAssetPropadmin_idBuilding']) ? $input['propAssetPropadmin_idBuilding'] : 0,
            !empty($input['propAssetPropadmin_idFloor']) ? $input['propAssetPropadmin_idFloor'] : 0,
            !empty($input['propAssetPropadmin_idRoom']) ? $input['propAssetPropadmin_idRoom'] : 0,
            !empty($input['propAssetPropadmin_idFund']) ? $input['propAssetPropadmin_idFund'] : 0
        );
        // get data asset master
        $asset['propAssetMaster'] = $asset_master_search;

        // get data prop asset prop admin
        $asset['propAssetPropadmin'] = $asset_propadmin;

        // input data file dari session
        // if (empty($input['idAsset'])) {
        $asset['propAssetPropfiles'] =  !empty($_SESSION['assetFileUploads']) ? $_SESSION['assetFileUploads'] : '';
        // }

        $asset_propbuilding_room = $this->m_asset_propbuilding_room->assetPropBuildingRoomById(
            !empty($input['propAssetPropadmin_idRoom']) ? (int)$input['propAssetPropadmin_idRoom'] : 0
        );
        // get data propAssetPropbuildingRoom
        $asset['propAssetPropadmin']['propAssetPropbuildingRoom'] = $asset_propbuilding_room['data'];

        if (!empty($input['propAssetPropadmin_idFund'])) {
            $funding = $this->m_funding->fundingById($input['propAssetPropadmin_idFund']);
        }
        // get data funding
        $asset['propAssetPropadmin']['propFunding'] = !empty($funding) ? $funding['data'] : null;

        // get field asset propaspak
        $asset_propaspak = $this->m_asset_propaspak->data(
            !empty($input['idAsset']) ? $input['idAsset'] : 0,
            !empty($input['propAssetPropaspak_aspakCode']) ? $input['propAssetPropaspak_aspakCode'] : '',
            $idAspak = '',
            !empty($input['propAssetPropaspak_akdAkl']) ? $input['propAssetPropaspak_akdAkl'] : '',
            !empty($input['propAssetPropaspak_insCode']) ? $input['propAssetPropaspak_insCode'] : ''
        );
        // get data propasset propaspak
        $asset['propAssetPropaspak'] = $asset_propaspak;

        $asset_propbuilding = $this->m_asset_propbuilding->data(
            !empty($input['idAsset']) ? $input['idAsset'] : 0,
            !empty($input['propAssetPropbuilding_buildingName']) ? $input['propAssetPropbuilding_buildingName'] : '',
            $gpsLonglat = '',
            $lastUpdated = date('Y-m-d H:i:s'),
            !empty($input['propAssetPropbuilding_buildingCode']) ? $input['propAssetPropbuilding_buildingCode'] : '',
            !empty($input['propAssetPropbuilding_buildingDesc']) ? $input['propAssetPropbuilding_buildingDesc'] : '',
            !empty($input['propAssetPropbuilding_city']) ? $input['propAssetPropbuilding_city'] : '',
            !empty($input['propAssetPropbuilding_phone']) ? $input['propAssetPropbuilding_phone'] : '',
            !empty($input['propAssetPropbuilding_luasTanah']) ? $input['propAssetPropbuilding_luasTanah'] : '',
            !empty($input['propAssetPropbuilding_luasBangunan']) ? $input['propAssetPropbuilding_luasBangunan'] : ''
        );
        $asset['propAssetPropbuilding'] = $asset_propbuilding;

        $asset_propbuilding_floor = [];
        if (!empty($input['propAssetPropbuildingFloor_floorName'])) {
            foreach ($this->input->post('propAssetPropbuildingFloor_floorName') as $key => $propAssetPropbuildingFloor_floorName) {
                $asset_propbuilding_floor[] = $this->m_asset_propbuilding_floor->data(
                    !empty($input['propAssetPropbuildingFloor_idBuilding']) ? $input['propAssetPropbuildingFloor_idBuilding'] : 0,
                    !empty($input['propAssetPropbuilding_buildingName']) ? $input['propAssetPropbuilding_buildingName'] : '',
                    !empty($input['propAssetPropbuildingFloor_idFloor'][$key]) ? $input['propAssetPropbuildingFloor_idFloor'][$key] : 0,
                    $floorNumber = $key + 1,
                    $propAssetPropbuildingFloor_floorName, //floorCode
                    $propAssetPropbuildingFloor_floorName,
                    $propAssetPropbuildingFloor_floorName //floorDesc
                );
            }
        }
        $asset['propAssetPropbuilding']['propAssetPropbuildingFloor'] = $asset_propbuilding_floor;

        $asset_propelectrical = $this->m_asset_propelectrical->data(
            !empty($input['idAsset']) ? $input['idAsset'] : 0,
            // !empty($input['propAssetPropelectrical_idAsset']) ? $input['propAssetPropelectrical_idAsset'] : 0,
            !empty($input['propAssetPropelectrical_voltageInput']) ? $input['propAssetPropelectrical_voltageInput'] : '',
            !empty($input['propAssetPropelectrical_voltageOutput']) ? $input['propAssetPropelectrical_voltageOutput'] : '',
            !empty($input['propAssetPropelectrical_powerConsumption']) ? $input['propAssetPropelectrical_powerConsumption'] : '',
            !empty($input['propAssetPropelectrical_powerRating']) ? $input['propAssetPropelectrical_powerRating'] : '',
            !empty($input['propAssetPropelectrical_currentInput']) ? $input['propAssetPropelectrical_currentInput'] : '',
            !empty($input['propAssetPropelectrical_currentOutput']) ? $input['propAssetPropelectrical_currentOutput'] : '',
            date('Y-m-d H:i:s')
        );
        $asset['propAssetPropelectrical'] = $asset_propelectrical;

        $asset_propgenit = $this->m_asset_propgenit->data(
            !empty($input['idAsset']) ? $input['idAsset'] : 0,
            // !empty($input['idAsset']) ? $input['idAsset'] : 0,
            $idFilePicture = '',
            !empty($input['propAssetPropgenit_merk']) ? $input['propAssetPropgenit_merk'] : '',
            !empty($input['propAssetPropgenit_tipe']) ? $input['propAssetPropgenit_tipe'] : '',
            !empty($input['propAssetPropgenit_spesifikasi']) ? $input['propAssetPropgenit_spesifikasi'] : '',
            $manufacture = '',
            !empty($input['propAssetPropgenit_serialNumber']) ? $input['propAssetPropgenit_serialNumber'] : '',
            $dimension = '',
            !empty($input['propAssetPropgenit_warrantyExpired']) ? $input['propAssetPropgenit_warrantyExpired'] : '',
            $lastUpdated = date('Y-m-d H:i:s'),
            !empty($input['propAssetPropgenit_idSupplier']) ? $input['propAssetPropgenit_idSupplier'] : 0
        );

        $asset['propAssetPropgenit'] = $asset_propgenit;

        $asset['propAssetPropgenit']['propFile'] = '';

        $asset_propinstrument = $this->m_asset_propinstrument->data(
            // !empty($input['propAssetPropinstrument_idAsset']) ? $input['propAssetPropinstrument_idAsset'] : 0,
            !empty($input['idAsset']) ? $input['idAsset'] : 0,
            !empty($input['propAssetPropgenit_merk']) ? $input['propAssetPropgenit_merk'] : '',
            !empty($input['propAssetPropgenit_tipe']) ? $input['propAssetPropgenit_tipe'] : '',
            $catCode == 'MSET' ? 1 : 0, //tipe set
            // !empty($input['propAssetPropinstrument_tipe_set']) ? $input['propAssetPropinstrument_tipe_set'] : 0,
            $lastUpdated = date('Y-m-d H:i:s')
        );
        $asset['propAssetPropinstrument'] = $asset_propinstrument;

        $asset_propland = $this->m_asset_propland->data(
            !empty($input['idAsset']) ? $input['idAsset'] : 0,
            !empty($input['propAssetPropland_certNumber']) ? $input['propAssetPropland_certNumber'] : '',
            !empty($input['propAssetPropland_areal']) ? $input['propAssetPropland_areal'] : '',
            $lastUpdated = date('Y-m-d H:i:s')
        );
        $asset['propAssetPropland'] = $asset_propland;

        $asset_propmedeq = $this->m_asset_propmedeq->data(
            !empty($input['idAsset']) ? $input['idAsset'] : 0,
            $lifetimeExpired = '',
            !empty($input['propAssetPropmedeq_calibrationMust']) ? $input['propAssetPropmedeq_calibrationMust'] : false,
            $calibrationCertFile = '',
            $lastUpdated = date('Y-m-d H:i:s')
        );
        $asset['propAssetPropmedeq'] = $asset_propmedeq;
        $asset['propAssetPropmedeq']['propFile'] = '';

        $asset_propsimak = $this->m_asset_propsimak->data(
            !empty($input['idAsset']) ? $input['idAsset'] : 0,
            !empty($input['propAssetPropsimak_simakCode']) ? $input['propAssetPropsimak_simakCode'] : '',
            !empty($input['propAssetPropsimak_nup']) ? $input['propAssetPropsimak_nup'] : ''
        );

        $asset['propAssetPropsimak'] = $asset_propsimak;

        $master_simak = $this->m_master_simak->masterSimakBySimakCode(
            !empty($input['propAssetPropsimak_simakCode']) ? $input['propAssetPropsimak_simakCode'] : ''
        );
        $asset['propAssetPropsimak']['propMasterSimak'] = !empty($master_simak['data']) ? $master_simak['data'] : null;

        $asset_proptax = $this->m_asset_proptax->data(
            !empty($input['idAsset']) ? $input['idAsset'] : 0,
            $taxCategory = '',
            !empty($input['propAssetProptax_expectedLifeTime']) ? $input['propAssetProptax_expectedLifeTime'] : '',
            !empty($input['propAssetProptax_cost']) ? $this->remove_comma($input['propAssetProptax_cost']) : '',
            !empty($input['propAssetProptax_residuVal']) ? $this->remove_comma($input['propAssetProptax_residuVal']) : '',
            !empty($input['propAssetProptax_yearlyDep']) ? $this->remove_comma($input['propAssetProptax_yearlyDep']) : '',
            !empty($input['propAssetProptax_accuVal']) ? $this->remove_comma($input['propAssetProptax_accuVal']) : '',
            !empty($input['propAssetProptax_bookVal']) ? $this->remove_comma($input['propAssetProptax_bookVal']) : '',
            // $yearlyDep = '',
            // $accuVal = '',
            // $bookVal = '',
            $currentLifeTime = '',
            $percentLifeTime = '',
            !empty($input['propAssetProptax_presentDate']) ? $input['propAssetProptax_presentDate'] : '',
            !empty($input['propAssetProptax_calcStart']) ? $this->remove_comma($input['propAssetProptax_calcStart']) : '',
            $lastUpdated = date('Y-m-d H:i:s')
        );
        $asset['propAssetProptax'] = $asset_proptax;

        $asset_proptax_other = $this->m_asset_proptax_other->data(
            !empty($input['idAsset']) ? $input['idAsset'] : 0,
            $taxCategory = '',
            !empty($input['propAssetProptaxother_expectedLifeTime']) ? $input['propAssetProptaxother_expectedLifeTime'] : '',
            $lifeTimeUnit = 'MONTH',
            !empty($input['propAssetProptaxother_cost']) ? $this->remove_comma($input['propAssetProptaxother_cost']) : '',
            !empty($input['propAssetProptaxother_residuVal']) ? $this->remove_comma($input['propAssetProptaxother_residuVal']) : '',

            !empty($input['propAssetProptaxother_yearlyDep']) ? $this->remove_comma($input['propAssetProptaxother_yearlyDep']) : '',
            !empty($input['propAssetProptaxother_accuVal']) ? $this->remove_comma($input['propAssetProptaxother_accuVal']) : '',
            !empty($input['propAssetProptaxother_bookVal']) ? $this->remove_comma($input['propAssetProptaxother_bookVal']) : '',

            // $yearlyDep = '',
            // $accuVal = '',
            // $bookVal = '',
            $currentLifeTime = '',
            $percentLifeTime = '',

            !empty($input['propAssetProptaxother_presentDate']) ? $input['propAssetProptaxother_presentDate'] : '',
            !empty($input['propAssetProptaxother_calcStart']) ? $this->remove_comma($input['propAssetProptaxother_calcStart']) : '',
            $lastUpdated = date('Y-m-d H:i:s')
        );
        $asset['propAssetProptaxother'] = $asset_proptax_other;

        $asset_propvehicle = $this->m_asset_propvehicle->data(
            !empty($input['idAsset']) ? $input['idAsset'] : 0,
            !empty($input['propAssetPropvehicle_platNumber']) ? $input['propAssetPropvehicle_platNumber'] : '',
            !empty($input['propAssetPropvehicle_frameNumber']) ? $input['propAssetPropvehicle_frameNumber'] : '',
            !empty($input['propAssetPropvehicle_machineNumber']) ? $input['propAssetPropvehicle_machineNumber'] : '',
            !empty($input['propAssetPropvehicle_bpkbNumber']) ? $input['propAssetPropvehicle_bpkbNumber'] : '',
            !empty($input['propAssetPropvehicle_vCC']) ? $input['propAssetPropvehicle_vCC'] : '',
            !empty($input['propAssetPropvehicle_vColor']) ? $input['propAssetPropvehicle_vColor'] : '',
            $lastUpdated = date('Y-m-d H:i:s')
        );
        $asset['propAssetPropvehicle'] = $asset_propvehicle;


        // $asset_insert = [];
        if (!empty($input['idAsset'])) {
            $asset_update = $this->m_asset->assetUpdate($asset);
            // $asset_parent_id = $asset_insert['data'];
            // if ($asset_update['queryResult'] == true) {
            //     $this->session->set_flashdata('sukses', "Success, data updated successfully with code {$catCode}-{$input['idAsset']}");
            // } else {
            //     $message = $asset_update['queryMessage'] ? $asset_update['queryMessage'] : 'Failed';
            //     $this->session->set_flashdata('error', $message);
            // }

            $this->session->unset_userdata('assetFileUploads');
            $this->session->set_userdata('assetFileUploads', []);
            $this->session->unset_userdata('assetInstrument');
            $this->session->set_userdata('assetInstrument', []);
            // redirect('asset/me/inventory_me', 'refresh');
            echo json_encode($asset_update);
            die;
        } else {
            $asset_insert = $this->m_asset->assetInsert($asset);
            $asset_parent_id = $asset_insert['data'];

            // var_dump($asset_insert);
            // die;
            // if ($asset_insert['queryResult'] == true) {
            //     $this->session->set_flashdata('sukses', "Success, data saved successfully with code {$catCode}-{$asset_parent_id}");
            // } else {
            //     $message = $asset_insert['queryMessage'] ? $asset_insert['queryMessage'] : 'Failed';
            //     $this->session->set_flashdata('error', $message);
            // }

            $this->session->unset_userdata('assetFileUploads');
            $this->session->set_userdata('assetFileUploads', []);
            $this->session->unset_userdata('assetInstrument');
            $this->session->set_userdata('assetInstrument', []);
            // redirect('asset/me/inventory_me', 'refresh');
            echo json_encode($asset_insert);
            die;
        }
    }

    public function report()
    {
        $q1 = htmlspecialchars($this->input->post('q1'));
        $v1 = htmlspecialchars($this->input->post('v1'));
        $q2 = htmlspecialchars($this->input->post('q2'));
        $v2 = htmlspecialchars($this->input->post('v2'));
        $q3 = htmlspecialchars($this->input->post('q3'));
        $v3 = htmlspecialchars($this->input->post('v3'));
        $bq3 = htmlspecialchars($this->input->post('bq3'));
        $bv3 = htmlspecialchars($this->input->post('bv3'));
        $q4 = htmlspecialchars($this->input->post('q4'));
        $v4 = htmlspecialchars($this->input->post('v4'));
        $bq4 = htmlspecialchars($this->input->post('bq4'));
        $bv4 = htmlspecialchars($this->input->post('bv4'));
        $q5 = htmlspecialchars($this->input->post('q5'));
        $v5 = htmlspecialchars($this->input->post('v5'));
        $bq5 = htmlspecialchars($this->input->post('bq5'));
        $bv5 = htmlspecialchars($this->input->post('bv5'));
        $q6 = htmlspecialchars($this->input->post('q6'));
        $v6 = htmlspecialchars($this->input->post('v6'));
        $bq6 = htmlspecialchars($this->input->post('bq6'));
        $bv6 = htmlspecialchars($this->input->post('bv6'));
        $q7 = htmlspecialchars($this->input->post('q7'));
        $v7 = htmlspecialchars($this->input->post('v7'));
        $bq7 = htmlspecialchars($this->input->post('bq7'));
        $bv7 = htmlspecialchars($this->input->post('bv7'));
        $q8 = htmlspecialchars($this->input->post('q8'));
        $v8 = htmlspecialchars($this->input->post('v8'));
        $bq8 = htmlspecialchars($this->input->post('bq8'));
        $bv8 = htmlspecialchars($this->input->post('bv8'));
        $q9 = htmlspecialchars($this->input->post('q9'));
        $v9 = htmlspecialchars($this->input->post('v9'));
        $bq9 = htmlspecialchars($this->input->post('bq9'));
        $bv9 = htmlspecialchars($this->input->post('bv9'));
        $q10 = htmlspecialchars($this->input->post('q10'));
        $v10 = htmlspecialchars($this->input->post('v10'));
        $bq10 = htmlspecialchars($this->input->post('bq10'));
        $bv10 = htmlspecialchars($this->input->post('bv10'));
        $postIdAsset = htmlspecialchars($this->input->post('idAsset'));
        $procureDateStart = htmlspecialchars($this->input->post('procureDateStart'));
        $procureDateEnd = htmlspecialchars($this->input->post('procureDateEnd'));
        $procureDateStartq1 = htmlspecialchars($this->input->post('procureDateStartq1'));
        $procureDateEndq2 = htmlspecialchars($this->input->post('procureDateEndq2'));
        $status = htmlspecialchars($this->input->post('status'));

        $any_toogle = $this->input->post('toogle_signature');
        $lokasi_print = $this->input->post('lokasi_print');
        $tgl_print = $this->input->post('tgl_print');
        $button_pdf = $this->input->post('button_pdf');
        $button_excel = $this->input->post('button_excel');
        $officer = $this->input->post('officer');

        $data['any_toogle'] = $any_toogle;
        $data['lokasi_print'] = $lokasi_print;
        $data['tgl_print'] = $tgl_print;
        $data['officer'] = $officer;
        // var_dump($q1);
        // die;

        $query_params = [];
        $query_params_like_or = [];
        $query_params_where_between = [];
        $query_groups_where_between = [];

        if ($button_pdf == 'pdf') {

            if ($procureDateStart != '') {

                $procureDateStart_query_params = [
                    "column" => $procureDateStartq1,
                    "value" => $procureDateStart
                ];
                array_push($query_params_where_between, $procureDateStart_query_params);
            }

            if ($procureDateEnd != '') {

                $procureDateEnd_query_params = [
                    "column" => $procureDateEndq2,
                    "value" => $procureDateEnd
                ];
                array_push($query_params_where_between, $procureDateEnd_query_params);
            }

            $sys_cat_name_query_params = [
                "column" => "sysCatName",
                "value" => "BLD"
            ];
            array_push($query_params, $sys_cat_name_query_params);

            if ($q1 != '') {

                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $q1_query_params = [
                        "column" => $q1,
                        "value" => $v1
                    ];
                    array_push($query_params_like_or, $q1_query_params);
                } else {
                    $q1_query_params = [
                        "column" => $q1,
                        "value" => $v1
                    ];

                    array_push($query_params, $q1_query_params);
                }
            }

            if ($q2 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $q2_query_params = [
                        "column" => $q2,
                        "value" => $v2
                    ];
                    array_push($query_params_like_or, $q2_query_params);
                } else {
                    $q2_query_params = [
                        "column" => $q2,
                        "value" => $v2
                    ];

                    array_push($query_params, $q2_query_params);
                }
            }

            if ($q3 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $q3_query_params = [
                        "column" => $q3,
                        "value" => $v3
                    ];
                    array_push($query_params_like_or, $q3_query_params);
                } else {
                    $q3_query_params = [
                        "column" => $q3,
                        "value" => $v3
                    ];

                    array_push($query_params, $q3_query_params);
                }
            }

            if ($bq3 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $bq3_query_params = [
                        "column" => $bq3,
                        "value" => $bv3
                    ];
                    array_push($query_params_like_or, $bq3_query_params);
                } else {
                    $bq3_query_params = [
                        "column" => $bq3,
                        "value" => $bv3
                    ];

                    array_push($query_params, $bq3_query_params);
                }
            }

            if ($q4 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $q4_query_params = [
                        "column" => $q4,
                        "value" => $v4
                    ];
                    array_push($query_params_like_or, $q4_query_params);
                } else {
                    $q4_query_params = [
                        "column" => $q4,
                        "value" => $v4
                    ];

                    array_push($query_params, $q4_query_params);
                }
            }

            if ($bq4 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $bq4_query_params = [
                        "column" => $bq4,
                        "value" => $bv4
                    ];
                    array_push($query_params_like_or, $bq4_query_params);
                } else {
                    $bq4_query_params = [
                        "column" => $bq4,
                        "value" => $bv4
                    ];

                    array_push($query_params, $bq4_query_params);
                }
            }

            if ($q5 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $q5_query_params = [
                        "column" => $q5,
                        "value" => $v5
                    ];
                    array_push($query_params_like_or, $q5_query_params);
                } else {
                    $q5_query_params = [
                        "column" => $q5,
                        "value" => $v5
                    ];

                    array_push($query_params, $q5_query_params);
                }
            }

            if ($bq5 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $bq5_query_params = [
                        "column" => $bq5,
                        "value" => $bv5
                    ];
                    array_push($query_params_like_or, $bq5_query_params);
                } else {
                    $bq5_query_params = [
                        "column" => $bq5,
                        "value" => $bv5
                    ];

                    array_push($query_params, $bq5_query_params);
                }
            }

            if ($q6 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $q6_query_params = [
                        "column" => $q6,
                        "value" => $v6
                    ];
                    array_push($query_params_like_or, $q6_query_params);
                } else {
                    $q6_query_params = [
                        "column" => $q6,
                        "value" => $v6
                    ];

                    array_push($query_params, $q6_query_params);
                }
            }

            if ($bq6 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $bq6_query_params = [
                        "column" => $bq6,
                        "value" => $bv6
                    ];
                    array_push($query_params_like_or, $bq6_query_params);
                } else {
                    $bq6_query_params = [
                        "column" => $bq6,
                        "value" => $bv6
                    ];

                    array_push($query_params, $bq6_query_params);
                }
            }

            if ($q7 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $q7_query_params = [
                        "column" => $q7,
                        "value" => $v7
                    ];
                    array_push($query_params_like_or, $q7_query_params);
                } else {
                    $q7_query_params = [
                        "column" => $q7,
                        "value" => $v7
                    ];

                    array_push($query_params, $q7_query_params);
                }
            }

            if ($bq7 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $bq7_query_params = [
                        "column" => $bq7,
                        "value" => $bv7
                    ];
                    array_push($query_params_like_or, $bq7_query_params);
                } else {
                    $bq7_query_params = [
                        "column" => $q7,
                        "value" => $v7
                    ];

                    array_push($query_params, $bq7_query_params);
                }
            }

            if ($q8 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $q8_query_params = [
                        "column" => $q8,
                        "value" => $v8
                    ];
                    array_push($query_params_like_or, $q8_query_params);
                } else {
                    $q8_query_params = [
                        "column" => $q8,
                        "value" => $v8
                    ];

                    array_push($query_params, $q8_query_params);
                }
            }

            if ($bq8 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $bq8_query_params = [
                        "column" => $bq8,
                        "value" => $bv8
                    ];
                    array_push($query_params_like_or, $bq8_query_params);
                } else {
                    $bq8_query_params = [
                        "column" => $bq8,
                        "value" => $bv8
                    ];

                    array_push($query_params, $bq8_query_params);
                }
            }

            if ($q9 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $q9_query_params = [
                        "column" => $q9,
                        "value" => $v9
                    ];
                    array_push($query_params_like_or, $q9_query_params);
                } else {
                    $q9_query_params = [
                        "column" => $q9,
                        "value" => $v9
                    ];

                    array_push($query_params, $q9_query_params);
                }
            }

            if ($bq9 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $bq9_query_params = [
                        "column" => $bq9,
                        "value" => $bv9
                    ];
                    array_push($query_params_like_or, $bq9_query_params);
                } else {
                    $bq9_query_params = [
                        "column" => $bq9,
                        "value" => $bv9
                    ];

                    array_push($query_params, $bq9_query_params);
                }
            }

            if ($q10 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $q10_query_params = [
                        "column" => $q10,
                        "value" => $v10
                    ];
                    array_push($query_params_like_or, $q10_query_params);
                } else {
                    $q10_query_params = [
                        "column" => $q10,
                        "value" => $v10
                    ];

                    array_push($query_params, $q10_query_params);
                }
            }

            if ($bq10 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $bq10_query_params = [
                        "column" => $bq10,
                        "value" => $bv10
                    ];
                    array_push($query_params_like_or, $bq10_query_params);
                } else {
                    $bq10_query_params = [
                        "column" => $bq10,
                        "value" => $bv10
                    ];

                    array_push($query_params, $bq10_query_params);
                }
            }

            if ($status != '') {
                $status_query_params = [
                    "column" => "status",
                    "value" => $status
                ];

                array_push($query_params, $status_query_params);
            }

            $query_groups_like_or = [];
            $query_groups = [];

            if ($q1 != null || $q2 != null || $q3 != null || $bq3 != null || $q4 != null || $bq4 != null || $q5 != null || $bq5 != null || $q6 != null || $bq6 != null || $q7 != null || $bq7 != null || $q8 != null || $bq8 != null || $q9 != null || $bq9 != null || $q10 != null || $bq10 != null) {
                $query_groups_like_or = [
                    [
                        "queryMethod" => "LIKEOR",
                        "queryParams" => $query_params_like_or
                    ]
                ];
            }


            // parsing all
            $query_groups = [
                [
                    "queryMethod" => "LIKEAND",
                    "queryParams" => $query_params
                ]
            ];



            $merge_query_groups = array_merge($query_groups, $query_groups_like_or);
            $merge_query_groups = array_merge($merge_query_groups, $query_groups_where_between);

            $request = [
                "queryGroupMethod" => "AND",
                "queryGroups" => $query_groups,
            ];

            $data['assets'] = $this->m_asset->assetQuery($request);


            $mpdfConfig = array(
                'tempDir' => sys_get_temp_dir() . DIRECTORY_SEPARATOR,
                'mode' => 'utf-8',
                'format' => 'A4',    // format - A4, for example, default ''
                'margin_left' => 5,        // 15 margin_left
                'margin_right' => 5,        // 15 margin right
                // 'margin_top' => 5,        // 15 margin right
                // 'margin_bottom' => 5,        // 15 margin right
                'orientation' => 'L'      // L - landscape, P - portrait
            );
            $mpdf = new \Mpdf\Mpdf($mpdfConfig);
            $data['mpdf'] = $mpdf;
            $html = $this->load->view('assets/building/print/pdf_bld', $data, TRUE);
            $mpdf->WriteHTML($html);
            $mpdf->Output();
        } else {
            if ($procureDateStart != '') {

                $procureDateStart_query_params = [
                    "column" => $procureDateStartq1,
                    "value" => $procureDateStart
                ];
                array_push($query_params_where_between, $procureDateStart_query_params);
            }

            if ($procureDateEnd != '') {

                $procureDateEnd_query_params = [
                    "column" => $procureDateEndq2,
                    "value" => $procureDateEnd
                ];
                array_push($query_params_where_between, $procureDateEnd_query_params);
            }

            $sys_cat_name_query_params = [
                "column" => "sysCatName",
                "value" => "BLD"
            ];
            array_push($query_params, $sys_cat_name_query_params);

            if ($q1 != '') {

                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $q1_query_params = [
                        "column" => $q1,
                        "value" => $v1
                    ];
                    array_push($query_params_like_or, $q1_query_params);
                } else {
                    $q1_query_params = [
                        "column" => $q1,
                        "value" => $v1
                    ];

                    array_push($query_params, $q1_query_params);
                }
            }

            if ($q2 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $q2_query_params = [
                        "column" => $q2,
                        "value" => $v2
                    ];
                    array_push($query_params_like_or, $q2_query_params);
                } else {
                    $q2_query_params = [
                        "column" => $q2,
                        "value" => $v2
                    ];

                    array_push($query_params, $q2_query_params);
                }
            }

            if ($q3 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $q3_query_params = [
                        "column" => $q3,
                        "value" => $v3
                    ];
                    array_push($query_params_like_or, $q3_query_params);
                } else {
                    $q3_query_params = [
                        "column" => $q3,
                        "value" => $v3
                    ];

                    array_push($query_params, $q3_query_params);
                }
            }

            if ($bq3 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $bq3_query_params = [
                        "column" => $bq3,
                        "value" => $bv3
                    ];
                    array_push($query_params_like_or, $bq3_query_params);
                } else {
                    $bq3_query_params = [
                        "column" => $bq3,
                        "value" => $bv3
                    ];

                    array_push($query_params, $bq3_query_params);
                }
            }

            if ($q4 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $q4_query_params = [
                        "column" => $q4,
                        "value" => $v4
                    ];
                    array_push($query_params_like_or, $q4_query_params);
                } else {
                    $q4_query_params = [
                        "column" => $q4,
                        "value" => $v4
                    ];

                    array_push($query_params, $q4_query_params);
                }
            }

            if ($bq4 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $bq4_query_params = [
                        "column" => $bq4,
                        "value" => $bv4
                    ];
                    array_push($query_params_like_or, $bq4_query_params);
                } else {
                    $bq4_query_params = [
                        "column" => $bq4,
                        "value" => $bv4
                    ];

                    array_push($query_params, $bq4_query_params);
                }
            }

            if ($q5 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $q5_query_params = [
                        "column" => $q5,
                        "value" => $v5
                    ];
                    array_push($query_params_like_or, $q5_query_params);
                } else {
                    $q5_query_params = [
                        "column" => $q5,
                        "value" => $v5
                    ];

                    array_push($query_params, $q5_query_params);
                }
            }

            if ($bq5 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $bq5_query_params = [
                        "column" => $bq5,
                        "value" => $bv5
                    ];
                    array_push($query_params_like_or, $bq5_query_params);
                } else {
                    $bq5_query_params = [
                        "column" => $bq5,
                        "value" => $bv5
                    ];

                    array_push($query_params, $bq5_query_params);
                }
            }

            if ($q6 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $q6_query_params = [
                        "column" => $q6,
                        "value" => $v6
                    ];
                    array_push($query_params_like_or, $q6_query_params);
                } else {
                    $q6_query_params = [
                        "column" => $q6,
                        "value" => $v6
                    ];

                    array_push($query_params, $q6_query_params);
                }
            }

            if ($bq6 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $bq6_query_params = [
                        "column" => $bq6,
                        "value" => $bv6
                    ];
                    array_push($query_params_like_or, $bq6_query_params);
                } else {
                    $bq6_query_params = [
                        "column" => $bq6,
                        "value" => $bv6
                    ];

                    array_push($query_params, $bq6_query_params);
                }
            }

            if ($q7 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $q7_query_params = [
                        "column" => $q7,
                        "value" => $v7
                    ];
                    array_push($query_params_like_or, $q7_query_params);
                } else {
                    $q7_query_params = [
                        "column" => $q7,
                        "value" => $v7
                    ];

                    array_push($query_params, $q7_query_params);
                }
            }

            if ($bq7 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $bq7_query_params = [
                        "column" => $bq7,
                        "value" => $bv7
                    ];
                    array_push($query_params_like_or, $bq7_query_params);
                } else {
                    $bq7_query_params = [
                        "column" => $q7,
                        "value" => $v7
                    ];

                    array_push($query_params, $bq7_query_params);
                }
            }

            if ($q8 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $q8_query_params = [
                        "column" => $q8,
                        "value" => $v8
                    ];
                    array_push($query_params_like_or, $q8_query_params);
                } else {
                    $q8_query_params = [
                        "column" => $q8,
                        "value" => $v8
                    ];

                    array_push($query_params, $q8_query_params);
                }
            }

            if ($bq8 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $bq8_query_params = [
                        "column" => $bq8,
                        "value" => $bv8
                    ];
                    array_push($query_params_like_or, $bq8_query_params);
                } else {
                    $bq8_query_params = [
                        "column" => $bq8,
                        "value" => $bv8
                    ];

                    array_push($query_params, $bq8_query_params);
                }
            }

            if ($q9 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $q9_query_params = [
                        "column" => $q9,
                        "value" => $v9
                    ];
                    array_push($query_params_like_or, $q9_query_params);
                } else {
                    $q9_query_params = [
                        "column" => $q9,
                        "value" => $v9
                    ];

                    array_push($query_params, $q9_query_params);
                }
            }

            if ($bq9 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $bq9_query_params = [
                        "column" => $bq9,
                        "value" => $bv9
                    ];
                    array_push($query_params_like_or, $bq9_query_params);
                } else {
                    $bq9_query_params = [
                        "column" => $bq9,
                        "value" => $bv9
                    ];

                    array_push($query_params, $bq9_query_params);
                }
            }

            if ($q10 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $q10_query_params = [
                        "column" => $q10,
                        "value" => $v10
                    ];
                    array_push($query_params_like_or, $q10_query_params);
                } else {
                    $q10_query_params = [
                        "column" => $q10,
                        "value" => $v10
                    ];

                    array_push($query_params, $q10_query_params);
                }
            }

            if ($bq10 != '') {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $bq10_query_params = [
                        "column" => $bq10,
                        "value" => $bv10
                    ];
                    array_push($query_params_like_or, $bq10_query_params);
                } else {
                    $bq10_query_params = [
                        "column" => $bq10,
                        "value" => $bv10
                    ];

                    array_push($query_params, $bq10_query_params);
                }
            }

            if ($status != '') {
                $status_query_params = [
                    "column" => "status",
                    "value" => $status
                ];

                array_push($query_params, $status_query_params);
            }

            $query_groups_like_or = [];
            $query_groups = [];

            if ($q1 != null || $q2 != null || $q3 != null || $bq3 != null || $q4 != null || $bq4 != null || $q5 != null || $bq5 != null || $q6 != null || $bq6 != null || $q7 != null || $bq7 != null || $q8 != null || $bq8 != null || $q9 != null || $bq9 != null || $q10 != null || $bq10 != null) {
                $query_groups_like_or = [
                    [
                        "queryMethod" => "LIKEOR",
                        "queryParams" => $query_params_like_or
                    ]
                ];
            }


            // parsing all
            $query_groups = [
                [
                    "queryMethod" => "LIKEAND",
                    "queryParams" => $query_params
                ]
            ];



            $merge_query_groups = array_merge($query_groups, $query_groups_like_or);
            $merge_query_groups = array_merge($merge_query_groups, $query_groups_where_between);
            $request = [
                "queryGroupMethod" => "AND",
                "queryGroups" => $merge_query_groups,
            ];

            $data['assets'] = $this->m_asset->assetQuery($request);

            $this->load->view('assets/building/print/excell_bld', $data);
        }
    }

    private function remove_comma($value)
    {
        return preg_replace('/[^\d.]/', '', $value);
    }
}

/* End of file Inventory_bld.php */
