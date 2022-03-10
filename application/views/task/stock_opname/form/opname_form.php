<div id="opname_form" class="modal samrs-modal zoom fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <form id="addform">
      <div class="modal-content">
        <div class="modal-header">
          <p id="title-opname">add new task opname</p>
          <button class="btn btn-rounded btn-outline-danger" type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body fixed-height samrs-form" id="app_form">
          <form-opname></form-opname>
          <div class="samrs-tab red">
            <ul class="nav nav-tabs" role="tablist">
              <li class="nav-item" role="presentation">
                <a class="nav-link active" href="#opname" data-toggle="tab" role="tab">detail opname</a>
              </li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane fade show active" role="tabpanel" id="opname">
                <form-opname-detail></form-opname-detail>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="mr-10 ml-10">
            <button class="btn samrs-primary" type="submit" name="save" value="save">Save</button>
            <button class="btn samrs-success" type="submit" name="save_close" value="save_close">Save & Exit</button>
          </div>
          <a class="btn samrs-danger is-outline" href="<?= base_url('task/stock_opname'); ?>">Cancel</a>
        </div>
      </div>
    </form>
  </div>
</div>

<div id="addOpname" class="modal samrs-modal bounce fade">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <form id="uploadForm" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <p>add new opname detail</p>
          <button class="btn btn-rounded btn-outline-danger" type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body samrs-form">
          <div class="form-group row">
            <div class="col-xl-4">
              <label class="form-title">main category</label>
            </div>
            <div class="col-xl-8 d-flex">
              <div class="p-1">
                <input type="checkbox" value="MED" class="sysCatName" name="sysCatName[]">Medical Assets
              </div>
              <div class="p-1">
                <input type="checkbox" value="NON" class="sysCatName" name="sysCatName[]">Non Medical Assets
              </div>
              <div class="p-1">
                <input type="checkbox" value="BLD" class="sysCatName" name="sysCatName[]">Building
              </div>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-xl-4">
              <label class="form-title">assets category</label>
            </div>
            <div class="col-xl-8 d-flex">
              <select class="form-control required selectpicker" data-actions-box="True" data-done-button="True" data-live-search="True" id="catasset" multiple="True" name="catasset[]">
                <!-- <option value="">Pilih</option> -->
              </select>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-xl-4">
              <label class="form-title">assets location</label>
            </div>
            <div class="col-xl-8 d-flex">
              <select class="form-control required selectpicker" data-actions-box="True" data-done-button="True" data-live-search="True" id="lokasiasset" multiple="True" name="lokasiasset[]">
                <!-- <option value="">Pilih</option> -->
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="mr-10 ml-10">
            <button class="btn samrs-primary" type="submit" name="button" id="save-detail-opname">Save & Exit</button>
          </div>
          <a class="btn samrs-danger is-outline" href="#" data-dismiss="modal">Cancel</a>
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
    // proses save
    $('#addform').submit(function(e) {
      e.preventDefault();
      $.ajax({
        url: BASE_URL + 'task/stock_opname/store',
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
                document.location.href = "<?php echo base_url(); ?>task/stock_opname";
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

    $('form#uploadForm').submit(function(e) {
      e.preventDefault();
      var formData = new FormData(this);
      var idTaskOpnameAdd = $("input[name=idTaskOpname]").val();

      if (idTaskOpnameAdd != '') {
        var url = BASE_URL + 'stock_opname_detail/bulk_insert/' + idTaskOpnameAdd;
      } else {
        var url = BASE_URL + 'stock_opname_detail/store_to_session';
      }
      // console.log(formData);
      $.ajax({
        type: "POST",
        url: url,
        data: formData,
        success: function(data) {
          // const response = JSON.parse(data)
          // console.log(data)
          // if (ajax_idasset_edit === '') {
          $('.opname_detail').DataTable().ajax.reload();
          // } else {
          //   $('.file_list').DataTable().ajax.url(BASE_URL + "asset_propfiles/asset_propfiles_by_id_asset/" + ajax_idasset_edit).load();
          // }

          $('#addOpname').modal('hide');
        },
        error: function(data) {
          console.log(data)
        },
        cache: false,
        contentType: false,
        processData: false
      });

    });

    $(document).on("click", ".btn-deletefile", function(e) {
      e.preventDefault();
      var post_url = $(this).attr('href');
      // console.log(post_url)
      // var task = $(this).data('task');
      // var asset = $(this).data('asset');

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
                type: 'POST',
                url: post_url,
                // data: {
                //     'task': task,
                //     'asset': asset
                // },
                dataType: 'json',
                success: function(response) {
                  // console.log(response.taskStockopnameDetails)
                  if (response.taskStockopnameDetails || response.queryResult == true) {
                    $('.opname_detail').DataTable().ajax.reload();
                  } else {
                    Swal.fire({
                      icon: 'warning',
                      title: 'Oops...',
                      text: response.message,
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
            }
          },
          close: function() {}
        }
      });

    });

    $.get("<?php echo base_url(); ?>asset_propbuilding_room/asset_propbuilding_room_query?limit=0", function(result, status) {

      var data = JSON.parse(result);

      // console.log(data.data)

      data.data.map(function(item) {
        $('#lokasiasset').append(`<option value="${item.idRoom}">${item.buildingName} | ${item.floorName} | ${item.roomName}</optio>`);
      })

      $('#lokasiasset').selectpicker('refresh');
    });

    $('.sysCatName:checkbox').click(function() {
      var sysCatName = [];

      $('.sysCatName:checkbox:checked').map(function(i) {
        sysCatName[i] = $(this).val();
      });

      // console.log(sysCatName.join("-"));

      $.get(`<?php echo base_url(); ?>asset_category/asset_category_query?sysCatName=${sysCatName.join("-")}&limit=0`, function(result, status) {

        var data = JSON.parse(result);

        $("#catasset").empty();
        // console.log(data.data)
        data.data.map(function(item) {
          // console.log(item)
          $('#catasset').append(`<option value="${item.catCode}">${item.assetCatName}</optio>`);
        });

        $('#catasset').selectpicker('refresh');
      });
    })
  });
</script>