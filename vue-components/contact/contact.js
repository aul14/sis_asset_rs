let forms = new Vue({
  el: '#app_form',
  components:{
    'form-contact':httpVueLoader(BASE_URL + 'vue-components/contact/form/form_contact.vue?v=1.0'),
  }
});
