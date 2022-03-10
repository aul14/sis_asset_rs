<div id="inspection_form_edit" class="modal samrs-modal zoom fade" data-backdrop="static" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <form action="<?= base_url('task/med/inspection/schedule_report/store_form_edit'); ?>" id="app_form_edit">
      <div class="modal-content">
        <div class="modal-header">
          <p id="title-report-main">report form inspection</p>
          <a class="btn btn-rounded btn-outline-danger" class="close" href="javascript:void(0)" onclick="return clickback()" aria-hidden="true">×</a>
        </div>
        <div class="modal-body fixed-height samrs-form" id="template_taskform">
          <input type="hidden" name="taskSysCat" value="MED">
          <input type="hidden" name="idTaskSignature" id="idTaskSignature">
          <input type="hidden" name="idTask" id="idtask">
          <input type="hidden" name="idForm" id="idForm">
          <input type="hidden" name="idAssetSignature" id="idAssetSignature">
          <input type="hidden" name="idAsset" id="idasset">
          <input type="hidden" name="idFpEqdata" id="fpEqdata">
          <form-main>
            <template v-slot:ftname-form>
              <input class="form-control" name="ftName" type="text" id="ftName" value="Inspection Forms" required readonly>
            </template>
          </form-main>
          <subform-assets list-alphabet="A"></subform-assets>
          <subform-technician list-alphabet="B"></subform-technician>
          <subform-measuringtools list-alphabet="C"></subform-measuringtools>
          <subform-toolset list-alphabet="D"></subform-toolset>
          <subform-rooms list-alphabet="E"></subform-rooms>
          <subform-electrical list-alphabet="F"></subform-electrical>
          <subform-qualitative list-alphabet="G"></subform-qualitative>
          <subform-quantitative list-alphabet="H"></subform-quantitative>
          <subform-material list-alphabet="I"></subform-material>
          <subform-action-record list-alphabet="J"></subform-action-record>
          <!-- <subform-kpi list-alphabet="I" title-kpi="maintenance"></subform-kpi> -->
          <subform-result title-result="inspection"></subform-result>
          <subform-signature>

          </subform-signature>
        </div>
        <div class="modal-footer report-print" style="display: none;">
          <div class="mr-10 ml-10">
            <a href="javascript:void(0)" class="btn samrs-dark" onclick="printArea()">Print</a>
          </div>
        </div>
        <div class="modal-footer report-footer">
          <div class="mr-10 ml-10">
            <button class="btn samrs-primary" type="submit" name="save" value="save">Save</button>
            <button class="btn samrs-success" type="submit" name="save_close" value="save_close">Save & Exit</button>
          </div>
          <a class="btn samrs-danger is-outline" href="javascript:void(0)" onclick="return clickback()">Cancel</a>
        </div>
      </div>
    </form>
  </div>
</div>

<div id="select_tools" class="modal samrs-modal zoom fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <p>select tools</p>
        <button class="btn btn-rounded btn-outline-danger" type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body fixed-height samrs-form">
        <div class="table-responsive">
          <table class="select_tools table samrs-tableview capitalize samrs-table-striped table-hover w-100">
            <thead>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <div class="mr-10 ml-10">
          <button class="btn samrs-primary" type="button" name="button" data-dismiss="modal">Select</button>
        </div>
        <a class="btn samrs-danger is-outline" href="#" data-dismiss="modal">Cancel</a>
      </div>
    </div>
  </div>
</div>

<div id="select_tools2" class="modal samrs-modal zoom fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <p>select tools</p>
        <button class="btn btn-rounded btn-outline-danger" type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body fixed-height samrs-form">
        <div class="table-responsive">
          <table class="select_tools2 table samrs-tableview capitalize samrs-table-striped table-hover w-100">
            <thead>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <div class="mr-10 ml-10">
          <button class="btn samrs-primary" type="button" name="button" data-dismiss="modal">Select</button>
        </div>
        <a class="btn samrs-danger is-outline" href="#" data-dismiss="modal">Cancel</a>
      </div>
    </div>
  </div>
