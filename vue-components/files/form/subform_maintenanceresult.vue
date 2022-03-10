<template>
  <div class="p-1 border-top-1 border-light">
    <label class="form-title" samrs-typography="700">maintenance result</label>
    <div class="table-responsive">
      <table class="table samrs-tableview">
        <tr>
            <td class="text-center"><input type="radio" name="" id="" disabled> </td>
            <td>Good</td>
        </tr>
        <tr>
            <td class="text-center"><input type="radio" name="" id="" disabled> </td>
            <td>Lightly Damage</td>
        </tr>
        <tr>
            <td class="text-center"><input type="radio" name="" id="" disabled> </td>
            <td>Heavy Damage</td>
        </tr>
        <tr>
            <td class="text-center"><input type="radio" name="" id="" disabled> </td>
            <td>Unexposed</td>
        </tr>
        <tr>
            <td class="text-center">Note</td>
            <td>
                <textarea class="form-control" name="note" readonly></textarea>
            </td>
        </tr>
      </table>
    </div>
  </div>
</template>

<script>
// module.exports = {
//   props: {
//     listAlphabet : {
//       type : String,
//       default: 'List_Unavailable',
//     }
//   },
// }
</script>
