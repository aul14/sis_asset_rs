<template>
  <div id="warningPop" class="modal samrs-modal popup bounce fade" data-poptype="warning">
    <div class="modal-dialog modal-dialog-centered modal-sm">
      <div class="modal-content">
        <div class="modal-header">
            <button class="btn btn-danger" type="button"
            data-dismiss="modal">×</button>
        </div>
        <div class="modal-body">
          <i class="fas fa-exclamation-circle"></i>
          <span>Please select the data</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
module.exports = {
  mounted(){
    // SamrsModal();
  }
}
</script>
