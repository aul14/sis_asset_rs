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
    <action-button-card title="Electromedic Task - Complain">
      <template v-slot:buttons>
        <table-init></table-init>
        <?php if ($result_role[2]['subMenu1'][0]['subMenu2'][4]['subMenu3'][0]['isAllow'] == true) : ?>
          <approve-data button-id="modal_approve_repair"></approve-data>
        <?php endif; ?>
        <?php if ($result_role[2]['subMenu1'][0]['subMenu2'][4]['subMenu3'][1]['isAllow'] == true) : ?>
          <add-data modal="complain_form"></add-data>
        <?php endif; ?>
        <?php if ($result_role[2]['subMenu1'][0]['subMenu2'][4]['subMenu3'][2]['isAllow'] == true) : ?>
          <edit-data button-id="modal_edit_complain"></edit-data>
        <?php endif; ?>
        <?php if ($result_role[2]['subMenu1'][0]['subMenu2'][4]['subMenu3'][3]['isAllow'] == true) : ?>
          <delete-data button-id="modal_delete_complain"></delete-data>
        <?php endif; ?>

        <?php if ($result_role[2]['subMenu1'][0]['subMenu2'][4]['subMenu3'][4]['isAllow'] == true) : ?>
          <div class="grid-box">
            <a id="modal_detail_repair" data-toggle="modal" class="btn btn-block samrs-info"><i class="fas fa-book-open"></i> Details</a>
          </div>
        <?php endif; ?>
        <?php if ($result_role[2]['subMenu1'][0]['subMenu2'][4]['subMenu3'][5]['isAllow'] == true) : ?>
          <print-data modal="task_print"></print-data>
        <?php endif; ?>
        <?php if ($result_role[2]['subMenu1'][0]['subMenu2'][4]['subMenu3'][6]['isAllow'] == true) : ?>
          <table-advance-search overlay="advanced_search"></table-advance-search>
        <?php endif; ?>
        <?php if ($result_role[2]['subMenu1'][0]['subMenu2'][4]['subMenu3'][7]['isAllow'] == true) : ?>
          <table-column-view></table-column-view>
        <?php endif; ?>
      </template>
      <template v-slot:content>
        <form action="" method="get">
          <advanced-search with-status="Yes" have-task-periode="yes" :radio-name="['status']" :radio-label="['Not Work','Pending Work','Finish Not Approved','Approved']" :radio-value="['1','2','3','4']"></advanced-search>
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
        "url": BASE_URL + "task/med/task_datatable/data_table",
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
          "taskSysCat": "MED",
          "taskCode": "CPL",

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
          "data": "propTaskComplain.status",
          "defaultContent": "-"
        },
        {
          title: 'Code',
          name: 'idTask',
          "data": "propTaskComplain.taskComplainCode",
          "defaultContent": "-"
        },
        {
          title: 'Asset Code',
          name: 'idAsset',
          "data": "propTaskComplain.propAsset.assetCode",
          "defaultContent": "-"
        },
        {
          title: 'Asset Name',
          name: 'assetName',
          "data": "propTaskComplain.propAsset.assetName",
          "defaultContent": "-"
        },
        {
          title: 'Merk',
          name: 'merk',
          "data": "propTaskComplain.propAsset.propAssetPropgenit.merk",
          "defaultContent": "-"
        },
        {
          title: 'Type',
          name: 'tipe',
          "data": "propTaskComplain.propAsset.propAssetPropgenit.tipe",
          "defaultContent": "-"
        },
        {
          title: 'Serial Number',
          name: 'serialNumber',
          "data": "propTaskComplain.propAsset.propAssetPropgenit.serialNumber",
          "defaultContent": "-"
        },
        {
          title: 'Room name',
          name: 'roomName',
          "data": "propTaskComplain.propAsset.propAssetPropadmin.propAssetPropbuildingRoom.roomName",
          "defaultContent": "-"
        },
        {
          title: 'Floor name',
          name: 'floorName',
          "data": "propTaskComplain.propAsset.propAssetPropadmin.propAssetPropbuildingRoom.floorName",
          "defaultContent": "-"
        },
        {
          title: 'Building',
          name: 'buildingName',
          "data": "propTaskComplain.propAsset.propAssetPropadmin.propAssetPropbuildingRoom.buildingName",
          "defaultContent": "-"
        },
        {
          title: 'Complain Date',
          name: 'timeInit',
          "data": "propProgress.timeInit",
          "defaultContent": "-"
        },
        {
          title: 'Repair Date',
          name: 'timeStart',
          "data": "propProgress.timeStart",
          "defaultContent": "-"
        },
        {
          title: 'Complain Duration',
          name: 'complainDuration',
          "data": "propProgress.complainDuration",
          "defaultContent": "-"
        },
        {
          title: 'Technician',
          name: 'assignTo',
          "data": "propProgress.assignTo",
          "defaultContent": "-"
        },
        {
          title: 'Vendor/Supplier',
          name: 'contactCompany',
          "data": "propContact.contactCompany",
          "defaultContent": "-"
        },
        {
          title: 'Informant',
          name: 'initBy',
          "data": "propProgress.initBy",
          "defaultContent": "-"
        },
        {
          title: 'Complain Description',
          name: 'complainRequest',
          "data": "propTaskComplain.complainRequest",
          "defaultContent": "-"
        },
        // {
        //   title: 'Repair Description',
        //   name: 'complainAction',
        //   "data": "propTaskComplain.complainAction",
        //   "defaultContent": "-"
        // },
      ],
      initComplete: function() {
        this.api().columns().every(function() {
          var column = this;
        });
      },
      // "columnDefs": [{
      //   "orderable": false,
      //   "targets": [0]
      // }],
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


    //cal function edit
    edit();

    //call function hapus
    hapus();

    //call function approve
    // approve(table);

    //call function detaul
    detail(table);

    shortcut_repair();

    return table;
  }

  function shortcut_repair() {
    $(document).on('click', '#shortcut-repair', function() {
      // e.preventDefault();
      let idTask = $(this).data('idtask');
      let idAsset = $(this).data('idasset');
      let idProgress = $(this).data('idprogress');

      $('#repair_form').modal('show');
      $('.btn-repair').css({
        'display': 'none'
      });

      $.ajax({
        type: "POST",
        url: BASE_URL + "task/med/complain/complain_by_id_no_array",
        data: {
          'idTask': idTask
        },
        dataType: "json",
        success: function(res) {
          // console.log(res);

          $("input[name=idRelatedTask]").val(idTask);
          $("input[name=idTaskSignature]").val(idTask);
          $("input[name=idTaskSignatureApprove]").val(idTask);
          $("input[name=idProgress]").val(idProgress);
          $("input[name=idComplain]").val(idTask);
          $("input[name=idAsset]").val(idAsset);

          $("input[name=catCode]").val(res.data_update.propTaskComplain[0].propAsset.catCode);
          $("input[name=complain]").val(res.data_update.taskCode + "-" + res.data_update.idTask);
          $("input[name=assetCode]").val(res.data_update.propTaskComplain[0].propAsset.assetCode);
          $("input[name=assetName]").val(res.data_update.propTaskComplain[0].propAsset.assetName);
          $("input[name=merk]").val(res.data_update.propTaskComplain[0].propAsset.propAssetPropgenit.merk);
          $("input[name=tipe]").val(res.data_update.propTaskComplain[0].propAsset.propAssetPropgenit.tipe);
          $("input[name=serialNumber]").val(res.data_update.propTaskComplain[0].propAsset.propAssetPropgenit.serialNumber);
          $("input[name=roomName]").val(res.data_update.propTaskComplain[0].propAsset.propAssetPropadmin.propAssetPropbuildingRoom.roomName);
          $("input[name=initBy]").val(res.data_update.propProgress.initBy);
          $("input[name=scheduleStart]").val(res.data_update.propProgress.timeInit);
          $("textarea[name=complainRequest]").val(res.data_update.propTaskComplain[0].complainRequest);

          $.ajax({
            type: "POST",
            url: BASE_URL + "task/med/repair/files_by_id_task",
            data: {
              idTask: idTask,
            },
            dataType: "json",
            success: function(res) {
              if (res.data_file.length > 0) {
                $(".insert-gambar").css({
                  visibility: "visible",
                });
                for (i = 0; i < res.data_file.length; i++) {

                  $(".insert-gambar").append(`
                                  <div class="border-dashed p-1 mr-10 ml-10" data-border="dark">
                                    <a href="` + BASE_URL + `assets/upload/file/` + res.data_file[i].fileDesc + `" data-fancybox="preview" data-width="320" data-height="320" title="Click for expand">
                                        <img class="img-responsive zoom is-fix" alt="" src="` + BASE_URL + `assets/upload/file/` + res.data_file[i].fileDesc + `" />
                                     </a>
                                  </div>
                                  `);
                }
              } else {
                $(".insert-gambar").css({
                  visibility: "hidden",
                });
              }
              // console.log(response);
            },
          });
        }
      });
    });
  }

  function detail(table) {
    $("#modal_detail_repair").click(function() {
      var id_related = table.rows({
        selected: true
      }).data().pluck('idRelatedTask').toArray();

      var idTask = [];
      // Read all checked checkboxes
      $("input:checkbox[class=delete_check]:checked").each(function() {
        idTask.push($(this).val());
      });

      if (id_related != 0) {
        // e.preventDefault();
        if (idTask.length == 1) {
          $.ajax({
            type: "POST",
            url: BASE_URL + "task/med/complain/complain_by_id",
            data: {
              idTask: id_related
            },
            dataType: "json",
            success: function(res) {
              $('#complain_repair_details').modal('show');

              let signHash = res.finishSign.search("DRAW");
              let signHashChairman = res.approveSign.search("DRAW");

              if (res.finishSign != "") {
                if (signHash == 0) {
                  $(`#drawOtpTeknisiDetail`).attr("src", BASE_URL + "assets/upload/file/" + res.finishSign.substr(5));
                } else {
                  $(`#drawOtpTeknisiDetail`).attr("src", res.finishSign);
                }
              }

              if (res.approveSign != "") {
                $("#addDrawChairman").remove();
                if (signHashChairman == 0) {
                  $(`#drawOtpChairmanDetail`).attr("src", BASE_URL + "assets/upload/file/" + res.approveSign.substr(5));
                } else {
                  $(`#drawOtpChairmanDetail`).attr("src", res.approveSign);
                }
              }
              // console.log(res);
              $("#app-task-name").html(res.data_update.taskName);
              $("#app-task-code").html(res.data_update.propTaskComplain[0].propAsset.assetCode);
              $("#app-task-asset").html(res.data_update.propTaskComplain[0].propAsset.assetName);
              $("#app-task-room").html(res.data_update.propTaskComplain[0].propAsset.propAssetPropadmin.propAssetPropbuildingRoom.roomName);
              $("#app-task-brand").html(res.data_update.propTaskComplain[0].propAsset.propAssetPropgenit.merk);
              $("#app-task-type").html(res.data_update.propTaskComplain[0].propAsset.propAssetPropgenit.tipe);
              $("#app-task-sn").html(res.data_update.propTaskComplain[0].propAsset.propAssetPropgenit.serialNumber);
              $("#app-task-desc").html(res.data_update.taskDesc);
              $("#app-task-informant").html(res.data_update.propProgress.initBy);
              $("#app-task-cpldate").html(res.data_update.propProgress.timeInit);
              // $("input[name=idprogress_approve]").val(res.data_update.idProgress);

              $("#text-complain").html(res.data_update.propTaskComplain[0].complainRequest);

              if (res.data_update.propTaskRepair[0].propForm != null) {
                $('.progressrecord_list_detail2').DataTable().ajax.url(BASE_URL + "task/med/task_datatable/list_data_record/" + res.data_update.propTaskRepair[0].propForm.idForm).load();
                // $('.pendingstatus_list').DataTable().ajax.url(BASE_URL + "task/med/task_datatable/list_data_record/" + res.data_update.propTaskRepair[0].propForm.idForm).load();
                $('.sparepart_list_detail').DataTable().ajax.url(BASE_URL + "task/med/task_datatable/list_data_stock/" + res.data_update.propTaskRepair[0].propForm.idForm).load();
              }

              $('.name-teknisi').html(res.data_update.propProgress.assignTo);
              $('.name-chairman').html(res.data_update.propProgress.approveBy);
              $("#text-repair-desc").html(res.data_update.propTaskRepair[0].repairNote);
              $("#text-repair-result").html(res.data_update.propTaskRepair[0].repairResult);

              if (res.data_file_related != null) {
                if (res.data_file_related.length > 0) {
                  //ambil gambar complain
                  for (i = 0; i < res.data_file_related.length; i++) {
                    $(".insert-image-complain-detail").append(`
                                  <div class="border-dashed p-1 mr-10 ml-10" data-border="dark">
                                    <a href="data:image/png;base64,` + res.view_file_related[i] + `" data-fancybox="preview" data-width="320" data-height="320" title="Click for expand">
                                        <img class="img-responsive zoom is-fix" alt="" src="data:image/png;base64,` + res.view_file_related[i] + `" />
                                     </a>
                                  </div>
                                  `);

                  }
                }
              }

              if (res.data_update.propTaskFiles.length > 0) {
                //ambil gambar repair
                for (i = 0; i < res.data_update.propTaskFiles.length; i++) {
                  $(".insert-image-repair-detail").append(`
                                  <div class="border-dashed p-1 mr-10 ml-10" data-border="dark">
                                    <a href="data:image/png;base64,` + res.view_task_file[i] + `" data-fancybox="preview" data-width="320" data-height="320" title="Click for expand">
                                        <img class="img-responsive zoom is-fix" alt="" src="data:image/png;base64,` + res.view_task_file[i] + `" />
                                     </a>
                                  </div>
                                  `);

                }
              }
            }
          });
        } else {
          Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: (idTask.length > 1) ? "You choose more than 1 item, please choose one item to be Detail" : "Select Items to be Detail",
          });
        }
      } else {
        if (idTask.length == 1) {
          $.ajax({
            type: "POST",
            url: BASE_URL + "task/med/complain/complain_by_id",
            data: {
              idTask: idTask
            },
            dataType: "json",
            success: function(res) {
              $('#complain_repair_details').modal('show');
              // console.log(res);
              $("#app-task-name").html(res.data_update.taskName);
              $("#app-task-code").html(res.data_update.propTaskComplain[0].propAsset.assetCode);
              $("#app-task-asset").html(res.data_update.propTaskComplain[0].propAsset.assetName);
              $("#app-task-room").html(res.data_update.propTaskComplain[0].propAsset.propAssetPropadmin.propAssetPropbuildingRoom.roomName);
              $("#app-task-brand").html(res.data_update.propTaskComplain[0].propAsset.propAssetPropgenit.merk);
              $("#app-task-type").html(res.data_update.propTaskComplain[0].propAsset.propAssetPropgenit.tipe);
              $("#app-task-sn").html(res.data_update.propTaskComplain[0].propAsset.propAssetPropgenit.serialNumber);
              $("#app-task-desc").html(res.data_update.taskDesc);
              $("#app-task-informant").html(res.data_update.propProgress.initBy);
              $("#app-task-cpldate").html(res.data_update.propProgress.timeInit);
              // $("input[name=idprogress_approve]").val(res.data_update.idProgress);

              $("#text-complain").html(res.data_update.propTaskComplain[0].complainRequest);


              $('.name-teknisi').html(res.data_update.propProgress.assignTo);
              $('.name-chairman').html(res.data_update.propProgress.approveBy);


              if (res.data_update.propTaskFiles.length > 0) {
                //ambil gambar repair
                for (i = 0; i < res.data_update.propTaskFiles.length; i++) {
                  $(".insert-image-complain-detail").append(`
                                  <div class="border-dashed p-1 mr-10 ml-10" data-border="dark">
                                    <a href="data:image/png;base64,` + res.view_task_file[i] + `" data-fancybox="preview" data-width="320" data-height="320" title="Click for expand">
                                        <img class="img-responsive zoom is-fix" alt="" src="data:image/png;base64,` + res.view_task_file[i] + `" />
                                     </a>
                                  </div>
                                  `);

                }
              }
            }
          });
        } else {
          Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: (idTask.length > 1) ? "You choose more than 1 item, please choose one item to be Detail" : "Select Items to be Detail",
          });
        }
      }


    });
  }

  //create function approve
  function approve(table) {
    $("#modal_approve_repair").click(function() {
      var id_related = table.rows({
        selected: true
      }).data().pluck('idRelatedTask').toArray();
      // e.preventDefault();
      var idTask = [];
      // Read all checked checkboxes
      $("input:checkbox[class=delete_check]:checked").each(function() {
        idTask.push($(this).val());
      });

      if (idTask.length == 1) {

        var selectedID = table.rows({
          selected: true
        }).data().pluck('propProgress').pluck('idProgress')[0];

        $.ajax({
          type: "GET",
          url: BASE_URL + "progress/bulk_update?idProgress[]=" + selectedID + "&status=approve",
          dataType: "json",
          success: function(response) {
            if (response.code === 200) {
              $('#complain_repair_approve').modal('show');

              $.ajax({
                type: "POST",
                url: BASE_URL + "task/med/complain/complain_by_id",
                data: {
                  idTask: id_related
                },
                dataType: "json",
                success: function(res) {

                  let signHash = res.finishSign.search("DRAW");
                  let signHashChairman = res.approveSign.search("DRAW");

                  if (res.finishSign != "") {
                    if (signHash == 0) {
                      $(`#drawOtpTeknisiApprove`).attr("src", BASE_URL + "assets/upload/file/" + res.finishSign.substr(5));
                    } else {
                      $(`#drawOtpTeknisiApprove`).attr("src", res.finishSign);
                    }
                  }

                  if (res.approveSign != "") {
                    $("#addDrawChairman").remove();
                    if (signHashChairman == 0) {
                      $(`#drawOtpChairmanApprove`).attr("src", BASE_URL + "assets/upload/file/" + res.approveSign.substr(5));
                    } else {
                      $(`#drawOtpChairmanApprove`).attr("src", res.approveSign);
                    }
                  }

                  $('.name-teknisi').html(res.data_update.propProgress.assignTo);

                  if (res.data_update.propProgress.approveBy != "") {
                    $('.name-chairman').html(res.data_update.propProgress.approveBy);
                  }
                  // console.log(res.data_update.taskName);
                  $("#app-task-approve-name").html(res.data_update.taskName);
                  $("#app-task-approve-code").html(res.data_update.propTaskComplain[0].propAsset.assetCode);
                  $("#app-task-approve-asset").html(res.data_update.propTaskComplain[0].propAsset.assetName);
                  $("#app-task-approve-room").html(res.data_update.propTaskComplain[0].propAsset.propAssetPropadmin.propAssetPropbuildingRoom.roomName);
                  $("#app-task-approve-brand").html(res.data_update.propTaskComplain[0].propAsset.propAssetPropgenit.merk);
                  $("#app-task-approve-type").html(res.data_update.propTaskComplain[0].propAsset.propAssetPropgenit.tipe);
                  $("#app-task-approve-sn").html(res.data_update.propTaskComplain[0].propAsset.propAssetPropgenit.serialNumber);
                  $("#app-task-approve-desc").html(res.data_update.taskDesc);
                  $("#app-task-approve-informant").html(res.data_update.propProgress.initBy);
                  $("#app-task-approve-cpldate").html(res.data_update.propProgress.timeInit);
                  $("input[name=idprogress_approve]").val(res.data_update.idProgress);
                  $("input[name=idTaskSignature]").val(res.data_update.idTask);
                  $("input[name=idTaskSignatureApprove]").val(res.data_update.idTask);

                  $("#text-approve-complain").html(res.data_update.propTaskComplain[0].complainRequest);

                  $('.progressrecord_list_detail').DataTable().ajax.url(BASE_URL + "task/med/task_datatable/list_data_record/" + res.data_update.propTaskRepair[0].propForm.idForm).load();
                  // $('.pendingstatus_list').DataTable().ajax.url(BASE_URL + "task/med/task_datatable/list_data_record/" + res.data_update.propTaskRepair[0].propForm.idForm).load();
                  $('.sparepart_list').DataTable().ajax.url(BASE_URL + "task/med/task_datatable/list_data_stock/" + res.data_update.propTaskRepair[0].propForm.idForm).load();


                  $("#text-repair-approve-desc").html(res.data_update.propTaskRepair[0].repairNote);
                  $("#text-repair-approve-result").html(res.data_update.propTaskRepair[0].repairResult);

                  if (res.data_file_related != null) {
                    if (res.data_file_related.length > 0) {
                      //ambil gambar complain
                      for (i = 0; i < res.data_file_related.length; i++) {
                        $(".insert-image-complain").append(`
                                  <div class="border-dashed p-1 mr-10 ml-10" data-border="dark">
                                    <a href="data:image/png;base64,` + res.view_file_related[i] + `" data-fancybox="preview" data-width="320" data-height="320" title="Click for expand">
                                        <img class="img-responsive zoom is-fix" alt="" src="data:image/png;base64,` + res.view_file_related[i] + `" />
                                     </a>
                                  </div>
                                  `);

                      }
                    }
                  }

                  if (res.data_update.propTaskFiles.length > 0) {
                    //ambil gambar repair
                    for (i = 0; i < res.data_update.propTaskFiles.length; i++) {
                      $(".insert-image-repair").append(`
                                  <div class="border-dashed p-1 mr-10 ml-10" data-border="dark">
                                    <a href="data:image/png;base64,` + res.view_task_file[i] + `" data-fancybox="preview" data-width="320" data-height="320" title="Click for expand">
                                        <img class="img-responsive zoom is-fix" alt="" src="data:image/png;base64,` + res.view_task_file[i] + `" />
                                     </a>
                                  </div>
                                  `);

                    }
                  }
                }
              });
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
      } else {
        Swal.fire({
          icon: 'warning',
          title: 'Oops...',
          text: (idTask.length > 1) ? "You choose more than 1 item, please choose one item to be Approve" : "Select Items to be Approve",
        });
      }

    });
  }
  //create function delete
  function hapus() {
    // create function delete
    $('#modal_delete_complain').click(function() {
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
                  url: BASE_URL + "task/med/complain/delete",
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

  //create function edit
  function edit() {
    $("#modal_edit_complain").click(function() {
      // e.preventDefault();
      var idTask = [];
      // Read all checked checkboxes
      $("input:checkbox[class=delete_check]:checked").each(function() {
        idTask.push($(this).val());
      });

      if (idTask.length == 1) {
        $('#complain_form').modal('show');
        $.ajax({
          type: "POST",
          url: BASE_URL + "task/med/complain/complain_by_id",
          data: {
            idTask: idTask
          },
          dataType: "json",
          success: function(res) {
            $("#title-complain").html("Update Complain");
            $("input[name=initBy]").val(res.data_update.propProgress.initBy);
            $("input[name=scheduleStart]").val(res.data_update.propSchedule.scheduleStart);
            $("input[name=idProgress]").val(res.data_update.idProgress);
            $("input[name=idRelatedTask]").val(res.data_update.idRelatedTask);
            $("input[name=idSchedule]").val(res.data_update.idSchedule);
            $("input[name=idTask]").val(res.data_update.idTask);
            $("input[name=idTask_edit]").val(res.data_update.idTask);
            $("input[name=taskName]").val(res.data_update.taskName);
            $("input[name=taskDesc]").val(res.data_update.taskDesc);
            $("input[name=idAsset]").val(res.data_update.propTaskComplain[0].propAsset.idAsset);
            $("input[name=assetCode]").val(res.data_update.propTaskComplain[0].propAsset.assetCode);
            $("input[name=assetName]").val(res.data_update.propTaskComplain[0].propAsset.assetName);
            $("input[name=merk]").val(res.data_update.propTaskComplain[0].propAsset.propAssetPropgenit.merk);
            $("input[name=tipe]").val(res.data_update.propTaskComplain[0].propAsset.propAssetPropgenit.tipe);
            $("input[name=serialNumber]").val(res.data_update.propTaskComplain[0].propAsset.propAssetPropgenit.serialNumber);
            $("input[name=roomName]").val(res.data_update.propTaskComplain[0].propAsset.propAssetPropadmin.propAssetPropbuildingRoom.roomName);
            $("textarea[name=complainRequest]").val(res.data_update.propTaskComplain[0].complainRequest);

            if (res.data_update.propTaskComplain[0].complainPriority == 1) {
              $("#complainPriority").prop('checked', true);
            } else {
              $("#complainPriority").prop('checked', false);
            }

            $('#btn-pick-complain').css({
              'display': 'none'
            });

            if (res.data_update.propTaskFiles != '') {
              $("input[name=idTaskFile1]").val(res.data_update.propTaskFiles[0].idTaskFile);
              $("input[name=idFile1]").val(res.data_update.propTaskFiles[0].idFile);
              $("input[name=fileDesc1]").val(res.data_update.propTaskFiles[0].fileDesc);
              if (res.data_update.propTaskFiles[1] != null) {
                $("input[name=idTaskFile2]").val(res.data_update.propTaskFiles[1].idTaskFile);
                $("input[name=idFile2]").val(res.data_update.propTaskFiles[1].idFile);
                $("input[name=fileDesc2]").val(res.data_update.propTaskFiles[1].fileDesc);
              }

              $('.view-file-edit').css({
                'display': ''
              });

              if (res.data_update.propTaskFiles.length > 0) {
                for (i = 0; i < res.data_update.propTaskFiles.length; i++) {
                  $(".view-file-edit").append(`<div class="col-xl-4">
                  <div class="card" style="width: 8rem;">
                    <img src="` + BASE_URL + `assets/upload/file/` + res.data_update.propTaskFiles[i].fileDesc + `" class="card-img-top" alt="...">
                    <div class="card-body">
                    <a href="` + BASE_URL + `file/file_download/` + res.data_update.propTaskFiles[i].propFile.idFile + `"  class="file-download">
                      <i class="mdi mdi-download"></i> Download File
                    </a>
                    </div>
                  </div>
                  </div>`);

                }
              }
            } else {
              $('.view-file-edit').css({
                'display': 'none'
              });
            }

          }
        });
      } else {
        Swal.fire({
          icon: 'warning',
          title: 'Oops...',
          text: (idTask.length > 1) ? "You choose more than 1 item, please choose one item to be edited" : "Select Items to be Edited",
        });
      }

    });
  }

  function ActiveIndex(index) {
    if (index === 0) {
      return 'active';
    }
  }
</script>
