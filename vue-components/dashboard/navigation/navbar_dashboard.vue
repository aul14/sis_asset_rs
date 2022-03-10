<template>
  <nav id="navbarMenu" class="navbar navbar-expand-lg navbar-dark with-shadow with-radius samrs-navbar" with-bg="primary">
    <p class="navbar-brand">{{ dashboardName }}
      <span class="info-menu">{{ dashboardSubmenu }}</span>|
      <span class="info-year">{{ dashboardYears }}</span>
    </p>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#DashboardNav" aria-expanded="false" aria-label="Toggle navigation"
      v-if="mobileFirst() === 'YES'">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="DashboardNav" v-if="mobileFirst() === 'YES'">
      <ul class="navbar-nav ml-auto">
        <slot name="nav-item"></slot>
      </ul>
    </div>
  </nav>

</template>

<script>
module.exports = {
  props: {
    dashboardName:{
      type:String,
      default:'undefined'
    },
    dashboardSubmenu:{
      type:String,
      default:'undefined'
    },
    dashboardYears:{
      type:String,
      default:'undefined'
    },
    mobileNav:{
      type:String,
      default:'Yes'
    }
  },
  methods:{
    mobileFirst(){
      return this.mobileNav.toUpperCase();
    }
  },
  mounted(){
  $(function(){
    "use strict"
    let url = window.location.search + "";
    let urlParameters = url.substr(1).split('&')[0];
    let elementWindow = $('#navbarMenu a').filter(function() {
        return splitMulti(this.href, ['?','&'])[1] === urlParameters;
    });
    elementWindow.parent('.nav-item').addClass('active')
    });
    console.log($('.dropdown-menu[with-state="charts-data"]'));
  }
}
</script>

<style lang="css" scoped>
</style>
