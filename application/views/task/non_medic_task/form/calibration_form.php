<div id="calibration_form" class="modal samrs-modal zoom fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <form id="cal-form">
      <div class="modal-content">
        <div class="modal-header">
          <p>add new calibration</p>
          <button class="btn btn-rounded btn-outline-danger" type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body fixed-height samrs-form" id="app_form">
          <input type="hidden" name="sysCatName" value="NON">
          <form-calibration>

          </form-calibration>
        </div>
        <div class="modal-footer">
          <div class="mr-10 ml-10">
            <button class="btn samrs-primary" type="submit" name="save" value="save">Save</button>
            <button class="btn samrs-success" type="submit" name="save_close" value="save_close">Save & Exit</button>
          </div>
          <a class="btn samrs-danger is-outline" href="<?= base_url('task/non/calibration/schedule_report'); ?>">Cancel</a>
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
          <table class="select_assets_1 table samrs-tableview capitalize samrs-table-striped table-hover w-100">
            <thead>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <div class="mr-10 ml-10">
          <button class="btn samrs-primary" type="button" id="selectAllIdAsset" data-dismiss="modal" name="button">Select</button>
        </div>
        <a class="btn samrs-danger is-outline" href="#" data-dismiss="modal">Cancel</a>
      </div>
    </div>
  </div>
</div>

