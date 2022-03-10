<template>
<div class="pt-10">
    <div class="fixed-box samrs-form">
        <div class="form-group">
            <label class="form-title">Select signature options</label>
            <div class="m-10">
                <div class="form-check-inline form-check">
                    <label class="form-check-label text-capitalize">
                        <input class="signatureType" type="radio" name="signature" id="signature_otp" value="otp" checked>
                        one time password (OTP)
                        <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="These option you need request the code on every signature approval" data-original-title="These option you need request the code on every signature approval">
                            <i class="fas fa-question-circle"></i>
                        </a>
                    </label>
                </div>
                <div class="form-check-inline form-check">
                    <label class="form-check-label text-capitalize">
                        <input class="signatureType" type="radio" name="signature" id="signature_draw" value="draw">
                        draw / picture signature
                        <a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="These option you required to draw or upload your signature picture" data-original-title="These option you required to draw or upload your signature picture">
                            <i class="fas fa-question-circle"></i>
                        </a>
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group collapse p-10" id="otp_sign">
            <div class="samrs-detail-box blue mt-10">
                <div class="account-info">
                    <p class="name">{{ this.$parent.$data.user_information.username }}</p>
                    <p class="email">{{ this.$parent.$data.user_information.email }}</p>
                    <p class="info">Note : Make sure your email was active, check to spam if the email was not available in the inbox</p>
                </div>
            </div>
        </div>
        <div class="form-group collapse p-10" id="draw_sign">
            <div class="samrs-detail-box mt-10" samrs-border="1px primary">
                <label class="detail-title">Available signature</label>
                <!-- <input type="text" name="username_sign" id="username_sign" value="{{ this.$parent.$data.user_information.username }}">
                <input type="text" name="id_user_sign" id="id_user_sign" value="{{ this.$parent.$data.user_information.id_user }}"> -->
                <div class="col-xl-12 file-signature-box">
                    <img src="" alt="" id="drawSignature" style="width: 100px;" class="img img-responsive">
                    <div class="float-right">
                        <button class="btn samrs-danger is-outline is-small" type="button" id="removeSignatureLive" name="button"><i class="fas fa-times"></i> Remove signature</button>
                    </div>
                </div>
            </div>
            <div class="samrs-flex wrapped is-row">
                <div class="flex-box">
                    <button class="btn samrs-primary" data-toggle="modal" data-target="#add_signature" type="button" name="button">Draw new</button>
                </div>
                <div class="flex-box">
                    <input type="hidden" id="ImageDrawing" name="ImageDrawingBase64">
                    <div class="custom-file samrs-success">
                        <!-- <input class="custom-file-input" type="file" name="ImageTtd" id="ImageTtd">
                        <label class="custom-file-label label-shorts" data-color-type="clear">upload picture</label> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <button class="btn samrs-primary" type="submit" name="button">Save</button>
    </div>
</div>
</template>

<script>
module.exports = {
    mounted() {
        $("#drawSignature").attr('src', BASE_URL + "assets/images/white.png");

        $.ajax({
            type: "POST",
            url: BASE_URL + "settings/information_setting",
            data: {},
            dataType: "json",
            success: function (res) {
                // console.log(res);
                $("#drawSignature").attr('src', "data:image/png;base64," + res.set_file);

                if (res.userVar == "signature|ttd") {
                    $("#signature_draw").attr("checked", true);
                    $('#draw_sign').collapse('show');
                    $('#otp_sign').collapse('hide');
                }

            }
        });

        InputFiles();
        Tooltip();
        SignatureDrawing('add_signature');
        $('.signatureType').each(function () {
            $(this).on('click', function () {
                if ($(this).val() === 'otp') {
                    $('#otp_sign').collapse('show');
                    $('#draw_sign').collapse('hide');
                } else if ($(this).val() === 'draw') {
                    $('#otp_sign').collapse('hide');
                    $('#draw_sign').collapse('show');
                }
            });
            if ($(this).prop('checked') === true) {
                var that = $(this)
                if ($(that).val() === 'otp') {
                    $('#otp_sign').collapse('show');
                } else if ($(that).val() === 'draw') {
                    $('#draw_sign').collapse('show');
                }
            }
        });

        $("#removeSignatureLive").click(function () {
            // e.preventDefault();
            $('#ImageDrawing').val("");
            $("#drawSignature").attr('src', BASE_URL + "assets/images/white.png");
        });

        $('#changeSignature').submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: BASE_URL + 'settings/upload_signature',
                type: "post",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                dataType: 'json',
                success: function (response) {
                    // console.log(data);
                    if (response.queryResult == true) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success..',
                            text: "Success, updated profile successfully"
                        });
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Oops...',
                            text: response.queryMessage,
                        });
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
        });
    }
}
</script>
