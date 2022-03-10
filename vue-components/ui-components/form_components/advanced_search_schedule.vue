<template>
<div class="samrs-flex wrapped is-row in-center samrs-form">

    <div class="flex-box">
        <div class="form-group">
            <label class="form-title text-capitalize mb-0">year</label>
            <input class="form-control" type="text" autocomplete="off" onkeypress="return hanyaAngka(event)" name="years">
        </div>
    </div>
    <div class="flex-box">
        <div class="form-group">
            <label class="form-title text-capitalize mb-0">month</label>
            <!-- <slot name="select-month-search"></slot> -->
            <input class="form-control" type="text" autocomplete="off" name="month" onkeypress="return hanyaAngka(event)" data-date-format="MM">
        </div>
    </div>
    <div class="flex-box">
        <div class="form-group">
            <label class="form-title text-capitalize mb-0">assets</label>
            <select class="form-control selectpicker-asset with-ajax-asset" name="idAsset">
                <option value="">All</option>
            </select>
        </div>
    </div>
    <div class="flex-box">
        <div class="form-group">
            <label class="form-title text-capitalize mb-0">rooms</label>
            <select class="form-control selectpicker-room" name="idRoom">
                <option value="">All</option>
            </select>
        </div>
    </div>
    <div class="flex-box">
        <div class="form-group">
            <label class="form-title text-capitalize mb-0">technician</label>
            <select class="form-control selectpicker-user" name="idFinishBy">
                <option value="">All</option>
            </select>
        </div>
    </div>
    <div class="flex-box">
        <div class="form-group mt-20">
            <button class="btn btn-sm btn-block samrs-primary pl-50 pr-50" type="submit">Find</button>
        </div>
    </div>
</div>
</template>

<script>
module.exports = {
    create() {
        DatePicker();
    },
    mounted() {
        $("input[name=month]").datepicker({
            format: "mm", // Notice the Extra space at the beginning
            viewMode: "months",
            minViewMode: "months",
            autoclose: true
        });

        $("input[name=years]").datepicker({
            format: "yyyy", // Notice the Extra space at the beginning
            viewMode: "years",
            minViewMode: "years",
            autoclose: true
        });
        let currentTime = new Date();
        $("input[name=years]").val(currentTime.getFullYear());

        let scheduleSysCat = $("input[name=scheduleSysCat]").val();

        $('.selectpicker-room').focus(function () {
            $('.selectpicker-room').select2({
                width: '100%',
                placeholder: 'Room',
                allowClear: true,
                tokenSeparators: [',', ' '],
                ajax: {
                    url: BASE_URL + 'asset_propbuilding_room/asset_propbuilding_room_query',
                    dataType: 'json',
                    type: 'GET',
                    delay: 250,
                    processResults: function (data) {
                        // console.log(data);
                        return {
                            results: $.map(data['data'], function (item) {
                                return {
                                    text: item.roomName,
                                    id: item.idRoom
                                }
                            })
                        };
                    },
                }
            });
        });

        $('.selectpicker-user').focus(function () {
            $('.selectpicker-user').select2({
                width: '100%',
                placeholder: 'Technician',
                allowClear: true,
                ajax: {
                    url: BASE_URL + "asset/building/room_bld/user_query",
                    dataType: 'json',
                    type: 'GET',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results: $.map(data['data'], function (item) {
                                return {
                                    text: item.userFullName,
                                    id: item.idUser
                                }
                            })
                        };
                    },
                }
            });
        });

        $('.selectpicker-asset').focus(function () {
            $('.selectpicker-asset').select2({
                width: '100%',
                placeholder: 'Asset',
                allowClear: true,
                tokenSeparators: [',', ' '],
                ajax: {
                    url: BASE_URL + "asset/me/inventory_data_table/asset_query",
                    dataType: 'json',
                    // data: {
                    //     sysCatName: scheduleSysCat
                    // },
                    type: 'GET',
                    delay: 250,
                    processResults: function (data) {
                        // console.log(data);
                        return {
                            results: $.map(data['data'], function (item) {
                                return {
                                    text: item.assetName,
                                    id: item.idAsset
                                }
                            })
                        };
                    },
                }
            });
        });
    },
}
</script>
