<template>
  <div class="p-10 row">
    <div class="col-xl-6">
      <div class="form-group row">
        <div class="col-xl-4">
          <label class="form-title">code</label>
        </div>
        <div class="col-xl-6">
          <input id="formType" name="formType" type="hidden"
              value="add">
          <input class="form-control" id="orgCode"
              name="orgCode" required type="text"
              >
        </div>
      </div>
      <div class="form-group row">
        <div class="col-xl-4">
          <label class="form-title">type</label>
        </div>
        <div class="col-xl-6">
          <select name="orgType" id="orgType" class="form-control">
              <option value="SERVICE">SERVICE</option>
              <option value="DEPARTMENT">DEPARTMENT</option>
              <option value="ROOM">ROOM</option>
          </select>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-xl-4">
          <label class="form-title">parent</label>
        </div>
        <div class="col-xl-6">
          <select name="orgParent" id="orgParent" class="form-control selectpicker-parent with-ajax-parent" data-live-search="true">
              <option value="" id="option-ajax-parent">select</option>
          </select>
        </div>
      </div>
    </div>
    <div class="col-xl-6">
      <div class="form-group row">
        <div class="col-xl-4">
          <label class="form-title">name</label>
        </div>
        <div class="col-xl-6">
          <input class="form-control" id="orgName" name="orgName" required type="text"
              >
        </div>
      </div>
      <div class="form-group row">
        <div class="col-xl-4">
          <label class="form-title">description</label>
        </div>
        <div class="col-xl-6">
          <input class="form-control" id="orgDesc" name="orgDesc"
           type="text"
              >
        </div>
      </div>
    </div>
  </div>
</template>

<script>
module.exports= {
  mounted() {
    evtOrgParent('init');
       function evtOrgParent(evt) {
            var options = {
                ajax: {
                    // url     : SITE_URL + "assets/vendors/bootstrap-select-ajax/example/php/ajax.php",
                    emptyRequest: true,
                    url: BASE_URL + "master_data/installation/query",
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
                                text: data[i].orgCode,
                                value: data[i].orgCode,
                                data: {
                                    subtext: data[i].orgName
                                }
                            }));
                        }
                    }
                    // You must always return a valid array when processing data. The
                    // data argument passed is a clone and cannot be modified directly.
                    return array;
                }
            };

            if (evt == 'init') {
                $('.selectpicker-parent').selectpicker().filter('.with-ajax-parent').ajaxSelectPicker(options);
            } else if (evt == 'render') {
                $('.selectpicker-parent').selectpicker().filter('.with-ajax-parent').ajaxSelectPicker('render');
            }
        }
  },
}
</script>
