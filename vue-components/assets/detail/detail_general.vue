<template>
  <div class="p-10">
    <div class="samrs-detail-box">
      <label class="detail-title">equipment profile</label>
      <div class="row">
        <fieldset class="col-xl-6">
          <table class="samrs-tableview td-first-title">
            <tbody>
              <tr>
                <td>asset code</td>
                <td>:</td>
                <td class="td-asset-code"></td>
              </tr>
              <tr>
                <td>asset name</td>
                <td>:</td>
                <td class="td-asset-name"></td>
              </tr>
              <tr>
                <td>brand</td>
                <td>:</td>
                <td class="td-asset-brand"></td>
              </tr>
              <tr>
                <td>type</td>
                <td>:</td>
                <td class="td-asset-tipe"></td>
              </tr>
              <tr>
                <td>serial number</td>
                <td>:</td>
                <td class="td-asset-sn"></td>
              </tr>
              <tr>
                <td>asset category</td>
                <td>:</td>
                <td class="td-asset-category"></td>
              </tr>
            </tbody>
          </table>
        </fieldset>
        <fieldset class="col-xl-6">
          <table class="samrs-tableview td-first-title">
            <tbody>
              <tr>
                <td>location</td>
                <td>:</td>
                <td class="td-asset-lokasi"></td>
              </tr>
              <tr>
                <td>condition</td>
                <td>:</td>
                <td class="td-asset-kondisi"></td>
              </tr>
              <tr>
                <td>supplier name</td>
                <td>:</td>
                <td class="td-asset-supplier"></td>
              </tr>
            </tbody>
          </table>
        </fieldset>
      </div>
    </div>
    <div class="samrs-detail-box mt-20">
      <label class="detail-title">documents information</label>
      <div class="row">
        <fieldset class="col-xl-6">
          <table class="samrs-tableview td-first-title">
            <tbody>
              <tr>
                <td>warranty expire</td>
                <td>:</td>
                <td class="td-asset-warranty"></td>
              </tr>
              <tr>
                <td>ownership</td>
                <td>:</td>
                <td class="td-asset-ownership"></td>
              </tr>
              <tr>
                <td>voltage input/output</td>
                <td>:</td>
                <td class="td-asset-voltage"></td>
              </tr>
              <tr>
                <td>last update</td>
                <td>:</td>
                <td class="td-asset-update"></td>
              </tr>
            </tbody>
          </table>
        </fieldset>
        <fieldset class="col-xl-6">
          <table class="samrs-tableview td-first-title">
            <tbody>
              <tr>
                <td>accumulation value</td>
                <td>:</td>
                <td class="td-asset-accuval"></td>
              </tr>
              <tr>
                <td>Book Value</td>
                <td>:</td>
                <td class="td-asset-bookval"></td>
              </tr>
            </tbody>
          </table>
        </fieldset>
      </div>
    </div>
  </div>
</template>

<script>
// export default {
// }
</script>
<style scoped>
.td-asset-name{
  word-break: break-all;
  white-space: nowrap;
}
</style>