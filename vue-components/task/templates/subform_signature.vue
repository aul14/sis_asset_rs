<template>
<div class="p-1 border-top-1 border-light">
    <div class="signature-card">
        <div class="col-xl-3 col-lg-3 offset-xl-2 col-6">
            <div class="signature-box">
                <div class="signature-action">
                    <!-- <button class="btn samrs-info" type="button" name="button">Add signature</button> -->
                </div>
                <div class="signature-title">
                    Chairman :
                </div>
                <div class="signature-draw">
                    <!-- <slot name="draw-or-otp-chairman"></slot> -->
                    <img src="" id="drawOtpChairman" alt='Image Ttd' width='100'>
                </div>
                <div class="signature-name text-center">
                    <p class="signature-chairman">..........</p>
                    <input type="hidden" name="idAssigneeChairman">
                </div>
                <div class="text-center" id="addSignatureChairman">
                    <button class="btn btn-info waves-effect waves-light" type="button" data-id="chairman" id="approve-chairman" data-toggle="modal">Add Signature</button>
                </div>
                <div class="text-center" id="addDrawChairman" style="display:none;">
                    <button class="btn btn-success waves-effect waves-light" type="button" id="approve-draw-chairman">Add Signature</button>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 offset-xl-2 col-6">
            <div class="signature-box">
                <div class="signature-action">
                    <!-- <button class="btn samrs-info" type="button" name="button">Add signature</button> -->
                </div>
                <div class="signature-title">
                    Implementer :
                </div>
                <div class="signature-draw">
                    <!-- draws -->
                    <img src="" id="drawOtpTeknisi" alt='Image Ttd' width='100'>
                </div>
                <div class="signature-name text-center">
                    <p class="signature-teknisi">..........</p>
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
</template>

<script>
module.exports = {
    mounted() {

        $("#drawOtpChairman").attr('src', BASE_URL + "assets/images/white.png");
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
                    $('#addDrawTeknisi').css({
                        'display': ''
                    });

                    $("#addSignatureChairman").remove();
                    $('#addDrawChairman').css({
                        'display': ''
                    });
                }
            }
        });

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
                                    $(`#drawOtpChairman`).attr("src", BASE_URL + "assets/upload/file/" + res.signHash.substr(5));
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
                                $(".signature-chairman").html(res.otp_name);
                                $(`#drawOtpChairman`).attr("src", res.otp);
                                $("#addSignatureChairman").remove();
                            }
                        });
                        // location.reload();
                    }
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
                url: BASE_URL + 'task/med/maintenance/schedule_report/finishSign',
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

        function approveSign(signHash) {
            let idTask = $("input[name=idTaskSignature]").val();
            $.ajax({
                url: BASE_URL + 'task/med/maintenance/schedule_report/approveSign',
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
    },
}
</script>
