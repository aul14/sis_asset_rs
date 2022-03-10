<form id="signature" action="<?= base_url('asset/me/sparepart_med/report/'); ?>" target="_blank" method="POST">
  <div id="assets_print" class="modal samrs-modal zoom fade" data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg ">
      <div class="modal-content">
        <div class="modal-header">
          <p>printout report</p>
          <button class="btn btn-rounded btn-outline-danger" type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body" id="app_print">
          <input type="hidden" name="q1" id="q1" value="<?= empty($this->input->get('q1')) ? "" : $this->input->get('q1') ?>">
          <input type="hidden" name="v1" id="v1" value="<?= empty($this->input->get('v1')) ? "" : $this->input->get('v1') ?>">
          <input type="hidden" name="q2" id="q2" value="<?= empty($this->input->get('q2')) ? "" : $this->input->get('q2') ?>">
          <input type="hidden" name="v2" id="v2" value="<?= empty($this->input->get('v2')) ? "" : $this->input->get('v2') ?>">
          <input type="hidden" name="q3" id="q3" value="<?= empty($this->input->get('q3')) ? "" : $this->input->get('q3') ?>">
          <input type="hidden" name="v3" id="v3" value="<?= empty($this->input->get('v3')) ? "" : $this->input->get('v3') ?>">
          <input type="hidden" name="bq3" id="bq3" value="<?= empty($this->input->get('bq3')) ? "" : $this->input->get('bq3') ?>">
          <input type="hidden" name="bv3" id="bv3" value="<?= empty($this->input->get('bv3')) ? "" : $this->input->get('bv3') ?>">
          <input type="hidden" name="q4" id="q4" value="<?= empty($this->input->get('q4')) ? "" : $this->input->get('q4') ?>">
          <input type="hidden" name="v4" id="v4" value="<?= empty($this->input->get('v4')) ? "" : $this->input->get('v4') ?>">
          <input type="hidden" name="bq4" id="bq4" value="<?= empty($this->input->get('bq4')) ? "" : $this->input->get('bq4') ?>">
          <input type="hidden" name="bv4" id="bv4" value="<?= empty($this->input->get('bv4')) ? "" : $this->input->get('bv4') ?>">
          <input type="hidden" name="q5" id="q5" value="<?= empty($this->input->get('q5')) ? "" : $this->input->get('q5') ?>">
          <input type="hidden" name="v5" id="v5" value="<?= empty($this->input->get('v5')) ? "" : $this->input->get('v5') ?>">
          <input type="hidden" name="bq5" id="bq5" value="<?= empty($this->input->get('bq5')) ? "" : $this->input->get('bq5') ?>">
          <input type="hidden" name="bv5" id="bv5" value="<?= empty($this->input->get('bv5')) ? "" : $this->input->get('bv5') ?>">
          <input type="hidden" name="q6" id="q6" value="<?= empty($this->input->get('q6')) ? "" : $this->input->get('q6') ?>">
          <input type="hidden" name="v6" id="v6" value="<?= empty($this->input->get('v6')) ? "" : $this->input->get('v6') ?>">
          <input type="hidden" name="bq6" id="bq6" value="<?= empty($this->input->get('bq6')) ? "" : $this->input->get('bq6') ?>">
          <input type="hidden" name="bv6" id="bv6" value="<?= empty($this->input->get('bv6')) ? "" : $this->input->get('bv6') ?>">
          <input type="hidden" name="q7" id="q7" value="<?= empty($this->input->get('q7')) ? "" : $this->input->get('q7') ?>">
          <input type="hidden" name="v7" id="v7" value="<?= empty($this->input->get('v7')) ? "" : $this->input->get('v7') ?>">
          <input type="hidden" name="bq7" id="bq7" value="<?= empty($this->input->get('bq7')) ? "" : $this->input->get('bq7') ?>">
          <input type="hidden" name="bv7" id="bv7" value="<?= empty($this->input->get('bv7')) ? "" : $this->input->get('bv7') ?>">
          <input type="hidden" name="q8" id="q8" value="<?= empty($this->input->get('q8')) ? "" : $this->input->get('q8') ?>">
          <input type="hidden" name="v8" id="v8" value="<?= empty($this->input->get('v8')) ? "" : $this->input->get('v8') ?>">
          <input type="hidden" name="bq8" id="bq8" value="<?= empty($this->input->get('bq8')) ? "" : $this->input->get('bq8') ?>">
          <input type="hidden" name="bv8" id="bv8" value="<?= empty($this->input->get('bv8')) ? "" : $this->input->get('bv8') ?>">
          <input type="hidden" name="q9" id="q9" value="<?= empty($this->input->get('q9')) ? "" : $this->input->get('q9') ?>">
          <input type="hidden" name="v9" id="v9" value="<?= empty($this->input->get('v9')) ? "" : $this->input->get('v9') ?>">
          <input type="hidden" name="bq9" id="bq9" value="<?= empty($this->input->get('bq9')) ? "" : $this->input->get('bq9') ?>">
          <input type="hidden" name="bv9" id="bv9" value="<?= empty($this->input->get('bv9')) ? "" : $this->input->get('bv9') ?>">
          <input type="hidden" name="q10" id="q10" value="<?= empty($this->input->get('q10')) ? "" : $this->input->get('q10') ?>">
          <input type="hidden" name="v10" id="v10" value="<?= empty($this->input->get('v10')) ? "" : $this->input->get('v10') ?>">
          <input type="hidden" name="bq10" id="bq10" value="<?= empty($this->input->get('bq10')) ? "" : $this->input->get('bq10') ?>">
          <input type="hidden" name="bv10" id="bv10" value="<?= empty($this->input->get('bv10')) ? "" : $this->input->get('bv10') ?>">
          <input type="hidden" name="startDateq3" id="startDateq3" value="<?= empty($this->input->get('startDateq3')) ? "" : $this->input->get('startDateq3') ?>">
          <input type="hidden" name="startDatev3" id="startDatev3" value="<?= empty($this->input->get('startDatev3')) ? "" : $this->input->get('startDatev3') ?>">
          <input type="hidden" name="startDatebq3" id="startDatebq3" value="<?= empty($this->input->get('startDatebq3')) ? "" : $this->input->get('startDatebq3') ?>">
          <input type="hidden" name="startDatebv3" id="startDatebv3" value="<?= empty($this->input->get('startDatebv3')) ? "" : $this->input->get('startDatebv3') ?>">

          <input type="hidden" name="startDateq4" id="startDateq4" value="<?= empty($this->input->get('startDateq4')) ? "" : $this->input->get('startDateq4') ?>">
          <input type="hidden" name="startDatev4" id="startDatev4" value="<?= empty($this->input->get('startDatev4')) ? "" : $this->input->get('startDatev4') ?>">
          <input type="hidden" name="startDatebq4" id="startDatebq4" value="<?= empty($this->input->get('startDatebq4')) ? "" : $this->input->get('startDatebq4') ?>">
          <input type="hidden" name="startDatebv4" id="startDatebv4" value="<?= empty($this->input->get('startDatebv4')) ? "" : $this->input->get('startDatebv4') ?>">

          <input type="hidden" name="startDateq5" id="startDateq5" value="<?= empty($this->input->get('startDateq5')) ? "" : $this->input->get('startDateq5') ?>">
          <input type="hidden" name="startDatev5" id="startDatev5" value="<?= empty($this->input->get('startDatev5')) ? "" : $this->input->get('startDatev5') ?>">
          <input type="hidden" name="startDatebq5" id="startDatebq5" value="<?= empty($this->input->get('startDatebq5')) ? "" : $this->input->get('startDatebq5') ?>">
          <input type="hidden" name="startDatebv5" id="startDatebv5" value="<?= empty($this->input->get('startDatebv5')) ? "" : $this->input->get('startDatebv5') ?>">

          <print-assets>

          </print-assets>

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
<script>
  function print_pdf(obj) {
    window.open(window.location.origin + window.location.pathname + "/report/pdf", '_blank');
    // location.href = ;
  }
</script>