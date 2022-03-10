<template>
  <section class="page-content full container-fluid" :is-fixed="isFixed()">
    <slot></slot>
  </section>
</template>
<script>
module.exports={
  props:{
    fixedHeight:{
      type:String,
      default:'no'
    }
  },
  methods:{
    isFixed(){
      let propsData = this.fixedHeight;
      if (propsData.toUpperCase() === 'YES') {
        return 'yes'
      }else {
        return 'no'
      }
    }
  },
  mounted(){
  }
}
</script>
