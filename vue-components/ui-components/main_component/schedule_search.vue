<template>
<samrs-overlay overlay-id="advanced_search" title="Advanced Search">
    <template v-slot:overlay-content>
        <advanced-search-schedule>
          
        </advanced-search-schedule>
    </template>
</samrs-overlay>
</template>

<script>
module.exports = {
    components: {
        'samrs-overlay': httpVueLoader(BASE_URL + 'vue-components/ui-components/main_component/samrs_overlay.vue'),
        'advanced-search-schedule': httpVueLoader(BASE_URL + 'vue-components/ui-components/form_components/advanced_search_schedule.vue'),
    },
    // mounted(){
    //
    // }
}
</script>
