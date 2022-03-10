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
  let url = window.location + "";
  let path = url.replace(window.location.protocol + "//" + window.location.host + "/", "").split("?");
  let dropdownLink = $('.samrs-dropdown .dropdown-menu a').filter(function(){
    return this.href.split('?')[0] === url.split("?")[0] || this.href.split('?')[0]  === path ||  this.href.split('?')[0] === url.split("#")[0];
  });
  dropdownLink.addClass('active')

    $('body,html').on('click', function(a){
      let overlay = $('.samrs-overlay.on');
      let idOverlay = $('.samrs-overlay.on').attr('id');
      let isStatic = $('.samrs-overlay').attr('data-static');
      let overlayBox = $('.samrs-overlay.on#'+idOverlay+'');
      if (isStatic === "false") {
        if (!overlayBox.is(a.target) && overlayBox.has(a.target).length===0) {
          $('.samrs-overlay').removeClass('on');
          $('.samrs-overlay').addClass('off');
        }
      }
    });
  $(document).on('show.bs.modal', '.modal', function (event) {
    var zIndex = 1040 + (10 * $('.modal:visible').length);
    $(this).css('z-index', zIndex);
    setTimeout(function() {
        $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
    }, 0);
  });
  $(document).on('hidden.bs.modal', '.modal', function () {
    $('.modal:visible').length && $(document.body).addClass('modal-open');
  });
});
function SamrsModal(){
  let ModalPopup = $('.samrs-modal.popup');
  let ModalZoom = $('.samrs-modal.zoom');
  let ModalSlide = $('.samrs-modal.slide');
  let ModalRotate = $('.samrs-modal.rotate');
  let ModalBounce = $('.samrs-modal.bounce');
  let ModalTada = $('.samrs-modal.tada');
  ModalZoom.on('show.bs.modal', function(){
    if ($(this).find('.modal-dialog').hasClass('animated zoomOut')) {
      $(this).find('.modal-dialog').removeClass('animated zoomOut');
    }
    $(this).find('.modal-dialog').addClass('animated zoomIn');
  });
  ModalZoom.on('hide.bs.modal', function(){
    if ($(this).find('.modal-dialog').hasClass('animated zoomIn')) {
      $(this).find('.modal-dialog').removeClass('animated zoomIn');
    }
    $(this).find('.modal-dialog').addClass('animated zoomOut');
  });
  ModalSlide.on('show.bs.modal', function(){
    if ($(this).find('.modal-dialog').hasClass('animated slideOutRight')) {
      $(this).find('.modal-dialog').removeClass('animated slideOutRight');
    }
    $(this).find('.modal-dialog').addClass('animated slideInLeft');
  });
  ModalSlide.on('hide.bs.modal', function(){
    if ($(this).find('.modal-dialog').hasClass('animated slideInLeft')) {
      $(this).find('.modal-dialog').removeClass('animated slideInLeft');
    }
    $(this).find('.modal-dialog').addClass('animated slideOutRight');
  });
  ModalRotate.on('show.bs.modal', function(){
    if ($(this).find('.modal-dialog').hasClass('animated rotateOut')) {
      $(this).find('.modal-dialog').removeClass('animated rotateOut');
    }
    $(this).find('.modal-dialog').addClass('animated rotateIn');
  });
  ModalRotate.on('hide.bs.modal', function(){
    if ($(this).find('.modal-dialog').hasClass('animated rotateIn')) {
      $(this).find('.modal-dialog').removeClass('animated rotateIn');
    }
    $(this).find('.modal-dialog').addClass('animated rotateOut');
  });
  ModalBounce.on('show.bs.modal', function(){
    if ($(this).find('.modal-dialog').hasClass('animated bounceOut')) {
      $(this).find('.modal-dialog').removeClass('animated bounceOut');
    }
    $(this).find('.modal-dialog').addClass('animated bounceIn');
  });
  ModalBounce.on('hide.bs.modal', function(){
    if ($(this).find('.modal-dialog').hasClass('animated bounceIn')) {
      $(this).find('.modal-dialog').removeClass('animated bounceIn');
    }
    $(this).find('.modal-dialog').addClass('animated bounceOut');
  });
  ModalTada.on('show.bs.modal', function(){
    if ($(this).find('.modal-dialog').hasClass('animated hinge')) {
      $(this).find('.modal-dialog').removeClass('animated hinge');
    }
    $(this).find('.modal-dialog').addClass('animated tada');
  });
  ModalTada.on('hide.bs.modal', function(){
    if ($(this).find('.modal-dialog').hasClass('animated tada')) {
      $(this).find('.modal-dialog').removeClass('animated tada');
    }
    $(this).find('.modal-dialog').addClass('animated hinge');
  });
  ModalPopup.on('shown.bs.modal',function(){
    $('.modal-backdrop').removeClass('.show');
    $('.modal-backdrop').addClass('open-popup');
  });
  ModalPopup.on('hidden.bs.modal',function(){
    $('.modal-backdrop').removeClass('open-popup');
  });
}
function PasswordToggle(){
  $('.password-toggle').on('click',function(){
    if ($('.password-field').attr('type') === 'password') {
      $('.password-field').attr('type','text');
      $('.input-group-text').find('i').removeClass('fa-lock');
      $('.input-group-text').find('i').addClass('fa-lock-open');
      $(this).find('i').removeClass('fa-eye');
      $(this).find('i').addClass('fa-eye-slash');
    }else if ($('.password-field').attr('type') === 'text') {
      $('.password-field').attr('type','password');
      $('.input-group-text').find('i').removeClass('fa-lock-open');
      $('.input-group-text').find('i').addClass('fa-lock');
      $(this).find('i').removeClass('fa-eye-slash');
      $(this).find('i').addClass('fa-eye');
    }
  });
}
function SamrsOverlay(){
 $('[data-toggle="samrs-overlay"]').on('click', function(e){
     e.preventDefault();
     let Targets = $(this).data('target');
     let Toggle = $(this).data('toggle');
     if (Toggle === 'samrs-overlay') {
       if ($(Targets).hasClass('off')) {
         $(Targets).removeClass('off');
         $(Targets).addClass('on');
         $(Targets).find('[data-dismiss="samrs-overlay"]').attr('data-parent', Targets);
       }
     }else {
       console.log("ERR : Target not defined !");
     }
     e.stopPropagation();
   });
   $('[data-dismiss="samrs-overlay"]').on('click',function(){
     let CloseTargets = $(this).data('parent');
     if ($(CloseTargets).hasClass('on')) {
       $(CloseTargets).removeClass('on');
       $(CloseTargets).addClass('off');
       $(CloseTargets).find('[data-dismiss="samrs-overlay"]').removeAttr('data-parent');
     }
   });
}
function Tooltip(){
  $('[data-toggle="tooltip"]').tooltip();
}
function SwitchInital(){
  $('.samrs-switch').bootstrapToggle();
}
function DatePicker(){
  $('input[type="date"]').bootstrapMaterialDatePicker({ weekStart: 0, time: false });
}
function SignatureDrawing(modalHide){
  let wrapper = document.getElementById("signatureDrawpad");
  let clearButton = $("[data-action=clear]");
  let saveImages = $("[data-action=save-img]");
  let canvas = wrapper.querySelector("canvas");
  let signaturePad = new SignaturePad(canvas, {
    backgroundColor: 'rgb(255, 255, 255)'
  });
    clearButton.on('click',function(){
      signaturePad.clear();
    });
    saveImages.on('click',function(){
      var img_data = signaturePad.toDataURL();
      $('#ImageDrawing').prop('src', img_data);
      $('#'+modalHide).modal('hide');
    });
}
