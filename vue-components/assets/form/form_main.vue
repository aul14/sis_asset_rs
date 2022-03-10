<template>
<div class="p-10">
    <p class="mandatory-info">Field marked <span>*</span> are required to fill or mandatory</p>
    <div class="row">
        <div class="col-xl-6">
            <div class="form-group row">
                <div class="col-xl-4 ">
                    <label class="form-title">asset category <span>*</span></label>
                </div>
                <div class="col-xl-8">
                    <input name="ajax_idassetmaster_edit" type="hidden" id="ajax_idassetmaster_edit" />
                    <!-- <select class="form-control selectpicker-catcodeKategori with-ajax-kategori" data-live-search="true" required name="catcode_kategori">
                      </select> -->
                    <slot name="kategori-tab"></slot>
                </div>
            </div>
            <div class="form-group row" id="ajax_catHasParent" style="display: none;">
                <div class="col-xl-4 ">
                    <label class="form-title">asset parent</label>
                </div>
                <div class="col-xl-8">
                    <input type="hidden" name="idParentAsset" id="idParentAsset">
                    <input type="hidden" name="catCodes" id="catCodes">
                    <select class="form-control selectpicker-parentAsset with-ajax-parentAsset" data-live-search="true" name="parentAssetID">
                        <option value="" id="option-ajax-parentasset">Tap to search</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xl-4 ">
                    <label class="form-title">asset name <span>*</span></label>
                </div>
                <div class="col-xl-8 select-asset-name">
                    <select class="form-control selectpicker-masterAsset with-ajax-masterAsset" onchange="onChangeMasterAsset();" data-live-search="true" required id="ajax_idAssetMaster" name="idAssetMaster">
                    </select>

                </div>
            </div>
            <div class="form-group row">
                <div class="col-xl-4 ">
                    <label class="form-title">alias name (optional)</label>
                </div>
                <div class="col-xl-8">
                    <input class="form-control" name="assetDesc" id="ajax_assetDesc" type="hidden" />
                    <input class="form-control" name="assetName" autocomplete="off" id="ajax_aliasName" type="text" />
                </div>
            </div>
            <div class="form-group row" id="row-brand">
                <div class="col-xl-4 ">
                    <label class="form-title">brand <span>*</span></label>
                </div>
                <div class="col-xl-8">
                    <div class="input-group">
                        <input name="propAssetPropgenit.idAsset" type="hidden" />
                        <select class="form-control selectpicker-merk with-ajax-merk" data-live-search="true" name="propAssetPropgenit_merk" id="ajax_merk">
                            <option value="" id="option-ajax-merk">Tap to search</option>
                        </select>
                        <div class="input-group-prepend">
                            <button class="btn samrs-primary" type="button" name="button" v-on:click="addbrand">+</button>
                        </div>
                    </div>
                </div>

            </div>
            <div class="form-group row" id="row-type">
                <div class="col-xl-4 ">
                    <label class="form-title">type</label>
                </div>
                <div class="col-xl-8">
                    <input class="form-control" name="propAssetPropgenit_tipe" type="text" />

                </div>
            </div>
            <div class="form-group row" id="row-serialno">
                <div class="col-xl-4 ">
                    <label class="form-title">serial no</label>
                </div>
                <div class="col-xl-8">
                    <input class="form-control" name="propAssetPropgenit_serialNumber" type="text" />
                </div>
            </div>
            <div class="form-group row" id="row-location">
                <div class="col-xl-4 ">
                    <label class="form-title">location / room <span style="color: red;">*</span></label>
                </div>
                <div class="col-xl-8">
                    <input class="form-control" name="propAssetPropadmin_idBuilding" type="hidden" />
                    <input class="form-control" name="propAssetPropadmin_idFloor" type="hidden" />
                    <input class="form-control" name="propAssetPropadmin_idRoom" type="hidden" />
                    <div class="input-group">
                        <input class="form-control readonly" type="text" id="ajax_lokasi" name="propAssetPropadmin_idRoom_not" required>
                        <!-- <select class="form-control selectpicker-lokasi with-ajax-lokasi" data-live-search="true" id="ajax_lokasi" name="propAssetPropadmin_idRoom" required>
                        </select> -->
                        <div class="input-group-prepend">
                            <button class="btn samrs-primary" type="button" name="button" v-on:click="selectlocation">Pick</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div id="ajax_tab_li_aspak" style="display: none;">

                <div class="pl-12 ml-12 bg-light">
                    <label class="form-title capitalize">aspak</label>
                </div>
                <div class="form-group row">
                    <div class="col-6">
                        <label class="form-title">aspak code</label>
                        <input name="propAssetPropaspak_idAsset" type="hidden" />
                        <input class="form-control" id="ajax_aspakCode" name="propAssetPropaspak_aspakCode" readonly type="text" />
                    </div>
                    <div class="col-6">
                        <label class="form-title">aspak name</label>
                        <input type="text" class="form-control" id="ajax_aspakName" readonly />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-6">
                        <label class="form-title">akl / akd number</label>
                        <input class="form-control" type="text" name="propAssetPropaspak_akdAkl" id="propAssetPropaspak_akdAkl">
                    </div>
                    <div class="col-6">
                        <label class="form-title">room standard aspak</label>
                        <select class="form-control selectpicker-roomaspak with-ajax-roomaspak" data-live-search="true" name="propAssetPropaspak_insCode" id="propAssetPropaspak_insCode">
                            <option value="" id="option-ajax-roomaspak">Select</option>
                        </select>
                    </div>
                </div>
            </div>

            <div id="ajax_tab_li_simak" style="display: none;">
                <div class="pl-12 ml-12 bg-light">
                    <label class="form-title capitalize">simak</label>
                </div>
                <div class="form-group row">
                    <div class="col-xl-4">
                        <label class="form-title">hospital/simak code</label>
                        <input name="propAssetPropsimak_idAsset" id="propAssetPropsimak_idAsset" type="hidden" />
                        <input class="form-control" name="propAssetPropsimak_simakCode" id="ajax_simakCode" readonly="readonly" type="text">
                    </div>
                    <div class="col-5">
                        <label class="form-title">hospital/simak name</label>
                        <input type="text" class="form-control simak_name" id="ajax_simakName" name="" readonly />
                    </div>
                    <div class="col-3">
                        <label class="form-title">nup</label>
                        <input class="form-control" type="text" name="propAssetPropsimak_nup" id="propAssetPropsimak_nup" />
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xl-4">
                    <label class="form-title">calibration req</label>
                    <!-- <input type="checkbox" checked data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="primary" data-offstyle="danger"> -->
                    <input class="samrs-switch" type="checkbox" id="propAssetPropmedeq_calibrationMust" name="propAssetPropmedeq_calibrationMust" data-size="small" value="Yes" data-on-text="Yes" data-off-text="No" data-onstyle="success" data-offstyle="danger">
                </div>
                <div class="col-xl-8">
                    <label class="form-title">risk level</label>
                    <select class="form-control custom-select" name="propAssetPropadmin_riskLevel" id="propAssetPropadmin_riskLevel">
                        <option value="LOW">Low</option>
                        <option value="MEDIUM">Medium</option>
                        <option value="HIGH">High</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
