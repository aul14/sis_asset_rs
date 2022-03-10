$(function(){
  "use strict";
  $("#main-wrapper").AdminSettings({
    Theme: false, // this can be true or false ( true means dark and false means light ),
    Layout: 'vertical',
    LogoBg: 'skin1', // You can change the Value to be skin1/skin2/skin3/skin4/skin5/skin6
    NavbarBg: 'skin1', // You can change the Value to be skin1/skin2/skin3/skin4/skin5/skin6
    SidebarType: 'full', // You can change it full / mini-sidebar / iconbar / overlay
    SidebarColor: 'skin5', // You can change the Value to be skin1/skin2/skin3/skin4/skin5/skin6
    SidebarPosition: true, // it can be true / false ( true means Fixed and false means absolute )
    HeaderPosition: true, // it can be true / false ( true means Fixed and false means absolute )
    BoxedLayout: false, // it can be true / false ( true means Boxed and false means Fluid )
  });
  let interval = setInterval(function(){
  let realTime = moment();
    realTime.locale('id');
    $('.real-time').find('.date').html(realTime.format('dddd') +', '+ realTime.format('DD MMMM YYYY'));
    $('.real-time').find('.time').html(realTime.format('HH:mm:ss'));
  });

  $('.samrs-dropdown').on('show.bs.dropdown', function(e){
    if ($('body').prop('dir') == 'ltr') {
      $(this).find('.dropdown-menu').removeClass('animated slideOutLeft');
      $(this).find('.dropdown-menu').removeClass('animated slideOutRight').addClass('animated slideInRight').show();
    }else if ($('body').prop('dir') == 'rtl') {
      $(this).find('.dropdown-menu').removeClass('animated slideOutRight');
      $(this).find('.dropdown-menu').removeClass('animated slideOutLeft').addClass('animated slideInLeft').show();
    }
  });
  $('.samrs-dropdown').on('hide.bs.dropdown', function(e){
    if ($('body').prop('dir') == 'ltr') {
      $(this).find('.dropdown-menu').removeClass('animated slideInLeft');
      $(this).find('.dropdown-menu').removeClass('animated slideInRight').addClass('animated slideOutRight');
    }else if ($('body').prop('dir') == 'rtl') {
      $(this).find('.dropdown-menu').removeClass('animated slideInRight');
      $(this).find('.dropdown-menu').removeClass('animated slideInLeft').addClass('animated slideOutLeft');
    }
  });
});
