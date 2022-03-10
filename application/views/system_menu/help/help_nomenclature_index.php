<?php include '../../vue-components/sidebar.php'; ?>

<main dir="ltr" class="page-wrapper full-height">

  <section class="page-content full container-fluid">
    <div class="col-xl-12">
      <div class="card samrs-card">
        <div class="card-header">
          <p>Nomenclature List</p>
        </div>
        <div style="display: none;">
          <div class="card-body">
            <div class="form-group samrs-input-group center">
              <input class="form-control quick_search" type="text" name="" value="" placeholder="Search all data">
              <label class="toggle-label"><i class="fas fa-search"></i></label>
            </div>
            <div class="samrs-grid grid-9">
              <div class="grid-box">
                <a href="inventory_form.php" class="btn btn-block samrs-primary"><i class="fas fa-plus"></i> Add new</a>
              </div>
              <div class="grid-box">
                <a href="#" class="btn btn-block samrs-success"><i class="fas fa-edit"></i> Edit</a>
              </div>
              <div class="grid-box">
                <a href="#" class="btn btn-block samrs-danger"><i class="fas fa-trash-alt"></i> Delete</a>
              </div>
              <div class="grid-box">
                <a href="#exampleModalForm" data-toggle="modal" class="btn btn-block samrs-info"><i class="fas fa-book-open"></i> Details</a>
              </div>
              <div class="grid-box">
                <a href="#" class="btn btn-block samrs-dark"><i class="fas fa-qrcode"></i> Print QR</a>
              </div>
              <div class="grid-box">
                <a href="#" class="btn btn-block samrs-gray"><i class="fas fa-print"></i> Print</a>
              </div>
              <div class="grid-box">
                <a href="#" class="btn btn-block samrs-teal samrs-overlay-toggle" data-target="#advanced_search" data-type="samrs-overlay">
                  <small><i class="fas fa-search"></i> Advanced Search</small></a>
              </div>
              <div class="grid-box">
                <div class="dropdown">
                  <a href="javascript:void(0)" class="btn btn-block samrs-brown dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-table"></i> View
                  </a>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:void(0)">View Mode Inventory</a>
                    <a class="dropdown-item" href="javascript:void(0)">View Mode ASPAK</a>
                    <a class="dropdown-item" href="javascript:void(0)">View Mode Finance</a>
                    <a class="dropdown-item" href="javascript:void(0)">View Mode Utilization</a>
                    <a class="dropdown-item" href="javascript:void(0)">View Mode Performance</a>
                  </div>
                </div>
              </div>
              <div class="grid-box">
                <div class="dropdown">
                  <a href="#" class="btn btn-block samrs-brown-dark dropdown-toggle" data-toggle="dropdown">
                    <i class="fas fa-chevron-down"></i> Column
                  </a>
                  <ul class="dropdown-menu data_column">
                  </ul>
                </div>
              </div>
            </div>
            <div class="samrs-overlay off" id="advanced_search">
              <div class="header">
                <div class="title">
                  <p>Advanced Search</p>
                </div>
                <div class="close-div">
                  <button class="btn btn-rounded close-btn samrs-danger is-outline" type="button" data-close="advanced_search">x</button>
                </div>
              </div>
              <div class="content">
                <div class="samrs-grid grid-7">
                  <div class="grid-box">
                    <select class="form-control" name="">
                      <option value="">Select Field</option>
                    </select>
                  </div>
                  <div class="grid-box">
                    <input class="form-control" type="text" name="" value="" placeholder="Search keyword">
                  </div>
                  <div class="grid-box">
                    <select class="form-control" name="">
                      <option value="">Select Field</option>
                    </select>
                  </div>
                  <div class="grid-box">
                    <input class="form-control" type="text" name="" value="" placeholder="Search keyword">
                  </div>
                  <div class="grid-box">
                    <select class="form-control" name="">
                      <option value="">All</option>
                    </select>
                  </div>
                  <div class="grid-box">
                    <button class="btn btn-block samrs-primary" type="button" name="button"><i class="fas fa-search"></i> Cari</button>
                  </div>
                  <div class="grid-box">
                    <button class="btn btn-block samrs-warning" type="button" name="button"><i class="ti ti-reload"></i> Semua</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-12">
      <div class="card samrs-card h-small">
        <div class="card-body">
          <div class="table-responsive">
            <table class="samrs-table1 table samrs-tableview samrs-table-striped table-hover" style="width:100%">
              <thead>
              </thead>
              <tbody>
                <?php $no = 1; ?>
                <?php for ($i = 0; $i <= 100; $i++) { ?>
                  <tr>
                    <td class="text-center"><input class="select_checkbox" type="checkbox" name="" value=""></td>
                    <td><?php echo $no; ?></td>
                    <td>Data 2_<?php echo $no; ?></td>
                    <td>Data 3_<?php echo $no; ?></td>
                    <td>Data 4_<?php echo $no; ?></td>
                    <td>Data 5_<?php echo $no; ?></td>
                    <td>Data 6_<?php echo $no; ?></td>
                    <td>Data 7_<?php echo $no; ?></td>
                    <td>Data 8_<?php echo $no; ?></td>
                    <td>Data 9_<?php echo $no; ?></td>
                    <td>Data 10_<?php echo $no; ?></td>
                    <td>Data 11_<?php echo $no; ?></td>
                    <td>Data 12_<?php echo $no; ?></td>
                    <td>Data 13_<?php echo $no; ?></td>
                    <td>Data 14_<?php echo $no; ?></td>
                    <td>Data 15_<?php echo $no; ?></td>
                    <td>Data 16_<?php echo $no; ?></td>
                    <td>Data 17_<?php echo $no; ?></td>
                  </tr>
                  <?php $no++ ?>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
  <div id="exampleModalForm" class="modal samrs-modal zoom fade" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl animated">
      <div class="modal-content glassmorphism">
        <div class="modal-header">
          <p>Extra Large modal</p>
          <button type="button" class="btn btn-circle btn-outline-danger" data-dismiss="modal" aria-hidden="true"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
          <h4>Overflowing text to show scroll behavior</h4>
          <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
          <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-toggle="modal" data-target="#exampleModal">Modal 2</button>
          <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</main>

<?php include '../../vue-components/sidebar_footer.php'; ?>

<script>
  let table = $('.samrs-table1').DataTable({
    // initComplete: function () {
    //       // Apply the search
    //       this.api().columns().every(function () {
    //           var that = this;
    //           $('.quick_search').on('keyup change clear', function () {
    //               if (that.search() !== this.value) {
    //                   that.search(this.value).draw();
    //               }
    //           });
    //       });
    //   },
    colReorder: true,
    columns: [{
        title: '<input type="checkbox"/>',
        name: null
      },
      {
        title: 'No',
        name: 'No'
      },
      {
        title: 'Code',
        name: 'Code'
      },
      {
        title: 'Label Code',
        name: 'Label Code'
      },
      {
        title: 'Asset name',
        name: 'Asset name'
      },
      {
        title: 'Merk',
        name: 'Merk'
      },
      {
        title: 'Type',
        name: 'Type'
      },
      {
        title: 'SN',
        name: 'SN'
      },
      {
        title: 'Room name',
        name: 'Room name'
      },
      {
        title: 'Floor name',
        name: 'Floor name'
      },
      {
        title: 'Building',
        name: 'Building'
      },
      {
        title: 'Year Procurement',
        name: 'Year Procurement'
      },
      {
        title: 'Condition',
        name: 'Condition'
      },
      {
        title: 'Vendor/Company',
        name: 'Vendor/Company'
      },
      {
        title: 'LAST CALIBRATED',
        name: 'LAST CALIBRATED'
      },
      {
        title: 'CAL. Required',
        name: 'CAL. Required'
      },
      {
        title: 'Ownership Type',
        name: 'Ownership Type'
      },
      {
        title: 'Risk Level',
        name: 'Risk Level'
      },
    ],
    dom: 'rt<"row pt-2"<"col-3 text-sm"l><"col-4 text-center text-sm"i><"col-5 text-sm"p>>',
    searching: true,
    scrollX: true,
    scrollY: "50vh",
    scrollCollapse: true,
    pageLength: 15,
    lengthMenu: [15, 50, 100, 500, 1000],
  });
  $('.samrs-table1 tbody td:first-child')
    .on('click', function() {
      if ($('.select_checkbox').is(':checked')) {
        console.log(table.row(this).index());
        $(table.row(table.row(this).index()).nodes()).addClass('highlight');
      } else {
        $(table.rows(table.row(this).index()).nodes()).removeClass('highlight');
      }
    });
  $('.quick_search').on('keyup change clear', function() {
    table.search(this.value).draw();
  });
  let ColumnData = table.settings().init().columns;
  $(window).on('load', function() {
    for (var i = 2; i < ColumnData.length; i++) {
      $('.data_column').append('<li>' +
        '<div class="custom-control custom-switch">' +
        '<input class="custom-control-input" checked type="checkbox" id="toggle_' + [i] + '" data-column="' + table.settings().init().columns[i].name + '">' +
        '<label class="custom-control-label" for="toggle_' + [i] + '">' + table.settings().init().columns[i].name + '</label>' +
        '</div>' +
        '</li>');

      $('#toggle_' + [i]).on('change', function(e) {
        e.preventDefault();
        // console.log($(this).attr('data-column'));
        var columns = table.column($(this).attr('data-column') + ':name');

        if (this.checked) {
          columns.visible(true);
        } else {
          columns.visible(false);
        }
      });
    }
  });
  $(".data_column").sortable({
    start: function(event, ui) {
      var start_pos = ui.item.index();
      ui.item.data('start_pos', start_pos);
    },
    change: function(event, ui) {
      var start_pos = ui.item.data('start_pos');
      var index = ui.placeholder.index();
    }
  });
  $(".data_column").disableSelection();
</script>