<div id="task_calibration_form" class="modal samrs-modal zoom fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <form action="<?= base_url('task/non/calibration/schedule_report/update_action'); ?>" id="editcalibration">
      <div class="modal-content">
        <div class="modal-header">
          <p>Calibration : </p>
          <a class="btn btn-rounded btn-outline-danger" class="close" href="<?= base_url('task/non/calibration/schedule_report'); ?>" aria-hidden="true">×</a>
        </div>
        <div class="modal-body fixed-height samrs-form" id="report_form">
          <report-calibration>
            <template v-slot:implementation-date>
              <input class="form-control" type="date" required value="<?= date('Y-m-d'); ?>" name="finishDate">
            </template>
            <template v-slot:institution-contact>
              <select class="form-control selectpicker-contact" name="idVendor" id="idVendor" data-live-search="true" required>
                <!-- <option>Value</option> -->
                <?php foreach ($contact as $u) : ?>
                  <option value="<?= $u['idContact']; ?>"><?= $u['contactCompany']; ?></option>
                <?php endforeach; ?>
              </select>
            </template>
          </report-calibration>
        </div>
        <div class="modal-footer">
          <div class="mr-10 ml-10">
            <button class="btn samrs-primary" type="submit" name="save_action" value="save">Save</button>
            <button class="btn samrs-success" type="submit" name="save_close_action" value="save_close">Save & Exit</button>
          </div>
          <a class="btn samrs-danger is-outline" href="<?= base_url('task/non/calibration/schedule_report'); ?>">Cancel</a>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
  function responseAndSaveToTableSelectedAsset(response) {

    var res = JSON.parse(response)

    var tr = [];
    for (var i = 0; i < res.length; i++) {
      tr.push(`<tr>`);
      tr.push(`
                    <td> 
                        <input type="text" class="text-right" value="${i+1}" style="border: none; width: 100%" readonly>
                    </td>
                `);

      tr.push(`
                    <td> 
                        <input type="hidden" name="idAsset[${i}]" id="idAsset${i}" value="${res[i].idAsset}">
                        <input type="text" name="assetCode[${i}]" id="assetCode${i}" value="${res[i].assetCode}"
                            style="float:left; border: none; width: 100%">
                    </td>
                `);

      tr.push(`
                    <td> 
                        <input type="text" name="assetName[${i}]"
                            style="border: none; width: 100%" readonly
                            id="assetName${i}" value="${res[i].assetName}" required> 
                    </td>
                `);

      tr.push(`
                    <td> 
                        <input type="text" name="riskLevel[${i}]"
                            style="border: none; width: 100%" readonly
                            id="riskLevel${i}" value="${res[i].propAssetPropadmin.riskLevel}" required> 
                    </td>
                `);

      tr.push(`
                    <td> 
                        <input type="text" name="room[${i}]"
                            style="border: none; width: 100%" readonly
                            id="room${i}" value="${res[i].propAssetPropadmin.propAssetPropbuildingRoom.roomName}" required> 
                    </td>
                `);

      tr.push(`
                    <td> 
                        <input type="text" name="brand[${i}]"
                            style="border: none; width: 100%" readonly
                            id="brand${i}" value="${res[i].propAssetPropgenit.merk}" required> 
                    </td>
                `);

      tr.push(`
                    <td> 
                        <input type="text" name="type[${i}]"
                            style="border: none; width: 100%" readonly
                            id="type${i}" value="${res[i].propAssetPropgenit.tipe}" required> 
                    </td>
                `);

      tr.push(`
                    <td> 
                        <input type="text" name="serialNumber[${i}]"
                            style="border: none; width: 100%" readonly
                            id="serialNumber${i}" value="${res[i].propAssetPropgenit.serialNumber}" required> 
                    </td>
                `);

      tr.push(`
                    <td> 
                        <button type="button" class="removeAsset btn btn-danger btn-sm" 
                            name="removeAsset[]" onClick="deleteRow(this, ${res[i].idAsset})"
                            style="margin-left:3px">
                            Remove
                        </button>
                    </td>`);
      tr.push(`</tr>`);
    }
    $('#responseAndSaveToTableSelectedAsset').empty().append($(tr.join('')))
  }

  function deleteRow(row, index) {
    let d = row.parentNode.parentNode.rowIndex - 1;
    console.log(row.parentNode.parentNode.rowIndex)
    console.log(index)
    deleteAssetSelected(index)
    document.getElementById('responseAndSaveToTableSelectedAsset').deleteRow(d);
  }

  function saveAssetSelected(idAsset) {
    $.ajax({
      url: BASE_URL + "asset/asset_datatable/save_id_asset_selected",
      type: "post", //send it through get method
      data: {
        'idAssets': idAsset,
      },
      success: function(response) {
        // console.log(response)
      },
      error: function(xhr) {
        console.log(xhr)
      }
    });
  }

  function deleteAssetSelected(idAsset) {
    $.ajax({
      url: BASE_URL + "asset/asset_datatable/delete_id_asset_selected",
      type: "post", //send it through get method
      data: {
        'idAsset': idAsset,
      },
      success: function(response) {
        // console.log(response)
      },
      error: function(xhr) {
        console.log(xhr)
      }
    });
  }

  function showAssetSelected() {
    let idTask = $("input[name=idTask]").val();
    $.ajax({
      url: BASE_URL + "asset/asset_datatable/show_id_asset_selected",
      type: "get", //send it through get method
      data: {
        'idTask': (idTask != '' ? '' : idTask)
      },
      success: function(response) {
        // console.log(response)
        responseAndSaveToTableSelectedAsset(response)
      },
      error: function(xhr) {
        console.log(xhr)
      }
    });
  }

  function getValueFromCheckAll() {
    let chkArray = [];

    $(".checkboxes:checked").map(function() {
      chkArray.push($(this).val());
    });

    console.log('getValueFromCheckAll', chkArray)

    saveAssetSelected(chkArray)
  }

  function setIdAssetForFormEdit() {
    let idTaskEdit = $("input[name=idTask]").val();
    $.ajax({
      url: BASE_URL + "asset/asset_datatable/set_id_asset_for_form_edit",
      type: "post", //send it through get method
      data: {
        'idTask': (idTaskEdit != '' ? '' : idTaskEdit)
      },
      success: function(response) {
        console.log(response)
        // responseAndSaveToTableSelectedAsset(response)
      },
      error: function(xhr) {
        console.log(xhr)
      }
    });
  }

  $(function() {
    var is_close = false;
    $("button[type='submit']").click(function() {
      var _name = $(this).val();
      is_close = (_name == "save") ? false : true;
    });

    $('#cal-form').submit(function(e) {
      e.preventDefault();
      $.ajax({
        url: BASE_URL + 'task/non/calibration/schedule_report/store',
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

    $('#editcalibration').submit(function(e) {
      e.preventDefault();

      let post_url = $("#editcalibration").attr("action");
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
    // saat chekbox di table di klik
    let chkBoxArray = [];

    $(document).on('change', '.checkboxes', function(e) {
      var rowCount = $('#responseAndSaveToTableSelectedAsset tr').length;

      for (var x = 0; x < rowCount; x++) {

        if (Number.isInteger(parseInt($(`#idAsset${x}`).val()))) {
          chkBoxArray.push($(`#idAsset${x}`).val());
        }
      }
      console.log('rowCount', rowCount)

      e.preventDefault();
      if ($(this).prop('checked')) {
        chkBoxArray.push($(this).val());
        var uniqueChkBoxArray = chkBoxArray.filter((v, i, a) => a.indexOf(v) === i);

        saveAssetSelected(uniqueChkBoxArray)
        // console.log(chkBoxArray.length); // < read the length of the amended array here
      } else {
        var uniqueChkBoxArray = chkBoxArray.filter((v, i, a) => a.indexOf(v) === i);
        for (var i = 0; i < uniqueChkBoxArray.length; i++)
          if (uniqueChkBoxArray[i] === $(this).val()) {
            uniqueChkBoxArray.splice(i, 1);
            deleteAssetSelected($(this).val())
            break;
          }
      }
      console.log(uniqueChkBoxArray); // just so you can see the content
    })


    // only for edit form
    setIdAssetForFormEdit()
    // end only for edit form

    showAssetSelected()

    $(".customcheck").change(function() {
      if (this.checked) {
        // Iterate each checkbox
        $(':checkbox').each(function() {
          this.checked = true;
          console.log($(this).val())
        });
      } else {
        $(':checkbox').each(function() {
          this.checked = false;
          deleteAssetSelected($(this).val())
        });
      }
    });

    $("#selectAllIdAsset").click(function() {
      getValueFromCheckAll()
      showAssetSelected();
    });
  });
</script>