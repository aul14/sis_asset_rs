<div class="modal samrs-modal zoom fade" id="rating" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="card-title m-auto" samrs-typography="capitalize 600">customer satisfication rate</h4>
      </div>
      <div class="modal-body samrs-form">
        <p class="mt-10 mb-10" samrs-typography="center capitalize 600">complain : <span samrs-typography="clear-transform">complain #123456</span> </p>
        <div class="star-wrap">
          <!-- <input checked class="input-star none" name="rating-1" value="0" type="radio"> -->
          <label  aria-label="1 stars"  class="star-label" for="rating-1">
            <i class="star-icon fas fa-star"></i>
          </label>
          <input checked class="input-star" id="rating-1" type="radio" name="rating-1" value="1">
          <label aria-label="2 stars" class="star-label" for="rating-2">
            <i class="star-icon fas fa-star"></i>
          </label>
          <input class="input-star" id="rating-2" type="radio" name="rating-1" value="2">
          <label aria-label="3 stars" class="star-label" for="rating-3">
            <i class="star-icon fas fa-star"></i>
          </label>
          <input class="input-star" id="rating-3" type="radio" name="rating-1" value="3">
          <label aria-label="4 stars" class="star-label" for="rating-4">
            <i class="star-icon fas fa-star"></i>
          </label>
          <input class="input-star" id="rating-4" type="radio" name="rating-1" value="4">
          <label aria-label="5 stars" class="star-label" for="rating-5">
            <i class="star-icon fas fa-star"></i>
          </label>
          <input class="input-star" id="rating-5" type="radio" name="rating-1" value="5">
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn samrs-primary" type="button" data-dismiss="modal">
          Skip for now
        </button>
      </div>
    </div>
  </div>
</div>
<!-- <script>
  window.setTimeout(function() {
      $('#rating').modal('show');
  }, 6000)
</script> -->