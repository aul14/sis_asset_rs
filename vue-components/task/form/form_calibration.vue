<template>
<div class="p-10">
    <p class="mandatory-info">Field marked <span>*</span> are required to fill or mandatory</p>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">schedule start<span>*</span></label>
        </div>
        <div class="col xl-8">
            <input id="idTask" name="idTask" type="hidden" />
            <input id="formType" name="formType" type="hidden" value="add"/>
            <input id="idProgress" name="idProgress" type="hidden" />
            <input id="idSchedule" name="idSchedule" type="hidden" />
            <input id="taskName" name="taskName" type="hidden" />
            <input id="taskDesc" name="taskDesc" type="hidden" />
            <input class="form-control" name="scheduleStart" type="date" id="scheduleStart" required>
        </div>
    </div>
    <div class="mr-10 ml-10">
        <button class="btn samrs-primary ml-10" id="btn-asset-pick" type="button" name="button" v-on:click="assetspick"><i class="fas fa-plus"></i> Add schedule</button>
        <div class="table-responsive">
            <table class="schedule_assets_2 table samrs-tableview capitalize">
                <thead>
                </thead>
                <tbody id="responseAndSaveToTableSelectedAsset">
                </tbody>
            </table>
        </div>
    </div>
</div>
</template>

<script>
module.exports = {
    methods: {
        assetspick: function (event) {
            $('#select_assets').modal('show');
        }
    },
    mounted() {
        let sysCatName = $("input[name=sysCatName]").val();
        SelectAssets_1(sysCatName);
        ScheduleAssets_2();
    }
}
</script>
