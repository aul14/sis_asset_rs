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
$(document).ready(function() {
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
});
