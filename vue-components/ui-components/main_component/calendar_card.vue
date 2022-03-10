<template>
  <div class="col-xl-12">
    <div class="card samrs-card h-small">
      <div class="card-body">
        <slot name="calendar-content"></slot>
      </div>
    </div>
  </div>
</template>

<script>
module.exports = {
  mounted: function(){
    CalendarData();
  }
}
</script>
