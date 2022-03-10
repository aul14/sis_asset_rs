<form id="signature" action="<?= base_url('task/stock_opname/report/'); ?>" target="_blank" method="POST">
  <div id="task_print" class="modal samrs-modal zoom fade" data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg ">
      <div class="modal-content">
        <div class="modal-header">
          <p>printout report</p>
          <button class="btn btn-rounded btn-outline-danger" type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body" id="app_print">
          <!-- <print-task></print-task> -->
          <input type="hidden" name="idTaskPrint">
          <table class="table samrs-tableview td-first-title signatureColumn">
            <tbody>
              <tr>
                <td>
                  <div class="mt-10">
                    TASK OPNAME
                  </div>
                </td>
                <td>:</td>
                <td>
                  <label class="p-0 float-right">
                    <input class="samrs-switch" type="checkbox" id="radio1" name="jenis" value="summary" checked data-toggle="toggle" data-size="small" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">
                  </label>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <div class="mr-10 ml-10">
            <button class="btn wrap samrs-primary" type="submit" value="pdf" name="button_pdf">
              <i class="fas fa-print"></i> Print Report</button>
            <!-- <button class="btn wrap samrs-danger" type="button" name="button">
            <i class="fas fa-file-pdf"></i> Print Report as PDF</button> -->
            <button class="btn wrap samrs-success" type="submit" value="excell" name="button_excel">
              <i class="fas fa-file-excel"></i>
              Print Report as Excel</button>
          </div>
          <a class="btn samrs-danger is-outline" href="#" data-dismiss="modal">Cancel</a>
        </div>
      </div>
    </div>
  </div>
</form>