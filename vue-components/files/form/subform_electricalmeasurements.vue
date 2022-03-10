<template>
<div class="p-1 border-top-1 border-light table-responsive">
    <label class="form-title" samrs-typography="700">{{ listAlphabet }}. electrical safety measurement (safety test)</label>
    <div class="float-right">
        <input class="samrs-switch" type="checkbox" data-toggle="toggle" data-size="small"
        data-on="On" data-off="Off" data-onstyle="success" data-offstyle="danger"
        value="On" collapse-target="#collapseElectrical" id="switch-formelect" name="tmpitemESM">
    </div>
    <div class="border-1 border-dark table-responsive collapse" id="collapseElectrical">
        <table class="table samrs-tableview electricalSafety capitalize mb-0">
            <thead>
                <th class="w-40">parameters</th>
                <th class="w-15">measurable</th>
                <th class="w-15">lower limit</th>
                <th class="w-15">upper limit</th>
                <th class="w-5">p/f</th>
                <th>options</th>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <input type="hidden" name="idFpElect[]" id="idFpElect0">
                        <input class="form-control w-100" with-state="measurementField" type="text" name="electParam[]" id="electParam0">
                    </td>
                    <td>
                        <div class="d-flex">
                            <input class="form-control w-100" type="text" style="width:40%;float:left;" name="electMeasure[]" id="electMeasure0" readonly>
                            <select class="form-control unitSelectElect" style="width:60%;float:right;" name="electUnit[]" id="electUnit0">
                                <option value="" id="val-electunit0"></option>
                            </select>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex">
                            <input class="form-control w-100" type="text" name="electLower[]" id="electLower0">
                            <!-- <select class="form-control unitSelectElect" name="electUnit[0]">

                            </select> -->
                        </div>
                    </td>
                    <td>
                        <div class="d-flex">
                            <input class="form-control w-100" type="text" name="electUpper[]" id="electUpper0">

                        </div>
                    </td>
                    <td>
                        <div class="d-flex">
                            <input class="form-control w-100" type="text" name="electResult[]" readonly id="electResult0">
                        </div>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn samrs-danger removeRowsElectrical"><i class="fas fa-times"></i> Remove</button>
                        <!-- <button type="button" class="btn samrs-success ml-10" data-toggle="collapse" data-target="#safety_0">Calculate</button> -->
                        <div class="collapse samrs-grid grid-2 mt-1" id="safety_0">
                            <input samrs-border="1px" id="comparefieldSafety_0" class="form-control" type="number" name="" placeholder="Add number">
                            <button class="btn btn-sm samrs-primary" type="button" name="button" id="fieldexecuteSafety_0">Calculate</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <button class="btn samrs-success" type="button" name="button" v-on:click="addrowselectrical"><i class="fas fa-plus"></i> Add Row</button>
    </div>
</div>
</template>

<script>
module.exports = {
    data() {
        return {
            number: 1
        }
    },
    props: {
        listAlphabet: {
            type: String,
            default: 'List_Unavailable',
        }
    },
    methods: {
        loadSelect3(index) {
            var unitSelectElect;

            if (index == -1) {
                unitSelectElect = $(`.unitSelectElect`)
            } else {
                unitSelectElect = $(`.unitSelectElect${index}`)
            }

            unitSelectElect.select2({
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
        addrowselectrical: function (e) {
            let rowHtml = `
                    <tr>
                        <td>
                        <input type="hidden" name="idFpElect[]">
                        <input class="form-control w-100" with-state="measurementField" type="text" name="electParam[]" required>
                        </td>
                        <td>
                        <div class="d-flex">
                            <input class="form-control w-100" type="text" name="electMeasure[]" readonly >
                            <select class="form-control unitSelectElect` + this.number + `" style="width:60%;float:right;" name="electUnit[]">
                                <option value="" id="val-electunit` + this.number + `"></option>
                            </select>
                        </div>
                        </td>
                        <td>
                        <div class="d-flex">
                            <input class="form-control w-100" type="text" name="electLower[]">

                        </div>
                        </td>
                        <td>
                        <div class="d-flex">
                            <input class="form-control w-100" type="text" name="electUpper[]">

                        </div>
                        </td>
                        <td>
                        <div class="d-flex">
                            <input class="form-control w-100" type="text" name="electResult[]"  readonly>
                        </div>
                        </td>
                        <td class="text-center">
                        <button type="button" class="btn samrs-danger removeRowsElectrical"><i class="fas fa-times"></i> Remove</button>

                        <div class="collapse samrs-grid grid-2 mt-1" id="safety_` + this.number + `">
                            <input samrs-border="1px" id="comparefieldSafety_` + this.number + `" class="form-control" type="number" name=""  placeholder="Add number">
                            <button class="btn btn-sm samrs-primary" type="button" name="button" id="fieldexecuteSafety_` + this.number + `">Calculate</button>
                        </div>
                        </td>
                    </tr>
                    `;

            $('.electricalSafety tbody').append(rowHtml);

            function decodeHtml2(html) {
                var txt = document.createElement("textarea");
                txt.innerHTML = html;
                return txt.value;
            }

            $('.unitSelectElect' + this.number).select2({
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
                                    text: decodeHtml2(item.satuan),
                                    id: item.satuan
                                }
                            })
                        };
                    },
                }
            });
            this.number++;
            $('.removeRowsElectrical').on('click', function () {
                $(this).parents('tr').remove();
            });
        }
    },
    mounted() {
        $('.removeRowsElectrical').on('click', function () {
            $(this).parents('tr').remove();
        });

        $('.unitSelectElect').focus(function () {
            loadSelect3(-1)
        });

        function decodeHtml2(html) {
            var txt = document.createElement("textarea");
            txt.innerHTML = html;
            return txt.value;
        }

        function loadSelect3(index) {
            var unitSelectElect;

            if (index == -1) {
                unitSelectElect = $(`.unitSelectElect`)
            } else {
                unitSelectElect = $(`.unitSelectElect${index}`)
            }

            unitSelectElect.select2({
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
                                    text: decodeHtml2(item.satuan),
                                    id: item.satuan
                                }
                            })
                        };
                    },
                }
            });
        }
        $('.samrs-switch[collapse-target="#collapseElectrical"]').each(function() {
          $(this).change(function(){
            if ($(this).prop('checked') === true) {
              $('.form-control[with-state="measurementField"]').each(function() {
                $(this).attr('required',true)
              });
            }else {
              $('.form-control[with-state="measurementField"]').each(function() {
                $(this).removeAttr('required');
              });
            }
          });
          if ($(this).prop('checked') === true) {
            $('.form-control[with-state="measurementField"]').each(function() {
              $(this).attr('required',true)
            });
          }else {
            $('.form-control[with-state="measurementField"]').each(function() {
              $(this).removeAttr('required');
            });
          }
        });
    }
}
</script>
