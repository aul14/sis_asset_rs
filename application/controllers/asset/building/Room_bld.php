<?php


defined('BASEPATH') or exit('No direct script access allowed');

use chillerlan\QRCode\QRCode;

class Room_bld extends CI_Controller
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
            'M_asset_unit'          => 'm_asset_unit',
            'M_org'          => 'm_org',
            'M_user'          => 'm_user',
        ]);
    }

    public function index()
    {
        $unit = $this->m_asset_unit->assetUnitList();
        $data['unit']   = $unit['data'];

        $result_role = $this->m_access_control->MyRole()['data']['roleACL'];

        $data['result_role'] = $result_role;
        $this->load->model('M_notifikasi', 'm_notifikasi');
        $data['notif'] = $this->m_notifikasi->list()['data'];

        if ($result_role[1]['subMenu1'][2]['subMenu2'][1]['isAllow'] != true) {
            exit('You dont have access!!');
        }

        $this->load->view('components/header');
        $this->load->view('components/sidebar', $data);
        $this->load->view('assets/building/room_bld_index');
        $this->load->view('assets/building/form/room_form', $data);
        $this->load->view('assets/building/print/assets_print_room');
        $this->load->view('components/sidebar_footer');
        $this->load->view('components/footer');
        $this->load->view('assets/assets_room_bld');
    }

    public function room_data_table()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $draw   = $this->input->post('draw');
        $start  = $this->input->post('start');
        $length = $this->input->post('length');
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
        if ($array['search']) {
            $room_name_query_params = [
                "column" => "roomName",
                "value" => $array['search']
            ];
            array_push($query_params, $room_name_query_params);

            $Floor_name_query_params = [
                "column" => "floorName",
                "value" => $array['search']
            ];
            array_push($query_params, $Floor_name_query_params);

            $building_name_query_params = [
                "column" => "buildingName",
                "value" => $array['search']
            ];
            array_push($query_params, $building_name_query_params);

            $room_code_query_params = [
                "column" => "roomCode",
                "value" => $array['search']
            ];
            array_push($query_params, $room_code_query_params);
        }

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

        $query_groups_like_or = [];
        $query_groups = [];
        if ($q1 != '' || $q2 != '' || $q3 != '' || $bq3 != '' || $q4 != '' || $bq4 != '' || $q5 != '' || $bq5 != '' || $q6 != '' || $bq6 != '' || $q7 != '' || $bq7 != '' || $q8 != '' || $bq8 != '' || $q9 != '' || $bq9 != '' || $q10 != '' || $bq10 != '') {

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
                ]
            ];
        }

        if ($startDateq3 != '' || $startDatev3 != '' || $startDatebq3 != '' || $startDatebv3 != '' || $startDateq4 != '' || $startDatev4 != '' || $startDatebq4 != '' || $startDatebv4 != '' || $startDateq5 != '' || $startDatev5 != '' || $startDatebq5 != '' || $startDatebv5 != '') {
            $query_groups_where_between = [
                [
                    "queryMethod" => "BETWEEN",
                    "queryParams" => $query_params_where_between
                ]
            ];
        }

        if ($array['search'] != '') {
            $query_groups = [
                [
                    "queryMethod" => "LIKEOR",
                    "queryParams" => $query_params
                ]
            ];
        }

        $merge_query_groups = array_merge($query_groups, $query_groups_like_or);
        $merge_query_groups = array_merge($merge_query_groups, $query_groups_where_between);

        // $count_asset = $this->m_asset_propbuilding_room->assetPropBuildingRoomQuery(
        //     [
        //         "queryGroupMethod" => "AND",
        //         "queryGroups" => $query_params ? $query_groups : [],
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
                    "column" => "idRoom",
                    "value" => "desc"
                ]
            ],
            "page" =>  $page,
            "limit" =>  (int)$length
        ];

        $posts = $this->m_asset_propbuilding_room->assetPropBuildingRoomQuery($request);

        $totalFiltered = $posts['dataCount'];

        if (sizeof($posts) > 0) {
            foreach ($posts['data'] as $key => $value) {
                $idRoom = $value['idRoom'];

                $posts['data'][$key]['room_code'] = "ROOM" . '-' . $value['idRoom'];
                $posts['data'][$key]['buildingArea'] = $value['roomSpace'] . ' ' . $value['spaceUnit'];
                $posts['data'][$key]['electricalPower'] = $value['roomPower'] . ' ' . $value['powerUnit'];
                $posts['data'][$key]['check_box_cuk'] = "<input  type='checkbox' id='delcheck_{$idRoom}'  name='msg[]' class='delete_check' value='{$idRoom}' />";
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
            "query_groups"    => $request
        ];

        echo json_encode($json_data);
        die;
    }

    public function store()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $input = $this->security->xss_clean($this->input->post());
        $building_name = $this->security->xss_clean($this->input->post('buildingName'));
        $roomName = $this->security->xss_clean($this->input->post('roomName'));

        $propbuilding_room = $this->m_asset_propbuilding_room->data(
            $input['idBuilding'],
            $input['idFloor'],
            $input['buildingName'],
            $input['floorName'],
            !empty($input['idRoom']) ? $input['idRoom'] : 0,
            $input['roomName'],
            !empty($input['roomCode']) ? $input['roomCode'] : "",
            $input['roomDesc'],
            $input['bedCount'],
            $input['roomSpace'],
            $input['spaceUnit'],
            $input['roomPower'],
            $input['powerUnit'],
            $input['roomPJID'],
            $input['roomPJName'],
            $input['workUnit'],
            $input['isWarehouse']
        );

        // echo json_encode($propbuilding_room);
        // die;

        if (!empty($input['idRoom'])) {
            $asset_propbuilding_room = $this->m_asset_propbuilding_room->assetPropBuildingRoomUpdate($propbuilding_room);
            // if ($asset_propbuilding_room['queryResult'] == true) {
            //     $this->session->set_flashdata('sukses', "Success, data updated successfully with room name {$roomName}");
            // } else {
            //     $message = $asset_propbuilding_room['queryMessage'] ? $asset_propbuilding_room['queryMessage'] : 'Failed';
            //     $this->session->set_flashdata('error', $message);
            // }

            // redirect('asset/building/room_bld', 'refresh');
        } else {
            $asset_propbuilding_room = $this->m_asset_propbuilding_room->assetPropBuildingRoomInsert($propbuilding_room);
            // if ($asset_propbuilding_room['queryResult'] == true) {
            //     $this->session->set_flashdata('sukses', "Success, data saved successfully with room name {$roomName}");
            // } else {
            //     $message = $asset_propbuilding_room['queryMessage'] ? $asset_propbuilding_room['queryMessage'] : 'Failed';
            //     $this->session->set_flashdata('error', $message);
            // }

            // redirect('asset/building/room_bld', 'refresh');
        }
        echo json_encode($asset_propbuilding_room);
        die;
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
            if ($q1 != '' || $q2 != '' || $q3 != '' || $bq3 != '' || $q4 != '' || $bq4 != '' || $q5 != '' || $bq5 != '' || $q6 != '' || $bq6 != '' || $q7 != '' || $bq7 != '' || $q8 != '' || $bq8 != '' || $q9 != '' || $bq9 != '' || $q10 != '' || $bq10 != '') {

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
                    ]
                ];
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

            $request = [
                "queryGroupMethod" => "AND",
                "queryGroups" =>  $merge_query_groups ? $merge_query_groups : [],
            ];

            $data['assets'] = $this->m_asset_propbuilding_room->assetPropBuildingRoomQuery($request);

            // echo "<pre>";
            // var_dump($data);
            // die;
            // echo "</pre>";


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
            $html = $this->load->view('assets/building/print/pdf_room', $data, TRUE);
            $mpdf->WriteHTML($html);
            $mpdf->Output();
        } else {
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
            if ($q1 != '' || $q2 != '' || $q3 != '' || $bq3 != '' || $q4 != '' || $bq4 != '' || $q5 != '' || $bq5 != '' || $q6 != '' || $bq6 != '' || $q7 != '' || $bq7 != '' || $q8 != '' || $bq8 != '' || $q9 != '' || $bq9 != '' || $q10 != '' || $bq10 != '') {

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
                    ]
                ];
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

            $request = [
                "queryGroupMethod" => "AND",
                "queryGroups" =>  $merge_query_groups ? $merge_query_groups : [],
            ];

            $data['assets'] = $this->m_asset_propbuilding_room->assetPropBuildingRoomQuery($request);

            $this->load->view('assets/building/print/excell_room', $data);
        }
    }

    public function room_by_id()
    {
        // 
        $show = [];
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $id_room = [];

        $id_room = $this->input->post('idRoom');

        foreach ($id_room as $key => $id) {
            $result = $this->m_asset_propbuilding_room->assetPropBuildingRoomById($id);
        }

        $show['data_update'] = $result['data'];

        echo json_encode($show);
        exit;
    }

    public function delete()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $id_room = [];

        if (!empty($this->input->post('idRoom'))) {
            $id_room = $this->input->post('idRoom');
        }

        // $id_asset = $this->input->post('idAsset');
        foreach ($id_room as $key => $id) {
            $asset = $this->m_asset_propbuilding_room->assetPropBuildingRoomDelete($id);
        }

        echo json_encode($asset);
        exit;
    }

    public function ajax_user_by_id()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $idUser = trim($this->input->post('idUser'));

        $user = $this->m_user->userById($idUser);

        echo json_encode($user['data']);
        exit;
    }

    public function ajax_user()
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
                            "column" => "userFullName",
                            "value" => $q
                        ]
                    ]
                ]
            ];
        }

        $request = [
            "queryGroupMethod" => "AND",
            "queryGroups" => $query_groups,
            // "page" =>  1,
            "limit" =>  25
        ];

        $org = $this->m_user->userQuery($request);

        echo json_encode($org['data']);
        exit;
    }

    public function user_query()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $q = $this->input->get('q');

        $query_groups = [];
        if (isset($q)) {
            $query_groups = [
                [
                    "queryMethod" => "LIKEOR",
                    "queryParams" => [
                        [
                            "column" => "userName",
                            "value" => $q
                        ],
                    ]
                ]
            ];
        }

        $request = [
            "queryGroupMethod" => "AND",
            "queryGroups" => $query_groups,
            "page" =>  1,
            "limit" =>  10
        ];

        $contact = $this->m_user->userQuery($request);

        echo json_encode($contact);
    }

    public function ajax_org()
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
                            "column" => "orgName",
                            "value" => $q
                        ]
                    ]
                ]
            ];
        }

        $request = [
            "queryGroupMethod" => "AND",
            "queryGroups" => $query_groups,
            // "page" =>  1,
            "limit" =>  25
        ];

        $org = $this->m_org->orgQuery($request);

        echo json_encode($org['data']);
        exit;
    }

    public function ajax_building_by_id()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $idAsset = trim($this->input->post('idAsset'));

        $building = $this->m_asset_propbuilding->assetPropbuildingById($idAsset);

        echo json_encode($building['data']);
        exit;
    }

    public function ajax_building_floor_by_idbuilding()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $idAsset = trim($this->input->post('idAsset'));
        $building = $this->m_asset_propbuilding_floor->assetPropbuildingFloorByIdBuilding($idAsset);

        echo json_encode($building['data']);
        exit;
    }

    public function ajax_building_floor_by_id()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $idFloor = trim($this->input->post('idFloor'));
        $floor = $this->m_asset_propbuilding_floor->assetPropbuildingFlooeById($idFloor);

        echo json_encode($floor['data']);
        exit;
    }

    public function ajax_building()
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
                            "column" => "buildingName",
                            "value" => $q
                        ]
                    ]
                ]
            ];
        }

        $request = [
            "queryGroupMethod" => "AND",
            "queryGroups" => $query_groups,
            // "page" =>  1,
            // "limit" =>  10
        ];

        $building = $this->m_asset_propbuilding->assetPropbuildingQuery($request);

        echo json_encode($building['data']);
        exit;
    }
}

/* End of file Room_bld.php */
