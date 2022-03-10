<template>
<div class="row">
    <div class="col-xl-6">
        <!-- <div class="form-group row">
            <div class="col-4">
                <label class="form-title">procurement date</label>
            </div>
            <div class="col-8">
                <input class="form-control datepicker" type="text" name="propAssetPropadmin_procureDate" id="propAssetPropadmin_procureDate" >
            </div>
        </div>
        <div class="form-group row">
            <div class="col-4">
                <label class="form-title">year operation</label>
            </div>
            <div class="col-8">
                <input class="form-control" type="text" onkeypress="return hanyaAngka(event)" name="propAssetPropadmi_yearProcurement" id="propAssetPropadmin_yearProcurement" >
            </div>
        </div> -->
        <div class="form-group row">
            <div class="col-4">
                <label class="form-title">po. number</label>
            </div>
            <div class="col-8">
                <input class="form-control" type="text" id="po_number" >
            </div>
        </div>
        <div class="form-group row">
            <div class="col-4">
                <label class="form-title">price</label>
            </div>
            <div class="col-8">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text">Rp.</label>
                    </div>
                    <input class="form-control" data-val="true" data-val-number="The field Cost must be a number." data-val-range="Cost Harus diantara 0 dan 10000000000" data-val-range-max="10000000000" data-val-range-min="0" data-val-required="The Cost field is required." onkeypress="return hanyaAngka(event)" onchange="calcDepre2()" type="text" name="propAssetProptaxother_cost" id="propAssetProptaxother_cost" value="0">
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-4">
                <label class="form-title">expectation life time</label>
            </div>
            <div class="col-8">
                <div class="input-group">
                    <input class="form-control" data-val="true" data-val-number="The field Expected Life Time must be a number." data-val-range="Expected Life Time Harus diantara 0 dan 10000000000" data-val-range-max="10000000000" data-val-range-min="0" data-val-required="The Expected Life Time field is required." type="text" onchange="calcDepre2()" name="propAssetProptaxother_expectedLifeTime" id="propAssetProptaxother_expectedLifeTime" value="0">
                    <div class="input-group-append">
                        <label class="input-group-text">Year</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-4">
                <label class="form-title">procurement date</label>
            </div>
            <div class="col-8">
                <input class="form-control datepicker" type="text" onchange="calcDepre2()" name="propAssetProptaxother_presentDate" id="propAssetProptaxother_presentDate" >
            </div>
        </div>
        <div class="form-group row">
            <div class="col-4">
                <label class="form-title">calculation date</label>
            </div>
            <div class="col-8">
                <input class="form-control datepicker" type="text" onchange="calcDepre2()" name="propAssetProptaxother_calcStart" id="propAssetProptaxother_calcStart" >
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="form-group row">
            <div class="col-4">
                <label class="form-title">residual value</label>
            </div>
            <div class="col-8">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text">Rp.</label>
                    </div>
                    <input class="form-control" type="text" data-val="true" data-val-number="The field Residu Val must be a number." data-val-range="Residu Val Harus diantara 0 dan 10000000000" data-val-range-max="10000000000" data-val-range-min="0" data-val-required="The Residu Val field is required." onchange="calcDepre2()" name="propAssetProptaxother_residuVal" id="propAssetProptaxother_residuVal" value="0">
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-4">
                <label class="form-title">year depreciation</label>
            </div>
            <div class="col-8">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text">Rp.</label>
                    </div>
                    <input class="form-control" readonly data-val="true" data-val-number="The field Yearly Dep must be a number." data-val-range="Yearly Dep Harus diantara 0 dan 10000000000" data-val-range-max="10000000000" data-val-range-min="0" data-val-required="The Yearly Dep field is required." type="text" onchange="calcDepre2()" name="propAssetProptaxother_yearlyDep" id="propAssetProptaxother_yearlyDep" >
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-4">
                <label class="form-title">accumulated depreciation</label>
            </div>
            <div class="col-8">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text">Rp.</label>
                    </div>
                    <input readonly class="form-control" type="text" data-val="true" data-val-number="The field Accu Val must be a number." data-val-range="Accu Val Harus diantara 0 dan 10000000000" data-val-range-max="10000000000" data-val-range-min="0" data-val-required="The Accu Val field is required." onchange="calcDepre2()" name="propAssetProptaxother_accuVal" id="propAssetProptaxother_accuVal" >
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-4">
                <label class="form-title">book value</label>
            </div>
            <div class="col-8">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text">Rp.</label>
                    </div>
                    <input readonly class="form-control" type="text" data-val="true" data-val-number="The field Book Val must be a number." data-val-range="Book Val Harus diantara 0 dan 10000000000" data-val-range-max="10000000000" data-val-range-min="0" data-val-required="The Book Val field is required." onchange="calcDepre2()" name="propAssetProptaxother_bookVal" id="propAssetProptaxother_bookVal" >
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
            //TANGGAL
            $('.datepicker').bootstrapMaterialDatePicker({
                weekStart: 0,
                time: false
            });
            $('#propAssetProptaxother_cost').keyup(function (event) {
                // skip for arrow keys
                if (event.which >= 37 && event.which <= 40) return;

                // format number
                $(this).val(function (index, value) {
                    return value
                        .replace(/\D/g, "")
                        .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                });
            });
            $('#propAssetProptaxother_expectedLifeTime').keyup(function (event) {

                // skip for arrow keys
                if (event.which >= 37 && event.which <= 40) return;

                // format number
                $(this).val(function (index, value) {
                    return value
                        .replace(/\D/g, "")
                        .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                });
            });
            $('#propAssetProptaxother_residuVal').keyup(function (event) {

                // skip for arrow keys
                if (event.which >= 37 && event.which <= 40) return;

                // format number
                $(this).val(function (index, value) {
                    return value
                        .replace(/\D/g, "")
                        .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                });
            });

            $('#propAssetProptaxother_yearlyDep').change(function (event) {

                // skip for arrow keys
                if (event.which >= 37 && event.which <= 40) return;

                // format number
                $(this).val(function (index, value) {
                    return value
                        .replace(/\D/g, "")
                        .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                });
            });
            $('#propAssetProptaxother_accuVal').change(function (event) {

                // skip for arrow keys
                if (event.which >= 37 && event.which <= 40) return;

                // format number
                $(this).val(function (index, value) {
                    return value
                        .replace(/\D/g, "")
                        .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                });
            });
            $('#propAssetProptaxother_bookVal').change(function (event) {

                // skip for arrow keys
                if (event.which >= 37 && event.which <= 40) return;

                // format number
                $(this).val(function (index, value) {
                    return value
                        .replace(/\D/g, "")
                        .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                });
            });
        });

    }
}
</script>
