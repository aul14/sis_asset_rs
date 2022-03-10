<template>
<div class="row">
    <div class="col-xl-6">
        <div class="form-group row">
            <div class="col-4">
                <label class="form-title">procurement date</label>
            </div>
            <div class="col-8">
                <input class="form-control datepicker" type="text" onchange="calcDepre1()" name="propAssetProptax_presentDate" id="propAssetProptax_presentDate">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-4">
                <label class="form-title">year operation</label>
            </div>
            <div class="col-8">
                <input class="form-control" type="text" data-date-format="yyyy" name="propAssetPropadmin_yearProcurement" id="propAssetPropadmin_yearProcurement" autocomplete="off">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-4">
                <label class="form-title">po. number</label>
            </div>
            <div class="col-8">
                <input class="form-control" type="text" name="propAssetPropadmin_poNumb" id="propAssetPropadmin_poNumb">
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
                    <input class="form-control" data-val="true" data-val-number="The field Cost must be a number." data-val-range="Cost Harus diantara 0 dan 10000000000" data-val-range-max="10000000000" data-val-range-min="0" data-val-required="The Cost field is required." onkeypress="return hanyaAngka(event)" onchange="calcDepre1()" type="text" name="propAssetProptax_cost" id="propAssetProptax_cost" value="0" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-4">
                <label class="form-title">expectation life time</label>
            </div>
            <div class="col-8">
                <div class="input-group">
                    <input class="form-control" data-val="true" data-val-number="The field Expected Life Time must be a number." data-val-range="Expected Life Time Harus diantara 0 dan 10000000000" data-val-range-max="10000000000" data-val-range-min="0" data-val-required="The Expected Life Time field is required." type="text" onchange="calcDepre1()" name="propAssetProptax_expectedLifeTime" id="propAssetProptax_expectedLifeTime" value="0">
                    <div class="input-group-append">
                        <label class="input-group-text">Year</label>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="form-group row">
            <div class="col-4">
                <label class="form-title">procedural date</label>
            </div>
            <div class="col-8">
                <input class="form-control datepicker" type="text" onchange="calcDepre1()" name="propAssetProptax_presentDate" id="propAssetProptax_presentDate" >
            </div>
        </div> -->
        <div class="form-group row">
            <div class="col-4">
                <label class="form-title">calculation date</label>
            </div>
            <div class="col-8">
                <input class="form-control datepicker" type="text" onchange="calcDepre1()" name="propAssetProptax_calcStart" id="propAssetProptax_calcStart">
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
                    <input class="form-control" type="text" data-val="true" data-val-number="The field Residu Val must be a number." data-val-range="Residu Val Harus diantara 0 dan 10000000000" data-val-range-max="10000000000" data-val-range-min="0" data-val-required="The Residu Val field is required." onchange="calcDepre1()" name="propAssetProptax_residuVal" id="propAssetProptax_residuVal" value="0">
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
                    <input class="form-control" readonly data-val="true" data-val-number="The field Yearly Dep must be a number." data-val-range="Yearly Dep Harus diantara 0 dan 10000000000" data-val-range-max="10000000000" data-val-range-min="0" data-val-required="The Yearly Dep field is required." type="text" onchange="calcDepre1()" name="propAssetProptax_yearlyDep" id="propAssetProptax_yearlyDep">
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
                    <input readonly class="form-control" type="text" data-val="true" data-val-number="The field Accu Val must be a number." data-val-range="Accu Val Harus diantara 0 dan 10000000000" data-val-range-max="10000000000" data-val-range-min="0" data-val-required="The Accu Val field is required." onchange="calcDepre1()" name="propAssetProptax_accuVal" id="propAssetProptax_accuVal">
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
                    <input readonly class="form-control" type="text" data-val="true" data-val-number="The field Book Val must be a number." data-val-range="Book Val Harus diantara 0 dan 10000000000" data-val-range-max="10000000000" data-val-range-min="0" data-val-required="The Book Val field is required." onchange="calcDepre1()" name="propAssetProptax_bookVal" id="propAssetProptax_bookVal">
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
module.exports = {
    mounted() {

        $("#propAssetPropadmin_yearProcurement").datepicker({
            format: "yyyy", // Notice the Extra space at the beginning
            viewMode: "years",
            minViewMode: "years",
            autoclose: true
        }).on('hide', function (event) {
            event.preventDefault();
            event.stopPropagation();
        });
        $(function () {

            $("#propAssetPropadmin_poNumb").change(function () {
                var po_number = $(this).val();
                $("#po_number").val(po_number);
                // console.log(po_number);
            });
            //TANGGAL
            $('.datepicker').bootstrapMaterialDatePicker({
                weekStart: 0,
                time: false
            });

            $('#propAssetProptax_cost').keyup(function (event) {
                // skip for arrow keys
                if (event.which >= 37 && event.which <= 40) return;

                // format number
                $(this).val(function (index, value) {
                    return value
                        .replace(/\D/g, "")
                        .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                });
            });

            $('#propAssetProptax_expectedLifeTime').keyup(function (event) {

                // skip for arrow keys
                if (event.which >= 37 && event.which <= 40) return;

                // format number
                $(this).val(function (index, value) {
                    return value
                        .replace(/\D/g, "")
                        .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                });
            });
            $('#propAssetProptax_residuVal').keyup(function (event) {

                // skip for arrow keys
                if (event.which >= 37 && event.which <= 40) return;

                // format number
                $(this).val(function (index, value) {
                    return value
                        .replace(/\D/g, "")
                        .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                });
            });

            $('#propAssetProptax_yearlyDep').change(function (event) {

                // skip for arrow keys
                if (event.which >= 37 && event.which <= 40) return;

                // format number
                $(this).val(function (index, value) {
                    return value
                        .replace(/\D/g, "")
                        .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                });
            });
            $('#propAssetProptax_accuVal').change(function (event) {

                // skip for arrow keys
                if (event.which >= 37 && event.which <= 40) return;

                // format number
                $(this).val(function (index, value) {
                    return value
                        .replace(/\D/g, "")
                        .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                });
            });
            $('#propAssetProptax_bookVal').change(function (event) {

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
