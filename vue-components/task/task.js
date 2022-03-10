if ($('#app_form').length != 0) {
    let forms = new Vue({
        el: '#app_form',
        components: {
            'form-opname': httpVueLoader(BASE_URL + 'vue-components/task/form/form_opname.vue?v=1.0'),
            'form-opname-detail': httpVueLoader(BASE_URL + 'vue-components/task/form/form_opname_details.vue?v=1.0'),
            'form-complain': httpVueLoader(BASE_URL + 'vue-components/task/form/form_complain.vue?v=1.0'),
            'form-mutation': httpVueLoader(BASE_URL + 'vue-components/task/form/form_mutation.vue?v=1.0'),
            'form-maintenance': httpVueLoader(BASE_URL + 'vue-components/task/form/form_maintenance.vue?v=1.0'),
            'form-inspection': httpVueLoader(BASE_URL + 'vue-components/task/form/form_inspection.vue?v=1.0'),
            'form-calibration': httpVueLoader(BASE_URL + 'vue-components/task/form/form_calibration.vue?v=1.0'),
            'form-repair': httpVueLoader(BASE_URL + 'vue-components/task/form/form_repair.vue?v=1.1'),
        }
    });
}
if ($('#app_form_directTo').length != 0) {
    let formsdirectTo = new Vue({
        el: '#app_form_directTo',
        components: {
            'form-repair': httpVueLoader(BASE_URL + 'vue-components/task/form/form_repair.vue?v=1.1'),
        }
    });
}
if ($('#template_taskform').length != 0) {
    let template_taskform = new Vue({
        el: '#template_taskform',
        components: {
            'form-main': httpVueLoader(BASE_URL + 'vue-components/task/templates/form_main.vue?v=1.0'),
            'subform-assets': httpVueLoader(BASE_URL + 'vue-components/task/templates/subform_asset.vue?v=1.1'),
            'subform-measuringtools': httpVueLoader(BASE_URL + 'vue-components/task/templates/subform_measuringtools.vue?v=1.0'),
            'subform-toolset': httpVueLoader(BASE_URL + 'vue-components/task/templates/subform_toolset.vue?v=1.0'),
            'subform-rooms': httpVueLoader(BASE_URL + 'vue-components/task/templates/subform_roomconditions.vue?v=1.0'),
            'subform-electrical': httpVueLoader(BASE_URL + 'vue-components/task/templates/subform_electricalmeasurements.vue?v=1.0'),
            'subform-qualitative': httpVueLoader(BASE_URL + 'vue-components/task/templates/subform_qualitativetask.vue?v=1.0'),
            'subform-quantitative': httpVueLoader(BASE_URL + 'vue-components/task/templates/subform_quantitativetask.vue?v=1.0'),
            'subform-material': httpVueLoader(BASE_URL + 'vue-components/task/templates/subform_maintenancematerial.vue?v=1.0'),
            'subform-action-record': httpVueLoader(BASE_URL + 'vue-components/task/templates/subform_actionrecords.vue?v=1.0'),
            'subform-technician': httpVueLoader(BASE_URL + 'vue-components/task/templates/subform_technician.vue?v=1.0'),
            'subform-kpi': httpVueLoader(BASE_URL + 'vue-components/task/templates/subform_kpiservicefee.vue?v=1.0'),
            'subform-result': httpVueLoader(BASE_URL + 'vue-components/task/templates/subform_maintenanceresult.vue?v=1.0'),
            'subform-signature': httpVueLoader(BASE_URL + 'vue-components/task/templates/subform_signature.vue?v=1.1'),
        }
    });
}
if ($('#app_detail').length != 0) {
    let details = new Vue({
        el: '#app_detail',
        components: {
            'detail-general': httpVueLoader(BASE_URL + 'vue-components/task/detail/detail_general.vue?v=1.0'),
            'detail-history': httpVueLoader(BASE_URL + 'vue-components/task/detail/detail_history.vue?v=1.0'),
            'detail-opname': httpVueLoader(BASE_URL + 'vue-components/task/detail/detail_opname.vue?v=1.0'),
        }
    });
}
if ($('#app_print').length != 0) {
    let print = new Vue({
        el: '#app_print',
        components: {
            'print-task': httpVueLoader(BASE_URL + 'vue-components/task/print/print_assets.vue?v=1.0'),
        },
    });
}
if ($('#app_approve').length != 0) {
    let approve = new Vue({
        el: '#app_approve',
        components: {
            'approve-general': httpVueLoader(BASE_URL + 'vue-components/task/approve/approve_general.vue?v=1.0'),
            'approve-history': httpVueLoader(BASE_URL + 'vue-components/task/approve/approve_history.vue?v=1.0'),
            'approve-mutation': httpVueLoader(BASE_URL + 'vue-components/task/approve/approve_mutation.vue?v=1.0'),
            'form-mutation-approval': httpVueLoader(BASE_URL + 'vue-components/task/form/subform_mutationapproval.vue?v=1.0'),
        },
    });
}
if ($('#app_return').length != 0) {
    let returns = new Vue({
        el: '#app_return',
        components: {
            'return-mutation': httpVueLoader(BASE_URL + 'vue-components/task/return/return_mutation.vue?v=1.0'),
            'form-mutation-approval': httpVueLoader(BASE_URL + 'vue-components/task/form/subform_mutationapproval_return.vue?v=1.0'),
            'form-mutation-return': httpVueLoader(BASE_URL + 'vue-components/task/form/subform_mutationreturn.vue?v=1.0')
        },
    });
}
if ($('#app_confirm').length != 0) {
    let confirm = new Vue({
        el: '#app_confirm',
        components: {
            'approve-mutation': httpVueLoader(BASE_URL + 'vue-components/task/confirm/confirm_mutation.vue?v=1.0'),
            'form-mutation-approval': httpVueLoader(BASE_URL + 'vue-components/task/form/subform_mutationapproval_confirm.vue?v=1.0'),
            'form-mutation-return': httpVueLoader(BASE_URL + 'vue-components/task/form/subform_mutationreturn_confirm.vue?v=1.0'),
            'form-mutation-confirm': httpVueLoader(BASE_URL + 'vue-components/task/form/subform_mutationconfirm.vue?v=1.0'),
        },
    });
}
if ($('#report_form').length != 0) {
    let report = new Vue({
        el: '#report_form',
        components: {
            'report-calibration': httpVueLoader(BASE_URL + 'vue-components/task/form/report_calibration.vue?v=1.0'),
        },
    });

}

