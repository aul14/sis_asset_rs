<template>
  <section class="auth-wrapper">
    <!-- <slot name="alert"></slot> -->
    <div class="samrs-flex wrapped is-row in-center far-from-top">
    <div class="col-xl-10">
      <div class="hospital-card card is-rounded swiper" with-state="hospital-swiper" title="Swipe or scroll down to see more hospital">
        <div class="card-header is-rounded p-2" data-color-type="light">
          <h2 class="text-capitalize border-bottom-1 border-light pl-0 pr-10 pt-10 pb-10">Select Hospital</h2>
        </div>
        <div class="swiper-wrapper p-10">
          <slot></slot>
        </div>
        <div class="swiper-pagination"></div>
      </div>
    </div>
  </div>

  </section>
</template>

<script>
module.exports = {
  mounted(){
    $(document).ready(function() {
      $('.hospital-card').addClass('animated slideInLeft delay-4s');
          let swiper = new Swiper(".swiper[with-state='hospital-swiper']", {
              direction: "horizontal",
              mousewheel: true,
              loop:false,
              breakpoints:{
                0:{
                  slidesPerView:1,
                  spaceBetween: 10,
                  grid: {
                    rows: 2
                  }
                },
                768:{
                  slidesPerView:1,
                  spaceBetween:10,
                  grid: {
                    rows: 2
                  }
                },
                1024:{
                  slidesPerView: 3,
                  spaceBetween:10,
                  grid: {
                    rows: 2
                  }
                },
                1280:{
                  slidesPerView: 3,
                  spaceBetween:10,
                  grid: {
                    rows: 2
                  },
                }
              },
              pagination: {
                el: ".swiper-pagination",
                type: "fraction"
              }
        });
      // $('.owl-carousel[with-state="hospital-carousel"]').owlCarousel({
      //   loop:false,
      //   dots:false,
      //   margin:10,
      //     navText:["<div class='samrs-slider prev-slide'><i class='fas fa-chevron-circle-left'></i></div>",
      //     "<div class='samrs-slider next-slide'><i class='fas fa-chevron-circle-right'></i></div>"],
      //   responsive: {
      //     0:{
      //       items:1,
      //       nav:true
      //     },
      //     600:{
      //       items:2,
      //       nav:true
      //     },
      //     1000:{
      //       items:2,
      //       nav:true
      //     }
      //   }
      // });
      // $('.owl-carousel[with-state="hospital-carousel"]').on('mousewheel', '.owl-stage', function (e) {
      //     if (e.deltaY>0) {
      //         $(this).trigger('next.owl');
      //     } else {
      //         $(this).trigger('prev.owl');
      //     }
      //     e.preventDefault();
      // });
      function hospitalcardResize(){
          let cardHeight = $(window).height() - 80;
          return $('.hospital-card').css('height',cardHeight+'px');
        }
      hospitalcardResize();
      $(window).resize(function() {
        hospitalcardResize();
      });
      $('img[with-state="hospital-logo"]').each(function() {
        $(this).on('error',function() {
          $(this).attr('src',BASE_URL+'assets/images/action-img/no-image-samrs.png')
        })
      });
    });
  }
}
</script>
<style scoped>
.swiper-slide {
  border-radius: 3px;
  box-shadow: 5px 4px 6px 0px rgb(0 0 0 / 30%);
  height: calc((100% - 30px) / 2);
  padding: 10px;
}
.hospital-card{
  overflow-y: hidden;
  overflow-x: hidden;
  padding-bottom: 75px
}
.hospital-info.in-center{
  align-content: center;
}
.is-rounded-corner{
  border-radius: 10px;
}
</style>
