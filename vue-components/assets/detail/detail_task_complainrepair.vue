<template>
  <div class="p-10">
    <div class="samrs-detail-box">
      <label class="detail-title">complain and repair</label>
      <div class="table-responsive">
        <table class="complainrepair_task_list table samrs-tableview capitalize">
          <thead>
          </thead>
          <tbody id="tbody-complain-asset">
          </tbody>
        </table>
      </div>
    </div>
    <div class="samrs-detail-box mt-20">
      <label class="detail-title">sparepart request</label>
      <div class="table-responsive">
        <table class="repairspareparts_task_list table samrs-tableview capitalize">
          <thead>
          </thead>
          <tbody id="tbody-complain-asset-parts">
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
module.exports={
  mounted(){
    function ComplainRepairTaskList(){
      $('.complainrepair_task_list').DataTable({
        columns:[
          {title: 'no', name: 'no'},
          {title:'date' , name:'date' },
          {title:'complains', name:'complains'},
          {title:'technician', name:'technician'},
          {title:'results', name:'results'},
        ],
        dom: 'trp',
        pageLength: 15,
        lengthMenu: [15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65, 70, 75, 80, 85, 90, 95, 100]
      });
    }
    function RepairSparepartTaskList(){
      $('.repairspareparts_task_list').DataTable({
        columns:[
          {title: 'no', name: 'no'},
          {title:'code' , name:'code' },
          {title:'spare part', name:'spare_part'},
          {title:'price' , name:'price' },
          {title:'amount', name:'amount'},
          {title:'total', name:'total'},
        ],
        dom: 'trp',
        pageLength: 15,
        lengthMenu: [15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65, 70, 75, 80, 85, 90, 95, 100]
      });
    }
    ComplainRepairTaskList();
    RepairSparepartTaskList();
  }
}
</script>
