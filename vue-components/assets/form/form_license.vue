<template>
  <div class="row">
    <div class="col-xl-6">
      <!-- <div class="form-group row">
        <div class="col-xl-4">
          <label class="form-title">software name</label>
        </div>
        <div class="col-xl-8">
          <input class="form-control" readonly type="text" name="assetname_license" >
        </div>
      </div> -->
      <div class="form-group row">
        <div class="col-xl-4">
          <label class="form-title">license type</label>
        </div>
        <div class="col-xl-8">
          <select class="form-control" name="propAssetProplicence_licType">
            <option value="">Pilih Licence Type</option>
            <option value="LifeTime">LifeTime</option>
            <option value="Limited LifeTime">Limited LifeTime</option>
            <option value="Trial">Trial</option>
            <option value="Non-License">Non-License</option>
          </select>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-xl-4">
          <label class="form-title">license valid date</label>
        </div>
        <div class="col-xl-8">
          <input class="form-control" type="date" name="propAssetProplicence_licStart" >
        </div>
      </div>
      <div class="form-group row">
        <div class="col-xl-4">
          <label class="form-title">license expired date</label>
        </div>
        <div class="col-xl-8">
          <input class="form-control" type="date" name="propAssetProplicence_licEnd" >
        </div>
      </div>
    </div>
    <div class="col-xl-6">
      <div class="form-group row">
        <div class="col-xl-4">
          <label class="form-title">license key</label>
        </div>
        <div class="col-xl-8">
          <input class="form-control" type="text" name="propAssetProplicence_licKey" >
        </div>
      </div>
      <div class="form-group row">
        <div class="col-xl-4">
          <label class="form-title">software version</label>
        </div>
        <div class="col-xl-8">
          <input class="form-control" type="text" name="propAssetProplicence_version" >
        </div>
      </div>
    </div>
  </div>
</template>

<script>
// export default {
// }
</script>
