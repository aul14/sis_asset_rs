<template>
<div class="grid-box">
    <a href="javascript:void(0)" :id="buttonId" class="btn btn-block samrs-success"><i class="fas fa-check"></i> Confirm</a>
</div>
</template>

<script>
module.exports = {
    props: {
        buttonId: {
            type: String,
            default: "not_unique"
        },
    },
    mounted() {
        this.$nextTick(function () {
            confirm_data(this.$parent.tabledata[0]);
        })
    }
};
</script>
