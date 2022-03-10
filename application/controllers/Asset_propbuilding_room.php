<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Asset_propbuilding_room extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->simple_login->cek_login(); // cek login
        $this->load->model([
            'M_asset'                       => 'm_asset',
            'M_asset_propbuilding_room'     => 'm_asset_propbuilding_room',
        ]);
    }

    public function asset_propbuilding_room_query()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $q = $this->input->get('q');
        $idBuilding = $this->input->get('idBuilding');
        $limit = $this->input->get('limit') == 0 ? $this->input->get('limit') : 20;

        $query_groups = [];
        $query_groups_like_or = [];
        $query_params_like_or = [];
        $query_params_like_and = [];
        if ($q != '') {
            $roomName_query_params = [
                "column" => "roomName",
                "value" => $q
            ];
            array_push($query_params_like_or, $roomName_query_params);
        }
        if ($idBuilding != '') {
            $idBuilding_query_params = [
                "column" => "idBuilding",
                "value" => $idBuilding
            ];
            array_push($query_params_like_and, $idBuilding_query_params);
        }

        if ($q != '') {
            $query_groups_like_or = [
                [
                    "queryMethod" => "LIKEOR",
                    "queryParams" => $query_params_like_or
                ]
            ];
        }

        if ($idBuilding != '') {
            $query_groups_like_or = [
                [
                    "queryMethod" => "LIKEAND",
                    "queryParams" => $query_params_like_and
                ]
            ];
        }

        $merge_query_groups = array_merge($query_groups, $query_groups_like_or);


        $request = [
            "queryGroupMethod" => "AND",
            "queryGroups" => $merge_query_groups,
            "page" =>  1,
            "limit" => $limit,
        ];

        $asset_propbuilding_room = $this->m_asset_propbuilding_room->assetPropBuildingRoomQuery($request);
        $asset_propbuilding_room['request'] = $request;

        echo json_encode($asset_propbuilding_room);
    }
}

/* End of file Asset_propbuilding_room.php */
