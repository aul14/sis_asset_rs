<template>
<div class="p-1 border-top-1 border-light">
    <label class="form-title" samrs-typography="700">
        {{ listAlphabet }}. measuring equipment
    </label>
    <div class="border-1 border-dark table-responsive" id="table-measuringtools">
        <table class="table samrs-tableview capitalize measuringTools mb-0">
            <thead>
                <th>assets name</th>
                <th>brand</th>
                <th>type</th>
                <th>serial number</th>
                <th id="th-option-alkur">options</th>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <input type="hidden" name="idFpAlkur[]" id="idFpAlkur0">
                        <input type="hidden" name="idAssetFormAlkur[]" id="idAssetFormAlkur0">
                        <input class="form-control w-100" type="text" name="assetNameFormAlkur[]" id="assetNameFormAlkur0" readonly>
                    </td>
                    <td><input class="form-control w-100" type="text" name="assetMerkFormAlkur[]" id="assetMerkFormAlkur0" readonly></td>
                    <td><input class="form-control w-100" type="text" name="assetTypeFormAlkur[]" id="assetTypeFormAlkur0" readonly></td>
                    <td><input class="form-control w-100" type="text" name="assetSNFormAlkur[]" id="assetSNFormAlkur0" readonly></td>
                    <td class="text-center" id="td-option-alkur">
                        <button type="button" class="btn samrs-success pick-tools" id="0"> pick</button>

                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</template>

<script>
module.exports = {
    props: {
        listAlphabet: {
            type: String,
            default: 'List_Unavailable',
        }
    },
    mounted() {

        var indexPick = 0;
        $(document).on("click", ".pick-tools", function () {
            indexPick = $(this).attr('id');
            $('#select_tools').modal('show');
            var TASKSYSCAT = $("input[name=taskSysCat]").val();
            ToolsList(TASKSYSCAT);
        });

        $(document).on("click", ".radioButtonAsset", function () {
            // console.log('indexPick', indexPick)
            $(`#idAssetFormAlkur${indexPick}`).val($(this).val());
            // $('#assetCode').val(data.data.assetCode);
            $(`#assetNameFormAlkur${indexPick}`).val($(this).data('asset_name'));
            $(`#assetMerkFormAlkur${indexPick}`).val($(this).data('merk'));
            $(`#assetTypeFormAlkur${indexPick}`).val($(this).data('tipe'));
            $(`#assetSNFormAlkur${indexPick}`).val($(this).data('sn'));

            $('#select_tools').modal('hide');
        });
    }
}
</script>
