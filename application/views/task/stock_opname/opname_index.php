<main dir="ltr" class="page-wrapper full-height" id="App">
  <main-app>
    <action-button-card title="Inventory Opname">
      <template v-slot:buttons>
        <table-init></table-init>
        <?php if ($result_role[2]['subMenu1'][2]['subMenu2'][0]['isAllow'] == true) : ?>
          <add-data modal="opname_form"></add-data>
        <?php endif; ?>
        <?php if ($result_role[2]['subMenu1'][2]['subMenu2'][1]['isAllow'] == true) : ?>
          <edit-data button-id="modal_edit_stockopname"></edit-data>
        <?php endif; ?>
        <?php if ($result_role[2]['subMenu1'][2]['subMenu2'][2]['isAllow'] == true) : ?>
          <delete-data button-id="modal_delete_stockopname"></delete-data>
        <?php endif; ?>
        <?php if ($result_role[2]['subMenu1'][2]['subMenu2'][3]['isAllow'] == true) : ?>
          <detail-data button-id="modal_detail_stockopname"></detail-data>
        <?php endif; ?>

        <?php if ($result_role[2]['subMenu1'][2]['subMenu2'][4]['isAllow'] == true) : ?>
          <!-- <print-data modal="opname_print"></print-data> -->
          <div class="grid-box">
            <a id="modal_print_stockopname" class="btn btn-block samrs-gray" style="color: white;"><i class="fas fa-print"></i> Print</a>
          </div>
        <?php endif; ?>
        <?php if ($result_role[2]['subMenu1'][2]['subMenu2'][5]['isAllow'] == true) : ?>
          <table-advance-search overlay="advanced_search"></table-advance-search>
        <?php endif; ?>
        <?php if ($result_role[2]['subMenu1'][2]['subMenu2'][6]['isAllow'] == true) : ?>
          <table-column-view></table-column-view>
        <?php endif; ?>
      </template>
      <template v-slot:content>
        <form action="<?= base_url('task/stock_opname'); ?>" method="get">
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
          "start_dateq1": "<?php echo $this->input->get('start_dateq1') ? $this->input->get('start_dateq1') : ''; ?>",
          "start_dateq2": "<?php echo $this->input->get('start_dateq2') ? $this->input->get('start_dateq2') : ''; ?>",
          "startDate": "<?php echo $this->input->get('startDate') ? $this->input->get('startDate') : ''; ?>",
          "endDate": "<?php echo $this->input->get('endDate') ? $this->input->get('endDate') : ''; ?>",
          // "taskSysCat": "ALL",
          "taskCode": "SOM",

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
          title: 'Task Name',
          name: 'taskName',
          data: 'taskName'
        },
        {
          title: 'Task Desc',
          name: 'taskDesc',
          data: 'taskDesc'
        },
        {
          title: 'Schedule Start',
          name: 'scheduleStart',
          data: 'propSchedule.scheduleStart'
        },
        {
          title: 'Schedule End',
          name: 'scheduleEnd',
          data: 'propSchedule.scheduleEnd'
        },
        {
          title: 'Task KPI',
          name: 'taskKpi',
          data: 'taskKpi'
        },
        {
          title: 'Task Amount',
          name: 'taskAmount',
          data: 'taskAmount'
        },
        {
          title: 'Scanned',
          name: 'scanned',
          data: 'scanned'
        },
        {
          title: 'Not Scanned',
          name: 'notScanned',
          data: 'notScanned'
        },
        {
          title: 'Total Asset',
          name: 'totalAsset',
          data: 'totalAsset'
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


    //cal function edit
    edit();

    //cal function hapus
    hapus();

    //call function detail opname
    detail();

    print_opname();


    return table;
  }

  function onlyUnique(value, index, self) {
    return self.indexOf(value) === index;
  }

  // create function print
  function print_opname() {
    $("#modal_print_stockopname").click(function() {
      // e.preventDefault();
      var idTask = [];
      // Read all checked checkboxes
      $("input:checkbox[class=delete_check]:checked").each(function() {
        idTask.push($(this).val());
      });

      if (idTask.length > 0) {
        $("#opname_print").modal('show');
        $("#idTaskPrint").val(idTask);
      } else {
        Swal.fire({
          icon: 'warning',
          title: 'Oops...',
          text: "Select Items to be Print",
        });
      }
    });
  }
  //create function detail modal opname
  function detail() {
    $("#modal_detail_stockopname").click(function() {
      // e.preventDefault();
      var idTask = [];
      // Read all checked checkboxes
      $("input:checkbox[class=delete_check]:checked").each(function() {
        idTask.push($(this).val());
      });
      if (idTask.length == 1) {
        $("#opname_details").modal('show');
        $.ajax({
          type: "POST",
          url: BASE_URL + "task/stock_opname/stockopname_detail",
          data: {
            'idTask': idTask
          },
          dataType: "json",
          success: function(res) {
            $("#detail-taskname").html(res.data_update.taskName);
            $("#detail-taskdesc").html(res.data_update.taskDesc);
            $("#detail-kpi").html(res.data_update.taskKpi);
            $("#detail-amount").html(res.data_update.taskAmount);
            $("#detail-start").html(res.data_update.propSchedule.scheduleStart);
            $("#detail-end").html(res.data_update.propSchedule.scheduleEnd);

            // var data_kategori = ;
            if (res.asset_categories != null) {
              for (i = 0; i < res.asset_categories.length; i++) {
                $(".list-asset-category").append(`<li><a href="javascript:void(0)"><i class="fas fa-dot-circle"></i>` + res.asset_categories[i] + `</a></li>`);
              }
            }

            if (res.locations != null) {
              for (i = 0; i < res.locations.length; i++) {
                $(".list-asset-lokasi").append(`<li><a href="javascript:void(0)"><i class="fas fa-dot-circle"></i>` + res.locations[i] + `</a></li>`);
              }
            }

            var html = '';
            var no = 1;
            if (res.data_update.propTaskStockopname.length > 0) {
              for (k = 0; k < res.data_update.propTaskStockopname.length; k++) {
                for (l = 0; l < res.data_update.propTaskStockopname[k].propTaskStockopnameDetail.length; l++) {
                  html += "<tr>";
                  html += '<td>' + no++ + '</td>';
                  html += '<td>' + res.data_update.propTaskStockopname[k].propTaskStockopnameDetail[l].propAsset.assetName + '</td>';
                  html += '<td>' + res.data_update.propTaskStockopname[k].propTaskStockopnameDetail[l].propAsset.kodeBar + '</td>';
                  if (res.data_update.propTaskStockopname[k].propTaskStockopnameDetail[l].isChecked == true) {
                    html += '<td class="text-center"><i class="fas fa-check-circle text-success"></i></td>';
                  } else {
                    html += '<td class="text-center"><i class="fas fa-times-circle text-danger"></i></td>';
                  }
                  html += '<td>' + res.data_update.propTaskStockopname[k].propTaskStockopnameDetail[l].checkedByName + '</td>';
                  html += '<td>' + res.data_update.propTaskStockopname[k].propTaskStockopnameDetail[l].checkedTime + '</td>';
                }
              }
              $('.tbody-opname-detail').html(html);
            }
            // console.log(data_kategori);
            // var unique = data_kategori.filter(onlyUnique);
            // console.log(unique);
            // // if (res.asset_categories != null) {
            // for (i = 0; i < unique.length; i++) {
            //   $(".list-asset-category").append(`<li><a href="javascript:void(0)"><i class="fas fa-dot-circle"></i>` + unique[i] + `</a></li>`);
            // }
            // // }
          }
        });
      } else {
        Swal.fire({
          icon: 'warning',
          title: 'Oops...',
          text: (idTask.length > 1) ? "You choose more than 1 item, please choose one item to be Detail" : "Select Items to be Detail",
        });
      }
    });
  }

  //create function detail tabel edit
  function DetailOpname() {
    var idTaskedit = $("input[name=idTask]").val();
    $('.opname_detail').DataTable({
      "ajax": {
        "url": BASE_URL + "stock_opname_detail/data_table_from_session",
        "type": "POST"
      },
      columns: [{
          title: '#',
          name: null,
          data: null
        },
        {
          title: 'assets code',
          name: 'assets code',
          data: 'propAsset.assetCode'
        },
        {
          title: 'assets name',
          name: 'assets name',
          data: 'propAsset.assetName'
        },
        {
          title: 'category',
          name: 'category',
          data: 'propAsset.propAssetCat.assetCatName'
        },
        {
          title: 'building',
          name: 'building',
          data: 'propAsset.propAssetPropadmin.propAssetPropbuildingRoom.buildingName'
        },
        {
          title: 'floor',
          name: 'floor',
          data: 'propAsset.propAssetPropadmin.propAssetPropbuildingRoom.floorName'
        },
        {
          title: 'room',
          name: 'room',
          data: 'propAsset.propAssetPropadmin.propAssetPropbuildingRoom.roomName'
        },
        {
          title: 'action',
          name: 'action',
          data: null,
          render: function(data, type, row) {
            // console.log(data)
            if (idTaskedit != null) {
              var button = `<a href="<?php echo base_url(); ?>stock_opname_detail/delete_task_stockopname_detail/${data.idTaskOpname}/${data.propAsset.idAsset}" class="btn-deletefile btn btn btn-rounded btn-outline-danger mr-2 btn-sm"><i class="ti-trash"></i></a>`;
            } else {
              var button = `<a href="<?php echo base_url(); ?>stock_opname_detail/delete_from_session/${data.propAsset.idAsset}" class="btn-deletefile btn btn btn-rounded btn-outline-danger mr-2 btn-sm"><i class="ti-trash"></i></a>`;
            }



            return button;
          }
        }
      ],
      "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
        var index = iDisplayIndex + 1;
        var api = this.api();
        var pageInfo = api.page.info();
        var page = pageInfo.page;
        var length = pageInfo.length;

        var number = (page * length) + index;

        $('td:eq(0)', nRow).html(number);
        return nRow;
      },
      retrieve: true,
      "paging": true,
      dom: '<"row"<"col-4"l><"col-8"f>>tr<"col-12"p>',
      searching: true,
      pageLength: 50,
      lengthMenu: [50, 100, 150, 200, 500, 1000],
    });
  }

  //create function delete
  function hapus() {
    $('#modal_delete_stockopname').click(function() {
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

  //create func edit
  function edit() {
    $("#modal_edit_stockopname").click(function() {
      // e.preventDefault();
      var idTask = [];
      // Read all checked checkboxes
      $("input:checkbox[class=delete_check]:checked").each(function() {
        idTask.push($(this).val());
      });
      if (idTask.length == 1) {
        $("#opname_form").modal('show');
        $.ajax({
          type: "POST",
          url: BASE_URL + "task/stock_opname/stockopname_by_id",
          data: {
            'idTask': idTask
          },
          dataType: "json",
          success: function(res) {
            $("#title-opname").html("update task opname");
            $("input[name=idProgress]").val(res.data_update.idProgress);
            $("input[name=idRelatedTask]").val(res.data_update.idRelatedTask);
            $("input[name=idSchedule]").val(res.data_update.idSchedule);
            $("input[name=propSchedule_idSchedule]").val(res.data_update.idSchedule);
            $("input[name=idTask]").val(res.data_update.idTask);
            $("input[name=taskName]").val(res.data_update.taskName);
            $("textarea[name=taskDesc]").val(res.data_update.taskDesc);
            $("input[name=taskKpi]").val(res.data_update.taskKpi);
            $("input[name=taskAmount]").val(res.data_update.taskAmount);
            $("input[name=propSchedule_scheduleStart]").val(res.data_update.propSchedule.scheduleStart);
            $("input[name=propSchedule_scheduleEnd]").val(res.data_update.propSchedule.scheduleEnd);

            $("input[name=idTaskOpname]").val(res.data_update.propTaskStockopname[0].idTaskOpname);
            $("input[name=formType]").val("edit");

            $('.opname_detail').DataTable().ajax.url(BASE_URL + "stock_opname_detail/data_table_task_stockopname_detail/" + res.data_update.idTask).load();

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
</script>
