<template>
  <div class="p-1">
    <label class="form-title">input data for simak reports</label>
    <div class="form-group row">
      <div class="col-4">
        <label class="form-title">simak code</label>
      </div>
      <div class="col-8">
        <input class="form-control" type="text" readonly name="propAssetPropsimak_simakCode_not" id="propAssetPropsimak_simakCode" >
        
      </div>
    </div>
    <div class="form-group row">
      <div class="col-4">
        <label class="form-title">nup</label>
      </div>
      <div class="col-8">
       <input type="text" onkeypress="return hanyaAngka(event)" class="form-control" name="propAssetPropsimak_nup_simak_not" id="propAssetPropsimak_nup_simak" >
      </div>
    </div>
  </div>
</template>

<script>
// export default {
// }
</script>
