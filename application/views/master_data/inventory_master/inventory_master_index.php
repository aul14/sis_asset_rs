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
    <action-button-card title="Master Data - Inventory Master">
      <template v-slot:buttons>
        <table-init></table-init>
        <?php if ($result_role[4]['subMenu1'][4]['subMenu2'][0]['isAllow'] == true) : ?>
          <add-data modal="inventorymaster_form"></add-data>
        <?php endif; ?>
        <?php if ($result_role[4]['subMenu1'][4]['subMenu2'][1]['isAllow'] == true) : ?>
          <edit-data button-id="modal_edit_master"></edit-data>
        <?php endif; ?>
        <?php if ($result_role[4]['subMenu1'][4]['subMenu2'][2]['isAllow'] == true) : ?>
          <delete-data button-id="modal_delete_master"></delete-data>
        <?php endif; ?>
        <?php if ($result_role[4]['subMenu1'][4]['subMenu2'][3]['isAllow'] == true) : ?>
          <table-column-view></table-column-view>
        <?php endif; ?>
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
      colReorder: true,
      colResize: {
        "handleWidth": 50
      },
      select: {
        style: 'multi',
        info: false
      },
      "ajax": {
        "url": BASE_URL + "master_data/inventory_master/data_table",
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
          title: 'Ecri Code',
          name: 'Ecri Code',
          data: 'ecriCode'
        },
        {
          title: 'Simak Code',
          name: 'Simak Code',
          data: 'simakCode'
        },
        {
          title: 'Aspak Code',
          name: 'Aspak Code',
          data: 'aspakCode'
        },
        {
          title: 'Category Code',
          name: 'Category Code',
          data: 'catCode'
        },
        {
          title: 'Asset Master Name',
          name: 'Asset Master Name',
          data: 'assetMasterName'
        },
        {
          title: 'Risk Level',
          name: 'Risk Level',
          data: 'riskLevel'
        },
        {
          title: 'Calib Must',
          name: 'Calib Must',
          data: 'calibMust'
        },
        {
          title: 'Lifetime',
          name: 'Lifetime',
          data: 'lifeTime'
        },
        {
          title: 'Score Maintenance',
          name: 'Score Maintenance',
          data: 'scoreMaintenance'
        },
        {
          title: 'Score Inspection',
          name: 'Score Inspection',
          data: 'scoreInspection'
        },
        {
          title: 'Score Repair',
          name: 'Score Repair',
          data: 'scoreRepair'
        },
        {
          title: 'Created Date',
          name: 'Created Date',
          data: 'createDate'
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
    $("#modal_edit_master").click(function() {
      // e.preventDefault();
      var idAssetMaster = [];
      // Read all checked checkboxes
      $("input:checkbox[class=delete_check]:checked").each(function() {
        idAssetMaster.push($(this).val());
      });

      if (idAssetMaster.length == 1) {
        $('#inventorymaster_form').modal('show');
        $.ajax({
          type: "POST",
          url: BASE_URL + "master_data/inventory_master/master_by_id",
          data: {
            'idAssetMaster': idAssetMaster
          },
          dataType: "json",
          success: function(res) {
            $("#title-master").html("update inventory master");
            $("input[name=idAssetMaster]").val(res.data_update.idAssetMaster);
            $("input[name=assetMasterName]").val(res.data_update.assetMasterName);
            $("input[name=scoreMaintenance]").val(res.data_update.scoreMaintenance);
            $("input[name=scoreRepair]").val(res.data_update.scoreRepair);
            $("input[name=scoreInspection]").val(res.data_update.scoreInspection);
            $("input[name=lifeTime]").val(res.data_update.lifeTime);

            $('#riskLevel').val(res.data_update.riskLevel).change();

            if (res.data_update.calibMust == true) {
              $('#calibmust_yes').prop('checked', true).change();
            } else {
              $('#calibmust_no').prop('checked', true).change();
            }

            // if (res.data_update.lifeTime == 1) {
            //   $('#lifetime_yes').prop('checked', true).change();
            // } else {
            //   $('#lifetime_no').prop('checked', true).change();
            // }

            if (res.data_update.ecriCode != "") {
              $('#option-ajax-ecri').val(res.data_update.ecriCode);
              $('#option-ajax-ecri').html(res.data_update.ecriCode);
              $('.selectpicker-ecri').selectpicker('refresh');
            }

            if (res.data_update.aspakCode != "") {
              $('#option-ajax-aspak').val(res.data_update.aspakCode);
              $('#option-ajax-aspak').html(res.data_update.aspakCode);
              $('.selectpicker-aspak').selectpicker('refresh');
            }

            if (res.data_update.simakCode != "") {
              $('#option-ajax-simak').val(res.data_update.simakCode);
              $('#option-ajax-simak').html(res.data_update.simakCode);
              $('.selectpicker-simak').selectpicker('refresh');
            }

            if (res.data_update.catCode != "") {
              // $('#option-ajax-catcode').val(res.data_update.catCode);
              // $('#option-ajax-catcode').html(res.data_update.catCode);
              $('.selectpicker-catcode').val(res.data_update.catCode).change();
            }


          }
        });

      } else {
        Swal.fire({
          icon: 'warning',
          title: 'Oops...',
          text: (idAssetMaster.length > 1) ? "You choose more than 1 item, please choose one item to be edited" : "Select Items to be Edited",
        });
      }
    });
  }

  function hapus() {
    $("#modal_delete_master").click(function() {
      // e.preventDefault();
      var idAssetMaster = [];
      // Read all checked checkboxes
      $("input:checkbox[class=delete_check]:checked").each(function() {
        idAssetMaster.push($(this).val());
      });

      if (idAssetMaster.length > 0) {
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
                  url: BASE_URL + "master_data/inventory_master/delete",
                  data: {
                    'idAssetMaster': idAssetMaster,
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
