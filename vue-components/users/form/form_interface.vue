<template>
  <div class="p-10">
    <div class="fixed-box samrs-form">
      <div class="form-group">
        <label class="form-title">interface position</label>
        <div class="m-10">
          <div class="form-check-inline form-check">
            <label class="form-check-label">
              <input type="radio" name="position" value="" checked>
              <img class="app-icon" :src="base_url()+'assets/images/app-icon/LTR.png'" alt="">
              <br>
              <span class="break-word">Left</span>
            </label>
          </div>
          <div class="form-check-inline form-check">
            <label class="form-check-label">
              <input type="radio" name="position" value="">
              <img class="app-icon" :src="base_url()+'assets/images/app-icon/RTL.png'" alt="">
              <br>
              <span class="break-word">Right</span>
            </label>
          </div>
        </div>
      </div>
    </div>
    <div class="form-group">
      <button class="btn samrs-primary" type="button" name="button">Save</button>
    </div>
  </div>
</template>

<script>
module.exports={
  methods:{
    base_url(){
      return BASE_URL;
    }
  }
}
</script>
