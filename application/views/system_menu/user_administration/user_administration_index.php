<main dir="ltr" class="page-wrapper full-height" id="App">
  <main-app>
    <action-button-card title="System - User Administration">
      <template v-slot:buttons>
        <table-init></table-init>
        <?php if ($result_role[6]['subMenu1'][1]['subMenu2'][0]['isAllow'] == true) : ?>
          <add-data modal="adduser_form"></add-data>
        <?php endif; ?>
        <?php if ($result_role[6]['subMenu1'][1]['subMenu2'][1]['isAllow'] == true) : ?>
          <edit-data button-id="modal_edit_user"></edit-data>
        <?php endif; ?>
        <?php if ($result_role[6]['subMenu1'][1]['subMenu2'][2]['isAllow'] == true) : ?>
          <delete-data button-id="modal_delete_user"></delete-data>
        <?php endif; ?>
        <!-- <table-advance-search overlay="advanced_search"></table-advance-search> -->
        <table-column-view></table-column-view>
      </template>
      <template v-slot:content>
        <samrs-overlay overlay-id="advanced_search" title="Advanced Search">
          <advanced-search-box></advanced-search-box>
        </samrs-overlay>
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
        "url": BASE_URL + "system_menu/user_admin/data_table",
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
          title: 'Username',
          name: 'userName',
          data: 'userName'
        },
        {
          title: 'Name',
          name: 'userFullName',
          data: 'userFullName'
        },
        {
          title: 'Email',
          name: 'userMail',
          data: 'userMail'
        },
        {
          title: 'Phone',
          name: 'userPhone',
          data: 'userPhone'
        },
        {
          title: 'Role',
          name: 'roleName',
          data: 'propRole.roleName'
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

  function edit() {
    $('#modal_edit_user').click(function() {
      // e.preventDefault();
      // console.log('keluar sini');
      var idUser = [];
      // Read all checked checkboxes
      $("input:checkbox[class=delete_check]:checked").each(function() {
        idUser.push($(this).val());
      });
      // console.log(idAsset);
      if (idUser.length == 1) {
        $('#adduser_form').modal('show');
        $.ajax({
          type: "POST",
          url: BASE_URL + "system_menu/user_admin/user_by_id",
          data: {
            'idUser': idUser
          },
          dataType: "json",
          success: function(res) {
            $("#title-user").html("edit user");
            $('#div-password').css({
              'display': 'none'
            });

            $("input[name=formType]").val("edit");
            $("input[name=userFullName]").val(res.data_update.userFullName);
            $("input[name=idUser]").val(res.data_update.idUser);
            $("input[name=idHospital]").val(res.data_update.idHospital);
            $("input[name=userName]").val(res.data_update.userName);
            $("input[name=userMail]").val(res.data_update.userMail);
            $("input[name=userMail]").prop('disabled', true);
            $("input[name=userPass]").prop('required', false);
            $("input[name=userPhone]").val(res.data_update.userPhone);

            if (res.data_update.idRole != '') {
              $('#option-ajax-role').html(res.data_update.propRole.roleName);
              $('#option-ajax-role').val(res.data_update.idRole);
              $('.selectpicker-role').selectpicker('refresh');
            }
          }
        });
      } else {
        Swal.fire({
          icon: 'warning',
          title: 'Oops...',
          text: (idUser.length > 1) ? "You choose more than 1 item, please choose one item to be edited" : "Select Items to be Edited",
        });
      }
    });
  }

  function hapus() {
    $('#modal_delete_user').click(function() {
      // e.preventDefault();
      // console.log('keluar sini');
      var idUser = [];
      // Read all checked checkboxes
      $("input:checkbox[class=delete_check]:checked").each(function() {
        idUser.push($(this).val());
      });
      // console.log(idAsset);
      if (idUser.length > 0) {
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
                  url: BASE_URL + "system_menu/user_admin/delete",
                  data: {
                    'idUser': idUser,
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
