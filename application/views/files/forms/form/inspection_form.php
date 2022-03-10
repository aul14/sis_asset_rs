<div id="inspection_form" class="modal samrs-modal zoom fade" data-backdrop="static" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <form action="<?= base_url('files/forms/inspection/store'); ?>" method="post" id="addform">
      <div class="modal-content">
        <div class="modal-header">
          <p id="title-forms-main">add new form inpection</p>
          <a class="btn btn-rounded btn-outline-danger" class="close" href="javascript:void(0)" onclick="return clickback()" aria-hidden="true">×</a>
        </div>
        <div class="modal-body fixed-height samrs-form" id="app_form">
          <input type="hidden" name="idTmpItem" id="idTmpItem">
          <form-main>
            <template v-slot:ftname-form>
              <input class="form-control" name="ftName_hc" type="text" id="ftName_hc" value="Inspection Forms" required readonly>
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
          <subform-action-record list-alphabet="I"></subform-action-record>

          <subform-result></subform-result>
          <subform-signature></subform-signature>
        </div>
        <div class="modal-footer">
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
          <button class="btn samrs-primary" id="selectAllIdAssetMaster" type="button" name="button" data-dismiss="modal">Select</button>
        </div>
        <a class="btn samrs-danger is-outline" href="#" data-dismiss="modal">Cancel</a>
      </div>
    </div>
  </div>
</div>

