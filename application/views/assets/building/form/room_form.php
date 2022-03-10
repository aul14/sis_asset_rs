<div id="room_form" class="modal samrs-modal zoom fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form id="room-form">
            <div class="modal-content">
                <div class="modal-header">
                    <p id="title-room-bld">add new building room</p>
                    <a href="<?= base_url('asset/building/room_bld'); ?>" class="btn btn-rounded btn-outline-danger" type="button" class="close" aria-hidden="true">×</a>
                </div>
                <div class="modal-body fixed-height samrs-form" id="app_form">
                    <room-form>
                        <template v-slot:select-unit1>
                            <select class="form-control selectpicker_not with-ajax" name="spaceUnit" data-live-search="true" id="unit">
                                <option value="">Tap to search</option>
                                <?php foreach ($unit as $data) : ?>
                                    <option value="<?= $data['idSatuan']; ?>"><?= $data['satuan']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </template>
                        <template v-slot:select-unit2>
                            <select class="form-control selectpicker_not with-ajax" name="powerUnit" data-live-search="true" id="unit2">
                                <option value="">Tap to search</option>
                                <?php foreach ($unit as $data) : ?>
                                    <option value="<?= $data['idSatuan']; ?>"><?= $data['satuan']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </template>
                    </room-form>
                </div>
                <div class="modal-footer">
                    <div class="mr-10 ml-10">
                        <button class="btn samrs-primary" type="submit" name="save" value="save">Save</button>
                        <button class="btn samrs-success" type="submit" name="save_close" value="save_close">Save & Exit</button>
                    </div>
                    <a class="btn samrs-danger is-outline" href="<?= base_url('asset/building/room_bld'); ?>">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
<div id="select_print_qr" class="modal samrs-modal bounce fade w-100">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <form>
            <div class="modal-content">
                <div class="modal-header">
                    <p>choose print qr</p>
                    <button class="btn btn-rounded btn-outline-danger" type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body samrs-form">
                    <div class="col-xl-12 text-center">
                        <button class="btn samrs-primary print_qrku" type="submit" name="cetak_besar" value="cetak_besar">Print 70x24MM</button>
                        <button class="btn samrs-success print_qrku" type="submit" name="cetak_kecil" value="cetak_kecil">Print 24x24MM</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- <div class="mr-10 ml-10">
          <button class="btn samrs-primary btn-ajax-lokasi" type="button" name="button">Save & Exit</button>
        </div> -->
                    <a class="btn samrs-danger is-outline" href="#" data-dismiss="modal">Cancel</a>
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

        // proses save
        $('#room-form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: BASE_URL + 'asset/building/room_bld/store',
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
                                $('.samrs-table1').DataTable().ajax.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success..',
                                text: "Success, data saved successfully"
                            }).then(function() {
                                $('.samrs-table1').DataTable().ajax.reload();
                                document.location.href = "<?php echo base_url(); ?>asset/building/room_bld";
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