<template>
<div class="p-1 border-top-1 border-light">
    <label class="form-title" samrs-typography="700">{{ listAlphabet }}. performance measurement (quantitative tasks)</label>
    <div class="float-right">
        <input class="samrs-switch" type="checkbox" data-toggle="toggle"
        data-size="small" data-on="On" data-off="Off" data-onstyle="success"
        data-offstyle="danger" value="Yes" collapse-target="#collapseQuantitative" id="switch-formukur" name="tmpitemPerf">
    </div>
    <div class="border-1 border-dark table-responsive collapse" id="collapseQuantitative">
        <table class="table samrs-tableview capitalize mb-0 quantitativeTask">
            <thead>
                <th class="w-40">parameters</th>
                <th class="w-15">adjustment on the tools</th>
                <th class="w-10">measurable</th>
                <th class="w-5">lower limit</th>
                <th class="w-5">upper limit</th>
                <th class="w-5">p/f</th>
                <th>options</th>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <input type="hidden" name="idUkurFormUkur[]" id="idUkurFormUkur0">
                        <input class="form-control" with-state="quantitativeField" type="text" name="ukurSubjectFormUkur[]" id="ukurSubjectFormUkur0">
                    </td>
                    <td>
                        <div class="d-flex">
                            <input class="form-control id-set-ukur" with-state="quantitativeField" style="text-align: center; width:40%;float:left;" type="text" name="ukurSetFormUkur[]" id="ukurSetFormUkur0">
                            <select class="form-control unitSelect" style="width:60%;float:right;" name="ukurUnitFormUkur[]" id="ukurUnitFormUkur0">
                                <option value="" id="val-ukurUnitFormUkur0"></option>
                            </select>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex">
                            <input class="form-control" type="text" readonly name="ukurVal[]" id="ukurValFormUkur0">

                        </div>
                    </td>
                    <td>
                        <div class="d-flex">
                            <input class="form-control" type="text" name="ukurMinFormUkur[]" id="ukurMinFormUkur0">

                        </div>
                    </td>
                    <td>
                        <div class="d-flex">
                            <input class="form-control" type="text" name="ukurMaxFormUkur[]" id="ukurMaxFormUkur0">

                        </div>
                    </td>
                    <td><input class="form-control" type="text" name="ukurResultFormUkur[]" id="ukurResult0" readonly></td>
                    <td>
                        <div class="d-flex">
                            <button type="button" class="btn btn-sm samrs-danger removerowsQuantitative"><i class="fas fa-times"></i> Remove</button>
                            <div class="collapse" id="calculator_0">
                                <input samrs-border="1px success" data-number="0" id="comparefieldQuantitative_0" class="form-control count-row-calculate" type="text" onkeypress="return hanyaAngka(event)" name="hitung_number[]" placeholder="%">
                            </div>
                            <button type="button" class="btn btn-sm samrs-success ml-10" data-numbtn="0" data-target="#calculator_0" data-toggle="collapse">Show Calc</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <button class="btn samrs-success" type="button" name="button" v-on:click="addrowquantitative"><i class="fas fa-plus"></i> Add Row</button>
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

        loadSelect2(index) {
            var unitSelect;

            if (index == -1) {
                unitSelect = $(`.unitSelect`)
            } else {
                unitSelect = $(`.unitSelect${index}`)
            }

            unitSelect.select2({
                ajax: {
                    url: BASE_URL + 'asset_unit/asset_unit_query',
                    dataType: 'json',
                    type: 'GET',
                    delay: 250,
                    processResults: function (data) {
                        provinces = data;

                        return {
                            results: $.map(data['data'], function (item) {
                                return {
                                    text: item.satuan,
                                    id: item.satuan
                                }
                            })
                        };
                    },
                }
            });
        },
        addrowquantitative: function (e) {
            this.number++;
            let rowHtml = `
            <tr>
                <td>
                    <input type="hidden" name="idUkurFormUkur[]" id="idUkurFormUkurA` + this.number + `">
                    <input class="form-control" with-state="quantitativeField" type="text" name="ukurSubjectFormUkur[]" id="ukurSubjectFormUkurA` + this.number + `" required>
                </td>
                <td>
                  <div class="d-flex">
                    <input class="form-control id-set-ukur" with-state="quantitativeField" type="text" name="ukurSetFormUkur[]"
                        id="ukurSetFormUkurA` + this.number + `" style="text-align: center; width:40%;float:left;" required>
                    <select class="form-control unitSelectA` + this.number + `" style="width:60%;float:right;" name="ukurUnitFormUkur[]" id="ukurUnitFormUkurA` + this.number + `">
                        <option value="" id="val-ukurUnitFormUkurA` + this.number + `"></option>
                    </select>
                  </div>
                </td>
                <td>
                  <div class="d-flex">
                    <input class="form-control" type="text" readonly name="ukurVal[]" id="ukurValFormUkurA` + this.number + `">

                  </div>
                </td>
                <td>
                  <div class="d-flex">
                    <input class="form-control" with-state="quantitativeField" type="text"  name="ukurMinFormUkur[]" id="ukurMinFormUkurA` + this.number + `" required>

                  </div>
                </td>
                <td>
                  <div class="d-flex">
                    <input class="form-control" with-state="quantitativeField" type="text"  name="ukurMaxFormUkur[]" id="ukurMaxFormUkurA` + this.number + `" required>

                  </div>
                </td>
                <td><input class="form-control" type="text"  name="ukurResultFormUkur[]" id="ukurResultA` + this.number + `" readonly></td>
                <td>
                  <div class="d-flex" id="quantitative_A` + this.number + `">
                    <button type="button" class="btn btn-sm samrs-danger removerowsQuantitative"><i class="fas fa-times"></i> Remove</button>
                    <div class="collapse" id="calculator_A` + this.number + `">
                      <input samrs-border="1px success" data-number="${this.number}" class="form-control count-row-calculateA" type="text" onkeypress="return hanyaAngka(event)" id="comparefieldQuantitative_A` + this.number + `" name="hitung_number[]" placeholder="%">
                    </div>
                    <button type="button" class="btn btn-sm samrs-success ml-10" data-target="#calculator_A` + this.number + `" data-toggle="collapse" data-numbtn="${this.number}" >Show Calc</button>
                  </div>
                </td>
            </tr>`;
            $('.quantitativeTask tbody').append(rowHtml);

            function decodeHtml(html) {
                var txt = document.createElement("textarea");
                txt.innerHTML = html;
                return txt.value;
            }

            $('.unitSelectA' + this.number).select2({
                ajax: {
                    url: BASE_URL + 'asset_unit/asset_unit_query',
                    dataType: 'json',
                    type: 'GET',
                    delay: 250,
                    processResults: function (data) {
                        provinces = data;

                        return {
                            results: $.map(data['data'], function (item) {
                                return {
                                    text: decodeHtml(item.satuan),
                                    id: item.satuan
                                }
                            })
                        };
                    },
                }
            });
            $('#calculator_A' + this.number).on('show.bs.collapse', function () {
                $(this).prev('.removerowsQuantitative').css({
                    display: 'none'
                });
                $(this).next('[data-toggle="collapse"]').removeClass('samrs-success').addClass('samrs-warning').text('Hide Calc');
            });
            $('#calculator_A' + this.number).on('hide.bs.collapse', function () {
                $(this).prev('.removerowsQuantitative').css({
                    display: ''
                });
                $(this).next('[data-toggle="collapse"]').removeClass('samrs-warning').addClass('samrs-success').text('Show Calc');
            });
            $('.removerowsQuantitative').on('click', function () {
                $(this).parents('tr').remove();
            });
        }
    },
    mounted() {
        $('#calculator_0').on('show.bs.collapse', function () {
            $(this).prev('.removerowsQuantitative').css({
                display: 'none'
            });
            $(this).next('[data-toggle="collapse"]').removeClass('samrs-success').addClass('samrs-warning').text('Hide Calc');
        });
        $('#calculator_0').on('hide.bs.collapse', function () {
            $(this).prev('.removerowsQuantitative').css({
                display: ''
            });
            $(this).next('[data-toggle="collapse"]').removeClass('samrs-warning').addClass('samrs-success').text('Show Calc');
        });
        $(document).on('keyup', '.count-row-calculateA', function () {
            var num = $(this).data('number');
            var unit = $(`#ukurUnitFormUkurA${num}`).val();
            if (unit == "") {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: "Unit of measurement cannot be empty",
                });
                $(`#comparefieldQuantitative_A${num}`).val("");
                return;
            }

            if (unit == '%') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: "Unit of measurement cannot be persens",
                });
                $(`#comparefieldQuantitative_A${num}`).val("");
                return;
            }
            //  var items = new Array();
            var val_ukur = $(`#ukurSetFormUkurA${num}`).val();
            var val_compare = $(`#comparefieldQuantitative_A${num}`).val();

            var ukur = parseFloat((val_ukur == '' ? 0 : val_ukur));
            var compare = parseFloat((val_compare == '' ? 0 : val_compare));

            var result = ukur * (compare / 100);
            var minimal = ukur - result;
            var maximal = ukur + result;
            $(`#ukurMinFormUkurA${num}`).val((minimal % 1 == 0 ? minimal : minimal.toFixed(2)));
            $(`#ukurMaxFormUkurA${num}`).val((maximal % 1 == 0 ? maximal : maximal.toFixed(2)));
        });

        $(document).on('keyup', '.count-row-calculate', function () {
            var num = $(this).data('number');
            var unit = $(`#ukurUnitFormUkur${num}`).val();
            if (unit == "") {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: "Unit of measurement cannot be empty",
                });
                $(`#comparefieldQuantitative_${num}`).val("");
                return;
            }

            if (unit == '%') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: "Unit of measurement cannot be persens",
                });
                $(`#comparefieldQuantitative_${num}`).val("");
                return;
            }
            //  var items = new Array();
            var val_ukur = $(`#ukurSetFormUkur${num}`).val();
            var val_compare = $(`#comparefieldQuantitative_${num}`).val();

            var ukur = parseFloat((val_ukur == '' ? 0 : val_ukur));
            var compare = parseFloat((val_compare == '' ? 0 : val_compare));

            var result = ukur * (compare / 100);
            var minimal = ukur - result;
            var maximal = ukur + result;
            $(`#ukurMinFormUkur${num}`).val((minimal % 1 == 0 ? minimal : minimal.toFixed(2)));
            $(`#ukurMaxFormUkur${num}`).val((maximal % 1 == 0 ? maximal : maximal.toFixed(2)));
        });

        $('.removerowsQuantitative').on('click', function () {
            return $(this).parents('tr').remove();
        });

        $('.unitSelect').focus(function () {
            loadSelect2(-1)
        });

        function decodeHtml(html) {
            var txt = document.createElement("textarea");
            txt.innerHTML = html;
            return txt.value;
        }


        function loadSelect2(index) {
            var unitSelect;

            if (index == -1) {
                unitSelect = $(`.unitSelect`)
            } else {
                unitSelect = $(`.unitSelect${index}`)
            }

            unitSelect.select2({
                ajax: {
                    url: BASE_URL + 'asset_unit/asset_unit_query',
                    dataType: 'json',
                    type: 'GET',
                    delay: 250,
                    processResults: function (data) {
                        provinces = data;

                        return {
                            results: $.map(data['data'], function (item) {
                                return {
                                    text: decodeHtml(item.satuan),
                                    id: item.satuan
                                }
                            })
                        };
                    },
                }
            });
        }
        $('.samrs-switch[collapse-target="#collapseQuantitative"]').each(function() {
          $(this).change(function(){
            if ($(this).prop('checked') === true) {
              $('.form-control[with-state="quantitativeField"]').each(function() {
                $(this).attr('required',true)
              });
            }else {
              $('.form-control[with-state="quantitativeField"]').each(function() {
                $(this).removeAttr('required');
              });
            }
          });
          if ($(this).prop('checked') === true) {
            $('.form-control[with-state="quantitativeField"]').each(function() {
              $(this).attr('required',true)
            });
          }else {
            $('.form-control[with-state="quantitativeField"]').each(function() {
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
