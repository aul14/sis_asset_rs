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
    <action-button-card title="Building - Room">
      <template v-slot:buttons>
        <table-init></table-init>
        <?php if ($result_role[1]['subMenu1'][2]['subMenu2'][1]['subMenu3'][0]['isAllow'] == true) : ?>
          <add-data modal="room_form"></add-data>
        <?php endif; ?>
        <?php if ($result_role[1]['subMenu1'][2]['subMenu2'][1]['subMenu3'][1]['isAllow'] == true) : ?>
          <edit-data button-id="modal_edit_room_bld"></edit-data>
        <?php endif; ?>
        <?php if ($result_role[1]['subMenu1'][2]['subMenu2'][1]['subMenu3'][2]['isAllow'] == true) : ?>
          <delete-data button-id="modal_delete_room_bld"></delete-data>
        <?php endif; ?>
        <?php if ($result_role[1]['subMenu1'][2]['subMenu2'][1]['subMenu3'][3]['isAllow'] == true) : ?>
          <print-qr-data button-id="modal_qr_room"></print-qr-data>
        <?php endif; ?>
        <?php if ($result_role[1]['subMenu1'][2]['subMenu2'][1]['subMenu3'][4]['isAllow'] == true) : ?>
          <print-data modal="assets_print"></print-data>
        <?php endif; ?>
        <?php if ($result_role[1]['subMenu1'][2]['subMenu2'][1]['subMenu3'][5]['isAllow'] == true) : ?>
          <table-advance-search overlay="advanced_search"></table-advance-search>
        <?php endif; ?>
        <!-- <table-quick-view></table-quick-view> -->
        <?php if ($result_role[1]['subMenu1'][2]['subMenu2'][1]['subMenu3'][6]['isAllow'] == true) : ?>
          <table-column-view></table-column-view>
        <?php endif; ?>
      </template>
      <template v-slot:content>
        <form action="<?= base_url('asset/building/room_bld'); ?>" method="get">
          <advanced-search></advanced-search>
        </form>
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
    var table = $('.samrs-table1').DataTable({
      processing: true,
      language: {
        loadingRecords: '&nbsp;',
        processing: '<div class="loader"><div></div><div></div></div>'
      },
      // "bProcessing": true,
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
        "url": BASE_URL + "asset/building/room_bld/room_data_table",
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
        },
        "type": "POST",
        "cache": true
      },
      columns: [{
          title: '<input type="checkbox" id="checkall" class="checkall">',
          name: null,
          orderable: false,
          data: 'check_box_cuk'
        },
        {
          title: 'No',
          name: 'No',
          data: null
        },
        {
          title: 'Room Code',
          name: 'idRoom',
          data: 'room_code'
        },
        {
          title: 'Room Name',
          name: 'roomName',
          data: 'roomName'
        },
        {
          title: 'Floor Name',
          name: 'floorName',
          data: 'floorName'
        },
        {
          title: 'Building Name',
          name: 'buildingName',
          data: 'buildingName'
        },
        {
          title: 'Building Area',
          name: 'buildingArea',
          data: 'buildingArea'
        },
        {
          title: 'Work Unit',
          name: 'workUnit',
          data: 'workUnit'
        },
        {
          title: 'Bed',
          name: 'bedCount',
          data: 'bedCount'
        },
        {
          title: 'Electrical Power',
          name: 'electricalPower',
          data: 'electricalPower'
        },
        {
          title: 'Function',
          name: 'roomDesc',
          data: 'roomDesc'
        },
        {
          title: 'Is Warehouse',
          name: 'isWarehouse',
          data: 'isWarehouse'
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

    // call edit
    edit();

    // call delete
    hapus();


    return table;
  }
  //create function qrcode
  function qr_code() {
    $('#modal_qr_room').click(function() {
      // e.preventDefault();
      var idAsset = [];
      $("input:checkbox[class=delete_check]:checked").each(function() {
        idAsset.push($(this).val());
      });

      if (idAsset.length == 0) {
        Swal.fire({
          icon: 'warning',
          title: 'Oops...',
          text: "Select Items to be Print QR",
        });
      } else {
        $('#select_print_qr').modal('show');
        $(document).one('click', '.print_qrku', function(e) {
          e.preventDefault();
          // return false;
          let _val = $(this).val();
          // console.log(_val);
          if (_val == "cetak_besar") {
            $.ajax({
              type: "POST",
              url: BASE_URL + "asset/qr_print/fullsize_qr",
              data: {
                'roomList': idAsset
              },
              // processData: false,
              // contentType: false,
              cache: false,
              async: false,
              // dataType: "json",
              success: function(response) {
                // console.log(response);
                var w = window.open('about:blank');
                // w.document.open();
                w.document.write(response);
                $('#select_print_qr').modal('hide');
              },
              error: function(xhr, ajaxOptions, thrownError) {
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: thrownError,
                });
              }
            });

          } else if (_val == "cetak_kecil") {
            $.ajax({
              type: "POST",
              url: BASE_URL + "asset/qr_print/smallsize_qr",
              data: {
                'roomList': idAsset
              },
              cache: false,
              async: false,
              // dataType: "json",
              success: function(response) {
                // console.log(response);
                var w = window.open('about:blank');
                // w.document.open();
                w.document.write(response);
                $('#select_print_qr').modal('hide');

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

        });
      }

    });
  }

  // create function hapus
  function hapus() {
    // create function delete
    $('#modal_delete_room_bld').click(function() {
      // e.preventDefault();
      // console.log('keluar sini');
      var idRoom = [];
      // Read all checked checkboxes
      $("input:checkbox[class=delete_check]:checked").each(function() {
        idRoom.push($(this).val());
      });
      // console.log(idRoom);
      if (idRoom.length > 0) {
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
                  url: BASE_URL + "asset/building/room_bld/delete",
                  data: {
                    'idRoom': idRoom,
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

  // create function edit
  function edit() {
    $("#modal_edit_room_bld").click(function() {
      // e.preventDefault();
      var idRoom = [];
      // Read all checked checkboxes
      $("input:checkbox[class=delete_check]:checked").each(function() {
        idRoom.push($(this).val());
      });
      let modalTarget = '#room_form';
      if (idRoom.length == 1) {
        $(modalTarget).modal('show');
        $(modalTarget).find('.samrs-form').append(`
            <div class="loader">
              <div></div>
              <div></div>
            </div>
          `);
        $('#title-room-bld').html('Update Building Room');
        $.ajax({
          type: "POST",
          url: BASE_URL + "asset/building/room_bld/room_by_id",
          data: {
            idRoom: idRoom
          },
          dataType: "json",
          success: function(res) {
            $("input[name=idRoom]").val(res.data_update.idRoom);
            $("input[name=roomCode]").val(res.data_update.roomCode);
            $("input[name=roomName]").val(res.data_update.roomName);
            $("input[name=roomSpace]").val(res.data_update.roomSpace);
            $("select[name=spaceUnit]").val(res.data_update.spaceUnit).change();
            $("select[name=powerUnit]").val(res.data_update.powerUnit).change();
            $("input[name=bedCount]").val(res.data_update.bedCount);
            $("input[name=roomPower]").val(res.data_update.roomPower);
            $("input[name=buildingName]").val(res.data_update.buildingName);
            $("input[name=floorName]").val(res.data_update.floorName);
            $("input[name=roomPJName]").val(res.data_update.roomPJName);
            $("textarea[name=roomDesc]").val(res.data_update.roomDesc);

            $("#option-ajax-building").html(res.data_update.buildingName);
            $("#option-ajax-building").val(res.data_update.idBuilding);
            $('.selectpicker-building').selectpicker('refresh');

            $("#option-ajax-floor").html(res.data_update.floorName);
            $("#option-ajax-floor").val(res.data_update.idFloor);
            $('.selectpicker-floor').selectpicker('refresh');

            $("#option-ajax-workunit").html(res.data_update.workUnit);
            $("#option-ajax-workunit").val(res.data_update.workUnit);
            $('.selectpicker-workunit').selectpicker('refresh');

            $("#option-ajax-person").html(res.data_update.roomPJName);
            $("#option-ajax-person").val(res.data_update.roomPJID);
            $('.selectpicker-person').selectpicker('refresh');

            if (res.data_update.isWarehouse == true) {
              $("#isWarehouse1").attr("checked", true);
            } else {
              $("#isWarehouse2").attr("checked", true);
            }
            $(modalTarget).find('.loader').remove();
          }
        });
      } else {
        Swal.fire({
          icon: 'warning',
          title: 'Oops...',
          text: (idRoom.length > 1) ? "You choose more than 1 item, please choose one item to be edited" : "Select Items to be Edited",
        });
      }
    });
  }
</script>