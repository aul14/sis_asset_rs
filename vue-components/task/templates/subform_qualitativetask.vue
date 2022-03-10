<template>
  <div class="p-1 border-top-1 border-light">
    <label class="form-title" samrs-typography="700">{{ listAlphabet }}. Examination of the physical condition and function of the tool (qualitative tasks)</label>
    <div class="border-1 border-dark table-responsive" id="table-qualitativetask">
      <table class="table samrs-tableview qualitativeTask capitalize mb-0">
        <thead>
          <th class="w-85">description</th>
          <th class="w-5">p</th>
          <th class="w-5">f</th>
          <th class="w-5">na</th>
        </thead>
        <tbody>
          <td>
              <input type="hidden" name="idFisfung[0]" id="idFisfung0">
              <input class="form-control w-100" type="text" name="fisfungItem[0]" id="fisfungItem0" readonly>
          </td>
          <td>
            <div class="radio-only-box">
              <input type="radio" name="fisfungResult[0]" id="fisfungResult0P" value="P">
            </div>
          </td>
          <td>
            <div class="radio-only-box">
              <input type="radio" name="fisfungResult[0]" id="fisfungResult0F" value="F">
            </div>
          </td>
          <td>
            <div class="radio-only-box">
              <input type="radio" name="fisfungResult[0]" id="fisfungResult0NA" value="NA">
            </div>
          </td>
        </tbody>
      </table>
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

}
</script>
