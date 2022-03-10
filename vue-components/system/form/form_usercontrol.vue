<template>
<div class="p-10">
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">roles name <span>*</span></label>
        </div>
        <div class="col-xl-8">
            <input type="hidden" name="formType" id="formType" value="add">
            <input class="form-control" type="hidden" name="idRole">
            <input class="form-control" type="text" required name="roleName">
        </div>
    </div>
    <div class="form-group row">

        <slot name="select-tipe"></slot>

    </div>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">roles description <span>*</span></label>
        </div>
        <div class="col-xl-8">
            <textarea name="roleDescription" id="roleDescription" class="form-control" rows="5"></textarea>
        </div>
    </div>
</div>
</template>

<script>
module.exports = {
    mounted() {
        // $("#roles-tipe").change(function () {
        //     // e.preventDefault();
        //     let val_tipe = this.value;
        //     if (val_tipe == "ALL") {
        //         $('#identity_card_a_med').css({
        //             'display': ''
        //         });
        //         $('#identity_card_a_non').css({
        //             'display': ''
        //         });
        //         $('#identity_card_d_med').css({
        //             'display': ''
        //         });
        //         $('#identity_card_d_non').css({
        //             'display': ''
        //         });
        //         $('#identity_card_t_med').css({
        //             'display': ''
        //         });
        //         $('#identity_card_t_non').css({
        //             'display': ''
        //         });
        //     } else if (val_tipe == "MED") {
        //         $('#identity_card_a_med').css({
        //             'display': ''
        //         });
        //         $('#identity_card_t_med').css({
        //             'display': ''
        //         });
        //         $('#identity_card_d_med').css({
        //             'display': ''
        //         });
        //         $('#identity_card_a_non').css({
        //             'display': 'none'
        //         });
        //         $('#identity_card_t_non').css({
        //             'display': 'none'
        //         });
        //         $('#identity_card_d_non').css({
        //             'display': 'none'
        //         });
        //     } else if (val_tipe == "NON") {
        //         $('#identity_card_a_non').css({
        //             'display': ''
        //         });
        //         $('#identity_card_t_non').css({
        //             'display': ''
        //         });
        //         $('#identity_card_d_non').css({
        //             'display': ''
        //         });
        //         $('#identity_card_a_med').css({
        //             'display': 'none'
        //         });
        //         $('#identity_card_t_med').css({
        //             'display': 'none'
        //         });
        //         $('#identity_card_d_med').css({
        //             'display': 'none'
        //         });
        //     } else {
        //         $('#identity_card_a_med').css({
        //             'display': 'none'
        //         });
        //         $('#identity_card_a_non').css({
        //             'display': 'none'
        //         });
        //         $('#identity_card_d_med').css({
        //             'display': 'none'
        //         });
        //         $('#identity_card_d_non').css({
        //             'display': 'none'
        //         });
        //         $('#identity_card_t_med').css({
        //             'display': 'none'
        //         });
        //         $('#identity_card_t_non').css({
        //             'display': 'none'
        //         });
        //     }
        // });
    }
}
</script>
