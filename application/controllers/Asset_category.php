<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Asset_category extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->simple_login->cek_login(); // cek login
        $this->load->model([
            'M_asset'                       => 'm_asset',
            'M_asset_category'     => 'm_asset_category',
        ]);
    }

    public function asset_category_query()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $catCode = $this->input->get('catCode') ? $this->input->get('catCode') : "";
        $sysCatName = $this->input->get('sysCatName') ? $this->input->get('sysCatName') : "";
        $sysCatNameAsset = $this->input->get('sysCatNameAsset') ? $this->input->get('sysCatNameAsset') : "";
        $q = $this->input->get('q') ? $this->input->get('q') : "";
        $limit = $this->input->get('limit') == 0 ? $this->input->get('limit') : 20;

        $query_params = [];
        $query_params_like_or = [];

        $query_groups_like_or = [];
        $query_groups = [];

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

        if ($sysCatName != 'ALL') {
            if ($sysCatName != '') {

                $sysCatNames = explode('-', $sysCatName);
                foreach ($sysCatNames as $sysCatName) {
                    if ($sysCatName) {
                        $sysCatName_query_params = [
                            "column" => "sysCatName",
                            "value" => $sysCatName
                        ];
                        array_push($query_params_like_or, $sysCatName_query_params);
                    }
                }
            }
        }

        if ($sysCatNameAsset != 'ALL') {
            if ($sysCatNameAsset != '') {

                $sysCatNameAssets = explode('-', $sysCatNameAsset);
                foreach ($sysCatNameAssets as $sysCatNameAsset) {
                    if ($sysCatNameAsset) {
                        $sysCatNameAsset_query_params = [
                            "column" => "sysCatName",
                            "value" => $sysCatNameAsset
                        ];
                        array_push($query_params, $sysCatNameAsset_query_params);
                    }
                }
            }
        }

        if ($q != '') {
            $assetCatName_query_params = [
                "column" => "assetCatName",
                "value" => $q
            ];
            array_push($query_params, $assetCatName_query_params);
        }

        if ($catCode != 'ALL') {
            if ($catCode !== '') {
                $query_groups_like_or = [
                    [
                        "queryMethod" => "LIKEOR",
                        "queryParams" => $query_params_like_or
                    ]
                ];
            }
        }

        if ($sysCatName != 'ALL') {
            if ($sysCatName !== '') {
                $query_groups_like_or = [
                    [
                        "queryMethod" => "EXACTOR",
                        "queryParams" => $query_params_like_or
                    ]
                ];
            }
        }

        if ($q != '' || $sysCatNameAsset != '') {
            $query_groups = [
                [
                    "queryMethod" => "LIKEAND",
                    "queryParams" => $query_params
                ]
            ];
        }

        $merge_query_groups = array_merge($query_groups, $query_groups_like_or);

        $request = [
            "queryGroupMethod" => "AND",
            // "queryGroups" => $query_params ? $query_params : $merge_query_groups ? $merge_query_groups : [],
            "queryGroups" => $merge_query_groups ? $merge_query_groups : [],
            "page" => 0, //$page,
            "limit" =>  0 //$limit
        ];

        $asset_category = $this->m_asset_category->assetCatQuery($request);

        echo json_encode($asset_category);
    }

    public function asset_category_query_master()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $catCode = $this->input->get('catCode') ? $this->input->get('catCode') : "";
        $sysCatName = $this->input->get('sysCatName') ? $this->input->get('sysCatName') : "";
        $sysCatNameAsset = $this->input->get('sysCatNameAsset') ? $this->input->get('sysCatNameAsset') : "";
        $q = $this->input->get('q') ? $this->input->get('q') : "";
        $limit = $this->input->get('limit') == 0 ? $this->input->get('limit') : 20;

        $query_params = [];
        $query_params_like_or = [];

        $query_groups_like_or = [];
        $query_groups = [];

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

        if ($sysCatName != 'ALL') {
            if ($sysCatName != '') {

                $sysCatNames = explode('-', $sysCatName);
                foreach ($sysCatNames as $sysCatName) {
                    if ($sysCatName) {
                        $sysCatName_query_params = [
                            "column" => "sysCatName",
                            "value" => $sysCatName
                        ];
                        array_push($query_params_like_or, $sysCatName_query_params);
                    }
                }
            }
        }

        if ($sysCatNameAsset != 'ALL') {
            if ($sysCatNameAsset != '') {

                $sysCatNameAssets = explode('-', $sysCatNameAsset);
                foreach ($sysCatNameAssets as $sysCatNameAsset) {
                    if ($sysCatNameAsset) {
                        $sysCatNameAsset_query_params = [
                            "column" => "sysCatName",
                            "value" => $sysCatNameAsset
                        ];
                        array_push($query_params, $sysCatNameAsset_query_params);
                    }
                }
            }
        }

        if ($q != '') {
            $assetCatName_query_params = [
                "column" => "assetCatName",
                "value" => $q
            ];
            array_push($query_params, $assetCatName_query_params);
        }

        if ($catCode != 'ALL') {
            if ($catCode !== '') {
                $query_groups_like_or = [
                    [
                        "queryMethod" => "LIKEOR",
                        "queryParams" => $query_params_like_or
                    ]
                ];
            }
        }

        if ($sysCatName != 'ALL') {
            if ($sysCatName !== '') {
                $query_groups_like_or = [
                    [
                        "queryMethod" => "EXACTOR",
                        "queryParams" => $query_params_like_or
                    ]
                ];
            }
        }

        if ($q != '' || $sysCatNameAsset != '') {
            $query_groups = [
                [
                    "queryMethod" => "LIKEAND",
                    "queryParams" => $query_params
                ]
            ];
        }

        $merge_query_groups = array_merge($query_groups, $query_groups_like_or);

        $request = [
            "queryGroupMethod" => "AND",
            // "queryGroups" => $query_params ? $query_params : $merge_query_groups ? $merge_query_groups : [],
            "queryGroups" => $merge_query_groups ? $merge_query_groups : [],
            "page" => 0, //$page,
            "limit" =>  0 //$limit
        ];

        $asset_category = $this->m_asset_category->assetCatQuery($request);

        echo json_encode($asset_category['data']);
    }
}

/* End of file Asset_category.php */
