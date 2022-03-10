<template>
<div class="p-10">
    <div class="form-group">
        <label class="form-title">name<span>*</span></label>
        <div class="input-group">
            <input type="hidden" id="idContact" name="idContact">
            <input type="hidden" id="formType" name="formType" value="add">
            <input class="form-control" type="text" autocomplete="off" name="contactPerson" required>
        </div>
    </div>
    <div class="form-group">
        <label class="form-title">company / vendor</label>
        <div class="input-group">
            <input class="form-control" type="text" autocomplete="off" name="contactCompany">
        </div>
    </div>
    <div class="form-group">
        <label class="form-title">type <span>*</span></label>
        <div class="input-group">
            <table class="table samrs-tableview">
                <tr>
                    <td>
                        <div class="form-check-inline form-check">
                            <label class="form-check-label text-sm">
                                <input class="form-check-input" type="radio" name="contactType" id="contactType1" value="PERSON" required>
                                PEOPLE
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check-inline form-check">
                            <label class="form-check-label text-sm">
                                <input class="form-check-input" type="radio" name="contactType" id="contactType2" value="CALIBRATION_INSTITUTION" required>
                                CALIBRATION INSTITUTION
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check-inline form-check">
                            <label class="form-check-label text-sm">
                                <input class="form-check-input" type="radio" name="contactType" id="contactType3" value="SUPPLIER" required>
                                SUPPLIER
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check-inline form-check">
                            <label class="form-check-label text-sm">
                                <input class="form-check-input" type="radio" name="contactType" id="contactType4" value="CUSTOMER" required>
                                CUSTOMER
                            </label>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="form-group">
        <label class="form-title">email</label>
        <div class="input-group">
            <input class="form-control" type="email" autocomplete="off" name="contactEmail">
        </div>
    </div>
    <div class="form-group">
        <label class="form-title">phone<span>*</span></label>
        <div class="input-group">
            <input class="form-control" type="text" autocomplete="off" onkeypress="return hanyaAngka(event)"  name="contactPhone" required>
        </div>
    </div>
    <div class="form-group">
        <label class="form-title">mobile</label>
        <div class="input-group">
            <input class="form-control" type="text" onkeypress="return hanyaAngka(event)"  name="contactMobile">
        </div>
    </div>
    <div class="form-group">
        <label class="form-title">websites</label>
        <div class="input-group">
            <input class="form-control" type="url" name="contactAddress2">
        </div>
    </div>
    <div class="form-group">
        <label class="form-title">address</label>
        <div class="input-group">
            <textarea class="form-control" name="contactAddress1" rows="8" cols="80"></textarea>
        </div>
    </div>
</div>
</template>

<script>
module.exports = {
    mounted() {
        $('#addcontact').submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: BASE_URL + 'contact/store',
                type: "post",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                success: function (res) {
                  console.log(res);
                    // if (res.queryResult == true) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success..',
                            text: "Success, saved contact successfully"
                        });
                        document.location.href = BASE_URL + "contact";
                    // } else {
                    //     Swal.fire({
                    //         icon: 'warning',
                    //         title: 'Oops...',
                    //         text: res.queryResult,
                    //     });
                    //     // document.location.href = BASE_URL + "contact";
                    // }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: thrownError,
                    });
                }
            });
        });
    },
}
</script>
