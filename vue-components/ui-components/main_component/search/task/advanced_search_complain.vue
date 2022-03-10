<template>
  <samrs-overlay overlay-id="advanced_search" title="Advanced Search">
    <template v-slot:overlay-content>
      <advanced-search-box>

      </advanced-search-box>
    </template>
  </samrs-overlay>
</template>

<script>
module.exports= {
  components: {
    'samrs-overlay':httpVueLoader(BASE_URL+'vue-components/ui-components/main_component/samrs_overlay.vue'),
    'advanced-search-box':httpVueLoader(BASE_URL+'vue-components/ui-components/form_components/task/complain/advanced_search_form.vue'),
  },
  // mounted(){
  //
  // }
}
</script>
