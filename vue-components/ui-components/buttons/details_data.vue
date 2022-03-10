<template>
<div class="grid-box">
    <a href="javascript:void(0)" :id="buttonId" class="btn btn-block samrs-info"><i class="fas fa-book-open"></i> Details</a>
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
            detail();
        })
    }
}
</script>
