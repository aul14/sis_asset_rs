<template>
<div class="p-1 border-top-1 border-light">
    <label class="form-title" samrs-typography="700">{{ listAlphabet }}. assets information</label>
    <input type="hidden" name="idTask">
    <input type="hidden" name="idAsset">
    <input type="hidden" name="idFpEqdata">
    
    <input type="hidden" name="idTmpItem">
    <input type="hidden" name="tmpitemEngineer">
    <input type="hidden" name="tmpitemAlkur">
    <input type="hidden" name="tmpitemTools">
    <input type="hidden" name="tmpitemEncon">
    <input type="hidden" name="tmpitemESM">
    <input type="hidden" name="tmpitemFisfung">
    <input type="hidden" name="tmpitemPerf">
    <input type="hidden" name="tmpitemAction">
    <input type="hidden" name="tmpitemUseVendor">
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-6">
            <div class="form-group row">
                <div class="col-xl-4">
                    <label class="form-title">assets code</label>
                </div>
                <div class="col-xl-8">
                    <input class="form-control" name="eqCodeFormEqdata" type="text" id="eqCode" readonly>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xl-4">
                    <label class="form-title">asset name</label>
                </div>
                <div class="col-xl-8">
                    <input class="form-control" name="eqNameFormEqdata" type="text" id="eqName" readonly>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xl-4">
                    <label class="form-title">brands</label>
                </div>
                <div class="col-xl-8">
                    <input class="form-control" name="eqMerkFormEqdata" type="text" id="eqMerk" readonly>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-6">
            <div class="form-group row">
                <div class="col-xl-4">
                    <label class="form-title">type</label>
                </div>
                <div class="col-xl-8">
                    <input class="form-control" name="eqTypeFormEqdata" type="text" id="eqType" readonly>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xl-4">
                    <label class="form-title">serial number</label>
                </div>
                <div class="col-xl-8">
                    <input class="form-control" name="eqSNFormEqdata" type="text" id="eqSN" readonly>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-xl-4">
                    <label class="form-title">location room</label>
                </div>
                <div class="col-xl-8">
                    <input class="form-control" name="eqLocationFormEqdata" type="text" id="eqLocation" readonly>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
module.exports = {
    props: {
        listAlphabet: {
            type: String,
            default: 'List_Unavailable',
        }
    },
    mounted() {
        // $('#executor').change(function () {
        //     var executor = $(this).val()

        //     if (executor == 'maintenance') {
        //         $('select[name=idVendor]').attr("disabled", true);
        //         $('select[name=idVendor]').attr("required", false);

        //         // $('#idVendor').val(0);

        //         // $('#startBy').val("");
        //     } else if (executor == 'vendor') {

        //         $('select[name=idVendor]').attr("disabled", false);

        //         $('select[name=idVendor]').attr("required", true);

        //         // $('#idStartBy').val(0);

        //         // $('#vendorName').val("");
        //     }
        // })

     
    //     var delegateBy;
    //     $('#idDelegator').focus(function () {
    //         // console.log('focus')
    //         $('.idDelegator').select2({
    //             width: '100%',
    //             ajax: {
    //                 url: BASE_URL + "system_menu/user_admin/user_query",
    //                 dataType: 'json',
    //                 type: 'GET',
    //                 delay: 250,
    //                 processResults: function (data) {
    //                     delegateBy = data;
    //                     return {
    //                         results: $.map(data['data'], function (item) {
    //                             return {
    //                                 text: item.userFullName,
    //                                 id: item.idUser
    //                             }
    //                         })
    //                     };
    //                 },
    //             }
    //         });
    //     });

    //     // $('#customerOrUser').text('Please Select Customer/User')
    //     $('#idDelegator').change(function () {
    //         if (delegateBy) {
    //             delegateBy.data.map(function (item) {
    //                 // console.log(item)
    //                 if (item.idUser == $('#idDelegator').val()) {
    //                     $('#delegateBy').val(item.userName)

    //                 }
    //             })
    //         }
    //     });
    },
}
</script>
