<template>
<div class="p-10 border-1 border-dashed border-light mt-10">
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">action description</label>
        </div>
        <div class="col-xl-8">
            <textarea class="form-control" name="pdetDesc" id="pendingDesc" rows="3"></textarea>
        </div>
    </div>
    <div class="form-group">
        <button class="btn btn-sm samrs-primary btn-block" type="button" name="button" id="add-prop-record"><i class="fas fa-plus"></i> Add</button>
    </div>
</div>
</template>

<script>
module.exports = {
    mounted() {
        $(function () {
            $("#add-prop-record").click(function () {
                var ajax_idform = $("input[name=idForm]").val();
                // e.preventDefault();
                if (ajax_idform == '') {
                    var url_record = BASE_URL + "task/med/task_datatable/session_add_record";
                } else {
                    var url_record = BASE_URL + "task/med/task_datatable/session_add_record/" + ajax_idform;
                }
                var pdetDesc = $("#pendingDesc").val();
                $.ajax({
                    type: "POST",
                    url: url_record,
                    data: {
                        pdetDesc: pdetDesc
                    },
                    dataType: "json",
                    success: function (response) {
                        if (response) {
                            // if (ajax_idasset_edit === '') {
                            $('.progressrecord_list').DataTable().ajax.reload();
                            $("#pendingDesc").val("")
                            // } else {
                            //     $('.file_list').DataTable().ajax.url(BASE_URL + "asset_propfiles/asset_propfiles_by_id_asset/" + ajax_idasset_edit).load();
                            // }
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Oops...',
                                text: response.message,
                            });
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log(thrownError)
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: thrownError,
                        });
                    }
                });
            });
        });
    },
}
</script>
