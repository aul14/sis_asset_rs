<template>
  <div id="successPop" class="modal samrs-modal popup bounce fade" data-poptype="success">
    <div class="modal-dialog modal-dialog-centered modal-sm">
      <div class="modal-content">
        <div class="modal-header">
            <button class="btn btn-danger" type="button"
            data-dismiss="modal">×</button>
        </div>
        <div class="modal-body">
          <i class="fas fa-check-circle"></i>
          <span>Your data successfully updated</span>
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
