<template>
<div class="p-10">
    <p class="mandatory-info">
        Field marked <span>*</span> is required to fill or mandatory
    </p>
    <div class="col-xl-12">
        <input id="formType" name="formType" type="hidden">
        <input id="idAssetMaster" name="idAssetMaster" type="hidden">
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">ecri code</label>
            </div>
            <div class="col-xl-8">
                <select name="ecriCode" id="ecriCode" class="form-control selectpicker-ecri with-ajax-ecri" data-live-search="true">
                    <option value="" id="option-ajax-ecri">Tap to search</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">aspak code</label>
            </div>
            <div class="col-xl-8">
                <select name="aspakCode" id="aspakCode" class="form-control selectpicker-aspak with-ajax-aspak" data-live-search="true">
                    <option value="" id="option-ajax-aspak">Tap to search</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">simak code</label>
            </div>
            <div class="col-xl-8">
                <select name="simakCode" id="simakCode" class="form-control selectpicker-simak with-ajax-simak" data-live-search="true">
                    <option value="" id="option-ajax-simak">Tap to search</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">category code <span>*</span></label>
            </div>
            <div class="col-xl-8">
                <slot name="catcode-slot"></slot>
                
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">assets master name <span>*</span></label>
            </div>
            <div class="col-xl-8">
                <input class="form-control" id="assetMasterName" name="assetMasterName" required type="text">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">should to calibrated ?</label>
            </div>
            <div class="col-xl-8">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="calibMust" id="calibmust_yes" value="1">
                    <label class="form-check-label"> Yes </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" checked name="calibMust" id="calibmust_no" value="0">
                    <label class="form-check-label"> No </label>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">score inspection</label>
            </div>
            <div class="col-xl-8">
                <input class="form-control" id="scoreInspection" name="scoreInspection" onkeypress="return hanyaAngka(event)" type="text">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">score maintenance</label>
            </div>
            <div class="col-xl-8">
                <input class="form-control" id="scoreMaintenance" name="scoreMaintenance" onkeypress="return hanyaAngka(event)" type="text">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">score repair</label>
            </div>
            <div class="col-xl-8">
                <input class="form-control" id="scoreRepair" name="scoreRepair" onkeypress="return hanyaAngka(event)" type="text">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">risk level <span>*</span></label>
            </div>
            <div class="col-xl-8">
                <select name="riskLevel" id="riskLevel" class="form-control">
                    <option value="HIGH">HIGH</option>
                    <option value="MEDIUM">MEDIUM</option>
                    <option value="LOW">LOW</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">lifetime </label>
            </div>
            <div class="col-xl-8">
                <input type="text" name="lifeTime" id="lifeTime" class="form-control" onkeypress="return hanyaAngka(event)">
                <!-- <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="lifeTime" id="lifetime_yes" value="1">
                    <label class="form-check-label"> Yes </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="lifeTime" id="lifetime_no" value="0">
                    <label class="form-check-label"> No </label>
                </div> -->
            </div>
        </div>
    </div>
</div>
</template>

<script>
module.exports = {
    mounted() {
        $('.selectpicker-catcode').selectpicker();
        
        evtEcriCode('init');
        evtAspakItemCode('init');
        evtSimakCode('init');
        // evtCatCode('init');

        function evtEcriCode(evt) {
            var options = {
                ajax: {
                    // url     : SITE_URL + "assets/vendors/bootstrap-select-ajax/example/php/ajax.php",
                    emptyRequest: true,
                    url: BASE_URL + "master_data/master_ecri/query",
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
                                text: data[i].ecriCode,
                                value: data[i].ecriCode,
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
                $('.selectpicker-ecri').selectpicker().filter('.with-ajax-ecri').ajaxSelectPicker(options);
            } else if (evt == 'render') {
                $('.selectpicker-ecri').selectpicker().filter('.with-ajax-ecri').ajaxSelectPicker('render');
            }
        }

        function evtAspakItemCode(evt) {
            var options = {
                ajax: {
                    // url     : SITE_URL + "assets/vendors/bootstrap-select-ajax/example/php/ajax.php",
                    emptyRequest: true,
                    url: BASE_URL + "master_data/master_aspak/master_aspak/aspak_item_query",
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
                                text: data[i].aspakItemCode,
                                value: data[i].aspakItemCode,
                                data: {
                                    subtext: data[i].aspakItemName
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
                $('.selectpicker-aspak').selectpicker().filter('.with-ajax-aspak').ajaxSelectPicker(options);
            } else if (evt == 'render') {
                $('.selectpicker-aspak').selectpicker().filter('.with-ajax-aspak').ajaxSelectPicker('render');
            }
        }

        function evtSimakCode(evt) {
            var options = {
                ajax: {
                    // url     : SITE_URL + "assets/vendors/bootstrap-select-ajax/example/php/ajax.php",
                    emptyRequest: true,
                    url: BASE_URL + "master_data/master_simak/query",
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
                                text: data[i].simakCode,
                                value: data[i].simakCode,
                                data: {
                                    subtext: data[i].simakUraian
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
                $('.selectpicker-simak').selectpicker().filter('.with-ajax-simak').ajaxSelectPicker(options);
            } else if (evt == 'render') {
                $('.selectpicker-simak').selectpicker().filter('.with-ajax-simak').ajaxSelectPicker('render');
            }
        }

        // function evtCatCode(evt) {
        //     var options = {
        //         ajax: {
        //             // url     : SITE_URL + "assets/vendors/bootstrap-select-ajax/example/php/ajax.php",
        //             emptyRequest: true,
        //             url: BASE_URL + "asset_category/asset_category_query_master",
        //             type: 'POST',
        //             dataType: 'json',
        //             // Use "{{{q}}}" as a placeholder and Ajax Bootstrap Select will
        //             // automatically replace it with the value of the search query.
        //             data: {
        //                 q: '{{{q}}}'
        //             }
        //         },
        //         locale: {
        //             emptyTitle: 'Tap to search'
        //         },
        //         log: 3,
        //         preprocessData: function (data) {
        //             var i, l = data.length,
        //                 array = [];

        //             if (l) {
        //                 for (i = 0; i < l; i++) {
        //                     array.push($.extend(true, data[i], {
        //                         text: data[i].catCode,
        //                         value: data[i].catCode,
        //                         data: {
        //                             subtext: data[i].assetCatName
        //                         }
        //                     }));
        //                 }
        //             }
        //             // You must always return a valid array when processing data. The
        //             // data argument passed is a clone and cannot be modified directly.
        //             return array;
        //         }
        //     };

        //     if (evt == 'init') {
        //         $('.selectpicker-catcode').selectpicker().filter('.with-ajax-catcode').ajaxSelectPicker(options);
        //     } else if (evt == 'render') {
        //         $('.selectpicker-catcode').selectpicker().filter('.with-ajax-catcode').ajaxSelectPicker('render');
        //     }
        // }
    },
}
</script>
