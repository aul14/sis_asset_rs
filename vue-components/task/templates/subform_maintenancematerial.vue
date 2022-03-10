<template>
<div class="p-1 border-top-1 border-light table-responsive">
    <label class="form-title" samrs-typography="700">{{ listAlphabet }}. maintenace material</label>
    <div class="border-1 border-dark table-responsive">
        <table class="table samrs-tableview maintenaceMaterial capitalize mb-0">
            <thead>
                <th class="w-40">assets name</th>
                <th class="w-15">price</th>
                <th class="w-15">quantity</th>
                <th class="w-15">total price</th>
                <th id="th-option-material">options</th>
            </thead>
            <tbody>

            </tbody>
        </table>
        <button class="btn samrs-success" id="btn-option-material" type="button" name="button" v-on:click="addrowsmaterial"><i class="fas fa-plus"></i> Add Row</button>
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
        addrowsmaterial: function (e) {
            this.number++;
            let rowHtml = `
          <tr>
              <td>
                <input type="hidden" name="idAssetPart[${this.number}]" id="idAssetPart${this.number}">
                  <input class="form-control w-100" type="text" readonly name="partName[${this.number}]" id="partName${this.number}">
              </td>
              <td>
                  <input class="form-control w-100" type="text" readonly onkeypress="return hanyaAngka(event)" name="assetPriceMaintenanceMaterial[${this.number}]" id="assetPriceMaintenanceMaterial${this.number}">
              </td>
              <td>
                  <input class="form-control w-100 count-qty" data-num="${this.number}" type="text" onkeypress="return hanyaAngka(event)" name="partQTY[${this.number}]" id="partQTY${this.number}">
              </td>
              <td>
                  <input class="form-control w-100" type="text" onkeypress="return hanyaAngka(event)" name="partPrice[${this.number}]" id="partPrice${this.number}">
              </td>
              <td class="text-center">
                  <button type="button" class="btn samrs-primary pick-parts" id="${this.number}">Pick Asset</button>
                  <button type="button" class="btn samrs-danger removeRowsMaterial"><i class="fas fa-times"></i> Remove</button>
              </td>
          </tr>
      `;
            $('.maintenaceMaterial tbody').append(rowHtml);

            $('.removeRowsMaterial').on('click', function () {
                $(this).parents('tr').remove();
            });
        }
    },
    mounted() {
        $('.removeRowsMaterial').on('click', function () {
            $(this).parents('tr').remove();
        });

        let indexPick = 0;
        $(document).on("click", ".pick-parts", function () {
            indexPick = $(this).attr('id');
            $('#select_parts').modal('show');
            var TASKSYSCAT = $("input[name=taskSysCat]").val();
            SparepartList(TASKSYSCAT);
        });

        $(document).on("click", ".radioButtonParts", function () {
            // console.log('indexPick', indexPick)
            $(`#idAssetPart${indexPick}`).val($(this).val());
            // $('#assetCode').val(data.data.assetCode);
            $(`#partName${indexPick}`).val($(this).data('asset_name'));
            $(`#assetPriceMaintenanceMaterial${indexPick}`).val($(this).data('price'));

            $('#select_parts').modal('hide');
        });
        $(document).on("keyup", ".count-qty", function () {
            var num = $(this).data('num');
            var price = parseFloat($(`#assetPriceMaintenanceMaterial${num}`).val());
            var qty = parseFloat($(this).val() == '' ? 0 : $(this).val());

            var total = price * qty;
            $(`#partPrice${num}`).val(total)
        });

        function convertToRupiah(angka) {
            var rupiah = '';
            var angkarev = angka.toString().split('').reverse().join('');
            for (var i = 0; i < angkarev.length; i++)
                if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + ',';
            return rupiah.split('', rupiah.length - 1).reverse().join('');
            // return 'Rp. '+rupiah.split('',rupiah.length-1).reverse().join('');
        }
    }
}
</script>
