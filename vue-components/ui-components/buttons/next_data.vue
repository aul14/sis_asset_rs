<template>
  <div class="grid-box">
    <a class="btn btn-block samrs-primary" :href="link" name="button" :form="dataForm">
      <small>Next Month <i class="fas fa-forward"></i></small>
    </a>
  </div>
</template>

<script>
module.exports = {
  props : {
    link:{
      type: String,
      default: 'javascript:void(0)',
    },
    dataForm:{
      type:String
    }
  },

}
</script>
