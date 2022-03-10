<template>
  <div :id="popId" class="modal samrs-modal popup bounce fade" data-poptype="danger">
    <div class="modal-dialog modal-dialog-centered modal-sm">
      <div class="modal-content">
        <div class="modal-header">
            <button class="btn btn-danger" type="button"
            data-dismiss="modal">×</button>
        </div>
        <div class="modal-body">
          <i class="fas fa-times-circle"></i>
          <span>
          {{ popupText }}
          </span>
        </div>
        <div class="modal-footer justify-content-between">
          <div class="p-1">
            <button class="btn btn-block samrs-success" type="button" name="button" @click="yesClick()">Yes</button>
          </div>
          <div class="p-1">
            <button class="btn btn-block btn-light" type="button" data-dismiss="modal">No</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
module.exports = {
  props:{
    popupText:{
      type:String,
      default:'NO_TEXT'
    },
    popId:{
      type:String,
      default:'#no_id'
    },
    yes:{
      type:Function
    }
  },
  methods:{
    yesClick(){
      this.$emit('yes');
    }
  },
  mounted(){
    SamrsModal();
  }
}
</script>
