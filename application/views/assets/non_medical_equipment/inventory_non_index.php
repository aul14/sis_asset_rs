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
    <action-button-card title="Non Medical Equipment - Inventory">
      <template v-slot:buttons>
        <table-init></table-init>
        <?php if ($result_role[1]['subMenu1'][1]['subMenu2'][0]['subMenu3'][0]['isAllow'] == true) : ?>
          <add-data modal="inventory_form"></add-data>
        <?php endif; ?>
        <?php if ($result_role[1]['subMenu1'][1]['subMenu2'][0]['subMenu3'][1]['isAllow'] == true) : ?>
          <edit-data button-id="modal_edit_inventory"></edit-data>
        <?php endif; ?>
        <?php if ($result_role[1]['subMenu1'][1]['subMenu2'][0]['subMenu3'][2]['isAllow'] == true) : ?>
          <delete-data button-id="modal_delete_inventory"></delete-data>
        <?php endif; ?>
        <?php if ($result_role[1]['subMenu1'][1]['subMenu2'][0]['subMenu3'][3]['isAllow'] == true) : ?>
          <detail-data button-id="modal_detail_inventory"></detail-data>
        <?php endif; ?>
        <?php if ($result_role[1]['subMenu1'][1]['subMenu2'][0]['subMenu3'][4]['isAllow'] == true) : ?>
          <print-qr-data button-id="modal_qr_inventory"></print-qr-data>
        <?php endif; ?>
        <?php if ($result_role[1]['subMenu1'][1]['subMenu2'][0]['subMenu3'][5]['isAllow'] == true) : ?>
          <print-data modal="assets_print"></print-data>
        <?php endif; ?>
        <?php if ($result_role[1]['subMenu1'][1]['subMenu2'][0]['subMenu3'][6]['isAllow'] == true) : ?>
          <table-advance-search overlay="advanced_search"></table-advance-search>
        <?php endif; ?>
        <?php if ($result_role[1]['subMenu1'][1]['subMenu2'][0]['subMenu3'][7]['isAllow'] == true) : ?>
          <table-quick-view></table-quick-view>
        <?php endif; ?>
        <?php if ($result_role[1]['subMenu1'][1]['subMenu2'][0]['subMenu3'][8]['isAllow'] == true) : ?>
          <table-column-view></table-column-view>
        <?php endif; ?>
      </template>
      <template v-slot:content>
        <form action="<?= base_url('asset/non/inventory_non'); ?>" method="get">
          <advanced-search></advanced-search>
        </form>
      </template>
    </action-button-card>
    <table-view-card>
      <template v-slot:table-content>
        <table class="samrs-table1 table samrs-tableview samrs-table-striped table-hover">
          <thead>
            <tr>
              <th>
                <input type="checkbox" id="checkall" class="checkall">
              </th>
              <th class="text-center" style="width:50px !important">No</th>
              <?php foreach ($columns as $column) { ?>
                <th class="text-center"><?php echo $column; ?></th>
              <?php } ?>

            </tr>
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
        "url": BASE_URL + "asset/me/inventory_data_table/asset_data_table?vmode=" + "<?= $this->input->get('vmode'); ?>",
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
          "status": "<?php echo $this->input->get('status') ? $this->input->get('status') : ''; ?>",
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
          "sysCatName": "NON",

        },
        "type": "POST",
        "cache": true,
      },
      "columns": [{
          "data": "check_box_cuk"
        },
        {
          "data": null
        },
        <?php foreach ($rows as $row) { ?> {
            <?php $link = explode(".", $row); ?>
              "data": "<?php echo $row; ?>",
              "name": "<?php echo (end($link) == "assetCode" ? "idAsset" : end($link)); ?>",
              "defaultContent": "-"
          },
        <?php } ?>
      ],
      initComplete: function() {
        this.api().columns().every(function() {
          var column = this;
        });
      },
      "columnDefs": [{
          "orderable": false,
          "targets": [0],
        },
        {
          "targets": [1],
          "className": 'text-center'
        },
        <?php foreach ($columns as $key => $column) { ?> {
            "name": "<?= $column; ?>",
            "targets": [<?= $key + 1 + 1; ?>],
            // "title":
          },
        <?php } ?>
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

    //call function edit
    edit();

    //call function hapus
    hapus();

    //call function detail
    detail();

    //call function qr code
    qr_code(table);



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

  function qr_code(table) {
    $('#modal_qr_inventory').click(function() {
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
                'assetList': idAsset
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
                'assetList': idAsset
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

  function ActiveIndex(index) {
    if (index === 0) {
      return 'active';
    }
  }
  //create function detail
  function detail() {
    $('#modal_detail_inventory').click(function() {
      // e.preventDefault();
      var idAsset = [];
      // Read all checked checkboxes
      $("input:checkbox[class=delete_check]:checked").each(function() {
        idAsset.push($(this).val());
      });

      if (idAsset.length == 1) {
        $('#assets_details').modal('show');

        $.ajax({
          type: "POST",
          url: BASE_URL + "asset/non/inventory_non/detail_asset_by_id",
          data: {
            idAsset: idAsset
          },
          dataType: "json",
          success: function(res) {
            $(".td-asset-code").html(res.data_detail.catCode + "-" + res.data_detail.idAsset);
            $(".td-asset-name").html(getNameAsset(res.data_detail.assetName));
            $(".td-asset-brand").html(res.data_detail.propAssetPropgenit.merk);
            $(".td-asset-tipe").html(res.data_detail.propAssetPropgenit.tipe);
            $(".td-asset-sn").html(res.data_detail.propAssetPropgenit.serialNumber);
            $(".td-asset-category").html(res.data_detail.propAssetCat.assetCatName);

            $(".td-asset-lokasi").html(res.data_detail.propAssetPropadmin.propAssetPropbuildingRoom.buildingName + " <br> " + res.data_detail.propAssetPropadmin.propAssetPropbuildingRoom.floorName + " <br> " + res.data_detail.propAssetPropadmin.propAssetPropbuildingRoom.roomName);
            $(".td-asset-kondisi").html(res.data_detail.propAssetPropadmin.condition);
            $(".td-asset-supplier").html(res.data_detail.propAssetPropadmin.propContact.contactCompany);

            $(".td-asset-warranty").html(res.data_detail.propAssetPropgenit.warrantyExpired);
            $(".td-asset-ownership").html(res.data_detail.propAssetPropadmin.ownershipType);

            if (res.data_detail.propAssetPropelectrical != null) {
              $(".td-asset-voltage").html(res.data_detail.propAssetPropelectrical.voltageInput + "/" + res.data_detail.propAssetPropelectrical.voltageOutput);
            }

            $(".td-asset-update").html(res.data_detail.propAssetPropadmin.lastUpdated);

            if (res.data_detail.propAssetProptax != null) {
              $(".td-asset-accuval").html("Rp." + convertToRupiah(res.data_detail.propAssetProptax.accuVal));
              $(".td-asset-bookval").html("Rp." + convertToRupiah(res.data_detail.propAssetProptax.bookVal));
              $(".td-asset-presentdate").html(res.data_detail.propAssetProptax.presentDate);
              $(".td-asset-calcdate").html(res.data_detail.propAssetProptax.calcStart);
              $(".td-asset-residuvaldepre").html("Rp." + convertToRupiah(res.data_detail.propAssetProptax.residuVal));
              $(".td-asset-yearlydepre").html("Rp." + convertToRupiah(res.data_detail.propAssetProptax.yearlyDep));
              $(".td-asset-presentdate").html(res.data_detail.propAssetProptax.presentDate);
              $(".td-asset-purchaseprice").html("Rp." + convertToRupiah(res.data_detail.propAssetProptax.cost));
              $(".td-asset-expected").html(res.data_detail.propAssetProptax.expectedLifeTime + " Year");
              $(".td-asset-accuvaldepre").html("Rp." + convertToRupiah(res.data_detail.propAssetProptax.accuVal));
              $(".td-asset-bookvaldepre").html("Rp." + convertToRupiah(res.data_detail.propAssetProptax.bookVal));
            }

            $(".td-asset-ponumb").html(res.data_detail.propAssetPropadmin.poNumb);
            //$(".td-asset-pricebuy").html("Rp." + convertToRupiah(res.data_detail.propAssetPropadmin.priceBuy));

            $(".td-asset-procuredate").html(res.data_detail.propAssetPropadmin.procureDate);


            if (res.data_detail.propAssetCat.subSysCat == "INST") {
              $("#tab-acc-details").html("instrument piece");
              $(".accesories_list .th-accesories").html("instrument piece");
            } else if (res.data_detail.propAssetCat.subSysCat != "INST") {
              $("#tab-acc-details").html("accesories");
              $(".accesories_list .th-accesories").html("accesories");
            }

            var i;
            var no = 1;
            var no_mut = 1;
            var no_parts = 1;
            var no_parts_mtn = 1;
            var no_cal = 1;
            var no_mtn = 1;
            var no_inp = 1;
            if (res.data_detail.propChildAsset != null) {
              var html = '';
              if (res.data_detail.propChildAsset.length > 0) {
                for (i = 0; i < res.data_detail.propChildAsset.length; i++) {
                  html += "<tr>";
                  html += '<td>' + no++ + '</td>';
                  html += '<td>' + res.data_detail.propChildAsset[i].childName + '</td>';
                  html += '<td>' + res.data_detail.propChildAsset[i].merk + '</td>';
                  html += '<td>' + res.data_detail.propChildAsset[i].tipe + '</td>';
                  html += '<td>' + "Rp." + convertToRupiah(res.data_detail.propChildAsset[i].price) + '</td>';
                  html += "</tr>";
                }
              }
            } else {
              html = '<tr><td colspan="6" class="text-center">No data available in table</td></tr>';
            }
            $('#tbody-detail-accesories').html(html);

            if (res.data_detail.propAssetPropfiles != null) {
              var html2 = '';
              if (res.data_detail.propAssetPropfiles.length > 0) {
                for (i = 0; i < res.data_detail.propAssetPropfiles.length; i++) {
                  html2 += "<tr>";
                  html2 += '<td>' + res.data_detail.propAssetPropfiles[i].propFile.propFileCat.fileCatDesc + '</td>';
                  html2 += '<td>' + res.data_detail.propAssetPropfiles[i].propFile.fileName + '</td>';
                  html2 += '<td>' + res.data_detail.propAssetPropfiles[i].propFile.fileSize + '</td>';
                  html2 += '<td>' + '<a href="<?= base_url(); ?>file/file_download/' +
                    res.data_detail.propAssetPropfiles[i].propFile.idFile + '"><i class"mdi mdi-download"></i>' + res.data_detail.propAssetPropfiles[i].propFile.fileName + '</a>' + '</td>';
                  html2 += "</tr>";

                  $(".insert-gambar").append(`<div class="carousel-item ` + ActiveIndex(i) + `">
                                      <a href="data:image/png;base64,` + res.view_file[i] + `" data-fancybox="preview" data-width="320" data-height="320">
                                          <img class="img-responsive zoom" style="width:200px; height:200px;" alt="" src="data:image/png;base64,` + res.view_file[i] + `" />
                                      </a>
                                    </div>`);
                }
              } else {
                html2 = '<tr><td colspan="4" class="text-center">No data available in table</td></tr>';
              }
            }
            $('#tbody-detail-dokumen').html(html2);

            if (res.data_task != null) {
              var html3 = '';
              var html4 = '';
              var html5 = '';
              var html6 = '';
              var html7 = '';
              var html8 = '';
              var html9 = '';

              if (res.data_task.listTaskComplain != null) {
                for (i = 0; i < res.data_task.listTaskComplain.length; i++) {
                  html3 += "<tr>";
                  html3 += '<td>' + no++ + '</td>';
                  html3 += '<td>' + res.data_task.listTaskComplain[i].timeInit + '</td>';
                  html3 += '<td>' + res.data_task.listTaskComplain[i].complainRequest + '</td>';
                  html3 += '<td>' + res.data_task.listTaskComplain[i].finishBy + '</td>';

                  if (res.data_task.listTaskRepair.length > 0) {
                    for (k = 0; k < res.data_task.listTaskRepair.length; k++) {
                      html3 += '<td>' + res.data_task.listTaskRepair[k].repairResult + '</td>';
                    }
                  } else {
                    html3 += '<td>-</td>';
                  }

                  html3 += "</tr>";
                }
              } else {
                html3 = '<tr><td colspan="5" class="text-center">No data available in table</td></tr>';
              }
              $('#tbody-complain-asset').html(html3);

              if (res.data_task.listTaskRepair != null) {
                for (i = 0; i < res.data_task.listTaskRepair.length; i++) {
                  if (res.data_task.listTaskRepair[i].propFormPart.length > 0) {
                    for (k = 0; k < res.data_task.listTaskRepair[i].propFormPart.length; k++) {
                      var total_parts = res.data_task.listTaskRepair[i].propFormPart[k].partPrice * res.data_task.listTaskRepair[i].propFormPart[k].partQTY;

                      html4 += "<tr>";
                      html4 += '<td>' + no_parts++ + '</td>';
                      html4 += '<td>' + res.data_task.listTaskRepair[i].propFormPart[k].partUnits + '</td>';
                      html4 += '<td>' + res.data_task.listTaskRepair[i].propFormPart[k].partName + '</td>';
                      html4 += '<td>' + convertToRupiah(res.data_task.listTaskRepair[i].propFormPart[k].partPrice) + '</td>';
                      html4 += '<td>' + res.data_task.listTaskRepair[i].propFormPart[k].partQTY + '</td>';
                      html4 += '<td>' + convertToRupiah(total_parts) + '</td>';
                      html4 += "</tr>";
                    }
                  } else {
                    html4 = '<tr><td colspan="6" class="text-center">No data available in table</td></tr>';
                  }
                }
              } else {
                html4 = '<tr><td colspan="6" class="text-center">No data available in table</td></tr>';
              }
              $('#tbody-complain-asset-parts').html(html4);

              if (res.data_task.listTaskCalibration != null) {
                for (i = 0; i < res.data_task.listTaskCalibration.length; i++) {
                  html5 += "<tr>";
                  html5 += '<td>' + no_cal++ + '</td>';
                  html5 += '<td>' + res.data_task.listTaskCalibration[i].scheduleStart + '</td>';
                  html5 += '<td>' + res.data_task.listTaskCalibration[i].timeFinish + '</td>';
                  html5 += '<td>' + res.data_task.listTaskCalibration[i].docNumber + '</td>';
                  html5 += '<td>' + res.data_task.listTaskCalibration[i].calibResult + '</td>';
                  html5 += '<td>' + '<a href="<?= base_url(); ?>file/file_download/' +
                    res.data_task.listTaskCalibration[i].idFileCert + '"><i class"fa fa-download"></i>' + res.data_task.listTaskCalibration[i].fileName + '</a>' + '</td>';
                  html5 += "</tr>";

                }
              } else {
                html5 = '<tr><td colspan="6" class="text-center">No data available in table</td></tr>';
              }
              $('#tbody-cal-asset').html(html5);

              if (res.data_task.listTaskMaintenance != null) {
                for (i = 0; i < res.data_task.listTaskMaintenance.length; i++) {
                  html6 += "<tr>";
                  html6 += '<td>' + no_mtn++ + '</td>';
                  html6 += '<td>' + res.data_task.listTaskMaintenance[i].scheduleStart + '</td>';
                  html6 += '<td>' + res.data_task.listTaskMaintenance[i].taskName + '</td>';
                  html6 += '<td>' + res.data_task.listTaskMaintenance[i].finishBy + '</td>';
                  html6 += '<td>' + res.data_task.listTaskMaintenance[i].maintenanceNote + '</td>';
                  html6 += '<td>' + res.data_task.listTaskMaintenance[i].maintenanceResult + '</td>';
                  html6 += "</tr>";

                  if (res.data_task.listTaskMaintenance[i].propFormPart.length > 0) {
                    for (k = 0; k < res.data_task.listTaskMaintenance[i].propFormPart.length; k++) {
                      var total_parts = res.data_task.listTaskMaintenance[i].propFormPart[k].partPrice * res.data_task.listTaskMaintenance[i].propFormPart[k].partQTY;
                      html8 += "<tr>";
                      html8 += '<td>' + no_parts_mtn++ + '</td>';
                      html8 += '<td>' + res.data_task.listTaskMaintenance[i].propFormPart[k].partName + '</td>';
                      html8 += '<td>' + convertToRupiah(res.data_task.listTaskMaintenance[i].propFormPart[k].partPrice) + '</td>';
                      html8 += '<td>' + res.data_task.listTaskMaintenance[i].propFormPart[k].partQTY + '</td>';
                      html8 += '<td>' + convertToRupiah(total_parts) + '</td>';
                      html8 += "</tr>";
                    }
                  }
                  // } else {
                  //   html8 = '<tr><td colspan="6" class="text-center">No data available in table</td></tr>';
                  // }
                  $('#tbody-maintenance-material-asset').html(html8);

                }
              } else {
                html6 = '<tr><td colspan="6" class="text-center">No data available in table</td></tr>';
              }
              $('#tbody-maintenance-asset').html(html6);

              if (res.data_task.listTaskInspection != null) {
                for (i = 0; i < res.data_task.listTaskInspection.length; i++) {
                  html7 += "<tr>";
                  html7 += '<td>' + no_inp++ + '</td>';
                  html7 += '<td>' + res.data_task.listTaskInspection[i].scheduleStart + '</td>';
                  html7 += '<td>' + res.data_task.listTaskInspection[i].taskName + '</td>';
                  html7 += '<td>' + res.data_task.listTaskInspection[i].finishBy + '</td>';
                  html7 += '<td>' + res.data_task.listTaskInspection[i].noteInspection + '</td>';
                  html7 += '<td>' + res.data_task.listTaskInspection[i].inspectionResult + '</td>';
                  html7 += "</tr>";
                }
              } else {
                html7 = '<tr><td colspan="6" class="text-center">No data available in table</td></tr>';
              }
              $('#tbody-inspection-asset').html(html7);

              if (res.data_task.listTaskMutation != null) {
                for (i = 0; i < res.data_task.listTaskMutation.length; i++) {
                  html9 += "<tr>";
                  html9 += '<td>' + no_mut++ + '</td>';
                  html9 += '<td>' + res.data_task.listTaskMutation[i].timeInit + '</td>';
                  html9 += '<td>' + res.data_task.listTaskMutation[i].mutationType + '</td>';
                  html9 += '<td>' + res.data_task.listTaskMutation[i].mutationStatus + '</td>';
                  html9 += '<td>' + res.data_task.listTaskMutation[i].srcRoomName + '</td>';
                  html9 += '<td>' + res.data_task.listTaskMutation[i].dstRoomName + '</td>';
                  html9 += '<td>' + res.data_task.listTaskMutation[i].mutationScope + '</td>';
                  html9 += "</tr>";
                }
              } else {
                html9 = '<tr><td colspan="7" class="text-center">No data available in table</td></tr>';
              }
              $('#tbody-mutation-asset').html(html9);

            }

          }
        });
      } else {
        Swal.fire({
          icon: 'warning',
          title: 'Oops...',
          text: (idAsset.length > 1) ? "You choose more than 1 item, please choose one item to be details" : "Select Items to be Details",
        });
      }
    });
  }

  function convertToRupiah(angka) {
    var rupiah = '';
    var angkarev = angka.toString().split('').reverse().join('');
    for (var i = 0; i < angkarev.length; i++)
      if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + ',';
    return rupiah.split('', rupiah.length - 1).reverse().join('');
    // return 'Rp. '+rupiah.split('',rupiah.length-1).reverse().join('');
  }

  //create function edit
  function edit() {
    // create function edit
    $('#modal_edit_inventory').click(function() {
      // e.preventDefault();
      var idAsset = [];
      // Read all checked checkboxes
      $("input:checkbox[class=delete_check]:checked").each(function() {
        idAsset.push($(this).val());
      });

      if (idAsset.length == 1) {
        $('#inventory_form').modal('show');

        $.ajax({
          type: "POST",
          url: BASE_URL + "asset/non/inventory_non/asset_by_id",
          data: {
            idAsset: idAsset
          },
          dataType: "json",
          success: function(res) {
            $('#title-asset').html('Updated New Assets');
            $('#catcode_kategori').val(res.data_update.catCode).change();

            if (res.data_update.parentAssetID != '') {
              $('#option-ajax-parentasset').val(res.data_update.parentAssetID);
              $('#option-ajax-parentasset').html(res.data_parent.assetName);
              $('.selectpicker-parentAsset').selectpicker('refresh');
            }

            if (res.data_update.propAssetPropgenit.merk != '') {
              $('#option-ajax-merk').html(res.data_update.propAssetPropgenit.merk);
              $('#option-ajax-merk').val(res.data_update.propAssetPropgenit.merk);
              $('.selectpicker-merk').selectpicker('refresh');
            }

            $('input[name=idAsset]').val(res.data_update.idAsset);
            $('input[name=propAssetPropsimak_idAsset]').val(res.data_update.idAsset);
            $('input[name=propAssetPropelectrical_idAsset]').val(res.data_update.idAsset);
            $('input[name=assetName]').val(res.data_update.assetName);
            $('#ajax_aspakName').val(res.data_update.assetDesc);
            $('input[name=assetDesc]').val(res.data_update.assetDesc);
            $('input[name=ajax_idassetmaster_edit]').val(res.data_update.idAssetMaster);
            $('input[name=propAssetPropgenit_tipe]').val(res.data_update.propAssetPropgenit.tipe);
            $('input[name=propAssetPropgenit_serialNumber]').val(res.data_update.propAssetPropgenit.serialNumber);
            $('input[name=propAssetPropadmin_idRoom_not]').val(res.data_update.propAssetPropadmin.propAssetPropbuildingRoom.buildingName + " | " + res.data_update.propAssetPropadmin.propAssetPropbuildingRoom.floorName + " | " + res.data_update.propAssetPropadmin.propAssetPropbuildingRoom.roomName);
            $('input[name=propAssetPropadmin_idBuilding]').val(res.data_update.propAssetPropadmin.propAssetPropbuildingRoom.idBuilding);
            $('input[name=propAssetPropadmin_idFloor]').val(res.data_update.propAssetPropadmin.propAssetPropbuildingRoom.idFloor);
            $('input[name=propAssetPropadmin_idRoom]').val(res.data_update.propAssetPropadmin.propAssetPropbuildingRoom.idRoom);

            if (res.data_update.propAssetPropaspak != null) {
              $('input[name=propAssetPropaspak_idAsset]').val(res.data_update.idAsset);
              $('input[name=aspakCode]').val(res.data_update.propAssetPropaspak.aspakCode);
              $('#propAssetPropaspak_akdAkl').val(res.data_update.propAssetPropaspak.akdAkl);
              //$('#propAssetPropaspak_insCode').val(res.data_update.propAssetPropaspak.insCode).change();
            }

            if (res.data_update.propAssetPropsimak != null) {
              $('input[name=propAssetPropsimak_simakCode]').val(res.data_update.propAssetPropsimak.simakCode);
              $('#ajax_simakName').val(res.data_update.propAssetMaster.propMasterSimak.simakUraian);
              $('input[name=propAssetPropsimak_nup]').val(res.data_update.propAssetPropsimak.nup);
            }

            $('#propAssetPropadmin_riskLevel').val(res.data_update.propAssetMaster.riskLevel).change();

            if (res.data_update.propAssetMaster.calibMust == true) {
              $('#propAssetPropmedeq_calibrationMust').prop('checked', true).change();
            } else {
              $('#propAssetPropmedeq_calibrationMust').prop('checked', false).change();
            }

            $('input[name=propAssetPropadmin_procureDate]').val(res.data_update.propAssetPropadmin.procureDate);
            $('input[name=propAssetPropadmin_priceBuy]').val(res.data_update.propAssetPropadmin.priceBuy);

            if (res.data_update.propAssetPropgenit.idSupplier != '') {
              $('#option-ajax-supplier').html(res.data_update.propAssetPropadmin.propContact.contactCompany);
              $('#option-ajax-supplier').val(res.data_update.propAssetPropadmin.propContact.idContact);
              $('.selectpicker-supplier').selectpicker('refresh');
            }
            // $('select[name=propAssetPropgenit_idSupplier]').val(res.data_update.propAssetPropgenit.idSupplier).change();

            $('select[name=propAssetPropadmin_condition]').val(res.data_update.propAssetPropadmin.condition).change();
            $('select[name=propAssetPropadmin_ownershipType]').val(res.data_update.propAssetPropadmin.ownershipType).change();
            $('select[name=propAssetPropadmin_idFund]').val(res.data_update.propAssetPropadmin.idFund).change();
            $('select[name=propAssetPropadmin_status]').val(res.data_update.propAssetPropadmin.status).change();
            $('input[name=propAssetPropadmin_inactive_date]').val(res.data_update.propAssetPropadmin.inactive_date);
            $('input[name=propAssetPropgenit_warrantyExpired]').val(res.data_update.propAssetPropgenit.warrantyExpired);
            if (res.data_update.propAssetPropelectrical != null) {
              $('input[name=propAssetPropelectrical_voltageOutput]').val(res.data_update.propAssetPropelectrical.voltageOutput);
            }
            $('textarea[name=propAssetPropgenit_spesifikasi]').val(res.data_update.propAssetPropgenit.spesifikasi);

            $('input[name=kodeAlat]').val(res.data_update.kodeAlat);
            $('input[name=kodeBar]').val(res.data_update.kodeBar);
            $('input[name=kodeTera]').val(res.data_update.kodeTera);
            $('input[name=otherCode1]').val(res.data_update.otherCode1);
            $('input[name=otherCode2]').val(res.data_update.otherCode2);

            $('input[name=propAssetProptax_presentDate]').val(res.data_update.propAssetProptax.presentDate);
            $('input[name=propAssetProptax_cost]').val(res.data_update.propAssetProptax.cost);
            $('input[name=propAssetProptax_expectedLifeTime]').val(res.data_update.propAssetProptax.expectedLifeTime);
            $('input[name=propAssetProptax_calcStart]').val(res.data_update.propAssetProptax.calcStart);
            $('input[name=propAssetProptax_residuVal]').val(res.data_update.propAssetProptax.residuVal);
            $('input[name=propAssetProptax_yearlyDep]').val(res.data_update.propAssetProptax.yearlyDep);
            $('input[name=propAssetProptax_accuVal]').val(res.data_update.propAssetProptax.accuVal);
            $('input[name=propAssetProptax_bookVal]').val(res.data_update.propAssetProptax.bookVal);

            $('input[name=propAssetPropadmin_yearProcurement]').val(res.data_update.propAssetPropadmin.yearProcurement);
            $('input[name=propAssetPropadmin_poNumb]').val(res.data_update.propAssetPropadmin.poNumb);
            $('#po_number').val(res.data_update.propAssetPropadmin.poNumb);

            $('input[name=propAssetProptaxother_presentDate]').val(res.data_update.propAssetProptaxother.presentDate);
            $('input[name=propAssetProptaxother_cost]').val(res.data_update.propAssetProptaxother.cost);
            $('input[name=propAssetProptaxother_expectedLifeTime]').val(res.data_update.propAssetProptaxother.expectedLifeTime);
            $('input[name=propAssetProptaxother_calcStart]').val(res.data_update.propAssetProptaxother.calcStart);
            $('input[name=propAssetProptaxother_residuVal]').val(res.data_update.propAssetProptaxother.residuVal);
            $('input[name=propAssetProptaxother_yearlyDep]').val(res.data_update.propAssetProptaxother.yearlyDep);
            $('input[name=propAssetProptaxother_accuVal]').val(res.data_update.propAssetProptaxother.accuVal);
            $('input[name=propAssetProptaxother_bookVal]').val(res.data_update.propAssetProptaxother.bookVal);

            $('.file_list').DataTable().ajax.url(BASE_URL + "asset_propfiles/asset_propfiles_by_id_asset/" + res.data_update.idAsset).load();

            if (res.data_update.propAssetCat.subSysCat == "INST") {
              if (res.data_update.propChildAsset != null) {
                $('#btn-add-instrument').css({
                  'display': 'none'
                });
                $('.instrument_list').DataTable().ajax.url(BASE_URL + "instrument/prop_child_instrument/" + res.data_update.idAsset).load();
              }
            }

            if (res.data_update.propAssetPropbuilding != null) {
              $('input[name=propAssetPropbuilding_buildingName]').val(res.data_update.propAssetPropbuilding.buildingName);
              $('input[name=propAssetPropbuilding_city]').val(res.data_update.propAssetPropbuilding.city);
              $('input[name=propAssetPropbuilding_phone]').val(res.data_update.propAssetPropbuilding.phone);
              $('input[name=propAssetPropbuilding_buildingCode]').val(res.data_update.propAssetPropbuilding.buildingCode);
              $('input[name=propAssetPropbuilding_luasTanah]').val(res.data_update.propAssetPropbuilding.luasTanah);
              $('input[name=propAssetPropbuilding_luasBangunan]').val(res.data_update.propAssetPropbuilding.luasBangunan);
              $('textarea[name=propAssetPropbuilding_buildingDesc]').val(res.data_update.propAssetPropbuilding.buildingDesc);
            }
          }
        });
      } else {
        Swal.fire({
          icon: 'warning',
          title: 'Oops...',
          text: (idAsset.length > 1) ? "You choose more than 1 item, please choose one item to be edited" : "Select Items to be Edited",
        });
      }
    });
  }

  //create function hapus
  function hapus() {
    // create function delete
    $('#modal_delete_inventory').click(function() {
      // e.preventDefault();
      // console.log('keluar sini');
      var idAsset = [];
      // Read all checked checkboxes
      $("input:checkbox[class=delete_check]:checked").each(function() {
        idAsset.push($(this).val());
      });
      // console.log(idAsset);
      if (idAsset.length > 0) {
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
                  url: BASE_URL + "asset/non/inventory_non/delete",
                  data: {
                    'idAsset': idAsset,
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