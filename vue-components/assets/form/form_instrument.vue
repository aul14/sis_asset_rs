<template>
  <div class="row">
    <!-- <div class="col-xl-6">
      <div class="form-group row">
        <div class="col-xl-4">
          <label class="form-title">instrument set name</label>
        </div>
        <div class="col-xl-8">
          <select class="form-control" name="">
            <option >Pilih</option>
          </select>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-xl-4">
          <label class="form-title">alias name</label>
        </div>
        <div class="col-xl-8">
          <input class="form-control" type="text" readonly name="" >
        </div>
      </div>
      <div class="form-group row">
        <div class="col-xl-4">
          <label class="form-title">merk</label>
        </div>
        <div class="col-xl-8">
          <input class="form-control" type="text" readonly name="" >
        </div>
      </div>
    </div> -->
    <div class="col-xl-12">
      <div class="col-xl-4">
        <h3>Instrument Piece</h3>
      <button class="btn samrs-primary animated" id="btn-add-instrument" type="button" name="button" data-toggle="modal" data-target="#instrument_Modal"><i class="fas fa-plus"></i> Add</button>
      </div>
      <div class="table-responsive">
        <table class="instrument_list table samrs-tableview capitalize samrs-table-striped table-hover w-100">
          <thead>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
module.exports = {
  mounted(){
    InstrumentTable();
    SelectInstrumentPiece();
  }
}
</script>
