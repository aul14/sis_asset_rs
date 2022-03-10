<template>
<div>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">repair result<span>*</span></label>
        </div>
        <div class="col-xl-8">
            <div class="form-check-inline form-check">
                <label class="form-check-lable">
                    <input class="form-check-input" type="radio" name="repairResult" value="Baik">
                    Good
                </label>
            </div>
            <div class="form-check-inline form-check">
                <label class="form-check-lable">
                    <input class="form-check-input" type="radio" name="repairResult" value="Rusak Ringan">
                    Lightly Damaged
                </label>
            </div>
            <div class="form-check-inline form-check">
                <label class="form-check-lable">
                    <input class="form-check-input" type="radio" name="repairResult" value="Rusak Berat">
                    Heavily Damaged
                </label>
            </div>
        </div>
    </div>
    <!-- <div class="row justify-content-between">
      <div class="col-xl-6 form-group row">
        <div class="col-xl-4">
          <label class="form-title">finish date</label>
        </div>
        <div class="col-xl-8">
          <input class="form-control" name="timeFinish" type="date" id="timeFinish"
          value="" required readonly>
        </div>
      </div>
      <div class="col-xl-6 form-group row">
        <div class="col-xl-4">
          <label class="form-title">finish time</label>
        </div>
        <div class="col-xl-8">
          <input class="form-control" name="timeFinish" type="time" id="timeFinish"
          value="" required readonly>
        </div>
      </div>
    </div> -->
    <!-- <div class="form-group row">
      <div class="col-xl-4">
        <label class="form-title">kpi point</label>
      </div>
      <div class="col-xl-8">
        <input class="form-control" name="taskKpi" type="text" id="taskKpi"
            value="">
      </div>
    </div> -->
    <!-- <div class="form-group row">
      <div class="col-xl-4">
        <label class="form-title">service price</label>
      </div>
      <div class="col-xl-8">
        <input class="form-control" name="servicePrice" type="numeric" id="servicePrice"
            value="">
      </div>
    </div> -->
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">repair picture</label>
        </div>
        <div class="col-xl-8 d-flex">
          <div class="custom-file samrs-primary">
            <input class="custom-file-input" type="file" name="taskFile1">
            <label class="custom-file-label label-shorts" data-color-type="primary">upload picture</label>
          </div>
          <div class="custom-file samrs-primary ml-10">
            <input class="custom-file-input" type="file" name="taskFile2">
            <label class="custom-file-label label-shorts" data-color-type="primary">upload picture</label>
          </div>
        </div>
    </div>
    <div class="form-group row view-file-edit">
        <div class="col-xl-4">

        </div>

    </div>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">repair note</label>
        </div>
        <div class="col-xl-8 d-flex">
            <textarea class="form-control" name="repairNote" rows="8" cols="80"></textarea>
        </div>
    </div>
</div>
</template>

<script>
module.exports = {
  mounted(){
    InputFiles();
  }
}
</script>
