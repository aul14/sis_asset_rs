<div id="complain_repair_details" class="modal samrs-modal zoom fade" data-backdrop="static" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <p>complain & repair detail</p>
        <a href="javascript:void(0)" onclick="return clickback()" class="btn btn-rounded btn-outline-danger" class="close" aria-hidden="true">×</a>
      </div>
      <div class="modal-body p-1" id="app_detail">
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
              <detail-general></detail-general>
            </div>
            <!-- <div class="tab-pane fade" role="tabpanel" id="history_details">
              <detail-history></detail-history>
            </div> -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  function clickback() {

    document.location.href = window.location.origin + window.location.pathname;
  }
</script>