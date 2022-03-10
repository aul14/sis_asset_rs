<div id="repair_form" class="modal samrs-modal zoom fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <form id="repair-formdirect">
      <div class="modal-content">
        <div class="modal-header">
          <p id="title-repair">add new repair</p>
          <a href="<?= base_url('task/med/complain'); ?>" class="btn btn-rounded btn-outline-danger" type="button" class="close" aria-hidden="true">×</a>
        </div>
        <div class="modal-body fixed-height samrs-form" id="app_form_directTo">
          <input type="hidden" name="taskSysCat" value="MED">
          <form-repair>
            <template v-slot:idassigne>
              <input type="text" class="form-control" name="idAssignee" readonly value="<?= $this->session->userdata('username'); ?>">
            </template>
          </form-repair>
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
<div id="select_complain" class="modal samrs-modal zoom fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <p>select complain</p>
        <button class="btn btn-rounded btn-outline-danger" type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body fixed-height samrs-form">
        <div class="table-responsive">
          <table class="select_complain table samrs-tableview capitalize samrs-table-striped table-hover">
            <thead>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <div class="mr-10 ml-10">
          <button class="btn samrs-primary" href="#" data-dismiss="modal">Select</button>
        </div>
        <a class="btn samrs-danger is-outline" href="#" data-dismiss="modal">Cancel</a>
      </div>
    </div>
  </div>
</div>
<div id="select_sparepart" class="modal samrs-modal zoom fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <p>select sparepart</p>
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
          <button class="btn samrs-primary" type="button" data-dismiss="modal">Select</button>
        </div>
        <a class="btn samrs-danger is-outline" href="#" data-dismiss="modal">Cancel</a>
      </div>
    </div>
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
<div class="modal samrs-modal zoom fade" id="OTPModalChairman" tabindex="-1" role="dialog" aria-labelledby="OTPModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <form action="">
      <div class="modal-content">
        <div class="modal-body samrs-form">
          <div class="p-10">
            <p class="mandatory-info" samrs-typography="center 600">OTP code send via Email</p>
            <p class="mandatory-info" samrs-typography="center capitalize">please check your inbox or spam folder</p>
            
              <div class="form-group row">
                <div class="col-xl-4 col-lg-4 col-4">
                  <label class="form-title">OTP Code</label>
                </div>
                <div class="col-xl-8 col-lg-8 col-8">
                  <input class="form-control" name="otpCode" type="text" id="otpCode" autocomplete="off" required>
                  <label for="otpPrefix" id="otpPrefix"></label>
                  <div class="p-10" samrs-border="top-2 light" id="otpMessage">
                    <small class="text-danger text-sm-left">
                      <span class="field-validation-valid" data-valmsg-for="otpCode" data-valmsg-replace="true"></span>
                    </small>
                  </div>
                </div>
              </div>
              <div class="form-group samrs-flex wrapped is-column">
                <div class="col-xl-12">
                  <label class="form-title capitalize">customer satisfication rate</label>
                </div>
                <div class="col-xl-12">
                  <div class="star-wrap sm-star">
                    <input checked class="input-star none" name="rating-1" value="0" type="radio">
                    <label  aria-label="1 stars"  class="star-label" for="rating-1">
                      <i class="star-icon fas fa-star"></i>
                    </label>
                    <input class="input-star" id="rating-1" type="radio" name="rating-1" value="1">
                    <label aria-label="2 stars" class="star-label" for="rating-2">
                      <i class="star-icon fas fa-star"></i>
                    </label>
                    <input class="input-star" id="rating-2" type="radio" name="rating-1" value="2">
                    <label aria-label="3 stars" class="star-label" for="rating-3">
                      <i class="star-icon fas fa-star"></i>
                    </label>
                    <input class="input-star" id="rating-3" type="radio" name="rating-1" value="3">
                    <label aria-label="4 stars" class="star-label" for="rating-4">
                      <i class="star-icon fas fa-star"></i>
                    </label>
                    <input class="input-star" id="rating-4" type="radio" name="rating-1" value="4">
                    <label aria-label="5 stars" class="star-label" for="rating-5">
                      <i class="star-icon fas fa-star"></i>
                    </label>
                    <input class="input-star" id="rating-5" type="radio" name="rating-1" value="5">
                  </div>
                </div>  
              </div> 
          </div>
        </div>
        <div class="modal-footer">
          <div class="form-group mb-0 text-right" id="btn-approve-chairman" style="display: none;">
            <button type="button" value="submitOTP" id="submitOTPChairman" class="btn btn-info waves-effect waves-light">Submit OTP</button>
          </div>
          <div class="form-group mb-0 text-right" id="btn-approve-teknisi" style="display: none;">
            <button type="button" value="submitOTP" id="submitOTPTeknisi" class="btn btn-info waves-effect waves-light">Submit OTP</button>
          </div>
        </div>
      </div>
    </form> 
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

    $('#repair-formdirect').submit(function(e) {
      e.preventDefault();
      $.ajax({
        url: BASE_URL + 'task/med/repair/store',
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
                document.location.href = "<?php echo base_url(); ?>task/med/repair";
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


  function delete_confirmation_service_repair(e, id_serv) {
    var ajax_form_service_delete = $("input[name=idForm]").val();

    if (ajax_form_service_delete === '') {
      var url = BASE_URL + "task/med/task_datatable/delete_service_session/" + id_serv;
    } else {
      var url = BASE_URL + "task/med/task_datatable/delete_service_data/" + id_serv;
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
                  $('.servicecharge_list').DataTable().ajax.reload();
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

  function delete_confirmation_stock_repair(e, id_stock) {
    var ajax_form_stock_delete = $("input[name=idForm]").val();

    if (ajax_form_stock_delete === '') {
      var url = BASE_URL + "task/med/task_datatable/delete_stock_session/" + id_stock;
    } else {
      var url = BASE_URL + "task/med/task_datatable/delete_stock_data/" + id_stock;
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
                  $('.sparepartusage_list').DataTable().ajax.reload();
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

  function delete_confirmation_tools_repair(e, id_tools) {
    var ajax_idformstools_edit = $("input[name=idForm]").val();;

    if (ajax_idformstools_edit == '') {
      var url = BASE_URL + "task/med/task_datatable/delete_tools_session/" + id_tools;
    } else {
      var url = BASE_URL + "task/med/task_datatable/delete_tools_data/" + id_tools;
      //     var url = BASE_URL + 'asset_propfiles/asset_propfiles_delete_by_id_stock/' + id_stock;
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
                  $('.toolsusage_list').DataTable().ajax.reload();
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

  function delete_confirmation_record_repair(e, id_time) {
    var ajax_idasset_edit = $("input[name=idForm]").val();

    if (ajax_idasset_edit == '') {
      var url = BASE_URL + "task/med/task_datatable/delete_record_session/" + id_time;
    } else {
      var url = BASE_URL + 'task/med/task_datatable/delete_record_data/' + id_time;
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
                  $('.progressrecord_list').DataTable().ajax.reload();
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
</script>