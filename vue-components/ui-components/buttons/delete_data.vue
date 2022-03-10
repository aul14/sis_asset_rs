<template>
  <div class="grid-box">
    <a href="javascript:void(0)" :id="buttonId" class="btn btn-block samrs-danger"><i class="fas fa-trash-alt"></i> Delete</a>
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
      hapus();
    })
  }
}
</script>
