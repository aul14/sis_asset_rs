<main dir="ltr" class="page-wrapper full-height" id="App">
  <main-app>
    <action-button-card title="Files - Maintenance Form">
      <template v-slot:buttons>
        <table-init></table-init>
        <?php if ($result_role[3]['subMenu1'][0]['subMenu2'][1]['subMenu3'][0]['isAllow'] == true) : ?>
          <add-data modal="maintenance_form"></add-data>
        <?php endif; ?>
        <?php if ($result_role[3]['subMenu1'][0]['subMenu2'][1]['subMenu3'][1]['isAllow'] == true) : ?>
          <edit-data button-id="modal_edit_formmain"></edit-data>
        <?php endif; ?>
        <?php if ($result_role[3]['subMenu1'][0]['subMenu2'][1]['subMenu3'][2]['isAllow'] == true) : ?>
          <delete-data button-id="modal_delete_formmain"></delete-data>
        <?php endif; ?>

        <?php if ($result_role[3]['subMenu1'][0]['subMenu2'][1]['subMenu3'][3]['isAllow'] == true) : ?>
          <table-column-view></table-column-view>
        <?php endif; ?>
      </template>
    </action-button-card>
    <table-view-card>
      <template v-slot:table-content>
        <table class="samrs-table1 table samrs-tableview samrs-table-striped table-hover w-100">
          <thead>
          </thead>
          <tbody>

          </tbody>
        </table>
      </template>
    </table-view-card>
  </main-app>
