<template>
  <div class="grid-box">
    <a href="javascript:void(0)" :id="buttonId" class="btn btn-block samrs-dark"><i class="fas fa-qrcode"></i> Print QR</a>
  </div>
</template>

<script>
module.exports = {
  props : {
      buttonId:{
        type:String,
        default:"not_unique"
      },
      text:{
        type: String,
        default: 'Edit',
      },
  },
  mounted(){
    this.$nextTick(function(){
      qr_code();
    })
  }
}
</script>
