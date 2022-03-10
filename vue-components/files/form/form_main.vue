<template>
<div class="border-top-1 border-light p-10">
    <p class="mandatory-info">Field marked <span>*</span> are required to fill or mandatory</p>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">form type<span>*</span></label>
        </div>
        <div class="col-xl-8">
            <input type="hidden" name="formType" id="formType" value="add">
            <input name="idFormTemplate" type="hidden" id="idFormTemplate">
            <slot name="ftname-form"></slot>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">form name <span>*</span></label>
        </div>
        <div class="col-xl-8">
            <input class="form-control" name="ftName" type="text" id="ftName" autocomplete="off" required>

        </div>
    </div>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">document number <span>*</span></label>
        </div>
        <div class="col-xl-8">
            <input class="form-control" name="ftCode" type="text" id="ftCode" autocomplete="off" required>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">assets master</label>
        </div>
        <div class="col-xl-8">
            <div class="p-1">
                <button class="btn samrs-primary" type="button" name="button" v-on:click="selectassets"><i class="fas fa-plus"></i> Select Assets</button>
            </div>
            <table class="table samrs-tableview capitalize">
                <thead>
                    <th>Asset master selected list</th>
                    <th style="width: 10%"></th>
                </thead>
                <tbody id="responseAndSaveToTableSelectedAssetMaster">
                </tbody>
            </table>
        </div>
    </div>
</div>
</template>

<script>
module.exports = {
    methods: {
        selectassets: function () {
            $('#select_assets').modal('show');
        },
    },
    mounted: function () {
        SelectAssets();
        
    }
}
</script>
