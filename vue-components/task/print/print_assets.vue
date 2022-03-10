<template>
<div class="p-10 table-responsive">
    <table class="table samrs-tableview td-first-title signatureColumn">
        <tbody>
            <tr>
                <td>
                    <div class="mt-10">
                        print with signature column ?
                    </div>
                </td>
                <td>:</td>
                <td>
                    <label class="p-0 float-right">
                        <input class="samrs-switch signatureConfirm" type="checkbox" name="toogle_signature" data-toggle="toggle" data-size="small" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger" value="Yes">
                    </label>
                </td>
            </tr>
        </tbody>
    </table>
</div>
</template>

<script>
module.exports = {
    beforeMount() {
        $(document).ready(function () {
            let AddRow = `
      <tr class="columnSignature" style="display:none">
        <td></td>
        <td>:</td>
        <td>
          <div class="d-flex p-10">
            <label>Place and date :</label>
            <div class="input-group ml-10">
              <input class="form-control" type="text" name="lokasi_print" placeholder="Location">
              <input class="form-control" type="date" name="tgl_print">
            </div>
          </div>
          <div class="d-flex p-10">
            <label>Officer :</label>
            <select class="form-control ml-10 selectpicker-person with-ajax-person" data-live-search="true" name="officer">
              <option value="">Select</option>
            </select>
          </div>
        </td>
      </tr>
      `;
            $('.signatureColumn tbody tr:last').after(AddRow);
            DatePicker();
        });
    },
    mounted() {
        $(function () {
            evtUser('init');
        });
        SwitchInital();
        $('.signatureConfirm').on('change', function () {
            if ($(this).prop('checked') === true) {
                $('.columnSignature').show();
            } else {
                $('.columnSignature').hide();
            }
        });

        function evtUser(evt) {
            var options = {
                ajax: {
                    // url     : SITE_URL + "assets/vendors/bootstrap-select-ajax/example/php/ajax.php",
                    emptyRequest: true,
                    url: BASE_URL + "asset/building/room_bld/ajax_user",
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
                                text: data[i].userFullName,
                                value: data[i].userFullName,
                                // data: {
                                //     subtext: data[i].catCode + "-" + data[i].idAsset
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
                $('.selectpicker-person').selectpicker().filter('.with-ajax-person').ajaxSelectPicker(options);
            } else if (evt == 'render') {
                $('.selectpicker-person').selectpicker().filter('.with-ajax-person').ajaxSelectPicker('render');
            }
        }
    }
}
</script>
