<template>
  <div class="p-10">
    <div class="samrs-detail-box">
      <label class="detail-title">inspection</label>
      <div class="table-responsive">
        <table class="inspection_task_list table samrs-tableview capitalize">
          <thead>
          </thead>
          <tbody id="tbody-inspection-asset">
          </tbody>
        </table>
      </div>
    </div>
    <!-- <div class="samrs-detail-box mt-20">
      <label class="detail-title">inspection material</label>
      <div class="table-responsive">
        <table class="inspectionmaterial_task_list table samrs-tableview capitalize">
          <thead>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div> -->
  </div>
</template>

<script>
module.exports={
  mounted(){
    function InspectionTaskList(){
      $('.inspection_task_list').DataTable({
        columns:[
          {title: 'no', name: 'no'},
          {title:'date' , name:'date' },
          {title:'type', name:'type'},
          {title:'institution / technician', name:'institution_technician'},
          {title:'note', name:'LK_numbers'},
          {title:'results', name:'results'},
        ],
        dom: 'trp',
        pageLength: 15,
        lengthMenu: [15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65, 70, 75, 80, 85, 90, 95, 100]
      });
    }
    // function InspectionMaterialTaskList(){
    //   $('.inspectionmaterial_task_list').DataTable({
    //     columns:[
    //       {title: 'no', name: 'no'},
    //       {title:'name' , name:'name' },
    //       {title:'prices', name:'price'},
    //       {title:'amount', name:'amount'},
    //       {title:'total', name:'total'},
    //     ],
    //     dom: 'trp',
    //     pageLength: 15,
    //     lengthMenu: [15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65, 70, 75, 80, 85, 90, 95, 100]
    //   });
    // }
    InspectionTaskList();
    // InspectionMaterialTaskList();
  }
}
</script>
