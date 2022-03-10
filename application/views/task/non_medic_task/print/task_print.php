<div id="task_print" class="modal samrs-modal zoom fade" data-backdrop="static" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-lg ">
    <div class="modal-content">
      <div class="modal-header">
        <p>printout report</p>
        <button class="btn btn-rounded btn-outline-danger" type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body" id="app_print">
        <print-task></print-task>
      </div>
      <div class="modal-footer">
        <div class="mr-10 ml-10">
          <button class="btn wrap samrs-primary" type="button" name="button">
            <i class="fas fa-print"></i> Print Report</button>
          <button class="btn wrap samrs-danger" type="button" name="button">
            <i class="fas fa-file-pdf"></i> Print Report as PDF</button>
          <button class="btn wrap samrs-success" type="button" name="button">
            <i class="fas fa-file-excel"></i>
            Print Report as Excel</button>
        </div>
        <a class="btn samrs-danger is-outline" href="#" data-dismiss="modal">Cancel</a>
      </div>
    </div>
  </div>
</div>
