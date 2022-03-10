<template>
  <div class="p-10">
    <div class="d-flex">
      <div class="mr-10 ml-10">
        <button class="btn btn-block samrs-primary" data-toggle="modal" data-target="#addOpname" type="button" name="button">
          <i class="fas fa-plus"></i> Add new
        </button>
      </div>
      <div class="mr-10 ml-10">
            <div class="mr-10 ml-10">
            <a href="javascript:void(0)" class="btn btn-block samrs-danger" id="reset_detail_opname"  name="button">
                <i class="fas fa-times"></i> Reset
            </a>
        </div>
      </div>
    </div>
    <div class="table-responsive">
      <table class="opname_detail table samrs-tableview capitalize samrs-table-striped table-hover w-100">
        <thead>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
module.exports = {
   mounted: function () {
        DetailOpname();
        $(document).on("click", "#reset_detail_opname", function (e) {
            e.preventDefault();
            // var task = $(this).data('task');
            var idTaskOpname = $("input[name=idTaskOpname]").val();
            var idTaskdetail = $("input[name=idTask]").val();
            // var asset = $(this).data('asset');
            if (idTaskdetail != '') {
              var url_delete_all = BASE_URL + "stock_opname_detail/DeleteByIdTaskOpname/" + idTaskOpname;
            } else {
              var url_delete_all = BASE_URL + "stock_opname_detail/delete_from_session";
            }

            $.confirm({
                title: "Confirmation",
                content: "Are You Sure You Will Delete All Data ?",
                theme: 'bootstrap',
                columnClass: 'medium',
                typeAnimated: true,
                buttons: {
                    hapus: {
                        text: 'Submit',
                        btnClass: 'btn-red',
                        action: function () {
                            $.ajax({
                                type: 'POST',
                                url: url_delete_all,
                                // data: {
                                //     'task': task,
                                //     'asset': asset
                                // },
                                dataType: 'json',
                                success: function (response) {
                                    // console.log(response.taskStockopnameDetails)
                                    if (response.taskStockopnameDetails || response.queryResult == true) {
                                        $('.opname_detail').DataTable().ajax.reload();
                                    } else {
                                        Swal.fire({
                                            icon: 'warning',
                                            title: 'Oops...',
                                            text: response.message,
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
                        }
                    },
                    close: function () {}
                }
            });

        });
    },
}
</script>

<style lang="css" scoped>
</style>
