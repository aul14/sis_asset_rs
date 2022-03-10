<template>
<div class="p-1 border-top-1 border-light">
    <label class="form-title" samrs-typography="700">{{ listAlphabet }}. technincian engineer / vendor in-charges</label>
    <div class="form-group row">
      <div class="col-xl-4">
        <label class="form-title">technician in-charges</label>
      </div>
      <div class="col-xl-8">
        <input class="form-control" readonly type="text" name="" value="">
      </div>
    </div>
    <div class="form-group row">
      <div class="col-xl-4">
        <label class="form-title">technician assistant</label>
      </div>
      <div class="col-xl-8">
        <input class="samrs-switch" type="checkbox" data-toggle="toggle" data-size="small"
        data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger"
        value="Yes" name="tmpitemEngineer" id="tmpitemEngineer">
      </div>
    </div>
    <div class="form-group row">
      <div class="col-xl-4">
        <label class="form-title">vendor technician</label>
      </div>
      <div class="col-xl-8">
        <input class="samrs-switch" type="checkbox" data-toggle="toggle" data-size="small"
        data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger"
        value="Yes" name="tmpitemUseVendor" id="tmpitemUseVendor">
      </div>
    </div>
</div>
</template>

<script>
module.exports = {
    data() {
        return {
            number: 0
        }
    },
    props: {
        listAlphabet: {
            type: String,
            default: 'List_Unavailable',
        }
    },
    mounted() {

    }
}
</script>

<style scoped>
.is-soft-rounded {
    border-radius: 2px !important;
}
</style>
