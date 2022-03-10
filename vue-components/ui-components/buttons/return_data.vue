<template>
<div class="grid-box">
    <a href="javascript:void(0)" :id="buttonId" class="btn btn-block samrs-gray"><i class="fas fa-undo-alt"></i> Return</a>
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
            return_data(this.$parent.tabledata[0]);
        })
    }
}
</script>
