<template >
  <div class="grid-box">
    <a :href="'#'+modal" data-toggle="modal" class="btn btn-block samrs-primary"><i class="fas fa-plus"></i> Add new</a>
  </div>
</template>

<script>
module.exports = {
  props : {
    modal:{
      type: String,
      default: '',
    },
  },
  
}
</script>
