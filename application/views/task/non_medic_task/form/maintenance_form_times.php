<div id="maintenance_times" class="modal samrs-modal zoom fade" data-backdrop="static" role="dialog">
  <div class="modal-dialog modal-xl">
    <form id="mtn-formtimes">
      <div class="modal-content">
        <div class="modal-header">
          <p>Edit maintenance</p>
          <a href="<?= base_url('task/non/maintenance/schedule_report'); ?>" class="btn btn-rounded btn-outline-danger" class="close" aria-hidden="true">×</a>
        </div>
        <div class="modal-body fixed-height samrs-form">
          <div class="p-10">
            <p class="mandatory-info">Field marked <span>*</span> is required to fill or mandatory</p>
            <div class="form-group row">
              <div class="col-xl-4">
                <label class="form-title">assets code</label>
              </div>
              <div class="col-xl-8">
                <input type="hidden" name="idTaskEditTimes">
                <input readonly class="form-control" type="text" name="codeEditTimes">
              </div>
            </div>
            <div class="form-group row">
              <div class="col-xl-4">
                <label class="form-title">assets name</label>
              </div>
              <div class="col-xl-8">
                <input readonly class="form-control" type="text" name="assetnameEditTimes">
              </div>
            </div>
            <div class="form-group row">
              <div class="col-xl-4">
                <label class="form-title">brands</label>
              </div>
              <div class="col-xl-8">
                <input readonly class="form-control" type="text" name="merkEditTimes">
              </div>
            </div>
            <div class="form-group row">
              <div class="col-xl-4">
                <label class="form-title">type</label>
              </div>
              <div class="col-xl-8">
                <input readonly class="form-control" type="text" name="tipeEditTimes">
              </div>
            </div>
            <div class="form-group row">
              <div class="col-xl-4">
                <label class="form-title">serial number</label>
              </div>
              <div class="col-xl-8">
                <input readonly class="form-control" type="text" name="snEditTimes">
              </div>
            </div>
            <div class="form-group row">
              <div class="col-xl-4">
                <label class="form-title">rooms</label>
              </div>
              <div class="col-xl-8">
                <input readonly class="form-control" type="text" name="roomEditTimes">
              </div>
            </div>
            <div class="form-group row">
              <div class="col-xl-4">
                <label class="form-title">planned date <span>*</span></label>
              </div>
              <div class="col-xl-8">
                <input class="form-control" type="date" name="scheduleStartEdit">
              </div>
            </div>
            <div class="form-group row">
              <div class="col-xl-4">
                <label class="form-title">forms <span>*</span></label>
              </div>
              <div class="col-xl-8">
                <select class="form-control selectpicker with-ajax-formtemplate" data-live-search="true" name="formTemplateEdit">
                  <!-- <option>Select Forms</option> -->
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="mr-10 ml-10">
            <button class="btn samrs-primary" type="submit" name="save" value="save">Save</button>
            <button class="btn samrs-success" type="submit" name="save_close" value="save_close">Save & Exit</button>
          </div>
          <a class="btn samrs-danger is-outline" href="<?= base_url('task/non/maintenance/schedule_report'); ?>">Cancel</a>
        </div>
      </div>
    </form>
  </div>
</div>
<script>
  $(document).ready(function() {
    var is_close = false;
    $("button[type='submit']").click(function() {
      var _name = $(this).val();
      is_close = (_name == "save") ? false : true;
    });

    $('#mtn-formtimes').submit(function(e) {
      e.preventDefault();
      $.ajax({
        url: BASE_URL + 'task/non/maintenance/schedule_report/store_form_schedule_edit',
        type: "POST",
        data: new FormData(this),
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        dataType: 'json',
        success: function(response) {
          if (response.queryResult == true) {
            if (!is_close) {
              Swal.fire({
                icon: 'success',
                title: 'Success..',
                text: "Success, data saved successfully"
              }).then(function() {
                $('.samrs-form input, .samrs-form textarea').val('');
                $('.samrs-table1').DataTable().ajax.reload();
              });
            } else {
              Swal.fire({
                icon: 'success',
                title: 'Success..',
                text: "Success, data saved successfully"
              }).then(function() {
                $('.samrs-table1').DataTable().ajax.reload();
                location.reload();
              });

            }
          } else {
            Swal.fire({
              icon: 'warning',
              title: 'Oops...',
              text: response.queryMessage,
            });

          }
        },
        error: function(xhr, ajaxOptions, thrownError) {
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: thrownError,
          });
        }
      });
    });
  });
</script>