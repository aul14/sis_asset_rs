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
    <action-button-card title="Non Electromedic Task - Mutation">
      <template v-slot:buttons>
        <table-init></table-init>
        <?php if ($result_role[2]['subMenu1'][1]['subMenu2'][3]['subMenu3'][0]['isAllow'] == true) : ?>
          <approve-data button-id="modal_approve_mtn"></approve-data>
        <?php endif; ?>
        <?php if ($result_role[2]['subMenu1'][1]['subMenu2'][3]['subMenu3'][1]['isAllow'] == true) : ?>
          <add-data modal="mutation_form"></add-data>
        <?php endif; ?>
        <?php if ($result_role[2]['subMenu1'][1]['subMenu2'][3]['subMenu3'][2]['isAllow'] == true) : ?>
          <delete-data button-id="modal_delete_mtn"></delete-data>
        <?php endif; ?>
        <?php if ($result_role[2]['subMenu1'][1]['subMenu2'][3]['subMenu3'][3]['isAllow'] == true) : ?>
          <return-data button-id="modal_return_mtn"></return-data>
        <?php endif; ?>
        <?php if ($result_role[2]['subMenu1'][1]['subMenu2'][3]['subMenu3'][4]['isAllow'] == true) : ?>
          <confirm-data button-id="modal_confirm_mtn"></confirm-data>
        <?php endif; ?>
        <?php if ($result_role[2]['subMenu1'][1]['subMenu2'][3]['subMenu3'][5]['isAllow'] == true) : ?>
          <table-advance-search overlay="advanced_search"></table-advance-search>
        <?php endif; ?>
        <?php if ($result_role[2]['subMenu1'][1]['subMenu2'][3]['subMenu3'][6]['isAllow'] == true) : ?>
          <table-column-view></table-column-view>
        <?php endif; ?>
      </template>
      <template v-slot:content>
        <form action="" method="get">
          <advanced-search with-status="Yes" have-task-periode="yes" :radio-name="['status']" :radio-label="['Open','Borrowed','Expired','Returned','Return Completed','Mutation Completed']" :radio-value="['Open','Borrowed','Expired','Returned','Return Completed','Mutation Completed']"></advanced-search>
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

      colResize: {
        "handleWidth": 50
      },
      select: {
        style: 'multi',
        info: false
      },

      "ajax": {
        "url": BASE_URL + "task/med/task_datatable/data_table_mutation",
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
          "taskCode": "NMUT",

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
          name: 'status',
          data: 'propTaskMutation.status',
          defaultContent: '-'

        },
        {
          title: 'Code',
          name: 'idTask',
          data: 'propTaskMutation.taskMutationCode',
          defaultContent: '-'
        },
        {
          title: 'Mutation Type',
          name: 'mutationType',
          data: 'propTaskMutation.mutationType',
          defaultContent: '-'
        },
        {
          title: 'Asset Code',
          name: 'idAsset',
          data: 'propTaskMutation.propAsset.assetCode',
          defaultContent: '-'
        },
        {
          title: 'Asset Name',
          name: 'assetName',
          data: 'propTaskMutation.propAsset.assetName',
          defaultContent: '-'
        },
        {
          title: 'Merk',
          name: 'merk',
          data: 'propTaskMutation.propAsset.propAssetPropgenit.merk',
          defaultContent: '-'
        },
        {
          title: 'Type',
          name: 'tipe',
          data: 'propTaskMutation.propAsset.propAssetPropgenit.tipe',
          defaultContent: '-'
        },
        {
          title: 'Serial Number',
          name: 'serialNumber',
          data: 'propTaskMutation.propAsset.propAssetPropgenit.serialNumber',
          defaultContent: '-'
        },
        {
          title: 'Location Source',
          name: 'locationSrc',
          data: 'propTaskMutation.srcRoomName',
          defaultContent: '-'
        },
        {
          title: 'Informant',
          name: 'initBy',
          data: 'propProgress.initBy',
          defaultContent: '-'
        },
        {
          title: 'Request Date',
          name: 'timeInit',
          data: 'propProgress.timeInit',
          defaultContent: '-'
        },
        {
          title: 'Location Destination',
          name: 'locationDst',
          data: 'propTaskMutation.dstRoomName',
          defaultContent: '-'
        },
        {
          title: 'Approve Date',
          name: 'timeApproved',
          data: 'propProgress.timeApproved',
          defaultContent: '-'
        },
        {
          title: 'Approval By',
          name: 'approveBy',
          data: 'propProgress.approveBy',
          defaultContent: '-'
        },
        {
          title: 'Rejected Date',
          name: 'timeReject',
          data: 'propProgress.timeReject',
          defaultContent: '-'
        },
        {
          title: 'Rejected By',
          name: 'rejectBy',
          data: 'propProgress.rejectBy',
          defaultContent: '-'
        },
        {
          title: 'Finish Date Estimation',
          name: 'timePending',
          data: 'propTaskMutation.returnDatePlan',
          defaultContent: '-'
        },
        {
          title: 'Return Date',
          name: 'timeFinish',
          data: 'propProgress.timeFinish',
          defaultContent: '-'
        },
        {
          title: 'Finish By',
          name: 'finishBy',
          data: 'propProgress.finishBy',
          defaultContent: '-'
        },
        {
          title: 'Confirm By',
          name: 'assignTo',
          data: 'propProgress.assignTo',
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

    return table;
  }

  function confirm_data(table) {
    $("#modal_confirm_mtn").click(function() {
      var idTask = [];
      // Read all checked checkboxes
      $("input:checkbox[class=delete_check]:checked").each(function() {
        idTask.push($(this).val());
      });

      if (idTask.length == 1) {
        var mutationStatus = table.rows({
          selected: true
        }).data().pluck('propTaskMutation')[0].mutationStatus;

        if (mutationStatus == 'Returned') {
          $("#mutation_confirm").modal('show');

          $.ajax({
            type: "POST",
            url: BASE_URL + "task/non/mutation/task_by_id",
            data: {
              'idTask': idTask
            },
            dataType: "json",
            success: function(res) {
              $("input[name=mutationStatusConfirm]").val("confirm");
              $("input[name=idTaskConfirm]").val(res.data_update.idTask);
              $("input[name=idAssetConfirm]").val(res.data_update.propTaskMutation[0].idAsset);
              $("input[name=assetCodeConfirm]").val(res.data_update.propTaskMutation[0].propAsset.assetCode);
              $("input[name=assetNameConfirm]").val(res.data_update.propTaskMutation[0].propAsset.assetName);
              $("input[name=merkConfirm]").val(res.data_update.propTaskMutation[0].propAsset.propAssetPropgenit.merk);
              $("input[name=tipeConfirm]").val(res.data_update.propTaskMutation[0].propAsset.propAssetPropgenit.tipe);
              $("input[name=serialNumberConfirm]").val(res.data_update.propTaskMutation[0].propAsset.propAssetPropgenit.serialNumber);
              $("input[name=srcRoomIDConfirm]").val(res.data_update.propTaskMutation[0].srcRoomID);
              $("input[name=dstRoomIDConfirm]").val(res.data_update.propTaskMutation[0].dstRoomID);
              $("input[name=srcRoomNameConfirm]").val(res.data_update.propTaskMutation[0].srcRoomName);
              $("input[name=dstRoomNameConfirm]").val(res.data_update.propTaskMutation[0].dstRoomName);
              $("textarea[name=mutationDescConfirm]").val(res.data_update.propTaskMutation[0].mutationDesc);
              $("textarea[name=mutationDescConfirm]").attr("disabled", true);
              $("input[name=userNameConfirm]").val(res.data_update.propProgress.initBy);
              $("input[name=initByConfirm]").val(res.data_update.propProgress.initBy);
              $("input[name=idInitByConfirm]").val(res.data_update.propProgress.idInitBy);
              $("input[name=scheduleStartConfirm]").val(res.data_update.propProgress.timeInit);

              if (res.data_update.propTaskMutation[0].mutationType == "Temporary") {
                $("#mutationTypeConfirm1").attr("checked", true);
                $("#mutationTypeConfirm2").attr("disabled", true);
                $("#timePendingConfirm").attr("disabled", true);
                $("#timePendingConfirm").val(res.data_update.propTaskMutation[0].ConfirmDatePlan);
              } else {
                $("#mutationTypeConfirm2").attr("checked", true);
                $("#mutationTypeConfirm1").attr("disabled", true);
                $("#timePendingConfirm").attr("disabled", true);
              }

              if (res.data_update.propProgress.timeApproved != "") {
                $("#requestApprovalConfirm").attr("checked", true);
                $("#requestApprovalConfirm2").attr("disabled", true);
              }

              $("#approveByConfirm").val(res.data_update.propProgress.approveBy);
              $("#timeApprovedConfirm").val(res.data_update.propProgress.timeApproved);
              $("#approveNoteConfirm").val(res.data_update.propTaskMutation[0].mutationNote);

              $("input[name=timeAssignConfirm]").val(res.data_update.propProgress.timeAssign);
              $("input[name=assignToConfirm]").val(res.data_update.propProgress.assignTo);
            }
          });
        } else {
          Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: "Only mutations with Returned status can be returned confirm",
          });
        }
      } else {
        Swal.fire({
          icon: 'warning',
          title: 'Oops...',
          text: (idTask.length > 1) ? "You choose more than 1 item, please choose one item to be Confirm" : "Select Items to be Confirm",
        });
      }
    });
  }

  function return_data(table) {
    $("#modal_return_mtn").click(function() {
      var idTask = [];
      // Read all checked checkboxes
      $("input:checkbox[class=delete_check]:checked").each(function() {
        idTask.push($(this).val());
      });

      if (idTask.length == 1) {
        var mutationStatus = table.rows({
          selected: true
        }).data().pluck('propTaskMutation')[0].mutationStatus;

        if (mutationStatus == 'Borrowed' || mutationStatus == 'Expired') {
          $("#mutation_return").modal('show');
          $.ajax({
            type: "POST",
            url: BASE_URL + "task/non/mutation/task_by_id",
            data: {
              'idTask': idTask
            },
            dataType: "json",
            success: function(res) {
              $("input[name=mutationStatusReturn]").val("back");
              $("input[name=idTaskReturn]").val(res.data_update.idTask);
              $("input[name=idAssetReturn]").val(res.data_update.propTaskMutation[0].idAsset);
              $("input[name=assetCodeReturn]").val(res.data_update.propTaskMutation[0].propAsset.assetCode);
              $("input[name=assetNameReturn]").val(res.data_update.propTaskMutation[0].propAsset.assetName);
              $("input[name=merkReturn]").val(res.data_update.propTaskMutation[0].propAsset.propAssetPropgenit.merk);
              $("input[name=tipeReturn]").val(res.data_update.propTaskMutation[0].propAsset.propAssetPropgenit.tipe);
              $("input[name=serialNumberReturn]").val(res.data_update.propTaskMutation[0].propAsset.propAssetPropgenit.serialNumber);
              $("input[name=srcRoomIDReturn]").val(res.data_update.propTaskMutation[0].srcRoomID);
              $("input[name=dstRoomIDReturn]").val(res.data_update.propTaskMutation[0].dstRoomID);
              $("input[name=srcRoomNameReturn]").val(res.data_update.propTaskMutation[0].srcRoomName);
              $("input[name=dstRoomNameReturn]").val(res.data_update.propTaskMutation[0].dstRoomName);
              $("textarea[name=mutationDescReturn]").val(res.data_update.propTaskMutation[0].mutationDesc);
              $("textarea[name=mutationDescReturn]").attr("disabled", true);
              $("input[name=userNameReturn]").val(res.data_update.propProgress.initBy);
              $("input[name=initByReturn]").val(res.data_update.propProgress.initBy);
              $("input[name=idInitByReturn]").val(res.data_update.propProgress.idInitBy);
              $("input[name=scheduleStartReturn]").val(res.data_update.propProgress.timeInit);

              if (res.data_update.propTaskMutation[0].mutationType == "Temporary") {
                $("#mutationTypeReturn1").attr("checked", true);
                $("#mutationTypeReturn2").attr("disabled", true);
                $("#timePendingReturn").attr("disabled", true);
                $("#timePendingReturn").val(res.data_update.propTaskMutation[0].returnDatePlan);
              } else {
                $("#mutationTypeReturn2").attr("checked", true);
                $("#mutationTypeReturn1").attr("disabled", true);
                $("#timePendingReturn").attr("disabled", true);
              }

              if (res.data_update.propProgress.timeApproved != "") {
                $("#requestApprovalReturn").attr("checked", true);
                $("#requestApprovalReturn2").attr("disabled", true);
              }

              $("#approveByReturn").val(res.data_update.propProgress.approveBy);
              $("#timeApprovedReturn").val(res.data_update.propProgress.timeApproved);
              $("#approveNoteReturn").val(res.data_update.propTaskMutation[0].mutationNote);
            }
          });
        } else {
          Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: "Only mutations with Borrowed/Expired status can be returned",
          });
        }
      } else {
        Swal.fire({
          icon: 'warning',
          title: 'Oops...',
          text: (idTask.length > 1) ? "You choose more than 1 item, please choose one item to be Return" : "Select Items to be Return",
        });
      }
    });
  }

  function approve(table) {
    $("#modal_approve_mtn").click(function() {

      var idTask = [];
      // Read all checked checkboxes
      $("input:checkbox[class=delete_check]:checked").each(function() {
        idTask.push($(this).val());
      });
      if (idTask.length == 1) {
        var mutationStatus = table.rows({
          selected: true
        }).data().pluck('propTaskMutation')[0].mutationStatus;
        if (mutationStatus != 'Open') {
          Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: "Only mutations with Open status can be approved",
          });
        } else {
          $("#mutation_approve").modal('show');
          $.ajax({
            type: "POST",
            url: BASE_URL + "task/non/mutation/task_by_id",
            data: {
              'idTask': idTask
            },
            dataType: "json",
            success: function(res) {
              $("input[name=mutationStatusApprove]").val("approve");
              $("input[name=idTaskApprove]").val(res.data_update.idTask);
              $("input[name=idAssetApprove]").val(res.data_update.propTaskMutation[0].idAsset);
              $("input[name=assetCodeApprove]").val(res.data_update.propTaskMutation[0].propAsset.assetCode);
              $("input[name=assetNameApprove]").val(res.data_update.propTaskMutation[0].propAsset.assetName);
              $("input[name=merkApprove]").val(res.data_update.propTaskMutation[0].propAsset.propAssetPropgenit.merk);
              $("input[name=tipeApprove]").val(res.data_update.propTaskMutation[0].propAsset.propAssetPropgenit.tipe);
              $("input[name=serialNumberApprove]").val(res.data_update.propTaskMutation[0].propAsset.propAssetPropgenit.serialNumber);
              $("input[name=srcRoomIDApprove]").val(res.data_update.propTaskMutation[0].srcRoomID);
              $("input[name=dstRoomIDApprove]").val(res.data_update.propTaskMutation[0].dstRoomID);
              $("input[name=srcRoomNameApprove]").val(res.data_update.propTaskMutation[0].srcRoomName);
              $("input[name=dstRoomNameApprove]").val(res.data_update.propTaskMutation[0].dstRoomName);
              $("textarea[name=mutationDescApprove]").val(res.data_update.propTaskMutation[0].mutationDesc);
              $("textarea[name=mutationDescApprove]").attr("disabled", true);
              $("input[name=userNameApprove]").val(res.data_update.propProgress.initBy);
              $("input[name=initByApprove]").val(res.data_update.propProgress.initBy);
              $("input[name=idInitByApprove]").val(res.data_update.propProgress.idInitBy);
              $("input[name=scheduleStartApprove]").val(res.data_update.propProgress.timeInit);

              if (res.data_update.propTaskMutation[0].mutationType == "Temporary") {
                $("#mutationTypeApprove1").attr("checked", true);
                $("#mutationTypeApprove2").attr("disabled", true);
                $("#timePendingApprove").attr("disabled", true);
                $("#timePendingApprove").val(res.data_update.propTaskMutation[0].returnDatePlan);
              } else {
                $("#mutationTypeApprove2").attr("checked", true);
                $("#mutationTypeApprove1").attr("disabled", true);
                $("#timePendingApprove").attr("disabled", true);
              }
            }
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

  function hapus() {
    // create function delete
    $('#modal_delete_mtn').click(function() {
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
                      Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: response.queryMessage,
                      });

                      $('.samrs-table1').DataTable().ajax.reload();
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
