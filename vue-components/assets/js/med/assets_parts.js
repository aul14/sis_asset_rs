let forms = new Vue ({
  el:'#app_form',
  components:{
    'main-form': httpVueLoader(BASE_URL + 'vue-components/assets/form/form_main.vue?v=1.2'),
    'room-form':httpVueLoader(BASE_URL + 'vue-components/assets/form/form_room.vue'),
    'form-general':httpVueLoader(BASE_URL + 'vue-components/assets/form/form_general.vue'),
    'form-code':httpVueLoader(BASE_URL + 'vue-components/assets/form/form_code.vue'),
    'form-instrument':httpVueLoader(BASE_URL + 'vue-components/assets/form/form_instrument.vue'),
    'form-building':httpVueLoader(BASE_URL + 'vue-components/assets/form/form_building.vue'),
    'form-vehicle':httpVueLoader(BASE_URL + 'vue-components/assets/form/form_vehicle.vue'),
    'form-land':httpVueLoader(BASE_URL + 'vue-components/assets/form/form_land.vue'),
    'form-stock':httpVueLoader(BASE_URL + 'vue-components/assets/form/form_stock.vue'),
    'form-file':httpVueLoader(BASE_URL + 'vue-components/assets/form/form_file.vue'),
    'form-depreciation-1':httpVueLoader(BASE_URL + 'vue-components/assets/form/form_depreciation1.vue'),
    'form-depreciation-2':httpVueLoader(BASE_URL + 'vue-components/assets/form/form_depreciation2.vue'),
    'form-license':httpVueLoader(BASE_URL + 'vue-components/assets/form/form_license.vue'),
    'form-aspak':httpVueLoader(BASE_URL + 'vue-components/assets/form/form_aspak.vue'),
    'form-simak':httpVueLoader(BASE_URL + 'vue-components/assets/form/form_simak.vue')
  }
});
let details = new Vue ({
  el:'#app_detail',
  components:{
    'detail-picture':httpVueLoader(BASE_URL + 'vue-components/assets/detail/detail_pictures.vue'),
    'detail-general':httpVueLoader(BASE_URL + 'vue-components/assets/detail/detail_general.vue'),
    'detail-accesories':httpVueLoader(BASE_URL + 'vue-components/assets/detail/detail_accesories.vue'),
    'detail-document':httpVueLoader(BASE_URL + 'vue-components/assets/detail/detail_documents.vue'),
    'detail-depreciation-1':httpVueLoader(BASE_URL + 'vue-components/assets/detail/detail_depreciation_1.vue'),
    'detail-task-calibration':httpVueLoader(BASE_URL + 'vue-components/assets/detail/detail_task_calibration.vue'),
    'detail-task-maintenance':httpVueLoader(BASE_URL + 'vue-components/assets/detail/detail_task_maintenance.vue'),
    'detail-task-inspection':httpVueLoader(BASE_URL + 'vue-components/assets/detail/detail_task_inspection.vue'),
    'detail-task-compainrepair':httpVueLoader(BASE_URL + 'vue-components/assets/detail/detail_task_complainrepair.vue'),
    'detail-stock':httpVueLoader(BASE_URL + 'vue-components/assets/detail/detail_stock.vue'),
    'detail-task-mutation':httpVueLoader(BASE_URL + 'vue-components/assets/detail/detail_task_mutation.vue')
  },
});
let print = new Vue ({
  el:'#app_print',
  components:{
    'print-assets':httpVueLoader(BASE_URL + 'vue-components/assets/print/print_assets.vue')
  },
});

