<template>
  <div class="p-10">
    <div class="form-group row">
      <div class="col-xl-4">
        <label class="form-title">fund name</label>
      </div>
      <div class="col-xl-8">
        <input id="formType" name="formType" type="hidden"
            value="add">
        <input id="idFund" name="idFund" type="hidden">
     
            <input class="form-control" id="fundName" name="fundName" required type="text">
      </div>
    </div>
    <div class="form-group row">
      <div class="col-xl-4">
        <label class="form-title">fund description</label>
      </div>
      <div class="col-xl-8">
        <input class="form-control" id="fundDesc" name="fundDesc" type="text">
      </div>
    </div>
  </div>
</template>

<script>
// export default {
// }
</script>
