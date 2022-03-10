<template>
  <div class="grid-box">
    <div class="dropdown">
      <a href="javascript:void(0)" class="btn btn-block samrs-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-calendar-day"></i> Task periode
      </a>
      <div class="dropdown-menu">
          <a class="dropdown-item" href="schedule_report?periode=this_year">This Year</a>
          <a class="dropdown-item" href="schedule_report?periode=last_year">Last Year</a>
          <a class="dropdown-item" href="schedule_report?periode=next_year">Next Year</a>
          <a class="dropdown-item" href="schedule_report?periode=this_month">This Month</a>
          <a class="dropdown-item" href="schedule_report?periode=last_month">Last Month</a>
          <a class="dropdown-item" href="schedule_report?periode=next_month">Next Month</a>
      </div>
    </div>
  </div>
</template>

<script>
// module.exports = {
//   props : {
//     modal:{
//       type: String,
//       default: '',
//     },
//   },
// }
</script>
