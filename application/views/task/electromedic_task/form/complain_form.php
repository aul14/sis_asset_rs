<div id="complain_form" class="modal samrs-modal zoom fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <form id="complain-form">
      <div class="modal-content">
        <div class="modal-header">
          <p id="title-complain">add new complain</p>
          <button class="btn btn-rounded btn-outline-danger" type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body fixed-height samrs-form" id="app_form">
          <input type="hidden" name="taskSysCat" value="MED">
          <form-complain>
            <template v-slot:form-username>
              <input class="form-control" name="userName" type="text" value="<?= $this->session->userdata('username'); ?>" id="userName" readonly required>
            </template>
            <template v-slot:form-informant>
              <input class="form-control" name="initBy" type="text" value="<?= $this->session->userdata('username'); ?>" id="initBy" required>
            </template>
            <template v-slot:form-complain-date>
              <input class="form-control" name="scheduleStart" value="<?= date('Y-m-d H:i:s'); ?>" type="text" id="scheduleStart" required readonly>
            </template>

          </form-complain>
        </div>
        <div class="modal-footer">
          <div class="mr-10 ml-10">
            <button class="btn samrs-primary" type="submit" name="save" value="save">Save</button>
            <button class="btn samrs-success" type="submit" name="save_close" value="save_close">Save & Exit</button>
          </div>
          <a class="btn samrs-danger is-outline" href="<?= base_url('task/med/complain'); ?>">Cancel</a>
        </div>
      </div>
    </form>
  </div>
</div>
<div id="select_assets" class="modal samrs-modal zoom fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <p>select assets</p>
        <button class="btn btn-rounded btn-outline-danger" type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body fixed-height samrs-form">
        <div class="table-responsive">
          <table class="select_assets table samrs-tableview capitalize samrs-table-striped table-hover w-100">
            <thead>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <div class="mr-10 ml-10">
          <a class="btn samrs-primary" href="javascript:void(0)" data-dismiss="modal" name="button">Select</a>
        </div>
        <a class="btn samrs-danger is-outline" href="#" data-dismiss="modal">Cancel</a>
      </div>
    </div>
  </div>
</div>

<script>
  $(function() {
    //CEK BUTTON SAVE CLOSE ATAU SAVE
    var is_close = false;
    $("button[type='submit']").click(function() {
      var _name = $(this).val();
      is_close = (_name == "save") ? false : true;
    });

    $('#complain-form').submit(function(e) {
      e.preventDefault();
      $.ajax({
        url: BASE_URL + 'task/med/complain/store',
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
                document.location.href = "<?php echo base_url(); ?>task/med/complain";
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