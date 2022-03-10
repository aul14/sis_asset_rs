<div id="assets_details" class="modal samrs-modal zoom fade" data-backdrop="static" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <p>assets detail</p>
        <a href="" class="btn btn-rounded btn-outline-danger" class="close" aria-hidden="true">×</a>
      </div>
      <div class="modal-body p-1 row" id="app_detail">
        <div class="col-xl-9 pr-1">
          <div class="samrs-tab blue">
            <ul class="nav nav-tabs">
              <li class="nav-item">
                <a class="nav-link active" href="#general_details" data-toggle="tab">general info</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#accesories_details" data-toggle="tab" id="tab-acc-details">accesories</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#documents_details" data-toggle="tab">document</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#task_details" data-toggle="tab">task</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#depreciation_1_details" data-toggle="tab">depreciation 1</a>
              </li>
            </ul>
            <div class="tab-content fixed-height">

              <div class="tab-pane fade show active" role="tabpanel" id="general_details">
                <detail-general></detail-general>
              </div>
              <div class="tab-pane fade" role="tabpanel" id="accesories_details">
                <detail-accesories></detail-accesories>
              </div>
              <div class="tab-pane fade" role="tabpanel" id="documents_details">
                <detail-document></detail-document>
              </div>
              <div class="tab-pane fade" role="tabpanel" id="task_details">
                <!-- nested tab -->
                <div class="samrs-tab blue">
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" href="#calibration_details" data-toggle="tab">calibration</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#maintenance_details" data-toggle="tab">maintenance</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#inspection_details" data-toggle="tab">inspection</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#complainrepair_details" data-toggle="tab">complain & repair</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#mutation_details" data-toggle="tab">mutation</a>
                    </li>
                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane fade show active" role="tabpanel" id="calibration_details">
                      <detail-task-calibration></detail-task-calibration>
                    </div>
                    <div class="tab-pane fade" role="tabpanel" id="maintenance_details">
                      <detail-task-maintenance></detail-task-maintenance>
                    </div>
                    <div class="tab-pane fade" role="tabpanel" id="inspection_details">
                      <detail-task-inspection></detail-task-inspection>
                    </div>
                    <div class="tab-pane fade" role="tabpanel" id="complainrepair_details">
                      <detail-task-compainrepair></detail-task-compainrepair>
                    </div>
                    <div class="tab-pane fade" role="tabpanel" id="mutation_details">
                      <detail-task-mutation></detail-task-mutation>
                    </div>
                  </div>
                </div>

              </div>
              <div class="tab-pane fade" role="tabpanel" id="depreciation_1_details">
                <detail-depreciation-1></detail-depreciation-1>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3">
          <div class="samrs-tab red">
            <ul class="nav nav-tabs">
              <li class="nav-item">
                <a class="nav-link active" href="#picture_details" data-toggle="tab">picture</a>
              </li>
            </ul>
            <div class="tab-content fixed-height">
              <div class="tab-pane fade show active" role="tabpanel" id="picture_details">
                <detail-picture></detail-picture>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>