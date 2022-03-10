<template>
<div class="p-10 border-1 border-dashed border-light mt-10">
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">service name</label>
        </div>
        <div class="col-xl-8">
            <input class="form-control" type="text" name="servicesName">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">service price</label>
        </div>
        <div class="col-xl-8">
            <input class="form-control" type="text" onkeypress="return hanyaAngka(event)" name="servicesPrice" min="0">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">quantity</label>
        </div>
        <div class="col-xl-8">
            <input class="form-control" type="text" onkeypress="return hanyaAngka(event)" name="servicesQty" min="0">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">service description</label>
        </div>
        <div class="col-xl-8">
            <textarea class="form-control" name="servicesDesc" rows="8" cols="80"></textarea>
        </div>
    </div>
    <div class="form-group">
        <button class="btn btn-sm samrs-primary btn-block" type="button" name="button" id="add-prop-service"><i class="fas fa-plus"></i> Add</button>
    </div>
</div>
</template>

<script>
module.exports = {
    mounted() {
        $(function () {
            $("#add-prop-service").click(function () {
                // e.preventDefault();
                var ajax_idform = $("input[name=idForm]").val();

                if (ajax_idform == '') {
                    var url_service = BASE_URL + "task/med/task_datatable/session_add_service";
                } else {
                    var url_service = BASE_URL + "task/med/task_datatable/session_add_service/" + ajax_idform;
                }

                var servicesName = $("input[name=servicesName]").val();
                var servicesDesc = $("textarea[name=servicesDesc]").val();
                var servicesQty = $("input[name=servicesQty]").val();
                var servicesPrice = $("input[name=servicesPrice]").val();
                $.ajax({
                    type: "POST",
                    url: url_service,
                    data: {
                        servicesName: servicesName,
                        servicesDesc: servicesDesc,
                        servicesQty: servicesQty,
                        servicesPrice: servicesPrice
                    },
                    dataType: "json",
                    success: function (response) {
                        if (response) {
                            // if (ajax_idasset_edit === '') {
                            $('.servicecharge_list').DataTable().ajax.reload();
                            $("input[name=servicesName]").val("")
                            $("textarea[name=servicesDesc]").val("")
                            $("input[name=servicesQty]").val("")
                            $("input[name=servicesPrice]").val("")
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
                    }
                });
            });
        });
    },
}
</script>
