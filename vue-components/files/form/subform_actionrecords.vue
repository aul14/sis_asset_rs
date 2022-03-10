<template>
<div class="p-1 border-top-1 border-light">
    <label class="form-title" samrs-typography="700">{{ listAlphabet }}. action taken</label>
    <div class="float-right">
        <input class="samrs-switch" type="checkbox" data-toggle="toggle"
        data-size="small" data-on="On" data-off="Off" data-onstyle="success"
        data-offstyle="danger" value="On" collapse-target="#collapseactionRecord" id="switch-tmpitemAction" name="tmpitemAction">
    </div>
    <div class="border-1 border-dark table-responsive collapse" id="collapseactionRecord">
        <table class="table samrs-tableview capitalize mb-0 actioRecords">
            <thead>
                <th class="w-90">action details</th>
                <th class="w-10">checklist</th>
                <th>options</th>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <input type="hidden" name="idGenFormGen[]" id="idGenFormGen0">
                        <input class="form-control" with-state="actionrecordField" type="text" name="genActionFormGen[]" id="genActionFormGen0">
                    </td>
                    <td>
                      <label class="p-10">
                        <input type="checkbox" disabled name="genResult[]" value="" id="">
                        <span class="ml-10">Done</span>
                      </label>
                    </td>
                    <td>
                      <div class="d-flex">
                          <button type="button" class="btn btn-sm samrs-danger removeactionRecord"><i class="fas fa-times"></i> Remove</button>
                      </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <button class="btn samrs-success" type="button" name="button" v-on:click="addrowactionrecord"><i class="fas fa-plus"></i> Add Row</button>
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
                  <input type="checkbox" disabled name="genResult[]" value="" id="`+this.number+`">
                  <span class="ml-10">Done</span>
                </label>
                </td>
                <td>
                  <div class="d-flex">
                    <button type="button" class="btn btn-sm samrs-danger removeactionRecord"><i class="fas fa-times"></i> Remove</button>
                  </div>
                </td>
            </tr>`;
            $('.actioRecords tbody').append(rowHtml);
            $('.removeactionRecord').on('click', function () {
                return $(this).parents('tr').remove();
            });
        }
    },
    mounted() {
        $('.removeactionRecord').on('click', function () {
            return $(this).parents('tr').remove();
        });
        $('.samrs-switch[collapse-target="#collapseactionRecord"]').each(function() {
          $(this).change(function(){
            if ($(this).prop('checked') === true) {
              $('.form-control[with-state="actionrecordField"]').each(function() {
                $(this).attr('required',true)
              });
            }else {
              $('.form-control[with-state="actionrecordField"]').each(function() {
                $(this).removeAttr('required');
              });
            }
          });
          if ($(this).prop('checked') === true) {
            $('.form-control[with-state="actionrecordField"]').each(function() {
              $(this).attr('required',true)
            });
          }else {
            $('.form-control[with-state="actionrecordField"]').each(function() {
              $(this).removeAttr('required');
            });
          }
        });
    }
}
</script>

<style scoped>
.is-soft-rounded {
    border-radius: 2px !important;
}
</style>
