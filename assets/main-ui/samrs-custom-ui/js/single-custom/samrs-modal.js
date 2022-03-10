function SamrsModal(){
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
  $('.modal').each(function(){
    $(this).attr('dir','ltr');
  });
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
