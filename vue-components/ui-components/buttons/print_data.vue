<template>
  <div class="grid-box">
    <a :href="'#'+modal" class="btn btn-block samrs-gray" data-toggle="modal"><i class="fas fa-print"></i> Print</a>
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
