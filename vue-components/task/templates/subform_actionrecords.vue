<template>
<div class="p-1 border-top-1 border-light">
    <label class="form-title" samrs-typography="700">{{ listAlphabet }}. action taken</label>
    <div class="border-1 border-dark table-responsive" id="table-actiorecords">
        <table class="table samrs-tableview capitalize mb-0 actioRecords">
            <thead>
                <th class="w-90">action details</th>
                <th class="w-10">checklist</th>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <input type="hidden" name="idGenFormGen[0]" id="idGenFormGen0">
                        <input class="form-control" readonly with-state="actionrecordField" type="text" name="genActionFormGen[0]" id="genActionFormGen0">
                    </td>
                    <td>
                        <label class="p-10">
                            <input type="checkbox" name="genResult[0]" id="genResult0" value="true">
                            <span class="ml-10">Done</span>
                        </label>
                    </td>
                  
                </tr>
            </tbody>
        </table>
    </div>
</div>
</template>

<script>
module.exports = {
    data() {
        return {
            number: 0
        }
    },
    props: {
        listAlphabet: {
            type: String,
            default: 'List_Unavailable',
        }
    },
    methods: {
        addrowactionrecord: function (e) {
            this.number++;
            let rowHtml = `
            <tr>
                <td>
                    <input type="hidden" name="idGenFormGen[]" id="idGenFormGen` + this.number + `">
                    <input class="form-control" with-state="actionrecordField" type="text" name="genActionFormGen[]" id="genActionFormGen` + this.number + `" required>
                </td>
                <td>
                <label class="p-10">
                  <input type="checkbox" name="genResult[]"  value="true">
                  <span class="ml-10">Done</span>
                </label>
                </td>
                <td>
                 
                </td>
            </tr>`;
            $('.actioRecords tbody').append(rowHtml);
          
        }
    },
    // mounted() {
    //     $('.removeactionRecord').on('click', function () {
    //         return $(this).parents('tr').remove();
    //     });
    //     $('.samrs-switch[collapse-target="#collapseactionRecord"]').each(function () {
    //         $(this).change(function () {
    //             if ($(this).prop('checked') === true) {
    //                 $('.form-control[with-state="actionrecordField"]').each(function () {
    //                     $(this).attr('required', true)
    //                 });
    //             } else {
    //                 $('.form-control[with-state="actionrecordField"]').each(function () {
    //                     $(this).removeAttr('required');
    //                 });
    //             }
    //         });
    //         if ($(this).prop('checked') === true) {
    //             $('.form-control[with-state="actionrecordField"]').each(function () {
    //                 $(this).attr('required', true)
    //             });
    //         } else {
    //             $('.form-control[with-state="actionrecordField"]').each(function () {
    //                 $(this).removeAttr('required');
    //             });
    //         }
    //     });
    // }
}
</script>

<style scoped>
.is-soft-rounded {
    border-radius: 2px !important;
}
</style>
