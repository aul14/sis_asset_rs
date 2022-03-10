<template>
  <div class="p-10">
    <div class="samrs-detail-box">
      <label class="detail-title">Mutation Confirm</label>
      <div class="p-10">
        <div class="form-group row">
          <div class="col-xl-4">
            <label class="form-title">confirm date</label>
          </div>
          <div class="col-xl-8">
             <slot name="finishdate-confirm-mut"></slot>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-xl-4">
            <label class="form-title">confirmed by<span>*</span></label>
          </div>
          <div class="col-xl-8">
            <slot name="finishby-confirm-mut"></slot>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-xl-4">
            <label class="form-title">note<span>*</span></label>
          </div>
          <div class="col-xl-8">
            <textarea class="form-control" name="finishSign" rows="8" cols="80"></textarea>

      
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
// module.exports ={
//   mounted:function(){
//     DatePicker();
//   }
// }
</script>