function FileTable() {
  // 'use-strict';
  $('.file_list').DataTable({
    ajax: BASE_URL + `file/file_list_session`,
    columns: [{
        title: '#',
        name: null,
        data: "no"
      },
      {
        title: 'file name',
        name: 'file name',
        data: "propFileName"
      },
      {
        title: 'file category',
        name: 'file category',
        data: "propFile.propFileCat.fileCatDesc"
      },
      {
        title: 'action',
        name: 'action',
        data: null,
        render: function(data, type, row) {
          var _button = `<a href="<?= base_url(); ?>file/file_download/${data.propFile.idFile}" class="btn-download btn btn btn-rounded btn-outline-success mr-2 btn-sm" > <i class="mdi mdi-cloud-download"></i></a>` +
            `<a onClick="return delete_confirmation(event, ${data.propFile.idFile})" href="javascript:void(0);" data-asset="${data.idAsset}" data-file="${data.propFile.idFile}" class="btn-deletefile btn btn btn-rounded btn-outline-danger mr-2 btn-sm" > <i class="ti-trash"></i></a>`;

          return _button;
        }
      },
    ],
    dom: 'ftrp',
    searching: true,
    retrieve:true,
    pageLength: 15,
    lengthMenu: [15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65, 70, 75, 80, 85, 90, 95, 100],
  });
}

