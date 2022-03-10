<template>
<div class="p-10">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner insert-gambar">
            <!-- <div :class="'carousel-item '+activeState(index)" v-for="(image, index) in images">
                        <img class="is-fix" :src="image.src" alt="First slide">
                    </div> -->
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
</template>
  <style scoped>
    .zoom {
      /* padding: 50px; */
      /* background-color: green; */
      transition: transform .2s;
      /* Animation */
      /* width: 200px;
            height: 200px; */
      margin: 0 auto;
    }

    .zoom:hover {
      transform: scale(2);
      /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
    }
  </style>

<style scoped>
img.is-fix {
    display: block;
    height: auto;
    width: 8rem;
    margin: 0 auto;
}
</style>

<script>
// export default {
// }
</script>
