<template>
<div class="p-10 border-1 border-dashed border-light mt-10">
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">sparepart asset code</label>
            <input class="form-control" type="hidden" name="merkparts">
            <input class="form-control" type="hidden" name="tipeparts">
            <input class="form-control" type="hidden" name="serialNumberparts">
            <input class="form-control" type="hidden" name="idAssetparts">
            <input class="form-control" type="hidden" name="qtycurrentparts">
            <input class="form-control" type="hidden" name="priceparts">
        </div>
        <div class="col-xl-8">
            <div class="input-group">
                <input class="form-control" type="text" name="assetCodeparts" readonly>
                <div class="input-group-prepend">
                    <button class="btn samrs-primary" type="button" name="button" v-on:click="pickSpareparts">Pick Assets</button>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">asset name</label>
        </div>

        <div class="col-xl-8">
            <input class="form-control" type="text" name="assetNameparts" readonly>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">quantity</label>
        </div>
        <div class="col-xl-8">
            <input class="form-control" type="number" name="qty_parts" min="0">
        </div>
    </div>
    <div class="form-group">
        <button class="btn btn-sm samrs-primary btn-block" type="button" name="button" id="add-prop-stock"><i class="fas fa-plus"></i> Add</button>
    </div>
</div>
</template>

<script>
module.exports = {
    methods: {
        pickSpareparts: function () {
            $('#select_sparepart').modal('show');
            var TASKSYSCAT = $("input[name=taskSysCat]").val();
            SparepartList(TASKSYSCAT);
        },
    },
    mounted() {
        $(function () {

            $("#add-prop-stock").click(function () {
                // e.preventDefault();
                var ajax_idform = $("input[name=idForm]").val();
                if (ajax_idform == '') {
                    var url_stock = BASE_URL + "task/med/task_datatable/session_add_stock";
                } else {
                    var url_stock = BASE_URL + "task/med/task_datatable/session_add_stock/" + ajax_idform;
                }
                var idAssetparts = $('input[name=idAssetparts]').val();
                var assetCodeparts = $('input[name=assetCodeparts]').val();
                var assetNameparts = $('input[name=assetNameparts]').val();
                var qty_parts = $('input[name=qty_parts]').val();
                var merkparts = $('input[name=merkparts]').val();
                var tipeparts = $('input[name=tipeparts]').val();
                var serialNumberparts = $('input[name=serialNumberparts]').val();
                var priceparts = $('input[name=priceparts]').val();

                // var qty2 = $('input[name=qtycurrentparts]').val();
                // if (qty_parts >= qty2) {
                //     alert('the number of qty exceeds the available stock limit');
                //     $('input[name=qty_parts]').val("");
                //     return;
                // } else {
                $.ajax({
                    type: "POST",
                    url: url_stock,
                    data: {
                        idAssetparts: idAssetparts,
                        assetCodeparts: assetCodeparts,
                        assetNameparts: assetNameparts,
                        qty_parts: qty_parts,
                        merkparts: merkparts,
                        tipeparts: tipeparts,
                        serialNumberparts: serialNumberparts,
                        priceparts: priceparts
                    },
                    dataType: "json",
                    success: function (response) {
                        // console.log(response);
                        if (response) {
                            // if (ajax_idasset_edit === '') {
                            $('.sparepartusage_list').DataTable().ajax.reload();
                            $('input[name=idAssetparts]').val("");
                            $('input[name=assetCodeparts]').val("");
                            $('input[name=assetNameparts]').val("");
                            $('input[name=qty_parts]').val("");
                            $('input[name=merkparts]').val("");
                            $('input[name=tipeparts]').val("");
                            $('input[name=serialNumberparts]').val("");
                            $('input[name=priceparts]').val("");
                            // } else {
                            //     $('.file_list').DataTable().ajax.url(BASE_URL + "asset_propfiles/asset_propfiles_by_id_asset/" + ajax_idasset_edit).load();
                            // }
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Oops...',
                                text: response.message,
                            });
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log(thrownError)
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: thrownError,
                        });
                    }
                });
                // }

            });
            $(document).on('click', '#selected-asset-parts', function () {
                var id_asset = this.value;
                var code = $(this).data('code');
                var asset_name = $(this).data('asset_name');
                var merk = $(this).data('merk');
                var tipe = $(this).data('tipe');
                var sn = $(this).data('sn');
                var qtycurrent = $(this).data('qtycurrent');
                var priceparts = $(this).data('price');

                $('input[name=idAssetparts]').val(id_asset);
                $('input[name=assetCodeparts]').val(code);
                $('input[name=assetNameparts]').val(asset_name);
                $('input[name=merkparts]').val(merk);
                $('input[name=tipeparts]').val(tipe);
                $('input[name=qtycurrentparts]').val(qtycurrent);
                $('input[name=serialNumberparts]').val(sn);
                $('input[name=priceparts]').val(priceparts);
            });
        });

    },
}
</script>
