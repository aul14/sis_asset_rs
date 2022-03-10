<div id="mutation_return" class="modal samrs-modal zoom fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="<?= base_url('task/med/mutation/store_return'); ?>" id="approveform" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <p>Return Mutation</p>
                    <a href="<?= base_url('task/med/mutation'); ?>" class="btn btn-rounded btn-outline-danger" class="close" aria-hidden="true">×</a>
                </div>
                <div class="modal-body fixed-height samrs-form" id="app_return">
                    <return-mutation></return-mutation>
                    <form-mutation-approval>
                        <template v-slot:approveby-mut>
                            <input type="text" readonly class="form-control" name="approveByReturn" id="approveByReturn">
                        </template>
                        <template v-slot:approvedate-mut>
                            <input type="text" readonly class="form-control" name="timeApprovedReturn" id="timeApprovedReturn">
                        </template>
                    </form-mutation-approval>
                    <form-mutation-return>
                        <template v-slot:finishdate-return-mut>
                            <input type="text" class="form-control" readonly name="timeAssign" value="<?= date('Y-m-d H:i:s'); ?>">
                        </template>
                        <template v-slot:finishby-return-mut>
                            <input type="text" class="form-control" readonly name="assignTo" value="<?= $this->session->userdata('username'); ?>">
                        </template>
                    </form-mutation-return>
                </div>
                <div class="modal-footer">
                    <div class="mr-10 ml-10">
                        <button class="btn samrs-primary" type="submit" name="save" value="save">Save</button>
                        <button class="btn samrs-success" type="submit" name="save_close" value="save_close">Save & Exit</button>
                    </div>
                    <a class="btn samrs-danger is-outline" href="<?= base_url('task/med/mutation'); ?>">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>