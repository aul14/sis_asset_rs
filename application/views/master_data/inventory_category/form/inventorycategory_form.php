<div id="inventorycategory_form" class="modal samrs-modal zoom fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="<?= base_url('master_data/inventory_category/store'); ?>" method="post" id="addform">
            <div class="modal-content">
                <div class="modal-header">
                    <p id="title-category">add new inventory category</p>
                    <button class="btn btn-rounded btn-outline-danger" type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body fixed-height samrs-form" id="app_form">
                    <form-inventorycategory>
                        <template v-slot:category-property>
                            <div class="col-xl-8">
                                <div class="samrs-detail-box mt-20 property" data-border="primary">
                                    <label class="detail-title">select one or multiple select</label>
                                    <div class="float-right samrs-flex wrapped is-row">
                                        <button class="btn samrs-primary is-outline is-small" type="button">
                                            <label class="form-check">
                                                <input class="form-check-input checkedAll" type="checkbox">
                                                <span>Check All</span>
                                            </label>
                                        </button>
                                        <button class="btn samrs-success is-outline is-small toggleCheck" type="button">
                                            <label>
                                                <i class="fas fa-toggle-off"></i>
                                                <span>Toggle Check</span>
                                            </label>
                                        </button>
                                    </div>
                                    <div class="samrs-grid grid-3">
                                        <?php foreach ($asset_prop as $key => $prop) : ?>
                                            <div class="grid-box border-1 border-light text-left">
                                                <div class="form-check-inline form-check pl-1">
                                                    <label class="form-check text-capitaliz">
                                                        <input type="checkbox" name="propZAssetCatprop_idAssetProp[]" id="idassetprop-<?= $prop['idAssetProp']; ?>" value="<?= $prop['idAssetProp']; ?>">
                                                        <?= $prop['propName']; ?>
                                                    </label>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </form-inventorycategory>
                </div>
                <div class="modal-footer">
                    <div class="mr-10 ml-10">
                        <button class="btn samrs-primary" type="submit" name="save" value="save">Save</button>
                        <button class="btn samrs-success" type="submit" name="save_close" value="save_close">Save & Exit</button>
                    </div>
                    <a class="btn samrs-danger is-outline" href="<?= base_url('master_data/inventory_category'); ?>">Cancel</a>
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
                $.ajax({
                    type: request_method,
                    url: post_url,
                    data: $(form).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        // console.log(response)
                        if (response.queryResult == true) {
                            if (!is_close) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success..',
                                    text: "Success, data saved successfully"
                                }).then(function() {
                                    $('.samrs-form input, .samrs-form textarea').val('');
                                    $('.samrs-table1').DataTable().ajax.reload();
                                    // window.location.reload();
                                });

                            } else {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success..',
                                    text: "Success, data saved successfully"
                                }).then(function() {
                                    $('.samrs-table1').DataTable().ajax.reload();
                                    document.location.href = "<?php echo base_url(); ?>master_data/inventory_category";
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
            }
        });
    });
</script>