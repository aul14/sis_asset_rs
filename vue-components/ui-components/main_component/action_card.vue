<template>
  <div class="col-xl-12">
    <div class="card samrs-card actioncard">
      <div class="card-header row">
        <div class="col-xl-9 p-0">
          <p>{{title}}</p>
        </div>
        <div class="col-xl-3 form-group samrs-input-group" v-if="withSearch === 'true'">
          <input class="form-control quick_search" type="text" name="" value="" placeholder="Search all data">
          <label class="toggle-label"><i class="fas fa-search"></i></label>
        </div>
      </div>
      <div class="card-body">
        <div class="samrs-grid grid-9 mr-10 ml-10">
          <slot name="buttons"></slot>
        </div>
        <slot name="content"></slot>
      </div>
    </div>
  </div>
</template>

<script>
module.exports = {
  props : {
      title:{
        type : String,
        default: 'No Title',
      },
      withSearch:{
        type:String,
        default:'true',
      }
  },
  data(){
    return{
      tabledata:null,
      scheduledata:null,
    }
  }
}
</script>