</main>
<script>
  function TableData() {
    let table = $('.samrs-table1').DataTable({
      processing: true,
      language: {
            loadingRecords: '&nbsp;',
            processing: '<div class="loader"><div></div><div></div></div>'}, 
      retrieve: true,
      serverSide: true,
      dom: 'Rrt<"samrs-grid grid-3 table-pagination"<"grid-box text-sm"l><"grid-box text-center text-sm"i><"grid-box text-sm"p>>',
      searching: true,
      scrollX: true,
      scrollY: "50vh",
      scrollCollapse: true,
      pageLength: 50,
      lengthMenu: [50, 100, 150, 200, 500, 1000],

      colReorder: true,
      colResize: {
        "handleWidth": 50
      },
      select: {
        style: 'multi',
        info: false
      },
      "ajax": {
        "url": BASE_URL + "files/forms/maintenance/data_table",
        "dataType": "json",
        "data": {
          "q1": "<?php echo $this->input->get('q1') ? $this->input->get('q1') : ''; ?>",
          "v1": "<?php echo $this->input->get('v1') ? $this->input->get('v1') : ''; ?>",
          "q2": "<?php echo $this->input->get('q2') ? $this->input->get('q2') : ''; ?>",
          "v2": "<?php echo $this->input->get('v2') ? $this->input->get('v2') : ''; ?>",
          "formTypeId": "2",
        },
        "type": "POST",
        "cache": true,
      },
      columns: [{
          title: '<input type="checkbox" id="checkall" class="checkall"/>',
          name: null,
          orderable: false,
          data: "check_box_cuk"
        },
        {
          title: 'No',
          name: 'No',
          data: null
        },
        {
          title: 'No Document',
          name: 'ftCode',
          data: 'ftCode'
        },
        {
          title: 'Asset Name',
          name: 'assetMasterName',
          data: 'assetMasterName',

          defaultContent: '-',
        },
        {
          title: 'Type Of Activity',
          name: 'formTypeName',
          data: 'propFormType.formTypeName',
          defaultContent: '-'
        },
      ],
      initComplete: function() {
        this.api().columns().every(function() {
          var column = this;
        });
      },

      "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {

        var index = iDisplayIndex + 1;
        var api = this.api();
        var pageInfo = api.page.info();
        var page = pageInfo.page;
        var length = pageInfo.length;

        var number = (page * length) + index;
        // $('td:eq(0)', nRow).html('');
        $('td:eq(1)', nRow).html(number);
        return nRow;
      }
    });

    $(document).on('click', '.samrs-table1 tbody td', function() {
      var colIdx = table.cell(this).index().row;
      // console.log(colIdx);
      if (table.rows(colIdx).nodes().to$().find('td:first-child .delete_check').is(':checked') === true) {
        table.rows(colIdx).nodes().to$().find('td:first-child .delete_check').prop('checked', false);
        table.rows(colIdx).nodes().to$().removeClass('highlight');
      } else {
        table.rows(colIdx).nodes().to$().find('td:first-child .delete_check').prop('checked', true);
        // console.log(table.rows(colIdx).nodes().to$().find('td:first-child .delete_check').val());
        table.rows(colIdx).nodes().to$().addClass('highlight');
      }
    });


    $('.checkall').click(function() {
      $('input:checkbox.delete_check').not(this).prop('checked', this.checked);
      if ($('input:checkbox.delete_check').not(this).is(':checked') === true) {
        table.rows().select();
        $('tbody tr').addClass('highlight');
        $('.delete_check').prop('checked', true);
        // console.log($('input:checkbox.delete_check').not(this));
      } else {
        table.rows().deselect();
        $('tbody tr').removeClass('highlight');
        $('.delete_check').prop('checked', false);
      }
    });

    edit();

    hapus();

    return table;
  }

  function showAssetMasterSelected() {
    $.ajax({
      url: BASE_URL + "master_data/inventory_master/show_id_asset_master_selected",
      type: "post", //send it through get method
      success: function(response) {
        // console.log(response)
        responseAndSaveToTableSelectedAssetMaster(response)
      },
      error: function(xhr) {
        console.log(xhr)
      }
    });
  }

  function setIdAssetMasterForFormEdit(id_form_template) {

    $.ajax({
      url: BASE_URL + "master_data/inventory_master/set_id_asset_master_for_form_edit",
      type: "post", //send it through get method
      data: {
        'idFormTemplate': id_form_template
      },
      success: function(response) {
        // console.log(response)
      },
      error: function(xhr) {
        console.log(xhr)
      }
    });
  }

  function hapus() {
    $("#modal_delete_formmain").click(function() {
      // e.preventDefault();
      var idFormTemplate = [];
      // Read all checked checkboxes
      $("input:checkbox[class=delete_check]:checked").each(function() {
        idFormTemplate.push($(this).val());
      });

      if (idFormTemplate.length > 0) {
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
                  url: BASE_URL + "files/forms/maintenance/delete",
                  data: {
                    'idFormTemplate': idFormTemplate,
                    //'coba':itemData.toArray()
                  },
                  dataType: 'json',
                  success: function(response) {
                    console.log(response.queryResult)
                    if (response.queryResult === true) {
                      $('.samrs-table1').DataTable().ajax.reload();
                      // console.log(response)
                      // document.location.href = "";
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
            },
            close: function() {}
          }
        });
      } else {
        Swal.fire({
          icon: 'warning',
          title: 'Oops...',
          text: "Select the items to be deleted",
        });
      }

    });
  }

  function edit() {
    $("#modal_edit_formmain").click(function() {
      // e.preventDefault();
      var idFormTemplate = [];
      // Read all checked checkboxes
      $("input:checkbox[class=delete_check]:checked").each(function() {
        idFormTemplate.push($(this).val());
      });

      if (idFormTemplate.length == 1) {
        $('#maintenance_form').modal('show');
        $.ajax({
          type: "POST",
          url: BASE_URL + "files/forms/maintenance/forms_by_id",
          data: {
            'idFormTemplate': idFormTemplate
          },
          dataType: "json",
          success: function(res) {
            setIdAssetMasterForFormEdit(res.data_update.idFormTemplate);
            showAssetMasterSelected();

            $("#title-forms-main").html("update form maintenance");
            $("input[name=formType]").val("edit");
            $("input[name=idFormTemplate]").val(res.data_update.idFormTemplate);
            $("input[name=ftName]").val(res.data_update.ftName);
            $("input[name=ftCode]").val(res.data_update.ftCode);

            $("input[name=idTmpItem]").val(res.data_update.propFormTemplateitem.idTmpItem);

            if (res.data_update.propFormTemplateitem.tmpitemEncon == true) {
              $('#switch-formencon').prop('checked', true).change();
            }

            if (res.data_update.propFormTemplateitem.tmpitemEngineer == true) {
              $('#tmpitemEngineer').prop('checked', true).change();
            }

            if (res.data_update.propFormTemplateitem.tmpitemUseVendor == true) {
              $('#tmpitemUseVendor').prop('checked', true).change();
            }

            if (res.data_update.propFormTemplateitem.tmpitemAlkur == true && res.data_update.propFormAlkur.length > 0) {
              $('#switch-formalkur').prop('checked', true).change();
              for (i = 1; i < res.data_update.propFormAlkur.length; i++) {
                let rowHtml = `
                      <tr>
                          <td>
                              <input type="hidden" name="idFpAlkur[]">
                              <input type="hidden" name="idAssetFormAlkur[]">
                              <input class="form-control w-100" type="text" name="assetNameFormAlkur[]" readonly>
                          </td>
                          <td><input class="form-control w-100" type="text" name="assetMerkFormAlkur[]" readonly></td>
                          <td><input class="form-control w-100" type="text" name="assetTypeFormAlkur[]" readonly></td>
                          <td><input class="form-control w-100" type="text" name="assetSNFormAlkur[]"  readonly></td>
                          <td class="text-center"><button type="button" class="btn samrs-danger removeRowsTools"><i class="fas fa-times"></i> Remove</button></td>
                      </tr>
                      `;
                $('.measuringTools tbody').append(rowHtml);
                $('.removeRowsTools').on('click', function() {
                  $(this).parents('tr').remove();
                });
              }
            }

            if (res.data_update.propFormTemplateitem.tmpitemTools == true && res.data_update.propFormTools.length > 0) {
              $('#switch-formtools').prop('checked', true).change();
              for (i = 1; i < res.data_update.propFormTools.length; i++) {
                let rowHtmlTools = `
                  <tr>
                    <td>
                        <input class="form-control w-100" type="hidden" name="idFpTools[]">
                        <input class="form-control w-100" type="hidden" name="idAssetFormTools[]">
                        <input class="form-control w-100" type="text" name="assetNameFormTools[]" readonly>
                    </td>
                    <td><input class="form-control w-100" type="text" name="assetMerkFormTools[]" readonly></td>
                    <td><input class="form-control w-100" type="text" name="assetTypeFormTools[]" readonly></td>
                    <td><input class="form-control w-100" type="text" name="assetSNFormTools[]" readonly></td>
                    <td class="text-center"><button type="button" class="btn samrs-danger removeRowsToolset"><i class="fas fa-times"></i> Remove</button></td>
                  </tr>
                  `;
                $('.toolsetUsage tbody').append(rowHtmlTools);
                $('.removeRowsToolset').on('click', function() {
                  $(this).parents('tr').remove();
                });
              }
            }

            if (res.data_update.propFormTemplateitem.tmpitemAction == true && res.data_update.propFormGen.length > 0) {
              $('#switch-tmpitemAction').prop('checked', true).change();
              $("#genActionFormGen0").val(res.data_update.propFormGen[0].genAction);
              $("#idGenFormGen0").val(res.data_update.propFormGen[0].idGen);
              for (i = 1; i < res.data_update.propFormGen.length; i++) {
                let rowHtmlGen = `
                  <tr>
                    <td>
                        <input type="hidden" name="idGenFormGen[]" value="${res.data_update.propFormGen[i].idGen}">
                        <input class="form-control w-100" type="text" name="genActionFormGen[]" value="${res.data_update.propFormGen[i].genAction}" required>
                    </td>
                    <td>
                    <label class="p-10">
                      <input type="checkbox" disabled name="genResult[]" value="" id="` + [i] + `">
                      <span class="ml-10">Done</span>
                    </label>
                    </td>
                    <td class="text-center">
                    <button type="button" class="btn btn-sm samrs-danger removeactionRecord"><i class="fas fa-times"></i> Remove</button>
                    </td>
                  </tr>
                  `;
                $('.actioRecords tbody').append(rowHtmlGen);
                $('.removeactionRecord').on('click', function() {
                  return $(this).parents('tr').remove();
                });
              }
            }

            if (res.data_update.propFormTemplateitem.tmpitemFisfung == true && res.data_update.propFormFisfung.length > 0) {
              $('#switch-formgen').prop('checked', true).change();
              $("#fisfungItem0").val(res.data_update.propFormFisfung[0].fisfungItem);
              $("#idFisfung0").val(res.data_update.propFormFisfung[0].idFisfung);
              for (i = 1; i < res.data_update.propFormFisfung.length; i++) {
                let rowHtml = `
                  <tr>
                    <td>
                        <input type="hidden" name="idFisfung[]" value="${res.data_update.propFormFisfung[i].idFisfung}">
                        <input class="form-control w-100" type="text" name="fisfungItem[]" value="${res.data_update.propFormFisfung[i].fisfungItem}" required>
                    </td>
                    <td>
                      <div class="radio-only-box">
                        <input type="radio" name="radio"  disabled>
                      </div>
                    </td>
                    <td>
                      <div class="radio-only-box">
                        <input type="radio" name="radio"  disabled>
                      </div>
                    </td>
                    <td>
                      <div class="radio-only-box">
                        <input type="radio" name="radio"  disabled>
                      </div>
                    </td>
                    <td class="text-center"><button type="button" class="btn samrs-danger removeRowsQualitative"><i class="fas fa-times"></i> Remove</button></td>
                  </tr>
                  `;
                $('.qualitativeTask tbody').append(rowHtml);
                $('.removeRowsQualitative').on('click', function() {
                  $(this).parents('tr').remove();
                });
              }
            }

            if (res.data_update.propFormTemplateitem.tmpitemESM == true && res.data_update.propFormElect.length > 0) {
              $('#switch-formelect').prop('checked', true).change();
              $("#idFpElect0").val(res.data_update.propFormElect[0].idFpElect);
              $("#electParam0").val(res.data_update.propFormElect[0].electParam);
              $("#electMeasure0").val(res.data_update.propFormElect[0].electMeasure);
              $("#electLower0").val(res.data_update.propFormElect[0].electLower);
              $("#electUpper0").val(res.data_update.propFormElect[0].electUpper);
              $("#val-electunit0").val(res.data_update.propFormElect[0].electUnit);
              $("#val-electunit0").html(res.data_update.propFormElect[0].electUnit);
              for (i = 1; i < res.data_update.propFormElect.length; i++) {
                let rowHtml = `
                    <tr>
                        <td>
                        <input type="hidden" name="idFpElect[]" value="${res.data_update.propFormElect[i].idFpElect}">
                        <input class="form-control w-100" type="text" name="electParam[]" value="${res.data_update.propFormElect[i].electParam}">
                        </td>
                        <td>
                        <div class="d-flex">
                            <input class="form-control w-100" type="text" name="electMeasure[]" readonly value="${res.data_update.propFormElect[i].electMeasure}">
                            <select class="form-control unitSelectElect` + [i] + `" style="width:60%;float:right;" name="electUnit[]">
                                <option value="${res.data_update.propFormElect[i].electUnit}" id="val-electunit` + [i] + `">${res.data_update.propFormElect[i].electUnit}</option>
                            </select>
                        </div>
                        </td>
                        <td>
                        <div class="d-flex">
                            <input class="form-control w-100" type="text" name="electLower[]" value="${res.data_update.propFormElect[i].electLower}">

                        </div>
                        </td>
                        <td>
                        <div class="d-flex">
                            <input class="form-control w-100" type="text" name="electUpper[]" value="${res.data_update.propFormElect[i].electUpper}">

                        </div>
                        </td>
                        <td>
                        <div class="d-flex">
                            <input class="form-control w-100" type="text" name="electResult[]"  readonly>
                        </div>
                        </td>
                        <td class="text-center">
                        <button type="button" class="btn samrs-danger removeRowsElectrical"><i class="fas fa-times"></i> Remove</button>

                        <div class="collapse samrs-grid grid-2 mt-1" id="safety_` + [i] + `">
                            <input data-border="dark" id="comparefieldSafety_` + [i] + `" class="form-control" type="number" name=""  placeholder="Add number">
                            <button class="btn btn-sm samrs-primary" type="button" name="button" id="fieldexecuteSafety_` + [i] + `">Calculate</button>
                        </div>
                        </td>
                    </tr>
                    `;

                $('.electricalSafety tbody').append(rowHtml);
                $('.unitSelectElect' + [i]).select2({
                  ajax: {
                    url: BASE_URL + 'asset_unit/asset_unit_query',
                    dataType: 'json',
                    type: 'GET',
                    delay: 250,
                    processResults: function(data) {
                      provinces = data;

                      return {
                        results: $.map(data['data'], function(item) {
                          return {
                            text: decodeHtml(item.satuan),
                            id: item.satuan
                          }
                        })
                      };
                    },
                  }
                });
                $('.removeRowsElectrical').on('click', function() {
                  $(this).parents('tr').remove();
                });
              }
            }

            if (res.data_update.propFormTemplateitem.tmpitemPerf == true && res.data_update.propFormUkur.length > 0) {
              $('#switch-formukur').prop('checked', true).change();
              $("#idUkurFormUkur0").val(res.data_update.propFormUkur[0].idUkur);
              $("#ukurSubjectFormUkur0").val(res.data_update.propFormUkur[0].ukurSubject);
              $("#ukurSetFormUkur0").val(res.data_update.propFormUkur[0].ukurSet);
              $("#ukurValFormUkur0").val(res.data_update.propFormUkur[0].ukurVal);
              $("#ukurMinFormUkur0").val(res.data_update.propFormUkur[0].ukurMin);
              $("#ukurMaxFormUkur0").val(res.data_update.propFormUkur[0].ukurMax);
              $("#ukurResult0").val(res.data_update.propFormUkur[0].ukurResult);
              $("#val-ukurUnitFormUkur0").val(res.data_update.propFormUkur[0].ukurUnit);
              $("#val-ukurUnitFormUkur0").html(res.data_update.propFormUkur[0].ukurUnit);
              for (i = 1; i < res.data_update.propFormUkur.length; i++) {
                let rowHtml = `
                    <tr>
                        <td>
                            <input type="hidden" value="${res.data_update.propFormUkur[i].idUkur}" name="idUkurFormUkur[]" id="idUkurFormUkur` + [i] + `">
                            <input class="form-control" type="text" name="ukurSubjectFormUkur[]" value="${res.data_update.propFormUkur[i].ukurSubject}" id="ukurSubjectFormUkur` + [i] + `" required>
                        </td>
                        <td>
                          <div class="d-flex">
                            <input class="form-control id-set-ukur" value="${res.data_update.propFormUkur[i].ukurSet}" style="text-align: center; width:40%;float:left;" type="text" name="ukurSetFormUkur[]"
                                id="ukurSetFormUkur` + [i] + `" required>
                            <select class="form-control unitSelect` + [i] + `" style="width:60%;float:right;" name="ukurUnitFormUkur[]" id="ukurUnitFormUkur` + [i] + `" required>
                              <option value="${res.data_update.propFormUkur[i].ukurUnit}" id="val-ukurUnitFormUkur` + [i] + `">${res.data_update.propFormUkur[i].ukurUnit}</option>
                            </select>
                          </div>
                        </td>
                        <td>
                          <div class="d-flex">
                            <input class="form-control" type="text" readonly name="ukurVal[]" value="${res.data_update.propFormUkur[i].ukurVal}" id="ukurValFormUkur` + [i] + `">

                          </div>
                        </td>
                        <td>
                          <div class="d-flex">
                            <input class="form-control" type="text"  name="ukurMinFormUkur[]" value="${res.data_update.propFormUkur[i].ukurMin}" id="ukurMinFormUkur` + [i] + `" required>

                          </div>
                        </td>
                        <td>
                          <div class="d-flex">
                            <input class="form-control" type="text"  name="ukurMaxFormUkur[]" value="${res.data_update.propFormUkur[i].ukurMax}" id="ukurMaxFormUkur` + [i] + `" required>

                          </div>
                        </td>
                        <td><input class="form-control" type="text"  name="ukurResultFormUkur[]" id="ukurResult` + [i] + `" value="${res.data_update.propFormUkur[i].ukurResult}" readonly></td>
                        <td>
                          <div class="d-flex" id="quantitative_A` + [i] + `">
                            <button type="button" class="btn btn-sm samrs-danger removerowsQuantitative"><i class="fas fa-times"></i> Remove</button>
                            <div class="collapse" id="calculator_` + [i] + `">
                              <input data-border="success" data-number="${[i]}" class="form-control count-row-calculate" type="text" onkeypress="return hanyaAngka(event)" id="comparefieldQuantitative_` + [i] + `" name="hitung_number[]" placeholder="%">
                            </div>
                            <button type="button" class="btn btn-sm samrs-success ml-10" data-target="#calculator_` + [i] + `" data-toggle="collapse" data-numbtn="${[i]}" >Show Calc</button>
                          </div>
                        </td>
                    </tr>`;
                // this.$option.mounted.loadSelect2([i]);
                $('.quantitativeTask tbody').append(rowHtml);
                $('.unitSelect' + [i]).select2({
                  ajax: {
                    url: BASE_URL + 'asset_unit/asset_unit_query',
                    dataType: 'json',
                    type: 'GET',
                    delay: 250,
                    processResults: function(data) {
                      provinces = data;

                      return {
                        results: $.map(data['data'], function(item) {
                          return {
                            text: decodeHtml(item.satuan),
                            id: item.satuan
                          }
                        })
                      };
                    },
                  }
                });
                $('#calculator_' + [i]).on('show.bs.collapse', function() {
                  $(this).prev(`.removerowsQuantitative`).css({
                    display: 'none'
                  });
                  $(this).next('[data-toggle="collapse"]').removeClass('samrs-success').addClass('samrs-warning').text('Hide Calc');
                });
                $('#calculator_' + [i]).on('hide.bs.collapse', function() {
                  $(this).prev(`.removerowsQuantitative`).css({
                    display: ''
                  });
                  $(this).next('[data-toggle="collapse"]').removeClass('samrs-warning').addClass('samrs-success').text('Show Calc');
                });
                $(`.removerowsQuantitative`).on('click', function() {
                  $(this).parents('tr').remove();
                });


                $(document).on('keyup', '.count-row-calculate', function() {
                  var num = $(this).data('number');
                  var unit = $(`#ukurUnitFormUkur${num}`).val();
                  if (unit == "") {
                    Swal.fire({
                      icon: 'warning',
                      title: 'Oops...',
                      text: "Unit of measurement cannot be empty",
                    });
                    $(`#comparefieldQuantitative_${num}`).val("");
                    return;
                  }

                  if (unit == '%') {
                    Swal.fire({
                      icon: 'warning',
                      title: 'Oops...',
                      text: "Unit of measurement cannot be persens",
                    });
                    $(`#comparefieldQuantitative_${num}`).val("");
                    return;
                  }
                  //  var items = new Array();
                  var val_ukur = $(`#ukurSetFormUkur${num}`).val();
                  var val_compare = $(`#comparefieldQuantitative_${num}`).val();

                  var ukur = parseFloat((val_ukur == '' ? 0 : val_ukur));
                  var compare = parseFloat((val_compare == '' ? 0 : val_compare));

                  var result = ukur * (compare / 100);
                  var minimal = ukur - result;
                  var maximal = ukur + result;
                  $(`#ukurMinFormUkur${num}`).val((minimal % 1 == 0 ? minimal : minimal.toFixed(2)));
                  $(`#ukurMaxFormUkur${num}`).val((maximal % 1 == 0 ? maximal : maximal.toFixed(2)));
                });
              }
            }
          }
        });
      } else {
        Swal.fire({
          icon: 'warning',
          title: 'Oops...',
          text: (idFormTemplate.length > 1) ? "You choose more than 1 item, please choose one item to be edited" : "Select Items to be Edited",
        });
      }
    });
  }


  function decodeHtml(html) {
    var txt = document.createElement("textarea");
    txt.innerHTML = html;
    return txt.value;
  }
</script>
