<template>
  <div class="row">
    <div class="col-xl-6">
      <div class="form-group row">
        <div class="col-xl-4">
          <label class="form-title">task name</label>
        </div>
        <div class="col-xl-8">
          <input id="taskCode" name="taskCode" type="hidden" value="SOM" />
          <input id="idProgress" name="idProgress" type="hidden"  />
          <input id="formType" name="formType" type="hidden"  />
          <input name="idRelatedTask" type="hidden"  />
          <input name="idSchedule" type="hidden"  />
          <input id="idTask" name="idTask" type="hidden"  />
          <input id="idTaskOpname" name="idTaskOpname" type="hidden"  />
          <input id="propSchedule_idSchedule" name="propSchedule_idSchedule" type="hidden"/>

          <input class="form-control" name="taskName" required="True" type="text"  />
        </div>
      </div>
      <div class="form-group row">
        <div class="col-xl-4">
          <label class="form-title">task desc</label>
        </div>
        <div class="col-xl-8">
          <textarea class="form-control" id="taskDesc" name="taskDesc">
          </textarea>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-xl-4">
          <label class="form-title">task kpi</label>
        </div>
        <div class="col-xl-8">
          <input class="form-control" id="taskKpi" name="taskKpi"
              type="text" onkeypress="return hanyaAngka(event)" />
        </div>
      </div>
      <div class="form-group row">
        <div class="col-xl-4">
          <label class="form-title">task amount</label>
        </div>
        <div class="col-xl-8">
          <input class="form-control" id="taskAmount"
              name="taskAmount" type="text" onkeypress="return hanyaAngka(event)" />
        </div>
      </div>
    </div>
    <div class="col-xl-6">
      <div class="form-group row">
        <div class="col-xl-4">
          <label class="form-title">schedule start</label>
        </div>
        <div class="col-xl-8">
          <input class="form-control" id="propSchedule_scheduleStart"
              name="propSchedule_scheduleStart" required="True" type="date"
               />
        </div>
      </div>
      <div class="form-group row">
        <div class="col-xl-4">
          <label class="form-title">schedule end</label>
        </div>
        <div class="col-xl-8">
          <input class="form-control" id="propSchedule_scheduleEnd"
              name="propSchedule_scheduleEnd" required="True" type="date"
               />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
module.exports={
  mounted() {
    DatePicker();
  },
}
</script>

<style lang="css" scoped>
</style>
