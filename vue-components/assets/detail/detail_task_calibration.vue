<template>
  <div class="p-10">
    <div class="table-responsive">
      <table class="calibration_task_list table samrs-tableview capitalize">
        <thead>
        </thead>
        <tbody id="tbody-cal-asset">
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
module.exports={
  mounted(){
    function CalibrationTaskList(){
      $('.calibration_task_list').DataTable({
        columns:[
          {title: 'no', name: 'no'},
          {title:'date' , name:'date' },
          {title:'date of completion', name:'date_of_completion'},
          // {title:'institution', name:'institution'},
          {title:'certificates number', name:'certificates_number'},
          {title:'results', name:'results'},
          {title:'certificates', name:'certificates'},
        ],
        dom: 'trp',
        pageLength: 15,
        lengthMenu: [15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65, 70, 75, 80, 85, 90, 95, 100]
      });
    }
    CalibrationTaskList();
  }
}
</script>
