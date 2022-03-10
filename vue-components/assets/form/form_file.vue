<template>
  <div class="p-10">
    <button class="btn samrs-dark" type="button" name="button" data-toggle="modal" data-target="#file_uploadModal">Upload new file</button>
    <div class="table-responsive">
      <table class="file_list table samrs-tableview capitalize samrs-table-striped table-hover w-100">
        <thead>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </div>

</template>

<script>
module.exports ={
  mounted(){
    FileTable();
  }
}
</script>
