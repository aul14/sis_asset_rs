<template>
  <div class="grid-box">
    <a href="javascript:void(0)"  :id="buttonId" class="btn btn-block samrs-green"><i class="fas fa-thumbs-up"></i> Approve</a>
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
      approve(this.$parent.tabledata[0]);
    })
  }
}
</script>
