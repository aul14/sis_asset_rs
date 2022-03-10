<template>
<div class="p-1">
    <div class="row">
        <div class="col-xl-6">
            <!-- <div class="form-group row">
                <div class="col-4">
                    <label class="form-title">procurement date</label>
                </div>
                <div class="col-8">
                     <input type="hidden" id="ajax_idasset_stock" name="ajax_idasset_stock">
                    <input class="form-control datepicker" type="text" name="propAssetPropadmin_procureDate_stock" id="propAssetPropadmin_procureDate">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-4">
                    <label class="form-title">po. number</label>
                </div>
                <div class="col-8">
                    <input class="form-control" autocomplete="off" type="text" name="propAssetPropadmin_poNumb_stock" id="propAssetPropadmin_poNumb">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-4">
                    <label class="form-title">price buy</label>
                </div>
                <div class="col-8">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text">Rp.</label>
                        </div>
                        <input class="form-control" autocomplete="off" data-val="true" data-val-number="The field Cost must be a number." data-val-range="Cost Harus diantara 0 dan 10000000000" data-val-range-max="10000000000" data-val-range-min="0" data-val-required="The Cost field is required." onkeypress="return hanyaAngka(event)" type="text" name="propAssetPropadmin_priceBuy_stock" id="propAssetPropadmin_priceBuy_stock">
                    </div>
                </div>
            </div> -->
            <div class="form-group row">
                <div class="col-xl-4">
                    <label class="form-title">stock location</label>
                </div>
                <input class="form-control" name="propAssetPropadmin_idRoom_stock" type="hidden" />
                <input class="form-control" name="idStockIn" type="hidden" />
                <input class="form-control" name="idStockOut" type="hidden" />
                <div class="col-xl-8">
                    <input class="form-control" type="text" name="propAssetPropstock_idLocation" id="propAssetPropstock_idLocation" readonly>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xl-4">
                    <label class="form-title">stock name</label>
                </div>
                <div class="col-xl-8">
                    <input class="form-control" type="text" autocomplete="off" name="propAssetPropstock_stockName">
                    <input class="form-control" type="hidden" autocomplete="off" name="propAssetPropstock_stockName2">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xl-4">
                    <label class="form-title">quantity stock</label>
                </div>
                <div class="col-xl-8">
                    <input class="form-control" name="propAssetPropstock_qtyCurrent" onkeypress="return hanyaAngka(event)" type="text" autocomplete="off">
                    <input class="form-control" name="propAssetPropstock_qtyCurrent2" onkeypress="return hanyaAngka(event)" type="hidden" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xl-4">
                    <label class="form-title">quantity</label>
                </div>
                <div class="col-xl-8">
                    <div class="row">
                        <div class="col-xl-6">
                            <label class="form-title">quantity minimum stock</label>
                            <input class="form-control" autocomplete="off" onkeypress="return hanyaAngka(event)" type="text" name="propAssetPropstock_qtyMin">
                            <input class="form-control" autocomplete="off" onkeypress="return hanyaAngka(event)" type="hidden" name="propAssetPropstock_qtyMin2">
                        </div>
                        <div class="col-xl-6">
                            <label class="form-title">quantity available</label>
                            <input class="form-control" readonly type="number" style="display: none;" name="ajax_qty_in" id="ajax_qty_in">
                            <input class="form-control" readonly type="number" style="display: none;" name="ajax_qty_out" id="ajax_qty_out">
                            <input class="form-control" readonly type="number" name="ajax_qty_all" id="ajax_qty_all">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="form-group row">
                <div class="col-xl-4">
                    <label class="form-title">description</label>
                </div>
                <div class="col-xl-8">
                    <textarea class="form-control" name="propAssetPropstock_stockDesc" id="propAssetPropstock_stockDesc" rows="8" cols="80"></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6">
            <fieldset class="border-1 border-light field-roles">
                <legend class="field-parent-name text-center w-25 ml-10">Stock In</legend>
                <div class="float-right mr-20">
                    <button class="btn samrs-primary" type="submit" name="button" id="ajax_btn_stock_in"><i class="fas fa-plus"></i> Add Stock In</button>
                </div>
                <div class="table-responsive">
                    <table class="stockin_list table samrs-tableview capitalize samrs-table-striped table-hover">
                        <thead>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </fieldset>
        </div>
        <div class="col-xl-6">
            <fieldset class="border-1 border-light field-roles">
                <legend class="field-parent-name text-center w-25 ml-10">Stock Out</legend>
                <div class="float-right mr-20">
                    <button class="btn samrs-primary" type="submit" name="button" id="ajax_btn_stock_out"><i class="fas fa-plus"></i> Add Stock Out</button>
                </div>
                <div class="table-responsive">
                    <table class="stockout_list table samrs-tableview capitalize samrs-table-striped table-hover">
                        <thead>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </fieldset>
        </div>
    </div>
</div>
</template>

<script>
module.exports = {
    methods: {
        selectlocation() {
            $('#select_location').modal('show');
            SelectLocation();
        }
    },
    mounted() {

        $(function () {
            //TANGGAL
            $('.datepicker').bootstrapMaterialDatePicker({
                weekStart: 0,
                time: false
            });

            $('#propAssetPropadmin_priceBuy_stock').keyup(function (event) {
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
