let mainApp = new Vue({
  el: '#App',
  components: {
    'main-app':httpVueLoader(BASE_URL + 'vue-components/ui-components/main_component/main_app.vue'),
    'action-button-card':httpVueLoader(BASE_URL + 'vue-components/ui-components/main_component/action_card.vue'),
    'table-view-card':httpVueLoader(BASE_URL + 'vue-components/ui-components/main_component/table_card.vue'),
    'calendar-view-card':httpVueLoader(BASE_URL + 'vue-components/ui-components/main_component/calendar_card.vue'),
    'advanced-search':httpVueLoader(BASE_URL+'vue-components/ui-components/main_component/search/task/advanced_search_opname.vue'),
    'table-init':httpVueLoader(BASE_URL + 'vue-components/ui-components/main_component/table_init.vue'),
    'add-data':httpVueLoader(BASE_URL + 'vue-components/ui-components/buttons/add_data.vue'),
    // 'edit-data':httpVueLoader(BASE_URL + 'vue-components/ui-components/buttons/edit_data.vue'),
    // 'stock-data':httpVueLoader(BASE_URL + 'vue-components/ui-components/buttons/stock_data.vue'),
    // 'delete-data':httpVueLoader(BASE_URL + 'vue-components/ui-components/buttons/delete_data.vue'),
    'detail-data':httpVueLoader(BASE_URL + 'vue-components/ui-components/buttons/details_data.vue'),
    'print-qr-data':httpVueLoader(BASE_URL + 'vue-components/ui-components/buttons/printqr_data.vue'),
    'print-data':httpVueLoader(BASE_URL + 'vue-components/ui-components/buttons/print_data.vue'),
    'return-data':httpVueLoader(BASE_URL + 'vue-components/ui-components/buttons/return_data.vue'),
    // 'approve-data':httpVueLoader(BASE_URL + 'vue-components/ui-components/buttons/approve_data.vue'),
    'confirm-data':httpVueLoader(BASE_URL + 'vue-components/ui-components/buttons/confirm_data.vue'),
    'periode-data':httpVueLoader(BASE_URL + 'vue-components/ui-components/buttons/periode_data.vue'),
    'table-advance-search':httpVueLoader(BASE_URL + 'vue-components/ui-components/buttons/advance_search.vue'),
    'table-quick-view':httpVueLoader(BASE_URL + 'vue-components/ui-components/buttons/table_view.vue'),
    'table-column-view':httpVueLoader(BASE_URL + 'vue-components/ui-components/buttons/column_view.vue'),
    'popup-delete':httpVueLoader(BASE_URL + 'vue-components/ui-components/popup/popup_delete.vue'),
    'popup-success':httpVueLoader(BASE_URL + 'vue-components/ui-components/popup/popup_success.vue'),
    'popup-warning':httpVueLoader(BASE_URL + 'vue-components/ui-components/popup/popup_warning.vue'),
  }
});

