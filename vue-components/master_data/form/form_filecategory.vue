<template>
  <div class="p-10">
    <p class="mandatory-info">
        Field marked <span>*</span> is required to fill or mandatory
    </p>
    <div class="form-group row">
      <div class="col-xl-4">
        <label class="form-title">file category name <span>*</span></label>
      </div>
      <div class="col-xl-8">
          <input id="formType" name="formType" type="hidden" value="add">
          <input id="idFileCat" name="idFileCat" type="hidden">

          <input class="form-control" id="fileCatName"
              name="fileCatName" required type="text">
      </div>
    </div>
    <div class="form-group row">
      <div class="col-xl-4">
        <label class="form-title">description <span>*</span></label>
      </div>
      <div class="col-xl-8">
        <input class="form-control" id="fileCatDesc"
              name="fileCatDesc" required="" type="text">
      </div>
    </div>
    <div class="form-group row">
      <div class="col-xl-4">
        <label class="form-title">type</label>
      </div>
      <div class="col-xl-8">
        <select name="fileCatType" id="fileCatType" class="form-control">
            <option value="INVENTORY">Inventory</option>
            <option value="TASK">Task</option>
            <option value="PROFILE">Profile</option>
        </select>
      </div>
    </div>
  </div>
</template>

<script>
// export default {
// }
</script>
