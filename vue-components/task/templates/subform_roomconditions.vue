<template>
  <div class="p-1 border-top-1 border-light">
    <label class="form-title" samrs-typography="700">{{ listAlphabet }}. rooms conditions</label>
    <div class="table-responsive" id="table-rooms">
      <input type="hidden" name="idFpEncon" value="">
      <table class="table samrs-tableview capitalize">
        <thead>
          <th class="w-75">parameters</th>
          <th class="w-50">measurable</th>
        </thead>
        <tbody>
          <tr>
              <td>Temperature</td>
              <td>
                <div class="d-flex">
                  <input type="hidden" name="idFpEncon" id="idFpEncon">
                  <input class="form-control w-80" type="text" name="tempStartFormEncon">
                  <span>&deg;C</span>
                </div>
              </td>
          </tr>
          <tr>
              <td>Relative Humidity</td>
              <td>
                <div class="d-flex">
                  <input class="form-control w-80" type="text" name="humidityStartFormEncon"/>
                  <span>%</span>
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
  props: {
    listAlphabet : {
      type : String,
      default: 'List_Unavailable',
    }
  }
}
</script>
