<template>
  <div class="grid-box">
    <button class="btn btn-block samrs-warning" :data-target="'#'+overlay" data-toggle="samrs-overlay">
      <small><i class="fas fa-search"></i > Advanced Search</small></button>
  </div>
</template>

<script>
module.exports = {
  props : {
    overlay:{
      type: String,
      default: '',
    }
  },
  mounted(){
    SamrsOverlay();
  }
}
</script>