</div>

<div id="select_parts" class="modal samrs-modal zoom fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <p>select inspection material</p>
        <button class="btn btn-rounded btn-outline-danger" type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body fixed-height samrs-form">
        <div class="table-responsive">
          <table class="select_sparepart table samrs-tableview capitalize samrs-table-striped table-hover w-100">
            <thead>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <div class="mr-10 ml-10">
          <button class="btn samrs-primary" type="button" name="button" data-dismiss="modal">Select</button>
        </div>
        <a class="btn samrs-danger is-outline" href="#" data-dismiss="modal">Cancel</a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="OTPModalChairman" tabindex="-1" role="dialog" aria-labelledby="OTPModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <form action="">
          <div class="card-body pt-0 pb-0">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group row">
                  <div class="col-md-3 col-sm-12">
                    <div class="b-label">
                      <label for="otpCode">Code OTP</label>
                    </div>
                  </div>
                  <div class="col-md-9 col-sm-12 border-left">

                    <label for="otpPrefix" id="otpPrefix"></label>
                    <input class="form-control" name="otpCode" type="text" id="otpCode" autocomplete="off" required>

                    <hr>
                    <p id="otpMessage"></p>

                    <small class="text-danger text-sm-left">
                      <span class="field-validation-valid" data-valmsg-for="otpCode" data-valmsg-replace="true"></span>
                    </small>
                  </div>
                </div>

                <div class="form-group mb-0 text-right" id="btn-approve-chairman" style="display: none;">
                  <button type="button" value="submitOTP" id="submitOTPChairman" class="btn btn-info waves-effect waves-light">Submit OTP</button>
                </div>
                <div class="form-group mb-0 text-right" id="btn-approve-teknisi" style="display: none;">
                  <button type="button" value="submitOTP" id="submitOTPTeknisi" class="btn btn-info waves-effect waves-light">Submit OTP</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  function printArea() {
    $("#template_taskform").printThis({
      importCSS: true,
      header: "<h2 style='text-align: center;'>Report Form Inspection</h2>"
    });
  }
  $(document).ready(function() {
    //CEK BUTTON SAVE CLOSE ATAU SAVE
    var is_close = false;
    $("button[type='submit']").click(function() {
      var _name = $(this).val();
      is_close = (_name == "save") ? false : true;
    });

    $('#app_form_edit').submit(function(e) {
      e.preventDefault();
      let post_url = $("#app_form_edit").attr("action");

      $.ajax({
        url: post_url,
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

  function delete_confirmation_asstech_repair(e, id_time) {
    var ajax_idasset_edit = $("input[name=idForm]").val();

    if (ajax_idasset_edit == '') {
      var url = BASE_URL + "task/med/task_datatable/delete_asstech_session/" + id_time;
    } else {
      var url = BASE_URL + 'task/med/task_datatable/delete_pic_data/' + id_time;
    }

    $.confirm({
      title: "Confirmation",
      content: "Are You Sure You Will Delete Data ?",
      theme: 'bootstrap',
      columnClass: 'medium',
      typeAnimated: true,
      buttons: {
        hapus: {
          text: 'Submit',
          btnClass: 'btn-red',
          action: function() {
            $.ajax({
              type: 'GET',
              url: url,
              dataType: 'json',
              success: function(response) {
                if (response) {
                  // if (ajax_idasset_edit === '') {
                  $('.techassistant_list').DataTable().ajax.reload();
                  // } else {
                  //     $('.file_list').DataTable().ajax.url(BASE_URL + "asset_propfiles/asset_propfiles_by_id_asset/" + ajax_idasset_edit).load();
                  // }
                } else {
                  Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: response.message,
                  });
                }
              },
              error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError)
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: thrownError,
                });
              }
            });
          }
        },
        close: function() {}
      }
    });
  }

  function clickback() {
    <?php
    $this->session->unset_userdata('sesspropFormPic');
    $this->session->set_userdata('sesspropFormPic', []);
    ?>
    location.reload();
  }
</script>