let forms = new Vue({
  el:'#app_form',
  components : {
      'form-opname':httpVueLoader(BASE_URL+'vue-components/task/form/form_opname.vue'),
      'form-opname-detail':httpVueLoader(BASE_URL+'vue-components/task/form/form_opname_details.vue'),
      'form-complain':httpVueLoader(BASE_URL+'vue-components/task/form/form_complain.vue'),
      'form-mutation':httpVueLoader(BASE_URL+'vue-components/task/form/form_mutation.vue'),
      'form-maintenance':httpVueLoader(BASE_URL+'vue-components/task/form/form_maintenance.vue'),
      'form-inspection':httpVueLoader(BASE_URL+'vue-components/task/form/form_inspection.vue'),
      'form-calibration':httpVueLoader(BASE_URL+'vue-components/task/form/form_calibration.vue'),
      'form-repair':httpVueLoader(BASE_URL+'vue-components/task/form/form_repair.vue'),
  }
});
let details = new Vue ({
  el:'#app_detail',
  components:{
    'detail-general':httpVueLoader(BASE_URL+'vue-components/task/detail/detail_general.vue'),
    'detail-history':httpVueLoader(BASE_URL+'vue-components/task/detail/detail_history.vue'),
    'detail-opname':httpVueLoader(BASE_URL+'vue-components/task/detail/detail_opname.vue'),
  },
});
let print = new Vue ({
  el:'#app_print',
  components:{
    'print-task':httpVueLoader(BASE_URL+'vue-components/task/print/print_assets.vue'),
  },
});
// let approve = new Vue ({
//   el:'#app_approve',
//   components:{
//     'approve-general':httpVueLoader(BASE_URL+'vue-components/task/approve/approve_general.vue'),
//     'approve-history':httpVueLoader(BASE_URL+'vue-components/task/approve/approve_history.vue'),
//     'approve-mutation':httpVueLoader(BASE_URL+'vue-components/task/approve/approve_mutation.vue'),
//     'form-mutation-approval':httpVueLoader(BASE_URL+'vue-components/task/form/subform_mutationapproval.vue'),
//   },
// });
// let returns = new Vue ({
//   el:'#app_return',
//   components:{
//     'approve-mutation':httpVueLoader(BASE_URL+'vue-components/task/approve/approve_mutation.vue'),
//     'form-mutation-approval':httpVueLoader(BASE_URL+'vue-components/task/form/subform_mutationapproval.vue'),
//     'form-mutation-return':httpVueLoader(BASE_URL+'vue-components/task/form/subform_mutationreturn.vue')
//   },
// });
// let confirm = new Vue ({
//   el:'#app_confirm',
//   components:{
//     'approve-mutation':httpVueLoader(BASE_URL+'vue-components/task/approve/approve_mutation.vue'),
//     'form-mutation-approval':httpVueLoader(BASE_URL+'vue-components/task/form/subform_mutationapproval.vue'),
//     'form-mutation-return':httpVueLoader(BASE_URL+'vue-components/task/form/subform_mutationreturn.vue'),
//     'form-mutation-confirm':httpVueLoader(BASE_URL+'vue-components/task/form/subform_mutationconfirm.vue'),
//   },
// });
// let report = new Vue ({
//   el:'#report_form',
//   components:{
//     'report-calibration':httpVueLoader(BASE_URL+'vue-components/task/form/report_calibration.vue'),
//   },
// });
function SelectAssets(){
  $('.select_assets').DataTable({
    ajax: {
      url: BASE_URL + `asset/asset_datatable/view_data_asset`,
      dataType: "json"
    },
    columns:[
      {title: '#', name: 'radio', data: 'radioButton'},
      {title:'assets code' , name:'assets code', data: "assetCode" },
      {title:'assets name', name:'assets name', data: "assetName"},
      {title:'room', name:'room', data: 'roomName'},
      {title:'brand', name:'brand', data: 'merk'},
      {title:'type', name:'type', data: 'tipe'},
      {title:'serial number', name:'serial number', data: 'serialNumber'}
    ],
    retrieve: true,
    dom: '<"row"<"col-xl-4"l><"col-xl-8"f>>tr<"col-12"p>',
    searching: true,
    pageLength: 15,
    lengthMenu: [15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65, 70, 75, 80, 85, 90, 95, 100]
  });
}
function SelectAssets_1(){
  let table = $('.select_assets_1').DataTable({
    columns:[
      {title: '<input type="checkbox"/>', name: null},
      {title:'assets code' , name:'assets code' },
      {title:'assets name', name:'assets name'},
      {title:'room', name:'room'},
      {title:'brand', name:'brand'},
      {title:'type', name:'type'},
      {title:'serial number', name:'serial number'}
    ],
    retrieve:true,
    dom: '<"row"<"col-xl-4"l><"col-xl-8"f>>tr<"col-12"p>',
    searching: true,
    pageLength: 15,
    lengthMenu: [15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65, 70, 75, 80, 85, 90, 95, 100]
  });
  $('.select_assets_1 thead th input:checkbox').addClass('checkboxTop');
  $('.select_assets_1 tbody td')
    .on('click', function () {
        var colIdx = table.cell(this).index().row;
        if (table.rows(colIdx).nodes().to$().find('td:first-child .select_checkbox').is(':checked') === true) {
          table.rows(colIdx).nodes().to$().find('td:first-child .select_checkbox').prop('checked',false);
          table.rows(colIdx).nodes().to$().removeClass('highlight');
        }else {
          table.rows(colIdx).nodes().to$().find('td:first-child .select_checkbox').prop('checked',true);
          table.rows(colIdx).nodes().to$().addClass('highlight');
        }
    });
  $('.checkboxTop').click(function(){
      $('input:checkbox').not(this).prop('checked', this.checked);
      if ($('input:checkbox').not(this).is(':checked') === true) {
        $('tbody tr').addClass('highlight');
      }else {
        $('tbody tr').removeClass('highlight');
      }
    });
}
function ScheduleAssets_1(){
  $('.schedule_assets_1').DataTable({
    columns:[
      {title:'no', name: 'no'},
      {title:'assets code' , name:'assets code' },
      {title:'assets name', name:'assets name'},
      {title:'risk level', name:'risk level'},
      {title:'room', name:'room'},
      {title:'brand', name:'brand'},
      {title:'type', name:'type'},
      {title:'serial number', name:'serial number'},
      {title:'form', name:'form'},
      {title:'action', name:'action'}
    ],
    retrieve:true,
    dom: 'tr<"row pt-2"<"col-6 text-sm"l><"col-6 text-sm"p>>',
    searching: true,
    pageLength: 15,
    lengthMenu: [15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65, 70, 75, 80, 85, 90, 95, 100]
  });
}
function ScheduleAssets_2(){
  $('.schedule_assets_2').DataTable({
    columns:[
      {title:'no', name: 'no'},
      {title:'assets code' , name:'assets code' },
      {title:'assets name', name:'assets name'},
      {title:'risk level', name:'risk level'},
      {title:'room', name:'room'},
      {title:'brand', name:'brand'},
      {title:'type', name:'type'},
      {title:'serial number', name:'serial number'},
      {title:'action', name:'action'}
    ],
    retrieve:true,
    dom: 'tr<"row pt-2"<"col-6 text-sm"l><"col-6 text-sm"p>>',
    searching: true,
    pageLength: 15,
    lengthMenu: [15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65, 70, 75, 80, 85, 90, 95, 100]
  });
}
// function DetailOpname() {
//   $('.opname_detail').DataTable({
//     ajax: {
//       url: BASE_URL + `Stock_opname_detail/data_table_from_session`,
//       dataType: "json"
//     },
//     columns:[
//       {title: '#', name: null},
//       {title:'assets code' , name:'assets code' },
//       {title:'assets name', name:'assets name'},
//       {title:'category', name:'category'},
//       {title:'building', name:'building'},
//       {title:'floor', name:'floor'},
//       {title:'room', name:'room'},
//       {title:'action', name:'action'}
//     ],
//     retrieve:true,
//     dom: '<"row"<"col-4"l><"col-8"f>>tr<"col-12"p>',
//     searching: true,
//     pageLength: 15,
//     lengthMenu: [15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65, 70, 75, 80, 85, 90, 95, 100]
//   });
// }
function SelectComplain(){
  
  $('.select_complain').DataTable({
    "ajax": {
      "url": BASE_URL + "task/med/task_datatable/data_table_related",
      "dataType": "json",
      "data": {
        "taskSysCat": "med",
        "taskCode": "CPL",
        "idRelatedTask": 0,

      },
      "type": "POST",
      "cache": true,
    },
    columns: [{
        title: '#',
        name: null,
        data: "radioButton"
      },
      {
        title: 'code',
        name: 'Code',
        "data": "propTaskComplain.taskComplainCode",
        "defaultContent": "-"
      },
      {
        title: 'Asset Code',
        name: 'Asset Code',
        "data": "propTaskComplain.propAsset.assetCode",
        "defaultContent": "-"
      },
      {
        title: 'Asset Name',
        name: 'Asset Name',
        "data": "propTaskComplain.propAsset.assetName",
        "defaultContent": "-"
      },
      {
        title: 'Merk',
        name: 'Merk',
        "data": "propTaskComplain.propAsset.propAssetPropgenit.merk",
        "defaultContent": "-"
      },
      {
        title: 'Type',
        name: 'Type',
        "data": "propTaskComplain.propAsset.propAssetPropgenit.tipe",
        "defaultContent": "-"
      },
      {
        title: 'Serial Number',
        name: 'Serial Number',
        "data": "propTaskComplain.propAsset.propAssetPropgenit.serialNumber",
        "defaultContent": "-"
      },
      {
        title: 'Room name',
        name: 'Room name',
        "data": "propTaskComplain.propAsset.propAssetPropadmin.propAssetPropbuildingRoom.roomName",
        "defaultContent": "-"
      },
      {
        title: 'Floor name',
        name: 'Floor name',
        "data": "propTaskComplain.propAsset.propAssetPropadmin.propAssetPropbuildingRoom.floorName",
        "defaultContent": "-"
      },
      {
        title: 'Building',
        name: 'Building',
        "data": "propTaskComplain.propAsset.propAssetPropadmin.propAssetPropbuildingRoom.buildingName",
        "defaultContent": "-"
      },
      {
        title: 'Complain Date',
        name: 'Complain Date',
        "data": "propSchedule.scheduleStart",
        "defaultContent": "-"
      },
      {
        title: 'Informant',
        name: 'Informant',
        "data": "propProgress.initBy",
        "defaultContent": "-"
      },
  
    ],
    retrieve: true,
    serverSide: true,
    dom: 'ftr<"row pt-2"<"col-6 text-sm"l><"col-6 text-sm"p>>',
    searching: true,
    pageLength: 15,
    lengthMenu: [15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65, 70, 75, 80, 85, 90, 95, 100],
  });
}
function SparepartList(){
  $('.select_sparepart').DataTable({
    ajax: {
      url: BASE_URL + `asset/asset_datatable/view_data_parts`,
      dataType: "json"
    },
    columns: [
      { title: '#', name: 'radio', data: 'radioButton' },
      { title: 'assets code', name: 'assets code', data: "assetCode" },
      { title: 'assets name', name: 'assets name', data: "assetName" },
      { title: 'brand', name: 'brand', data: 'propAssetPropgenit.merk' },
      { title: 'type', name: 'type', data: 'propAssetPropgenit.tipe' },
      { title: 'price', name: 'price', data: 'propAssetPropadmin.priceBuy' },
      { title: 'available stock', name: 'available_stock', data: 'qty' },
    ],
    serverSide: true,
    retrieve:true,
    dom: 'ftr<"row pt-2"<"col-6 text-sm"l><"col-6 text-sm"p>>',
    searching: true,
    pageLength: 15,
    lengthMenu: [15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65, 70, 75, 80, 85, 90, 95, 100]
  });
}
function ToolsList(){
  $('.select_tools').DataTable({
    ajax: {
      url: BASE_URL + `asset/asset_datatable/view_data_tools`,
      dataType: "json"
    },
    columns:[
      {title: '#', name: 'radio', data: 'radioButton'},
      {title:'assets code' , name:'assets code', data: "assetCode" },
      {title:'assets name', name:'assets name', data: "assetName"},
      {title:'brand', name:'brand', data: 'merk'},
      {title:'type', name:'type', data: 'tipe'},
      // {title:'price', name:'price', data: 'price'},
      // {title:'available stock', name:'available_stock', data: 'qty'},
      // {title:'used stock', name:'used_stock'},
    ],
    retrieve:true,
    dom: 'ftr<"row pt-2"<"col-6 text-sm"l><"col-6 text-sm"p>>',
    searching: true,
    pageLength: 15,
    lengthMenu: [15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65, 70, 75, 80, 85, 90, 95, 100]
  });
}
