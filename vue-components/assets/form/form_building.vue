<template>
<div class="row">
    <div class="col-xl-6">
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">building name</label>
            </div>
            <div class="col-xl-6">
                <input type="hidden" name="propAssetPropbuilding_buildingCode">
                <input type="text" class="form-control ajax_propAssetPropbuilding_buildingName" name="propAssetPropbuilding_buildingName" />
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">city</label>
            </div>
            <div class="col-xl-6">
                <input type="text" class="form-control" name="propAssetPropbuilding_city" />
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">phone</label>
            </div>
            <div class="col-xl-6">
                <input type="text" class="form-control" onkeypress="return hanyaAngka(event)" name="propAssetPropbuilding_phone" />
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">address</label>
            </div>
            <div class="col-xl-6">
                <textarea class="form-control" name="propAssetPropbuilding_buildingDesc" rows="8" cols="80"></textarea>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">surface area</label>
            </div>
            <div class="col-xl-6">
                <input type="text" class="form-control" name="propAssetPropbuilding_luasTanah" />
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">building area</label>
            </div>
            <div class="col-xl-6">
                <input type="text" class="form-control" name="propAssetPropbuilding_luasBangunan" />
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="form-group row">
            <div class="col-xl-4">
                <label class="form-title">floor</label>
            </div>
            <div class="col-xl-6">
                <div class="floor-form">
                    <div class="input-group input-hidden-bld">
                      <input type="hidden" class="id-floor-first" name="propAssetPropbuildingFloor_idFloor[]">
                      <input type="hidden" class="id-building-first" name="propAssetPropbuildingFloor_idBuilding">
                        <!--  -->
                        <input type="text" class="form-control floor-first" name="propAssetPropbuildingFloor_floorName[]" />
                        <div class="input-group-append">
                            <button class="btn samrs-success add-floor" type="button" name="button" data-toggle="tooltip" data-placement="right" title="" data-original-title="Add New Floor">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
module.exports = {
    created() {
        $(window).on("load", function () {
            // var fieldCopy = `
            // <div class="floor-formcopy" style="display: none;">
            //   <div class="input-group mt-10 mb-10">
            //     <input type="text" class="form-control" name="propAssetPropbuildingFloor_floorName[]" >
            //     <div class="input-group-append">
            //       <button class="btn samrs-danger remove-floor"
            //       type="button" name="button"
            //       title="Remove Floor"><i class="fas fa-times"></i></button>
            //     </div>
            //   </div>
            // </div>
            // `;
            // $("body").find(".floor-form").after(fieldCopy);
        });
    },
    mounted() {
        $(document).ready(function () {
            $(".add-floor").click(function () {
                var addfield =
                    '<div class="floor-form">' + $(`<div class="floor-formcopy" style="display: none;">
        <div class="input-group mt-10 mb-10">
          <input type="text" class="form-control" name="propAssetPropbuildingFloor_floorName[]" >
          <div class="input-group-append">
            <button class="btn samrs-danger remove-floor"
            type="button" name="button"
            title="Remove Floor"><i class="fas fa-times"></i></button>
          </div>
        </div>
      </div>`).html() + "</div>";
                $("body").find(".floor-form:last").after(addfield);
            });
            $("body").on("click", ".remove-floor", function () {
                $(this).parents(".floor-form").remove();
            });
        });
        Tooltip();
    },
};
</script>
