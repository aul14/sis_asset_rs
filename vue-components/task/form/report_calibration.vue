<template>
<div class="p-10">
    <p class="mandatory-info">Field marked <span>*</span> are required to fill or mandatory</p>

    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">planning date<span>*</span></label>
        </div>
        <div class="col-xl-8">
            <input class="form-control" type="text" name="scheduleStart" readonly>
        </div>
    </div>
        <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">implementation date<span>*</span></label>
        </div>
        <div class="col-xl-8">
            <slot name="implementation-date"></slot>
            <input type="hidden" name="idTaskReport">
            <input type="hidden" name="idAssetReport">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">next calibration<span>*</span></label>
        </div>
        <div class="col-xl-4">
            <select class="form-control selectpicker-contact with-ajax-date" name="next_range" id="next_range" data-live-search="true" required>
                <!-- <option>Value</option> -->
                <option value="1years">1 years</option>
                <option value="6month">6 month</option>
                <option value="2years">2 years</option>
            </select>
        </div>
        <div class="col-xl-4">
            <input class="form-control" type="text" name="scheduleStartNext" readonly>
            <input type="hidden" name="calitemProgress">
        </div>
    </div>

    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">institution<span>*</span></label>
        </div>
        <div class="col-xl-8">
            <slot name="institution-contact"></slot>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">certificates number<span>*</span></label>
        </div>
        <div class="col-xl-8">
            <input class="form-control" type="text" name="sertificateNumber" autocomplete="off" required>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">service price<span>*</span></label>
        </div>
        <div class="col-xl-8">
            <input class="form-control" type="text" name="servicePrice"  autocomplete="off" onkeypress="return hanyaAngka(event)">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">result<span>*</span></label>
        </div>
        <div class="col-xl-8">
            <div class="form-check form-check-inline">
                <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="calibrationResult" id="calibrationResult1" value="Laik">
                    Pass (<i>Laik</i>)
                </label>
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="calibrationResult" id="calibrationResult2" value="Tidak Laik">
                    Fails (<i>Tidak Laik</i>)
                </label>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">file</label>
        </div>
        <div class="col-xl-8">
            <input class="form-control" type="file" name="file" id="file">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">calibration note's </label>
        </div>
        <div class="col-xl-8">
            <textarea class="form-control" name="note" rows="8" cols="80"></textarea>
        </div>
    </div>
</div>
</template>

<script>
module.exports = {
    mounted() {
        // DatePicker();
        $('.selectpicker-contact').selectpicker();
        $(".with-ajax-date").change(function () {
            // e.preventDefault();
            let val_date = this.value,
                //  next_range = $("input[name=next_range]").val(),
                scheduleStart = $("input[name=scheduleStart]").val();

            // console.log(val_date);
            if (val_date != undefined) {
                $.ajax({
                    type: "POST",
                    url: BASE_URL + "task/med/calibration/schedule_report/next_range_date",
                    data: {
                        'next_range': val_date,
                        'scheduleStart': scheduleStart
                    },
                    dataType: "json",
                    success: function (res) {
                        $("input[name=scheduleStartNext]").val(res);
                    }
                });
            }

        });
    }
}
</script>
