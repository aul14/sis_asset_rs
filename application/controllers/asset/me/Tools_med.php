<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Tools_med extends CI_Controller
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

    public function index()
    {
        $query_groups = [
            [
                "queryMethod" => "EXACTAND",
                "queryParams" => [
                    [
                        "column" => "sysCatName",
                        "value" => "MED"
                    ],
                ]
            ],
            [
                "queryMethod" => "EXACTOR",
                "queryParams" => [
                    [
                        "column" => "subSysCat",
                        "value" => "TOOLS"
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

        $vmode = $this->input->get('vmode') ? $this->input->get('vmode') : 'MQP';

        switch ($vmode) {
            case "Inventory":
                $data['columns'] = [
                    'Code',
                    // 'Simak Code',
                    'Label Code', 'Asset Name', 'Merk', 'Type', 'SN',
                    'Condition', 'Ownership Type', 'Risk Level'
                ];

                $data['rows'] = [
                    'assetCode',
                    // 'propAssetPropsimak.simakCode',
                    'kodeBar', 'assetName', 'propAssetPropgenit.merk', 'propAssetPropgenit.tipe',
                    'propAssetPropgenit.serialNumber',
                    'propAssetPropadmin.condition',
                    'propAssetPropadmin.ownershipType', 'propAssetPropadmin.riskLevel'
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
                    'Label Code', 'Asset Name', 'Merk', 'Type', 'SN',
                    'Condition', 'Ownership Type', 'Risk Level'
                ];

                $data['rows'] = [
                    'assetCode',
                    // 'propAssetPropsimak.simakCode',
                    'kodeBar', 'assetName', 'propAssetPropgenit.merk', 'propAssetPropgenit.tipe',
                    'propAssetPropgenit.serialNumber',
                    'propAssetPropadmin.condition',
                    'propAssetPropadmin.ownershipType', 'propAssetPropadmin.riskLevel'
                ];
        }

        $result_role = $this->m_access_control->MyRole()['data']['roleACL'];

        $data['result_role'] = $result_role;
        $this->load->model('M_notifikasi', 'm_notifikasi');
        $data['notif'] = $this->m_notifikasi->list()['data'];

        if ($result_role[1]['subMenu1'][0]['subMenu2'][2]['isAllow'] != true) {
            exit('You dont have access!!');
        }

        $this->load->view('components/header');
        $this->load->view('components/sidebar', $data);
        $this->load->view('assets/medical_equipment/tools_med_index', $data);
        $this->load->view('assets/medical_equipment/form/tools_form');
        $this->load->view('assets/medical_equipment/details/inventory_details');
        $this->load->view('assets/medical_equipment/print/assets_print');
        $this->load->view('components/sidebar_footer');
        $this->load->view('components/footer');
        $this->load->view('assets/assets');
    }
    public function ajax_cat_has_parent()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $catCode = $this->input->post('catCode');

        $assetCat = $this->m_asset_category->ByCatCode($catCode);

        // AMBIL DATA PROPTABLE UNTUK MENGETAHUI VIEW TAB APA AJA YG DIGUNAKAN
        foreach ($assetCat['data']['propZAssetCatprop'] as $key => $val) {
            switch ($val['propTable']) {
                case "asset_propadmin":
                case "asset_propgenit":
                case "asset_propmedeq":
                case "asset_propelectrical":
                    $general =  'general';
                    $code =   'code';
                    break;

                case "asset_propbuilding":
                    $building = 'building';
                    break;

                case "asset_propinstrument":
                    $instrument = 'instrument';
                    break;

                case "asset_propvehicle":
                    $vehicle = 'vehicle';
                    break;

                case "asset_propland":
                    $land = 'land';
                    break;

                case "asset_propstock":
                    $stock = 'stock';
                    break;

                case "asset_propfiles":
                    $file = 'file';
                    break;

                case "asset_proptax":
                    $depreciation1 = 'depreciation1';
                    break;
                case "asset_proptaxother":
                    $depreciation2 = 'depreciation2';
                    break;

                case "asset_proplicence":
                    $license = 'license';
                    break;

                case "asset_propaspak":
                    $aspak = 'aspak';
                    break;
                case "asset_propsimak":
                    $simak = 'simak';
                    break;

                default:
                    break;
            }
        }

        echo json_encode([
            'catHasParent'      => $assetCat['data']['catHasParent'],
            'general'           => empty($general) ? false : true,
            'code'               => empty($code) ? false : true,
            'building'          => empty($building) ? false : true,
            'instrument'        => empty($instrument) ? false : true,
            'vehicle'           => empty($vehicle) ? false : true,
            'land'              => empty($land) ? false : true,
            'stock'             => empty($stock) ? false : true,
            'file'              => empty($file) ? false : true,
            'depreciation1'       => empty($depreciation1) ? false : true,
            'depreciation2'       => empty($depreciation2) ? false : true,
            'license'           => empty($license) ? false : true,
            'aspak'             => empty($aspak) ? false : true,
            'simak'             => empty($simak) ? false : true,
        ]);
        exit;
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

        $asset_proplicense = $this->m_asset_proplicense->data(
            !empty($input['idAsset']) ? $input['idAsset'] : 0,
            !empty($input['propAssetProplicence_licType']) ? $input['propAssetProplicence_licType'] : '',
            !empty($input['propAssetProplicence_licStart']) ? $input['propAssetProplicence_licStart'] : '',
            !empty($input['propAssetProplicence_licEnd']) ? $input['propAssetProplicence_licEnd'] : '',
            !empty($input['propAssetProplicence_licKey']) ? $input['propAssetProplicence_licKey'] : '',
            !empty($input['propAssetProplicence_version']) ? $input['propAssetProplicence_version'] : '',
            $lastUpdated = date('Y-m-d H:i:s'),
            ""
        );
        $asset['propAssetProplicence'] = $asset_proplicense;

        $asset_propmedeq = $this->m_asset_propmedeq->data(
            !empty($input['idAsset']) ? $input['idAsset'] : 0,
            $lifetimeExpired = '',
            !empty($input['propAssetPropmedeq_calibrationMust']) ? true : false,
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

        $asset['propChildAsset']    = !empty($_SESSION['assetInstrument']) ? $_SESSION['assetInstrument'] : '';

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
            // redirect('asset/me/tools_med', 'refresh');
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
            // redirect('asset/me/tools_med', 'refresh');
            echo json_encode($asset_insert);
            die;
        }
    }

    public function ajax_asset_category()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $q = trim($this->input->post('q'));

        $query_where_or_params = [];
        // $query_like_or_params = [];

        $catCode_params = [
            "column" => "catCode",
            "value" => "MEQ"
        ];
        array_push($query_where_or_params, $catCode_params);

        $catCode_params = [
            "column" => "catCode",
            "value" => "MDQA"
        ];
        array_push($query_where_or_params, $catCode_params);

        $catCode_params = [
            "column" => "catCode",
            "value" => "MINS"
        ];
        array_push($query_where_or_params, $catCode_params);

        $catCode_params = [
            "column" => "catCode",
            "value" => "MSET"
        ];
        array_push($query_where_or_params, $catCode_params);

        // $assetCatName_params = [
        //     "column" => "assetCatName",
        //     "value" => "$q"
        // ];
        // array_push($query_like_or_params, $assetCatName_params);

        $query_group_where_or = [
            [
                "queryMethod" => "EXACTOR",
                "queryParams" => $query_where_or_params
            ]
        ];

        // $query_group_like_or = [
        //     [
        //         "queryMethod" => "LIKEOR",
        //         "queryParams" => $query_like_or_params
        //     ]
        // ];

        // $merge_group_query = array_merge($query_group_where_or, $query_group_like_or);


        $data_request = [
            "queryGroupMethod" => "AND",
            "queryGroups" => $query_group_where_or
        ];

        $result = $this->m_asset_category->assetCatQuery($data_request);

        echo json_encode($result['data']);
        exit;
    }

    public function ajax_asset_parent()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $q = trim($this->input->post('q'));
        $catcode_kategori = $this->input->post('catcode_kategori');

        if (!empty($q)) {
            $query_groups = [
                [
                    "queryMethod" => "EXACTOR",
                    "queryParams" => [
                        [
                            "column" => "sysCatName",
                            "value" => "MED"
                        ],
                    ]
                ],
                [
                    "queryMethod" => "LIKEOR",
                    "queryParams" => [
                        [
                            "column" => "assetName",
                            "value" => "$q"
                        ],
                    ]
                ]
            ];
        }

        $data_request = [
            "queryGroupMethod" => "AND",
            "limit" => 15,
            "page"  => 1,
            "queryGroups" => $query_groups
        ];

        $result = $this->m_asset->assetQuery($data_request);

        echo json_encode($result['data']);
        exit;
    }

    public function ajax_asset_master()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        // $q = trim($this->input->post('q'));
        $catCode = trim($this->input->post('catCode'));

        $result = $this->m_asset_master->assetMasterByCatCode($catCode);

        echo json_encode($result['data']);
        exit;
    }

    public function ajax_asset_master_instrument()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $q = trim($this->input->post('q'));

        $query_like_and_params = [];
        $query_where_and_params = [];

        $catCode_params = [
            "column" => "catCode",
            "value" => "MINS"
        ];
        array_push($query_where_and_params, $catCode_params);

        $assetMasterName_params = [
            "column" => "assetMasterName",
            "value" => "$q"
        ];
        array_push($query_like_and_params, $assetMasterName_params);

        $query_group_like_and = [
            [
                "queryMethod" => "LIKEAND",
                "queryParams" => $query_like_and_params
            ]
        ];

        $query_group_where_and = [
            [
                "queryMethod" => "EXACTAND",
                "queryParams" => $query_where_and_params
            ]
        ];

        $query_merge_group = array_merge($query_group_where_and, $query_group_like_and);

        $data_request = [
            "queryGroupMethod" => "AND",
            // "page" => 1,
            "limit" => 15,
            "queryGroups" => $query_merge_group
        ];

        $result = $this->m_asset_master->assetMasterQuery($data_request);

        echo json_encode($result['data']);
        exit;
    }

    public function ajax_asset_master_by_id()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $idAssetMaster = $this->input->post('idAssetMaster');

        $assetMasterId = $this->m_asset_master->assetMasterByID($idAssetMaster);

        echo json_encode([
            'assetMasterName'  => $assetMasterId['data']['assetMasterName'],
            'riskLevel'         => $assetMasterId['data']['riskLevel'],
            'calibMust'         => $assetMasterId['data']['calibMust'],
            'aspakCode'         => $assetMasterId['data']['aspakCode'],
            'aspakItemName'     => $assetMasterId['data']['propMasterAspakItem']['aspakItemName'],
            'simakCode'         => $assetMasterId['data']['simakCode'],
            'simakUraian'       => $assetMasterId['data']['propMasterSimak']['simakUraian'],
            'propAssetSimakCode' => $assetMasterId['data']['propMasterSimak']['simakCode']
        ]);
        exit;
    }

    public function ajax_brand()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $q = trim($this->input->post('q'));

        $query_like_or_params = [];

        $brandName_params = [
            "column" => "brandName",
            "value" => "$q"
        ];
        array_push($query_like_or_params, $brandName_params);

        $query_like_or_params = [
            [
                "queryMethod" => "LIKEOR",
                "queryParams" => $query_like_or_params
            ]
        ];

        $data_request = [
            "queryGroupMethod" => "AND",
            // "page" => 1,
            "limit" => 15,
            "queryGroups" => $query_like_or_params
        ];

        $result = $this->m_brand->brandQuery($data_request);

        echo json_encode($result['data']);
        exit;
    }

    public function ajax_room()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $q = trim($this->input->post('q'));

        $query_like_or_params = [];
        // $query_like_or2_params = [];
        // $query_like_or3_params = [];

        $buildingName_params = [
            "column" => "buildingName",
            "value" => $q
        ];
        array_push($query_like_or_params, $buildingName_params);

        $buildingName_params = [
            "column" => "roomName",
            "value" => "$q"
        ];
        array_push($query_like_or_params, $buildingName_params);

        $buildingName_params = [
            "column" => "floorName",
            "value" => $q
        ];
        array_push($query_like_or_params, $buildingName_params);

        // $merge_query_like_or_groups = array_merge($query_like_or_params, $query_like_or2_params, $query_like_or3_params);

        $query_like_or_params = [
            [
                "queryMethod" => "LIKEOR",
                "queryParams" => $query_like_or_params
            ]
        ];

        $request = [
            "queryGroupMethod" => "AND",
            "queryGroups" => $query_like_or_params
        ];

        $result = $this->m_asset_propbuilding_room->assetPropBuildingRoomQuery($request);

        echo json_encode($result['data']);
        exit;
    }

    public function ajax_room_list()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $result = $this->m_asset_propbuilding_room->assetPropBuildingRoomList();
        echo json_encode($result['data']);
        exit;
    }

    public function ajax_room_by_id()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $idRoom = $this->input->post('idRoom');

        $result = $this->m_asset_propbuilding_room->assetPropBuildingRoomById($idRoom);

        echo json_encode([
            'id_building'       => $result['data']['idBuilding'],
            'id_floor'          => $result['data']['idFloor']
        ]);
        exit;
    }

    public function ajax_supplier()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $q = trim($this->input->post('q'));

        $query_where_or_params = [];
        $query_like_or_params = [];

        $contactType_params = [
            "column" => "contactType",
            "value" => "SUPPLIER"
        ];
        array_push($query_where_or_params, $contactType_params);

        $contactCompany_params = [
            "column" => "contactCompany",
            "value" => "$q"
        ];
        array_push($query_like_or_params, $contactCompany_params);

        $contactPerson_params = [
            "column" => "contactPerson",
            "value" => "$q"
        ];
        array_push($query_like_or_params, $contactPerson_params);

        $query_group_where_or = [
            [
                "queryMethod" => "EXACTOR",
                "queryParams" => $query_where_or_params
            ]
        ];

        $query_group_like_or = [
            [
                "queryMethod" => "LIKEOR",
                "queryParams" => $query_like_or_params
            ]
        ];

        $merge_group_query = array_merge($query_group_where_or, $query_group_like_or);

        $data_request = [
            "queryGroupMethod" => "AND",
            // "page" => 1,
            "limit" => 15,
            "queryGroups" => $merge_group_query
        ];

        $result = $this->m_contact->contactQuery($data_request);

        echo json_encode($result['data']);
        exit;
    }

    public function ajax_file_cat()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $q = trim($this->input->post('q'));

        $query_groups = [];

        if (!empty($q)) {
            $query_groups = [
                [
                    "queryMethod" => "LIKEOR",
                    "queryParams" => [
                        [
                            "column" => "fileCatDesc",
                            "value" => $q
                        ],
                    ]
                ]
            ];
        }

        $data_request = [
            "queryGroupMethod" => "AND",
            "queryGroups" => $query_groups,
            "limit" =>  15
        ];

        $result = $this->m_file_cat->fileCatQuery($data_request);

        echo json_encode($result['data']);
        exit;
    }

    private function remove_comma($value)
    {
        return preg_replace('/[^\d.]/', '', $value);
    }

    public function calc_depre()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $post = $this->input->post();

        isset($post['propAssetProptax_expectedLifeTime']) ? (int)$this->remove_comma($post['propAssetProptax_expectedLifeTime']) : 0;
        isset($post['propAssetProptax_residuVal']) ? (int)$this->remove_comma($post['propAssetProptax_residuVal']) : 0;
        isset($post['propAssetProptax_cost']) ? (int)$this->remove_comma($post['propAssetProptax_cost']) : 0;


        $CalcDepre = $this->m_asset->helperCalcDepre($post);


        echo json_encode($CalcDepre);
        exit;
    }

    public function delete()
    {
        $id_asset = $this->input->post('idAsset');
        $asset = $this->m_asset->assetDelete($id_asset);

        echo json_encode($asset);
    }
}

/* End of file Tools_med.php */
