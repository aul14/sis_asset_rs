<template>
  <div class="p-1">
    <div class="row">
      <div class="col-xl-6">
        <div class="form-group row">
          <div class="col-xl-4">
            <label class="form-title">stock location</label>
          </div>
          <div class="col-xl-8">
              <input class="form-control" type="text" name="" value="" readonly>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-xl-4">
            <label class="form-title">stock name</label>
          </div>
          <div class="col-xl-8">
            <input class="form-control" type="text" name="" value="">
          </div>
        </div>
        <div class="form-group row">
          <div class="col-xl-4">
            <label class="form-title">quantity</label>
          </div>
          <div class="col-xl-8">
            <div class="row">
              <div class="col-xl-6">
                <label class="form-title">quantity minimum stock</label>
                <input class="form-control" type="number" name="" value="">
              </div>
              <div class="col-xl-6">
                <label class="form-title">quantity available</label>
                <input class="form-control" readonly type="number" name="" value="">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-6">
        <div class="form-group row">
          <div class="col-xl-4">
            <label class="form-title">description</label>
          </div>
          <div class="col-xl-8">
          <textarea class="form-control" name="name" rows="8" cols="80"></textarea>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-6">
        <fieldset class="border-1 border-light field-roles">
          <legend class="field-parent-name text-center w-25 ml-10">Stock In</legend>
          <div class="float-right mr-20">
            <button class="btn samrs-primary" type="button" name="button"><i class="fas fa-plus"></i> Add Stock</button>
          </div>
          <div class="table-responsive">
            <table class="stockin_list table samrs-tableview capitalize samrs-table-striped table-hover">
              <thead>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </fieldset>
      </div>
      <div class="col-xl-6">
        <fieldset class="border-1 border-light field-roles">
          <legend class="field-parent-name text-center w-25 ml-10">Stock Out</legend>
          <div class="float-right mr-20">
            <button class="btn samrs-primary" type="button" name="button"><i class="fas fa-plus"></i> Add Stock</button>
          </div>
          <div class="table-responsive">
            <table class="stockout_list table samrs-tableview capitalize samrs-table-striped table-hover">
              <thead>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </fieldset>
      </div>
    </div>
  </div>
</template>

<script>
module.exports = {
  mounted(){
    StockIn();
    StockOut();
  }
}
</script>
