<template>
  <div class="p-1 border-top-1 border-light">
    <label class="form-title" samrs-typography="700">
      {{ listAlphabet }}. measuring equipment
    </label>
    <div class="float-right">
        <input class="samrs-switch" type="checkbox" data-toggle="toggle"
        data-size="small" data-on="On" data-off="Off" data-onstyle="success" data-offstyle="danger"
        value="on" collapse-target="#collapseMeasurement" id="switch-formalkur" name="tmpitemAlkur">
    </div>
    <div class="border-1 border-dark table-responsive collapse" id="collapseMeasurement">
      <table class="table samrs-tableview capitalize measuringTools mb-0">
        <thead>
          <th>assets name</th>
          <th>brand</th>
          <th>type</th>
          <th>serial number</th>
          <th>options</th>
        </thead>
        <tbody>
          <tr>
              <td>
                  <input type="hidden" name="idFpAlkur[]">
                  <input type="hidden" name="idAssetFormAlkur[]">
                  <input class="form-control w-100" type="text" name="assetNameFormAlkur[]" readonly>
              </td>
              <td><input class="form-control w-100" type="text" name="assetMerkFormAlkur[]" readonly></td>
              <td><input class="form-control w-100" type="text" name="assetTypeFormAlkur[]" readonly></td>
              <td><input class="form-control w-100" type="text" name="assetSNFormAlkur[]"  readonly></td>
              <td class="text-center"><button type="button" class="btn samrs-danger removeRowsTools"><i class="fas fa-times"></i> Remove</button></td>
          </tr>
        </tbody>
      </table>
        <button class="btn samrs-success" type="button" name="button" v-on:click="addrowtools"><i class="fas fa-plus"></i> Add Row</button>
    </div>
  </div>
</template>

<script>
module.exports = {
  props: {
    listAlphabet : {
      type : String,
      default: 'List_Unavailable',
    }
  },
  methods: {
    addrowtools: function(e){
      let rowHtml = `
      <tr>
          <td>
              <input type="hidden" name="idFpAlkur[]">
              <input type="hidden" name="idAssetFormAlkur[]">
              <input class="form-control w-100" type="text" name="assetNameFormAlkur[]" readonly>
          </td>
          <td><input class="form-control w-100" type="text" name="assetMerkFormAlkur[]" readonly></td>
          <td><input class="form-control w-100" type="text" name="assetTypeFormAlkur[]" readonly></td>
          <td><input class="form-control w-100" type="text" name="assetSNFormAlkur[]"  readonly></td>
          <td class="text-center"><button type="button" class="btn samrs-danger removeRowsTools"><i class="fas fa-times"></i> Remove</button></td>
      </tr>
      `;
      $('.measuringTools tbody').append(rowHtml);
      $('.removeRowsTools').on('click', function(){
        $(this).parents('tr').remove();
      });
    }
  },
  mounted(){
    $('.removeRowsTools').on('click', function(){
      $(this).parents('tr').remove();
    });
  }
}
</script>
