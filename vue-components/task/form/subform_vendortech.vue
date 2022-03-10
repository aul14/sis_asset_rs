<template>
  <div class="p-10 mt-10">
    <div class="form-group row">
      <div class="col-xl-4">
        <label class="form-title">vendor name</label>
      </div>
      <div class="col-xl-8">
        <!-- <input type="hidden" name="idVendor" id="idVendor" value=""> -->
        <select name="idVendor" id="supplierContactName" data-live-search="true" class="form-control selectpicker-supplier with-ajax-supplier">
          <option id="option-ajax-vendor">Select</option>
        </select>
      </div>
    </div>
    <!-- <div class="form-group">
      <button class="btn btn-sm samrs-primary btn-block" type="button" name="button"><i class="fas fa-plus"></i> Add</button>
    </div> -->
  </div>
</template>

<script>
module.exports = {
  mounted() {
    $(function () {
      evtSupplier('init');
    });
      function evtSupplier(evt) {
            var options = {
                ajax: {
                    // url     : SITE_URL + "assets/vendors/bootstrap-select-ajax/example/php/ajax.php",
                    emptyRequest: true,
                    url: BASE_URL + "asset/me/inventory_me/ajax_supplier",
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
                    var i, lo = data.length,
                        array = [];

                    if (lo) {
                        for (i = 0; i < lo; i++) {
                            array.push($.extend(true, data[i], {
                                text: data[i].contactCompany,
                                value: data[i].idContact,
                                // data: {
                                //     subtext: data[i].contactCompany
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
                $('.selectpicker-supplier').selectpicker().filter('.with-ajax-supplier').ajaxSelectPicker(options);
            } else if (evt == 'render') {
                $('.selectpicker-supplier').selectpicker().filter('.with-ajax-supplier').ajaxSelectPicker('render');
            }
        }
  },
}
</script>
