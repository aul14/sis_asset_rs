<template>
<div class="p-10">
  <p class="mandatory-info">
      Field marked <span>*</span> is required to fill or mandatory
  </p>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">task code <span>*</span></label>
        </div>
        <div class="col-xl-8">
            <input id="formType" name="formType" type="hidden" value="add">

            <input class="form-control" name="taskCode" required="" type="text" >
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">task system code</label>
        </div>
        <div class="col-xl-8">
            <select name="taskSysCode" id="taskSysCode" class="form-control">
                <option value="MED">MED</option>
                <option value="NON">NON</option>
                <option value="BLD">BLD</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">task name <span>*</span></label>
        </div>
        <div class="col-xl-8">
            <input class="form-control" id="taskName" name="taskName" required type="text" >
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">required approval</label>
        </div>
        <div class="col-xl-8">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" checked name="needApproval" id="needApproval1" value="true">
                <label class="form-check-label"> Yes </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="needApproval" id="needApproval2" value="false">
                <label class="form-check-label"> No </label>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">required form</label>
        </div>
        <div class="col-xl-8">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="needForm" id="needForm1" value="true">
                <label class="form-check-label"> Yes </label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" checked name="needForm" id="needForm2" value="false">
                <label class="form-check-label"> No </label>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xl-4">
            <label class="form-title">task table</label>
        </div>
        <div class="col-xl-8">
            <input class="form-control" id="taskTable" name="taskTable" required type="text" >
        </div>
    </div>
</div>
</template>

<script>
// export default {
// }
</script>
