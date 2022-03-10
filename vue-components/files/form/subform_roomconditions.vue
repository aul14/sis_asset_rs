<template>
  <div class="p-1 border-top-1 border-light">
    <label class="form-title" samrs-typography="700">{{ listAlphabet }}. rooms conditions</label>
    <div class="float-right">
        <input class="samrs-switch" type="checkbox" data-toggle="toggle"
        data-size="small" data-on="On" data-off="Off" data-onstyle="success" data-offstyle="danger"
        value="on" collapse-target="#collapseRooms" id="switch-formencon" name="tmpitemEncon">
    </div>
    <div class="table-responsive collapse" id="collapseRooms">
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
                  <input class="form-control w-80" type="text" name="tempStartFormEncon" readonly>
                  <span>&deg;C</span>
                </div>
              </td>
          </tr>
          <tr>
              <td>Relative Humidity</td>
              <td>
                <div class="d-flex">
                  <input class="form-control w-80" type="text" name="humidityStartFormEncon" readonly/>
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
