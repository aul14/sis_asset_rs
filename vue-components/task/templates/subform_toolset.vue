<template>
<div class="p-1 border-top-1 border-light">
    <label class="form-title" samrs-typography="700">{{ listAlphabet }}. toolset usage</label>

    <div class="border-1 border-dark table-responsive" id="table-toolsetusage">
        <table class="table samrs-tableview capitalize toolsetUsage mb-0">
            <thead>
                <th>assets name</th>
                <th>brand</th>
                <th>type</th>
                <th>serial number</th>
                <th id="th-option-tools">options</th>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <input type="hidden" name="idFpTools[]" id="idFpTools0">
                        <input type="hidden" name="idAssetFormTools[]" id="idAssetFormTools0">
                        <input class="form-control w-100" type="text" name="assetNameFormTools[]" id="assetNameFormTools0" readonly>
                    </td>
                    <td><input class="form-control w-100" type="text" name="assetMerkFormTools[]" id="assetMerkFormTools0" readonly></td>
                    <td><input class="form-control w-100" type="text" name="assetTypeFormTools[]" id="assetTypeFormTools0" readonly></td>
                    <td><input class="form-control w-100" type="text" name="assetSNFormTools[]" id="assetSNFormTools0" readonly></td>
                    <td class="text-center" id="td-option-tools">
                        <button type="button" class="btn samrs-success pick-toolset" id="0"> Pick</button>
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
        let indexPick = 0;
        $(document).on("click", ".pick-toolset", function () {
            indexPick = $(this).attr('id');
            $('#select_tools2').modal('show');
            var TASKSYSCAT = $("input[name=taskSysCat]").val();
            $('.radioButtonAsset').attr('data-info', 'ini tools');
            ToolsList2(TASKSYSCAT);
        });
        $(document).on("click", ".radioButtonAsset2", function () {
            // console.log('indexPick', indexPick)
            $(`#idAssetFormTools${indexPick}`).val($(this).val());
            // $('#assetCode').val(data.data.assetCode);
            $(`#assetNameFormTools${indexPick}`).val($(this).data('asset_name'));
            $(`#assetMerkFormTools${indexPick}`).val($(this).data('merk'));
            $(`#assetTypeFormTools${indexPick}`).val($(this).data('tipe'));
            $(`#assetSNFormTools${indexPick}`).val($(this).data('sn'));

            $('#select_tools2').modal('hide');
        });
    }
}
</script>
