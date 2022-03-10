<template>
<div class="col-xl-4">
    <div class="card samrs-card more-space">
        <div class="card-header" data-color-type="light">
            <p class="text-bold">Contacts</p>
            <input type="hidden" with-state="filtering" name="" value="">
        </div>
        <div class="card-body p-20">
            <div class="samrs-input-group">
                <input class="form-control quick_search_contact" type="text" name="" value="" placeholder="Search contacts">
                <label class="toggle-label"><i class="fas fa-search"></i></label>
            </div>
            <div class="p-10">
                <add-data modal="contact_form"></add-data>
            </div>
            <div class="border-bottom-1 border-light mt-30 mb-30">
                <a class="filter" href="javascript:void(0)">All Contacts <span class="float-right" id="all-count-contact">0</span></a>
            </div>
            <div class="samrs-detail-box mt-20">
                <label class="detail-title">Groups contact</label>
                <div class="samrs-list with-border more-space with-rounded">
                    <a class="list-item filter" href="javascript:void(0)">People
                        <span class="badge badge-primary float-right" id="people-count-contact">
                            <i class="fas fa-users"></i> 0
                        </span>
                    </a>
                    <a class="list-item filter" href="javascript:void(0)">Calibration Institution
                        <span class="badge badge-success float-right" id="ci-count-contact">
                            <i class="fas fa-users"></i> 0
                        </span>
                    </a>
                    <a class="list-item filter" href="javascript:void(0)">Supplier
                        <span class="badge badge-dark float-right" id="sup-count-contact">
                            <i class="fas fa-users"></i> 0
                        </span>
                    </a>
                    <a class="list-item filter" href="javascript:void(0)">Customer
                        <span class="badge badge-warning float-right" id="cus-count-contact">
                            <i class="fas fa-users"></i> 0
                        </span>
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
</template>

<script>
module.exports = {
    components: {
        'add-data': httpVueLoader(BASE_URL + 'vue-components/ui-components/buttons/add_data.vue'),
    },
    mounted() {
        $.ajax({
            type: "POST",
            url: BASE_URL + "contact/data_count",
            data: {},
            dataType: "json",
            success: function (res) {
                $("#all-count-contact").text(res.all);
                $("#all-count-contact").parent('a').attr('data-filtering','');
                $("#people-count-contact").text(res.countPerson);
                $("#people-count-contact").parent('a').attr('data-filtering','PERSON');
                $("#ci-count-contact").text(res.countCalibInstitution);
                $("#ci-count-contact").parent('a').attr('data-filtering','CALIBRATION_INSTITUTION');
                $("#sup-count-contact").text(res.countSupplier);
                $("#sup-count-contact").parent('a').attr('data-filtering','SUPPLIER');
                $("#cus-count-contact").text(res.countCustomer);
                $("#cus-count-contact").parent('a').attr('data-filtering','CUSTOMER');
            }
        });
        $('a.filter').each(function() {
          $(this).click(function() {
            $('input[with-state="filtering"]').val($(this).attr('data-filtering'));
          })
        })
    }
}
</script>
