<div id="companyinfo_form" class="modal samrs-modal zoom fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form id="addform">
            <div class="modal-content">
                <div class="modal-header">
                    <p>Edit company information</p>
                    <button class="btn btn-rounded btn-outline-danger" type="button" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body fixed-height samrs-form" id="app_form">
                    <form-companyinfo></form-companyinfo>
                </div>
                <div class="modal-footer">
                    <div class="mr-10 ml-10">
                        <button class="btn samrs-primary" type="submit" name="save" value="save">Save</button>
                        <button class="btn samrs-success" type="submit" name="save_close" value="save_close">Save & Exit</button>
                    </div>
                    <a class="btn samrs-danger is-outline" href="<?= base_url('master_data/company_information'); ?>">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(function() {
        $('button[data-dismiss="modal"]').click(function() {
            location.reload();
        });
        var is_close = false;
        $("button[type='submit']").click(function() {
            var _name = $(this).val();
            is_close = (_name == "save") ? false : true;
        });
        $('#addform').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: BASE_URL + 'master_data/company_information/store',
                type: "POST",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                dataType: 'json',
                success: function(response) {
                    if (response.queryResult == true) {
                        if (!is_close) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success..',
                                text: "Success, data saved successfully"
                            }).then(function() {
                                $('.samrs-form input, .samrs-form textarea').val('');
                                // $('.samrs-table1').DataTable().ajax.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success..',
                                text: "Success, data saved successfully"
                            }).then(function() {
                                location.reload();
                            });

                        }
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Oops...',
                            text: response.queryMessage,
                        });

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
        });
    });
</script>