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
            <label class="form-title">document number <span>*</span></label>
        </div>
        <div class="col-xl-8">
            <input class="form-control" name="ftCode" type="text" id="ftCode" autocomplete="off" readonly>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">assets master</label>
        </div>
        <div class="col-xl-8">
            <input class="form-control" type="text" id="asset-master" autocomplete="off" readonly>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">planning date</label>
        </div>
        <div class="col-xl-8">
            <input class="form-control" type="text" id="planning-date" readonly>
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
    }
}
</script>
