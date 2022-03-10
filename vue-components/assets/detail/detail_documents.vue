<template>
  <div class="p-10">
    <div class="table-responsive">
      <table class="document_list table samrs-tableview capitalize">
        <thead>
        </thead>
        <tbody id="tbody-detail-dokumen">
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
module.exports={
  mounted(){
    function DocumentList(){
      $('.document_list').DataTable({
        columns:[
          {title: 'file category', name: 'file_category'},
          {title:'file name' , name:'file_name' },
          {title:'file size', name:'file_size'},
          {title:'files', name:'files'},
        ],
        dom: 'trp',
        pageLength: 15,
        lengthMenu: [15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65, 70, 75, 80, 85, 90, 95, 100]
      });
    }
    DocumentList();
  }
}
</script>
