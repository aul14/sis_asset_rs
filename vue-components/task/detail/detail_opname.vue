<template>
  <div class="p-10 table-responsive">
    <table class="table samrs-tableview td-first-title">
      <tr>
        <td>task name</td>
        <td colspan="4" id="detail-taskname"></td>
      </tr>
      <tr>
        <td>task description</td>
        <td colspan="4" id="detail-taskdesc"></td>
      </tr>
      <tr>
        <td class="w-10">schedule start</td>
        <td class="w-30" id="detail-start"></td>
        <td class="text-capitalize text-bold w-10">schedule end</td>
        <td class="w-30" id="detail-end"></td>
      </tr>
      <tr>
        <td class="w-10">task kpi</td>
        <td class="w-30" id="detail-kpi"></td>
        <td class="text-capitalize text-bold w-10">task amount</td>
        <td class="w-30" id="detail-amount"></td>
      </tr>
      <tr>
        <td>assets category</td>
        <td colspan="4">
          <ul class="samrs-list with-border-bottom w-50 list-asset-category">
            <!-- <li><a href="javascript:void(0)"><i class="fas fa-dot-circle"></i> List 1</a></li> -->
          </ul>
        </td>
      </tr>
      <tr>
        <td>assets location</td>
        <td colspan="4">
          <ul class="samrs-list with-border-bottom w-50 list-asset-lokasi">
            <!-- <li><a href="javascript:void(0)"><i class="fas fa-dot-circle"></i> List 1</a></li> -->
          </ul>
        </td>
      </tr>
    </table>
    <hr>
    <table class="table samrs-tableview capitalize">
      <thead>
        <th>#</th>
        <th>asset name</th>
        <th>label code</th>
        <th>scanned</th>
        <th>checked by</th>
        <th>checked date</th>
      </thead>
      <tbody class="tbody-opname-detail">
        <!-- <tr>
          <td>1</td>
          <td>assets_name</td>
          <td>123/123/123</td>
          <td class="text-center"><i class="fas fa-check-circle text-success"></i></td>
          <td>examiner_name</td>
          <td>date_time</td>
        </tr>
        <tr>
          <td>1</td>
          <td>assets_name</td>
          <td>123/123/123</td>
          <td class="text-center"><i class="fas fa-times-circle text-danger"></i></td>
          <td>examiner_name</td>
          <td>date_time</td>
        </tr> -->
      </tbody>
    </table>
  </div>
</template>

<script>
// export default {
// }
</script>
