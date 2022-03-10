<template>
  <div class="p-1 border-top-1 border-light">
    <label class="form-title" samrs-typography="700">{{ listAlphabet }}. Examination of the physical condition and function of the tool (qualitative tasks)</label>
    <div class="float-right">
        <input class="samrs-switch" type="checkbox" data-toggle="toggle"
        data-size="small" data-on="On" data-off="Off" data-onstyle="success" data-offstyle="danger"
        value="On" collapse-target="#collapseQualitative" id="switch-formgen" name="tmpitemFisfung">
    </div>
    <div class="border-1 border-dark table-responsive collapse" id="collapseQualitative">
      <table class="table samrs-tableview qualitativeTask capitalize mb-0">
        <thead>
          <th class="w-85">description</th>
          <th class="w-5">p</th>
          <th class="w-5">f</th>
          <th class="w-5">na</th>
          <th>options</th>
        </thead>
        <tbody>
          <td>
              <input type="hidden" name="idFisfung[]" id="idFisfung0">
              <input class="form-control w-100" with-state="qualitativeField" type="text" name="fisfungItem[]" id="fisfungItem0">
          </td>
          <td>
            <div class="radio-only-box">
              <input type="radio" name="radio"  disabled>
            </div>
          </td>
          <td>
            <div class="radio-only-box">
              <input type="radio" name="radio"  disabled>
            </div>
          </td>
          <td>
            <div class="radio-only-box">
              <input type="radio" name="radio"  disabled>
            </div>
          </td>
          <td class="text-center"><button type="button" class="btn samrs-danger removeRowsQualitative"><i class="fas fa-times"></i> Remove</button></td>
        </tbody>
      </table>
        <button class="btn samrs-success" type="button" name="button" v-on:click="addrowqualitative"><i class="fas fa-plus"></i> Add Row</button>
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
    addrowqualitative: function(e){
      let rowHtml = `
      <tr>
        <td>
            <input type="hidden" name="idFisfung[]">
            <input class="form-control w-100" with-state="qualitativeField" type="text" name="fisfungItem[]" required>
        </td>
        <td>
          <div class="radio-only-box">
            <input type="radio" name="radio"  disabled>
          </div>
        </td>
        <td>
          <div class="radio-only-box">
            <input type="radio" name="radio"  disabled>
          </div>
        </td>
        <td>
          <div class="radio-only-box">
            <input type="radio" name="radio"  disabled>
          </div>
        </td>
        <td class="text-center"><button type="button" class="btn samrs-danger removeRowsQualitative"><i class="fas fa-times"></i> Remove</button></td>
      </tr>
      `;
      $('.qualitativeTask tbody').append(rowHtml);
      $('.removeRowsQualitative').on('click', function(){
        $(this).parents('tr').remove();
      });
    }
  },
  mounted(){
    $('.removeRowsQualitative').on('click', function(){
      $(this).parents('tr').remove();
    });
    $('.samrs-switch[collapse-target="#collapseQualitative"]').each(function() {
      $(this).change(function(){
        if ($(this).prop('checked') === true) {
          $('.form-control[with-state="qualitativeField"]').each(function() {
            $(this).attr('required',true)
          });
        }else {
          $('.form-control[with-state="qualitativeField"]').each(function() {
            $(this).removeAttr('required');
          });
        }
      });
      if ($(this).prop('checked') === true) {
        $('.form-control[with-state="qualitativeField"]').each(function() {
          $(this).attr('required',true)
        });
      }else {
        $('.form-control[with-state="qualitativeField"]').each(function() {
          $(this).removeAttr('required');
        });
      }
    });
  }
}
</script>
