<template>
<div class="p-10">
    <div class="samrs-detail-box">
        <label class="detail-title">Mutation Approval</label>
        <div class="p-10">
            <div class="form-group row">
                <div class="col-xl-4">
                    <label class="form-title">request approval<span>*</span></label>
                </div>
                <div class="col-xl-8">
                    <div class="form-check form-check-inline">
                        <label>
                            <input class="form-check-input" type="radio" name="requestApproval" value="YES">
                            YES
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label>
                            <input class="form-check-input" type="radio" name="requestApproval" value="NO">
                            NO
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group row" id="row-approve-by">
                <div class="col-xl-4">
                    <label class="form-title">approved by<span>*</span></label>
                </div>
                <div class="col-xl-8">
                    <slot name="approveby-mut"></slot>
                </div>
            </div>
            <div class="form-group row" id="row-approve-date">
                <div class="col-xl-4">
                    <label class="form-title">approved date & time<span>*</span></label>
                </div>
                <div class="col-xl-8">
                    <slot name="approvedate-mut"></slot>
                </div>
            </div>
            <div class="form-group row" id="row-approve-note">
                <div class="col-xl-4">
                    <label class="form-title">notes<span>*</span></label>
                </div>
                <div class="col-xl-8">
                    <textarea class="form-control" name="approveNote" id="approveNote" rows="3" required></textarea>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
module.exports = {
    mounted() {
        $('input:radio[name="requestApproval"]').click(function () {
            if ($(this).is(':checked')) {
                if ($(this).val() == 'NO') {
                    // console.log('Permanent')
                    $('#row-approve-by').css({
                        'display': 'none'
                    });
                    $('#row-approve-date').css({
                        'display': 'none'
                    });
                } else {
                    // console.log('Temporary')
                    $('#row-approve-by').css({
                        'display': ''
                    });
                    $('#row-approve-date').css({
                        'display': ''
                    });
                }
            }
        });
    },
}
</script>
