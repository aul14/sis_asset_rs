<template>
<div class="grid-box">
    <a href="javascript:void(0)" :id="buttonId" data-toggle="modal" class="btn btn-block samrs-success"><i class="fas fa-boxes"></i> Stock</a>
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
            stock();
        })
    }
}
</script>
