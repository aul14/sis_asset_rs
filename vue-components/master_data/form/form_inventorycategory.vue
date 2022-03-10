<template>
  <div class="p-10">
    <p class="mandatory-info">
        Field marked <span>*</span> is required to fill or mandatory
    </p>
    <div class="form-group row">
      <div class="col-xl-4">
        <label class="form-title">code <span>*</span></label>
      </div>
      <div class="col-xl-8">
        <input id="formType" name="formType" type="hidden" value="add">
        <input class="form-control" id="catCode" name="catCode" required="" autocomplete="off" type="text">
      </div>
    </div>
    <div class="form-group row">
      <div class="col-xl-4">
        <label class="form-title">name <span>*</span></label>
      </div>
      <div class="col-xl-8">
        <input class="form-control" id="assetCatName"
            name="assetCatName" required="" autocomplete="off" type="text">
      </div>
    </div>
    <div class="form-group row">
      <div class="col-xl-4">
        <label class="form-title">description</label>
      </div>
      <div class="col-xl-8">
        <input class="form-control" id="assetCatDesc"
            name="assetCatDesc"  type="text">
      </div>
    </div>
    <div class="form-group row">
      <div class="col-xl-4">
        <label class="form-title">category has parent?</label>
      </div>
       <div class="col-xl-8">
        <div class="form-check-inline form-check">
          <label class="form-check-label">
            <input class="typeRadio" type="radio" name="catHasParent" id="catHasParent1" value="true">
            TRUE
          </label>
        </div>
        <div class="form-check-inline form-check">
          <label class="form-check-label">
            <input class="typeRadio" type="radio" name="catHasParent" id="catHasParent2" checked value="false">
            FALSE
          </label>
        </div>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-xl-4">
        <label class="form-title">type</label>
      </div>
      <div class="col-xl-8">
        <div class="form-check-inline form-check">
          <label class="form-check-label">
            <input class="typeRadio" type="radio" name="sysCatName" id="sysCatName1" value="BLD">
            BUILDING
          </label>
        </div>
        <div class="form-check-inline form-check">
          <label class="form-check-label">
            <input class="typeRadio" type="radio" name="sysCatName" id="sysCatName2" value="MED">
            MEDIC
          </label>
        </div>
        <div class="form-check-inline form-check">
          <label class="form-check-label">
            <input class="typeRadio" type="radio" name="sysCatName" id="sysCatName3" value="NON">
            NON MEDIC
          </label>
        </div>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-xl-4">
        <label class="form-title">subtype</label>
      </div>
      <div class="col-xl-8">
        <div class="samrs-flex wrapped is-row">
          <div class="flex-box border-1 border-light mt-10">
            <div class="form-check-inline form-check ">
              <label class="form-check-label text-capitalize">
                <input class="subtypeRadio" type="radio" name="subSysCat" id="subSysCat1" value="UNITS">
                equipment units
              </label>
            </div>
          </div>
          <div class="flex-box border-1 border-light mt-10">
            <div class="form-check-inline form-check">
              <label class="form-check-label text-capitalize">
                <input class="subtypeRadio" type="radio" name="subSysCat" id="subSysCat2" value="PARTS">
                sparepart/consumable
              </label>
            </div>
          </div>
          <div class="flex-box border-1 border-light mt-10">
            <div class="form-check-inline form-check">
              <label class="form-check-label text-capitalize">
                <input class="subtypeRadio" type="radio" name="subSysCat" id="subSysCat3" value="TOOLS">
                tools/meters
              </label>
            </div>
          </div>
          <div class="flex-box border-1 border-light mt-10">
            <div class="form-check-inline form-check">
              <label class="form-check-label text-capitalize">
                <input class="subtypeRadio" type="radio" name="subSysCat" id="subSysCat4" value="INST">
                instrument set/piece
              </label>
            </div>
          </div>
          <div class="flex-box border-1 border-light mt-10">
            <div class="form-check-inline form-check">
              <label class="form-check-label text-capitalize">
                <input class="subtypeRadio" type="radio" name="subSysCat" id="subSysCat5" value="BLDG">
                buildings
              </label>
            </div>
          </div>
          <div class="flex-box border-1 border-light mt-10">
            <div class="form-check-inline form-check">
              <label class="form-check-label text-capitalize">
                <input class="subtypeRadio" type="radio" name="subSysCat" id="subSysCat6" value="FLOR">
                floor
              </label>
            </div>
          </div>
          <div class="flex-box border-1 border-light mt-10">
            <div class="form-check-inline form-check">
              <label class="form-check-label text-capitalize">
                <input class="subtypeRadio" type="radio" name="subSysCat" id="subSysCat7" value="ROOM">
                rooms
              </label>
            </div>
          </div>
          <div class="flex-box border-1 border-light mt-10">
            <div class="form-check-inline form-check">
              <label class="form-check-label text-capitalize">
                <input class="subtypeRadio" type="radio" name="subSysCat" id="subSysCat8" value="ACCS">
                accs
              </label>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-xl-4">
        <label class="form-title">property</label>
      </div>
       <slot name="category-property"></slot>

    </div>
  </div>
</template>

<script>
module.exports={
  mounted(){
    $("input[name=catCode]").change(function () {
      // e.preventDefault();
      var cat_code = $("input[name=catCode]").val();
      if (cat_code.length > 4) {
        Swal.fire({
          icon: 'warning',
          title: 'Oops...',
          text: "Maximum code 4 character",
        });
        $("input[name=catCode]").val("");
        return;
      }
      // alert(cat_code.length);
    });

    $('.checkedAll').click(function(){
      $('.property input:checkbox').not(this).not('.toggleCheck').prop('checked', this.checked);
      if (this.checked === true) {
        $(this).parents('button').removeClass('samrs-primary').addClass('samrs-danger');
        $(this).next('span').text("Uncheck All");
      }else {
        $(this).parents('button').removeClass('samrs-danger').addClass('samrs-primary');
        $(this).next('span').text("Check All");
      }
    });
    $('.toggleCheck').click(function(){
        $('.property input:checkbox').each(function(){
          $(this).not('.checkedAll').prop('checked', !$(this)[0].checked);
        });
        if ($('.property input:checkbox').is(':checked') === true) {
          $(this).find('i').removeClass('fa-toggle-off').addClass('fa-toggle-on');
        }else {
          $(this).find('i').removeClass('fa-toggle-on').addClass('fa-toggle-off');
        }
    });
    $('.typeRadio').each(function(){
      $(this).change(function(){
        if (this.checked === true) {
          $('.subtype').collapse('show');
        }else {
          $('.subtype').collapse('hide');
        }
      });
    });
    $('.subtypeRadio').each(function(){
      $(this).change(function(){
        if (this.checked === true) {
          $('.property').collapse('show');
        }else {
          $('.property').collapse('hide');
        }
      })
    })
  }
}
</script>
