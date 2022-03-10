<template>
<div class="p-1 border-top-1 border-light">
    <label class="form-title" samrs-typography="700">{{ listAlphabet }}. performance measurement (quantitative tasks)</label>
    <div class="border-1 border-dark table-responsive" id="table-quantitativetask">
        <table class="table samrs-tableview capitalize mb-0 quantitativeTask">
            <thead>
                <th class="w-40">parameters</th>
                <th class="w-15">adjustment on the tools</th>
                <th class="w-15">measurable</th>
                <th class="w-5">lower limit</th>
                <th class="w-5">upper limit</th>
                <th class="w-5">p/f</th>

            </thead>
            <tbody>
                <tr>
                    <td>
                        <input type="hidden" name="idUkurFormUkur[]" id="idUkurFormUkur0">
                        <input class="form-control" type="text" name="ukurSubjectFormUkur[]" id="ukurSubjectFormUkur0" readonly>
                    </td>
                    <td>
                        <div class="d-flex">
                            <input class="form-control id-set-ukur" style="text-align: center; width:40%;float:left;" type="text" name="ukurSetFormUkur[]" id="ukurSetFormUkur0" readonly>
                            <select class="form-control unitSelect" style="width:60%;float:right;">
                                <option value="" id="val-ukurUnitFormUkurB0"></option>
                            </select>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex">
                            <input class="form-control count-val" style="text-align: center; width:40%;float:left;" type="text" name="ukurVal[]" data-number="0" id="ukurValFormUkur0">
                            <select class="form-control unitSelect" style="width:60%;float:right;" name="ukurUnitFormUkur[]" id="ukurUnitFormUkur0">
                                <option value="" id="val-ukurUnitFormUkur0"></option>
                            </select>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex">
                            <input class="form-control" type="text" readonly name="ukurMinFormUkur[]" id="ukurMinFormUkur0">

                        </div>
                    </td>
                    <td>
                        <div class="d-flex">
                            <input class="form-control" type="text" readonly name="ukurMaxFormUkur[]" id="ukurMaxFormUkur0">

                        </div>
                    </td>
                    <td class="text-center">
                        <img src="" id="ukurResultImg0">
                        <input class="form-control" type="hidden" name="ukurResultFormUkur[]" id="ukurResult0" readonly>
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
    mounted() {
        $(document).on('keyup', '.count-val', function () {
            var num = $(this).data('number');
            var valUkurVal = $(`#ukurValFormUkur${num}`).val();
            var valUkurMin = parseFloat($(`#ukurMinFormUkur${num}`).val());
            var valUkurMax = parseFloat($(`#ukurMaxFormUkur${num}`).val());
            var ukurMin = $(`#ukurMinFormUkur${num}`).val();
            var ukurMax = $(`#ukurMaxFormUkur${num}`).val();
            var valUkurSet = parseFloat($(`#ukurSetFormUkur${num}`).val());
            var valUkurUnit = $(`#ukurUnitFormUkur${num}`).val();

            if (valUkurUnit == '%') {
                var min = valUkurSet * valUkurMin / 100;
                var max = valUkurSet * valUkurMax / 100;

                var fixMin = valUkurSet - min;
                var fixMax = valUkurSet + max;

                if (valUkurVal >= fixMin && valUkurVal <= fixMax) {
                    // console.log(true)
                    $(`#ukurResult${num}`).val("true");
                    $(`#ukurResultImg${num}`).attr("src", BASE_URL + "assets/images/icon/check.png");
                } else {
                    $(`#ukurResult${num}`).val("false");
                    $(`#ukurResultImg${num}`).attr("src", BASE_URL + "assets/images/icon/no.png");
                }

                console.log('ukurVal ' + valUkurVal)
                console.log('min ' + fixMin)
                console.log('max ' + fixMax)
            } else {
                if (valUkurVal >= valUkurMin && valUkurVal <= valUkurMax) {
                    $(`#ukurResult${num}`).val("true");
                    $(`#ukurResultImg${num}`).attr("src", BASE_URL + "assets/images/icon/check.png");
                } else {
                    $(`#ukurResult${num}`).val("false");
                    $(`#ukurResultImg${num}`).attr("src", BASE_URL + "assets/images/icon/no.png");
                }
            }
        });
    },
}
</script>

<style scoped>
.is-soft-rounded {
    border-radius: 2px !important;
}
</style>
