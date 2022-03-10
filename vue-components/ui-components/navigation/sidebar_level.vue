<template>
    <ul :class="'collapse '+dropdownLevel">
      <slot name="link"></slot>
    </ul>
</template>
<script>
  module.exports = {
    props: {
      dropdownLevel:{
        type:String,
        default:'',
      }
    }
  }
</script>
