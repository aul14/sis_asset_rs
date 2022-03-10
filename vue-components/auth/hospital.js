new Vue({
    el: '#hospital',
    components: {
        'hospital-card': httpVueLoader(BASE_URL + 'vue-components/auth/hospital.vue?v=1.5'),
    },
});
