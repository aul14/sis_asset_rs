<div id="mutation_confirm" class="modal samrs-modal zoom fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="<?= base_url('task/med/mutation/store_confirm'); ?>" method="post" id="confirmform">
            <div class="modal-content">
                <div class="modal-header">
                    <p>Confirm Mutation</p>
                    <button class="btn btn-rounded btn-outline-danger" type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body fixed-height samrs-form" id="app_confirm">
                    <approve-mutation></approve-mutation>
                    <form-mutation-approval>
                        <template v-slot:approveby-mut>
                            <input type="text" readonly class="form-control" name="approveByConfirm" id="approveByConfirm">
                        </template>
                        <template v-slot:approvedate-mut>
                            <input type="text" readonly class="form-control" name="timeApprovedConfirm" id="timeApprovedConfirm">
                        </template>
                    </form-mutation-approval>
                    <form-mutation-return>
                        <template v-slot:finishdate-return-mut>
                            <input type="text" class="form-control" readonly name="timeAssignConfirm">
                        </template>
                        <template v-slot:finishby-return-mut>
                            <input type="text" class="form-control" readonly name="assignToConfirm">
                        </template>
                    </form-mutation-return>
                    <form-mutation-confirm>
                        <template v-slot:finishdate-confirm-mut>
                            <input type="text" class="form-control" readonly name="timeFinishConfirm" value="<?= date('Y-m-d H:i:s'); ?>">
                        </template>
                        <template v-slot:finishby-confirm-mut>
                            <input type="text" class="form-control" readonly name="finishByConfirm" value="<?= $this->session->userdata('username'); ?>">
                        </template>
                    </form-mutation-confirm>
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