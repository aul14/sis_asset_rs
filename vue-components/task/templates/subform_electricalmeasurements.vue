<template>
<div class="p-1 border-top-1 border-light table-responsive">
    <label class="form-title" samrs-typography="700">{{ listAlphabet }}. electrical safety measurement (safety test)</label>

    <div class="border-1 border-dark table-responsive" id="table-electricalsafety">
        <table class="table samrs-tableview electricalSafety capitalize mb-0">
            <thead>
                <th class="w-40">parameters</th>
                <th class="w-15">measurable</th>
                <th class="w-15">lower limit</th>
                <th class="w-15">upper limit</th>
                <th class="w-5">p/f</th>
                <!-- <th>options</th> -->
            </thead>
            <tbody>
                <tr>
                    <td>
                        <input type="hidden" name="idFpElect[]" id="idFpElect0">
                        <input class="form-control w-100" type="text" name="electParam[]" id="electParam0" readonly>
                    </td>
                    <td>
                        <div class="d-flex">
                            <input class="form-control w-100 count-elect" data-number="0" type="text" style="width:40%;float:left;" name="electMeasure[]" id="electMeasure0">
                            <select class="form-control unitSelectElect" style="width:60%;float:right;" name="electUnit[]" id="electUnit0">
                                <option value="" id="val-electunit0"></option>
                            </select>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex">
                            <input class="form-control w-100" type="text" name="electLower[]" id="electLower0" readonly>

                        </div>
                    </td>
                    <td>
                        <div class="d-flex">
                            <input class="form-control w-100" type="text" name="electUpper[]" id="electUpper0" readonly>

                        </div>
                    </td>
                    <td class="text-center">
                        <div class="d-flex">
                            <img src="" id="electResultImg0">
                            <input class="form-control w-100" type="hidden" name="electResult[]" readonly id="electResult0">
                        </div>
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
            number: 1
        }
    },
    props: {
        listAlphabet: {
            type: String,
            default: 'List_Unavailable',
        }
    },
   mounted() {
       $(document).on('keyup', '.count-elect', function () {
            var num = $(this).data('number');
            var valUkurVal = $(`#electMeasure${num}`).val();
            var valUkurMin = parseFloat($(`#electLower${num}`).val());
            var valUkurMax = parseFloat($(`#electUpper${num}`).val());
            var valUkurSet = 0;
            var valUkurUnit = $(`#electUnit${num}`).val();

            if (valUkurUnit == '%') {
                var min = valUkurSet * valUkurMin / 100;
                var max = valUkurSet * valUkurMax / 100;

                var fixMin = valUkurSet - min;
                var fixMax = valUkurSet + max;

                if (valUkurVal >= fixMin && valUkurVal <= fixMax) {
                    // console.log(true)
                    $(`#electResult${num}`).val("true");
                    $(`#electResultImg${num}`).attr("src", BASE_URL + "assets/images/icon/check.png");
                } else {
                    $(`#electResult${num}`).val("false");
                    $(`#electResultImg${num}`).attr("src", BASE_URL + "assets/images/icon/no.png");
                }

                console.log('ukurVal ' + valUkurVal)
                console.log('min ' + fixMin)
                console.log('max ' + fixMax)
            } else {
                if (valUkurVal >= valUkurMin && valUkurVal <= valUkurMax) {
                    $(`#electResult${num}`).val("true");
                    $(`#electResultImg${num}`).attr("src", BASE_URL + "assets/images/icon/check.png");
                } else {
                    $(`#electResult${num}`).val("false");
                    $(`#electResultImg${num}`).attr("src", BASE_URL + "assets/images/icon/no.png");
                }
            }
        });
   },
}
</script>
