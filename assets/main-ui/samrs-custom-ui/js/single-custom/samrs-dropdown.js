function SamrsDropdown() {
  let Hoverable = $('.samrs-dropdown.hoverable');
  let DropSlide = $('.samrs-dropdown.slide');
  let DropBounce = $('.samrs-dropdown.bounce');
  let DropFade = $('.samrs-dropdown.fade');
  let DropZoom = $('.samrs-dropdown.zoom');
  let DropTada =  $('.samrs-dropdown.tada');

  let DropStyle = $('.samrs-dropdown[dropdown-style]');

  DropStyle.on('show.bs.dropdown', function() {
    let $dropStyle = $(this).attr('dropdown-style');
    if ($dropStyle === 'slide') {
      if ($('body').prop('dir') == 'ltr') {
        $(this).find('.dropdown-menu').removeClass('animated slideOutLeft');
        $(this).find('.dropdown-menu').removeClass('animated slideOutRight').addClass('animated slideInRight').show();
      }else if ($('body').prop('dir') == 'rtl') {
        $(this).find('.dropdown-menu').removeClass('animated slideOutRight');
        $(this).find('.dropdown-menu').removeClass('animated slideOutLeft').addClass('animated slideInLeft').show();
      }
    }else if ($dropStyle === 'fade') {
      if ($('body').prop('dir') == 'ltr') {
        $(this).find('.dropdown-menu').removeClass('animated fadeOutLeft');
        $(this).find('.dropdown-menu').removeClass('animated fadeOutRight').addClass('animated fadeInRight').show();
      }else if ($('body').prop('dir') == 'rtl') {
        $(this).find('.dropdown-menu').removeClass('animated fadeOutRight');
        $(this).find('.dropdown-menu').removeClass('animated fadeOutLeft').addClass('animated fadeInLeft').show();
      }
    }else if ($dropStyle === 'zoom') {
        $(this).find('.dropdown-menu').removeClass('animated zoomOut').addClass('animated zoomIn').show();
    }else if ($dropStyle === 'tada') {
        $(this).find('.dropdown-menu').removeClass('animated zoomOut').addClass('animated tada').show();
    }else if ($dropStyle === 'bounce') {
      $(this).find('.dropdown-menu').addClass('animated bounceInDown');
    }
  });
  DropStyle.on('hide.bs.dropdown', function() {
    let $dropStyle = $(this).attr('dropdown-style');
    if ($dropStyle === 'slide') {
      if ($('body').prop('dir') == 'ltr') {
            $(this).find('.dropdown-menu').removeClass('animated slideInLeft');
            $(this).find('.dropdown-menu').removeClass('animated slideInRight').addClass('animated slideOutRight');
          }else if ($('body').prop('dir') == 'rtl') {
            $(this).find('.dropdown-menu').removeClass('animated slideInRight');
            $(this).find('.dropdown-menu').removeClass('animated slideInLeft').addClass('animated slideOutLeft');
          }
    }else if ($dropStyle === 'fade') {
      if ($('body').prop('dir') == 'ltr') {
            $(this).find('.dropdown-menu').removeClass('animated fadeInLeft');
            $(this).find('.dropdown-menu').removeClass('animated fadeInRight').addClass('animated fadeOutRight');
          }else if ($('body').prop('dir') == 'rtl') {
            $(this).find('.dropdown-menu').removeClass('animated fadeInRight');
            $(this).find('.dropdown-menu').removeClass('animated fadeInLeft').addClass('animated fadeOutLeft');
          }
    }else if ($dropStyle === 'zoom') {
        $(this).find('.dropdown-menu').removeClass('animated zoomOut').addClass('animated zoomOut');
    }else if ($dropStyle === 'tada') {
        $(this).find('.dropdown-menu').removeClass('animated tada').addClass('animated zoomOut');
    }
  });
  Hoverable.on('mouseover',function() {
    $(this).addClass('show');
    $(this).find('.dropdown-toggle').attr('aria-expanded', true);
    $(this).find('.dropdown-menu').addClass('show');
  });
  Hoverable.on('mouseout',function() {
    $(this).removeClass('show');
    $(this).find('.dropdown-toggle').attr('aria-expanded', false);
    $(this).find('.dropdown-menu').removeClass('show');
  });
}
