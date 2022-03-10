<template>
<div class="p-10">
    <p class="mandatory-info">Field marked <span>*</span> is required to fill or mandatory</p>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">asset code<span>*</span></label>
        </div>
        <div class="col-xl-8">
            <div class="input-group">
                <input type="hidden" name="idAsset" id="idAsset" required>
                <input class="form-control" name="assetCode" type="text" id="assetCode" readonly required>
                <div class="input-group-append">
                    <button class="btn samrs-primary" type="button" name="button" v-on:click="assetspick">Pick</button>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">asset name</label>
        </div>
        <div class="col-xl-8">
            <input class="form-control" name="assetName" type="text" id="assetName" required readonly>

        </div>
    </div>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">merk</label>
        </div>
        <div class="col-xl-8">
            <input class="form-control" name="merk" type="text" id="merk" required readonly>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">type</label>
        </div>
        <div class="col-xl-8">
            <input class="form-control" name="tipe" type="text" id="tipe" required readonly>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">serial number</label>
        </div>
        <div class="col-xl-8">
            <input class="form-control" name="serialNumber" type="text" id="serialNumber" required readonly>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">room</label>
        </div>
        <div class="col-xl-8">
            <input type="hidden" name="srcRoomID" id="srcRoomID">
            <input class="form-control" name="srcRoomName" type="text" id="srcRoomName" required readonly>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">username</label>
        </div>
        <div class="col-xl-8">
            <input type="hidden" name="formType" value="add">
            <input name="taskCode" type="hidden" value="MUT" />
            <input id="idProgress" name="idProgress" type="hidden" />
            <input id="idRelatedTask" name="idRelatedTask" type="hidden" />
            <input id="idSchedule" name="idSchedule" type="hidden" />
            <input id="idTask" name="idTask" type="hidden" />
            <input id="taskName" name="taskName" type="hidden" />
            <input id="taskDesc" name="taskDesc" type="hidden" />
            <input id="idTaskFile1" name="idTaskFile1" type="hidden" />
            <input id="idFile1" name="idFile1" type="hidden" />
            <input id="fileDesc1" name="fileDesc1" type="hidden" />
            <input id="idTaskFile2" name="idTaskFile2" type="hidden" />
            <input id="idFile2" name="idFile2" type="hidden" />
            <input id="fileDesc2" name="fileDesc2" type="hidden" />

            <input type="hidden" name="mutationStatus" id="mutationStatus">
            <slot name="username-mut"></slot>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">Informant<span>*</span></label>
        </div>
        <div class="col-xl-8">
            <slot name="informant-mut"></slot>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">request date<span>*</span></label>
        </div>
        <div class="col-xl-8">
            <slot name="request-mut"></slot>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">location destination<span>*</span></label>
        </div>
        <div class="col-xl-8">
            <input type="hidden" name="dstRoomID" id="dstRoomID">
            <input type="hidden" name="dstRoomName" id="dstRoomName">
            <div class="input-group">
                <input class="form-control" readonly type="text" id="ajax_lokasi" name="propAssetPropadmin_idRoom_not" required>
                <!-- <select class="form-control selectpicker-lokasi with-ajax-lokasi" data-live-search="true" id="ajax_lokasi" name="propAssetPropadmin_idRoom" required>
                        </select> -->
                <div class="input-group-prepend">
                    <button class="btn samrs-primary" type="button" name="button" v-on:click="selectlocation">Pick</button>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">mutation type<span>*</span></label>
        </div>
        <div class="col-xl-8 d-flex">
            <label class="mr-10 ml-10">
                <input type="radio" class="mutationType" name="mutationType" value="Temporary" checked>Temporary
            </label>
            <label class="mr-10 ml-10">
                <input type="radio" class="mutationType" name="mutationType" value="Permanent">Permanent
            </label>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">finish estimation<span>*</span></label>
        </div>
        <div class="col-xl-8">
            <input class="form-control" name="timePending" type="date" id="timePending">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">description<span>*</span></label>
        </div>
        <div class="col-xl-8">
            <textarea class="form-control" name="mutationDesc" id="mutationDesc" rows="3" required></textarea>
        </div>
    </div>
</div>
</template>

<script>
module.exports = {
    methods: {
        assetspick: function (event) {
            $('#select_assets').modal('show');
        },
        selectlocation: function (event) {
            $('#select_location').modal('show');
            SelectLocation();
        },
    },
    mounted: function () {
        let sysCatName = $("input[name=sysCatName]").val();
        SelectAssets(sysCatName);

        ajaxRoomList();

        $(document).on('click', '#select-lokasi', function () {
            var name_room = $(this).data('name_room');
            var name_floor = $(this).data('name_floor');
            var name_building = $(this).data('name_building');
            var id_room = $(this).data('id_room');
            var id_floor = $(this).data('id_floor');
            var id_building = $(this).data('id_building');

            // console.log(name_room, name_floor, name_building, id_room, id_floor, id_building);
            $('input[name=dstRoomName]').val(name_room);
            $('input[name=dstRoomID]').val(id_room);
            $('input[name=propAssetPropadmin_idRoom_not]').val(name_room + " | " + name_floor + " | " + name_building);
            $('#select_location').modal('hide');
        });

        $(document).on("click", "#selected-asset", function () {
            var id_asset = this.value;
            var code = $(this).data("code");
            var asset_name = $(this).data("asset_name");
            var merk = $(this).data("merk");
            var tipe = $(this).data("tipe");
            var idroom = $(this).data("idroom");
            var sn = $(this).data("sn");
            var room = $(this).data("room");

            $("input[name=idAsset]").val(id_asset);
            $("input[name=assetCode]").val(code);
            $("input[name=assetName]").val(asset_name);
            $("input[name=merk]").val(merk);
            $("input[name=tipe]").val(tipe);
            $("input[name=serialNumber]").val(sn);
            $("input[name=srcRoomName]").val(room);
            $("input[name=srcRoomID]").val(idroom);
        });

        $('input:radio[name="mutationType"]').click(function () {
            if ($(this).is(':checked')) {
                if ($(this).val() == 'Permanent') {
                    // console.log('Permanent')
                    $('#timePending').prop('disabled', true);
                } else if ($(this).val() == 'Temporary') {
                    // console.log('Temporary')
                    $('#timePending').prop('disabled', false);
                }
            }
        });

        function ajaxRoomList() {
            $.ajax({
                type: "post",
                url: BASE_URL + "asset/me/inventory_me/ajax_room_list",
                async: false,
                dataType: 'json',
                success: function (data) {
                    var html = '';
                    var i;
                    if (data.length > 0) {
                        for (i = 0; i < data.length; i++) {
                            html += "<tr>";
                            html += '<td>' + '<input type="radio" name="select_lokasi" class="btn btn-xs btn-info" id="select-lokasi" data-name_floor="' + data[i].floorName + '" data-name_building="' + data[i].buildingName + '" data-name_room="' + data[i].roomName + '" data-id_room="' + data[i].idRoom + '" data-id_floor="' + data[i].idFloor + '" data-id_building="' + data[i].idBuilding + '"></input>' + '</td>';
                            html += '<td>' + data[i].roomName + '</td>';
                            html += '<td>' + data[i].floorName + '</td>';
                            html += '<td>' + data[i].buildingName + '</td>';
                            html += "</tr>";
                        }
                        $('.tbody-list').html(html);
                    }
                }
            });
        }
    }
}
</script>
