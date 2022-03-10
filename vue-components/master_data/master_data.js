let forms = new Vue({
  el: '#app_form',
  components:{
    'form-companyinfo':httpVueLoader(BASE_URL+'vue-components/master_data/form/form_companyinfo.vue'),
    'form-installation':httpVueLoader(BASE_URL+'vue-components/master_data/form/form_installation.vue'),
    'form-brand':httpVueLoader(BASE_URL+'vue-components/master_data/form/form_brand.vue'),
    'form-inventorycategory':httpVueLoader(BASE_URL+'vue-components/master_data/form/form_inventorycategory.vue'),
    'form-inventorymaster':httpVueLoader(BASE_URL+'vue-components/master_data/form/form_inventorymaster.vue'),
    'form-funding':httpVueLoader(BASE_URL+'vue-components/master_data/form/form_funding.vue'),
    'form-measurementunit':httpVueLoader(BASE_URL+'vue-components/master_data/form/form_measurementunit.vue'),
    'form-filecategory':httpVueLoader(BASE_URL+'vue-components/master_data/form/form_filecategory.vue'),
    'form-taskcategory':httpVueLoader(BASE_URL+'vue-components/master_data/form/form_taskcategory.vue'),
    'form-instrument':httpVueLoader(BASE_URL+'vue-components/master_data/form/form_instrument.vue'),
  }
});
