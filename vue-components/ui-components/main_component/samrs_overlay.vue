<template>
  <div class="samrs-overlay off" :id="overlayId" :data-static="isStatic">
    <div class="header">
      <div class="title">
        <p>{{ title }}</p>
      </div>
      <div class="close-div">
          <button class="btn btn-rounded close-btn btn-outline-danger" type="button" data-dismiss="samrs-overlay">x</button>
      </div>
    </div>
    <div class="content">
      <slot name="overlay-content"></slot>
    </div>
    <div class="footer">
      <slot name="overlay-footer"></slot>
    </div>
  </div>
</template>

<script>
module.exports = {
  props: {
    overlayId:{
      type : String,
    },
    title: {
      type: String,
      default: 'Overlay title not available',
    },
    isStatic:{
      type:String,
      default:"true",
    }
  },
  mounted(){
    SamrsOverlay();
  }
}
</script>
