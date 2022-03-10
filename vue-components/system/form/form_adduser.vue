<template>
<div class="p-10">
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">fullname <span>*</span></label>
        </div>
        <div class="col-xl-8">
            <input class="form-control" id="userFullName" name="userFullName" autocomplete="off" required="" type="text">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">username <span>*</span></label>
        </div>
        <div class="col-xl-8">
            <input id="formType" name="formType" type="hidden" value="add">
            <input id="idUser" name="idUser" type="hidden">
            <input id="idHospital" name="idHospital" type="hidden">
            <input class="form-control" id="userName" name="userName" required="" autocomplete="off" type="text">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">email <span>*</span></label>
        </div>
        <div class="col-xl-8">
            <input class="form-control" id="userMail" name="userMail" required="" autocomplete="off" type="email">
        </div>
    </div>
    <div class="form-group row" id="div-password">
        <div class="col-xl-4">
            <label class="form-title">password <span>*</span></label>
        </div>
        <div class="col-xl-8">
            <input class="form-control" id="userPass" name="userPass" required="" type="password">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">phones</label>
        </div>
        <div class="col-xl-8">
            <input class="form-control" id="userPhone" name="userPhone" type="text" autocomplete="off" onkeypress="return hanyaAngka(event)">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">role <span>*</span></label>
        </div>
        <div class="col-xl-8">
            <select class="form-control selectpicker-role with-ajax-role" required name="idRole" data-live-search="true">
                <option value="" id="option-ajax-role">Tap to search</option>
            </select>
        </div>
    </div>
</div>
</template>

<script>
module.exports = {
    mounted() {
        evtChoseRole('init');

        function evtChoseRole(evt) {
            var options = {
                ajax: {
                    // url     : SITE_URL + "assets/vendors/bootstrap-select-ajax/example/php/ajax.php",
                    emptyRequest: true,
                    url: BASE_URL + "system_menu/access_control/query",
                    type: 'POST',
                    dataType: 'json',
                    // Use "{{{q}}}" as a placeholder and Ajax Bootstrap Select will
                    // automatically replace it with the value of the search query.
                    data: {
                        q: '{{{q}}}'
                    }
                },
                locale: {
                    emptyTitle: 'Tap to search'
                },
                log: 3,
                preprocessData: function (data) {
                    var i, l = data.length,
                        array = [];

                    if (l) {
                        for (i = 0; i < l; i++) {
                            array.push($.extend(true, data[i], {
                                text: data[i].roleName,
                                value: data[i].idRole,
                                // data: {
                                //     subtext: data[i].idBrand
                                // }
                            }));
                        }
                    }
                    // You must always return a valid array when processing data. The
                    // data argument passed is a clone and cannot be modified directly.
                    return array;
                }
            };

            if (evt == 'init') {
                $('.selectpicker-role').selectpicker().filter('.with-ajax-role').ajaxSelectPicker(options);
            } else if (evt == 'render') {
                $('.selectpicker-role').selectpicker().filter('.with-ajax-role').ajaxSelectPicker('render');
            }
        }
    },
}
</script>