function SelectAssets(sysCatName) {
    $('.select_assets').DataTable({
        ajax: {
            url: BASE_URL + `asset/asset_datatable/view_data_asset`,
            dataType: "json",
            data: {
                sysCatName: sysCatName
            },
            type: "POST",
            cache: true
        },
        columns: [
            { title: '#', name: 'radio', data: 'radioButton' },
            { title: 'assets code', name: 'assets code', data: "assetCode" },
            { title: 'assets name', name: 'assets name', data: "assetName" },
            { title: 'room', name: 'room', data: 'propAssetPropadmin.propAssetPropbuildingRoom.roomName' },
            { title: 'brand', name: 'brand', data: 'propAssetPropgenit.merk' },
            { title: 'type', name: 'type', data: 'propAssetPropgenit.tipe' },
            { title: 'serial number', name: 'serial number', data: 'propAssetPropgenit.serialNumber' }
        ],
        processing: true,
        retrieve: true,
        serverSide: true,
        dom: '<"row"<"col-xl-4"l><"col-xl-8"f>>tr<"col-12"p>',
        searching: true,
        pageLength: 50,
        lengthMenu: [50, 100, 150, 200, 250, 300, 350, 400, 450, 500]
    });
}

function SelectLocation() {
    return $('.select_location').DataTable({
        columns: [{
                title: '#',
                name: null
            },
            {
                title: 'room',
                name: 'room'
            },
            {
                title: 'floor',
                name: 'floor'
            },
            {
                title: 'building',
                name: 'building'
            },
        ],
        // retrieve:true,
        dom: 'ftr<"row pt-2"<"col-6 text-sm"l><"col-6 text-sm"p>>',
        retrieve: true,
        searching: true,
        pageLength: 15,
        lengthMenu: [15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65, 70, 75, 80, 85, 90, 95, 100]
    });
}