<script>
  function clickback() {
    "<?php
      $this->session->unset_userdata('idAssetMasterSelected');
      $this->session->set_userdata('idAssetMasterSelected', []);

      ?>"
    document.location.href = "<?php echo base_url(); ?>files/forms/inspection";
  }
  $(function() {
    var is_close = false;
    $("button[type='submit']").click(function() {
      var _name = $(this).val();
      is_close = (_name == "save") ? false : true;
    });
    $("#addform").validate({
      ignore: "input[type=hidden]",
      errorClass: "text-danger",
      successClass: "text-success",
      highlight: function(element, errorClass) {
        var elem = $(element);
        if (elem.hasClass('select2-offscreen')) {
          $('#s2id_' + elem.attr('id') + ' ul').removeClass(errorClass);
          $('#s2id_' + elem.attr('id') + ' ul').addClass('is-invalid');
        } else {
          elem.removeClass(errorClass);
          elem.addClass('is-invalid');
        }

        $(element).removeClass(errorClass)
        $(element).addClass('is-invalid');
      },
      unhighlight: function(element, errorClass) {
        var elem = $(element);
        if (elem.hasClass('select2-offscreen')) {
          $('#s2id_' + elem.attr('id') + ' ul').removeClass(errorClass);
          $('#s2id_' + elem.attr('id') + ' ul').removeClass('is-invalid');
        } else {
          elem.removeClass(errorClass);
          elem.removeClass('is-invalid');
        }

        $(element).removeClass(errorClass)
        $(element).removeClass('is-invalid');
      },
      errorPlacement: function(error, element) {
        error.insertAfter(element)
        error.addClass('invalid-feedback');
        element.closest('.col-8').append(error);
      },
      submitHandler: function(form) {
        // console.log(request_method);

        var post_url = $(form).attr("action");
        var request_method = $(form).attr("method");
        $.ajax({
          type: request_method,
          url: post_url,
          data: $(form).serialize(),
          dataType: 'json',
          success: function(response) {
            // console.log(response)
            if (response.queryResult == true) {
              if (!is_close) {
                Swal.fire({
                  icon: 'success',
                  title: 'Success..',
                  text: "Success, data saved successfully"
                }).then(function() {

                  $('.samrs-table1').DataTable().ajax.reload();
                  // window.location.reload();
                });

              } else {
                Swal.fire({
                  icon: 'success',
                  title: 'Success..',
                  text: "Success, data saved successfully"
                }).then(function() {
                  $('.samrs-table1').DataTable().ajax.reload();
                  document.location.href = "<?php echo base_url(); ?>files/forms/inspection";
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
      }
    });
  });
</script>

<script>
  function SelectAssets() {
    let table = $('.select_assets').DataTable({
      "ajax": {
        "url": BASE_URL + "master_data/inventory_master/data_table_2",
        "dataType": "json",
        "type": "POST"
      },
      columns: [{
          title: '<input type="checkbox" id="checkall" class="checkall_master"/>',
          name: null,
          data: "check_box_cuk"
        },
        {
          title: 'No',
          name: 'No',
          data: 'no'
        },
        {
          title: 'assets master name',
          name: 'assets_master_name',
          data: 'assetMasterName'
        },
      ],
      dom: '<"row"<"col-4"l><"col-8"f>>tr<"col-12"p>',
      retrieve: true,
      serverSide: true,
      searching: true,
      pageLength: 50,
      lengthMenu: [50, 100, 150, 200, 250, 300, 350, 400, 450, 500]
    });
    $(document).on('click', '.select_assets tbody td', function() {
      var colIdx = table.cell(this).index().row;
      // console.log(colIdx);
      if (table.rows(colIdx).nodes().to$().find('td:first-child .checkboxes').is(':checked') === true) {
        table.rows(colIdx).nodes().to$().find('td:first-child .checkboxes').prop('checked', false);
        table.rows(colIdx).nodes().to$().removeClass('highlight');
      } else {
        table.rows(colIdx).nodes().to$().find('td:first-child .checkboxes').prop('checked', true);
        // console.log(table.rows(colIdx).nodes().to$().find('td:first-child .checkboxes').val());
        table.rows(colIdx).nodes().to$().addClass('highlight');
      }
    });


    $('.checkall_master').click(function() {
      $('input:checkbox.checkboxes').not(this).prop('checked', this.checked);
      if ($('input:checkbox.checkboxes').not(this).is(':checked') === true) {
        table.rows().select();
        $('tbody tr').addClass('highlight');
        $('.checkboxes').prop('checked', true);
        $("input:checkbox").prop('checked', $(this).prop("checked"));
        // console.log($('input:checkbox.checkboxes').not(this));
      } else {
        table.rows().deselect();
        $('tbody tr').removeClass('highlight');
        $('.checkboxes').prop('checked', false);
        $("input:checkbox:not(:checked)").map(function() {
          deleteAssetMasterSelected($(this).val())
        });
      }
    });
  }

  function responseAndSaveToTableSelectedAssetMaster(response) {

    var res = JSON.parse(response);

    var tr = [];
    for (var i = 0; i < res.length; i++) {
      tr.push(`<tr>`);
      tr.push(`
        <td> 
            <input type="hidden" name="idAssetMaster[${i}]" 
                id="idAssetMaster${i}" value="${res[i].idAssetMaster}"> 
            <input type="text" name="assetMasterName[${i}]"
                style="border: none" readonly
                id="assetMasterName${i}" value="${res[i].assetMasterName}" required> 
        </td>
    `);

      tr.push(`<td> 
                <button type="button" class="removeAssetMaster btn btn-danger btn-sm" 
                    name="removeAssetMaster[]" onClick="deleteRow(this, ${res[i].idAssetMaster})"
                    style="margin-left:3px">
                    Remove
                </button>
            </td>`);
      tr.push(`</tr>`);
    }
    $('#responseAndSaveToTableSelectedAssetMaster').empty().append($(tr.join('')))
  }

  function deleteRow(row, index) {
    let d = row.parentNode.parentNode.rowIndex - 1;
    console.log(row.parentNode.parentNode.rowIndex)
    console.log(index)
    deleteAssetMasterSelected(index)
    document.getElementById('responseAndSaveToTableSelectedAssetMaster').deleteRow(d);
  }

  function saveAssetMasterSelected(idAssetMaster) {
    $.ajax({
      url: BASE_URL + "master_data/inventory_master/save_id_asset_master_selected",
      type: "post", //send it through get method
      "dataType": "json",
      data: {
        'idAssetMasters': idAssetMaster,
      },
      success: function(response) {
        // console.log(response)
      },
      error: function(xhr) {
        console.log(xhr)
      }
    });
  }

  function deleteAssetMasterSelected(idAssetMaster) {
    $.ajax({
      url: BASE_URL + "master_data/inventory_master/delete_id_asset_master_selected",
      type: "post", //send it through get method
      "dataType": "json",
      data: {
        'idAssetMaster': idAssetMaster,
      },
      success: function(response) {
        // console.log(response)
      },
      error: function(xhr) {
        console.log(xhr)
      }
    });
  }

  function showAssetMasterSelected() {
    $.ajax({
      url: BASE_URL + "master_data/inventory_master/show_id_asset_master_selected",
      type: "post", //send it through get method
      "dataType": "json",
      success: function(response) {
        // console.log(response)
        responseAndSaveToTableSelectedAssetMaster(response)
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
    var uniquechkArray = chkArray.filter((v, i, a) => a.indexOf(v) === i);
    // console.log(uniquechkArray);

    saveAssetMasterSelected(uniquechkArray)
  }


  $(function() {

    $(document).on('click', '#selectAllIdAssetMaster', function() {
      getValueFromCheckAll()
      showAssetMasterSelected();
    });

    // saat chekbox di table di klik
    let chkBoxArray = [];
    $(document).on('change', '.checkboxes', function(e) {
      e.preventDefault();
      var rowCount = $('#responseAndSaveToTableSelectedAssetMaster tr').length;

      for (var x = 0; x < rowCount; x++) {

        if (Number.isInteger(parseInt($(`#idAssetMaster${x}`).val()))) {
          chkBoxArray.push($(`#idAssetMaster${x}`).val());
        }
      }
      // console.log('rowCount', rowCount)
      if ($(this).prop('checked')) {
        chkBoxArray.push($(this).val());
        var uniqueChkBoxArray = chkBoxArray.filter((v, i, a) => a.indexOf(v) === i);

        saveAssetMasterSelected(uniqueChkBoxArray)
        // console.log(chkBoxArray.length); // < read the length of the amended array here
      } else {
        var uniqueChkBoxArray = chkBoxArray.filter((v, i, a) => a.indexOf(v) === i);
        for (var i = 0; i < uniqueChkBoxArray.length; i++)
          if (uniqueChkBoxArray[i] === $(this).val()) {
            uniqueChkBoxArray.splice(i, 1);
            deleteAssetMasterSelected($(this).val())
            break;
          }
      }
      console.log(uniqueChkBoxArray); // just so you can see the content
    });

    // end only for edit form

    // showAssetMasterSelected();

    // $("#modalAssetMaster").on("hidden.bs.modal", function () {
    //     deleteAssetMasterSelected()
    // });
  });
</script>