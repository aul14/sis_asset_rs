<template>
<div class="p-10">
    <div class="samrs-detail-box">
        <label class="detail-title">a. data customer and tools</label>
        <fieldset class="row">
            <div class="col-xl-6">
                <table class="samrs-tableview td-first-title">
                    <tbody>
                        <tr>
                            <td>task name</td>
                            <td>:</td>
                            <td id="app-task-approve-name"></td>
                        </tr>
                        <tr>
                            <td>asset code</td>
                            <td>:</td>
                            <td id="app-task-approve-code"></td>
                        </tr>
                        <tr>
                            <td>brand</td>
                            <td>:</td>
                            <td id="app-task-approve-brand"></td>
                            <input type="hidden" name="idprogress_approve">
                        </tr>
                        <tr>
                            <td>type</td>
                            <td>:</td>
                            <td id="app-task-approve-type"></td>
                        </tr>
                        <tr>
                            <td>serial number</td>
                            <td>:</td>
                            <td id="app-task-approve-sn"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-xl-6">
                <table class="samrs-tableview td-first-title">
                    <tbody>
                        <tr>
                            <td>task description</td>
                            <td>:</td>
                            <td id="app-task-approve-desc"></td>
                        </tr>
                        <tr>
                            <td>asset name</td>
                            <td>:</td>
                            <td id="app-task-approve-asset"></td>
                        </tr>
                        <tr>
                            <td>room name</td>
                            <td>:</td>
                            <td id="app-task-approve-room"></td>
                        </tr>
                        <tr>
                            <td>informant</td>
                            <td>:</td>
                            <td id="app-task-approve-informant"></td>
                        </tr>
                        <tr>
                            <td>complain date</td>
                            <td>:</td>
                            <td id="app-task-approve-cpldate"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </fieldset>
    </div>
    <div class="samrs-detail-box mt-20">
        <label class="detail-title">b. complain</label>
        <p id="text-approve-complain" style="text-align: justify;"></p>
        <fieldset class="border-top-1 border-light pt-1">
        </fieldset>
    </div>
    <div class="samrs-detail-box mt-20">
        <label class="detail-title">c. repair action</label>
        <!-- <fieldset class="border-top-1 border-light pt-1">
            <p>complain action</p>
        </fieldset> -->
        <div class="table-responsive">
            <table class="progressrecord_list_detail samrs-tableview capitalize w-100">
                <thead></thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
    <div class="samrs-detail-box mt-20 bg-gray">
        <label class="detail-title">c. complain images</label>
        <div class="samrs-flex wrapped is-row in-center insert-image-complain">
        </div>

    </div>
    <div class="samrs-detail-box mt-20 bg-gray">
        <label class="detail-title">d. repair images</label>
        <div class="samrs-flex wrapped is-row in-center insert-image-repair">
        </div>

    </div>
    <div class="samrs-detail-box mt-20">
        <label class="detail-title">f. sparepart usage</label>
        <fieldset class="row">
            <table class="sparepart_list samrs-tableview capitalize w-100">
                <thead>
                </thead>
                <tbody>
                </tbody>
            </table>
        </fieldset>
    </div>
    <div class="samrs-detail-box mt-20">
        <label class="detail-title">g. repair note</label>
        <p id="text-repair-approve-desc" style="text-align: justify;"></p>
        <fieldset class="border-top-1 border-light pt-1">
            <!-- <img src="" alt=""> -->
        </fieldset>
    </div>
    <div class="samrs-detail-box mt-20">
        <label class="detail-title">h. repair result</label>
        <p id="text-repair-approve-result" style="text-align: justify;"></p>
        <fieldset class="border-top-1 border-light pt-1">
            <!-- <img src="" alt=""> -->
        </fieldset>
    </div>
    <div class="signature-card">
        <div class="col-xl-3 offset-xl-2">
            <!-- <div class="signature-action text-center">
                <button class="btn samrs-primary" type="button" name="button" v-on:click="addSignature">Add Signature</button>
            </div> -->
            <div class="signature-box">
                <input type="hidden" name="idTaskSignatureApprove" id="idTaskSignatureApprove">
                <div class="signature-title">
                    Chairman :
                </div>
                <div class="signature-draw">
                    <img id="drawOtpChairmanApprove" src="" alt="" width="100" height="100" />
                </div>
                <div class="signature-name text-center">
                    <p class="name-chairman text-center"></p>
                    <!-- <button class="btn samrs-success" type="button" name="button" id="approve-repair">Approve</button> -->
                </div>
                <div class="text-center" id="addSignatureChairman">
                    <button class="btn btn-info waves-effect waves-light" type="button" data-id="technician" id="approve-chairman" data-toggle="modal">Add Signature</button>
                </div>
                <div class="text-center" id="addDrawChairman" style="display:none;">
                    <button class="btn btn-success waves-effect waves-light" type="button" id="approve-draw-chairman">Add Signature</button>
                </div>
            </div>
        </div>
        <div class="col-xl-3 offset-xl-2">
            <div class="signature-box mt-40">
                <div class="signature-title">
                    Technician :
                </div>
                <div class="signature-draw">
                    <img id="drawOtpTeknisiApprove" src="" alt="" width="100" height="100" />
                </div>
                <div class="signature-name">
                    <p class="name-teknisi text-center">
                        .......
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<style scoped>
img.is-fix {
    display: block;
    height: auto;
    width: 8rem;
    margin: 0 auto;
}

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
    transform: scale(2);
    /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
}
</style>

