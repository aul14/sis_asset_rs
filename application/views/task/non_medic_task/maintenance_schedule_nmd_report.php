<main dir="ltr" class="page-wrapper full-height" id="App">
  <main-app>
    <div class="col-xl-12">
      <?php
      $data = $this->session->flashdata('sukses');
      if ($data != "") { ?>
        <div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <i class="icon fa fa-check"></i> <?= $data; ?>
        </div>
      <?php } ?>
      <?php
      $data2 = $this->session->flashdata('error');
      if ($data2 != "") { ?>
        <div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <i class="icon fa fa-close"></i> <?= $data2; ?>
        </div>
      <?php } ?>
    </div>
    <action-button-card title="Non Electromedic Task - Maintenance Schedule & Report">
      <template v-slot:buttons>
        <table-init></table-init>
        <?php if ($result_role[2]['subMenu1'][1]['subMenu2'][2]['subMenu3'][0]['subMenu4'][3]['isAllow'] == true) : ?>
          <approve-data button-id="modal_approve_maintenance"></approve-data>
        <?php endif; ?>
        <?php if ($result_role[2]['subMenu1'][1]['subMenu2'][2]['subMenu3'][0]['subMenu4'][0]['isAllow'] == true) : ?>
          <add-data modal="maintenance_form"></add-data>
        <?php endif; ?>
        <?php if ($result_role[2]['subMenu1'][1]['subMenu2'][2]['subMenu3'][0]['subMenu4'][1]['isAllow'] == true) : ?>
          <div class="grid-box">
            <a href="javascript:void(0)" id="modal_edit_maintenance" class="btn btn-block samrs-success"><i class="fas fa-edit"></i> Edit</a>
          </div>
        <?php endif; ?>
        <?php if ($result_role[2]['subMenu1'][1]['subMenu2'][2]['subMenu3'][0]['subMenu4'][2]['isAllow'] == true) : ?>
          <delete-data button-id="modal_delete_maintenance"></delete-data>
        <?php endif; ?>
        <?php if ($result_role[2]['subMenu1'][1]['subMenu2'][2]['subMenu3'][0]['subMenu4'][8]['isAllow'] == true) : ?>
          <detail-data button-id="modal_detail_maintenance"></detail-data>
        <?php endif; ?>
        <?php if ($result_role[2]['subMenu1'][1]['subMenu2'][2]['subMenu3'][0]['subMenu4'][4]['isAllow'] == true) : ?>
          <print-data modal="task_print"></print-data>
        <?php endif; ?>

        <?php if ($result_role[2]['subMenu1'][1]['subMenu2'][2]['subMenu3'][0]['subMenu4'][6]['isAllow'] == true) : ?>
          <table-advance-search overlay="advanced_search"></table-advance-search>
        <?php endif; ?>
        <?php if ($result_role[2]['subMenu1'][1]['subMenu2'][2]['subMenu3'][0]['subMenu4'][7]['isAllow'] == true) : ?>
          <table-column-view></table-column-view>
        <?php endif; ?>
      </template>
      <template v-slot:content>
        <form action="" method="get">
          <advanced-search with-status="Yes" have-task-periode="yes" :radio-name="['status']" :radio-label="['Not Work','Finish Not Approved','Approve']" :radio-value="['1','2','3']"></advanced-search>
        </form>
      </template>
    </action-button-card>
    <table-view-card>
      <template v-slot:table-content>
        <table class="samrs-table1 table samrs-tableview samrs-table-striped table-hover">
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
        processing: '<div class="loader"><div></div><div></div></div>'
      },
      retrieve: true,
      serverSide: true,
      dom: 'Rrt<"samrs-grid grid-3 table-pagination"<"grid-box text-sm"l><"grid-box text-center text-sm"i><"grid-box text-sm"p>>',
      searching: true,
      scrollX: true,
      scrollY: "50vh",
      scrollCollapse: true,
      pageLength: 50,
      lengthMenu: [50, 100, 150, 200, 500, 1000],
      colResize: {
        "handleWidth": 50
      },
      select: {
        style: 'multi',
        info: false
      },

      "ajax": {
        "url": BASE_URL + "task/non/maintenance/schedule_report/data_table",
        "dataType": "json",
        "data": {
          "q1": "<?php echo $this->input->get('q1') ? $this->input->get('q1') : ''; ?>",
          "v1": "<?php echo $this->input->get('v1') ? $this->input->get('v1') : ''; ?>",
          "q2": "<?php echo $this->input->get('q2') ? $this->input->get('q2') : ''; ?>",
          "v2": "<?php echo $this->input->get('v2') ? $this->input->get('v2') : ''; ?>",
          "q3": "<?php echo $this->input->get('q3') ? $this->input->get('q3') : ''; ?>",
          "v3": "<?php echo $this->input->get('v3') ? $this->input->get('v3') : ''; ?>",
          "bq3": "<?php echo $this->input->get('bq3') ? $this->input->get('bq3') : ''; ?>",
          "bv3": "<?php echo $this->input->get('bv3') ? $this->input->get('bv3') : ''; ?>",
          "q4": "<?php echo $this->input->get('q4') ? $this->input->get('q4') : ''; ?>",
          "v4": "<?php echo $this->input->get('v4') ? $this->input->get('v4') : ''; ?>",
          "bq4": "<?php echo $this->input->get('bq4') ? $this->input->get('bq4') : ''; ?>",
          "bv4": "<?php echo $this->input->get('bv4') ? $this->input->get('bv4') : ''; ?>",
          "q5": "<?php echo $this->input->get('q5') ? $this->input->get('q5') : ''; ?>",
          "v5": "<?php echo $this->input->get('v5') ? $this->input->get('v5') : ''; ?>",
          "bq5": "<?php echo $this->input->get('bq5') ? $this->input->get('bq5') : ''; ?>",
          "bv5": "<?php echo $this->input->get('bv5') ? $this->input->get('bv5') : ''; ?>",
          "q6": "<?php echo $this->input->get('q6') ? $this->input->get('q6') : ''; ?>",
          "v6": "<?php echo $this->input->get('v6') ? $this->input->get('v6') : ''; ?>",
          "bq6": "<?php echo $this->input->get('bq6') ? $this->input->get('bq6') : ''; ?>",
          "bv6": "<?php echo $this->input->get('bv6') ? $this->input->get('bv6') : ''; ?>",
          "q7": "<?php echo $this->input->get('q7') ? $this->input->get('q7') : ''; ?>",
          "v7": "<?php echo $this->input->get('v7') ? $this->input->get('v7') : ''; ?>",
          "bq7": "<?php echo $this->input->get('bq7') ? $this->input->get('bq7') : ''; ?>",
          "bv7": "<?php echo $this->input->get('bv7') ? $this->input->get('bv7') : ''; ?>",
          "q8": "<?php echo $this->input->get('q8') ? $this->input->get('q8') : ''; ?>",
          "v8": "<?php echo $this->input->get('v8') ? $this->input->get('v8') : ''; ?>",
          "bq8": "<?php echo $this->input->get('bq8') ? $this->input->get('bq8') : ''; ?>",
          "bv8": "<?php echo $this->input->get('bv8') ? $this->input->get('bv8') : ''; ?>",
          "q9": "<?php echo $this->input->get('q9') ? $this->input->get('q9') : ''; ?>",
          "v9": "<?php echo $this->input->get('v9') ? $this->input->get('v9') : ''; ?>",
          "bq9": "<?php echo $this->input->get('bq9') ? $this->input->get('bq9') : ''; ?>",
          "bv9": "<?php echo $this->input->get('bv9') ? $this->input->get('bv9') : ''; ?>",
          "q10": "<?php echo $this->input->get('q10') ? $this->input->get('q10') : ''; ?>",
          "v10": "<?php echo $this->input->get('v10') ? $this->input->get('v10') : ''; ?>",
          "bq10": "<?php echo $this->input->get('bq10') ? $this->input->get('bq10') : ''; ?>",
          "bv10": "<?php echo $this->input->get('bv10') ? $this->input->get('bv10') : ''; ?>",
          "startDateq3": "<?php echo $this->input->get('startDateq3') ? $this->input->get('startDateq3') : ''; ?>",
          "startDatev3": "<?php echo $this->input->get('startDatev3') ? $this->input->get('startDatev3') : ''; ?>",
          "startDatebq3": "<?php echo $this->input->get('startDatebq3') ? $this->input->get('startDatebq3') : ''; ?>",
          "startDatebv3": "<?php echo $this->input->get('startDatebv3') ? $this->input->get('startDatebv3') : ''; ?>",
          "startDateq4": "<?php echo $this->input->get('startDateq4') ? $this->input->get('startDateq4') : ''; ?>",
          "startDatev4": "<?php echo $this->input->get('startDatev4') ? $this->input->get('startDatev4') : ''; ?>",
          "startDatebq4": "<?php echo $this->input->get('startDatebq4') ? $this->input->get('startDatebq4') : ''; ?>",
          "startDatebv4": "<?php echo $this->input->get('startDatebv4') ? $this->input->get('startDatebv4') : ''; ?>",
          "startDateq5": "<?php echo $this->input->get('startDateq5') ? $this->input->get('startDateq5') : ''; ?>",
          "startDatev5": "<?php echo $this->input->get('startDatev5') ? $this->input->get('startDatev5') : ''; ?>",
          "startDatebq5": "<?php echo $this->input->get('startDatebq5') ? $this->input->get('startDatebq5') : ''; ?>",
          "startDatebv5": "<?php echo $this->input->get('startDatebv5') ? $this->input->get('startDatebv5') : ''; ?>",
          "status": "<?php echo $this->input->get('status') ? $this->input->get('status') : ''; ?>",
          "periode": "<?php echo $this->input->get('periode'); ?>",
          "taskSysCat": "NON",
          "taskCode": "NMTN",

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
          title: 'Status',
          name: 'progressStatus',
          data: 'status_img'
        },
        {
          title: 'Schedule Type',
          name: 'scheduleType',
          data: 'propSchedule.scheduleType'
        },
        {
          title: 'Asset Code',
          name: 'idAsset',
          data: 'assetCode'
        },
        {
          title: 'Asset Name',
          name: 'assetName',
          data: 'assetName'
        },
        {
          title: 'Merk',
          name: 'merk',
          data: 'merk'
        },
        {
          title: 'Type',
          name: 'tipe',
          data: 'tipe'
        },
        {
          title: 'Serial Number',
          name: 'serialNumber',
          data: 'serialNumber'
        },
        {
          title: 'Room Name',
          name: 'roomName',
          data: 'roomName'
        },
        {
          title: 'Floor',
          name: 'floorName',
          data: 'floorName'
        },
        {
          title: 'Building Name',
          name: 'Building Name',
          data: 'buildingName'
        },
        {
          title: 'Planning Date',
          name: 'scheduleStart',
          data: 'scheduleStart'
        },
        {
          title: 'Action Date',
          name: 'timeFinish',
          data: 'timeFinish',
          defaultContent: '-'
        },
        {
          title: 'Form',
          name: 'assignTo',
          data: 'assignTo'
        },
        {
          title: 'Executor',
          name: 'finishBy',
          data: 'finishBy'
        },

        {
          title: 'Result',
          name: 'maintenanceResult',
          data: 'maintenanceResult'
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

    edit(table);

    hapus();

    detail();

    update_mtn();

    approve(table);

    return table;
  }

  function edit(table) {
    $("#modal_edit_maintenance").click(function() {
      var idTask = [];
      // Read all checked checkboxes
      $("input:checkbox[class=delete_check]:checked").each(function() {
        idTask.push($(this).val());
      });

      if (idTask.length == 1) {

        var timeStart = table.rows({
          selected: true
        }).data().pluck('propProgress').pluck('timeStart')[0];

        if (timeStart != "") {
          $("#maintenance_form_edit").modal('show');
          $("#title-report-main").html("edit form maintenance");


          let url_action_approve = BASE_URL + "task/non/maintenance/schedule_report/store_form_old_edit";
          $("#app_form_edit").attr("action", url_action_approve);

          $.ajax({
            type: "POST",
            url: BASE_URL + "task/non/maintenance/schedule_report/approve_id_task",
            data: {
              'idTask': idTask
            },
            dataType: "json",
            success: function(res) {
              if (res.idVendor != 0) {
                $("#option-vendor").val(res.idVendor).change();
                $("#option-vendor").html(res.propContact.contactCompany);
              }

              $("#addDrawChairman").remove();
              $("#addSignatureChairman").remove();

              let signHashChairman = res.approveSign.search("DRAW");
              if (res.approveSign != "") {
                if (signHashChairman == 0) {
                  $(`#drawOtpChairman`).attr("src", BASE_URL + "assets/upload/file/" + res.approveSign.substr(5));
                } else {
                  $(`#drawOtpChairman`).attr("src", res.approveSign);
                }
              }

              $(".signature-teknisi").html(res.propProgress.finishBy);

              let signHash = res.finishSign.search("DRAW");
              if (res.finishSign != "") {
                $("#addSignatureTeknisi").remove();
                $("#addDrawTeknisi").remove();
                if (signHash == 0) {
                  $(`#drawOtpTeknisi`).attr("src", BASE_URL + "assets/upload/file/" + res.finishSign.substr(5));
                } else {
                  $(`#drawOtpTeknisi`).attr("src", res.finishSign);
                }
              }

              $(".signature-chairman").html(res.propProgress.approveBy);
              $("input[name=idAssigneeChairman]").val(res.propProgress.idAssignee);

              $("#createdDate").val(res.timeFinish);
              $("#idtask").val(res.idTask);
              $("#idTaskSignature").val(res.idTask);
              $("#idForm").val(res.propTaskMaintenance[0].propForm.idForm);
              $("#ftCode").val(res.propTaskMaintenance[0].propForm.formCode);
              $("#idFormTemplate").val(res.propTaskMaintenance[0].idFormTemplate);
              $("#idasset").val(res.propTaskMaintenance[0].idAsset);
              $("#idAssetSignature").val(res.propTaskMaintenance[0].idAsset);
              $("#asset-master").val(res.propTaskMaintenance[0].propAsset.assetName);
              $("#planning-date").val(res.propSchedule.scheduleStart);
              $("input[name=eqNameFormEqdata]").val(res.propTaskMaintenance[0].propAsset.assetName);
              $("input[name=eqCodeFormEqdata]").val(res.propTaskMaintenance[0].propAsset.assetCode);
              $("input[name=eqMerkFormEqdata]").val(res.propTaskMaintenance[0].propAsset.propAssetPropgenit.merk);
              $("input[name=eqTypeFormEqdata]").val(res.propTaskMaintenance[0].propAsset.propAssetPropgenit.tipe);
              $("input[name=eqSNFormEqdata]").val(res.propTaskMaintenance[0].propAsset.propAssetPropgenit.serialNumber);
              $("input[name=eqLocationFormEqdata]").val(res.propTaskMaintenance[0].propAsset.propAssetPropadmin.propAssetPropbuildingRoom.roomName);

              $("#startBy").val(res.propProgress.finishBy);
              $("#idStartBy").val(res.propProgress.idFinishBy);

              $("input[name=idTmpItem]").val(res.propTaskMaintenance[0].propForm.propFormTemplateitem.idTmpItem);
              $("input[name=tmpitemEngineer]").val(res.propTaskMaintenance[0].propForm.propFormTemplateitem.tmpitemEngineer);
              $("input[name=tmpitemAlkur]").val(res.propTaskMaintenance[0].propForm.propFormTemplateitem.tmpitemAlkur);
              $("input[name=tmpitemTools]").val(res.propTaskMaintenance[0].propForm.propFormTemplateitem.tmpitemTools);
              $("input[name=tmpitemEncon]").val(res.propTaskMaintenance[0].propForm.propFormTemplateitem.tmpitemEncon);
              $("input[name=tmpitemESM]").val(res.propTaskMaintenance[0].propForm.propFormTemplateitem.tmpitemESM);
              $("input[name=tmpitemFisfung]").val(res.propTaskMaintenance[0].propForm.propFormTemplateitem.tmpitemFisfung);
              $("input[name=tmpitemPerf]").val(res.propTaskMaintenance[0].propForm.propFormTemplateitem.tmpitemPerf);
              $("input[name=tmpitemAction]").val(res.propTaskMaintenance[0].propForm.propFormTemplateitem.tmpitemAction);
              $("input[name=tmpitemUseVendor]").val(res.propTaskMaintenance[0].propForm.propFormTemplateitem.tmpitemUseVendor);

              $('.techassistant_list').DataTable().ajax.url(BASE_URL + "task/med/task_datatable/list_data_pic/" + res.propTaskMaintenance[0].propForm.idForm).load();

              if (res.propTaskMaintenance[0].propForm.propFormTemplateitem.tmpitemUseVendor == false) {
                $("#row-vendor").remove();
              }

              if (res.propTaskMaintenance[0].propForm.propFormTemplateitem.tmpitemEncon == false) {
                $("#table-rooms").remove();
              } else {
                $("input[name=idFpEqdata]").val(res.propTaskMaintenance[0].propForm.propFormEqdata.idFpEqdata);
                $("input[name=idFpEncon]").val(res.propTaskMaintenance[0].propForm.propFormEncon.idFpEncon);
                $("input[name=tempStartFormEncon]").val(res.propTaskMaintenance[0].propForm.propFormEncon.tempStart);
                $("input[name=humidityStartFormEncon]").val(res.propTaskMaintenance[0].propForm.propFormEncon.humidityStart);
              }

              if (res.propTaskMaintenance[0].propForm.propFormTemplateitem.tmpitemEngineer == false) {
                $("#row-teknisi").remove();
              }


              if (res.propTaskMaintenance[0].propForm.propFormTemplateitem.tmpitemAlkur == true && res.propTaskMaintenance[0].propForm.propFormAlkur.length > 0) {
                $("#idFpAlkur0").val(res.propTaskMaintenance[0].propForm.propFormAlkur[0].idFpAlkur);
                $("#idAssetFormAlkur0").val(res.propTaskMaintenance[0].propForm.propFormAlkur[0].idAsset);
                $("#assetNameFormAlkur0").val(res.propTaskMaintenance[0].propForm.propFormAlkur[0].assetName);
                $("#assetMerkFormAlkur0").val(res.propTaskMaintenance[0].propForm.propFormAlkur[0].assetMerk);
                $("#assetTypeFormAlkur0").val(res.propTaskMaintenance[0].propForm.propFormAlkur[0].assetType);
                $("#assetSNFormAlkur0").val(res.propTaskMaintenance[0].propForm.propFormAlkur[0].assetSN);
                for (i = 1; i < res.propTaskMaintenance[0].propForm.propFormAlkur.length; i++) {
                  let rowHtml = `
                      <tr>
                          <td>
                              <input type="hidden" name="idFpAlkur[]" id="idFpAlkur${i}" value="${res.propTaskMaintenance[0].propForm.propFormAlkur[i].idFpAlkur}">
                              <input type="hidden" name="idAssetFormAlkur[]" id="idAssetFormAlkur${i}" value="${res.propTaskMaintenance[0].propForm.propFormAlkur[i].idAsset}">
                              <input class="form-control w-100" type="text" name="assetNameFormAlkur[]" id="assetNameFormAlkur${i}" readonly value="${res.propTaskMaintenance[0].propForm.propFormAlkur[i].assetName}">
                          </td>
                          <td><input class="form-control w-100" type="text" name="assetMerkFormAlkur[]" id="assetMerkFormAlkur${i}" readonly value="${res.propTaskMaintenance[0].propForm.propFormAlkur[i].assetMerk}"></td>
                          <td><input class="form-control w-100" type="text" name="assetTypeFormAlkur[]" id="assetTypeFormAlkur${i}" readonly value="${res.propTaskMaintenance[0].propForm.propFormAlkur[i].assetType}"></td>
                          <td><input class="form-control w-100" type="text" name="assetSNFormAlkur[]" id="assetSNFormAlkur${i}"  readonly value="${res.propTaskMaintenance[0].propForm.propFormAlkur[i].assetSN}"></td>
                          <td class="text-center">
                          <button type="button" class="btn samrs-success pick-tools" id="${i}"> Pick</button>
                          </td>
                      </tr>
                      `;
                  $('.measuringTools tbody').append(rowHtml);
                }
              } else {
                $("#table-measuringtools").remove();
              }


              if (res.propTaskMaintenance[0].propForm.propFormTemplateitem.tmpitemTools == true && res.propTaskMaintenance[0].propForm.propFormTools.length > 0) {
                $("#idFpTools0").val(res.propTaskMaintenance[0].propForm.propFormTools[0].idFpTools);
                $("#idAssetFormTools0").val(res.propTaskMaintenance[0].propForm.propFormTools[0].idAsset);
                $("#assetNameFormTools0").val(res.propTaskMaintenance[0].propForm.propFormTools[0].assetName);
                $("#assetMerkFormTools0").val(res.propTaskMaintenance[0].propForm.propFormTools[0].assetMerk);
                $("#assetTypeFormTools0").val(res.propTaskMaintenance[0].propForm.propFormTools[0].assetType);
                $("#assetSNFormTools0").val(res.propTaskMaintenance[0].propForm.propFormTools[0].assetSN);
                for (i = 1; i < res.propTaskMaintenance[0].propForm.propFormTools.length; i++) {
                  let rowHtmlTools = `
                  <tr>
                    <td>
                        <input class="form-control w-100" type="hidden" name="idFpTools[]" id="idFpTools${i}" value="${res.propTaskMaintenance[0].propForm.propFormTools[i].idFpTools}">
                        <input class="form-control w-100" type="hidden" name="idAssetFormTools[]" id="idAssetFormTools${i}" value="${res.propTaskMaintenance[0].propForm.propFormTools[i].idAsset}">
                        <input class="form-control w-100" type="text" name="assetNameFormTools[]" readonly id="assetNameFormTools${i}" value="${res.propTaskMaintenance[0].propForm.propFormTools[i].assetName}">
                    </td>
                    <td><input class="form-control w-100" type="text" name="assetMerkFormTools[]" readonly id="assetMerkFormTools${i}" value="${res.propTaskMaintenance[0].propForm.propFormTools[i].assetMerk}"></td>
                    <td><input class="form-control w-100" type="text" name="assetTypeFormTools[]" readonly id="assetTypeFormTools${i}" value="${res.propTaskMaintenance[0].propForm.propFormTools[i].assetType}"></td>
                    <td><input class="form-control w-100" type="text" name="assetSNFormTools[]" readonly id="assetSNFormTools${i}" value="${res.propTaskMaintenance[0].propForm.propFormTools[i].assetSN}"></td>
                    <td class="text-center">
                    <button type="button" class="btn samrs-success pick-toolset" id="${i}"> Pick</button>
                    </td>
                  </tr>
                  `;
                  $('.toolsetUsage tbody').append(rowHtmlTools);
                }
              } else {
                $("#table-toolsetusage").remove();
              }


              if (res.propTaskMaintenance[0].propForm.propFormTemplateitem.tmpitemESM == true && res.propTaskMaintenance[0].propForm.propFormElect.length > 0) {

                if (res.propTaskMaintenance[0].propForm.propFormElect[0].electResult == true) {
                  $(`#electResultImg0`).attr("src", BASE_URL + "assets/images/icon/check.png");
                } else {
                  $(`#electResultImg0`).attr("src", BASE_URL + "assets/images/icon/no.png");
                }

                $("#idFpElect0").val(res.propTaskMaintenance[0].propForm.propFormElect[0].idFpElect);
                $("#electParam0").val(res.propTaskMaintenance[0].propForm.propFormElect[0].electParam);
                $("#electMeasure0").val(res.propTaskMaintenance[0].propForm.propFormElect[0].electMeasure);
                $("#electLower0").val(res.propTaskMaintenance[0].propForm.propFormElect[0].electLower);
                $("#electUpper0").val(res.propTaskMaintenance[0].propForm.propFormElect[0].electUpper);
                $("#electUpper0").val(res.propTaskMaintenance[0].propForm.propFormElect[0].electUpper);
                $("#electResult0").val(res.propTaskMaintenance[0].propForm.propFormElect[0].electResult);
                $("#val-electunit0").val(res.propTaskMaintenance[0].propForm.propFormElect[0].electUnit);
                $("#val-electunit0").html(res.propTaskMaintenance[0].propForm.propFormElect[0].electUnit);
                for (i = 1; i < res.propTaskMaintenance[0].propForm.propFormElect.length; i++) {

                  let rowHtml = `
                    <tr>
                        <td>
                        <input type="hidden" name="idFpElect[]" value="${res.propTaskMaintenance[0].propForm.propFormElect[i].idFpElect}">
                        <input class="form-control w-100" type="text" name="electParam[]" value="${res.propTaskMaintenance[0].propForm.propFormElect[i].electParam}" readonly>
                        </td>
                        <td>
                        <div class="d-flex">
                            <input class="form-control w-100 count-elect" data-number="${i}" type="text" id="electMeasure${i}" name="electMeasure[]" value="${res.propTaskMaintenance[0].propForm.propFormElect[i].electMeasure}">
                            <select class="form-control unitSelectElect` + [i] + `" style="width:60%;float:right;" name="electUnit[]" id="electUnit${i}">
                                <option value="${res.propTaskMaintenance[0].propForm.propFormElect[i].electUnit}" id="val-electunit` + [i] + `">${res.propTaskMaintenance[0].propForm.propFormElect[i].electUnit}</option>
                            </select>
                        </div>
                        </td>
                        <td>
                        <div class="d-flex">
                            <input class="form-control w-100" type="text" name="electLower[]" id="electLower${i}" value="${res.propTaskMaintenance[0].propForm.propFormElect[i].electLower}" readonly>

                        </div>
                        </td>
                        <td>
                        <div class="d-flex">
                            <input class="form-control w-100" type="text" name="electUpper[]" id="electUpper${i}" value="${res.propTaskMaintenance[0].propForm.propFormElect[i].electUpper}" readonly>

                        </div>
                        </td>
                        <td class="text-center">
                        <div class="d-flex">

                            <img src="${res.propTaskMaintenance[0].propForm.propFormElect[i].electResult == true ? BASE_URL + "assets/images/icon/check.png" : BASE_URL + "assets/images/icon/no.png"}" id="electResultImg` + [i] + `">
                            <input class="form-control w-100" type="hidden" name="electResult[]" id="electResult${i}" value="${res.propTaskMaintenance[0].propForm.propFormElect[i].electResult}" readonly>
                        </div>
                        </td>

                    </tr>
                    `;
                  $('.electricalSafety tbody').append(rowHtml);
                }
              } else {
                $("#table-electricalsafety").remove();
              }



              if (res.propTaskMaintenance[0].propForm.propFormTemplateitem.tmpitemFisfung == true && res.propTaskMaintenance[0].propForm.propFormFisfung.length > 0) {

                $("#fisfungItem0").val(res.propTaskMaintenance[0].propForm.propFormFisfung[0].fisfungItem);
                $("#idFisfung0").val(res.propTaskMaintenance[0].propForm.propFormFisfung[0].idFisfung);
                if (res.propTaskMaintenance[0].propForm.propFormFisfung[0].fisfungResult == "P") {
                  $("#fisfungResult0P").attr("checked", true);
                  // $("#fisfungResult0F").attr("disabled", true);
                  // $("#fisfungResult0NA").attr("disabled", true);
                } else if (res.propTaskMaintenance[0].propForm.propFormFisfung[0].fisfungResult == "F") {
                  $("#fisfungResult0F").attr("checked", true);
                  // $("#fisfungResult0NA").attr("disabled", true);
                  // $("#fisfungResult0P").attr("disabled", true);
                } else {
                  $("#fisfungResult0NA").attr("checked", true);
                  // $("#fisfungResult0P").attr("disabled", true);
                  // $("#fisfungResult0F").attr("disabled", true);
                }

                for (i = 1; i < res.propTaskMaintenance[0].propForm.propFormFisfung.length; i++) {
                  let rowHtmlGen = `
                  <tr>
                    <td>
                        <input type="hidden" name="idFisfung[${i}]" value="${res.propTaskMaintenance[0].propForm.propFormFisfung[i].idFisfung}">
                        <input class="form-control w-100" type="text" name="fisfungItem[${i}]" value="${res.propTaskMaintenance[0].propForm.propFormFisfung[i].fisfungItem}" readonly>
                    </td>
                    <td>
                      <div class="radio-only-box">
                        <input type="radio" name="fisfungResult[${i}]" ${res.propTaskMaintenance[0].propForm.propFormFisfung[i].fisfungResult == "P" ? "checked"  : ""} value="P">
                      </div>
                    </td>
                    <td>
                      <div class="radio-only-box">
                        <input type="radio" name="fisfungResult[${i}]" ${res.propTaskMaintenance[0].propForm.propFormFisfung[i].fisfungResult == "F" ? "checked"  : ""} value="F">
                      </div>
                    </td>
                    <td>
                      <div class="radio-only-box">
                        <input type="radio" name="fisfungResult[${i}]" ${res.propTaskMaintenance[0].propForm.propFormFisfung[i].fisfungResult == "NA" ? "checked"  : ""} value="NA">
                      </div>
                    </td>
                  </tr>
                  `;
                  $('.qualitativeTask tbody').append(rowHtmlGen);
                }
              } else {
                $("#table-qualitativetask").remove();
              }


              if (res.propTaskMaintenance[0].propForm.propFormTemplateitem.tmpitemAction == true && res.propTaskMaintenance[0].propForm.propFormGen.length > 0) {
                if (res.propTaskMaintenance[0].propForm.propFormGen[0].genResult == "true") {
                  $("#genResult0").attr("checked", true);
                }

                $("#genActionFormGen0").val(res.propTaskMaintenance[0].propForm.propFormGen[0].genAction);
                $("#idGenFormGen0").val(res.propTaskMaintenance[0].propForm.propFormGen[0].idGen);
                for (i = 1; i < res.propTaskMaintenance[0].propForm.propFormGen.length; i++) {
                  let rowHtmlGen = `
                  <tr>
                    <td>
                        <input type="hidden" name="idGenFormGen[${i}]" value="${res.propTaskMaintenance[0].propForm.propFormGen[i].idGen}">
                        <input class="form-control w-100" readonly type="text" name="genActionFormGen[${i}]" value="${res.propTaskMaintenance[0].propForm.propFormGen[i].genAction}" required>
                    </td>
                    <td>
                    <label class="p-10">
                      <input type="checkbox" name="genResult[${i}]" id="genResult${i}" value="true" ${res.propTaskMaintenance[0].propForm.propFormGen[i].genResult == "true" ? "checked"  : ""}>
                      <span class="ml-10">Done</span>
                    </label>
                    </td>

                  </tr>
                  `;
                  $('.actioRecords tbody').append(rowHtmlGen);

                }
              } else {
                $("#table-actiorecords").remove();
              }

              if (res.propTaskMaintenance[0].propForm.propFormTemplateitem.tmpitemPerf == true && res.propTaskMaintenance[0].propForm.propFormUkur.length > 0) {

                if (res.propTaskMaintenance[0].propForm.propFormUkur[0].ukurResult == "true") {
                  $(`#ukurResultImg0`).attr("src", BASE_URL + "assets/images/icon/check.png");
                } else {
                  $(`#ukurResultImg0`).attr("src", BASE_URL + "assets/images/icon/no.png");
                }

                $("#idUkurFormUkur0").val(res.propTaskMaintenance[0].propForm.propFormUkur[0].idUkur);
                $("#ukurSubjectFormUkur0").val(res.propTaskMaintenance[0].propForm.propFormUkur[0].ukurSubject);
                $("#ukurSetFormUkur0").val(res.propTaskMaintenance[0].propForm.propFormUkur[0].ukurSet);
                $("#ukurValFormUkur0").val(res.propTaskMaintenance[0].propForm.propFormUkur[0].ukurVal);
                $("#ukurMinFormUkur0").val(res.propTaskMaintenance[0].propForm.propFormUkur[0].ukurMin);
                $("#ukurMaxFormUkur0").val(res.propTaskMaintenance[0].propForm.propFormUkur[0].ukurMax);
                $("#ukurResult0").val(res.propTaskMaintenance[0].propForm.propFormUkur[0].ukurResult);
                $("#val-ukurUnitFormUkurB0").val(res.propTaskMaintenance[0].propForm.propFormUkur[0].ukurUnit);
                $("#val-ukurUnitFormUkurB0").html(res.propTaskMaintenance[0].propForm.propFormUkur[0].ukurUnit);
                $("#val-ukurUnitFormUkur0").val(res.propTaskMaintenance[0].propForm.propFormUkur[0].ukurUnit);
                $("#val-ukurUnitFormUkur0").html(res.propTaskMaintenance[0].propForm.propFormUkur[0].ukurUnit);

                for (i = 1; i < res.propTaskMaintenance[0].propForm.propFormUkur.length; i++) {
                  let rowHtml = `
                  <tr>
                      <td>
                          <input type="hidden" value="${res.propTaskMaintenance[0].propForm.propFormUkur[i].idUkur}" name="idUkurFormUkur[]" id="idUkurFormUkur` + [i] + `">
                          <input class="form-control" type="text" name="ukurSubjectFormUkur[]" value="${res.propTaskMaintenance[0].propForm.propFormUkur[i].ukurSubject}" id="ukurSubjectFormUkur` + [i] + `" readonly>
                      </td>
                      <td>
                        <div class="d-flex">
                          <input class="form-control id-set-ukur" value="${res.propTaskMaintenance[0].propForm.propFormUkur[i].ukurSet}" style="text-align: center; width:40%;float:left;" type="text" name="ukurSetFormUkur[]"
                              id="ukurSetFormUkur` + [i] + `" readonly>
                          <select class="form-control unitSelect` + [i] + `" style="width:60%;float:right;">
                            <option value="${res.propTaskMaintenance[0].propForm.propFormUkur[i].ukurUnit}" id="val-ukurUnitFormUkurB` + [i] + `">${res.propTaskMaintenance[0].propForm.propFormUkur[i].ukurUnit}</option>
                          </select>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex">
                          <input class="form-control count-val" type="text" data-number="${i}" name="ukurVal[]" style="text-align: center; width:40%;float:left;" value="${res.propTaskMaintenance[0].propForm.propFormUkur[i].ukurVal}" id="ukurValFormUkur` + [i] + `">
                          <select class="form-control unitSelect` + [i] + `" style="width:60%;float:right;" name="ukurUnitFormUkur[]" id="ukurUnitFormUkur` + [i] + `">
                            <option value="${res.propTaskMaintenance[0].propForm.propFormUkur[i].ukurUnit}" id="val-ukurUnitFormUkur` + [i] + `">${res.propTaskMaintenance[0].propForm.propFormUkur[i].ukurUnit}</option>
                          </select>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex">
                          <input class="form-control" type="text"  name="ukurMinFormUkur[]" readonly value="${res.propTaskMaintenance[0].propForm.propFormUkur[i].ukurMin}" id="ukurMinFormUkur` + [i] + `" >

                        </div>
                      </td>
                      <td>
                        <div class="d-flex">
                          <input class="form-control" type="text"  name="ukurMaxFormUkur[]" readonly value="${res.propTaskMaintenance[0].propForm.propFormUkur[i].ukurMax}" id="ukurMaxFormUkur` + [i] + `" >

                        </div>
                      </td>
                      <td class="text-center">
                      <img src="${res.propTaskMaintenance[0].propForm.propFormUkur[i].ukurResult == "true" ? BASE_URL + "assets/images/icon/check.png" : BASE_URL + "assets/images/icon/no.png"}" id="ukurResultImg` + [i] + `">
                      <input class="form-control" type="hidden"  name="ukurResultFormUkur[]"  id="ukurResult` + [i] + `" value="${res.propTaskMaintenance[0].propForm.propFormUkur[i].ukurResult}" readonly>
                      </td>

                  </tr>`;
                  // this.$option.mounted.loadSelect2([i]);
                  $('.quantitativeTask tbody').append(rowHtml);
                }
              } else {
                $("#table-quantitativetask").remove();
              }


              if (res.propTaskMaintenance[0].propForm.propFormPart.length > 0) {

                for (i = 0; i < res.propTaskMaintenance[0].propForm.propFormPart.length; i++) {
                  let rowHtml = `
                  <tr>
                      <td>
                        <input type="hidden" name="idAssetPart[${i}]" id="idAssetPart${i}" value="${res.propTaskMaintenance[0].propForm.propFormPart[i].idAssetPart}">
                        <input type="hidden" name="idFPart[${i}]" id="idFPart${i}" value="${res.propTaskMaintenance[0].propForm.propFormPart[i].idFPart}">

                          <input class="form-control w-100" type="text" readonly name="partName[${i}]" value="${res.propTaskMaintenance[0].propForm.propFormPart[i].partName}" id="partName${i}">
                      </td>
                      <td>
                          <input class="form-control w-100" type="text" readonly onkeypress="return hanyaAngka(event)" value="${res.propTaskMaintenance[0].propForm.propFormPart[i].partPrice / res.propTaskMaintenance[0].propForm.propFormPart[i].partQTY}" name="assetPriceMaintenanceMaterial[${i}]" id="assetPriceMaintenanceMaterial${i}">
                      </td>
                      <td>
                          <input class="form-control w-100 count-qty" data-num="${i}" type="text" value="${res.propTaskMaintenance[0].propForm.propFormPart[i].partQTY}" onkeypress="return hanyaAngka(event)" name="partQTY[${i}]" id="partQTY${i}">
                      </td>
                      <td>
                          <input class="form-control w-100" type="text" onkeypress="return hanyaAngka(event)" value="${res.propTaskMaintenance[0].propForm.propFormPart[i].partPrice}" name="partPrice[${i}]" id="partPrice${i}">
                      </td>
                      <td class="text-center">
                  <button type="button" class="btn samrs-primary pick-parts" id="${i}">Pick Asset</button>
                  <button type="button" class="btn samrs-danger removeRowsMaterial"><i class="fas fa-times"></i> Remove</button>
              </td>
                  </tr>
                  `;
                  $('.maintenaceMaterial tbody').append(rowHtml);

                  $('.removeRowsMaterial').on('click', function() {
                    $(this).parents('tr').remove();
                  });
                }
              }
              $("input[name=kpi_point]").val(res.taskKpi);
              $("input[name=service_price]").val(res.taskAmount);
              $("#maintenanceNote").val(res.propTaskMaintenance[0].maintenanceNote);

              if (res.propTaskMaintenance[0].propForm.finalResult == "Baik") {
                $("#finalResultBaik").attr("checked", true);
                // $("#finalResultRingan").attr("disabled", true);
                // $("#finalResultBerat").attr("disabled", true);
                // $("#finalResultNot").attr("disabled", true);
              } else if (res.propTaskMaintenance[0].propForm.finalResult == "Rusak Ringan") {
                // $("#finalResultBaik").attr("disabled", true);
                $("#finalResultRingan").attr("checked", true);
                // $("#finalResultBerat").attr("disabled", true);
                // $("#finalResultNot").attr("disabled", true);
              } else if (res.propTaskMaintenance[0].propForm.finalResult == "Rusak Berat") {
                // $("#finalResultBaik").attr("disabled", true);
                // $("#finalResultRingan").attr("disabled", true);
                $("#finalResultBerat").attr("checked", true);
                // $("#finalResultNot").attr("disabled", true);
              } else {
                // $("#finalResultBaik").attr("disabled", true);
                // $("#finalResultRingan").attr("disabled", true);
                // $("#finalResultBerat").attr("disabled", true);
                $("#finalResultNot").attr("checked", true);
              }

            }
          });


        } else {
          $('#maintenance_times').modal('show');
          $.ajax({
            type: "POST",
            url: BASE_URL + "task/non/maintenance/schedule_report/task_by_id",
            data: {
              'idTask': idTask
            },
            dataType: "json",
            success: function(res) {
              $("input[name=idTaskEditTimes]").val(res.idTask);
              $("input[name=codeEditTimes]").val(res.propTaskMaintenance[0].propAsset.assetCode);
              $("input[name=assetnameEditTimes]").val(res.propTaskMaintenance[0].propAsset.assetName);
              $("input[name=merkEditTimes]").val(res.propTaskMaintenance[0].propAsset.propAssetPropgenit.merk);
              $("input[name=tipeEditTimes]").val(res.propTaskMaintenance[0].propAsset.propAssetPropgenit.tipe);
              $("input[name=snEditTimes]").val(res.propTaskMaintenance[0].propAsset.propAssetPropgenit.serialNumber);
              $("input[name=roomEditTimes]").val(res.propTaskMaintenance[0].propAsset.propAssetPropadmin.propAssetPropbuildingRoom.roomName);
              $("input[name=scheduleStartEdit]").val(res.propSchedule.scheduleStart);

              $('.selectpicker').html('');

              $.each(res.formTemplate, function(index, value) {
                // darle un option con los valores asignados a la variable select
                $('.selectpicker').append('<option value="' + value.idFormTemplate + '">' + value.ftCode + '</option>');
              });
              $('select[name=formTemplateEdit]').val(res.propTaskMaintenance[0].idFormTemplate).change();

              $('.selectpicker').selectpicker('refresh');
            }
          });
        }

      } else {
        Swal.fire({
          icon: 'warning',
          title: 'Oops...',
          text: (idTask.length > 1) ? "You choose more than 1 item, please choose one item to be edited" : "Select Items to be Edited",
        });
      }
    });
  }

  function detail() {
    $("#modal_detail_maintenance").click(function() {
      var idTask = [];
      // Read all checked checkboxes
      $("input:checkbox[class=delete_check]:checked").each(function() {
        idTask.push($(this).val());
      });

      if (idTask.length == 1) {
        $("#maintenance_form_edit").modal('show');
        $("#title-report-main").html("detail form maintenance");
        $(".report-footer").css({
          'display': 'none'
        });
        $(".report-print").css({
          'display': ''
        });
        $("#th-option-alkur").css({
          'display': 'none'
        });
        $("#td-option-alkur").css({
          'display': 'none'
        });
        $("#th-option-tools").css({
          'display': 'none'
        });
        $("#td-option-tools").css({
          'display': 'none'
        });
        $("#th-option-material").css({
          'display': 'none'
        });
        $("#td-option-material").css({
          'display': 'none'
        });
        $("#btn-option-material").css({
          'display': 'none'
        });
        $("#td-result-worksheet").css({
          'display': 'none'
        });
        $("#electMeasure0").attr("readonly", true);
        $("#ukurValFormUkur0").attr("readonly", true);
        $("#assetQuantityMaintenanceMaterial0").attr("readonly", true);
        $("#assetTotalPriceMaintenanceMaterial0").attr("readonly", true);
        $("input[name=tempStartFormEncon]").attr("readonly", true);
        $("input[name=humidityStartFormEncon]").attr("readonly", true);
        $("input[name=kpi_point]").attr("readonly", true);
        $("input[name=service_price]").attr("readonly", true);

        $("#idVendor").removeAttr('id');

        let url_action_approve = "";
        $("#app_form_edit").attr("action", url_action_approve)

        $.ajax({
          type: "POST",
          url: BASE_URL + "task/non/maintenance/schedule_report/approve_id_task",
          data: {
            'idTask': idTask
          },
          dataType: "json",
          success: function(res) {
            if (res.idVendor != 0) {
              $("#option-vendor").val(res.idVendor).change();
              $("#option-vendor").html(res.propContact.contactCompany);
            }

            $("#addSignatureChairman").remove();
            $("#addDrawChairman").remove();
            $("#addDrawTeknisi").remove();
            $("#addSignatureTeknisi").remove();
            $("#btn-addteknisi").remove();

            let signHashChairman = res.approveSign.search("DRAW");
            if (res.approveSign != "") {
              if (signHashChairman == 0) {
                $(`#drawOtpChairman`).attr("src", BASE_URL + "assets/upload/file/" + res.approveSign.substr(5));
              } else {
                $(`#drawOtpChairman`).attr("src", res.approveSign);
              }
            }

            $(".signature-teknisi").html(res.propProgress.finishBy);

            let signHash = res.finishSign.search("DRAW");
            if (res.finishSign != "") {
              if (signHash == 0) {
                $(`#drawOtpTeknisi`).attr("src", BASE_URL + "assets/upload/file/" + res.finishSign.substr(5));
              } else {
                $(`#drawOtpTeknisi`).attr("src", res.finishSign);
              }
            }


            $(".signature-teknisi").html(res.propProgress.finishBy);

            if (res.propProgress.approveBy != "") {
              $(".signature-chairman").html(res.propProgress.approveBy);
            }
            $("input[name=idAssigneeChairman]").val(res.propProgress.idAssignee);

            $("#createdDate").val(res.timeFinish);
            $("#idtask").val(res.idTask);
            $("#idTaskSignature").val(res.idTask);
            $("#idForm").val(res.propTaskMaintenance[0].propForm.idForm);
            $("#ftCode").val(res.propTaskMaintenance[0].propForm.formCode);
            $("#idFormTemplate").val(res.propTaskMaintenance[0].idFormTemplate);
            $("#idasset").val(res.propTaskMaintenance[0].idAsset);
            $("#asset-master").val(res.propTaskMaintenance[0].propAsset.assetName);
            $("#planning-date").val(res.propSchedule.scheduleStart);
            $("input[name=eqNameFormEqdata]").val(res.propTaskMaintenance[0].propAsset.assetName);
            $("input[name=eqCodeFormEqdata]").val(res.propTaskMaintenance[0].propAsset.assetCode);
            $("input[name=eqMerkFormEqdata]").val(res.propTaskMaintenance[0].propAsset.propAssetPropgenit.merk);
            $("input[name=eqTypeFormEqdata]").val(res.propTaskMaintenance[0].propAsset.propAssetPropgenit.tipe);
            $("input[name=eqSNFormEqdata]").val(res.propTaskMaintenance[0].propAsset.propAssetPropgenit.serialNumber);
            $("input[name=eqLocationFormEqdata]").val(res.propTaskMaintenance[0].propAsset.propAssetPropadmin.propAssetPropbuildingRoom.roomName);

            $("#startBy").val(res.propProgress.finishBy);
            $("#idStartBy").val(res.propProgress.idFinishBy);

            var dt = $('.techassistant_list').DataTable().ajax.url(BASE_URL + "task/med/task_datatable/list_data_pic/" + res.propTaskMaintenance[0].propForm.idForm).load();

            //hide the first column
            dt.column(2).visible(false);

            if (res.propTaskMaintenance[0].propForm.propFormTemplateitem.tmpitemUseVendor == false) {
              $("#row-vendor").remove();
            }

            if (res.propTaskMaintenance[0].propForm.propFormTemplateitem.tmpitemEncon == false) {
              $("#table-rooms").remove();
            } else {
              $("input[name=idFpEqdata]").val(res.propTaskMaintenance[0].propForm.propFormEqdata.idFpEqdata);
              $("input[name=idFpEncon]").val(res.propTaskMaintenance[0].propForm.propFormEncon.idFpEncon);
              $("input[name=tempStartFormEncon]").val(res.propTaskMaintenance[0].propForm.propFormEncon.tempStart);
              $("input[name=humidityStartFormEncon]").val(res.propTaskMaintenance[0].propForm.propFormEncon.humidityStart);
            }

            if (res.propTaskMaintenance[0].propForm.propFormTemplateitem.tmpitemEngineer == false) {
              $("#row-teknisi").remove();
            }


            if (res.propTaskMaintenance[0].propForm.propFormTemplateitem.tmpitemAlkur == true && res.propTaskMaintenance[0].propForm.propFormAlkur.length > 0) {
              $("#idFpAlkur0").val(res.propTaskMaintenance[0].propForm.propFormAlkur[0].idFpAlkur);
              $("#idAssetFormAlkur0").val(res.propTaskMaintenance[0].propForm.propFormAlkur[0].idAsset);
              $("#assetNameFormAlkur0").val(res.propTaskMaintenance[0].propForm.propFormAlkur[0].assetName);
              $("#assetMerkFormAlkur0").val(res.propTaskMaintenance[0].propForm.propFormAlkur[0].assetMerk);
              $("#assetTypeFormAlkur0").val(res.propTaskMaintenance[0].propForm.propFormAlkur[0].assetType);
              $("#assetSNFormAlkur0").val(res.propTaskMaintenance[0].propForm.propFormAlkur[0].assetSN);

              for (i = 1; i < res.propTaskMaintenance[0].propForm.propFormAlkur.length; i++) {
                let rowHtml = `
                      <tr>
                          <td>
                              <input type="hidden" name="idFpAlkur[]" id="idFpAlkur${i}" value="${res.propTaskMaintenance[0].propForm.propFormAlkur[i].idFpAlkur}">
                              <input type="hidden" name="idAssetFormAlkur[]" id="idAssetFormAlkur${i}" value="${res.propTaskMaintenance[0].propForm.propFormAlkur[i].idAsset}">
                              <input class="form-control w-100" type="text" name="assetNameFormAlkur[]" id="assetNameFormAlkur${i}" readonly value="${res.propTaskMaintenance[0].propForm.propFormAlkur[i].assetName}">
                          </td>
                          <td><input class="form-control w-100" type="text" name="assetMerkFormAlkur[]" id="assetMerkFormAlkur${i}" readonly value="${res.propTaskMaintenance[0].propForm.propFormAlkur[i].assetMerk}"></td>
                          <td><input class="form-control w-100" type="text" name="assetTypeFormAlkur[]" id="assetTypeFormAlkur${i}" readonly value="${res.propTaskMaintenance[0].propForm.propFormAlkur[i].assetType}"></td>
                          <td><input class="form-control w-100" type="text" name="assetSNFormAlkur[]" id="assetSNFormAlkur${i}"  readonly value="${res.propTaskMaintenance[0].propForm.propFormAlkur[i].assetSN}"></td>

                      </tr>
                      `;
                $('.measuringTools tbody').append(rowHtml);
              }
            } else {
              $("#table-measuringtools").remove();
            }


            if (res.propTaskMaintenance[0].propForm.propFormTemplateitem.tmpitemTools == true && res.propTaskMaintenance[0].propForm.propFormTools.length > 0) {
              $("#idFpTools0").val(res.propTaskMaintenance[0].propForm.propFormTools[0].idFpTools);
              $("#idAssetFormTools0").val(res.propTaskMaintenance[0].propForm.propFormTools[0].idAsset);
              $("#assetNameFormTools0").val(res.propTaskMaintenance[0].propForm.propFormTools[0].assetName);
              $("#assetMerkFormTools0").val(res.propTaskMaintenance[0].propForm.propFormTools[0].assetMerk);
              $("#assetTypeFormTools0").val(res.propTaskMaintenance[0].propForm.propFormTools[0].assetType);
              $("#assetSNFormTools0").val(res.propTaskMaintenance[0].propForm.propFormTools[0].assetSN);
              for (i = 1; i < res.propTaskMaintenance[0].propForm.propFormTools.length; i++) {
                let rowHtmlTools = `
                  <tr>
                    <td>
                        <input class="form-control w-100" type="hidden" name="idFpTools[]" id="idFpTools${i}" value="${res.propTaskMaintenance[0].propForm.propFormTools[i].idFpTools}">
                        <input class="form-control w-100" type="hidden" name="idAssetFormTools[]" id="idAssetFormTools${i}" value="${res.propTaskMaintenance[0].propForm.propFormTools[i].idAsset}">
                        <input class="form-control w-100" type="text" name="assetNameFormTools[]" readonly id="assetNameFormTools${i}" value="${res.propTaskMaintenance[0].propForm.propFormTools[i].assetName}">
                    </td>
                    <td><input class="form-control w-100" type="text" name="assetMerkFormTools[]" readonly id="assetMerkFormTools${i}" value="${res.propTaskMaintenance[0].propForm.propFormTools[i].assetMerk}"></td>
                    <td><input class="form-control w-100" type="text" name="assetTypeFormTools[]" readonly id="assetTypeFormTools${i}" value="${res.propTaskMaintenance[0].propForm.propFormTools[i].assetType}"></td>
                    <td><input class="form-control w-100" type="text" name="assetSNFormTools[]" readonly id="assetSNFormTools${i}" value="${res.propTaskMaintenance[0].propForm.propFormTools[i].assetSN}"></td>

                  </tr>
                  `;
                $('.toolsetUsage tbody').append(rowHtmlTools);
              }
            } else {
              $("#table-toolsetusage").remove();
            }

            if (res.propTaskMaintenance[0].propForm.propFormTemplateitem.tmpitemESM == true && res.propTaskMaintenance[0].propForm.propFormElect.length > 0) {

              if (res.propTaskMaintenance[0].propForm.propFormElect[0].electResult == true) {
                $(`#electResultImg0`).attr("src", BASE_URL + "assets/images/icon/check.png");
              } else {
                $(`#electResultImg0`).attr("src", BASE_URL + "assets/images/icon/no.png");
              }

              $("#idFpElect0").val(res.propTaskMaintenance[0].propForm.propFormElect[0].idFpElect);
              $("#electParam0").val(res.propTaskMaintenance[0].propForm.propFormElect[0].electParam);
              $("#electMeasure0").val(res.propTaskMaintenance[0].propForm.propFormElect[0].electMeasure);
              $("#electLower0").val(res.propTaskMaintenance[0].propForm.propFormElect[0].electLower);
              $("#electUpper0").val(res.propTaskMaintenance[0].propForm.propFormElect[0].electUpper);
              $("#electUpper0").val(res.propTaskMaintenance[0].propForm.propFormElect[0].electUpper);
              $("#electResult0").val(res.propTaskMaintenance[0].propForm.propFormElect[0].electResult);
              $("#val-electunit0").val(res.propTaskMaintenance[0].propForm.propFormElect[0].electUnit);
              $("#val-electunit0").html(res.propTaskMaintenance[0].propForm.propFormElect[0].electUnit);
              for (i = 1; i < res.propTaskMaintenance[0].propForm.propFormElect.length; i++) {

                let rowHtml = `
                    <tr>
                        <td>
                        <input type="hidden" name="idFpElect[]" value="${res.propTaskMaintenance[0].propForm.propFormElect[i].idFpElect}">
                        <input class="form-control w-100" type="text" name="electParam[]" value="${res.propTaskMaintenance[0].propForm.propFormElect[i].electParam}" readonly>
                        </td>
                        <td>
                        <div class="d-flex">
                            <input class="form-control w-100 count-elect" readonly data-number="${i}" type="text" id="electMeasure${i}" name="electMeasure[]" value="${res.propTaskMaintenance[0].propForm.propFormElect[i].electMeasure}">
                            <select class="form-control unitSelectElect` + [i] + `" style="width:60%;float:right;" name="electUnit[]" id="electUnit${i}">
                                <option value="${res.propTaskMaintenance[0].propForm.propFormElect[i].electUnit}" id="val-electunit` + [i] + `">${res.propTaskMaintenance[0].propForm.propFormElect[i].electUnit}</option>
                            </select>
                        </div>
                        </td>
                        <td>
                        <div class="d-flex">
                            <input class="form-control w-100" type="text" name="electLower[]" id="electLower${i}" value="${res.propTaskMaintenance[0].propForm.propFormElect[i].electLower}" readonly>

                        </div>
                        </td>
                        <td>
                        <div class="d-flex">
                            <input class="form-control w-100" type="text" name="electUpper[]" id="electUpper${i}" value="${res.propTaskMaintenance[0].propForm.propFormElect[i].electUpper}" readonly>

                        </div>
                        </td>
                        <td class="text-center">
                        <div class="d-flex">

                            <img src="${res.propTaskMaintenance[0].propForm.propFormElect[i].electResult == true ? BASE_URL + "assets/images/icon/check.png" : BASE_URL + "assets/images/icon/no.png"}" id="electResultImg` + [i] + `">
                            <input class="form-control w-100" type="hidden" name="electResult[]" id="electResult${i}" value="${res.propTaskMaintenance[0].propForm.propFormElect[i].electResult}" readonly>
                        </div>
                        </td>

                    </tr>
                    `;
                $('.electricalSafety tbody').append(rowHtml);
              }
            } else {
              $("#table-electricalsafety").remove();
            }

            if (res.propTaskMaintenance[0].propForm.propFormTemplateitem.tmpitemFisfung == true && res.propTaskMaintenance[0].propForm.propFormFisfung.length > 0) {

              $("#fisfungItem0").val(res.propTaskMaintenance[0].propForm.propFormFisfung[0].fisfungItem);
              $("#idFisfung0").val(res.propTaskMaintenance[0].propForm.propFormFisfung[0].idFisfung);
              if (res.propTaskMaintenance[0].propForm.propFormFisfung[0].fisfungResult == "P") {
                $("#fisfungResult0P").attr("checked", true);
                $("#fisfungResult0F").attr("disabled", true);
                $("#fisfungResult0NA").attr("disabled", true);
              } else if (res.propTaskMaintenance[0].propForm.propFormFisfung[0].fisfungResult == "F") {
                $("#fisfungResult0F").attr("checked", true);
                $("#fisfungResult0NA").attr("disabled", true);
                $("#fisfungResult0P").attr("disabled", true);
              } else {
                $("#fisfungResult0NA").attr("checked", true);
                $("#fisfungResult0P").attr("disabled", true);
                $("#fisfungResult0F").attr("disabled", true);
              }

              for (i = 1; i < res.propTaskMaintenance[0].propForm.propFormFisfung.length; i++) {
                let rowHtmlGen = `
                      <tr>
                        <td>
                            <input type="hidden" name="idFisfung[${i}]" value="${res.propTaskMaintenance[0].propForm.propFormFisfung[i].idFisfung}">
                            <input class="form-control w-100" type="text" name="fisfungItem[${i}]" value="${res.propTaskMaintenance[0].propForm.propFormFisfung[i].fisfungItem}" readonly>
                        </td>
                        <td>
                          <div class="radio-only-box">
                            <input type="radio" name="fisfungResult[${i}]" ${res.propTaskMaintenance[0].propForm.propFormFisfung[i].fisfungResult == "P" ? "checked"  : "disabled"} value="P">
                          </div>
                        </td>
                        <td>
                          <div class="radio-only-box">
                            <input type="radio" name="fisfungResult[${i}]" ${res.propTaskMaintenance[0].propForm.propFormFisfung[i].fisfungResult == "F" ? "checked"  : "disabled"} value="F">
                          </div>
                        </td>
                        <td>
                          <div class="radio-only-box">
                            <input type="radio" name="fisfungResult[${i}]" ${res.propTaskMaintenance[0].propForm.propFormFisfung[i].fisfungResult == "NA" ? "checked"  : "disabled"} value="NA">
                          </div>
                        </td>
                      </tr>
                      `;
                $('.qualitativeTask tbody').append(rowHtmlGen);
              }
            } else {
              $("#table-qualitativetask").remove();
            }


            if (res.propTaskMaintenance[0].propForm.propFormTemplateitem.tmpitemAction == true && res.propTaskMaintenance[0].propForm.propFormGen.length > 0) {
              if (res.propTaskMaintenance[0].propForm.propFormGen[0].genResult == "true") {
                $("#genResult0").attr("checked", true);
                $("#genResult0").attr("disabled", false);
              } else {
                $("#genResult0").attr("checked", false);
                $("#genResult0").attr("disabled", true);
              }

              $("#genActionFormGen0").val(res.propTaskMaintenance[0].propForm.propFormGen[0].genAction);
              $("#idGenFormGen0").val(res.propTaskMaintenance[0].propForm.propFormGen[0].idGen);
              for (i = 1; i < res.propTaskMaintenance[0].propForm.propFormGen.length; i++) {
                let rowHtmlGen = `
                    <tr>
                      <td>
                          <input type="hidden" name="idGenFormGen[${i}]" value="${res.propTaskMaintenance[0].propForm.propFormGen[i].idGen}">
                          <input class="form-control w-100" readonly type="text" name="genActionFormGen[${i}]" value="${res.propTaskMaintenance[0].propForm.propFormGen[i].genAction}" required>
                      </td>
                      <td>
                      <label class="p-10">
                        <input type="checkbox" name="genResult[${i}]" id="genResult${i}" value="true" ${res.propTaskMaintenance[0].propForm.propFormGen[i].genResult == "true" ? "checked"  : "disabled"}>
                        <span class="ml-10">Done</span>
                      </label>
                      </td>

                    </tr>
                    `;
                $('.actioRecords tbody').append(rowHtmlGen);

              }
            } else {
              $("#table-actiorecords").remove();
            }


            if (res.propTaskMaintenance[0].propForm.propFormTemplateitem.tmpitemPerf == true && res.propTaskMaintenance[0].propForm.propFormUkur.length > 0) {
              if (res.propTaskMaintenance[0].propForm.propFormUkur[0].ukurResult == "true") {
                $(`#ukurResultImg0`).attr("src", BASE_URL + "assets/images/icon/check.png");
              } else {
                $(`#ukurResultImg0`).attr("src", BASE_URL + "assets/images/icon/no.png");
              }

              $("#idUkurFormUkur0").val(res.propTaskMaintenance[0].propForm.propFormUkur[0].idUkur);
              $("#ukurSubjectFormUkur0").val(res.propTaskMaintenance[0].propForm.propFormUkur[0].ukurSubject);
              $("#ukurSetFormUkur0").val(res.propTaskMaintenance[0].propForm.propFormUkur[0].ukurSet);
              $("#ukurValFormUkur0").val(res.propTaskMaintenance[0].propForm.propFormUkur[0].ukurVal);
              $("#ukurMinFormUkur0").val(res.propTaskMaintenance[0].propForm.propFormUkur[0].ukurMin);
              $("#ukurMaxFormUkur0").val(res.propTaskMaintenance[0].propForm.propFormUkur[0].ukurMax);
              $("#ukurResult0").val(res.propTaskMaintenance[0].propForm.propFormUkur[0].ukurResult);
              $("#val-ukurUnitFormUkurB0").val(res.propTaskMaintenance[0].propForm.propFormUkur[0].ukurUnit);
              $("#val-ukurUnitFormUkurB0").html(res.propTaskMaintenance[0].propForm.propFormUkur[0].ukurUnit);
              $("#val-ukurUnitFormUkur0").val(res.propTaskMaintenance[0].propForm.propFormUkur[0].ukurUnit);
              $("#val-ukurUnitFormUkur0").html(res.propTaskMaintenance[0].propForm.propFormUkur[0].ukurUnit);
              for (i = 1; i < res.propTaskMaintenance[0].propForm.propFormUkur.length; i++) {
                let rowHtml = `
                  <tr>
                      <td>
                          <input type="hidden" value="${res.propTaskMaintenance[0].propForm.propFormUkur[i].idUkur}" name="idUkurFormUkur[]" id="idUkurFormUkur` + [i] + `">
                          <input class="form-control" type="text" name="ukurSubjectFormUkur[]" value="${res.propTaskMaintenance[0].propForm.propFormUkur[i].ukurSubject}" id="ukurSubjectFormUkur` + [i] + `" readonly>
                      </td>
                      <td>
                        <div class="d-flex">
                          <input class="form-control id-set-ukur" value="${res.propTaskMaintenance[0].propForm.propFormUkur[i].ukurSet}" style="text-align: center; width:40%;float:left;" type="text" name="ukurSetFormUkur[]"
                              id="ukurSetFormUkur` + [i] + `" readonly>
                          <select class="form-control unitSelect` + [i] + `" style="width:60%;float:right;">
                            <option value="${res.propTaskMaintenance[0].propForm.propFormUkur[i].ukurUnit}" id="val-ukurUnitFormUkurB` + [i] + `">${res.propTaskMaintenance[0].propForm.propFormUkur[i].ukurUnit}</option>
                          </select>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex">
                          <input class="form-control count-val" type="text" readonly data-number="${i}" name="ukurVal[]" style="text-align: center; width:40%;float:left;" value="${res.propTaskMaintenance[0].propForm.propFormUkur[i].ukurVal}" id="ukurValFormUkur` + [i] + `">
                          <select class="form-control unitSelect` + [i] + `" style="width:60%;float:right;" name="ukurUnitFormUkur[]" id="ukurUnitFormUkur` + [i] + `">
                            <option value="${res.propTaskMaintenance[0].propForm.propFormUkur[i].ukurUnit}" id="val-ukurUnitFormUkur` + [i] + `">${res.propTaskMaintenance[0].propForm.propFormUkur[i].ukurUnit}</option>
                          </select>
                        </div>
                      </td>
                      <td>
                        <div class="d-flex">
                          <input class="form-control" type="text"  name="ukurMinFormUkur[]" readonly value="${res.propTaskMaintenance[0].propForm.propFormUkur[i].ukurMin}" id="ukurMinFormUkur` + [i] + `" >

                        </div>
                      </td>
                      <td>
                        <div class="d-flex">
                          <input class="form-control" type="text"  name="ukurMaxFormUkur[]" readonly value="${res.propTaskMaintenance[0].propForm.propFormUkur[i].ukurMax}" id="ukurMaxFormUkur` + [i] + `" >

                        </div>
                      </td>
                      <td class="text-center">
                      <img src="${res.propTaskMaintenance[0].propForm.propFormUkur[i].ukurResult == "true" ? BASE_URL + "assets/images/icon/check.png" : BASE_URL + "assets/images/icon/no.png"}" id="ukurResultImg` + [i] + `">
                      <input class="form-control" type="hidden"  name="ukurResultFormUkur[]"  id="ukurResult` + [i] + `" value="${res.propTaskMaintenance[0].propForm.propFormUkur[i].ukurResult}" readonly>
                      </td>

                  </tr>`;
                // this.$option.mounted.loadSelect2([i]);
                $('.quantitativeTask tbody').append(rowHtml);
              }
            } else {
              $("#table-quantitativetask").remove();
            }


            if (res.propTaskMaintenance[0].propForm.propFormPart.length > 0) {
              for (i = 0; i < res.propTaskMaintenance[0].propForm.propFormPart.length; i++) {
                let rowHtml = `
                  <tr>
                      <td>
                        <input type="hidden" name="idAssetPart[]" id="idAssetPart${i}" value="${res.propTaskMaintenance[0].propForm.propFormPart[i].idAssetPart}">
                        <input type="hidden" name="idFPart[]" id="idFPart${i}" value="${res.propTaskMaintenance[0].propForm.propFormPart[i].idFPart}">

                          <input class="form-control w-100" type="text" readonly name="partName[]" value="${res.propTaskMaintenance[0].propForm.propFormPart[i].partName}" id="partName${i}">
                      </td>
                      <td>
                          <input class="form-control w-100" type="text" readonly onkeypress="return hanyaAngka(event)" value="${res.propTaskMaintenance[0].propForm.propFormPart[i].partPrice / res.propTaskMaintenance[0].propForm.propFormPart[i].partQTY}" name="assetPriceMaintenanceMaterial[]" id="assetPriceMaintenanceMaterial${i}">
                      </td>
                      <td>
                          <input class="form-control w-100 count-qty" readonly data-num="${i}" type="text" value="${res.propTaskMaintenance[0].propForm.propFormPart[i].partQTY}" onkeypress="return hanyaAngka(event)" name="partQTY[]" id="partQTY${i}">
                      </td>
                      <td>
                          <input class="form-control w-100" type="text" readonly onkeypress="return hanyaAngka(event)" value="${res.propTaskMaintenance[0].propForm.propFormPart[i].partPrice}" name="partPrice[]" id="partPrice${i}">
                      </td>

                  </tr>
                  `;
                $('.maintenaceMaterial tbody').append(rowHtml);
              }
            }
            $("input[name=kpi_point]").val(res.taskKpi);
            $("input[name=service_price]").val(res.taskAmount);
            $("#maintenanceNote").val(res.propTaskMaintenance[0].maintenanceNote);

            $("#maintenanceNote").attr("disabled", true);

            if (res.propTaskMaintenance[0].propForm.finalResult == "Baik") {
              $("#finalResultBaik").attr("checked", true);
              $("#finalResultRingan").attr("disabled", true);
              $("#finalResultBerat").attr("disabled", true);
              $("#finalResultNot").attr("disabled", true);
            } else if (res.propTaskMaintenance[0].propForm.finalResult == "Rusak Ringan") {
              $("#finalResultBaik").attr("disabled", true);
              $("#finalResultRingan").attr("checked", true);
              $("#finalResultBerat").attr("disabled", true);
              $("#finalResultNot").attr("disabled", true);
            } else if (res.propTaskMaintenance[0].propForm.finalResult == "Rusak Berat") {
              $("#finalResultBaik").attr("disabled", true);
              $("#finalResultRingan").attr("disabled", true);
              $("#finalResultBerat").attr("checked", true);
              $("#finalResultNot").attr("disabled", true);
            } else {
              $("#finalResultBaik").attr("disabled", true);
              $("#finalResultRingan").attr("disabled", true);
              $("#finalResultBerat").attr("disabled", true);
              $("#finalResultNot").attr("checked", true);
            }

          }
        });

      } else {
        Swal.fire({
          icon: 'warning',
          title: 'Oops...',
          text: (idTask.length > 1) ? "You choose more than 1 item, please choose one item to be details" : "Select Items to be Details",
        });
      }

    });
  }

  function approve(table) {
    $("#modal_approve_maintenance").click(function() {
      // e.preventDefault();
      var idTask = [];
      // Read all checked checkboxes
      $("input:checkbox[class=delete_check]:checked").each(function() {
        idTask.push($(this).val());
      });

      if (idTask.length == 1) {
        var selectedID = table.rows({
          selected: true
        }).data().pluck('propProgress').pluck('progressStatus')[0];

        if (selectedID.includes("FINISHED") == true) {
          $("#maintenance_form_edit").modal('show');
          $("#title-report-main").html("approve form maintenance");
          $(".report-footer").css({
            'display': 'none'
          });
          $("#th-option-alkur").css({
            'display': 'none'
          });
          $("#td-option-alkur").css({
            'display': 'none'
          });
          $("#th-option-tools").css({
            'display': 'none'
          });
          $("#td-option-tools").css({
            'display': 'none'
          });
          $("#th-option-material").css({
            'display': 'none'
          });
          $("#td-option-material").css({
            'display': 'none'
          });
          $("#btn-option-material").css({
            'display': 'none'
          });
          $("#td-result-worksheet").css({
            'display': 'none'
          });
          $("#electMeasure0").attr("readonly", true);
          $("#ukurValFormUkur0").attr("readonly", true);
          $("#assetQuantityMaintenanceMaterial0").attr("readonly", true);
          $("#assetTotalPriceMaintenanceMaterial0").attr("readonly", true);
          $("input[name=tempStartFormEncon]").attr("readonly", true);
          $("input[name=humidityStartFormEncon]").attr("readonly", true);
          $("input[name=kpi_point]").attr("readonly", true);
          $("input[name=service_price]").attr("readonly", true);

          $("#idVendor").removeAttr('id');

          let url_action_approve = "";
          $("#app_form_edit").attr("action", url_action_approve)

          $.ajax({
            type: "POST",
            url: BASE_URL + "task/non/maintenance/schedule_report/approve_id_task",
            data: {
              'idTask': idTask
            },
            dataType: "json",
            success: function(res) {
              if (res.idVendor != 0) {
                $("#option-vendor").val(res.idVendor).change();
                $("#option-vendor").html(res.propContact.contactCompany);
              }

              $("#addSignatureTeknisi").remove();
              $("#addDrawTeknisi").remove();
              $("#btn-addteknisi").remove();

              let signHashChairman = res.approveSign.search("DRAW");
              if (res.approveSign != "") {
                $("#addSignatureChairman").remove();
                $("#addDrawChairman").remove();
                if (signHashChairman == 0) {
                  $(`#drawOtpChairman`).attr("src", BASE_URL + "assets/upload/file/" + res.approveSign.substr(5));
                } else {
                  $(`#drawOtpChairman`).attr("src", res.approveSign);
                }
              }

              $(".signature-teknisi").html(res.propProgress.finishBy);

              let signHash = res.finishSign.search("DRAW");
              if (res.finishSign != "") {
                $("#addSignatureTeknisi").remove();
                $("#addDrawTeknisi").remove();
                if (signHash == 0) {
                  $(`#drawOtpTeknisi`).attr("src", BASE_URL + "assets/upload/file/" + res.finishSign.substr(5));
                } else {
                  $(`#drawOtpTeknisi`).attr("src", res.finishSign);
                }
              }

              if (res.propProgress.approveBy != "") {
                $(".signature-chairman").html(res.propProgress.approveBy);
              } else {
                $(".signature-chairman").html(res.username);
              }
              $("input[name=idAssigneeChairman]").val(res.propProgress.idAssignee);

              $("#createdDate").val(res.timeFinish);
              $("#idtask").val(res.idTask);
              $("#idTaskSignature").val(res.idTask);
              $("#idForm").val(res.propTaskMaintenance[0].propForm.idForm);
              $("#ftCode").val(res.propTaskMaintenance[0].propForm.formCode);
              $("#idFormTemplate").val(res.propTaskMaintenance[0].idFormTemplate);
              $("#idasset").val(res.propTaskMaintenance[0].idAsset);
              $("#idAssetSignature").val(res.propTaskMaintenance[0].idAsset);
              $("#asset-master").val(res.propTaskMaintenance[0].propAsset.assetName);
              $("#planning-date").val(res.propSchedule.scheduleStart);
              $("input[name=eqNameFormEqdata]").val(res.propTaskMaintenance[0].propAsset.assetName);
              $("input[name=eqCodeFormEqdata]").val(res.propTaskMaintenance[0].propAsset.assetCode);
              $("input[name=eqMerkFormEqdata]").val(res.propTaskMaintenance[0].propAsset.propAssetPropgenit.merk);
              $("input[name=eqTypeFormEqdata]").val(res.propTaskMaintenance[0].propAsset.propAssetPropgenit.tipe);
              $("input[name=eqSNFormEqdata]").val(res.propTaskMaintenance[0].propAsset.propAssetPropgenit.serialNumber);
              $("input[name=eqLocationFormEqdata]").val(res.propTaskMaintenance[0].propAsset.propAssetPropadmin.propAssetPropbuildingRoom.roomName);


              $("#startBy").val(res.propProgress.finishBy);
              $("#idStartBy").val(res.propProgress.idFinishBy);


              var dt = $('.techassistant_list').DataTable().ajax.url(BASE_URL + "task/med/task_datatable/list_data_pic/" + res.propTaskMaintenance[0].propForm.idForm).load();

              //hide the first column
              dt.column(2).visible(false);

              if (res.propTaskMaintenance[0].propForm.propFormTemplateitem.tmpitemUseVendor == false) {
                $("#row-vendor").remove();
              }

              if (res.propTaskMaintenance[0].propForm.propFormTemplateitem.tmpitemEncon == false) {
                $("#table-rooms").remove();
              } else {
                $("input[name=idFpEqdata]").val(res.propTaskMaintenance[0].propForm.propFormEqdata.idFpEqdata);
                $("input[name=idFpEncon]").val(res.propTaskMaintenance[0].propForm.propFormEncon.idFpEncon);
                $("input[name=tempStartFormEncon]").val(res.propTaskMaintenance[0].propForm.propFormEncon.tempStart);
                $("input[name=humidityStartFormEncon]").val(res.propTaskMaintenance[0].propForm.propFormEncon.humidityStart);
              }

              if (res.propTaskMaintenance[0].propForm.propFormTemplateitem.tmpitemEngineer == false) {
                $("#row-teknisi").remove();
              }

              if (res.propTaskMaintenance[0].propForm.propFormTemplateitem.tmpitemAlkur == true && res.propTaskMaintenance[0].propForm.propFormAlkur.length > 0) {
                $("#idFpAlkur0").val(res.propTaskMaintenance[0].propForm.propFormAlkur[0].idFpAlkur);
                $("#idAssetFormAlkur0").val(res.propTaskMaintenance[0].propForm.propFormAlkur[0].idAsset);
                $("#assetNameFormAlkur0").val(res.propTaskMaintenance[0].propForm.propFormAlkur[0].assetName);
                $("#assetMerkFormAlkur0").val(res.propTaskMaintenance[0].propForm.propFormAlkur[0].assetMerk);
                $("#assetTypeFormAlkur0").val(res.propTaskMaintenance[0].propForm.propFormAlkur[0].assetType);
                $("#assetSNFormAlkur0").val(res.propTaskMaintenance[0].propForm.propFormAlkur[0].assetSN);

                for (i = 1; i < res.propTaskMaintenance[0].propForm.propFormAlkur.length; i++) {
                  let rowHtml = `
      <tr>
          <td>
              <input type="hidden" name="idFpAlkur[]" id="idFpAlkur${i}" value="${res.propTaskMaintenance[0].propForm.propFormAlkur[i].idFpAlkur}">
              <input type="hidden" name="idAssetFormAlkur[]" id="idAssetFormAlkur${i}" value="${res.propTaskMaintenance[0].propForm.propFormAlkur[i].idAsset}">
              <input class="form-control w-100" type="text" name="assetNameFormAlkur[]" id="assetNameFormAlkur${i}" readonly value="${res.propTaskMaintenance[0].propForm.propFormAlkur[i].assetName}">
          </td>
          <td><input class="form-control w-100" type="text" name="assetMerkFormAlkur[]" id="assetMerkFormAlkur${i}" readonly value="${res.propTaskMaintenance[0].propForm.propFormAlkur[i].assetMerk}"></td>
          <td><input class="form-control w-100" type="text" name="assetTypeFormAlkur[]" id="assetTypeFormAlkur${i}" readonly value="${res.propTaskMaintenance[0].propForm.propFormAlkur[i].assetType}"></td>
          <td><input class="form-control w-100" type="text" name="assetSNFormAlkur[]" id="assetSNFormAlkur${i}"  readonly value="${res.propTaskMaintenance[0].propForm.propFormAlkur[i].assetSN}"></td>

      </tr>
      `;
                  $('.measuringTools tbody').append(rowHtml);
                }
              } else {
                $("#table-measuringtools").remove();
              }


              if (res.propTaskMaintenance[0].propForm.propFormTemplateitem.tmpitemTools == true && res.propTaskMaintenance[0].propForm.propFormTools.length > 0) {
                $("#idFpTools0").val(res.propTaskMaintenance[0].propForm.propFormTools[0].idFpTools);
                $("#idAssetFormTools0").val(res.propTaskMaintenance[0].propForm.propFormTools[0].idAsset);
                $("#assetNameFormTools0").val(res.propTaskMaintenance[0].propForm.propFormTools[0].assetName);
                $("#assetMerkFormTools0").val(res.propTaskMaintenance[0].propForm.propFormTools[0].assetMerk);
                $("#assetTypeFormTools0").val(res.propTaskMaintenance[0].propForm.propFormTools[0].assetType);
                $("#assetSNFormTools0").val(res.propTaskMaintenance[0].propForm.propFormTools[0].assetSN);
                for (i = 1; i < res.propTaskMaintenance[0].propForm.propFormTools.length; i++) {
                  let rowHtmlTools = `
  <tr>
    <td>
        <input class="form-control w-100" type="hidden" name="idFpTools[]" id="idFpTools${i}" value="${res.propTaskMaintenance[0].propForm.propFormTools[i].idFpTools}">
        <input class="form-control w-100" type="hidden" name="idAssetFormTools[]" id="idAssetFormTools${i}" value="${res.propTaskMaintenance[0].propForm.propFormTools[i].idAsset}">
        <input class="form-control w-100" type="text" name="assetNameFormTools[]" readonly id="assetNameFormTools${i}" value="${res.propTaskMaintenance[0].propForm.propFormTools[i].assetName}">
    </td>
    <td><input class="form-control w-100" type="text" name="assetMerkFormTools[]" readonly id="assetMerkFormTools${i}" value="${res.propTaskMaintenance[0].propForm.propFormTools[i].assetMerk}"></td>
    <td><input class="form-control w-100" type="text" name="assetTypeFormTools[]" readonly id="assetTypeFormTools${i}" value="${res.propTaskMaintenance[0].propForm.propFormTools[i].assetType}"></td>
    <td><input class="form-control w-100" type="text" name="assetSNFormTools[]" readonly id="assetSNFormTools${i}" value="${res.propTaskMaintenance[0].propForm.propFormTools[i].assetSN}"></td>

  </tr>
  `;
                  $('.toolsetUsage tbody').append(rowHtmlTools);
                }
              } else {
                $("#table-toolsetusage").remove();
              }

              if (res.propTaskMaintenance[0].propForm.propFormTemplateitem.tmpitemESM == true && res.propTaskMaintenance[0].propForm.propFormElect.length > 0) {

                if (res.propTaskMaintenance[0].propForm.propFormElect[0].electResult == true) {
                  $(`#electResultImg0`).attr("src", BASE_URL + "assets/images/icon/check.png");
                } else {
                  $(`#electResultImg0`).attr("src", BASE_URL + "assets/images/icon/no.png");
                }

                $("#idFpElect0").val(res.propTaskMaintenance[0].propForm.propFormElect[0].idFpElect);
                $("#electParam0").val(res.propTaskMaintenance[0].propForm.propFormElect[0].electParam);
                $("#electMeasure0").val(res.propTaskMaintenance[0].propForm.propFormElect[0].electMeasure);
                $("#electLower0").val(res.propTaskMaintenance[0].propForm.propFormElect[0].electLower);
                $("#electUpper0").val(res.propTaskMaintenance[0].propForm.propFormElect[0].electUpper);
                $("#electUpper0").val(res.propTaskMaintenance[0].propForm.propFormElect[0].electUpper);
                $("#electResult0").val(res.propTaskMaintenance[0].propForm.propFormElect[0].electResult);
                $("#val-electunit0").val(res.propTaskMaintenance[0].propForm.propFormElect[0].electUnit);
                $("#val-electunit0").html(res.propTaskMaintenance[0].propForm.propFormElect[0].electUnit);
                for (i = 1; i < res.propTaskMaintenance[0].propForm.propFormElect.length; i++) {

                  let rowHtml = `
    <tr>
        <td>
        <input type="hidden" name="idFpElect[]" value="${res.propTaskMaintenance[0].propForm.propFormElect[i].idFpElect}">
        <input class="form-control w-100" type="text" name="electParam[]" value="${res.propTaskMaintenance[0].propForm.propFormElect[i].electParam}" readonly>
        </td>
        <td>
        <div class="d-flex">
            <input class="form-control w-100 count-elect" readonly data-number="${i}" type="text" id="electMeasure${i}" name="electMeasure[]" value="${res.propTaskMaintenance[0].propForm.propFormElect[i].electMeasure}">
            <select class="form-control unitSelectElect` + [i] + `" style="width:60%;float:right;" name="electUnit[]" id="electUnit${i}">
                <option value="${res.propTaskMaintenance[0].propForm.propFormElect[i].electUnit}" id="val-electunit` + [i] + `">${res.propTaskMaintenance[0].propForm.propFormElect[i].electUnit}</option>
            </select>
        </div>
        </td>
        <td>
        <div class="d-flex">
            <input class="form-control w-100" type="text" name="electLower[]" id="electLower${i}" value="${res.propTaskMaintenance[0].propForm.propFormElect[i].electLower}" readonly>

        </div>
        </td>
        <td>
        <div class="d-flex">
            <input class="form-control w-100" type="text" name="electUpper[]" id="electUpper${i}" value="${res.propTaskMaintenance[0].propForm.propFormElect[i].electUpper}" readonly>

        </div>
        </td>
        <td class="text-center">
        <div class="d-flex">

            <img src="${res.propTaskMaintenance[0].propForm.propFormElect[i].electResult == true ? BASE_URL + "assets/images/icon/check.png" : BASE_URL + "assets/images/icon/no.png"}" id="electResultImg` + [i] + `">
            <input class="form-control w-100" type="hidden" name="electResult[]" id="electResult${i}" value="${res.propTaskMaintenance[0].propForm.propFormElect[i].electResult}" readonly>
        </div>
        </td>

    </tr>
    `;
                  $('.electricalSafety tbody').append(rowHtml);
                }
              } else {
                $("#table-electricalsafety").remove();
              }

              if (res.propTaskMaintenance[0].propForm.propFormTemplateitem.tmpitemFisfung == true && res.propTaskMaintenance[0].propForm.propFormFisfung.length > 0) {

                $("#fisfungItem0").val(res.propTaskMaintenance[0].propForm.propFormFisfung[0].fisfungItem);
                $("#idFisfung0").val(res.propTaskMaintenance[0].propForm.propFormFisfung[0].idFisfung);
                if (res.propTaskMaintenance[0].propForm.propFormFisfung[0].fisfungResult == "P") {
                  $("#fisfungResult0P").attr("checked", true);
                  $("#fisfungResult0F").attr("disabled", true);
                  $("#fisfungResult0NA").attr("disabled", true);
                } else if (res.propTaskMaintenance[0].propForm.propFormFisfung[0].fisfungResult == "F") {
                  $("#fisfungResult0F").attr("checked", true);
                  $("#fisfungResult0NA").attr("disabled", true);
                  $("#fisfungResult0P").attr("disabled", true);
                } else {
                  $("#fisfungResult0NA").attr("checked", true);
                  $("#fisfungResult0P").attr("disabled", true);
                  $("#fisfungResult0F").attr("disabled", true);
                }

                for (i = 1; i < res.propTaskMaintenance[0].propForm.propFormFisfung.length; i++) {
                  let rowHtmlGen = `
      <tr>
        <td>
            <input type="hidden" name="idFisfung[${i}]" value="${res.propTaskMaintenance[0].propForm.propFormFisfung[i].idFisfung}">
            <input class="form-control w-100" type="text" name="fisfungItem[${i}]" value="${res.propTaskMaintenance[0].propForm.propFormFisfung[i].fisfungItem}" readonly>
        </td>
        <td>
          <div class="radio-only-box">
            <input type="radio" name="fisfungResult[${i}]" ${res.propTaskMaintenance[0].propForm.propFormFisfung[i].fisfungResult == "P" ? "checked"  : "disabled"} value="P">
          </div>
        </td>
        <td>
          <div class="radio-only-box">
            <input type="radio" name="fisfungResult[${i}]" ${res.propTaskMaintenance[0].propForm.propFormFisfung[i].fisfungResult == "F" ? "checked"  : "disabled"} value="F">
          </div>
        </td>
        <td>
          <div class="radio-only-box">
            <input type="radio" name="fisfungResult[${i}]" ${res.propTaskMaintenance[0].propForm.propFormFisfung[i].fisfungResult == "NA" ? "checked"  : "disabled"} value="NA">
          </div>
        </td>
      </tr>
      `;
                  $('.qualitativeTask tbody').append(rowHtmlGen);
                }
              } else {
                $("#table-qualitativetask").remove();
              }


              if (res.propTaskMaintenance[0].propForm.propFormTemplateitem.tmpitemAction == true && res.propTaskMaintenance[0].propForm.propFormGen.length > 0) {
                if (res.propTaskMaintenance[0].propForm.propFormGen[0].genResult == "true") {
                  $("#genResult0").attr("checked", true);
                  $("#genResult0").attr("disabled", false);
                } else {
                  $("#genResult0").attr("checked", false);
                  $("#genResult0").attr("disabled", true);
                }

                $("#genActionFormGen0").val(res.propTaskMaintenance[0].propForm.propFormGen[0].genAction);
                $("#idGenFormGen0").val(res.propTaskMaintenance[0].propForm.propFormGen[0].idGen);
                for (i = 1; i < res.propTaskMaintenance[0].propForm.propFormGen.length; i++) {
                  let rowHtmlGen = `
    <tr>
      <td>
          <input type="hidden" name="idGenFormGen[${i}]" value="${res.propTaskMaintenance[0].propForm.propFormGen[i].idGen}">
          <input class="form-control w-100" readonly type="text" name="genActionFormGen[${i}]" value="${res.propTaskMaintenance[0].propForm.propFormGen[i].genAction}" required>
      </td>
      <td>
      <label class="p-10">
        <input type="checkbox" name="genResult[${i}]" id="genResult${i}" value="true" ${res.propTaskMaintenance[0].propForm.propFormGen[i].genResult == "true" ? "checked"  : "disabled"}>
        <span class="ml-10">Done</span>
      </label>
      </td>

    </tr>
    `;
                  $('.actioRecords tbody').append(rowHtmlGen);

                }
              } else {
                $("#table-actiorecords").remove();
              }


              if (res.propTaskMaintenance[0].propForm.propFormTemplateitem.tmpitemPerf == true && res.propTaskMaintenance[0].propForm.propFormUkur.length > 0) {
                if (res.propTaskMaintenance[0].propForm.propFormUkur[0].ukurResult == "true") {
                  $(`#ukurResultImg0`).attr("src", BASE_URL + "assets/images/icon/check.png");
                } else {
                  $(`#ukurResultImg0`).attr("src", BASE_URL + "assets/images/icon/no.png");
                }

                $("#idUkurFormUkur0").val(res.propTaskMaintenance[0].propForm.propFormUkur[0].idUkur);
                $("#ukurSubjectFormUkur0").val(res.propTaskMaintenance[0].propForm.propFormUkur[0].ukurSubject);
                $("#ukurSetFormUkur0").val(res.propTaskMaintenance[0].propForm.propFormUkur[0].ukurSet);
                $("#ukurValFormUkur0").val(res.propTaskMaintenance[0].propForm.propFormUkur[0].ukurVal);
                $("#ukurMinFormUkur0").val(res.propTaskMaintenance[0].propForm.propFormUkur[0].ukurMin);
                $("#ukurMaxFormUkur0").val(res.propTaskMaintenance[0].propForm.propFormUkur[0].ukurMax);
                $("#ukurResult0").val(res.propTaskMaintenance[0].propForm.propFormUkur[0].ukurResult);
                $("#val-ukurUnitFormUkurB0").val(res.propTaskMaintenance[0].propForm.propFormUkur[0].ukurUnit);
                $("#val-ukurUnitFormUkurB0").html(res.propTaskMaintenance[0].propForm.propFormUkur[0].ukurUnit);
                $("#val-ukurUnitFormUkur0").val(res.propTaskMaintenance[0].propForm.propFormUkur[0].ukurUnit);
                $("#val-ukurUnitFormUkur0").html(res.propTaskMaintenance[0].propForm.propFormUkur[0].ukurUnit);
                for (i = 1; i < res.propTaskMaintenance[0].propForm.propFormUkur.length; i++) {
                  let rowHtml = `
  <tr>
      <td>
          <input type="hidden" value="${res.propTaskMaintenance[0].propForm.propFormUkur[i].idUkur}" name="idUkurFormUkur[]" id="idUkurFormUkur` + [i] + `">
          <input class="form-control" type="text" name="ukurSubjectFormUkur[]" value="${res.propTaskMaintenance[0].propForm.propFormUkur[i].ukurSubject}" id="ukurSubjectFormUkur` + [i] + `" readonly>
      </td>
      <td>
        <div class="d-flex">
          <input class="form-control id-set-ukur" value="${res.propTaskMaintenance[0].propForm.propFormUkur[i].ukurSet}" style="text-align: center; width:40%;float:left;" type="text" name="ukurSetFormUkur[]"
              id="ukurSetFormUkur` + [i] + `" readonly>
          <select class="form-control unitSelect` + [i] + `" style="width:60%;float:right;">
            <option value="${res.propTaskMaintenance[0].propForm.propFormUkur[i].ukurUnit}" id="val-ukurUnitFormUkurB` + [i] + `">${res.propTaskMaintenance[0].propForm.propFormUkur[i].ukurUnit}</option>
          </select>
        </div>
      </td>
      <td>
        <div class="d-flex">
          <input class="form-control count-val" type="text" readonly data-number="${i}" name="ukurVal[]" style="text-align: center; width:40%;float:left;" value="${res.propTaskMaintenance[0].propForm.propFormUkur[i].ukurVal}" id="ukurValFormUkur` + [i] + `">
          <select class="form-control unitSelect` + [i] + `" style="width:60%;float:right;" name="ukurUnitFormUkur[]" id="ukurUnitFormUkur` + [i] + `">
            <option value="${res.propTaskMaintenance[0].propForm.propFormUkur[i].ukurUnit}" id="val-ukurUnitFormUkur` + [i] + `">${res.propTaskMaintenance[0].propForm.propFormUkur[i].ukurUnit}</option>
          </select>
        </div>
      </td>
      <td>
        <div class="d-flex">
          <input class="form-control" type="text"  name="ukurMinFormUkur[]" readonly value="${res.propTaskMaintenance[0].propForm.propFormUkur[i].ukurMin}" id="ukurMinFormUkur` + [i] + `" >

        </div>
      </td>
      <td>
        <div class="d-flex">
          <input class="form-control" type="text"  name="ukurMaxFormUkur[]" readonly value="${res.propTaskMaintenance[0].propForm.propFormUkur[i].ukurMax}" id="ukurMaxFormUkur` + [i] + `" >

        </div>
      </td>
      <td class="text-center">
      <img src="${res.propTaskMaintenance[0].propForm.propFormUkur[i].ukurResult == "true" ? BASE_URL + "assets/images/icon/check.png" : BASE_URL + "assets/images/icon/no.png"}" id="ukurResultImg` + [i] + `">
      <input class="form-control" type="hidden"  name="ukurResultFormUkur[]"  id="ukurResult` + [i] + `" value="${res.propTaskMaintenance[0].propForm.propFormUkur[i].ukurResult}" readonly>
      </td>

  </tr>`;
                  // this.$option.mounted.loadSelect2([i]);
                  $('.quantitativeTask tbody').append(rowHtml);
                }
              } else {
                $("#table-quantitativetask").remove();
              }


              if (res.propTaskMaintenance[0].propForm.propFormPart.length > 0) {
                for (i = 0; i < res.propTaskMaintenance[0].propForm.propFormPart.length; i++) {
                  let rowHtml = `
  <tr>
      <td>
        <input type="hidden" name="idAssetPart[]" id="idAssetPart${i}" value="${res.propTaskMaintenance[0].propForm.propFormPart[i].idAssetPart}">
        <input type="hidden" name="idFPart[]" id="idFPart${i}" value="${res.propTaskMaintenance[0].propForm.propFormPart[i].idFPart}">

          <input class="form-control w-100" type="text" readonly name="partName[]" value="${res.propTaskMaintenance[0].propForm.propFormPart[i].partName}" id="partName${i}">
      </td>
      <td>
          <input class="form-control w-100" type="text" readonly onkeypress="return hanyaAngka(event)" value="${res.propTaskMaintenance[0].propForm.propFormPart[i].partPrice / res.propTaskMaintenance[0].propForm.propFormPart[i].partQTY}" name="assetPriceMaintenanceMaterial[]" id="assetPriceMaintenanceMaterial${i}">
      </td>
      <td>
          <input class="form-control w-100 count-qty" readonly data-num="${i}" type="text" value="${res.propTaskMaintenance[0].propForm.propFormPart[i].partQTY}" onkeypress="return hanyaAngka(event)" name="partQTY[]" id="partQTY${i}">
      </td>
      <td>
          <input class="form-control w-100" type="text" readonly onkeypress="return hanyaAngka(event)" value="${res.propTaskMaintenance[0].propForm.propFormPart[i].partPrice}" name="partPrice[]" id="partPrice${i}">
      </td>

  </tr>
  `;
                  $('.maintenaceMaterial tbody').append(rowHtml);
                }
              }
              $("input[name=kpi_point]").val(res.taskKpi);
              $("input[name=service_price]").val(res.taskAmount);
              $("#maintenanceNote").val(res.propTaskMaintenance[0].maintenanceNote);

              $("#maintenanceNote").attr("disabled", true);

              if (res.propTaskMaintenance[0].propForm.finalResult == "Baik") {
                $("#finalResultBaik").attr("checked", true);
                $("#finalResultRingan").attr("disabled", true);
                $("#finalResultBerat").attr("disabled", true);
                $("#finalResultNot").attr("disabled", true);
              } else if (res.propTaskMaintenance[0].propForm.finalResult == "Rusak Ringan") {
                $("#finalResultBaik").attr("disabled", true);
                $("#finalResultRingan").attr("checked", true);
                $("#finalResultBerat").attr("disabled", true);
                $("#finalResultNot").attr("disabled", true);
              } else if (res.propTaskMaintenance[0].propForm.finalResult == "Rusak Berat") {
                $("#finalResultBaik").attr("disabled", true);
                $("#finalResultRingan").attr("disabled", true);
                $("#finalResultBerat").attr("checked", true);
                $("#finalResultNot").attr("disabled", true);
              } else {
                $("#finalResultBaik").attr("disabled", true);
                $("#finalResultRingan").attr("disabled", true);
                $("#finalResultBerat").attr("disabled", true);
                $("#finalResultNot").attr("checked", true);
              }

            }
          });
        } else {
          Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: "Please do maintenance activities first!",
          });
        }

      } else {
        Swal.fire({
          icon: 'warning',
          title: 'Oops...',
          text: (idTask.length > 1) ? "You choose more than 1 item, please choose one item to be Approve" : "Select Items to be Approve",
        });
      }
    });
  }

  function GetTodayDate() {
    var tdate = new Date();
    var dd = tdate.getDate(); //yields day
    var MM = tdate.getMonth(); //yields month
    var yyyy = tdate.getFullYear(); //yields year
    var currentDate = yyyy + "-" + (MM + 1) + "-" + dd;

    return currentDate;
  }

  function update_mtn() {
    $(document).on('click', '#update-mtn', function() {
      // e.preventDefault();
      let idTask = $(this).data('idtask');
      let idAsset = $(this).data('idasset');
      let schedule = $(this).data('schedule');
      let idFormTemplate = $(this).data('formtemplate');


      $("#maintenance_form_edit").modal('show');

      $("#addSignatureChairman").remove();
      $("#addDrawChairman").remove();

      $.ajax({
        type: "POST",
        url: BASE_URL + "task/non/maintenance/schedule_report/update_mtn",
        data: {
          'idTask': idTask,
          'idAsset': idAsset
        },
        dataType: "json",
        success: function(res) {
          $("#createdDate").val(GetTodayDate());

          $("input[name=startBy]").val(res.username);
          $(".signature-teknisi").html(res.username);
          $("input[name=idStartBy]").val(res.id_user);
          $("#ftCode").val(res.formTemplate.ftCode);
          $("#idFormTemplate").val(idFormTemplate);
          $("input[name=idAsset]").val(idAsset);
          $("#idAssetSignature").val(idAsset);
          $("input[name=idTask]").val(idTask);
          $("input[name=idTaskSignature]").val(idTask);
          $("input[name=idFpEqdata]").val(res.formTemplate.propFormEqdata.idFpEqdata);
          $("#idFormTemplate").val(idFormTemplate);
          $("#planning-date").val(schedule);
          $("#asset-master").val(res.task[0].propTaskMaintenance[0].propAsset.assetName);
          $("input[name=eqNameFormEqdata]").val(res.task[0].propTaskMaintenance[0].propAsset.assetName);
          $("input[name=eqCodeFormEqdata]").val(res.task[0].propTaskMaintenance[0].propAsset.assetCode);
          $("input[name=eqMerkFormEqdata]").val(res.task[0].propTaskMaintenance[0].propAsset.propAssetPropgenit.merk);
          $("input[name=eqTypeFormEqdata]").val(res.task[0].propTaskMaintenance[0].propAsset.propAssetPropgenit.tipe);
          $("input[name=eqSNFormEqdata]").val(res.task[0].propTaskMaintenance[0].propAsset.propAssetPropgenit.serialNumber);
          $("input[name=eqLocationFormEqdata]").val(res.task[0].propTaskMaintenance[0].propAsset.propAssetPropadmin.propAssetPropbuildingRoom.roomName);

          $("input[name=idTmpItem]").val(res.formTemplate.propFormTemplateitem.idTmpItem);
          $("input[name=tmpitemEngineer]").val(res.formTemplate.propFormTemplateitem.tmpitemEngineer);
          $("input[name=tmpitemAlkur]").val(res.formTemplate.propFormTemplateitem.tmpitemAlkur);
          $("input[name=tmpitemTools]").val(res.formTemplate.propFormTemplateitem.tmpitemTools);
          $("input[name=tmpitemEncon]").val(res.formTemplate.propFormTemplateitem.tmpitemEncon);
          $("input[name=tmpitemESM]").val(res.formTemplate.propFormTemplateitem.tmpitemESM);
          $("input[name=tmpitemFisfung]").val(res.formTemplate.propFormTemplateitem.tmpitemFisfung);
          $("input[name=tmpitemPerf]").val(res.formTemplate.propFormTemplateitem.tmpitemPerf);
          $("input[name=tmpitemAction]").val(res.formTemplate.propFormTemplateitem.tmpitemAction);
          $("input[name=tmpitemUseVendor]").val(res.formTemplate.propFormTemplateitem.tmpitemUseVendor);

          if (res.formTemplate.propFormTemplateitem.tmpitemEncon == false) {
            $("#table-rooms").remove();
          }

          if (res.formTemplate.propFormTemplateitem.tmpitemEngineer == false) {
            $("#row-teknisi").remove();
          }

          if (res.formTemplate.propFormTemplateitem.tmpitemUseVendor == false) {
            $("#row-vendor").remove();
          }

          if (res.formTemplate.propFormTemplateitem.tmpitemAlkur == true && res.formTemplate.propFormAlkur.length > 0) {
            $("#idFpAlkur0").val(res.formTemplate.propFormAlkur[0].idFpAlkur);
            for (i = 1; i < res.formTemplate.propFormAlkur.length; i++) {
              let rowHtml = `
                      <tr>
                          <td>
                              <input type="hidden" name="idFpAlkur[]" id="idFpAlkur${i}" value="${res.formTemplate.propFormAlkur[i].idFpAlkur}">
                              <input type="hidden" name="idAssetFormAlkur[]" id="idAssetFormAlkur${i}">
                              <input class="form-control w-100" type="text" name="assetNameFormAlkur[]" id="assetNameFormAlkur${i}" readonly>
                          </td>
                          <td><input class="form-control w-100" type="text" name="assetMerkFormAlkur[]" id="assetMerkFormAlkur${i}" readonly></td>
                          <td><input class="form-control w-100" type="text" name="assetTypeFormAlkur[]" id="assetTypeFormAlkur${i}" readonly></td>
                          <td><input class="form-control w-100" type="text" name="assetSNFormAlkur[]" id="assetSNFormAlkur${i}"  readonly></td>
                          <td class="text-center">
                          <button type="button" class="btn samrs-success pick-tools" id="${i}"> Pick</button>
                          </td>
                      </tr>
                      `;

              $('.measuringTools tbody').append(rowHtml);

            }
          } else {
            $("#table-measuringtools").remove();
          }

          if (res.formTemplate.propFormTemplateitem.tmpitemTools == true && res.formTemplate.propFormTools.length > 0) {
            $("#idFpTools0").val(res.formTemplate.propFormTools[0].idFpTools);
            for (i = 1; i < res.formTemplate.propFormTools.length; i++) {
              let rowHtmlTools = `
                  <tr>
                    <td>
                        <input class="form-control w-100" type="hidden" name="idFpTools[]" id="idFpTools${i}" value="${res.formTemplate.propFormTools[i].idFpTools}">
                        <input class="form-control w-100" type="hidden" name="idAssetFormTools[]" id="idAssetFormTools${i}">
                        <input class="form-control w-100" type="text" name="assetNameFormTools[]" readonly id="assetNameFormTools${i}">
                    </td>
                    <td><input class="form-control w-100" type="text" name="assetMerkFormTools[]" readonly id="assetMerkFormTools${i}"></td>
                    <td><input class="form-control w-100" type="text" name="assetTypeFormTools[]" readonly id="assetTypeFormTools${i}"></td>
                    <td><input class="form-control w-100" type="text" name="assetSNFormTools[]" readonly id="assetSNFormTools${i}"></td>
                    <td class="text-center">
                    <button type="button" class="btn samrs-success pick-toolset" id="${i}"> Pick</button>
                    </td>
                  </tr>
                  `;
              $('.toolsetUsage tbody').append(rowHtmlTools);
            }
          } else {
            $("#table-toolsetusage").remove();
          }


          if (res.formTemplate.propFormTemplateitem.tmpitemESM == true && res.formTemplate.propFormElect.length > 0) {
            $("#idFpElect0").val(res.formTemplate.propFormElect[0].idFpElect);
            $("#electParam0").val(res.formTemplate.propFormElect[0].electParam);
            $("#electMeasure0").val(res.formTemplate.propFormElect[0].electMeasure);
            $("#electLower0").val(res.formTemplate.propFormElect[0].electLower);
            $("#electUpper0").val(res.formTemplate.propFormElect[0].electUpper);
            $("#val-electunit0").val(res.formTemplate.propFormElect[0].electUnit);
            $("#val-electunit0").html(res.formTemplate.propFormElect[0].electUnit);

            for (i = 1; i < res.formTemplate.propFormElect.length; i++) {
              let rowHtml = `
                    <tr>
                        <td>
                        <input type="hidden" name="idFpElect[]" value="${res.formTemplate.propFormElect[i].idFpElect}">
                        <input class="form-control w-100" type="text" name="electParam[]" value="${res.formTemplate.propFormElect[i].electParam}" readonly>
                        </td>
                        <td>
                        <div class="d-flex">
                            <input class="form-control w-100 count-elect" data-number="${i}" type="text" id="electMeasure${i}" name="electMeasure[]" value="${res.formTemplate.propFormElect[i].electMeasure}">
                            <select class="form-control unitSelectElect` + [i] + `" style="width:60%;float:right;" name="electUnit[]" id="electUnit${i}">
                                <option value="${res.formTemplate.propFormElect[i].electUnit}" id="val-electunit` + [i] + `">${res.formTemplate.propFormElect[i].electUnit}</option>
                            </select>
                        </div>
                        </td>
                        <td>
                        <div class="d-flex">
                            <input class="form-control w-100" type="text" name="electLower[]" id="electLower${i}" value="${res.formTemplate.propFormElect[i].electLower}" readonly>

                        </div>
                        </td>
                        <td>
                        <div class="d-flex">
                            <input class="form-control w-100" type="text" name="electUpper[]" id="electUpper${i}" value="${res.formTemplate.propFormElect[i].electUpper}" readonly>

                        </div>
                        </td>
                        <td class="text-center">
                        <div class="d-flex">
                            <img src="" id="electResultImg` + [i] + `">
                            <input class="form-control w-100" type="hidden" name="electResult[]" id="electResult${i}" readonly>
                        </div>
                        </td>

                    </tr>
                    `;
              $('.electricalSafety tbody').append(rowHtml);
            }
          } else {
            $("#table-electricalsafety").remove();
          }

          if (res.formTemplate.propFormTemplateitem.tmpitemAction == true && res.formTemplate.propFormGen.length > 0) {
            $("#genActionFormGen0").val(res.formTemplate.propFormGen[0].genAction);
            $("#idGenFormGen0").val(res.formTemplate.propFormGen[0].idGen);
            for (i = 1; i < res.formTemplate.propFormGen.length; i++) {
              let rowHtmlGen = `
                  <tr>
                    <td>
                        <input type="hidden" name="idGenFormGen[]" value="${res.formTemplate.propFormGen[i].idGen}">
                        <input class="form-control w-100" readonly type="text" name="genActionFormGen[]" value="${res.formTemplate.propFormGen[i].genAction}" required>
                    </td>
                    <td>
                    <label class="p-10">
                      <input type="checkbox" name="genResult[]" value="true">
                      <span class="ml-10">Done</span>
                    </label>
                    </td>

                  </tr>
                  `;
              $('.actioRecords tbody').append(rowHtmlGen);

            }
          } else {
            $("#table-actiorecords").remove();
          }


          if (res.formTemplate.propFormTemplateitem.tmpitemFisfung == true && res.formTemplate.propFormFisfung.length > 0) {
            $("#fisfungItem0").val(res.formTemplate.propFormFisfung[0].fisfungItem);
            $("#idFisfung0").val(res.formTemplate.propFormFisfung[0].idFisfung);
            for (i = 1; i < res.formTemplate.propFormFisfung.length; i++) {
              let rowHtmlGen = `
                  <tr>
                    <td>
                        <input type="hidden" name="idFisfung[${i}]" value="${res.formTemplate.propFormFisfung[i].idFisfung}">
                        <input class="form-control w-100" type="text" name="fisfungItem[${i}]" value="${res.formTemplate.propFormFisfung[i].fisfungItem}" readonly>
                    </td>
                    <td>
                      <div class="radio-only-box">
                        <input type="radio" name="fisfungResult[${i}]" value="P">
                      </div>
                    </td>
                    <td>
                      <div class="radio-only-box">
                        <input type="radio" name="fisfungResult[${i}]" value="F">
                      </div>
                    </td>
                    <td>
                      <div class="radio-only-box">
                        <input type="radio" name="fisfungResult[${i}]" value="NA">
                      </div>
                    </td>
                  </tr>
                  `;
              $('.qualitativeTask tbody').append(rowHtmlGen);

            }
          } else {
            $("#table-qualitativetask").remove();
          }

          if (res.formTemplate.propFormTemplateitem.tmpitemPerf == true && res.formTemplate.propFormUkur.length > 0) {
            $("#idUkurFormUkur0").val(res.formTemplate.propFormUkur[0].idUkur);
            $("#ukurSubjectFormUkur0").val(res.formTemplate.propFormUkur[0].ukurSubject);
            $("#ukurSetFormUkur0").val(res.formTemplate.propFormUkur[0].ukurSet);
            $("#ukurValFormUkur0").val(res.formTemplate.propFormUkur[0].ukurVal);
            $("#ukurMinFormUkur0").val(res.formTemplate.propFormUkur[0].ukurMin);
            $("#ukurMaxFormUkur0").val(res.formTemplate.propFormUkur[0].ukurMax);
            $("#ukurResult0").val(res.formTemplate.propFormUkur[0].ukurResult);
            $("#val-ukurUnitFormUkurB0").val(res.formTemplate.propFormUkur[0].ukurUnit);
            $("#val-ukurUnitFormUkurB0").html(res.formTemplate.propFormUkur[0].ukurUnit);
            $("#val-ukurUnitFormUkur0").val(res.formTemplate.propFormUkur[0].ukurUnit);
            $("#val-ukurUnitFormUkur0").html(res.formTemplate.propFormUkur[0].ukurUnit);

            for (i = 1; i < res.formTemplate.propFormUkur.length; i++) {
              let rowHtml = `
                    <tr>
                        <td>
                            <input type="hidden" value="${res.formTemplate.propFormUkur[i].idUkur}" name="idUkurFormUkur[]" id="idUkurFormUkur` + [i] + `">
                            <input class="form-control" type="text" name="ukurSubjectFormUkur[]" value="${res.formTemplate.propFormUkur[i].ukurSubject}" id="ukurSubjectFormUkur` + [i] + `" readonly>
                        </td>
                        <td>
                          <div class="d-flex">
                            <input class="form-control id-set-ukur" value="${res.formTemplate.propFormUkur[i].ukurSet}" style="text-align: center; width:40%;float:left;" type="text" name="ukurSetFormUkur[]"
                                id="ukurSetFormUkur` + [i] + `" readonly>
                            <select class="form-control unitSelect` + [i] + `" style="width:60%;float:right;">
                              <option value="${res.formTemplate.propFormUkur[i].ukurUnit}" id="val-ukurUnitFormUkurB` + [i] + `">${res.formTemplate.propFormUkur[i].ukurUnit}</option>
                            </select>
                          </div>
                        </td>
                        <td>
                          <div class="d-flex">
                            <input class="form-control count-val" type="text" data-number="${i}" name="ukurVal[]" style="text-align: center; width:40%;float:left;" value="${res.formTemplate.propFormUkur[i].ukurVal}" id="ukurValFormUkur` + [i] + `">
                            <select class="form-control unitSelect` + [i] + `" style="width:60%;float:right;" name="ukurUnitFormUkur[]" id="ukurUnitFormUkur` + [i] + `">
                              <option value="${res.formTemplate.propFormUkur[i].ukurUnit}" id="val-ukurUnitFormUkur` + [i] + `">${res.formTemplate.propFormUkur[i].ukurUnit}</option>
                            </select>
                          </div>
                        </td>
                        <td>
                          <div class="d-flex">
                            <input class="form-control" type="text"  name="ukurMinFormUkur[]" readonly value="${res.formTemplate.propFormUkur[i].ukurMin}" id="ukurMinFormUkur` + [i] + `" >

                          </div>
                        </td>
                        <td>
                          <div class="d-flex">
                            <input class="form-control" type="text"  name="ukurMaxFormUkur[]" readonly value="${res.formTemplate.propFormUkur[i].ukurMax}" id="ukurMaxFormUkur` + [i] + `" >

                          </div>
                        </td>
                        <td class="text-center">
                        <img src="" id="ukurResultImg` + [i] + `">
                        <input class="form-control" type="hidden"  name="ukurResultFormUkur[]"  id="ukurResult` + [i] + `" value="${res.formTemplate.propFormUkur[i].ukurResult}" readonly>
                        </td>

                    </tr>`;
              // this.$option.mounted.loadSelect2([i]);
              $('.quantitativeTask tbody').append(rowHtml);

            }
          } else {
            $("#table-quantitativetask").remove();
          }
        }
      });

    });
  }

  //create function delete
  function hapus() {
    $('#modal_delete_maintenance').click(function() {
      // e.preventDefault();
      // console.log('keluar sini');
      var idTask = [];
      // Read all checked checkboxes
      $("input:checkbox[class=delete_check]:checked").each(function() {
        idTask.push($(this).val());
      });
      // console.log(idAsset);
      if (idTask.length > 0) {
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
                  url: BASE_URL + "task/non/complain/delete",
                  data: {
                    'idTask': idTask,
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
                      $('.samrs-table1').DataTable().ajax.reload();
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
</script>