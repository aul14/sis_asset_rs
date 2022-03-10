<main dir="ltr" class="page-wrapper full-height" id="App">
  <main-app>
    <action-button-card title="Master Data - Installation">
      <template v-slot:buttons>
        <table-init></table-init>
        <?php if ($result_role[4]['subMenu1'][1]['subMenu2'][0]['isAllow'] == true) : ?>
          <add-data modal="installation_form"></add-data>
        <?php endif; ?>
        <?php if ($result_role[4]['subMenu1'][1]['subMenu2'][1]['isAllow'] == true) : ?>
          <edit-data button-id="modal_edit_org"></edit-data>
        <?php endif; ?>
        <?php if ($result_role[4]['subMenu1'][1]['subMenu2'][2]['isAllow'] == true) : ?>
          <delete-data button-id="modal_delete_org"></delete-data>
        <?php endif; ?>
        <?php if ($result_role[4]['subMenu1'][1]['subMenu2'][3]['isAllow'] == true) : ?>
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
        "url": BASE_URL + "master_data/installation/data_table",
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
          title: 'Installation Code',
          name: 'orgCode',
          data: 'orgCode'
        },
        {
          title: 'Parent Installation',
          name: 'orgParent',
          data: 'orgParent'
        },
        {
          title: 'Installation Name',
          name: 'orgName',
          data: 'orgName'
        },
        {
          title: 'Installation Type',
          name: 'orgType',
          data: 'orgType'
        },
        {
          title: 'Installation Description',
          name: 'orgDesc',
          data: 'orgDesc'
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
    $("#modal_edit_org").click(function() {
      // e.preventDefault();
      var orgCode = [];
      // Read all checked checkboxes
      $("input:checkbox[class=delete_check]:checked").each(function() {
        orgCode.push($(this).val());
      });

      if (orgCode.length == 1) {
        $('#installation_form').modal('show');
        $.ajax({
          type: "POST",
          url: BASE_URL + "master_data/installation/org_by_id",
          data: {
            'orgCode': orgCode
          },
          dataType: "json",
          success: function(res) {
            $("#title-org").html("Update installation");
            $("input[name=formType]").val("edit");
            $("input[name=orgCode]").val(res.data_update.orgCode);
            $('input[name=orgDesc]').val(res.data_update.orgDesc);
            $('input[name=orgName]').val(res.data_update.orgName);
            $('#orgType').val(res.data_update.orgType);

            if (res.data_update.orgParent != "") {
              $('#option-ajax-parent').val(res.data_update.orgParent);
              $('#option-ajax-parent').html(res.data_update.orgParent);
              $('.selectpicker-parent').selectpicker('refresh');
            }
          }
        });

      } else {
        Swal.fire({
          icon: 'warning',
          title: 'Oops...',
          text: (orgCode.length > 1) ? "You choose more than 1 item, please choose one item to be edited" : "Select Items to be Edited",
        });
      }
    });
  }

  function hapus() {
    $("#modal_delete_org").click(function() {
      // e.preventDefault();
      var orgCode = [];
      // Read all checked checkboxes
      $("input:checkbox[class=delete_check]:checked").each(function() {
        orgCode.push($(this).val());
      });

      if (orgCode.length > 0) {
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
                  url: BASE_URL + "master_data/installation/delete",
                  data: {
                    'orgCode': orgCode,
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
