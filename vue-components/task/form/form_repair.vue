<template>
<div class="p-10">
    <p class="mandatory-info">
        Field marked <span>*</span> is required to fill or mandatory
    </p>
    <div class="samrs-detail-box">
        <label class="detail-title">equipment information</label>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">complain<span>*</span></label>
            </div>
            <input type="hidden" name="formType" />
            <input id="idProgress" name="idProgress" type="hidden" />
            <input id="idForm" name="idForm" type="hidden" />
            <input id="idRelatedTask" name="idRelatedTask" type="hidden" />
            <input id="idSchedule" name="idSchedule" type="hidden" />
            <input id="idTask" name="idTask" type="hidden" />
            <input id="taskName" name="taskName" type="hidden" />
            <input id="taskDesc" name="taskDesc" type="hidden" />
            <input id="idTaskFile1" name="idTaskFile1" type="hidden" />
            <input id="idFile1" name="idFile1" type="hidden" />
            <input id="fileDesc1" name="fileDesc1" type="hidden" />
            <input id="idTaskFile2" name="idTaskFile2" type="hidden" />
            <input id="idFile2" name="idFile2" type="hidden" />
            <input id="fileDesc2" name="fileDesc2" type="hidden" />
            <div class="col-xl-8">
                <div class="input-group">
                    <input type="hidden" name="idComplain" id="idComplain" />

                    <input class="form-control" readonly name="complain" type="text" id="complain" required />
                    <div class="input-group-append btn-repair">
                        <button class="btn samrs-primary" type="button" name="button" id="btn-pick-complain" v-on:click="complainpick">
                            Pick
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">asset code<span>*</span></label>
            </div>
            <div class="col-xl-8">
                <input type="hidden" name="catCode" />
                <input type="hidden" name="idAsset" id="idAsset" required />
                <input class="form-control" name="assetCode" type="text" id="assetCode" required readonly />
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">asset name</label>
            </div>
            <div class="col-xl-8">
                <input class="form-control" name="assetName" type="text" id="assetName" required readonly />
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">brand</label>
            </div>
            <div class="col-xl-8">
                <input class="form-control" name="merk" type="text" id="merk" required readonly />
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">type</label>
            </div>
            <div class="col-xl-8">
                <input class="form-control" name="tipe" type="text" id="tipe" required readonly />
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">serial number</label>
            </div>
            <div class="col-xl-8">
                <input class="form-control" name="serialNumber" type="text" id="serialNumber" required readonly />
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">room</label>
            </div>
            <div class="col-xl-8">
                <input class="form-control" name="roomName" type="text" id="roomName" required readonly />
            </div>
        </div>
    </div>

    <div class="samrs-detail-box mt-20">
        <label class="detail-title">complain information</label>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">complain informants</label>
            </div>
            <div class="col-xl-8">
                <input class="form-control" type="text" name="initBy" required readonly />
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">complain date</label>
            </div>
            <div class="col-xl-8">
                <input class="form-control" name="scheduleStart" type="text" id="scheduleStart" required readonly />
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">complain request<span>*</span></label>
            </div>
            <div class="col-xl-8">
                <textarea class="form-control" name="complainRequest" id="complainRequest" rows="3" required readonly></textarea>
                <input type="hidden" name="repairProblem" />
            </div>
        </div>
        <div class="samrs-detail-box mt-20 bg-gray">
            <label class="detail-title">complain pictures</label>
            <div class="samrs-flex wrapped is-row in-center insert-gambar">
            </div>
        </div>
    </div>

    <div class="samrs-detail-box mt-20">
        <label class="detail-title"> technician engineer/vendor in-charges</label>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">technician <span>*</span></label>
            </div>
            <div class="col-xl-8">
                <input type="hidden" name="assignTo" id="assignTo" />

                <!-- <select name="idAssignee" id="idAssignee" data-live-search="true" required class="form-control selectpicker-teknisi with-ajax-teknisi">
                    <option id="option-ajax-teknisi">Select</option>
                </select> -->
                <slot name="idassigne"></slot>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">with technician assistant ?</label>
            </div>
            <div class="col-xl-8">
                <input class="samrs-switch" type="checkbox"
                data-toggle="toggle" data-size="small" data-on="Yes" data-off="No"
                data-onstyle="success" data-offstyle="danger" collapse-target="#TechAssistantField" value="Yes" id="withTechAssistant">
            </div>
        </div>
        <div class="form-group border-1 border-light collapse" id="TechAssistantField">
            <div class="collapse p-10" id="assistantField">
                <!-- <subform-assistant></subform-assistant> -->
                <form id="uploadForm" method="post">
                    <div class="form-group">
                        <select name="idUserPic[]" id="idUserPic" data-live-search="true" multiple class="form-control selectpicker-asstech with-ajax-asstech">
                            <option id="option-ajax-asstech">Select</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-sm samrs-primary btn-block" type="submit" name="button"><i class="fas fa-plus"></i> Add</button>
                    </div>
                </form>
            </div>
            <button class="btn btn-sm samrs-primary mb-10 mr-10 mt-10 float-right" type="button" data-toggle="collapse" data-target="#assistantField">
                <i class="fas fa-plus"></i> Add New</button>
            <div class="table-responsive">
                <table class="techassistant_list table samrs-tableview capitalize w-100">
                    <thead></thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">with vendor technician ?</label>
            </div>
            <div class="col-xl-8">
                <input class="samrs-switch" type="checkbox"
                data-toggle="toggle" data-size="small" data-on="Yes" data-off="No"
                data-onstyle="success" data-offstyle="danger" collapse-target="#TechVendorField" value="Yes" id="withTechVendor" />
            </div>
        </div>
        <div class="form-group border-1 border-light collapse" id="TechVendorField">
            <subform-vendortech></subform-vendortech>
        </div>
    </div>

    <div class="samrs-detail-box mt-20">
        <label class="detail-title">repair action</label>
        <div class="ml-10 mr-10">
            <div class="form-group border-1 border-light row">
                <div class="col-xl-4">
                    <label class="form-title">action records</label>
                </div>
                <div class="col-xl-8">
                    <div class="collapse" id="recordField">
                        <subform-records></subform-records>
                    </div>
                    <button class="btn btn-sm samrs-primary float-right mr-10 mt-10 mb-10" type="button" data-toggle="collapse" data-target="#recordField">
                        <i class="fas fa-plus"></i> Add new
                    </button>
                    <div class="table-responsive">
                        <table class="progressrecord_list samrs-tableview capitalize w-100">
                            <thead></thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="form-group row border-1 border-light">
                <div class="col-xl-4 pt-10 pb-10">
                    <label class="form-title">with sparepart usage ?</label>
                </div>
                <div class="col-xl-8 pt-10 pb-10">
                    <input class="samrs-switch" type="checkbox" data-toggle="toggle"
                    data-size="small" data-on="Yes" data-off="No"
                    data-onstyle="success" data-offstyle="danger" value="Yes" collapse-target="#ActionSparepartUsage"  name="isNeedPart" id="withActionSparepart" />
                </div>
                <div class="col-xl-12 collapse" id="ActionSparepartUsage">
                    <div class="collapse" id="sparepartUsageField">
                        <subform-sparepart></subform-sparepart>
                    </div>
                    <button class="btn btn-sm samrs-primary float-right mr-10 mt-10 mb-10" type="button" data-toggle="collapse" data-target="#sparepartUsageField">
                        <i class="fas fa-plus"></i> Add new
                    </button>
                    <div class="table-responsive">
                        <table class="sparepartusage_list samrs-tableview table-bordered capitalize w-100">
                            <thead></thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="form-group row border-1 border-light">
                <div class="col-xl-4 pt-10 pb-10">
                    <label class="form-title">with service charges ?</label>
                </div>
                <div class="col-xl-8 pt-10 pb-10">
                    <input class="samrs-switch" type="checkbox" data-toggle="toggle"
                    data-size="small" data-on="Yes" data-off="No"
                    data-onstyle="success" data-offstyle="danger" collapse-target="#ActionServiceCharge" value="Yes" id="withActionService" />
                </div>
                <div class="col-xl-12 collapse" id="ActionServiceCharge">
                    <div class="collapse" id="serviceChargesField">
                        <subform-servicecharge></subform-servicecharge>
                    </div>
                    <button class="btn btn-sm samrs-primary float-right mr-10 mt-10 mb-10" type="button" data-toggle="collapse" data-target="#serviceChargesField">
                        <i class="fas fa-plus"></i> Add new
                    </button>
                    <div class="table-responsive">
                        <table class="servicecharge_list  samrs-tableview table-bordered capitalize w-100">
                            <thead></thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="form-group row border-1 border-light">
                <div class="col-xl-4 pt-10 pb-10">
                    <label class="form-title">with tools usage ?</label>
                </div>
                <div class="col-xl-8 pt-10 pb-10">
                    <input class="samrs-switch" type="checkbox" data-toggle="toggle"
                    data-size="small" data-on="Yes" data-off="No"
                    data-onstyle="success" data-offstyle="danger" collapse-target="#ActionToolsUsage" value="Yes" id="withActionTools" />
                </div>
                <div class="col-xl-12 collapse" id="ActionToolsUsage">
                    <div class="collapse" id="toolsUsageField">
                        <subform-toolusage></subform-toolusage>
                    </div>
                    <button class="btn btn-sm samrs-primary float-right mr-10 mt-10 mb-10" type="button" data-toggle="collapse" data-target="#toolsUsageField">
                        <i class="fas fa-plus"></i> Add new
                    </button>
                    <div class="table-responsive">
                        <table class="toolsusage_list samrs-tableview table-bordered capitalize w-100">
                            <thead></thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group row mt-20">
        <div class="col-xl-4">
            <label class="form-title">is finish already ?</label>
        </div>
        <div class="col-xl-8">
            <input class="samrs-switch" type="checkbox" data-toggle="toggle"
             data-size="small" data-on="Yes" data-off="No"
             data-onstyle="success" data-offstyle="danger" collapse-target="#finalResultField" name="isPending" value="Yes" id="isAlreadyFinish" />
        </div>
    </div>

    <div class="samrs-detail-box mt-20 collapse" id="finalResultField">
        <label class="detail-title">Final Result</label>
        <subform-result></subform-result>
        <input type="hidden" name="idTaskSignature">
        <div class="samrs-detail-box mt-20">
            <div class="samrs-flex wrapped is-row in-end">
                <div class="signature-box mt-40">
                    <div class="signature-title">Technician :</div>
                    <div class="signature-draw">
                        <img id="drawOtpTeknisi" src="" alt="" width="100" height="100" />
                        <input type="hidden" name="signHashSignature" id="signHashSignature">
                    </div>
                    <div class="signature-name">
                        <p class="name-teknisi text-center">
                            ...........
                        </p>
                    </div>
                    <div class="text-center" id="addSignatureTeknisi">
                        <button class="btn btn-info waves-effect waves-light" type="button" data-id="technician" id="approve-teknisi" data-toggle="modal">Add Signature</button>
                    </div>
                    <div class="text-center" id="addDrawTeknisi" style="display:none;">
                        <button class="btn btn-success waves-effect waves-light" type="button" data-id="drawtechnician" id="approve-draw-teknisi">Add Signature</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
