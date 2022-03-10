<div id="complain_repair_approve" class="modal samrs-modal zoom fade" data-backdrop="static" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <p>approve</p>
        <a href="javascript:void(0)" onclick="return clickback()" class="btn btn-rounded btn-outline-danger" class="close" aria-hidden="true">×</a>
      </div>
      <div class="modal-body p-1" id="app_approve">
        <div class="samrs-tab blue">
          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link active" href="#general_details" data-toggle="tab">general</a>
            </li>
            <!-- <li>
              <a class="nav-link" href="#history_details" data-toggle="tab">history</a>
            </li> -->
          </ul>
          <div class="tab-content fixed-height">
            <div class="tab-pane fade show active" role="tabpanel" id="general_details">
              <approve-general></approve-general>
            </div>
            <!-- <div class="tab-pane fade" role="tabpanel" id="history_details">
              <approve-history></approve-history>
            </div> -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="add_signature" class="modal samrs-modal bounce fade">
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <p>Add signature</p>
        <button class="btn btn-rounded btn-outline-danger" type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body">
        <div class="drawing-box" id="signatureDrawpad">
          <canvas width="300" height="290"></canvas>
        </div>
      </div>
      <div class="modal-footer">
        <div class="mr-10 ml-10">
          <button class="btn samrs-primary" data-action="save-img" type="button" name="button">Save & Exit</button>
          <button class="btn samrs-danger" data-action="clear" type="button" name="button">Clear</button>
        </div>
        <a class="btn samrs-danger is-outline" href="#" data-dismiss="modal">Cancel</a>
      </div>
    </div>
  </div>
</div>
<script>
  function clickback() {

    document.location.href = window.location.origin + window.location.pathname;
  }
</script>