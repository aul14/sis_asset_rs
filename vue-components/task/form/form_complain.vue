<template>
<div class="p-10">
    <p class="mandatory-info">
        Field marked <span>*</span> is required to fill or mandatory
    </p>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">username</label>
        </div>
        <div class="col-xl-8">
            <input type="hidden" name="formType" />
            <input name="taskCode" type="hidden" value="CPL" />
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
            <!-- <input class="form-control" name="userName" type="text" id="userName" readonly required> -->
            <slot name="form-username"></slot>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">informant<span>*</span></label>
        </div>
        <div class="col-xl-8">
            <input type="hidden" name="idInitBy" id="idInitBy" />
            <!-- <input class="form-control" name="initBy" type="text" id="initBy" required> -->
            <slot name="form-informant"></slot>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">complain date<span>*</span></label>
        </div>
        <div class="col-xl-8">
            <!-- <input class="form-control" name="scheduleStart" type="text" id="scheduleStart" required readonly> -->
            <slot name="form-complain-date"></slot>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">asset code<span>*</span></label>
        </div>
        <div class="col-xl-8">
            <div class="input-group">
                <input type="hidden" name="idAsset" id="idAsset" required />
                <input class="form-control" name="assetCode" type="text" id="assetCode" readonly required />
                <div class="input-group-append">
                    <button class="btn samrs-primary" type="button" id="btn-pick-complain" name="button" v-on:click="assetspick">
                        Pick
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">asset name</label>
        </div>
        <div class="col-xl-8">
            <input class="form-control" name="assetName" type="text" id="assetName" required readonly />
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">brand</label>
        </div>
        <div class="col-xl-8">
            <input class="form-control" name="merk" type="text" id="merk" required readonly />
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">type</label>
        </div>
        <div class="col-xl-8">
            <input class="form-control" name="tipe" type="text" id="tipe" required readonly />
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">serial number</label>
        </div>
        <div class="col-xl-8">
            <input class="form-control" name="serialNumber" type="text" id="serialNumber" required readonly />
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">room</label>
        </div>
        <div class="col-xl-8">
            <input class="form-control" name="roomName" type="text" id="roomName" required readonly />
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">complain request<span>*</span></label>
        </div>
        <div class="col-xl-8">
            <textarea class="form-control" name="complainRequest" id="complainRequest" rows="3" required>

</textarea>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">complain picture<span>*</span></label>
        </div>
        <div class="col-xl-4">
            <div class="custom-file samrs-primary">
                <input class="custom-file-input" type="file" name="taskFile1" />
                <label class="custom-file-label label-shorts" data-color-type="primary">upload picture</label>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="custom-file samrs-primary">
                <input class="custom-file-input" type="file" name="taskFile2" />
                <label class="custom-file-label label-shorts" data-color-type="primary">upload picture</label>
            </div>
        </div>
    </div>

    <div class="form-group row view-file-edit">
        <div class="col-xl-4"></div>
    </div>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">complain request<span>*</span></label>
        </div>
        <div class="col-xl-8">
            <label>
                <input type="checkbox" name="complainPriority" id="complainPriority" />
                please check if priority complaint
            </label>
        </div>
    </div>
</div>
</template>

<script>
module.exports = {
    methods: {
        assetspick: function (event) {
            $("#select_assets").modal("show");
        },
    },
    mounted() {
        InputFiles();
        var TASKSYSCAT = $("input[name=taskSysCat]").val();

        SelectAssets(TASKSYSCAT);

        $(document).on("click", "#selected-asset", function () {
            var id_asset = this.value;
            var code = $(this).data("code");
            var asset_name = $(this).data("asset_name");
            var merk = $(this).data("merk");
            var tipe = $(this).data("tipe");
            var sn = $(this).data("sn");
            var room = $(this).data("room");

            $("input[name=idAsset]").val(id_asset);
            $("input[name=assetCode]").val(code);
            $("input[name=assetName]").val(asset_name);
            $("input[name=merk]").val(merk);
            $("input[name=tipe]").val(tipe);
            $("input[name=serialNumber]").val(sn);
            $("input[name=roomName]").val(room);
        });

    },
};
</script>