<script>
module.exports = {
    methods: {
        addSignature() {
            $('#add_signature').modal('show');
            SignatureDrawing('add_signature');
        },
        activeState(indexed) {
            if (indexed === 0) {
                return "active";
            } else {
                return "";
            }
        }
    },
    mounted() {
        $("#drawOtpChairmanApprove").attr('src', BASE_URL + "assets/images/white.png");
        // cek apakah metode approve menggunakan otp or ttd
        $.ajax({
            type: "POST",
            url: BASE_URL + "task/med/complain/information_setting",
            data: {},
            dataType: "json",
            success: function (res) {
                if (res.userVar == "signature|ttd") {
                    $("#addSignatureChairman").remove();
                    $("input[name=signHashSignature]").val(res.userVar);
                    $('#addDrawChairman').css({
                        'display': ''
                    });
                }
            }
        });

        let username = $("input[name=idAssignee]").val();

        $(".name-chairman").html(username);

        $("#approve-draw-chairman").click(function (e) {
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
                                url: BASE_URL + "task/med/repair/approveSignDraw",
                                data: {
                                    'idTask': idTask
                                },
                                dataType: "json",
                                success: function (res) {
                                    $(`#drawOtpChairmanApprove`).attr("src", BASE_URL + "assets/upload/file/" + res.signHash.substr(5));
                                    $(".name-chairman").html(res.username);
                                    $("#addDrawChairman").remove();
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


        $("#approve-chairman").click(function (e) {
            e.preventDefault();
            let idTask = $("input[name=idTaskSignature]").val();
            $("#btn-approve-chairman").css({
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

        $('#submitOTPChairman').click(function () {
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
                        approveSign(doc.signHash);
                        $("input[name=signHashSignature]").val(doc.signHash);
                        $.ajax({
                            type: "POST",
                            url: BASE_URL + "task/med/maintenance/schedule_report/generate_ttd",
                            data: {
                                'signHash': doc.signHash
                            },
                            dataType: "json",
                            success: function (res) {
                                // console.log(res);'
                                console.log(res.otp_name.signPerson);
                                $("#OTPModalChairman").modal('hide');

                                $(`#drawOtpChairmanApprove`).attr("src", res.otp);
                                $("#addSignatureChairman").remove();
                            }
                        });
                        // location.reload();
                    }
                }
            });
        });

        function approveSign(signHash) {
            let idTask = $("input[name=idTaskSignature]").val();
            $.ajax({
                url: BASE_URL + 'task/med/repair/approveSign',
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

        // // $(function () {
        SparepartListDetail();
        ProgressRecordDetail();
        // PendingStatusListDetail();

        // });

        function ProgressRecordDetail() {
            $(".progressrecord_list_detail").DataTable({
                ajax: BASE_URL + "task/med/task_datatable/list_session_null",
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
                    }
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

        function SparepartListDetail() {
            $(".sparepart_list").DataTable({
                ajax: BASE_URL + "task/med/task_datatable/list_session_null",
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
                    }
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

        // function PendingStatusList() {
        //     $('.pendingstatus_list').DataTable({
        //         columns: [{
        //                 title: 'pending date',
        //                 name: 'pending_date'
        //             },
        //             {
        //                 title: 'description',
        //                 name: 'description'
        //             },
        //         ],
        //         // retrieve: true,
        //         dom: 'tr',
        //         pageLength: 15,
        //         lengthMenu: [15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65, 70, 75, 80, 85, 90, 95, 100]
        //     });
        // }

        // PendingStatusList();
    }
}
</script>
