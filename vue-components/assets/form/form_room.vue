<template>
<div class="p-10">
    <p class="mandatory-info">Field marked <span>*</span> is required to fill or mandatory</p>
    <div class="row">
        <div class="col-xl-6">
            <div class="form-group row">
                <div class="col-xl-4">
                    <label class="form-title">room name <span>*</span></label>
                </div>
                <input type="hidden" name="idRoom">
                <div class="col-xl-8">
                    <input type="hidden" name="roomCode">
                    <input class="form-control" autocomplete="off" required type="text" name="roomName">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xl-4">
                    <label class="form-title">room area</label>
                </div>
                <div class="col-xl-8">
                    <div class="input-group">
                        <input class="form-control" type="text" onkeypress="return hanyaAngka(event)" name="roomSpace">
                        <slot name="select-unit1"></slot>
                        <!-- <div class="input-group-append"> -->
                        <!-- <select class="form-control" name="">
                  <option >Select</option>
                </select> -->
                        <!-- </div> -->
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xl-4">
                    <label class="form-title">number of bed</label>
                </div>
                <div class="col-xl-8">
                    <input class="form-control" type="text" onkeypress="return hanyaAngka(event)" name="bedCount">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xl-4">
                    <label class="form-title">electric power</label>
                </div>
                <div class="col-xl-8">
                    <div class="input-group">
                        <input class="form-control" type="text" onkeypress="return hanyaAngka(event)" name="roomPower">
                        <!-- <div class="input-group-append"> -->
                        <slot name="select-unit2"></slot>
                        <!-- <select class="form-control" name="">
                  <option >Select</option>
                </select> -->
                        <!-- </div> -->
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xl-4">
                    <label class="form-title">function</label>
                </div>
                <div class="col-xl-8">
                    <textarea class="form-control" name="roomDesc" rows="8" cols="80"></textarea>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="form-group row">
                <div class="col-xl-4">
                    <label class="form-title">building<span>*</span></label>
                </div>
                <input type="hidden" name="buildingName" id="buildingName">
                <div class="col-xl-8">
                    <select class="form-control selectpicker-building with-ajax-building" required data-live-search="true" name="idBuilding" id="idBuilding">
                        <option value="" id="option-ajax-building">Tap to search</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xl-4">
                    <label class="form-title">floors<span>*</span></label>
                </div>
                <input type="hidden" name="floorName" id="floorName">
                <div class="col-xl-8">
                    <select class="form-control selectpicker-floor with-ajax-floor" required data-live-search="true" name="idFloor" id="idFloor">
                        <option value="" id="option-ajax-floor">Tap to search</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xl-4">
                    <label class="form-title">work units<span>*</span></label>
                </div>
                <div class="col-xl-8">
                    <select class="form-control selectpicker-workunit with-ajax-workunit" required data-live-search="true" name="workUnit">
                        <option value="" id="option-ajax-workunit">Tap to search</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xl-4">
                    <label class="form-title">person in charge<span>*</span></label>
                </div>
                <input type="hidden" name="roomPJName" id="roomPJName">
                <div class="col-xl-8">
                    <select class="form-control selectpicker-person with-ajax-person" required data-live-search="true" name="roomPJID" id="roomPJID">
                        <option value="" id="option-ajax-person">Tap to search</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xl-4">
                    <label class="form-title">is warehouse? <span>*</span></label>
                </div>
                <div class="col-xl-8">
                    <div class="form-check-inline form-check">
                        <label class="form-check-label">
                            <input class="typeRadio" type="radio" name="isWarehouse" id="isWarehouse1" required value="true">
                            TRUE
                        </label>
                    </div>
                    <div class="form-check-inline form-check">
                        <label class="form-check-label">
                            <input class="typeRadio" type="radio" name="isWarehouse" id="isWarehouse2" value="false">
                            FALSE
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
module.exports = {
    mounted() {
        $(function () {
            $('.selectpicker_not').selectpicker();
            evtAssetBuilding('init');
            evtOrg('init');
            evtUser('init');
            onChangeAssetBuilding();
            onChangeAssetBuildingFloor();
            onChangeUser();
            $('.selectpicker-floor').selectpicker('refresh');
        });

        function onChangeUser() {
            $('.with-ajax-person').change(function () {
                // e.preventDefault();
                var idUser = $('.with-ajax-person').find(':selected').val();
                if (idUser != null) {
                    $.ajax({
                        type: "POST",
                        url: BASE_URL + "asset/building/room_bld/ajax_user_by_id",
                        data: {
                            idUser: idUser
                        },
                        dataType: "json",
                        success: function (res) {
                            $('input[name=roomPJName]').val(res.userFullName);
                        }
                    });
                }
            });
        }

        function onChangeAssetBuildingFloor() {
            $('.with-ajax-floor').change(function () {
                // e.preventDefault();
                var idFloor = $('.with-ajax-floor').find(':selected').val();
                if (idFloor != null) {
                    $.ajax({
                        type: "POST",
                        url: BASE_URL + "asset/building/room_bld/ajax_building_floor_by_id",
                        data: {
                            idFloor: idFloor
                        },
                        dataType: "json",
                        success: function (res) {
                            $('input[name=floorName]').val(res.floorName);
                        }
                    });
                }
            });
        }

        function onChangeAssetBuilding() {
            $('.with-ajax-building').change(function () {
                // e.preventDefault();
                var idAsset = $('.with-ajax-building').find(':selected').val();

                if (idAsset != null) {
                    $.ajax({
                        type: "POST",
                        url: BASE_URL + "asset/building/room_bld/ajax_building_by_id",
                        data: {
                            idAsset: idAsset
                        },
                        dataType: "json",
                        success: function (res) {
                            $("input[name=buildingName]").val(res.buildingName);
                        }
                    });

                    $.ajax({
                        type: "POST",
                        url: BASE_URL + "asset/building/room_bld/ajax_building_floor_by_idbuilding",
                        data: {
                            idAsset: idAsset
                        },
                        dataType: "json",
                        success: function (response) {
                            $('.selectpicker-floor').html('<option value=""></option>');
                            // cada array del parametro tiene un elemento index(concepto) y un elemento value(el  valor de concepto)
                            $.each(response, function (index, value) {
                                // darle un option con los valores asignados a la variable select
                                $('.selectpicker-floor').append('<option value="' + value.idFloor + '">' + value.floorName + '</option>');
                            });
                            $('.selectpicker-floor').selectpicker('refresh');
                        }
                    });
                }

            });
        }

        function evtOrg(evt) {
            var options = {
                ajax: {
                    // url     : SITE_URL + "assets/vendors/bootstrap-select-ajax/example/php/ajax.php",
                    emptyRequest: true,
                    url: BASE_URL + "asset/building/room_bld/ajax_org",
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
                                text: data[i].orgName,
                                value: data[i].orgCode,
                                data: {
                                    subtext: data[i].orgCode
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
                $('.selectpicker-workunit').selectpicker().filter('.with-ajax-workunit').ajaxSelectPicker(options);
            } else if (evt == 'render') {
                $('.selectpicker-workunit').selectpicker().filter('.with-ajax-workunit').ajaxSelectPicker('render');
            }
        }

        function evtUser(evt) {
            var options = {
                ajax: {
                    // url     : SITE_URL + "assets/vendors/bootstrap-select-ajax/example/php/ajax.php",
                    emptyRequest: true,
                    url: BASE_URL + "asset/building/room_bld/ajax_user",
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
                                text: data[i].userFullName,
                                value: data[i].idUser,
                                // data: {
                                //     subtext: data[i].catCode + "-" + data[i].idAsset
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
                $('.selectpicker-person').selectpicker().filter('.with-ajax-person').ajaxSelectPicker(options);
            } else if (evt == 'render') {
                $('.selectpicker-person').selectpicker().filter('.with-ajax-person').ajaxSelectPicker('render');
            }
        }

        function evtAssetBuilding(evt) {
            var options = {
                ajax: {
                    // url     : SITE_URL + "assets/vendors/bootstrap-select-ajax/example/php/ajax.php",
                    emptyRequest: true,
                    url: BASE_URL + "asset/building/room_bld/ajax_building",
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
                                text: data[i].buildingName,
                                value: data[i].idAsset,
                                // data: {
                                //     subtext: data[i].catCode + "-" + data[i].idAsset
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
                $('.selectpicker-building').selectpicker().filter('.with-ajax-building').ajaxSelectPicker(options);
            } else if (evt == 'render') {
                $('.selectpicker-building').selectpicker().filter('.with-ajax-building').ajaxSelectPicker('render');
            }
        }
    }
}
</script>
