<template>
  <div class="grid-box">
    <div class="dropdown">
    <a href="javascript:void(0)" class="btn btn-block samrs-brown dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-table"></i> View
        </a>
        <div class="dropdown-menu">
            <a class="dropdown-item" v-for="item in url" href="javascript:void(0)" v-on:click="clickLink(item.url)"> {{item.title}} </a>
        </div>
    </div>
  </div>
</template>
<script>
module.exports = {
    data: function(){
      return{
        url:[
          {
            "title" : "View Mode Inventory",
            "url" : "vmode=Inventory"
          },
          {
            "title" : "View Mode ASPAK",
            "url" : "vmode=Aspak"
          },
          {
            "title" : "View Mode Finance",
            "url" : "vmode=Finance"
          },
          {
            "title" : "View Mode Utilization",
            "url" : "vmode=Utilization"
          },
          {
            "title" : "View Mode Performance",
            "url" : "vmode=Performance"
          },
        ]
      }
    },
    methods: {
      clickLink(url){
          location.href = window.location.origin+window.location.pathname+"?"+url;
      }
    },
}
</script>