function SelectAssets_1(sysCatName) {
    let table = $('.select_assets_1').DataTable({
        ajax: {
            url: BASE_URL + "asset/asset_datatable/view_data_table",
            dataType: "json",
            type: "POST",
            data: {
                sysCatName: sysCatName,
            }
        },
        columns: [
            { title: '<input type="checkbox" id="checkAll" class="customcheck"/>', name: null, data: 'check_box' },
            { title: 'no', name: 'no', data: 'no' },
            { title: 'assets code', name: 'assets code', data: 'assetCode' },
            { title: 'assets name', name: 'assets name', data: 'assetName' },
            { title: 'room', name: 'room', data: 'propAssetPropadmin.propAssetPropbuildingRoom.roomName' },
            { title: 'brand', name: 'brand', data: 'propAssetPropgenit.merk' },
            { title: 'type', name: 'type', data: 'propAssetPropgenit.tipe' },
            { title: 'serial number', name: 'serial number', data: 'propAssetPropgenit.serialNumber' }
        ],
        retrieve: true,
        serverSide: true,
        dom: '<"row"<"col-xl-4"l><"col-xl-8"f>>tr<"col-12"p>',
        searching: true,
        pageLength: 50,
        lengthMenu: [50, 100, 150, 200, 250, 300, 350, 400, 450, 500]
    });
    $(document).on('click', '.select_assets_1 tbody td', function() {
        var colIdx = table.cell(this).index().row;
        // console.log(colIdx);
        if (table.rows(colIdx).nodes().to$().find('td:first-child .checkboxes').is(':checked') === true) {
            table.rows(colIdx).nodes().to$().find('td:first-child .checkboxes').prop('checked', false);
            table.rows(colIdx).nodes().to$().removeClass('highlight');
        } else {
            table.rows(colIdx).nodes().to$().find('td:first-child .checkboxes').prop('checked', true);
            // console.log(table.rows(colIdx).nodes().to$().find('td:first-child .checkboxes').val());
            table.rows(colIdx).nodes().to$().addClass('highlight');
        }
    });
    $('.customcheck').click(function() {
        $('input:checkbox.checkboxes').not(this).prop('checked', this.checked);
        if ($('input:checkbox.checkboxes').not(this).is(':checked') === true) {
            table.rows().select();
            $('tbody tr').addClass('highlight');
            $('.checkboxes').prop('checked', true);
            $("input:checkbox").prop('checked', $(this).prop("checked"));
            // console.log($('input:checkbox.checkboxes').not(this));
        } else {
            table.rows().deselect();
            $('tbody tr').removeClass('highlight');
            $('.checkboxes').prop('checked', false);
            $("input:checkbox:not(:checked)").map(function() {
                // deleteAssetMasterSelected($(this).val())
            });
        }
    });
}

function ScheduleAssets_1() {
    $('.schedule_assets_1').DataTable({
        columns: [
            { title: 'no', name: 'no' },
            { title: 'assets code', name: 'assets code' },
            { title: 'assets name', name: 'assets name' },
            { title: 'risk level', name: 'risk level' },
            { title: 'room', name: 'room' },
            { title: 'brand', name: 'brand' },
            { title: 'type', name: 'type' },
            { title: 'serial number', name: 'serial number' },
            { title: 'form', name: 'form' },
            { title: 'action', name: 'action' }
        ],
        retrieve: true,
        dom: 'tr<"row pt-2"<"col-6 text-sm"l><"col-6 text-sm"p>>',
        searching: true,
        pageLength: 15,
        lengthMenu: [15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65, 70, 75, 80, 85, 90, 95, 100]
    });
}

function ScheduleAssets_2() {
    $('.schedule_assets_2').DataTable({
        columns: [
            { title: 'no', name: 'no' },
            { title: 'assets code', name: 'assets code' },
            { title: 'assets name', name: 'assets name' },
            { title: 'risk level', name: 'risk level' },
            { title: 'room', name: 'room' },
            { title: 'brand', name: 'brand' },
            { title: 'type', name: 'type' },
            { title: 'serial number', name: 'serial number' },
            { title: 'action', name: 'action' }
        ],
        retrieve: true,
        dom: 'tr<"row pt-2"<"col-6 text-sm"l><"col-6 text-sm"p>>',
        searching: true,
        pageLength: 15,
        lengthMenu: [15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65, 70, 75, 80, 85, 90, 95, 100]
    });
}

