<template>
<div class="p-10 border-1 border-dashed border-light mt-10">
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">tools asset code</label>
        </div>
        <input type="hidden" name="idAssettools">
        <input type="hidden" name="merktools">
        <input type="hidden" name="tipetools">
        <input type="hidden" name="serialNumbertools">
        <div class="col-xl-8">
            <div class="input-group">
                <input class="form-control" type="text" name="assetCodetools" readonly>
                <div class="input-group-prepend">
                    <button class="btn samrs-primary" type="button" name="button" v-on:click="pickTools">Pick Assets</button>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">asset name</label>
        </div>
        <div class="col-xl-8">
            <input class="form-control" type="text" name="assetNametools" readonly>
        </div>
    </div>
    <div class="form-group">
        <button class="btn btn-sm samrs-primary btn-block" type="button" name="button" id="add-prop-tools"><i class="fas fa-plus"></i> Add</button>
    </div>
</div>
</template>

<script>
module.exports = {
    methods: {
        pickTools: function () {
            $('#select_tools').modal('show');
            var TASKSYSCAT = $("input[name=taskSysCat]").val();
            ToolsList(TASKSYSCAT);
        },
    },
    mounted() {
        $(function () {
            $("#add-prop-tools").click(function () {
                // e.preventDefault();
                var ajax_idform_tools = $("input[name=idForm]").val();

                if (ajax_idform_tools == '') {
                    var url_tools = BASE_URL + "task/med/task_datatable/session_add_tools";
                } else {
                    var url_tools = BASE_URL + "task/med/task_datatable/session_add_tools/" + ajax_idform_tools;
                }
                var idAssettools = $('input[name=idAssettools]').val();
                var assetCodetools = $('input[name=assetCodetools]').val();
                var assetNametools = $('input[name=assetNametools]').val();
                var merktools = $('input[name=merktools]').val();
                var tipetools = $('input[name=tipetools]').val();
                var serialNumbertools = $('input[name=serialNumbertools]').val();

                $.ajax({
                    type: "POST",
                    url: url_tools,
                    data: {
                        idAssettools: idAssettools,
                        assetCodetools: assetCodetools,
                        assetNametools: assetNametools,
                        merktools: merktools,
                        tipetools: tipetools,
                        serialNumbertools: serialNumbertools,
                    },
                    dataType: "json",
                    success: function (response) {
                        if (response) {
                            // if (ajax_idasset_edit === '') {
                            $('.toolsusage_list').DataTable().ajax.reload();

                            $('input[name=idAssettools]').val("");
                            $('input[name=assetCodetools]').val("");
                            $('input[name=assetNametools]').val("");
                            $('input[name=qty_tools]').val("");
                            $('input[name=merktools]').val("");
                            $('input[name=tipetools]').val("");
                            $('input[name=serialNumbertools]').val("");
                            $('input[name=pricetools]').val("");
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

            });
            $(document).on('click', '#selected-asset-tools', function () {
                var id_asset = this.value;
                var code = $(this).data('code');
                var asset_name = $(this).data('asset_name');
                var merk = $(this).data('merk');
                var tipe = $(this).data('tipe');
                var sn = $(this).data('sn');

                $('input[name=idAssettools]').val(id_asset);
                $('input[name=assetCodetools]').val(code);
                $('input[name=assetNametools]').val(asset_name);
                $('input[name=merktools]').val(merk);
                $('input[name=tipetools]').val(tipe);
                $('input[name=serialNumbertools]').val(sn);

            });
        });
    },
}
</script>
