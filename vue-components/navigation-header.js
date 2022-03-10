let appHeader = new Vue ({
  el: '#header_main',
  components:{
      'header-main':httpVueLoader(BASE_URL+'vue-components/ui-components/navigation/header.vue?v=1.2'),
  }
});