function SelectComplain(taskSysCat, taskCode) {

    $('.select_complain').DataTable({
        "ajax": {
            "url": BASE_URL + "task/med/task_datatable/data_table_related",
            "dataType": "json",
            "data": {
                "taskSysCat": taskSysCat,
                "taskCode": taskCode,
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
                data: "propTaskComplain.taskComplainCode",
                defaultContent: "-"
            },
            {
                title: 'Asset Code',
                name: 'Asset Code',
                data: "propTaskComplain.propAsset.assetCode",
                defaultContent: "-"
            },
            {
                title: 'Asset Name',
                name: 'Asset Name',
                data: "propTaskComplain.propAsset.assetName",
                defaultContent: "-"
            },
            {
                title: 'Merk',
                name: 'Merk',
                data: "propTaskComplain.propAsset.propAssetPropgenit.merk",
                defaultContent: "-"
            },
            {
                title: 'Type',
                name: 'Type',
                data: "propTaskComplain.propAsset.propAssetPropgenit.tipe",
                defaultContent: "-"
            },
            {
                title: 'Serial Number',
                name: 'Serial Number',
                data: "propTaskComplain.propAsset.propAssetPropgenit.serialNumber",
                defaultContent: "-"
            },
            {
                title: 'Room name',
                name: 'Room name',
                data: "propTaskComplain.propAsset.propAssetPropadmin.propAssetPropbuildingRoom.roomName",
                defaultContent: "-"
            },
            {
                title: 'Floor name',
                name: 'Floor name',
                data: "propTaskComplain.propAsset.propAssetPropadmin.propAssetPropbuildingRoom.floorName",
                defaultContent: "-"
            },
            {
                title: 'Building',
                name: 'Building',
                data: "propTaskComplain.propAsset.propAssetPropadmin.propAssetPropbuildingRoom.buildingName",
                defaultContent: "-"
            },
            {
                title: 'Complain Date',
                name: 'Complain Date',
                data: "propSchedule.scheduleStart",
                defaultContent: "-"
            },
            {
                title: 'Informant',
                name: 'Informant',
                data: "propProgress.initBy",
                defaultContent: "-"
            },

        ],
        retrieve: true,
        serverSide: true,
        dom: 'ftr<"row pt-2"<"col-6 text-sm"l><"col-6 text-sm"p>>',
        searching: true,
        pageLength: 50,
        lengthMenu: [50, 100, 150, 200, 250, 300, 350, 400, 450, 500]
    });
}

function SparepartList(sysCatName) {
    $('.select_sparepart').DataTable({
        ajax: {
            url: BASE_URL + `asset/asset_datatable/view_data_table_parts`,
            dataType: "json",
            data: {
                sysCatName: sysCatName
            },
            type: "POST",
            cache: true,
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
        retrieve: true,
        dom: 'ftr<"row pt-2"<"col-6 text-sm"l><"col-6 text-sm"p>>',
        searching: true,
        pageLength: 50,
        lengthMenu: [50, 100, 150, 200, 250, 300, 350, 400, 450, 500]
    });
}

function ToolsList(sysCatName) {
    $('.select_tools').DataTable({
        ajax: {
            url: BASE_URL + `asset/asset_datatable/view_data_tools`,
            dataType: "json",
            data: {
                sysCatName: sysCatName
            }
        },
        columns: [
            { title: '#', name: 'radio', data: 'radioButton' },
            { title: 'assets code', name: 'assets code', data: "assetCode" },
            { title: 'assets name', name: 'assets name', data: "assetName" },
            { title: 'brand', name: 'brand', data: 'merk' },
            { title: 'type', name: 'type', data: 'tipe' },
        ],
        retrieve: true,
        dom: 'ftr<"row pt-2"<"col-6 text-sm"l><"col-6 text-sm"p>>',
        searching: true,
        pageLength: 50,
        lengthMenu: [50, 100, 150, 200, 250, 300, 350, 400, 450, 500]
    });
}

function ToolsList2(sysCatName) {
    $('.select_tools2').DataTable({
        ajax: {
            url: BASE_URL + `asset/asset_datatable/view_data_tools2`,
            dataType: "json",
            data: {
                sysCatName: sysCatName
            }
        },
        columns: [
            { title: '#', name: 'radio', data: 'radioButton' },
            { title: 'assets code', name: 'assets code', data: "assetCode" },
            { title: 'assets name', name: 'assets name', data: "assetName" },
            { title: 'brand', name: 'brand', data: 'merk' },
            { title: 'type', name: 'type', data: 'tipe' },
        ],
        retrieve: true,
        dom: 'ftr<"row pt-2"<"col-6 text-sm"l><"col-6 text-sm"p>>',
        searching: true,
        pageLength: 50,
        lengthMenu: [50, 100, 150, 200, 250, 300, 350, 400, 450, 500]
    });
}
