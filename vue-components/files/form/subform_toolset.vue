<template>
  <div class="p-1 border-top-1 border-light">
    <label class="form-title" samrs-typography="700">{{ listAlphabet }}. toolset usage</label>
    <div class="float-right">
        <input class="samrs-switch" type="checkbox" data-toggle="toggle"
        data-size="small" data-on="On" data-off="Off" data-onstyle="success" data-offstyle="danger"
        value="on" collapse-target="#collapseToolset" id="switch-formtools" name="tmpitemTools">
    </div>
    <div class="border-1 border-dark table-responsive collapse" id="collapseToolset">
      <table class="table samrs-tableview capitalize toolsetUsage mb-0">
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
                  <input class="form-control w-100" type="hidden" name="idFpTools[]">
                  <input class="form-control w-100" type="hidden" name="idAssetFormTools[]">
                  <input class="form-control w-100" type="text" name="assetNameFormTools[]" readonly>
              </td>
              <td><input class="form-control w-100" type="text" name="assetMerkFormTools[]" readonly></td>
              <td><input class="form-control w-100" type="text" name="assetTypeFormTools[]" readonly></td>
              <td><input class="form-control w-100" type="text" name="assetSNFormTools[]" readonly></td>
              <td class="text-center"><button type="button" class="btn samrs-danger removeRowsToolset"><i class="fas fa-times"></i> Remove</button></td>
          </tr>
        </tbody>
      </table>
        <button class="btn samrs-success" type="button" name="button" v-on:click="addrowtoolset"><i class="fas fa-plus"></i> Add Row</button>
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
    addrowtoolset: function(e){
      let rowHtml = `
      <tr>
        <td>
            <input class="form-control w-100" type="hidden" name="idFpTools[]">
            <input class="form-control w-100" type="hidden" name="idAssetFormTools[]">
            <input class="form-control w-100" type="text" name="assetNameFormTools[]" readonly>
        </td>
        <td><input class="form-control w-100" type="text" name="assetMerkFormTools[]" readonly></td>
        <td><input class="form-control w-100" type="text" name="assetTypeFormTools[]" readonly></td>
        <td><input class="form-control w-100" type="text" name="assetSNFormTools[]" readonly></td>
        <td class="text-center"><button type="button" class="btn samrs-danger removeRowsToolset"><i class="fas fa-times"></i> Remove</button></td>
      </tr>
      `;
      $('.toolsetUsage tbody').append(rowHtml);
      $('.removeRowsToolset').on('click', function(){
        $(this).parents('tr').remove();
      });
    }
  },
  mounted(){
    $('.removeRowsToolset').on('click', function(){
      $(this).parents('tr').remove();
    });
  }
}
</script>
