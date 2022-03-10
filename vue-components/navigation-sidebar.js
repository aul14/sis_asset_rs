let appSidebar = new Vue({
  el: '#sidebar_main',
  components: {
    'sidebar-main':httpVueLoader(BASE_URL + 'vue-components/ui-components/navigation/sidebar_main.vue?v=1.2'),
    'sidebar-link':httpVueLoader(BASE_URL + 'vue-components/ui-components/navigation/sidebar_link.vue?v=1.0'),
    'sidebar-level':httpVueLoader(BASE_URL + 'vue-components/ui-components/navigation/sidebar_level.vue?v=1.0')
  },
  mounted(){
    // function sidebarMenu(){
    //   $(function() {
    //       "use strict";
    //         var url = window.location + "";
    //         var path = url.replace(window.location.protocol + "//" + window.location.host + "/", "").split("?");
    //         var element = $('ul#sidebarnav a').filter(function() {
    //             return this.href.split('?')[0] === url.split("?")[0] || this.href.split('?')[0]  === path ||  this.href.split('?')[0] === url.split("#")[0]// || url.href.indexOf(this.href) === 0;
    //         });
    //       element.addClass("active");
    //       element.parentsUntil(".sidebar-nav").each(function (index)
    //       {
    //           if($(this).is("li") && $(this).children("a").length !== 0)
    //           {
    //               $(this).children("a").addClass("active");
    //               $(this).parent("ul#sidebarnav").length === 0
    //                   ? $(this).addClass("active")
    //                   : $(this).addClass("selected");
    //           }
    //           else if(!$(this).is("ul") && $(this).children("a").length === 0)
    //           {
    //               $(this).addClass("selected");
    //
    //           }
    //           else if($(this).is("ul")){
    //               $(this).addClass('in');
    //           }
    //
    //       });
    //       $('#sidebarnav a').on('click', function (e) {
    //
    //               if (!$(this).hasClass("active")) {
    //                   // hide any open menus and remove all other classes
    //                   $("ul", $(this).parents("ul:first")).removeClass("in");
    //                   $("a", $(this).parents("ul:first")).removeClass("active");
    //
    //                   // open our new menu and add the open class
    //                   $(this).next("ul").addClass("in");
    //                   $(this).addClass("active");
    //
    //               }
    //               else if ($(this).hasClass("active")) {
    //                   $(this).removeClass("active");
    //                   $(this).parents("ul:first").removeClass("active");
    //                   $(this).next("ul").removeClass("in");
    //               }
    //       })
    //       // $('#sidebarnav >li >a.has-arrow').on('click', function (e) {
    //       //     e.preventDefault();
    //       // });
    //
    //   });
    // }
    // this.$nextTick(function() {
    //   $(document).ready(function() {
    //      sidebarMenu();
    //   })
    // });
  }
});