function InstrumentTable() {
  $('.instrument_list').DataTable({
    ajax: BASE_URL + `instrument/instrument_list_session`,
    columns: [{
        title: '#',
        name: null,
        data: 'no'
      },
      {
        title: 'instrument set name',
        name: 'instrument set name',
        data: 'instrument_set_name'
      },
      {
        title: 'alias name',
        name: 'alias name',
        data: 'alias_name'
      },
      {
        title: 'action',
        name: 'action',
        data: null,
        render: function(data, type, row) {
          var _button =
            `<a onClick="return delete_confirmation_instrument(event, ${data.idAssetMaster})" href="javascript:void(0);"  data-id-master="${data.idAssetMaster}" class="btn-deletefile btn btn btn-rounded btn-outline-danger mr-2 btn-sm" > <i class="ti-trash"></i></a>`;

          return _button;
        }
      },
    ],
    dom: 'ftr<"row pt-2"<"col-6 text-sm"l><"col-6 text-sm"p>>',
    retrieve:true,
    searching: true,
    pageLength: 15,
    lengthMenu: [15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65, 70, 75, 80, 85, 90, 95, 100]
  });
}
function SelectLocation(){
 return $('.select_location').DataTable({
    columns:[
      {title: '#', name: null},
      {title:'building' , name:'building' },
      {title:'floor', name:'floor'},
      {title:'room', name:'room'},
    ],
    // retrieve:true,
    dom: 'ftr<"row pt-2"<"col-6 text-sm"l><"col-6 text-sm"p>>',
    retrieve:true,
    searching: true,
    pageLength: 15,
    lengthMenu: [15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65, 70, 75, 80, 85, 90, 95, 100]
  });
}
function SelectInstrumentPiece() {
  $('.select_instrument_piece').DataTable({
    serverSide: true,
    pageLength: 100,
    ajax: {
        url: BASE_URL + `instrument/instrument_modal_list`,
        dataType: "json",
        type: "POST",
    },
    columns: [{
            data: "check_box"
        },
        {
            data: "no"
        },
        {
            data: "assetMasterName"
        },
        {
            data: "alias_name"
        },
    ],
    columnDefs: [{
        orderable: false,
        targets: [0]
    }, ],
    drawCallback: function() {
        this.api().page.info();
    },
    order: [],
    // retrieve:true,
    dom: 'ftr<"row pt-2"<"col-6 text-sm"l><"col-6 text-sm"p>>',
    retrieve:true,
    searching: true,
    pageLength: 15,
    lengthMenu: [15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65, 70, 75, 80, 85, 90, 95, 100]
  });
}
function StockIn(){
  $('.stockin_list').DataTable({
    ajax: BASE_URL + `stock/stock_list_session`,
    columns:[
      {title: 'no', data: null, name: 'no'},
      {title:'location', data: 'propLocation.roomName', name:'location'},
      {title:'quantity', data: 'inQty', name:'qty'},
      {title:'stock name', data: 'inName', name:'stock_name'},
      {title:'last updated', data: 'lastUpdated', name:'last_updated'},

      {
          title: "option",
          name: "option",
          data: null,
          render: function (data, type, row) {
              return `<a onClick="return delete_confirmation_stock_in(event, ${(data.idStockIn == null ? data.lastUpdated.substr(17) : data.idStockIn)})" href="javascript:void(0);"  class="btn-deletefile btn btn btn-rounded btn-outline-danger mr-2 btn-sm" > <i class="ti-trash"></i></a>`;

          }
      },
    ],
    "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {

      var index = iDisplayIndex + 1;
      var api = this.api();
      var pageInfo = api.page.info();
      var page = pageInfo.page;
      var length = pageInfo.length;
      var number = (page * length) + index;

      $('td:eq(0)', nRow).html(number);

      // converting to interger to find total
      var intVal = function ( i ) {
        return typeof i === 'string' ?
            i.replace(/[\$,]/g, '')*1 :
            typeof i === 'number' ?
                i : 0;
      };

      var sum = api
      .column(2)
      .data()
      .reduce( function (a, b) {
          return intVal(a) + intVal(b);
      }, 0 );

      $('#ajax_qty_in').val(sum);

      var stock_in = $('#ajax_qty_in').val();
      var stock_out = $('#ajax_qty_out').val();

      var stock_all = parseInt(stock_in) - (stock_out == '' ? 0 : parseInt(stock_out));

      $('#ajax_qty_all').val(stock_all);
      return nRow;

    },
    retrieve:true,
    dom: 'tr<"row pt-2"<"col-6 text-sm"l><"col-6 text-sm"p>>',
    searching: true,
    pageLength: 15,
    lengthMenu: [15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65, 70, 75, 80, 85, 90, 95, 100]
  });
}
function StockOut(){
  $('.stockout_list').DataTable({
    ajax: BASE_URL + `stock/stock_list_out_session`,
    columns:[
      {title: 'no', data: null, name: 'no'},
      {title:'location', data: 'propLocation.roomName', name:'location'},
      {title:'quantity', data: 'outQty', name:'qty'},
      {title:'stock name', data: 'outName', name:'stock_name'},
      {title:'description', data: 'outDesc', name:'description'},
      {title:'last updated', data: 'lastUpdated', name:'last_updated'},
      {
        title: 'action',
        name: 'action',
        data: null,
        render: function(data, type, row) {
          var _button = `<a onClick="return delete_confirmation_stock_out(event, ${(data.idStockOut == null ? data.lastUpdated.substr(17) : data.idStockOut)})" href="javascript:void(0);"  class="btn-deletefile btn btn btn-rounded btn-outline-danger mr-2 btn-sm" > <i class="ti-trash"></i></a>`;

          return _button;
        }
      },
    ],
    "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {

      var index = iDisplayIndex + 1;
      var api = this.api();
      var pageInfo = api.page.info();
      var page = pageInfo.page;
      var length = pageInfo.length;
      var number = (page * length) + index;

      $('td:eq(0)', nRow).html(number);

      // converting to interger to find total
      var intVal = function ( i ) {
        return typeof i === 'string' ?
            i.replace(/[\$,]/g, '')*1 :
            typeof i === 'number' ?
                i : 0;
      };

      var sum = api
      .column(2)
      .data()
      .reduce( function (a, b) {
          return intVal(a) + intVal(b);
      }, 0 );

      $('#ajax_qty_out').val(sum);

      var stock_in = $('#ajax_qty_in').val();
      var stock_out = $('#ajax_qty_out').val();

      var stock_all = parseInt(stock_in) - (sum == '' ? 0 : parseInt(stock_out));

      $('#ajax_qty_all').val(stock_all);
      return nRow;
    },
    retrieve:true,
    dom: 'tr<"row pt-2"<"col-6 text-sm"l><"col-6 text-sm"p>>',
    searching: true,
    pageLength: 15,
    lengthMenu: [15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65, 70, 75, 80, 85, 90, 95, 100]
  });
}
