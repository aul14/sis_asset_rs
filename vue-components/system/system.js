let forms = new Vue({
  el: '#app_form',
  components:{
    'form-adduser':httpVueLoader(BASE_URL+'vue-components/system/form/form_adduser.vue'),
    'form-usercontrol':httpVueLoader(BASE_URL+'vue-components/system/form/form_usercontrol.vue'),
    'subform-feature':httpVueLoader(BASE_URL+'vue-components/system/form/subform_features.vue'),
    'subform-location':httpVueLoader(BASE_URL+'vue-components/system/form/subform_location.vue'),
  }
});
