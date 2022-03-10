<template>
<div dir="ltr" class="col-xl-12">
    <div class="card samrs-card card-content">
        <div class="card-header">
            <p class="text-bold mr-10 ml-10"><i class="ti-settings mr-1 ml-1"></i> User Settings</p>
        </div>
        <div class="card-body">
            <div class="row samrs-pills to-stretched">
                <div class="col-xl-3 pl-0">
                    <div class="nav nav-pills samrs-flex wrapped is-column" role="tablist" aria-orientation="vertical" data-color="primary">
                        <a class="nav-link active" data-toggle="pill" href="#profile">profile</a>
                        <a class="nav-link" data-toggle="pill" href="#password">password</a>
                        <a class="nav-link" data-toggle="pill" href="#signature">signature preference</a>
                        <a class="nav-link" data-toggle="pill" href="#interface">interface preference</a>
                    </div>
                </div>
                <div class="col-xl-9">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="profile" role="tabpanel">
                            <!-- <form-profile></form-profile> -->
                            <slot name="form-profile"></slot>
                        </div>
                        <div class="tab-pane fade" id="password" role="tabpanel">
                            <!-- <form-password></form-password> -->
                            <slot name="form-pasword"></slot>
                        </div>
                        <div class="tab-pane fade" id="signature" role="tabpanel">
                            <form id="changeSignature">
                                <form-signature>
                                </form-signature>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="interface" role="tabpanel">
                            <form-interface></form-interface>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
module.exports = {
    data() {
        return {
            user_information: [],
        }
    },
    components: {
        'form-profile': httpVueLoader(BASE_URL + 'vue-components/users/form/form_profile.vue'),
        'form-password': httpVueLoader(BASE_URL + 'vue-components/users/form/form_password.vue'),
        'form-signature': httpVueLoader(BASE_URL + 'vue-components/users/form/form_signature.vue'),
        'form-interface': httpVueLoader(BASE_URL + 'vue-components/users/form/form_interface.vue'),
    },
    created() {
        axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        axios.post(BASE_URL + 'settings/information').then(response => {
            this.user_information = response.data
        });
    },
    updated() {
        function changefixedHeight() {
            let newHeight = $('.page-content').height() - 200;
            let contentHeight = $('.page-content').height() - 250;
            $('.fixed-box').css('height', newHeight + 'px');
            return $('.fixed-box').css('max-height', contentHeight + 'px');
        }
        changefixedHeight();
        $(window).resize(function () {
            changefixedHeight();
        });
    },
    mounted() {
        var is_close = false;
        $("button[type='submit']").click(function () {
            var _name = $(this).val();
            is_close = (_name == "save") ? false : true;
        });

        $("#changepwd").validate({
            ignore: "input[type=hidden]",
            errorClass: "text-danger",
            successClass: "text-success",
            highlight: function (element, errorClass) {
                var elem = $(element);
                if (elem.hasClass('select2-offscreen')) {
                    $('#s2id_' + elem.attr('id') + ' ul').removeClass(errorClass);
                    $('#s2id_' + elem.attr('id') + ' ul').addClass('is-invalid');
                } else {
                    elem.removeClass(errorClass);
                    elem.addClass('is-invalid');
                }

                $(element).removeClass(errorClass)
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass) {
                var elem = $(element);
                if (elem.hasClass('select2-offscreen')) {
                    $('#s2id_' + elem.attr('id') + ' ul').removeClass(errorClass);
                    $('#s2id_' + elem.attr('id') + ' ul').removeClass('is-invalid');
                } else {
                    elem.removeClass(errorClass);
                    elem.removeClass('is-invalid');
                }

                $(element).removeClass(errorClass)
                $(element).removeClass('is-invalid');
            },
            errorPlacement: function (error, element) {
                error.insertAfter(element)
                error.addClass('invalid-feedback');
                element.closest('.col-8').append(error);
            },
            submitHandler: function (form) {
                console.log(request_method);

                var post_url = $(form).attr("action");
                var request_method = $(form).attr("method");
                $.ajax({
                    type: request_method,
                    url: post_url,
                    data: $(form).serialize(),
                    dataType: 'json',
                    success: function (response) {
                        // console.log(response)
                        if (response.queryResult == true) {

                            Swal.fire({
                                icon: 'success',
                                title: 'Success..',
                                text: "Success, change password successfully"
                            });

                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Oops...',
                                text: response.queryMessage,
                            });
                            $('input[name=passOld]').val("");
                            $('input[name=passNew]').val("");
                            $('input[name=passNewConfirm]').val("");
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
        });

        $('#changeprofile').submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: BASE_URL + 'settings/change_profile',
                type: "post",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                success: function (data) {
                    // if (data.queryResult == true) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success..',
                        text: "Success, updated profile successfully"
                    });
                    document.location.href = BASE_URL + "settings";
                    // } else {
                    //     Swal.fire({
                    //         icon: 'warning',
                    //         title: 'Oops...',
                    //         text: data.queryResult,
                    //     });
                    //     document.location.href = BASE_URL + "settings";

                    // }
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
    },
}
</script>