module.exports = {
    methods: {
        selectlocation() {
            $('#select_location').modal('show');
            SelectLocation();
        },
        addbrand() {
            $('#brand_modal').modal('show');
        }
    },
    mounted() {
        SwitchInital();

        onChangeParentAsset();
        evtParentAsset('init', null);
        // evtMasterAsset('init', null);
        evtBrandMaster('init', null);
        evtSelectRoomAspak('init', null);
        // evtAssetRoom('init', null);

        $(".readonly").on('keydown paste focus mousedown', function (e) {
            if (e.keyCode != 9) // ignore tab
                e.preventDefault();
        });

        let subSysCat = $("#subSysCat").val();
        if (subSysCat == "BLD") {
            $('#row-location').remove();
            $('#row-serialno').remove();
            $('#row-type').remove();
            $('#row-brand').remove();
        } else if (subSysCat == "TOOLS") {
            $('#row-location').remove();
        }

        function evtSelectRoomAspak(evt) {
            var options = {
                ajax: {
                    // url     : SITE_URL + "assets/vendors/bootstrap-select-ajax/example/php/ajax.php",
                    emptyRequest: true,
                    url: BASE_URL + "master/master_service/master_service_query",
                    type: 'POST',
                    dataType: 'json',
                    // Use "{{{q}}}" as a placeholder and Ajax Bootstrap Select will
                    // automatically replace it with the value of the search query.
                    data: {}
                },
                // locale: {
                //     emptyTitle: 'Tap to search'
                // },
                log: 3,
                preprocessData: function (data) {
                    var i, l = data.length,
                        array = [];

                    if (l) {
                        for (i = 0; i < l; i++) {
                            array.push($.extend(true, data[i], {
                                text: data[i].insName,
                                value: data[i].insCode,
                                data: {
                                    subtext: data[i].insCode
                                }
                            }));
                        }
                    }
                    // You must always return a valid array when processing data. The
                    // data argument passed is a clone and cannot be modified directly.
                    return array;
                }
            };

            if (evt == 'init') {
                $('.selectpicker-roomaspak').selectpicker().filter('.with-ajax-roomaspak').ajaxSelectPicker(options);
            } else if (evt == 'render') {
                $('.selectpicker-roomaspak').selectpicker().filter('.with-ajax-roomaspak').ajaxSelectPicker('render');
            }

        }

        function onChangeParentAsset() {
            $('.with-ajax-kategori').change(function () {
                // $('#ajax_catCode').val(this.value);
                var catCode = $('.with-ajax-kategori').find(':selected').val();
                // check = true;
                // console.log(check);
                if (catCode != null) {
                    $('#ajax_catCode').val(catCode);

                    $.ajax({
                        type: "post",
                        url: BASE_URL + "asset/me/inventory_me/ajax_cat_has_parent",
                        data: {
                            catCode: catCode
                        },
                        dataType: "json",
                        success: function (res) {

                            if (res.catHasParent === true) {
                                $('#ajax_catHasParent').css({
                                    'display': ''
                                });
                            } else {
                                $('#ajax_catHasParent').css({
                                    'display': 'none'
                                });
                            }

                            if (res.general == true || res.code == true || res.building == true || res.instrument == true || res.vehicle == true || res.land == true || res.stock == true || res.file == true || res.depreciation1 == true || res.depreciation2 == true || res.license == true || res.aspak == true || res.simak == true) {
                                $('#ajax_page_tab').css({
                                    'display': ''
                                });
                            } else {
                                $('#ajax_page_tab').css({
                                    'display': 'none'
                                });
                            }

                            if (res.general === true) {

                                $('#ajax_tab_li_general').css({
                                    'display': ''
                                });
                            } else {
                                $('#ajax_tab_li_general').css({
                                    'display': 'none'
                                });
                            }

                            if (res.code == true) {
                                $('#ajax_tab_li_code').css({
                                    'display': ''
                                });
                            } else {
                                $('#ajax_tab_li_code').css({
                                    'display': 'none'
                                });
                            }

                            if (res.instrument == true) {
                                $('#ajax_tab_li_instrument').css({
                                    'display': ''
                                });
                            } else {
                                $('#ajax_tab_li_instrument').css({
                                    'display': 'none'
                                });
                            }

                            if (res.building == true) {
                                $('#ajax_tab_li_building').css({
                                    'display': ''
                                });
                                $(".ajax_propAssetPropbuilding_buildingName").keyup(function () {
                                    $("#ajax_aliasName").val($(this).val());
                                });

                                $("#ajax_aliasName").keyup(function () {
                                    $(".ajax_propAssetPropbuilding_buildingName").val($(this).val());
                                });
                            } else {
                                $('#ajax_tab_li_building').css({
                                    'display': 'none'
                                });
                            }

                            if (res.vehicle == true) {
                                $('#ajax_tab_li_vehicle').css({
                                    'display': ''
                                });
                            } else {
                                $('#ajax_tab_li_vehicle').css({
                                    'display': 'none'
                                });
                            }

                            if (res.land == true) {
                                $('#ajax_tab_li_land').css({
                                    'display': ''
                                });
                            } else {
                                $('#ajax_tab_li_land').css({
                                    'display': 'none'
                                });
                            }

                            if (res.stock == true) {
                                $('#ajax_tab_li_stock').css({
                                    'display': ''
                                });
                            } else {
                                $('#ajax_tab_li_stock').css({
                                    'display': 'none'
                                });
                            }

                            if (res.file == true) {
                                $('#ajax_tab_li_file').css({
                                    'display': ''
                                });
                            } else {
                                $('#ajax_tab_li_file').css({
                                    'display': 'none'
                                });
                            }

                            if (res.depreciation1 == true) {
                                $('#ajax_tab_li_depre1').css({
                                    'display': ''
                                });
                                $("input[name=form_depreciation1_text]").val("form");
                            } else {
                                $('#ajax_tab_li_depre1').css({
                                    'display': 'none'
                                });
                                $("input[name=form_depreciation1_text]").val("");
                            }

                            if (res.depreciation2 == true) {
                                $('#ajax_tab_li_depre2').css({
                                    'display': ''
                                });
                            } else {
                                $('#ajax_tab_li_depre2').css({
                                    'display': 'none'
                                });
                            }

                            if (res.license == true) {
                                $('#ajax_tab_li_license').css({
                                    'display': ''
                                });
                            } else {
                                $('#ajax_tab_li_license').css({
                                    'display': 'none'
                                });
                            }

                            if (res.license == true) {
                                $('#ajax_tab_li_license').css({
                                    'display': ''
                                });
                            } else {
                                $('#ajax_tab_li_license').css({
                                    'display': 'none'
                                });
                            }

                            if (res.aspak == true) {
                                $('#ajax_tab_li_aspak').css({
                                    'display': ''
                                });
                            } else {
                                $('#ajax_tab_li_aspak').css({
                                    'display': 'none'
                                });
                            }

                            if (res.simak == true) {
                                $('#ajax_tab_li_simak').css({
                                    'display': ''
                                });
                            } else {
                                $('#ajax_tab_li_simak').css({
                                    'display': 'none'
                                });
                            }

                        }
                    });
                    // if (data_edit == '') {
                    $.ajax({
                        type: "post",
                        url: BASE_URL + "asset/me/inventory_me/ajax_asset_master",
                        data: {
                            catCode: catCode
                        },
                        dataType: "json",
                        success: function (response) {
                            var ajax_idassetmaster_edit = $("#ajax_idassetmaster_edit").val();

                            $('.selectpicker-masterAsset').html('<option value="">Tap to search</option>');
                            let data_index = [];
                            // cada array del parametro tiene un elemento index(concepto) y un elemento value(el  valor de concepto)
                            $.each(response, function (index, value) {
                                data_index = index + 1;
                                data_val = value.idAssetMaster;
                                data_val_asset = value.assetMasterName;
                                // darle un option con los valores asignados a la variable select
                                $('.selectpicker-masterAsset').append('<option value="' + value.idAssetMaster + '">' + value.assetMasterName + '</option>');
                            });

                            // console.log(data_val);
                            if (ajax_idassetmaster_edit != "") {
                                $('select[name=idAssetMaster]').val(ajax_idassetmaster_edit).change();
                                $('.selectpicker-masterAsset').selectpicker('refresh');
                            } else {
                                // console.log(data_index);
                                let subSysCat = $("#subSysCat").val();
                                if (data_index == 1) {
                                    if (subSysCat == "BLD") {
                                        $('select[name=idAssetMaster]').val(data_val).change();
                                        $("#ajax_aliasName").val(data_val_asset);
                                        $("input[name=propAssetPropbuilding_buildingName]").val(data_val_asset);
                                        $('.selectpicker-masterAsset').selectpicker('refresh');
                                    } else {
                                        $('select[name=idAssetMaster]').val(data_val).change();
                                        $("#ajax_aliasName").val(data_val_asset);
                                        $('.selectpicker-masterAsset').selectpicker('refresh');
                                    }

                                } else {
                                    $('.selectpicker-masterAsset').selectpicker('refresh');
                                }
                            }

                        }
                    });
                    // // }

                }

            });
        }

        function evtBrandMaster(evt) {
            var options = {
                ajax: {
                    // url     : SITE_URL + "assets/vendors/bootstrap-select-ajax/example/php/ajax.php",
                    emptyRequest: true,
                    url: BASE_URL + "asset/me/inventory_me/ajax_brand",
                    type: 'POST',
                    dataType: 'json',
                    // Use "{{{q}}}" as a placeholder and Ajax Bootstrap Select will
                    // automatically replace it with the value of the search query.
                    data: {
                        q: '{{{q}}}'
                    }
                },
                locale: {
                    emptyTitle: 'Tap to search'
                },
                log: 3,
                preprocessData: function (data) {
                    var i, l = data.length,
                        array = [];

                    if (l) {
                        for (i = 0; i < l; i++) {
                            array.push($.extend(true, data[i], {
                                text: data[i].brandName,
                                value: data[i].brandName,
                                // data: {
                                //     subtext: data[i].idBrand
                                // }
                            }));
                        }
                    }
                    // You must always return a valid array when processing data. The
                    // data argument passed is a clone and cannot be modified directly.
                    return array;
                }
            };

            if (evt == 'init') {
                $('.selectpicker-merk').selectpicker().filter('.with-ajax-merk').ajaxSelectPicker(options);
            } else if (evt == 'render') {
                $('.selectpicker-merk').selectpicker().filter('.with-ajax-merk').ajaxSelectPicker('render');
            }
        }

        function evtParentAsset(evt) {
            var options = {
                ajax: {
                    // url     : SITE_URL + "assets/vendors/bootstrap-select-ajax/example/php/ajax.php",
                    emptyRequest: true,
                    url: BASE_URL + "asset/me/inventory_me/ajax_asset_parent",
                    type: 'POST',
                    dataType: 'json',
                    // Use "{{{q}}}" as a placeholder and Ajax Bootstrap Select will
                    // automatically replace it with the value of the search query.
                    data: {
                        q: '{{{q}}}'
                    }
                },
                locale: {
                    emptyTitle: 'Tap to search'
                },
                log: 3,
                preprocessData: function (data) {
                    var i, l = data.length,
                        array = [];

                    if (l) {
                        for (i = 0; i < l; i++) {
                            array.push($.extend(true, data[i], {
                                text: data[i].assetName,
                                value: data[i].idAsset,
                                data: {
                                    subtext: data[i].catCode + "-" + data[i].idAsset
                                }
                            }));
                        }
                    }
                    // You must always return a valid array when processing data. The
                    // data argument passed is a clone and cannot be modified directly.
                    return array;
                }
            };

            if (evt == 'init') {
                $('.selectpicker-parentAsset').selectpicker().filter('.with-ajax-parentAsset').ajaxSelectPicker(options);
            } else if (evt == 'render') {
                $('.selectpicker-parentAsset').selectpicker().filter('.with-ajax-parentAsset').ajaxSelectPicker('render');
            }
        }

    }

}
</script>
