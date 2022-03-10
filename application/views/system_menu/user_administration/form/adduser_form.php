<div id="adduser_form" class="modal samrs-modal zoom fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="<?= base_url('system_menu/user_admin/store'); ?>" id="addform" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <p id="title-user">add new user</p>
                    <a href="<?= base_url('system_menu/user_admin'); ?>" class="btn btn-rounded btn-outline-danger" class="close" aria-hidden="true">×</a>
                </div>
                <div class="modal-body fixed-height samrs-form" id="app_form">
                    <form-adduser></form-adduser>
                </div>
                <div class="modal-footer">
                    <div class="mr-10 ml-10">
                        <button class="btn samrs-primary" type="submit" name="save" value="save">Save</button>
                        <button class="btn samrs-success" type="submit" name="save_close" value="save_close">Save & Exit</button>
                    </div>
                    <a class="btn samrs-danger is-outline" href="<?= base_url('system_menu/user_admin'); ?>">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(function() {
        var is_close = false;
        $("button[type='submit']").click(function() {
            var _name = $(this).val();
            is_close = (_name == "save") ? false : true;
        });
        $("#addform").validate({
            ignore: "input[type=hidden]",
            errorClass: "text-danger",
            successClass: "text-success",
            highlight: function(element, errorClass) {
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
            unhighlight: function(element, errorClass) {
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
            errorPlacement: function(error, element) {
                error.insertAfter(element)
                error.addClass('invalid-feedback');
                element.closest('.col-8').append(error);
            },
            submitHandler: function(form) {
                // console.log(request_method);

                var post_url = $(form).attr("action");
                var request_method = $(form).attr("method");

                var form_type = $("input[name=formType]").val();
                $.ajax({
                    type: request_method,
                    url: post_url,
                    data: $(form).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        // console.log(response)
                        if (response.registerResult == true || response.queryResult == true) {
                            if (!is_close) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success..',
                                    text: form_type == "add" ? "Success, data saved successfully. Please, check your email to verify your account" : "Success, data saved successfully."
                                }).then(function() {
                                    $('.samrs-table1').DataTable().ajax.reload();
                                    // window.location.reload();
                                });

                            } else {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success..',
                                    text: form_type == "add" ? "Success, data saved successfully. Please, check your email to verify your account" : "Success, data saved successfully."
                                }).then(function() {
                                    $('.samrs-table1').DataTable().ajax.reload();
                                    document.location.href = "<?= base_url(); ?>system_menu/user_admin";
                                });

                            }
                        } else {
                            if (response.queryResult == false) {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Oops...',
                                    text: response.queryMessage,
                                });
                            } else {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Oops...',
                                    text: response.registerMessage,
                                });


                            }

                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: thrownError,
                        });
                    }
                });
            }
        });
    });
</script>