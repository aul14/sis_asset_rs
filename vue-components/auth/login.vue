<template>
  <section class="auth-wrapper">
    <div :class="'samrs-flex wrapped is-row in-center '+distanceTop()">
      <div class="samrs-flex wrapped is-column in-center" with-state="logoBox">
        <div class="card is-soft-rounded" v-if="this.companyLogo != ''">
          <div class="card-body p-2">
            <img class="logo center this-responsive" :src="companyLogo" alt="">
          </div>
        </div>
        <div class="card is-soft-rounded" with-state="loginBox">
          <div class="card-body">
            <div class="row">
              <div class="col-xl-6 d-none d-xs-none d-sm-none d-md-none d-lg-none d-xl-block">
                <div class="p-5">
                  <img class="logo" :src="brandLogo" alt="">
                </div>
              </div>
              <div class="col-xl-1 d-none d-xs-none d-sm-none d-md-none d-lg-none d-xl-block">
                <hr position="vertical">
              </div>
              <div class="col-xl-5 col-lg-12 col-md-12 col-sm-12">
                <div class="d-flex justify-content-between justify-content-xl-center">
                  <div class="p-2 d-block d-xs-block d-sm-block d-md-block d-lg-block d-xl-none">
                    <img class="logo small" :src="brandLogo" alt="">
                  </div>
                  <div class="p-2">
                    <h4>Please sign in to continue</h4>
                  </div>
                </div>
                <div class="pb-2 pt-2 pr-3 pl-3">
                  <form class="" :action="form" method="post">
                    <div class="form-group input-group">
                      <div class="input-group-append">
                        <span class="input-group-text transparent-left"><i class="fas fa-user"></i></span>
                      </div>
                      <input class="form-control big rounded-right border-left" type="email" autocomplete="off" autofocus name="email" placeholder="Enter your email address" required>
                    </div>
                    <div class="form-group input-group">
                      <div class="input-group-append">
                        <span class="input-group-text transparent-left"><i class="fas fa-lock"></i></span>
                      </div>
                      <input class="form-control big rounded-right border-left password-field" type="password"  name="password" placeholder="Enter your password" required>
                      <div class="password-toggle">
                        <i class="fas fa-eye"></i>
                      </div>
                    </div>
                    <div class="form-group">
                      <slot></slot>
                    </div>
                    <div class="form-group">
                      <button class="btn btn-rounded btn-block samrs-primary" type="submit" name="submit" id="button1" disabled>Login</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="samrs-flex wrapped is-row in-between fix-bottom text-white text-bold" with-state="companyInformation">
        <div class="col-xl-4">
          <p>Copyright &copy; 2021 • PT Falitechno Mandiri Indonesia</p>
        </div>
        <div class="col-xl-4">
          <p class="text-right">{{ versionView }}</p>
        </div>
    </div>
  </section>
</template>

// <script>
module.exports = {
  props: {
      brandLogo:{
        type:String,
        default:"",
      },
      companyLogo:{
        type:String,
        default:"",
      },
      form:{
        type:String,
      },
      captchaTag:{
        type:String
      },
      versionView:{
        type:String,
        default:'V.'
      }
  },
  methods:{
    distanceTop(){
      if (this.companyLogo != '') {
        return 'far-from-top';
      }else {
        return 'far-from-top-to-center';
      }
    }
  },
  mounted(){
    PasswordToggle();
  }
}
</script>
<style scoped>
.samrs-flex.far-from-top-to-center{
  position: relative;
  -webkit-transform:translate(-50%,-50%);
  transform:translate(0,37%);
}
</style>
