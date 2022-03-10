<template>
  <nav class="navbar top-navbar navbar-expand-md navbar-dark">
    <div class="navbar-header">
      <!-- This is for the sidebar toggle which is visible on mobile only -->
      <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
      <a class="navbar-brand d-block d-md-none" href="javascript:void(0)" :data-color-type="backgroundLight(isLight)" @click="directTo('dashboard/home')">
        <!-- Logo icon -->
        <span class="logo-icon">
          <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
          <!-- Company logo -->
          <img :src="companyLogo" alt="homepage" class="nav-logo this-responsive light-logo" />
          <img :src="companyLogo" alt="homepage" class="nav-logo this-responsive dark-logo" />
        </span>
        <!--End Logo icon -->
      </a>
      <div class="d-none d-md-block text-center">
        <a class="sidebartoggler waves-effect waves-light d-flex align-items-center side-start" href="javascript:void(0)" data-sidebartype="full-sidebar">
          <i class="mdi mdi-menu"></i>
          <span class="navigation-text ml-3">
            <img :src="brandLogo" alt="homepage" class="nav-logo" />
          </span>
        </a>
      </div>
      <!-- ============================================================== -->
      <!-- End Logo -->
      <!-- ============================================================== -->
      <!-- ============================================================== -->
      <!-- Toggle which is visible on mobile only -->
      <!-- ============================================================== -->
      <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
    </div>
    <!-- ============================================================== -->
    <!-- End Logo -->
    <!-- ============================================================== -->
    <div class="navbar-collapse collapse" id="navbarSupportedContent">
      <!-- ============================================================== -->
      <!-- toggle and nav items -->
      <!-- ============================================================== -->
      <ul class="navbar-nav float-left mr-auto">
        <!-- ============================================================== -->
        <!-- Logo -->
        <!-- ============================================================== -->
        <li class="nav-item">
          <a class="nav-link navbar-brand d-none d-md-block" href="javascript:void(0)" :data-color-type="backgroundLight(isLight)" @click="directTo('dashboard/home')">
            <!-- Logo icon -->
            <span class="logo-icon">
              <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
              <img :src="companyLogo" alt="homepage" class="nav-logo this-responsive light-logo" />
              <img :src="companyLogo" alt="homepage" class="nav-logo this-responsive dark-logo" />
            </span>
            <!--End Logo icon -->
          </a>
        </li>
        <li class="nav-item">
          <p class="hospital-active">{{ user_information.hospital_name }}</p>
        </li>
      </ul>
      <!-- ============================================================== -->
      <!-- Right side toggle and nav items -->
      <!-- ============================================================== -->
      <ul class="navbar-nav float-right">
        <slot name="notification"></slot>

        <!-- User profile and search -->
        <!-- ============================================================== -->
        <li class="nav-item dropdown samrs-dropdown" dropdown-style="slide">
          <a class="nav-link dropdown-toggle waves-effect waves-dark pro-pic" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img :src="user_information.picture" alt="user" class="rounded-circle" width="31">
            <span class="ml-2 user-text font-medium text-capitalize">{{ user_information.username }}</span>
            <span class="fas fa-chevron-left ml-2 user-text arrows"></span>
          </a>
          <div class="dropdown-menu with-glass dropdown-menu-right user-dd">
            <div class="d-flex no-block align-items-center p-3 mb-2 border-bottom">
              <div class="mr-1">
                <img :src="user_information.picture" alt="user" class="rounded" width="80">
              </div>
              <div class="ml-2">
                <h4 class="mb-0 text-bold">{{ user_information.username }}</h4>
                <p class=" mb-0 text-dark">{{ user_information.email }}</p>
              </div>
            </div>
            <a class="dropdown-item" :href="base_url()+'hospital'" v-if="user_information.hospital > 1"><i class="fa fa-hospital-user mr-1 ml-1"></i> Select Hospital</a>
            <a class="dropdown-item" :href="base_url()+'settings'"><i class="ti-settings mr-1 ml-1"></i> User Settings</a>
            <div class="dropdown-divider"></div>
            <!-- <a href="javascript:void(0)" class="dropdown-item changeview"><i class="fas fa-exchange-alt"></i> Change view</a> -->
            <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#logout_pop" ><i class="fa fa-power-off mr-1 ml-1"></i> Logout</a>
          </div>
        </li>
        <!-- ============================================================== -->
        <!-- User profile and search -->
        <!-- ============================================================== -->
      </ul>
    </div>
    <logouts popup-text="Are you sure want to logout ?" pop-id="logout_pop" @yes="directTo('login/logout')"></logouts>
  </nav>
</template>

<script>
module.exports={
  components:{
    'logouts':httpVueLoader(BASE_URL+'vue-components/ui-components/popup/popup_danger.vue')
  },
  props:{
    brandLogo:{
      type:String,
      default:'NO_IMAGE.jpg'
    },
    companyLogo:{
      type:String,
      default:'NO_IMAGE.jpg'
    },
    isLight:{
      type:String,
      default:'NO'
    }
  },
  methods:{
    backgroundLight(params){
      if (params === "YES" || params === "Yes" || params === "yes") {
        return "light";
      }else {
        return " ";
      }
    },
    base_url(){
      return BASE_URL;
    },
    directTo(link){
      return window.location.href = BASE_URL+link;
    }
  },
  data(){
    return{
      user_information:[]
    }
  },
  created(){
    // axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    axios.post(BASE_URL+'settings/information')
    .then(response => {
      this.user_information = response.data
    });
  },
  mounted(){
    $(document).ready(function() {
      var $url = window.location + "";
      let $dropdown = $('.samrs-dropdown .dropdown-menu a.dropdown-item').filter(function(){
        return this.href.split('?')[0] === $url.split('?')[0];
      });
      $dropdown.addClass('active');
    });
    $('.changeview').on('click',function(){
      if ($('body').prop('dir') == 'rtl') {
        $('body').attr('dir','ltr');
        $('.changeview').removeClass('samrs-success').addClass('samrs-primary');
        $('.samrs-dropdown').find('.dropdown-menu').removeClass('slideInRight');
      }else if ($('body').prop('dir') == 'ltr') {
        $('body').attr('dir','rtl');
        $('.changeview').removeClass('samrs-primary').addClass('samrs-success');
        $('.samrs-dropdown').find('.dropdown-menu').removeClass('slideInLeft');
      }
    });
  },
  updated(){
    $(document).ready(function() {
      $('.samrs-modal[data-poptype]').on('shown.bs.modal', function() {
        $('body.modal-open').find('.modal-backdrop.open-popup, .modal-backdrop.modal-stack').remove();
      });
    })
  }
}
</script>
<style scoped>
  .hospital-active{
    font-size: 18px;
    font-weight: bold;
    color: var(--natural-white);
    text-transform: capitalize;
    margin-bottom: 5px;
    margin-left: 10px;
    line-height: 3;
    word-break:normal;
    white-space: pre-wrap;
    width: 100%;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 270px;
    max-height:100%;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
  }
  @media only screen and (max-width:576px) {
    .hospital-active{
      /* font-size: 18px; */
      line-height: 1.5!important;
      max-width: 120px!important;
    }
  }
</style>
