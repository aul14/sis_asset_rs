<template>
<div class="row">
    <div class="col-xl-6">
        <div class="form-group row">
            <div class="col-4">
                <label class="form-title">procurement date</label>
            </div>
            <div class="col-8">
                <input type="hidden" name="form_depreciation1_text">
                <input type="hidden" name="form_depreciation2_text">
                <input class="form-control datepicker" type="text" name="propAssetPropadmin_procureDate" id="propAssetPropadmin_procureDate">
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
                    <input class="form-control" autocomplete="off" onkeypress="return hanyaAngka(event)" type="text" name="propAssetPropadmin_priceBuy" id="propAssetPropadmin_priceBuy">
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-4">
                <label class="form-title">supplier / vendor</label>
            </div>
            <div class="col-8">
                <select class="form-control selectpicker-supplier with-ajax-supplier" data-live-search="true" name="propAssetPropgenit_idSupplier" id="propAssetPropgenit_idSupplier">
                    <option value="" id="option-ajax-supplier">Tap to search</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-4">
                <label class="form-title">condition</label>
            </div>
            <div class="col-8">
                <select class="form-control selectpicker-not-ajax" data-live-search="true" name="propAssetPropadmin_condition" id="propAssetPropadmin_condition">
                    <!-- <option >Tap to search</option> -->
                    <option value="Baik">Baik</option>
                    <option value="Rusak Ringan">Rusak Ringan</option>
                    <option value="Rusak Berat">Rusak Berat</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-4">
                <label class="form-title">ownership</label>
            </div>
            <div class="col-8">
                <select class="form-control selectpicker-not-ajax" data-live-search="true" name="propAssetPropadmin_ownershipType" id="propAssetPropadmin_ownershipType">
                    <!-- <option >Tap to search</option> -->
                    <option value="Owned">Owned</option>
                    <option value="Rent">Rent</option>
                    <option value="KSO">KSO</option>
                    <option value="Bantuan">Bantuan</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-4">
                <label class="form-title">source of funds</label>
            </div>
            <div class="col-8">
                <!-- <select class="form-control" name="propAssetPropadmin.idFund">
                    <option >Pilih</option>
                </select> -->
                <slot name="funding-tab"></slot>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-4">
                <label class="form-title">status activation</label>
            </div>
            <div class="col-8">
                <select class="form-control selectpicker-not-ajax" data-live-search="true" name="propAssetPropadmin_status">
                    <!-- <option >Tap to search</option> -->
                    <option value="Active">Active</option>
                    <option value="Non-Active">Non-Active</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-4">
                <label class="form-title">inactive date</label>
            </div>
            <div class="col-8">
                <input class="form-control datepicker" type="text" name="propAssetPropadmin_inactive_date">
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="form-group row">
            <div class="col-4">
                <label class="form-title">warranty expired</label>
            </div>
            <div class="col-8">
                <input class="form-control datepicker" type="text" name="propAssetPropgenit_warrantyExpired">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-4">
                <label class="form-title">electrical output</label>
            </div>
            <div class="col-8">
                <input id="propAssetPropelectrical_idAsset" name="propAssetPropelectrical_idAsset" type="hidden" />
                <input class="form-control" type="text" name="propAssetPropelectrical_voltageOutput">
            </div>
        </div>
        <div class="form-group">
            <label class="form-title">other information</label>
            <textarea class="form-control" name="propAssetPropgenit_spesifikasi" rows="8" cols="40"></textarea>
        </div>
    </div>
</div>
</template>

<script>
module.exports = {
    mounted() {

        $("input[name=propAssetPropadmin_procureDate]").change(function () {
            let value = $(this).val();

            let form_dep1 = $("input[name=form_depreciation1_text]").val();
            // console.log(value);
            if (form_dep1 == "form") {
                $("input[name=propAssetProptax_presentDate]").val(value).change();
            } else {
                $("input[name=propAssetProptax_cost]").val("");
            }
        });

        $("input[name=propAssetPropadmin_priceBuy]").change(function () {
            let value = $(this).val();

            let form_dep1 = $("input[name=form_depreciation1_text]").val();
            // console.log(value);
            if (form_dep1 == "form") {
                $("input[name=propAssetProptax_cost]").val(value).change();
            } else {
                $("input[name=propAssetProptax_cost]").val("");
            }
        });
        $(function () {
            //TANGGAL
            $('.datepicker').bootstrapMaterialDatePicker({
                weekStart: 0,
                time: false
            });
            evtSupplier('init', null);
            $('.selectpicker-not-ajax').selectpicker();
        });

        $('#propAssetPropadmin_priceBuy').keyup(function (event) {
            // skip for arrow keys
            if (event.which >= 37 && event.which <= 40) return;

            // format number
            $(this).val(function (index, value) {
                return value
                    .replace(/\D/g, "")
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            });
        });

        function evtSupplier(evt) {
            var options = {
                ajax: {
                    // url     : SITE_URL + "assets/vendors/bootstrap-select-ajax/example/php/ajax.php",
                    emptyRequest: true,
                    url: BASE_URL + "asset/me/inventory_me/ajax_supplier",
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
                    var i, lo = data.length,
                        array = [];

                    if (lo) {
                        for (i = 0; i < lo; i++) {
                            array.push($.extend(true, data[i], {
                                text: data[i].contactCompany,
                                value: data[i].idContact,
                                data: {
                                    subtext: data[i].contactPerson
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
                $('.selectpicker-supplier').selectpicker().filter('.with-ajax-supplier').ajaxSelectPicker(options);
            } else if (evt == 'render') {
                $('.selectpicker-supplier').selectpicker().filter('.with-ajax-supplier').ajaxSelectPicker('render');
            }
        }

    }
}
</script>
