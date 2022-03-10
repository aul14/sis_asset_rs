<template>
  <div class="p-1 border-top-1 border-light table-responsive">
    <label class="form-title" samrs-typography="700">{{ listAlphabet }}. maintenace material</label>
    <div class="float-right">
        <input class="samrs-switch" type="checkbox" data-toggle="toggle"
        data-size="small" data-on="On" data-off="Off" data-onstyle="success" data-offstyle="danger"
        value="On" collapse-target="#collapseMaterial">
    </div>
    <div class="border-1 border-dark table-responsive collapse" id="collapseMaterial">
      <table class="table samrs-tableview maintenaceMaterial capitalize mb-0">
        <thead>
          <th class="w-40">assets name</th>
          <th class="w-15">price</th>
          <th class="w-15">quantity</th>
          <th class="w-15">total price</th>
          <th>options</th>
        </thead>
        <tbody>
          <tr>
            <td>
              <input class="form-control w-100" type="text" name="" value="">
            </td>
            <td>
              <input class="form-control w-100" type="text" onkeypress="return hanyaAngka(event)" name="" value="">
            </td>
            <td>
              <input class="form-control w-100" type="text" onkeypress="return hanyaAngka(event)" name="" value="">
            </td>
            <td>
              <input class="form-control w-100" type="text" onkeypress="return hanyaAngka(event)" name="" value="">
            </td>
            <td class="text-center">
              <button type="button" class="btn samrs-primary" v-on:click="selectassets">Pick Asset</button>
              <button type="button" class="btn samrs-danger removeRowsMaterial"><i class="fas fa-times"></i> Remove</button>
            </td>
          </tr>
        </tbody>
      </table>
        <button class="btn samrs-success" type="button" name="button" v-on:click="addrowsmaterial"><i class="fas fa-plus"></i> Add Row</button>
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
    selectassets: function(){
      $('#select_assets').modal('show');
    },
    addrowsmaterial: function(e){
      let rowHtml = `
      <tr>
        <td>
          <input class="form-control w-100" type="text" name="" value="">
        </td>
        <td>
          <input class="form-control w-100" type="text" onkeypress="return hanyaAngka(event)" name="" value="">
        </td>
        <td>
          <input class="form-control w-100" type="text" onkeypress="return hanyaAngka(event)" name="" value="">
        </td>
        <td>
          <input class="form-control w-100" type="text" onkeypress="return hanyaAngka(event)" name="" value="">
        </td>
        <td class="text-center">
          <button type="button" class="btn samrs-primary pickModal">Pick Asset</button>
          <button type="button" class="btn samrs-danger removeRowsMaterial"><i class="fas fa-times"></i> Remove</button>
        </td>
      </tr>
      `;
      $('.maintenaceMaterial tbody').append(rowHtml);
      $('.pickModal').click(function(){
        $('#select_assets').modal('show');
      });
      $('.removeRowsMaterial').on('click', function(){
        $(this).parents('tr').remove();
      });
    }
  },
  mounted(){
    $('.removeRowsMaterial').on('click', function(){
      $(this).parents('tr').remove();
    });
  }
}
</script>
