<template>
<div class="p-1 border-top-1 border-light">
    <label class="form-title" samrs-typography="700">{{titleResult}} result</label>
    <div class="table-responsive">
        <table class="table samrs-tableview">
            <tr>
                <input type="hidden" name="idTaskFile">
                <input type="hidden" name="idFile">
                <input type="hidden" name="fileDesc">
                <td class="text-center"><input type="radio" name="finalResult" id="finalResultBaik" value="Baik"> </td>
                <td>Good</td>
            </tr>
            <tr>
                <td class="text-center"><input type="radio" name="finalResult" id="finalResultRingan" value="Rusak Ringan"> </td>
                <td>Lightly Damage</td>
            </tr>
            <tr>
                <td class="text-center"><input type="radio" name="finalResult" id="finalResultBerat" value="Rusak Berat"> </td>
                <td>Heavy Damage</td>
            </tr>
            <!-- <tr>
                <td class="text-center"><input type="radio" name="finalResult" id="finalResultNot" value="Tidak Ditemukan"> </td>
                <td>Unexposed</td>
            </tr> -->
            <tr>
                <td class="text-center">Note</td>
                <td>
                    <textarea class="form-control" name="maintenanceNote" id="maintenanceNote"></textarea>
                </td>
            </tr>
            <tr id="td-result-worksheet">
                <td class="text-center">Worksheet</td>
                <td>
                    <input type="file" name="file_maintenance_result">
                </td>
            </tr>
        </table>
    </div>
</div>
</template>

<script>
module.exports = {
  props: {
    titleResult : {
      type : String,
      default: 'Result_Unavailable',
    }
  },
}
</script>
