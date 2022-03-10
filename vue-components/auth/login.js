new Vue({
  el: '#login',
  components: {
    'login-card': httpVueLoader(BASE_URL+'vue-components/auth/login.vue?v=1.1'),
  },
});
