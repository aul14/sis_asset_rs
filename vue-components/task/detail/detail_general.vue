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
                            <td id="app-task-name"></td>
                        </tr>
                        <tr>
                            <td>asset code</td>
                            <td>:</td>
                            <td id="app-task-code"></td>
                        </tr>
                        <tr>
                            <td>brand</td>
                            <td>:</td>
                            <td id="app-task-brand"></td>
                        </tr>
                        <tr>
                            <td>type</td>
                            <td>:</td>
                            <td id="app-task-type"></td>
                        </tr>
                        <tr>
                            <td>serial number</td>
                            <td>:</td>
                            <td id="app-task-sn"></td>
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
                            <td id="app-task-desc"></td>
                        </tr>
                        <tr>
                            <td>asset name</td>
                            <td>:</td>
                            <td id="app-task-asset"></td>
                        </tr>
                        <tr>
                            <td>room name</td>
                            <td>:</td>
                            <td id="app-task-room"></td>
                        </tr>
                        <tr>
                            <td>informant</td>
                            <td>:</td>
                            <td id="app-task-informant"></td>
                        </tr>
                        <tr>
                            <td>complain date</td>
                            <td>:</td>
                            <td id="app-task-cpldate"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </fieldset>
    </div>
    <div class="samrs-detail-box mt-20">
        <label class="detail-title">b. complain</label>
        <p id="text-complain" style="text-align: justify;"></p>
        <fieldset class="border-top-1 border-light pt-1">
        </fieldset>
    </div>
    <div class="samrs-detail-box mt-20">
        <label class="detail-title">c. repair action</label>
        <!-- <fieldset class="border-top-1 border-light pt-1">
            <p>complain action</p>
        </fieldset> -->
        <div class="table-responsive">
            <table class="progressrecord_list_detail2 samrs-tableview capitalize w-100">
                <thead></thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
    <div class="samrs-detail-box mt-20 bg-gray">
        <label class="detail-title">c. complain images</label>
        <div class="samrs-flex wrapped is-row in-center insert-image-complain-detail">
        </div>

    </div>
    <div class="samrs-detail-box mt-20 bg-gray">
        <label class="detail-title">d. repair images</label>
        <div class="samrs-flex wrapped is-row in-center insert-image-repair-detail">
        </div>

        <!-- <fieldset class="border-top-1 border-light pt-1">
            <img src="" alt="">
        </fieldset> -->
    </div>
    <div class="samrs-detail-box mt-20">
        <label class="detail-title">f. sparepart usage</label>
        <fieldset class="row">
            <table class="sparepart_list_detail samrs-tableview capitalize w-100">
                <thead>
                </thead>
                <tbody>
                </tbody>
            </table>
        </fieldset>
    </div>
    <div class="samrs-detail-box mt-20">
        <label class="detail-title">g. repair description</label>
        <p id="text-repair-desc" style="text-align: justify;"></p>
        <fieldset class="border-top-1 border-light pt-1">
            <!-- <img src="" alt=""> -->
        </fieldset>
    </div>
    <div class="samrs-detail-box mt-20">
        <label class="detail-title">h. repair result</label>
        <p id="text-repair-result" style="text-align: justify;"></p>
        <fieldset class="border-top-1 border-light pt-1">
            <!-- <img src="" alt=""> -->
        </fieldset>
    </div>
    <div class="signature-card">
        <div class="col-xl-3 offset-xl-2">
            <div class="signature-box">
                <div class="signature-title">
                    Chairman :
                </div>
                <div class="signature-draw">
                    <img id="drawOtpChairmanDetail" src="" alt="" width="100" height="100" />
                </div>
                <div class="signature-name">
                    <p class="name-chairman text-center"></p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 offset-xl-2">
            <div class="signature-box">
                <div class="signature-title">
                    Technician :
                </div>
                <div class="signature-draw">
                    <img id="drawOtpTeknisiDetail" src="" alt="" width="100" height="100" />

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
        $("#drawOtpChairmanDetail").attr('src', BASE_URL + "assets/images/white.png");
        $("#drawOtpTeknisiDetail").attr('src', BASE_URL + "assets/images/white.png");

        $("#approve-repair").click(function () {
            // e.preventDefault();
            // console.log("exit");
            var id_progress = $("input[name=idprogress_approve]").val();
            $.confirm({
                title: "Confirmation",
                content: "Are You Sure, You Want To Approve This Data ?",
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
                                url: BASE_URL + "progress/update",
                                data: {
                                    'idProgress': id_progress
                                },
                                dataType: "json",
                                success: function (response) {
                                    if (response.data == true) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Success...',
                                            text: 'Data has been approved successfully',
                                        });
                                        $(".name-chairman").html(response.data_detail.approveBy);
                                        // $('#brand_modal').modal('hide');
                                        // $('input[name=brandName]').val("");
                                    }
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

        // $(function () {
        SparepartListDetail2();
        ProgressRecordDetail2();
        // PendingStatusListDetail();

        // });

        // function PendingStatusListDetail() {
        //   $(".pendingstatus_list").DataTable({
        //         ajax: BASE_URL + "task/med/task_datatable/list_session_record",
        //         columns: [{
        //                 title: "no",
        //                 name: "no",
        //                 data: null,
        //             },
        //             {
        //                 title: "date/time",
        //                 name: "date_time",
        //                 data: "genTime",
        //             },
        //             {
        //                 title: "description",
        //                 name: "description",
        //                 data: "genAction",
        //             },
        //             {
        //                 title: "noted by",
        //                 name: "noted_by",
        //                 data: "genByName",
        //             }
        //         ],
        //         retrieve: true,
        //         serverSide: true,
        //         dom: "tr",
        //         pageLength: 15,
        //         lengthMenu: [
        //             15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65, 70, 75, 80, 85, 90, 95,
        //             100,
        //         ],
        //         "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
        //             var index = iDisplayIndex + 1;
        //             var api = this.api();
        //             var pageInfo = api.page.info();
        //             var page = pageInfo.page;
        //             var length = pageInfo.length;

        //             var number = (page * length) + index;

        //             $('td:eq(0)', nRow).html(number);
        //             return nRow;
        //         },
        //     });
        // }

        function ProgressRecordDetail2() {
            $(".progressrecord_list_detail2").DataTable({
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

        function SparepartListDetail2() {
            $(".sparepart_list_detail").DataTable({
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

    }
}
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
