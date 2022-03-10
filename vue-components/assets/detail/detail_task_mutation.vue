<template>
  <div class="p-10">
    <div class="table-responsive">
      <table class="mutation_task_list table samrs-tableview capitalize">
        <thead>
        </thead>
        <tbody id="tbody-mutation-asset">
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
module.exports={
  mounted(){
    function MutationTaskList(){
      $('.mutation_task_list').DataTable({
        columns:[
          {title: 'no', name: 'no'},
          {title:'date' , name:'date' },
          {title:'type', name:'type'},
          {title:'status', name:'status'},
          {title:'src room', name:'first_room'},
          {title:'dst room', name:'second_room'},
          {title:'scope', name:'informant'},
        ],
        dom: 'trp',
        pageLength: 15,
        lengthMenu: [15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65, 70, 75, 80, 85, 90, 95, 100]
      });
    }
    MutationTaskList();
  }
}
</script>
