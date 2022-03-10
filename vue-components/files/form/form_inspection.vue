<template>
  <div class="border-top-1 border-light p-10">
    <p>Field marked * are required to fill or mandatory</p>
    <div class="form-group row">
      <div class="col-xl-4">
        <label class="form-title">maintenance type*</label>
      </div>
      <div class="col-xl-8">
        <input name="idFormTemplate" type="hidden" id="idFormTemplate"
            value=""
            required>
        <input class="form-control" name="ftName" type="text" id="ftName"
            value=""
            required readonly>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-xl-4">
        <label class="form-title">document number*</label>
      </div>
      <div class="col-xl-8">
        <input class="form-control" name="ftCode" type="text" id="ftCode"
            value=""
            required>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-xl-4">
        <label class="form-title">assets master</label>
      </div>
      <div class="col-xl-8">
        <div class="p-1">
          <button class="btn samrs-primary" type="button" name="button" v-on:click="selectassets"><i class="fas fa-plus"></i> Select Assets</button>
        </div>
        <table class="table samrs-tableview capitalize">
          <thead>
            <th>Asset master selected list</th>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>
