<template>
  <div class="row card-content">
    <div class="col-xl-7">
      <nav id="navbarMenu" class="navbar navbar-expand-lg navbar-dark with-shadow with-radius samrs-navbar mb-20" with-bg="primary">
        <p class="navbar-brand">
          Welcome, <span class="info-menu text-bold">{{ user.username }}</span>
        </p>
      </nav>
      <slot name="home-dsb"></slot>
      <!-- <div class="row p-10" id="draggableArea">
        <div class="col-lg-3" v-for="item in shortcut"  :key="item.id">
          <div class="card samrs-shortcut with-shadow is-soft-rounded" data-color-type="light">
            <div class="samrs-ribbon" v-if="item.parent != '' ">
                <div class="ribbon" data-color-type="danger" v-if="item.parent === 'MED'">MED</div>
                <div class="ribbon" data-color-type="primary" v-else-if="item.parent === 'NON'">NON MED</div>
            </div>
            <div class="card-body">
              <a :href="item.link">
                <div class="samrs-flex wrapped is-column">
                  <i :class="'shortcut-icon '+item.icon"></i>
                  <span class="shortcut-name">{{ item.menu_name }}</span>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div> -->

    </div>
    <div class="col-xl-5">
      <div class="col-xl-10 offset-xl-2">
        <div class="card">
          <div class="card-header" data-color-type="info">
            <p class="text-capitalize text-center mb-1">user information</p>
          </div>
          <div class="card-body p-1">
            <div class="samrs-flex wrapped is-column user-information-box">
              <div class="user-header">
                <img :src="user.picture" alt="">
              </div>
              <div class="user-body">
                <p class="username text-capitalize">{{ user.username }}</p>
                <p class="emails">{{ user.email }}</p>
              </div>
              <div class="user-footer">
                <p>role : {{ user.role }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
module.exports = {
  data(){
    return{
      // shortcut:[],
      user:[]
    }
  },
  methods:{
    base_url(){
      return BASE_URL;
    }
  },
  mounted(){
    this.$nextTick(function() {
      axios.post(BASE_URL+'dashboard/home/fetch')
      .then(response => {
        // this.shortcut = response.data.shortcut,
        this.user = response.data.info
      });
    })
  },
  updated(){
    $('#draggableArea').sortable()
  }
}
</script>
