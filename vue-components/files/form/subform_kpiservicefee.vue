<template>
  <div class="p-1 border-top-1 border-light table-responsive">
    <label class="form-title" samrs-typography="700">{{ listAlphabet }}. maintenance kpi point & service fee</label>
    <div class="float-right">
        <input class="samrs-switch" type="checkbox" data-toggle="toggle"
        data-size="small" data-on="On" data-off="Off" data-onstyle="success" data-offstyle="danger"
        value="On" collapse-target="#collapseKPI">
    </div>
    <div class="border-1 border-dark table-responsive collapse" id="collapseKPI">
      <table class="table samrs-tableview capitalize mb-0">
        <tbody>
          <tr>
            <td>
              KPI Point
            </td>
            <td>
              <input class="form-control w-100" type="text" name="" >
            </td>
          </tr>
          <tr>
            <td>
              Service Fee
            </td>
            <td>
              <input class="form-control w-100" type="text" name="" >
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