module.exports = {
    components: {
        "subform-records": httpVueLoader(
            BASE_URL + "vue-components/task/form/subform_records.vue"
        ),
        "subform-sparepart": httpVueLoader(
            BASE_URL + "vue-components/task/form/subform_sparepartusage.vue"
        ),
        "subform-servicecharge": httpVueLoader(
            BASE_URL + "vue-components/task/form/subform_servicecharge.vue"
        ),
        "subform-toolusage": httpVueLoader(
            BASE_URL + "vue-components/task/form/subform_toolusage.vue"
        ),
        "subform-assistant": httpVueLoader(
            BASE_URL + "vue-components/task/form/subform_assistanttech.vue"
        ),
        "subform-vendortech": httpVueLoader(
            BASE_URL + "vue-components/task/form/subform_vendortech.vue"
        ),
        "subform-result": httpVueLoader(
            BASE_URL + "vue-components/task/form/subform_repairresult.vue"
        ),
    },
    methods: {
        complainpick: function () {
            $("#select_complain").modal("show");
            // console.log(this.images);
        },
        activeState(indexed) {
            if (indexed === 0) {
                return "active";
            } else {
                return "";
            }
        },
    },
    mounted() {
        SwitchToCollapse();
        $("#drawOtpTeknisi").attr('src', BASE_URL + "assets/images/white.png");

        // cek apakah metode approve menggunakan otp or ttd
        $.ajax({
            type: "POST",
            url: BASE_URL + "task/med/complain/information_setting",
            data: {},
            dataType: "json",
            success: function (res) {
                if (res.userVar == "signature|ttd") {
                    $("#addSignatureTeknisi").remove();
                    $("input[name=signHashSignature]").val(res.userVar);
                    $('#addDrawTeknisi').css({
                        'display': ''
                    });
                }
            }
        });

        let username = $("input[name=idAssignee]").val();

        $(".name-teknisi").html(username);

        $("#approve-draw-teknisi").click(function (e) {
            e.preventDefault();
            let idTask = $("input[name=idTaskSignature]").val();
            $.confirm({
                title: "Confirmation",
                content: "Are You Sure You Will Approve this Data ?",
                theme: 'bootstrap',
                columnClass: 'medium',
                typeAnimated: true,
                buttons: {
                    approve: {
                        text: 'Submit',
                        btnClass: 'btn-blue',
                        action: function () {
                            $.ajax({
                                type: "POST",
                                url: BASE_URL + "task/med/repair/finishSignDraw",
                                data: {
                                    'idTask': idTask
                                },
                                dataType: "json",
                                success: function (res) {
                                    $(`#drawOtpTeknisi`).attr("src", BASE_URL + "assets/upload/file/" + res.substr(5));
                                    $("#addDrawTeknisi").remove();
                                },
                                error: function (xhr, ajaxOptions, thrownError) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: thrownError,
                                    });
                                }
                            });
                        }
                    },
                    close: function () {}
                }
            });
        });

        $("#approve-teknisi").click(function (e) {
            e.preventDefault();
            let idTask = $("input[name=idTaskSignature]").val();
            $("#btn-approve-teknisi").css({
                'display': ''
            });
            $("#OTPModalChairman").modal('show');
            $.ajax({
                url: BASE_URL + 'otp/signatureOtpRequest',
                type: 'POST',
                dataType: 'json',
                data: {
                    'otpContext': 'idTask=' + idTask,
                },
                success: function (res) {
                    // response = JSON.parse(res)
                    $('#otpMessage').text(res.otpMessage);
                    $('#otpCode').val(`${res.otpPrefix}-`);
                    // console.log(res)
                }
            });
        });

        $('#submitOTPTeknisi').click(function () {
            let idTask = $("input[name=idTaskSignature]").val();
            var otpCode = $('#otpCode').val();

            $.ajax({
                url: BASE_URL + 'otp/signatureSigning',
                type: 'POST',
                dataType: 'json',
                data: {
                    // "otpPrefix": "string",
                    "otpCode": otpCode,
                    "objectContext": 'idTask=' + idTask,
                },
                success: function (doc) {
                    console.log(doc)
                    if (doc.signResult == true) {
                        $('#otpMessage').empty().text(doc.signMessage);
                        finishSign(doc.signHash);
                        $("input[name=signHashSignature]").val(doc.signHash);

                        $.ajax({
                            type: "POST",
                            url: BASE_URL + "task/med/maintenance/schedule_report/generate_ttd",
                            data: {
                                'signHash': doc.signHash
                            },
                            dataType: "json",
                            success: function (res) {
                                // console.log(res);
                                $("#OTPModalChairman").modal('hide');

                                $(`#drawOtpTeknisi`).attr("src", res.otp);
                                $("#addSignatureTeknisi").remove();
                            }
                        });
                        // location.reload();
                    }
                }
            });
        });

        function finishSign(signHash) {
            let idTask = $("input[name=idTaskSignature]").val();
            $.ajax({
                url: BASE_URL + 'task/med/repair/finishSign',
                type: 'POST',
                dataType: 'json',
                data: {
                    "signHash": signHash,
                    "idTask": idTask
                },
                success: function (doc) {
                    // console.log(doc)
                }
            });
        }

        $('form#uploadForm').submit(function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            var ajax_idform = $("input[name=idForm]").val();

            if (ajax_idform != '') {
                var url = BASE_URL + 'task/med/task_datatable/session_add_asstech/' + ajax_idform;
            } else {
                var url = BASE_URL + 'task/med/task_datatable/session_add_asstech/';
            }
            // console.log(formData);
            $.ajax({
                type: "POST",
                url: url,
                data: formData,
                success: function (data) {
                    // const response = JSON.parse(data)
                    // console.log(data)
                    // if (ajax_idasset_edit === '') {
                    $('.techassistant_list').DataTable().ajax.reload();
                    // } else {
                    //   $('.file_list').DataTable().ajax.url(BASE_URL + "asset_propfiles/asset_propfiles_by_id_asset/" + ajax_idasset_edit).load();
                    // }

                },
                error: function (data) {
                    console.log(data)
                },
                cache: false,
                contentType: false,
                processData: false
            });

        });
        $(function () {
            TechAssistantList();
            ToolsUsageList();
            TechVendorList();
            ProgressRecordList();
            SparepartUsageList();
            ServiceChargesList();
            // onChangeUser();
            // evtUser("init");
            $(document).on("click", ".selected-complain", function () {
                var id_related_task = this.value;
                var idTask = this.value;
                var idcomplain = $(this).data("idcomplain");
                var idprogress = $(this).data("idprogress");
                var complain = $(this).data("complain");
                var idasset = $(this).data("idasset");
                var code = $(this).data("code");
                var assetname = $(this).data("assetname");
                var catcode = $(this).data("catcode");
                var merk = $(this).data("merk");
                var tipe = $(this).data("tipe");
                var sn = $(this).data("sn");
                var room = $(this).data("room");
                var informants = $(this).data("informants");
                var cpldate = $(this).data("cpldate");
                var cplreq = $(this).data("cplreq");

                $("input[name=idRelatedTask]").val(id_related_task);
                $("input[name=idTaskSignature]").val(idTask);
                $("input[name=idProgress]").val(idprogress);
                $("input[name=idComplain]").val(idcomplain);
                $("input[name=idAsset]").val(idasset);
                $("input[name=catCode]").val(catcode);
                $("input[name=complain]").val(complain);
                $("input[name=assetCode]").val(code);
                $("input[name=assetName]").val(assetname);
                $("input[name=merk]").val(merk);
                $("input[name=tipe]").val(tipe);
                $("input[name=serialNumber]").val(sn);
                $("input[name=roomName]").val(room);
                $("input[name=initBy]").val(informants);
                $("input[name=scheduleStart]").val(cpldate);
                $("textarea[name=complainRequest]").val(cplreq);

                $.ajax({
                    type: "POST",
                    url: BASE_URL + "task/med/repair/files_by_id_task",
                    data: {
                        idTask: idTask,
                    },
                    dataType: "json",
                    success: function (res) {
                        if (res.data_file.length > 0) {
                            $(".insert-gambar").css({
                                visibility: "visible",
                            });
                            for (i = 0; i < res.data_file.length; i++) {
                                // console.log(res.data_file[i].fileDesc);
                                //  <div class="carousel-item ` + ActiveIndex(i) + `">
                                // <a href="` + BASE_URL + `assets/upload/file/` + res.data_file[i].fileDesc + `" data-fancybox="preview" data-width="320" data-height="320">
                                //          <img class="img-responsive zoom is-fix" style="width:200px; height:200px;" alt="" src="` + BASE_URL + `assets/upload/file/` + res.data_file[i].fileDesc + `" />
                                //  </a>
                                //  </div>
                                $(".insert-gambar").append(`
                                  <div class="border-dashed p-1 mr-10 ml-10" samrs-border="1px">
                                    <a href="` + BASE_URL + `assets/upload/file/` + res.data_file[i].fileDesc + `" data-fancybox="preview" data-width="320" data-height="320" title="Click for expand">
                                        <img class="img-responsive zoom is-fix" alt="" src="` + BASE_URL + `assets/upload/file/` + res.data_file[i].fileDesc + `" />
                                     </a>
                                  </div>
                                  `);
                            }
                        } else {
                            $(".insert-gambar").css({
                                visibility: "hidden",
                            });
                        }
                        // console.log(response);
                    },
                });
            });
        });
        var TASKSYSCAT = $("input[name=taskSysCat]").val();
        var TASKCODE = $("input[name=taskCode]").val();
        SwitchInital();
        SelectComplain(TASKSYSCAT, TASKCODE);
        DatePicker();

        evtAsstech('init');

        function evtAsstech(evt) {
            var options = {
                ajax: {
                    // url     : SITE_URL + "assets/vendors/bootstrap-select-ajax/example/php/ajax.php",
                    emptyRequest: true,
                    url: BASE_URL + "asset/building/room_bld/ajax_user",
                    type: "POST",
                    dataType: "json",
                    // Use "{{{q}}}" as a placeholder and Ajax Bootstrap Select will
                    // automatically replace it with the value of the search query.
                    data: {
                        q: "{{{q}}}",
                    },
                },
                locale: {
                    emptyTitle: "Tap to search",
                },
                log: 3,
                preprocessData: function (data) {
                    var i,
                        l = data.length,
                        array = [];

                    if (l) {
                        for (i = 0; i < l; i++) {
                            array.push(
                                $.extend(true, data[i], {
                                    text: data[i].userFullName,
                                    value: data[i].idUser,
                                    // data: {
                                    //     subtext: data[i].catCode + "-" + data[i].idAsset
                                    // }
                                })
                            );
                        }
                    }
                    // You must always return a valid array when processing data. The
                    // data argument passed is a clone and cannot be modified directly.
                    return array;
                },
            };

            if (evt == "init") {
                $(".selectpicker-asstech")
                    .selectpicker()
                    .filter(".with-ajax-asstech")
                    .ajaxSelectPicker(options);
            } else if (evt == "render") {
                $(".selectpicker-asstech")
                    .selectpicker()
                    .filter(".with-ajax-asstech")
                    .ajaxSelectPicker("render");
            }
        }

        function ActiveIndex(index) {
            if (index === 0) {
                return 'active';
            }
        };
        function TechAssistantList() {
            $(".techassistant_list").DataTable({
                ajax: BASE_URL + "task/med/task_datatable/list_session_asstech",
                columns: [{
                        title: "no",
                        name: "no",
                        data: null,
                    },
                    {
                        title: "name",
                        name: "name",
                        data: "picName",
                    },
                    {
                        title: "option",
                        name: "option",
                        data: null,
                        render: function (data, type, row) {
                            return `<a onClick="return delete_confirmation_asstech_repair(event, ${(data.idFPic == null ? data.idUserPic : data.idFPic)})" href="javascript:void(0);"  class="btn-deletefile btn btn btn-rounded btn-outline-danger mr-2 btn-sm" > <i class="ti-trash"></i></a>`;

                        }
                    },
                ],
                "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    var index = iDisplayIndex + 1;
                    var api = this.api();
                    var pageInfo = api.page.info();
                    var page = pageInfo.page;
                    var length = pageInfo.length;

                    var number = (page * length) + index;

                    $('td:eq(0)', nRow).html(number);
                    return nRow;
                },
                retrieve: true,
                serverSide: true,
                dom: "tr",
                pageLength: 15,
                lengthMenu: [
                    15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65, 70, 75, 80, 85, 90, 95,
                    100,
                ],
            });
        }

        function TechVendorList() {
            $(".vendortech_list").DataTable({
                columns: [{
                        title: "no",
                        name: "no",
                    },
                    {
                        title: "name",
                        name: "name",
                    },
                    {
                        title: "phone/mobile",
                        name: "phone/mobile",
                    },
                    {
                        title: "action",
                        name: "action",
                    },
                ],
                // retrieve: true,
                serverSide: true,
                dom: "tr",
                pageLength: 15,
                lengthMenu: [
                    15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65, 70, 75, 80, 85, 90, 95,
                    100,
                ],
            });
        }

        function ProgressRecordList() {
            var no = 1;
            $(".progressrecord_list").DataTable({
                ajax: BASE_URL + "task/med/task_datatable/list_session_record",
                columns: [{
                        title: "no",
                        name: "no",
                        data: null,
                    },
                    {
                        title: "date/time",
                        name: "date_time",
                        data: "genTime",
                    },
                    {
                        title: "description",
                        name: "description",
                        data: "genAction",
                    },
                    {
                        title: "noted by",
                        name: "noted_by",
                        data: "genByName",
                    },
                    {
                        title: "option",
                        name: "option",
                        data: null,
                        render: function (data, type, row) {
                            return `<a onClick="return delete_confirmation_record_repair(event, ${(data.idGen == null ? data.genTime.substr(17) : data.idGen)})" href="javascript:void(0);"  class="btn-deletefile btn btn btn-rounded btn-outline-danger mr-2 btn-sm" > <i class="ti-trash"></i></a>`;

                        }
                    },
                ],
                retrieve: true,
                serverSide: true,
                dom: "tr",
                pageLength: 15,
                lengthMenu: [
                    15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65, 70, 75, 80, 85, 90, 95,
                    100,
                ],
                "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    var index = iDisplayIndex + 1;
                    var api = this.api();
                    var pageInfo = api.page.info();
                    var page = pageInfo.page;
                    var length = pageInfo.length;

                    var number = (page * length) + index;

                    $('td:eq(0)', nRow).html(number);
                    return nRow;
                },
            });
        }

        function SparepartUsageList() {
            $(".sparepartusage_list").DataTable({
                ajax: BASE_URL + "task/med/task_datatable/list_session_stock",
                columns: [{
                        title: "no",
                        name: "no",
                        data: null,
                    },
                    {
                        title: "asset code",
                        name: "asset_code",
                        data: "partUnits",
                    },
                    {
                        title: "asset name",
                        name: "assets_name",
                        data: "partName",
                    },
                    {
                        title: "brand",
                        name: "brand",
                        data: "partBrand",
                    },
                    {
                        title: "type",
                        name: "type",
                        data: "partType",
                    },
                    {
                        title: "qty",
                        name: "qty",
                        data: "partQTY",
                    },
                    {
                        title: "option",
                        name: "option",
                        data: null,
                        render: function (data, type, row) {
                            return `<a onClick="return delete_confirmation_stock_repair(event, ${(data.idFPart == null ? data.idAssetPart : data.idFPart)})" href="javascript:void(0);"  class="btn-deletefile btn btn btn-rounded btn-outline-danger mr-2 btn-sm" > <i class="ti-trash"></i></a>`;

                        }
                    },
                ],
                retrieve: true,
                serverSide: true,
                dom: "tr",
                pageLength: 15,
                lengthMenu: [
                    15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65, 70, 75, 80, 85, 90, 95,
                    100,
                ],
                "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    var index = iDisplayIndex + 1;
                    var api = this.api();
                    var pageInfo = api.page.info();
                    var page = pageInfo.page;
                    var length = pageInfo.length;

                    var number = (page * length) + index;

                    $('td:eq(0)', nRow).html(number);
                    return nRow;
                },
            });
        }

        function ToolsUsageList() {
            $(".toolsusage_list").DataTable({
                ajax: BASE_URL + "task/med/task_datatable/list_session_tools",
                columns: [{
                        title: "no",
                        name: "no",
                        data: null,
                    },
                    {
                        title: "asset name",
                        name: "assets_name",
                        data: "assetName",
                    },
                    {
                        title: "brand",
                        name: "brand",
                        data: "assetMerk",
                    },
                    {
                        title: "type",
                        name: "type",
                        data: "assetType",
                    },
                    {
                        title: "option",
                        name: "option",
                        data: null,
                        render: function (data, type, row) {
                            return `<a onClick="return delete_confirmation_tools_repair(event, ${(data.idFpTools == null ? data.idAsset : data.idFpTools)})" href="javascript:void(0);"  class="btn-deletefile btn btn btn-rounded btn-outline-danger mr-2 btn-sm" > <i class="ti-trash"></i></a>`;

                        }
                    },
                ],
                retrieve: true,
                serverSide: true,
                dom: "tr",
                pageLength: 15,
                lengthMenu: [
                    15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65, 70, 75, 80, 85, 90, 95,
                    100,
                ],
                "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    var index = iDisplayIndex + 1;
                    var api = this.api();
                    var pageInfo = api.page.info();
                    var page = pageInfo.page;
                    var length = pageInfo.length;

                    var number = (page * length) + index;

                    $('td:eq(0)', nRow).html(number);
                    return nRow;
                },
            });
        }

        function ServiceChargesList() {
            $(".servicecharge_list").DataTable({
                ajax: BASE_URL + "task/med/task_datatable/list_session_service",
                columns: [{
                        title: "no",
                        name: "no",
                        data: null,
                    },
                    {
                        title: "service name",
                        name: "service_name",
                        data: "servicesName",
                    },
                    {
                        title: "description",
                        name: "service_desc",
                        data: "servicesDesc",
                    },
                    {
                        title: "price",
                        name: "price",
                        data: "servicesPrice",
                    },
                    {
                        title: "quantity",
                        name: "quantity",
                        data: "servicesQTY",
                    },
                    {
                        title: "option",
                        name: "option",
                        data: null,
                        render: function (data, type, row) {
                            return `<a onClick="return delete_confirmation_service_repair(event, '${(data.idFService == null ? data.servicesName : data.idFService)}')" href="javascript:void(0);"  class="btn-deletefile btn btn btn-rounded btn-outline-danger mr-2 btn-sm" > <i class="ti-trash"></i></a>`;

                        }
                    },
                ],
                retrieve: true,
                serverSide: true,
                dom: "tr",
                pageLength: 15,
                lengthMenu: [
                    15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65, 70, 75, 80, 85, 90, 95,
                    100,
                ],
                "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    var index = iDisplayIndex + 1;
                    var api = this.api();
                    var pageInfo = api.page.info();
                    var page = pageInfo.page;
                    var length = pageInfo.length;

                    var number = (page * length) + index;

                    $('td:eq(0)', nRow).html(number);
                    return nRow;
                },
            });
        }

        $("[data-toggle=collapse]").on("click", function () {
            let target = $(this).attr("data-target");
            let that = $(this);
            $("" + target + "").on("show.bs.collapse", function () {
                that.removeClass("samrs-primary").addClass("samrs-danger");
                that.html('<i class="fas fa-times"></i> Cancel');
            });
            $("" + target + "").on("hide.bs.collapse", function () {
                that.removeClass("samrs-danger").addClass("samrs-primary");
                that.html('<i class="fas fa-plus"></i> Add new');
            });
        });
    },
};
</script>

<style scoped>
.zoom {
    /* padding: 50px; */
    /* background-color: green; */
    transition: transform .2s;
    /* Animation */
    /* width: 200px;
            height: 200px; */
    margin: 0 auto;
}

.zoom:hover {
    transform: scale(1.2);
    /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
}

img.is-fix {
    display: block;
    /* height: auto;
    width: 8rem; */
    width: 200px;
    height: 200px;
    margin: 0 auto;
}
</style>
