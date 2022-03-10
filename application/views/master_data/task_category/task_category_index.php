<main dir="ltr" class="page-wrapper full-height" id="App">
  <main-app>
    <action-button-card title="Master Data - Task Category">
      <template v-slot:buttons>
        <table-init></table-init>
        <?php if ($result_role[4]['subMenu1'][11]['subMenu2'][0]['isAllow'] == true) : ?>
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
        "url": BASE_URL + "master_data/task_category/data_table",
        "dataType": "json",
        "data": {},
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
          title: 'Task Code',
          name: 'taskCode',
          data: 'taskCode'
        },
        {
          title: 'Task Sys Code',
          name: 'taskSysCode',
          data: 'taskSysCode'
        },
        {
          title: 'Task Name',
          name: 'taskName',
          data: 'taskName'
        },
        {
          title: 'Need Approval',
          name: 'needApproval',
          data: 'needApproval'
        },
        {
          title: 'Need Form',
          name: 'needForm',
          data: 'needForm'
        },
        {
          title: 'Task Table',
          name: 'taskTable',
          data: 'taskTable'
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

    //call function hapus
    hapus();

    edit();

    return table;
  }

  function edit() {
    $("#modal_edit_task").click(function() {
      // e.preventDefault();
      var taskCode = [];
      // Read all checked checkboxes
      $("input:checkbox[class=delete_check]:checked").each(function() {
        taskCode.push($(this).val());
      });

      if (taskCode.length == 1) {
        $('#taskcategory_form').modal('show');
        $.ajax({
          type: "POST",
          url: BASE_URL + "master_data/task_category/taskcategory_by_id",
          data: {
            'taskCode': taskCode
          },
          dataType: "json",
          success: function(res) {
            $("#title-task-category").html("Update task category");
            $("input[name=formType]").val("edit");
            $("input[name=taskCode]").val(res.data_update.taskCode);
            $('input[name=taskName]').val(res.data_update.taskName);
            $('input[name=taskTable]').val(res.data_update.taskTable);

            $("input[name=taskCode]").attr('readonly', true);

            if (res.data_update.needForm == true) {
              $('#needForm1').prop('checked', true).change();
            } else {
              $('#needForm2').prop('checked', true).change();
            }

            if (res.data_update.needApproval == true) {
              $('#needApproval1').prop('checked', true).change();
            } else {
              $('#needApproval2').prop('checked', true).change();
            }

          }
        });

      } else {
        Swal.fire({
          icon: 'warning',
          title: 'Oops...',
          text: (taskCode.length > 1) ? "You choose more than 1 item, please choose one item to be edited" : "Select Items to be Edited",
        });
      }
    });
  }

  function hapus() {
    $("#modal_delete_task").click(function() {
      // e.preventDefault();
      var taskCode = [];
      // Read all checked checkboxes
      $("input:checkbox[class=delete_check]:checked").each(function() {
        taskCode.push($(this).val());
      });

      if (taskCode.length > 0) {
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
                  url: BASE_URL + "master_data/task_category/delete",
                  data: {
                    'taskCode': taskCode,
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
</script>