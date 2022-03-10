<template>
  <div class="col-xl-12">
    <div class="card samrs-card schedulecard">
      <div class="card-body">
        <div class="table-responsive">
          <slot name="schedule-content"></slot>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
// module.exports = {
//   mounted: function(){
//     CalendarData();
//     $('.month').on('change', function(){
//       console.log($(this).val());
//       alert("Day of this month : "+moment($(this).val()).daysInMonth());
//     });
//   }
// }
</script>
