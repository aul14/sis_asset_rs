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
    <action-button-card title="Electromedic Task - Calibration Schedule & Report">
      <template v-slot:buttons>
        <table-init></table-init>
        <?php if ($result_role[2]['subMenu1'][0]['subMenu2'][0]['subMenu3'][0]['subMenu4'][0]['isAllow'] == true) : ?>
          <add-data modal="calibration_form"></add-data>
        <?php endif; ?>
        <?php if ($result_role[2]['subMenu1'][0]['subMenu2'][0]['subMenu3'][0]['subMenu4'][1]['isAllow'] == true) : ?>
          <!-- <edit-data button-id="modal_edit_calib"></edit-data> -->
          <div class="grid-box">
            <a href="javascript:void(0)" id="modal_edit_calib" class="btn btn-block samrs-success"><i class="fas fa-edit"></i> Edit</a>
          </div>
        <?php endif; ?>
        <?php if ($result_role[2]['subMenu1'][0]['subMenu2'][0]['subMenu3'][0]['subMenu4'][2]['isAllow'] == true) : ?>
          <delete-data button-id="modal_delete_calib"></delete-data>
        <?php endif; ?>

        <?php if ($result_role[2]['subMenu1'][0]['subMenu2'][0]['subMenu3'][0]['subMenu4'][3]['isAllow'] == true) : ?>
          <print-data modal="task_print"></print-data>
        <?php endif; ?>
        <?php if ($result_role[2]['subMenu1'][0]['subMenu2'][0]['subMenu3'][0]['subMenu4'][4]['isAllow'] == true) : ?>
          <table-advance-search overlay="advanced_search"></table-advance-search>
        <?php endif; ?>
        <?php if ($result_role[2]['subMenu1'][0]['subMenu2'][0]['subMenu3'][0]['subMenu4'][5]['isAllow'] == true) : ?>
          <table-column-view></table-column-view>
        <?php endif; ?>
      </template>
      <template v-slot:content>
        <form action="" method="get">
          <advanced-search></advanced-search>
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
      // "order": [
      //   [1, "asc"]
      // ],
      colResize: {
        "handleWidth": 50
      },
      select: {
        style: 'multi',
        info: false
      },

      "ajax": {
        "url": BASE_URL + "task/med/calibration/schedule_report/data_table",
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
          "taskSysCat": "MED",
          "taskCode": "CAL",

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
          name: 'Status',
          data: 'status_img'
        },
        {
          title: 'Asset Code',
          name: 'idAsset',
          data: 'assetCode'
        },
        {
          title: 'Asset Name',
          name: 'assetName',
          data: 'assetName',
        },
        {
          title: 'Merk',
          name: 'merk',
          data: 'merk',
        },
        {
          title: 'Type',
          name: 'tipe',
          data: 'tipe',
        },
        {
          title: 'Serial Number',
          name: 'serialNumber',
          data: 'serialNumber',
        },
        {
          title: 'Room Name',
          name: 'roomName',
          data: 'roomName'
        },
        {
          title: 'Floor',
          name: 'floorName',
          data: 'floorName',
        },
        {
          title: 'Building Name',
          name: 'buildingName',
          data: 'buildingName',
        },

        {
          title: 'Planning Date',
          name: 'scheduleStart',
          data: 'scheduleStart'
        },
        {
          title: 'Work Date',
          name: 'timeFinish',
          data: 'implementation_date'
        },
        {
          title: 'Institution Calibration',
          name: 'contactCompany',
          data: 'contactCompany',
          defaultContent: '-'
        },
        {
          title: 'Service Price',
          name: 'calitemPrice',
          data: 'calibration_service_price'
        },
        {
          title: 'Certificate Number',
          name: 'docNumber',
          data: 'sertificate_number'
        },
        {
          title: 'Calibration Result',
          name: 'calibResult',
          data: 'calibResult'
        },
        {
          title: 'File Certificate',
          name: 'fileName',
          data: 'file'
        },
        {
          title: 'Calibration Note',
          name: 'noteCalib',
          data: 'note'
        },
      ],

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

    update_cal();

    hapus();

    edit(table);

    return table;
  }

  function edit(table) {
    $("#modal_edit_calib").click(function() {
      let idTask = [];

      // Read all checked checkboxes
      $("input:checkbox[class=delete_check]:checked").each(function() {
        idTask.push($(this).val());

        assetReport = $(this).data('asset');
        taskReport = $(this).data('task');
      });


      if (idTask.length == 1) {

        var timeStart = table.rows({
          selected: true
        }).data().pluck('implementation_date')[0];

        if (timeStart != "-") {

          $('#task_calibration_form').modal('show');
          $.ajax({
            type: "POST",
            url: BASE_URL + "task/med/calibration/schedule_report/by_id_calibration",
            data: {
              'idTask': taskReport,
              'idAsset': assetReport
            },
            dataType: "json",
            success: function(res) {
              // console.log(res);
              let url_action_approve = BASE_URL + "task/med/calibration/schedule_report/update_action_approve";
              $("#editcalibration").attr("action", url_action_approve);

              $("input[name=finishDate]").val(res.propItemProgress.timeFinish);

              $("select[name=idVendor]").val(res.calitemVendor).change();
              if (res.propCertificate != null) {
                $("input[name=sertificateNumber]").val(res.propCertificate.docNumber);
              }
              $("input[name=servicePrice]").val(res.calitemPrice);
              $("input[name=calitemProgress]").val(res.calitemProgress);
              $("textarea[name=note]").val(res.noteCalib);
              $("input[name=idTaskReport]").val(res.idTask);
              $("input[name=idAssetReport]").val(res.idAsset);
              $("input[name=scheduleStart]").val(res.propItemSchedule.scheduleStart)

              if (res.calibResult == "Laik" || res.calibResult == "on") {
                $('#calibrationResult1').prop('checked', true).change();
              } else {
                $('#calibrationResult2').prop('checked', true).change();
              }
              // $("input[name=scheduleStartNext]").val(res);

              $.ajax({
                type: "POST",
                url: BASE_URL + "task/med/calibration/schedule_report/auto_date",
                data: {
                  scheduleStart: res.propItemSchedule.scheduleStart
                },
                dataType: "json",
                success: function(res) {
                  // console.log(res);
                  $("input[name=scheduleStartNext]").val(res);
                }
              });
            }
          });

        } else {
          $('#calibration_form').modal('show');
          $.ajax({
            type: "POST",
            url: BASE_URL + "task/med/calibration/schedule_report/by_id_task",
            data: {
              'idTask': idTask
            },
            dataType: "json",
            success: function(res) {
              $("#title-calibration").html("update calibration");
              $("input[name=idTask]").val(res.idTask);
              $("input[name=idProgress]").val(res.propProgress.idProgress);
              $("input[name=idSchedule]").val(res.idSchedule);
              $("input[name=taskName]").val(res.taskName);
              $("input[name=taskDesc]").val(res.taskDesc);
              $("input[name=scheduleStart]").val(res.propSchedule.scheduleStart);
              $("input[name=formType]").val("edit");

              $('#btn-asset-pick').css({
                'display': 'none'
              });
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


  function update_cal() {
    $(document).on('click', '#update-cal', function() {
      // e.preventDefault();
      let idTask = $(this).data('idtask');
      let idAsset = $(this).data('idasset');
      let schedule = $(this).data('schedule');

      // alert(`cek ${idTask}, ${idAsset}`);
      $("input[name=idTaskReport]").val(idTask);
      $("input[name=idAssetReport]").val(idAsset);
      $("input[name=scheduleStart]").val(schedule);

      $('#task_calibration_form').modal('show');

      $.ajax({
        type: "POST",
        url: BASE_URL + "task/med/calibration/schedule_report/auto_date",
        data: {
          scheduleStart: schedule
        },
        dataType: "json",
        success: function(res) {
          // console.log(res);
          $("input[name=scheduleStartNext]").val(res);
        }
      });



    });
  }

  function hapus() {
    $("#modal_delete_calib").click(function() {
      // e.preventDefault();
      let idTask = [];
      let idAssetDel = [];
      // Read all checked checkboxes
      $("input:checkbox[class=delete_check]:checked").each(function() {
        idTask.push($(this).val());
        idAssetDel.push($(this).data('asset'));
      });

      // console.log(idAssetDel);
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
                  url: BASE_URL + "task/med/calibration/schedule_report/delete",
                  data: {
                    'idTask': idTask,
                    'idAsset': idAssetDel,
                    //'coba':itemData.toArray()
                  },
                  dataType: 'json',
                  success: function(response) {
                    // console.log(response.queryResult)
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
