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
    <action-button-card title="System - Access Control">
      <template v-slot:buttons>
        <table-init></table-init>
        <?php if ($result_role[6]['subMenu1'][2]['subMenu2'][0]['isAllow'] == true) : ?>
          <add-data modal="usercontrol_form"></add-data>
          <!-- <div class="grid-box">
            <a href="javascript:void(0)" id="modal_add_role" class="btn btn-block samrs-primary"><i class="fas fa-plus"></i> Add new</a>
          </div> -->
        <?php endif; ?>
        <?php if ($result_role[6]['subMenu1'][2]['subMenu2'][1]['isAllow'] == true) : ?>
          <edit-data button-id="modal_edit_roles"></edit-data>
        <?php endif; ?>
        <?php if ($result_role[6]['subMenu1'][2]['subMenu2'][2]['isAllow'] == true) : ?>
          <delete-data button-id="modal_delete_roles"></delete-data>
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
      lengthMenu: [50, 100, 500, 1000],
      colReorder: true,
      colResize: {
        "handleWidth": 50
      },
      select: {
        style: 'multi',
        info: false
      },
      "ajax": {
        "url": BASE_URL + "system_menu/access_control/data_table",
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
          title: 'Role Name',
          name: 'roleName',
          data: "roleName",
          default: "-"
        },
        {
          title: 'Role Description',
          name: 'roleDescription',
          data: "roleDescription",
          default: "-"
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
    $("#modal_edit_roles").click(function() {

      var idRole = [];
      // Read all checked checkboxes
      $("input:checkbox[class=delete_check]:checked").each(function() {
        idRole.push($(this).val());
      });

      if (idRole.length == 1) {
        $('#usercontrol_form').modal('show');
        $.ajax({
          type: "POST",
          url: BASE_URL + "system_menu/access_control/roles_by_id",
          data: {
            'idRole': idRole
          },
          dataType: "json",
          success: function(res) {
            $("#title-roles").html("edit roles");
            $("input[name=formType]").val("edit");

            $("input[name=idRole]").val(res.data_update.idRole);
            $("input[name=roleName]").val(res.data_update.roleName);
            $("textarea[name=roleDescription]").val(res.data_update.roleDescription);
            $("select[name=roleGroup]").val(res.data_update.grpCode).change();

            //untuk menampilkan fitur
            if (res.data_update.roleACL.length > 0) {
              for (i = 0; i < res.data_update.roleACL.length; i++) {
                if (res.data_update.roleACL[i].isAllow == true) {
                  // console.log(res.data_update.roleACL[i].idMenu);
                  $(`#toggle_${res.data_update.roleACL[i].idMenu}`).val(res.data_update.roleACL[i].idMenu).prop('checked', true);
                  $('input[toggle-for]').each(function() {
                    let toggleFor = $(this).attr('toggle-for');
                    if (this.checked === true) {
                      $('.collapse[tag-name="' + toggleFor + '"]').collapse('show');
                    } else {
                      $('.collapse[tag-name="' + toggleFor + '"]').collapse('hide');
                    }
                  });

                  if (res.data_update.roleACL[i].subMenu1[0].menuType == "MENU") {
                    for (j = 0; j < res.data_update.roleACL[i].subMenu1.length; j++) {
                      if (res.data_update.roleACL[i].subMenu1[j].isAllow == true) {
                        $(`#toggle_menu_${res.data_update.roleACL[i].subMenu1[j].idMenu}`).val(res.data_update.roleACL[i].subMenu1[j].idMenu).prop('checked', true);
                        $('input[toggle-for]').each(function() {
                          let toggleFor = $(this).attr('toggle-for');
                          if (this.checked === true) {
                            $('.collapse[tag-name="' + toggleFor + '"]').collapse('show');
                          } else {
                            $('.collapse[tag-name="' + toggleFor + '"]').collapse('hide');
                          }
                        });

                        for (m = 0; m < res.data_update.roleACL[i].subMenu1[j].subMenu2.length; m++) {
                          var code = res.data_update.roleACL[i].subMenu1[j].subMenu2[m].menuCode;
                          var code_split = code.split(".");
                          // console.log(code_split[0]);
                          if (res.data_update.roleACL[i].subMenu1[j].subMenu2[m].isAllow == true) {
                            if (res.data_update.roleACL[i].subMenu1[j].subMenu2[m].subMenu3 != []) {
                              if (res.data_update.roleACL[i].subMenu1[j].subMenu2[m].menuType == "MENU" && res.data_update.roleACL[i].subMenu1[j].subMenu2[m].subMenu3[0] != "MENU") {
                                $(`#btn_${res.data_update.roleACL[i].subMenu1[j].subMenu2[m].idMenu}`).val(res.data_update.roleACL[i].subMenu1[j].subMenu2[m].idMenu).prop('checked', true);


                                for (n = 0; n < res.data_update.roleACL[i].subMenu1[j].subMenu2[m].subMenu3.length; n++) {
                                  if (res.data_update.roleACL[i].subMenu1[j].subMenu2[m].subMenu3[n].isAllow == true) {
                                    $(`#btn_${res.data_update.roleACL[i].subMenu1[j].subMenu2[m].subMenu3[n].idMenu}`).val(res.data_update.roleACL[i].subMenu1[j].subMenu2[m].subMenu3[n].idMenu).prop('checked', true);

                                    if (res.data_update.roleACL[i].subMenu1[j].subMenu2[m].subMenu3[n].subMenu4.length > 0) {
                                      for (c = 0; c < res.data_update.roleACL[i].subMenu1[j].subMenu2[m].subMenu3[n].subMenu4.length; c++) {
                                        // console.log(res.data_update.roleACL[i].subMenu1[j].subMenu2[m].subMenu3[n].subMenu4[c].idMenu);
                                        if (res.data_update.roleACL[i].subMenu1[j].subMenu2[m].subMenu3[n].subMenu4[c].isAllow == true) {
                                          $(`#btn_${res.data_update.roleACL[i].subMenu1[j].subMenu2[m].subMenu3[n].subMenu4[c].idMenu}`).val(res.data_update.roleACL[i].subMenu1[j].subMenu2[m].subMenu3[n].subMenu4[c].idMenu).prop('checked', true);

                                        }
                                      }
                                    }
                                  }
                                }
                              } else {
                                if (res.data_update.roleACL[i].subMenu1[j].subMenu2[m].isAllow == true) {
                                  $(`#btn_${res.data_update.roleACL[i].subMenu1[j].subMenu2[m].idMenu}`).val(res.data_update.roleACL[i].subMenu1[j].subMenu2[m].idMenu).prop('checked', true);

                                }
                              }
                            }
                          }
                        }
                      }
                    }
                  } else {
                    for (k = 0; k < res.data_update.roleACL[i].subMenu1.length; k++) {
                      if (res.data_update.roleACL[i].subMenu1[k].isAllow == true) {
                        $(`#btn_${res.data_update.roleACL[i].subMenu1[k].idMenu}`).val(res.data_update.roleACL[i].subMenu1[k].idMenu).prop('checked', true);
                      }
                    }
                  }
                }
              }
            }

            // menampilkan hospital, building, floor and room
            if (res.data_update.roleHospital.length > 0) {
              for (z = 0; z < res.data_update.roleHospital.length; z++) {

                $(`#cekhos_${res.data_update.roleHospital[z].idRs}`).val(res.data_update.roleHospital[z].idRs).prop('checked', true);

                $(`#hos-${res.data_update.roleHospital[z].idRs}`).show();
                if (res.data_update.roleHospital[z].buildingList.length > 0) {
                  $(`#hospital${res.data_update.roleHospital[z].idRs}`).addClass('show');

                  // console.log(res.data_update.roleHospital[z].idRs);

                  for (x = 0; x < res.data_update.roleHospital[z].buildingList.length; x++) {

                    $(`#bld_${res.data_update.roleHospital[z].buildingList[x].idAsset}_${res.data_update.roleHospital[z].idRs}`).val(res.data_update.roleHospital[z].buildingList[x].idAsset + "|" + res.data_update.roleHospital[z].idRs).prop('checked', true);

                    if (res.data_update.roleHospital[z].buildingList[x].propAssetPropbuildingFloor.length > 0) {

                      for (v = 0; v < res.data_update.roleHospital[z].buildingList[x].propAssetPropbuildingFloor.length; v++) {

                        $(`#floor_${res.data_update.roleHospital[z].buildingList[x].propAssetPropbuildingFloor[v].idFloor}_${res.data_update.roleHospital[z].buildingList[x].idAsset}_${res.data_update.roleHospital[z].idRs}`).val(res.data_update.roleHospital[z].buildingList[x].propAssetPropbuildingFloor[v].idFloor + "|" + res.data_update.roleHospital[z].buildingList[x].idAsset + "|" + res.data_update.roleHospital[z].idRs).prop('checked', true);

                        if (res.data_update.roleHospital[z].buildingList[x].propAssetPropbuildingFloor[v].propAssetPropbuildingRoom.length > 0) {

                          for (r = 0; r < res.data_update.roleHospital[z].buildingList[x].propAssetPropbuildingFloor[v].propAssetPropbuildingRoom.length; r++) {

                            $(`#room_${res.data_update.roleHospital[z].buildingList[x].propAssetPropbuildingFloor[v].propAssetPropbuildingRoom[r].idRoom}_${res.data_update.roleHospital[z].buildingList[x].propAssetPropbuildingFloor[v].idFloor}_${res.data_update.roleHospital[z].buildingList[x].idAsset}_${res.data_update.roleHospital[z].idRs}`).val(res.data_update.roleHospital[z].buildingList[x].propAssetPropbuildingFloor[v].propAssetPropbuildingRoom[r].idRoom + "|" + res.data_update.roleHospital[z].buildingList[x].propAssetPropbuildingFloor[v].idFloor + "|" + res.data_update.roleHospital[z].buildingList[x].idAsset + "|" + res.data_update.roleHospital[z].idRs).prop('checked', true);
                          }
                        }
                      }
                    }
                  }
                }

                if (res.data_update.roleHospital[z].assetCatList.length > 0) {
                  for (b = 0; b < res.data_update.roleHospital[z].assetCatList.length; b++) {

                    $(`#catcode_${res.data_update.roleHospital[z].assetCatList[b].catCode}_${res.data_update.roleHospital[z].idRs}`).val(res.data_update.roleHospital[z].assetCatList[b].catCode + "|" + res.data_update.roleHospital[z].idRs).prop('checked', true);
                  }
                }
              }
            }

            var arr_code = [];
            if (res.data_update.roleTask.length > 0) {
              for (q = 0; q < res.data_update.roleTask.length; q++) {
                let taskcode = res.data_update.roleTask[q].taskCode;
                arr_code.push(taskcode);
                // let taskcode_split = taskcode.split(',');
                // console.log(taskcode_join);
                $(`#taskCode`).val(arr_code);
              }
            }
          }
        });
      } else {
        Swal.fire({
          icon: 'warning',
          title: 'Oops...',
          text: (idRole.length > 1) ? "You choose more than 1 item, please choose one item to be edited" : "Select Items to be Edited",
        });
      }

    });
  }

  function hapus() {
    $('#modal_delete_roles').click(function() {
      // e.preventDefault();
      // console.log('keluar sini');
      var idRole = [];
      // Read all checked checkboxes
      $("input:checkbox[class=delete_check]:checked").each(function() {
        idRole.push($(this).val());
      });
      // console.log(idAsset);
      if (idRole.length > 0) {
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
                  url: BASE_URL + "system_menu/access_control/delete",
                  data: {
                    'idRole': idRole,
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
