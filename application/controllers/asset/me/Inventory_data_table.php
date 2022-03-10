<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Inventory_data_table extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->simple_login->cek_login(); // cek login
        $this->load->model([
            'M_asset'               => 'm_asset',
            'M_asset_category'      => 'm_asset_category',
            'M_asset_master'        => 'm_asset_master',
            'M_brand'               => 'm_brand'
        ]);
    }

    public function asset_query()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $q = $this->input->get('q');
        $sys_cat_name = $this->input->get('sysCatName') ? $this->input->get('sysCatName') : "";
        $catCode = $this->input->get('catCode') ? $this->input->get('catCode') : "";

        $query_params = [];
        $query_params_like_or = [];

        if ($q != '') {

            $serialNumber_query_params = [
                "column" => "serialNumber",
                "value" => $q
            ];
            array_push($query_params_like_or, $serialNumber_query_params);

            $asset_name_query_params = [
                "column" => "assetName",
                "value" => $q
            ];
            array_push($query_params_like_or, $asset_name_query_params);

            $asset_name_query_params = [
                "column" => "idAsset",
                "value" => $q
            ];
            array_push($query_params_like_or, $asset_name_query_params);

            $roomName_query_params = [
                "column" => "roomName",
                "value" => $q
            ];
            array_push($query_params_like_or, $roomName_query_params);
        }

        // if ($catCode != 'ALL') {
        //     if ($catCode != '') {
        //         $catCodes = explode('-', $catCode);

        //         foreach ($catCodes as $catCode) {
        //             if ($catCode) {
        //                 $catCode_query_params = [
        //                     "column" => "catCode",
        //                     "value" => $catCode
        //                 ];
        //                 array_push($query_params_like_or, $catCode_query_params);
        //             }
        //         }
        //     }
        // }

        if ($sys_cat_name != '') {
            $sys_cat_name_query_params = [
                "column" => "sysCatName",
                "value" => $sys_cat_name
            ];
            array_push($query_params, $sys_cat_name_query_params);
        }

        $query_groups_like_or = [];
        $query_groups = [];
        if ($sys_cat_name != '') {
            $query_groups = [
                [
                    "queryMethod" => "LIKEAND",
                    "queryParams" => $query_params
                ]
            ];
        }

        if ($catCode != '') {
            if ($catCode != 'ALL') {
                $query_groups_like_or = [
                    [
                        "queryMethod" => "LIKEOR",
                        "queryParams" => $query_params_like_or
                    ]
                ];
            }
        }

        if ($q != '') {
            $query_groups_like_or = [
                [
                    "queryMethod" => "LIKEOR",
                    "queryParams" => $query_params_like_or
                ]
            ];
        }

        $merge_query_groups = array_merge($query_groups, $query_groups_like_or);

        $request = [
            "queryGroupMethod" => "AND",
            "queryGroups" => $merge_query_groups ? $merge_query_groups : [],
            "page" =>  1,
            "limit" =>  50
        ];

        $assets = $this->m_asset->assetQuery($request);

        // if (sizeof($assets) > 0) {
        //     foreach ($assets['data'] as $key => $value) {
        //         $assets['data'][$key]['assetCode'] = $value['catCode'] . '-' . $value['idAsset'];
        //     }
        // }

        echo json_encode($assets);
    }

    public function asset_data_table()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $idAssets = empty($this->input->post('idAssets')) ? [] : $this->input->post('idAssets'); //ini format nya array

        $idAssetSelected = empty($this->session->userdata('idAssetSelected')) ? [] : $this->session->userdata('idAssetSelected');
        $idAssets = array_merge($idAssets, $idAssetSelected);

        // $vmode = $this->input->get('vmode');
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

        $startDateq3 = htmlspecialchars($this->input->post('startDateq3'));
        $startDatev3 = htmlspecialchars($this->input->post('startDatev3'));
        $startDatebq3 = htmlspecialchars($this->input->post('startDatebq3'));
        $startDatebv3 = htmlspecialchars($this->input->post('startDatebv3'));

        $startDateq4 = htmlspecialchars($this->input->post('startDateq4'));
        $startDatev4 = htmlspecialchars($this->input->post('startDatev4'));
        $startDatebq4 = htmlspecialchars($this->input->post('startDatebq4'));
        $startDatebv4 = htmlspecialchars($this->input->post('startDatebv4'));

        $startDateq5 = htmlspecialchars($this->input->post('startDateq5'));
        $startDatev5 = htmlspecialchars($this->input->post('startDatev5'));
        $startDatebq5 = htmlspecialchars($this->input->post('startDatebq5'));
        $startDatebv5 = htmlspecialchars($this->input->post('startDatebv5'));

        $status = htmlspecialchars($this->input->post('status'));
        $sys_cat_name = $this->input->post('sysCatName');
        $sub_sys_cat = $this->input->post('subSysCat');

        $catCode = $this->input->post('catCode');

        $draw   = $this->input->post('draw');
        $start  = $this->input->post('start');
        $length = $this->input->post('length');

        // if ($this->input->post('search')['value']) {
        $search = str_replace("'", "", strtolower($this->input->post('search')['value']));
        $searchTerms = explode(" ",  $search);
        // }
        isset($this->input->post('order')[0]['column']) ? $this->input->post('order')[0]['column'] : '';
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
        $query_params_where_between = [];
        $query_groups_where_between = [];

        ///////// ADVANCED SEACRH DATE ///////////////////
        if ($startDateq3 != '') {

            $startDateq3_query_params = [
                "column" => $startDateq3,
                "value" => $startDatev3,
            ];
            array_push($query_params_where_between, $startDateq3_query_params);
        }

        if ($startDatebq3 != '') {

            $startDatebq3_query_params = [
                "column" => $startDatebq3,
                "value" => $startDatebv3,
            ];
            array_push($query_params_where_between, $startDatebq3_query_params);
        }

        if ($startDateq4 != '') {

            $startDateq4_query_params = [
                "column" => $startDateq4,
                "value" => $startDatev4,
            ];
            array_push($query_params_where_between, $startDateq4_query_params);
        }

        if ($startDatebq4 != '') {

            $startDatebq4_query_params = [
                "column" => $startDatebq4,
                "value" => $startDatebv4,
            ];
            array_push($query_params_where_between, $startDatebq4_query_params);
        }

        if ($startDateq5 != '') {

            $startDateq5_query_params = [
                "column" => $startDateq5,
                "value" => $startDatev5,
            ];
            array_push($query_params_where_between, $startDateq5_query_params);
        }

        if ($startDatebq5 != '') {

            $startDatebq5_query_params = [
                "column" => $startDatebq5,
                "value" => $startDatebv5,
            ];
            array_push($query_params_where_between, $startDatebq5_query_params);
        }

        ///////// ADVANCED SEACRH DATE ///////////////////

        if ($array['search'] != '') {

            $id_assetQuery_params = [
                "column" => "idAsset",
                "value" => $array['search']
            ];
            array_push($query_params_like_or, $id_assetQuery_params);

            $asset_name_query_params = [
                "column" => "assetName",
                "value" => $array['search']
            ];
            array_push($query_params_like_or, $asset_name_query_params);

            // $asset_code_query_params = [
            //     "columns"   => "assetCode",
            //     "value"     => $array['search']
            // ];
            // array_push($query_params_like_or, $asset_code_query_params);

            $cat_code_query_params = [
                "column" => "catCode",
                "value" => $array['search']
            ];
            array_push($query_params_like_or, $cat_code_query_params);

            $room_name_query_params = [
                "column" => "roomName",
                "value" => $array['search']
            ];
            array_push($query_params_like_or, $room_name_query_params);

            $merk_query_params = [
                "column" => "parentAssetID",
                "value" => $array['search']
            ];
            array_push($query_params_like_or, $merk_query_params);

            $ecri_code_query_params = [
                "column" => "ecriCode",
                "value" => $array['search']
            ];
            array_push($query_params_like_or, $ecri_code_query_params);
            $tipe_query_params = [
                "column" => "tipe",
                "value" => $array['search']
            ];
            array_push($query_params_like_or, $tipe_query_params);
            $building_query_params = [
                "column" => "buildingName",
                "value" => $array['search']
            ];
            array_push($query_params_like_or, $building_query_params);
            $floorName_query_params = [
                "column" => "floorName",
                "value" => $array['search']
            ];
            array_push($query_params_like_or, $floorName_query_params);
            $merk_query_params = [
                "column" => "merk",
                "value" => $array['search']
            ];
            array_push($query_params_like_or, $merk_query_params);
            $tipe_query_params = [
                "column" => "tipe",
                "value" => $array['search']
            ];
            array_push($query_params_like_or, $tipe_query_params);
            $serial_number_query_params = [
                "column" => "serialNumber",
                "value" => $array['search']
            ];
            array_push($query_params_like_or, $serial_number_query_params);
            $kode_bar_query_params = [
                "column" => "kodeBar",
                "value" => $array['search']
            ];
            array_push($query_params_like_or, $kode_bar_query_params);
            $ownership_query_params = [
                "column" => "ownershipType",
                "value" => $array['search']
            ];
            array_push($query_params_like_or, $ownership_query_params);

            $year_procurement_query_params = [
                "column" => "yearProcurement",
                "value" => $array['search']
            ];
            array_push($query_params_like_or, $year_procurement_query_params);
            $risk_level_query_params = [
                "column" => "riskLevel",
                "value" => $array['search']
            ];
            array_push($query_params_like_or, $risk_level_query_params);
        }

        if ($catCode != 'ALL') {
            if ($catCode != '') {
                $catCodes = explode('-', $catCode);

                foreach ($catCodes as $catCode) {
                    if ($catCode) {
                        $catCode_query_params = [
                            "column" => "catCode",
                            "value" => $catCode
                        ];
                        array_push($query_params_like_or, $catCode_query_params);
                    }
                }
            }
        }

        if ($sys_cat_name != '') {
            $sys_cat_name_query_params = [
                "column" => "sysCatName",
                "value" => $sys_cat_name
            ];
            array_push($query_params, $sys_cat_name_query_params);
        }

        // if ($sub_sys_cat != '') {
        //     $sub_sys_cat_query_params = [
        //         "column" => "subSysCat",
        //         "value" => "UNITS"
        //     ];
        //     array_push($query_params_where_or, $sub_sys_cat_query_params);

        //     $sub_sys_cat_query_params = [
        //         "column" => "subSysCat",
        //         "value" => "INS"
        //     ];
        //     array_push($query_params_where_or, $sub_sys_cat_query_params);
        // }

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
        if ($q1 != '' || $q2 != '' || $q3 != '' || $bq3 != '' || $q4 != '' || $bq4 != '' || $q5 != '' || $bq5 != '' || $q6 != '' || $bq6 != '' || $q7 != '' || $bq7 != '' || $q8 != '' || $bq8 != '' || $q9 != '' || $bq9 != '' || $q10 != '' || $bq10 != '' || $sys_cat_name != '' || $status != '') {

            if (($q1 != '' && $q2 != '') || ($q3 != '' && $bq3 != '') || ($q4 != '' && $bq4 != '') ||  ($q5 != '' && $bq5 != '')  || ($q6 != '' && $bq6 != '') || ($q7 != '' && $bq7 != '') || ($q8 != '' && $bq8 != '') || ($q9 != '' && $bq9 != '') || ($q10 != '' && $bq10 != '')) {
                if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
                    $query_groups_like_or = [
                        [
                            "queryMethod" => "LIKEOR",
                            "queryParams" => $query_params_like_or
                        ]
                    ];
                }
            }
            // parsing all
            $query_groups = [
                [
                    "queryMethod" => "LIKEAND",
                    "queryParams" => $query_params
                ],
                [
                    "queryMethod" => "EXACTOR",
                    "queryParams" => [
                        [
                            "column" => "subSysCat",
                            "value" => "UNITS"
                        ],
                        [
                            "column" => "subSysCat",
                            "value" => "INST"
                        ],
                        [
                            "column" => "subSysCat",
                            "value" => "ACCS"
                        ]
                    ]
                ]
            ];
        }

        if ($catCode != 'ALL') {
            if ($catCode != '') {
                $query_groups_like_or = [
                    [
                        "queryMethod" => "LIKEOR",
                        "queryParams" => $query_params_like_or
                    ]
                ];
            }
        }

        // diganti jadi yang ini
        if ($array['search'] != '') {
            $query_groups_like_or = [
                [
                    "queryMethod" => "LIKEOR",
                    "queryParams" => $query_params_like_or
                ]
            ];
        }

        // sama yang ini
        if ($catCode != 'ALL') {
            if ($catCode != '') {
                $query_groups_like_or = [
                    [
                        "queryMethod" => "LIKEOR",
                        "queryParams" => $query_params_like_or
                    ]
                ];
            }
        }

        if ($startDateq3 != '' || $startDatev3 != '' || $startDatebq3 != '' || $startDatebv3 != '' || $startDateq4 != '' || $startDatev4 != '' || $startDatebq4 != '' || $startDatebv4 != '' || $startDateq5 != '' || $startDatev5 != '' || $startDatebq5 != '' || $startDatebv5 != '') {
            $query_groups_where_between = [
                [
                    "queryMethod" => "BETWEEN",
                    "queryParams" => $query_params_where_between
                ]
            ];
        }

        $merge_query_groups = array_merge($query_groups, $query_groups_like_or);
        $merge_query_groups = array_merge($merge_query_groups, $query_groups_where_between);

        // $count_asset = $this->m_asset->assetQuery(
        //     [
        //         "queryGroupMethod" => "AND",
        //         "queryGroups" => $merge_query_groups ? $merge_query_groups : [],
        //         'page' => 1,
        //         'limit' => 1
        //     ]
        // );


        $page = ($start / $length) + 1;

        $request = [
            "queryGroupMethod" => "AND",
            "queryGroups" => $merge_query_groups ? $merge_query_groups : [],
            "sortingParams" => [
                [
                    "column" => "idAsset",
                    "value" => "desc"
                ]
            ],
            "page" =>  $page,
            "limit" =>  isset($length) ? (int)$length : 10
        ];

        $posts = $this->m_asset->assetQuery($request);

        $totalFiltered = $posts['dataCount'];

        if (sizeof($posts) > 0) {
            $no = $start + 1;
            foreach ($posts['data'] as $key => $value) {
                $idAsset = $value['idAsset'];
                $catCode = $value['catCode'];

                $code = $value['catCode'] . "-" . $value['idAsset'];
                $assetName = $value['assetName'];
                $merk = empty($value['propAssetPropgenit']['merk']) ? '-' : $value['propAssetPropgenit']['merk'];
                $tipe = empty($value['propAssetPropgenit']['tipe']) ? '-' : $value['propAssetPropgenit']['tipe'];
                $serialNumber = empty($value['propAssetPropgenit']['serialNumber']) ? '-' : $value['propAssetPropgenit']['serialNumber'];
                $roomName = empty($value['propAssetPropadmin']['propAssetPropbuildingRoom']['roomName']) ? '-' : $value['propAssetPropadmin']['propAssetPropbuildingRoom']['roomName'];
                $year = empty($value['propAssetPropadmin']['procureDate']) ? '-' : date('Y', strtotime($value['propAssetPropadmin']['procureDate']));

                if ($idAsset == $postIdAsset) {
                    $checked = 'checked';
                } else {
                    $checked = '';
                }

                $check_box_checked = '';
                if (count($idAssets) > 0) {
                    if (in_array($idAsset, $idAssets)) {
                        $check_box_checked = 'checked';
                    }
                }
                $posts['data'][$key]['check_box_cuk'] = "<input {$check_box_checked} type='checkbox' id='delcheck_{$idAsset}'  name='msg[]' class='delete_check' value='{$idAsset}' />";
                $posts['data'][$key]['radioButton'] = "<input type='radio' {$checked} data-code='{$code}' data-asset_name='{$assetName}' data-merk='{$merk}' data-tipe='{$tipe}' data-sn='{$serialNumber}' data-room='{$roomName}' id='selected-asset' name='msg[]' value={$idAsset}>";

                $posts['data'][$key]['assetCode'] = "{$catCode}-{$idAsset}";
                $posts['data'][$key]['no'] = $no;
                $posts['data'][$key]['procureDate'] = $year;

                if ($value['propAssetProptax'] != null) {
                    $posts['data'][$key]['residuVal'] = number_format($value['propAssetProptax']['residuVal'], 0, ',', '.');
                    $posts['data'][$key]['yearlyDep'] = number_format($value['propAssetProptax']['yearlyDep'], 0, ',', '.');
                    $posts['data'][$key]['cost'] = number_format($value['propAssetProptax']['cost'], 0, ',', '.');
                    $posts['data'][$key]['accuVal'] = number_format($value['propAssetProptax']['accuVal'], 0, ',', '.');
                    $posts['data'][$key]['bookVal'] = number_format($value['propAssetProptax']['bookVal'], 0, ',', '.');
                    $posts['data'][$key]['expectedLifeTime'] = $value['propAssetProptax']['expectedLifeTime'] . " Year";

                    $posts['data'][$key]['calibMust'] = $value['propAssetMaster']['calibMust'] == true ? 'YES' : 'NO';
                }


                if (isset($value['propAssetPropmedeq']['lastUpdated'])) {
                    $date = $value['propAssetPropmedeq']['lastUpdated'];
                    $dt = new DateTime($date);
                }

                $posts['data'][$key]['lastCalibrated'] = isset($dt) ? $dt->format('Y-m-d') : '';

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
            "query_message"   => $posts['queryMessage']
        ];

        echo json_encode($json_data);
    }

    public function asset_data_task()
    {
    }

    public function view_data()
    {

        $query_where_or_params = [];

        $sysCatName_params = [
            "column" => "sysCatName",
            "value" => "MED"
        ];
        array_push($query_where_or_params, $sysCatName_params);

        $query_group_where_or = [
            [
                "queryMethod" => "EXACTOR",
                "queryParams" => $query_where_or_params
            ]
        ];

        $data_request = [
            "queryGroupMethod" => "AND",
            "queryGroups" => $query_group_where_or,
            "page" => 1,
            "sortingParams" => [
                [
                    "column" => "idAsset",
                    "value" => "desc"
                ]
            ],
            // "limit" => 15,
            "withDetails" => true,
            "subDetails" => true
        ];

        $result = $this->m_asset->assetQuery($data_request);

        $vmode = $this->input->get('vmode');

        // var_dump($result);
        // die;
        $data = [];
        foreach ($result['data'] as $key => $val) {

            if ($val['propAssetPropmedeq']['calibrationMust'] == true) {
                $cetak_calibMust = 'YES';
            } elseif ($val['propAssetPropmedeq']['calibrationMust'] == false) {
                $cetak_calibMust = 'NO';
            } else {
                $cetak_calibMust = '-';
            }

            $nama_merk = $this->m_brand->brandById($val['propAssetPropgenit']['merk']);



            // switch ($vmode) {
            //     case "Inventory":
            //         $row = [];
            //         $row['null']                = '<input type="checkbox"  class="generate_checkbox" name="msg[]" value="' . $val['idAsset'] . '">';
            //         $row['no']                  = ++$key;
            //         $row['assetCode']           = $val['catCode'] . "-" . $val['idAsset'];
            //         $row['kodeBar']             = $val['kodeBar'];
            //         $row['assetName']            = $val['assetName'];
            //         $row['merk']                = empty($val['propAssetPropgenit']['merk']) ? '-' : $val['propAssetPropgenit']['merk'];
            //         $row['tipe']                = empty($val['propAssetPropgenit']['tipe']) ? '-' : $val['propAssetPropgenit']['tipe'];
            //         $row['serialNumber']         =  empty($val['propAssetPropgenit']['serialNumber']) ? '-' : $val['propAssetPropgenit']['serialNumber'];
            //         $row['roomName']             =  empty($val['propAssetPropadmin']['propAssetPropbuildingRoom']['roomName']) ? '-' : $val['propAssetPropadmin']['propAssetPropbuildingRoom']['roomName'];
            //         $row['floorName']            =  empty($val['propAssetPropadmin']['propAssetPropbuildingRoom']['floorName']) ? '-' : $val['propAssetPropadmin']['propAssetPropbuildingRoom']['floorName'];
            //         $row['buildingName']         =  empty($val['propAssetPropadmin']['propAssetPropbuildingRoom']['buildingName']) ? '-' : $val['propAssetPropadmin']['propAssetPropbuildingRoom']['buildingName'];
            //         $row['yearProcurement']      =  empty($val['propAssetPropadmin']['yearProcurement']) ? '-' : $val['propAssetPropadmin']['yearProcurement'];
            //         $row['condition']            =  empty($val['propAssetPropadmin']['condition']) ? '-' : $val['propAssetPropadmin']['condition'];
            //         $row['contactCompany']       =  empty($val['propAssetPropadmin']['propContact']['contactCompany']) ? '-' : $val['propAssetPropadmin']['propContact']['contactCompany'];
            //         $row['lastUpdated']          =  empty($val['propAssetPropmedeq']['lastUpdated']) ? '-' : date('d-m-Y', strtotime($val['propAssetPropmedeq']['lastUpdated']));
            //         $row['calibMust']            =  $cetak_calibMust;
            //         $row['ownershipType']        =  empty($val['propAssetPropadmin']['ownershipType']) ? '-' : $val['propAssetPropadmin']['ownershipType'];
            //         $row['riskLevel']            =  empty($val['propAssetPropadmin']['riskLevel']) ? '-' : $val['propAssetPropadmin']['riskLevel'];

            //         $data[] = $row;

            //         break;
            //     case "Aspak":

            //         $row = [];
            //         $row['null']                = '<input type="checkbox"  class="generate_checkbox" name="msg[]" value="' . $val['idAsset'] . '">';
            //         $row['no']                  = ++$key;
            //         $row['assetCode']           = $val['catCode'] . "-" . $val['idAsset'];
            //         $row['kodeBar']             = $val['kodeBar'];
            //         $row['aspakCode'] = $val['propAssetMaster']['aspakCode'];
            //         $row['assetName']            = $val['assetName'];
            //         $row['yearProcurement']      =  empty($val['propAssetPropadmin']['yearProcurement']) ? '-' : $val['propAssetPropadmin']['yearProcurement'];
            //         $row['condition']            =  empty($val['propAssetPropadmin']['condition']) ? '-' : $val['propAssetPropadmin']['condition'];
            //         $row['lastUpdated']          =  empty($val['propAssetPropmedeq']['lastUpdated']) ? '-' : date('d-m-Y', strtotime($val['propAssetPropmedeq']['lastUpdated']));


            //         $data[] = $row;
            //         break;
            //     case "Finance":

            //         $row = [];
            //         $row['null']                = '<input type="checkbox"  class="generate_checkbox" name="msg[]" value="' . $val['idAsset'] . '">';
            //         $row['no']                  = ++$key;
            //         $row['assetCode']           = $val['catCode'] . "-" . $val['idAsset'];
            //         $row['assetName']            = $val['assetName'];
            //         $row['presentDate']         = empty($val['propAssetProptax']['presentDate']) ? '-' : $val['propAssetProptax']['presentDate'];
            //         $row['taxCategory']         = empty($val['propAssetProptax']['taxCategory']) ? '-' : $val['propAssetProptax']['taxCategory'];
            //         $row['cost']                = empty($val['propAssetProptax']['cost']) ? '-' : $val['propAssetProptax']['cost'];
            //         $row['bookVal']             = empty($val['propAssetProptax']['bookVal']) ? '-' : $val['propAssetProptax']['bookVal'];


            //         $data[] = $row;
            //         break;
            //     case "Utilization":

            //         $row = [];
            //         $row['null']                = '<input type="checkbox"  class="generate_checkbox" name="msg[]" value="' . $val['idAsset'] . '">';
            //         $row['no']                  = ++$key;
            //         $row['assetCode']                       = $val['catCode'] . '-' . $val['idAsset'];
            //         $row['assetName']                       = $val['assetName'];
            //         $row['condition']                       = empty($val['propAssetPropadmin']['condition']) ? '-' : $val['propAssetPropadmin']['condition'];

            //         $data[] = $row;
            //         break;
            //     case "Performance":

            //         $row = [];
            //         $row['null']                = '<input type="checkbox"  class="generate_checkbox" name="msg[]" value="' . $val['idAsset'] . '">';
            //         $row['no']                  = ++$key;
            //         $row['assetCode']                       = $val['catCode'] . '-' . $val['idAsset'];
            //         $row['assetName']                       = $val['assetName'];
            //         $row['status']                          = empty($val['propAssetPropadmin']['status']) ? '-'  : $val['propAssetPropadmin']['status'];


            //         $data[] = $row;

            //         break;
            //     default:

            $row = [];
            $row['null']                = '<input type="checkbox"  class="generate_checkbox" name="msg[]" value="' . $val['idAsset'] . '">';
            $row['no']                  = ++$key;
            $row['assetCode']           = $val['catCode'] . "-" . $val['idAsset'];
            $row['kodeBar']             = $val['kodeBar'];
            $row['assetName']            = $val['assetName'];
            $row['merk']                = empty($val['propAssetPropgenit']['merk']) ? '-' : $val['propAssetPropgenit']['merk'];
            $row['tipe']                = empty($val['propAssetPropgenit']['tipe']) ? '-' : $val['propAssetPropgenit']['tipe'];
            $row['serialNumber']         =  empty($val['propAssetPropgenit']['serialNumber']) ? '-' : $val['propAssetPropgenit']['serialNumber'];
            $row['roomName']             =  empty($val['propAssetPropadmin']['propAssetPropbuildingRoom']['roomName']) ? '-' : $val['propAssetPropadmin']['propAssetPropbuildingRoom']['roomName'];
            $row['floorName']            =  empty($val['propAssetPropadmin']['propAssetPropbuildingRoom']['floorName']) ? '-' : $val['propAssetPropadmin']['propAssetPropbuildingRoom']['floorName'];
            $row['buildingName']         =  empty($val['propAssetPropadmin']['propAssetPropbuildingRoom']['buildingName']) ? '-' : $val['propAssetPropadmin']['propAssetPropbuildingRoom']['buildingName'];
            $row['yearProcurement']      =  empty($val['propAssetPropadmin']['yearProcurement']) ? '-' : $val['propAssetPropadmin']['yearProcurement'];
            $row['condition']            =  empty($val['propAssetPropadmin']['condition']) ? '-' : $val['propAssetPropadmin']['condition'];
            $row['contactCompany']       =  empty($val['propAssetPropadmin']['propContact']['contactCompany']) ? '-' : $val['propAssetPropadmin']['propContact']['contactCompany'];
            $row['lastUpdated']          =  empty($val['propAssetPropmedeq']['lastUpdated']) ? '-' : date('d-m-Y', strtotime($val['propAssetPropmedeq']['lastUpdated']));
            $row['calibMust']            =  $cetak_calibMust;
            $row['ownershipType']        =  empty($val['propAssetPropadmin']['ownershipType']) ? '-' : $val['propAssetPropadmin']['ownershipType'];
            $row['riskLevel']            =  empty($val['propAssetPropadmin']['riskLevel']) ? '-' : $val['propAssetPropadmin']['riskLevel'];

            $data[] = $row;
            // }
        }
        // echo "<pre>";
        // var_dump($data);
        // die;
        // echo "</pre>";
        //merubah bentuk array ke bentuk json untuk datatables
        echo '{"draw":1,"recordsTotal":' . count($data) . ',"recordsFiltered":' . count($data) . ',"data":';
        echo json_encode($data);
        echo '}';
    }
}

/* End of file Inventory_data_table.php */
