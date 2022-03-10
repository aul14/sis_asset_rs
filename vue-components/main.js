let mainApp = new Vue({
  el: '#App',
  components: {
    'main-app':httpVueLoader(BASE_URL + 'vue-components/ui-components/main_component/main_app.vue?v=1.0'),
    'action-button-card':httpVueLoader(BASE_URL + 'vue-components/ui-components/main_component/action_card.vue?v=1.0'),
    'single-view-card':httpVueLoader(BASE_URL + 'vue-components/ui-components/main_component/single_card.vue?v=1.0'),
    'table-view-card':httpVueLoader(BASE_URL + 'vue-components/ui-components/main_component/table_card.vue?v=1.0'),
    'schedule-view-card':httpVueLoader(BASE_URL+'vue-components/ui-components/main_component/schedule_card.vue?v=1.0'),
    'advanced-search':httpVueLoader(BASE_URL+'vue-components/ui-components/main_component/advanced_search.vue?v=1.2'),
    'schedule-search':httpVueLoader(BASE_URL+'vue-components/ui-components/main_component/schedule_search.vue?v=1.0'),
    'samrs-overlay':httpVueLoader(BASE_URL + 'vue-components/ui-components/main_component/samrs_overlay.vue?v=1.0'),
    'table-init':httpVueLoader(BASE_URL + 'vue-components/ui-components/main_component/table_init.vue?v=1.3'),
    'schedule-init':httpVueLoader(BASE_URL+'vue-components/ui-components/main_component/schedule_init.vue?v=1.0'),
    'add-data':httpVueLoader(BASE_URL + 'vue-components/ui-components/buttons/add_data.vue?v=1.0'),
    'edit-data':httpVueLoader(BASE_URL + 'vue-components/ui-components/buttons/edit_data.vue?v=1.0'),
    'stock-data':httpVueLoader(BASE_URL + 'vue-components/ui-components/buttons/stock_data.vue?v=1.0'),
    'delete-data':httpVueLoader(BASE_URL + 'vue-components/ui-components/buttons/delete_data.vue?v=1.0'),
    'detail-data':httpVueLoader(BASE_URL + 'vue-components/ui-components/buttons/details_data.vue?v=1.0'),
    'print-qr-data':httpVueLoader(BASE_URL + 'vue-components/ui-components/buttons/printqr_data.vue?v=1.1'),
    'print-data':httpVueLoader(BASE_URL + 'vue-components/ui-components/buttons/print_data.vue?v=1.0'),
    'return-data':httpVueLoader(BASE_URL + 'vue-components/ui-components/buttons/return_data.vue?v=1.0'),
    'approve-data':httpVueLoader(BASE_URL + 'vue-components/ui-components/buttons/approve_data.vue?v=1.0'),
    'confirm-data':httpVueLoader(BASE_URL + 'vue-components/ui-components/buttons/confirm_data.vue?v=1.0'),
    'periode-data':httpVueLoader(BASE_URL + 'vue-components/ui-components/buttons/periode_data.vue?v=1.0'),
    'table-advance-search':httpVueLoader(BASE_URL + 'vue-components/ui-components/buttons/advance_search.vue?v=1.0'),
    'table-quick-view':httpVueLoader(BASE_URL + 'vue-components/ui-components/buttons/table_view.vue?v=1.0'),
    'table-column-view':httpVueLoader(BASE_URL + 'vue-components/ui-components/buttons/column_view.vue?v=1.0'),
    'previous':httpVueLoader(BASE_URL+'vue-components/ui-components/buttons/previous_data.vue?v=1.0'),
    'next':httpVueLoader(BASE_URL+'vue-components/ui-components/buttons/next_data.vue?v=1.0'),
    'contact-app':httpVueLoader(BASE_URL+'vue-components/contact/App.vue?v=1.1'),
    'user-config-app':httpVueLoader(BASE_URL+'vue-components/users/App.vue?v=1.0'),
    'navigation-dashboard':httpVueLoader(BASE_URL+'vue-components/dashboard/navigation/navbar_dashboard.vue?v=1.2'),
    'dashboard-bld-content':httpVueLoader(BASE_URL+'vue-components/dashboard/pages/bld/Bld.vue?v=1.6'),
    'dashboard-med-content':httpVueLoader(BASE_URL+'vue-components/dashboard/pages/med/Med.vue?v=1.6'),
    'dashboard-non-content':httpVueLoader(BASE_URL+'vue-components/dashboard/pages/non/Non.vue?v=1.6'),
    'desktop-view':httpVueLoader(BASE_URL+'vue-components/dashboard/pages/home/Home.vue?v=1.0')
  },
  data(){
    return{
      chartsYear:[]
    }
  },
  methods:{
    detectPage(){
      let url = window.location.search + "";
      let urlParameters = url.substr(1).split('&')[0];
      return urlParameters;
    },
    submenuParams(){
      let url = window.location.search + "";
      let urlParameters = url.substr(1).split('&')[0];
      let getValue = urlParameters.split('=');
      if (getValue.find(chr => chr.includes('_'))) {
        return getValue[1].split('_').join(' & ');
      }else if (getValue.find(chr => chr.includes('x'))) {
        return getValue[1].split('x').join(' & ');
      }else if (getValue.find(chr => chr.includes('%'))) {
        return getValue[1].split('%').join(' ');
      }else if (getValue.find(chr => chr.includes('+'))) {
        return getValue[1].split('+').join(' ');
      }else {
        return getValue[1];
      }
    },
    urlParameters(parameters){
      const urlString = window.location.search;
      const urlParams = new URLSearchParams(urlString);
      return urlParams.get(parameters);
    },
    pathIndex(){
      let urlString =  window.location.protocol+"//" +window.location.host+window.location.pathname+'/charts_data_year/';
      return urlString;
    }
  },
  created(){
    if (this.urlParameters('dashboard')) {
      axios.get(this.pathIndex()+this.urlParameters('dashboard'))
      .then(results => {
        this.chartsYear = results.data;
      });
    }
  },
  updated(){
    this.$nextTick(function() {
      SamrsDropdown();
      if (!$('.page-wrapper').hasClass('fixed-height')) {
        changeWrapper();
      }
      changeContent();
      changetableContent(120);
      singlecardContent(80, 100)
      changescheduleContent();
      changenavsContent();
      changecardContent()
    });
    function changeWrapper() {
      let newHeight = $(window).height() - $('footer').height();
      return $('.page-wrapper').css('height', newHeight+'px');
    }
    function changeContent(){
      let newHeight = $(window).height() - $('footer').height();
      return $('.page-content').css('height', newHeight+'px');
    }
    function changenavsContent(){
      let newHeight = $(window).height() - $('footer').height();
      let newheightCounts = newHeight - $('.page-content').outerHeight();
      let contentmaxHeight = parseInt($('.page-content').css('height')) + newheightCounts;
      let contentHeight = parseInt($('.page-content').css('height')) + newheightCounts - 100;
      $('.navs-content').css('height', contentHeight+'px');
      return $('.navs-content').css('max-height', contentmaxHeight+'px');
    }
    function changecardContent(){
      let newHeight = $('.page-content').height() - 60;
      let contentHeight = $('.page-content').height();
      $('.card-content').css('max-height',contentHeight+'px');
      return $('.card-content').css('height',newHeight+'px');
    }
    function changetableContent(height){
      let newHeight = $('.page-content').height() - $('.actioncard').outerHeight() - height;
      return $('.contentcard .table-responsive').css('height',newHeight+'px');
    }
    function singlecardContent(height, maxHeight) {
      let newHeight = $('.page-content').height() - height;
      let contentHeight = $('.page-content').height() - maxHeight;
      $('.singlecard .card-body').css(
        {
          'max-height':contentHeight+'px',
          'overflow-x':'hidden',
          'overflow-y':'scroll'
      });
      return $('.singlecard').css('height', newHeight+'px');
    }
    function changescheduleContent(){
      let newHeight = $('.page-content').height() - $('.actioncard').outerHeight() - 110;
      return $('.schedulecard .table-responsive').css('height',newHeight+'px');
    }
    $(window).resize(function(){
      if (!$('.page-wrapper').hasClass('fixed-height')) {
        changeWrapper();
      }
      changeContent();
      changetableContent(100);
      changescheduleContent();
      singlecardContent(70, 90)
      changenavsContent();
      changecardContent()
    });
  }
});
